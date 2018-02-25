<?php
/**
* Secure login/registration user class.
*/

class User{
    /** @var object $pdo Copy of PDO connection */
    private $pdo;
    /** @var object of the logged in user */
    private $user;
    /** @var string error msg */
    private $msg;
    /** @var int number of permitted wrong login attemps */
    private $permitedAttemps = 5;

    /**
    * Connection init function
    * @param string $conString DB connection string.
    * @param string $user DB user.
    * @param string $pass DB password.
    *
    * @return bool Returns connection success.
    */
    public function dbConnect($conString, $user, $pass){
        if(session_status() === PHP_SESSION_ACTIVE){
            try {
                $pdo = new PDO($conString, $user, $pass);
                $this->pdo = $pdo;
                return true;
            }catch(PDOException $e) { 
                $this->msg = '¡No se pudo realizar la conexión!';
                return false;
            }
        }else{
            $this->msg = 'No se ha podido iniciar sesión.';
            return false;
        }
    }

    /**
    * Return the logged in user.
    * @return user array data
    */
    public function getUser(){
        return $this->user;
    }

    /**
    * Login function
    * @param string $email User email.
    * @param string $password User password.
    *
    * @return bool Returns login success.
    */
    public function login($email,$password){
        if(is_null($this->pdo)){
            $this->msg = '¡No se pudo realizar la conexión!';
            return false;
        }else{
            $pdo = $this->pdo;
            $stmt = $pdo->prepare('SELECT id, fname, lname, email, wrong_logins, password, user_role, avatar FROM users WHERE email = ? and confirmed = 1 limit 1');
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if(password_verify($password,$user['password'])){
                if($user['wrong_logins'] <= $this->permitedAttemps){
                    $this->user = $user;
                    session_regenerate_id();
                    $_SESSION['user']['id'] = $user['id'];
                    $_SESSION['user']['fname'] = $user['fname'];
                    $_SESSION['user']['lname'] = $user['lname'];
                    $_SESSION['user']['email'] = $user['email'];
                    $_SESSION['user']['user_role'] = $user['user_role'];
					$_SESSION['user']['avatar'] = $user['avatar'];
					if($user['wrong_logins'] > 0){
						$stmt = $pdo->prepare('UPDATE users SET wrong_logins = 0 WHERE email = ?');
						$stmt->execute([$email]);
					}
                    return true;
                }else{
                    $this->msg = 'Esta cuenta de usuario está bloqueada, por favor ponte en contacto con el administrador.';
                    return false;
                }
            }else{
                $this->registerWrongLoginAttemp($email);
                $this->msg = 'El usuario o la contraseña no son válidos o la cuenta todavía no ha sido activada.';
                return false;
            } 
        }
    }

    /**
    * Register a new user account function
    * @param string $email User email.
    * @param string $fname User first name.
    * @param string $lname User last name.
    * @param string $pass User password.
    * @return boolean of success.
    */
    public function registration($email,$fname,$lname,$pass){
        $pdo = $this->pdo;
        if($this->checkEmail($email)){
            $this->msg = 'This email is already taken.';
            return false;
        }
        if(!(isset($email) && isset($fname) && isset($lname) && isset($pass) && filter_var($email, FILTER_VALIDATE_EMAIL))){
            $this->msg = 'Inesrt all valid requered fields.';
            return false;
        }

        $pass = $this->hashPass($pass);
        $confCode = $this->hashPass(date('Y-m-d H:i:s').$email);
        $stmt = $pdo->prepare('INSERT INTO users (fname, lname, email, password, confirm_code) VALUES (?, ?, ?, ?, ?)');
        if($stmt->execute([$fname,$lname,$email,$pass,$confCode])){
            if($this->sendConfirmationEmail($email)){
                return true;
            }else{
                $this->msg = 'confirmation email sending has failed.';
                return false; 
            }
        }else{
            $this->msg = 'Inesrting a new user failed.';
            return false;
        }
    }

    /**
    * Email the confirmation code function
    * @param string $email User email.
    * @return boolean of success.
    */
    private function sendConfirmationEmail($email){
        $pdo = $this->pdo;
        $stmt = $pdo->prepare('SELECT confirm_code FROM users WHERE email = ? limit 1');
        $stmt->execute([$email]);
        $code = $stmt->fetch();

        $subject = 'Confirm your registration';
        $message = 'Please confirm you registration by pasting this code in the confirmation box: '.$code['confirm_code'];
        $headers = 'X-Mailer: PHP/' . phpversion();

        if(mail($email, $subject, $message, $headers)){
            return true;
        }else{
            return false;
        }
    }

    /**
    * Activate a login by a confirmation code and login function
    * @param string $email User email.
    * @param string $confCode Confirmation code.
    * @return boolean of success.
    */
    public function emailActivation($email,$confCode){
        $pdo = $this->pdo;
        $stmt = $pdo->prepare('UPDATE users SET confirmed = 1 WHERE email = ? and confirm_code = ?');
        $stmt->execute([$email,$confCode]);
        if($stmt->rowCount()>0){
            $stmt = $pdo->prepare('SELECT id, fname, lname, email, wrong_logins, user_role, avatar FROM users WHERE email = ? and confirmed = 1 limit 1');
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            $this->user = $user;
            session_regenerate_id();
            if(!empty($user['email'])){
            	$_SESSION['user']['id'] = $user['id'];
	            $_SESSION['user']['fname'] = $user['fname'];
	            $_SESSION['user']['lname'] = $user['lname'];
	            $_SESSION['user']['email'] = $user['email'];
	            $_SESSION['user']['user_role'] = $user['user_role'];
				$_SESSION['user']['avatar'] = $user['avatar'];
	            return true;
            }else{
            	$this->msg = 'Account activitation failed.';
            	return false;
            }            
        }else{
            $this->msg = 'Account activitation failed.';
            return false;
        }
    }

    /**
    * Password change function
    * @param int $id User id.
    * @param string $pass New password.
    * @return boolean of success.
    */
    public function passwordChange($id,$pass){
        $pdo = $this->pdo;
        if(isset($id) && isset($pass)){
            $stmt = $pdo->prepare('UPDATE users SET password = ?, wrong_logins = 0 WHERE id = ?');
            if($stmt->execute([$this->hashPass($pass),$id])){
                return true;
            }else{
                $this->msg = 'No se ha podido actualizar la contraseña.';
                return false;
            }
        }else{
            $this->msg = 'Proporciona un ID y una contraseña.';
            return false;
        }
    }
	
	public function updateProfile($id,$nombre,$apellido,$email){
        $pdo = $this->pdo;
        if(isset($id) && isset($nombre) && isset($apellido) && isset($email)){
            $stmt = $pdo->prepare('UPDATE users SET fname = ?, lname = ?, email = ? WHERE id = ?');
            if($stmt->execute([$nombre,$apellido,$email,$id])){
				$stmt = $pdo->prepare('SELECT id, fname, lname, email, wrong_logins, user_role, avatar FROM users WHERE id = ? and confirmed = 1 limit 1');
				$stmt->execute([$id]);
				
				if($_SESSION['user']['id'] == $id){
					$user = $stmt->fetch();
					$this->user = $user;
					session_regenerate_id();
					$_SESSION['user']['id'] = $user['id'];
					$_SESSION['user']['fname'] = $user['fname'];
					$_SESSION['user']['lname'] = $user['lname'];
					$_SESSION['user']['email'] = $user['email'];
					$_SESSION['user']['user_role'] = $user['user_role'];
					$_SESSION['user']['avatar'] = $user['avatar'];
				}

                return true;
            }else{
                $this->msg = 'Error al actualizar los datos.';
                return false;
            }
        }else{
            $this->msg = 'Todos los campos son obligatorios.';
            return false;
        }
    }
	
	public function updateAvatar($id, $imageFileType){
		$pdo = $this->pdo;
		if(isset($id) && isset($imageFileType)){
			$archivo = $id . "." . $imageFileType;
			$stmt = $pdo->prepare('UPDATE users SET avatar = ? WHERE id = ?');
			
			if($stmt->execute([$archivo, $id])){
				$stmt = $pdo->prepare('SELECT id, fname, lname, email, wrong_logins, user_role, avatar FROM users WHERE id = ? and confirmed = 1 limit 1');
				$stmt->execute([$id]);

				if($_SESSION['user']['id'] == $id){
					$user = $stmt->fetch();
					$this->user = $user;
					session_regenerate_id();
					$_SESSION['user']['id'] = $user['id'];
					$_SESSION['user']['fname'] = $user['fname'];
					$_SESSION['user']['lname'] = $user['lname'];
					$_SESSION['user']['email'] = $user['email'];
					$_SESSION['user']['user_role'] = $user['user_role'];
					$_SESSION['user']['avatar'] = $user['avatar'];
				}

                return true;
			} else {
				$this->msg = 'Error al actualizar los datos.';
                return false;
			}
		} else {
			$this->msg = 'Ha ocurrido un error, inténtalo más tarde.';
            return false;
		}
	}


    /**
    * Assign a role function
    * @param int $id User id.
    * @param int $role User role.
    * @return boolean of success.
    */
    public function assignRole($id,$role){
        $pdo = $this->pdo;
        if(isset($id) && isset($role)){
            $stmt = $pdo->prepare('UPDATE users SET role = ? WHERE id = ?');
            if($stmt->execute([$id,$role])){
                return true;
            }else{
                $this->msg = 'Role assign failed.';
                return false;
            }
        }else{
            $this->msg = 'Provide a role for this user.';
            return false;
        }
    }



    /**
    * User information change function
    * @param int $id User id.
    * @param string $fname User first name.
    * @param string $lname User last name.
    * @return boolean of success.
    */
    public function userUpdate($id,$fname,$lname){
        $pdo = $this->pdo;
        if(isset($id) && isset($fname) && isset($lname)){
            $stmt = $pdo->prepare('UPDATE users SET fname = ?, lname = ? WHERE id = ?');
            if($stmt->execute([$id,$fname,$lname])){
                return true;
            }else{
                $this->msg = 'No hemos podido actualizar el perfil.';
                return false;
            }
        }else{
            $this->msg = 'Proporciona datos válidos.';
            return false;
        }
    }

    /**
    * Check if email is already used function
    * @param string $email User email.
    * @return boolean of success.
    */
    private function checkEmail($email){
        $pdo = $this->pdo;
        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ? limit 1');
        $stmt->execute([$email]);
        if($stmt->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }


    /**
    * Register a wrong login attemp function
    * @param string $email User email.
    * @return void.
    */
    private function registerWrongLoginAttemp($email){
        $pdo = $this->pdo;
        $stmt = $pdo->prepare('UPDATE users SET wrong_logins = wrong_logins + 1 WHERE email = ?');
        $stmt->execute([$email]);
    }

    /**
    * Password hash function
    * @param string $password User password.
    * @return string $password Hashed password.
    */
    private function hashPass($pass){
        return password_hash($pass, PASSWORD_DEFAULT);
    }

    /**
    * Print error msg function
    * @return void.
    */
    public function printMsg(){
        print $this->msg;
    }

    /**
    * Logout the user and remove it from the session.
    *
    * @return true
    */
    public function logout() {
        $_SESSION['user'] = null;
        session_regenerate_id();
        return true;
    }



    /**
    * List users function
    *
    * @return array Returns list of users.
    */
    public function listUsers(){
        if(is_null($this->pdo)){
            $this->msg = '¡No se pudo realizar la conexión!';
            return [];
        }else{
            $pdo = $this->pdo;
            $stmt = $pdo->prepare('SELECT id, fname, lname, email FROM users WHERE confirmed = 1');
            $stmt->execute();
            $result = $stmt->fetchAll(); 
            return $result; 
        }
    }

    /**
    * Simple template rendering function
    * @param string $path path of the template file.
    * @return void.
    */
    public function render($path,$vars = '') {
        ob_start();
        include($path);
        return ob_get_clean();
    }
	
	public function renderData($path,$vars,$datos) {
        ob_start();
        include($path);
        return ob_get_clean();
    }

    /**
    * Template for index head function
    * @return void.
    */
    public function indexHead() {
        print $this->render(indexHead);
    }

    /**
    * Template for index top function
    * @return void.
    */
    public function indexTop() {
        print $this->render(indexTop);
    }

    /**
    * Template for login form function
    * @return void.
    */
    public function loginForm() {
        print $this->render(loginForm);
    }

    /**
    * Template for activation form function
    * @return void.
    */
    public function activationForm() {
        print $this->render(activationForm);
    }

    /**
    * Template for index middle function
    * @return void.
    */
    public function indexMiddle() {
        print $this->render(indexMiddle);
    }

    /**
    * Template for register form function
    * @return void.
    */
    public function registerForm() {
        print $this->render(registerForm);
    }

    /**
    * Template for index footer function
    * @return void.
    */
    public function indexFooter() {
        print $this->render(indexFooter);
    }

    /**
    * Template for user page function
    * @return void.
    */
    public function userEdit() {
	$users = [];
	if($_SESSION['user']['user_role'] == 2){
		$users = $this->listUsers();
	}
        print $this->render(userEdit,$users);
    }
	
	public function usereditFooter() {
        print $this->render(usereditFooter);
    }
	
	public function userEditFooterAdmin() {
        print $this->render(userEditFooterAdmin);
    }
	
	public function usersMiddle($data) {
        print $this->renderData(usersMiddle, "", $data);
    }
	
	public function userEditAdmin($data) {
        print $this->renderData(userEditAdmin, "", $data);
    }
	
	public function usersFooter() {
        print $this->render(usersFooter);
    }
	
	public function getUsers(){
		$database = new Database();
		

		$database->query('SELECT * FROM users ORDER BY id DESC');
		$code = $database->resultset();
		if($database->rowCount() > 0){
			return $code;
		} else {
			return false;
		}

    }
	
	public function getSingleUser($id){
		$database = new Database();
		
		if(isset($id) && $id !== ""){
			$database->query('SELECT * FROM users WHERE id = :id ORDER BY id DESC');
			$database->bind(':id', $id);
			$code = $database->single();
			if($database->rowCount() > 0){
				return $code;
			} else {
				return false;
			}
		} 
    }
	
	public function newUser($nombre){
		$database = new Database();
		
		if(isset($nombre) && $nombre !== ""){
						
			$database->query('INSERT INTO users (id, fname, lname, email, wrong_logins, user_role, confirmed, password, avatar) VALUES (:id, :fname, :lname, :email, :wrong_logins, :user_role, :confirmed, :password, :avatar)');
			$database->bind(':id', NULL);
			$database->bind(':lname', "");
			$database->bind(':email', rand());
			$database->bind(':password', "tocatelagaita23");
			$database->bind(':fname', $nombre);
			$database->bind(':wrong_logins', 0);
			$database->bind(':user_role', 1);
			$database->bind(':confirmed', 1);
			$database->bind(':avatar', "");
			
			if($database->execute()){
				$this->msg = $database->lastInsertId();
				return true;
			} else {
				$this->msg = 'Ha ocurrido un error creando tu nuevo slider. Inténtalo más tarde.';
				return false;
			}
		}
		$this->msg = 'Ha ocurrido un error creando tu nuevo slider. Inténtalo más tarde.';
		return false;
	}
	
	
	public function delUser($id){
		$database = new Database();
		
		if(isset($id) && $id !== ""){
			
			$database->query('DELETE FROM users WHERE id = :id');
			$database->bind(':id', $id);
			
			if($database->execute()){
				return true;
			} else {
				$this->msg = 'Ha ocurrido un error durante el borrado del usuario. Inténtalo más tarde.';
				return false;
			}
		} else {
			$this->msg = 'Ha ocurrido un error durante el borrado del usuario. Inténtalo más tarde.';
			return false;
		}
	}
	

	

}
