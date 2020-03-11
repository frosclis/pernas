<?php
class Dashboard{
	
    private $dashboard;
	
	public function getDashboard(){
        return $this->dashboard;
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
	* Templates del Dashboad
	* @return void*/
	
	public function dashboardHead() {
        print $this->render(dashboardHead);
    }
	
	public function dashboardTop() {
        print $this->render(dashboardTop);
    }
	
	public function dashboardMiddle() {
        print $this->render(dashboardMiddle);
    }
	
	public function dashboardFooter() {
        print $this->render(dashboardFooter);
    }
	
	public function optionsEdit($data) {
        print $this->renderData(optionsEdit, "", $data);
    }
	
	public function optionsFooter() {
        print $this->render(optionsFooter);
    }
	
	public function menuEdit($data) {
        print $this->renderData(menuEdit, "", $data);
    }
	
	public function menuFooter() {
        print $this->render(menuFooter);
    }
	
	public function getOptions(){
		$database = new Database();
		
		$database->query('SELECT * FROM parameters');
		$code = $database->resultset();
		return $code;
    }
	
	public function setOptions($nombre_web, $description, $email, $facebook, $twitter, $instagram, $flickr, $pinterest, $linkedin, $telefono, $direccion, $latitud, $longitud, $mantenimiento){
		$database = new Database();
		
		$database->query('UPDATE parameters SET nombre_web = :nombre_web, description = :description, email = :email, facebook = :facebook, twitter = :twitter, instagram = :instagram, flickr = :flickr, pinterest = :pinterest, linkedin = :linkedin, telefono = :telefono, direccion = :direccion, longitud = :longitud, latitud = :latitud, mantenimiento = :mantenimiento WHERE id = :id');
		
		$database->bind(':id', 1);
		$database->bind(':nombre_web', $nombre_web);
		$database->bind(':description', $description);
		$database->bind(':email', $email);
		$database->bind(':facebook', $facebook);
		$database->bind(':twitter', $twitter);
		$database->bind(':instagram', $instagram);
		$database->bind(':flickr', $flickr);
		$database->bind(':pinterest', $pinterest);
		$database->bind(':linkedin', $linkedin);
		$database->bind(':telefono', $telefono);
		$database->bind(':direccion', $direccion);
		$database->bind(':latitud', $latitud);
		$database->bind(':longitud', $longitud);
		$database->bind(':mantenimiento', $mantenimiento);
		
		
		if($database->execute()){
			return true;
		} else {
			$this->msg = 'Ha ocurrido un problema al guardar los datos. Inténtalo más tarde.';
			return false;
		}
    }
	
	public function getMenus($father){
		$database = new Database();
		
		$database->query('SELECT * FROM menu WHERE father = :father ORDER BY position');
		$database->bind(':father', $father);
		$code = $database->resultset();
		return $code;
    }
	
	public function setMenu($name, $url, $father){
		$database = new Database();
		
		
		$database->query('INSERT INTO menu (name, url, father, position) VALUES ( :name, :url, :father, :position)');
		
		$database->bind(':name', $name);
		$database->bind(':url', $url);
		$database->bind(':father', $father);
		$database->bind(':position', 100);
		
		var_dump($database->query);
		die;
		
		if($database->execute()){
			return true;
		} else {
			$this->msg = 'Ha ocurrido un problema al guardar los datos. Inténtalo más tarde.';
			return false;
		}
    }
	
	public function updateMenu($id, $position, $father){
		$database = new Database();
		
		$database->query('UPDATE menu SET position = :position, father = :father WHERE id = :id ORDER BY father, position');
		
		$database->bind(':id', $id);
		$database->bind(':position', $position);
		$database->bind(':father', $father);
		
		
		if($database->execute()){
			return true;
		} else {
			$this->msg = 'Ha ocurrido un problema al guardar los datos. Inténtalo más tarde.';
			return false;
		}
    }
	
	public function getPaginas(){
		$database = new Database();
		
		$database->query('SELECT * FROM pages WHERE estado = 1 ORDER BY id');
		$code = $database->resultset();
		return $code;
    }
	
	public function getGalerias(){
		$database = new Database();
		
		$database->query('SELECT * FROM galleries WHERE estado = 1 ORDER BY id');
		$code = $database->resultset();
		return $code;
    }
	
	public function getCategories(){
		$database = new Database();
		
		$database->query('SELECT * FROM categories WHERE estado = 1 ORDER BY id');
		$code = $database->resultset();
		return $code;
	}
	
	public function updateImagesPosition($id, $type, $position){
		$database = new Database();
		error_log("ID:".$id, 0);

		if ($type == 'categoryimages') {
			$database->query('UPDATE categoryimages SET position = :position WHERE id = :id');
		} else if ($type == 'categoryblogimages') {
			$database->query('UPDATE categoryblogimages SET position = :position WHERE id = :id');
		} else if ($type == 'galleriesimages') {
			$database->query('UPDATE galleriesimages SET position = :position WHERE id = :id');
		} else if ($type == 'pagesimages') {
			$database->query('UPDATE pagesimages SET position = :position WHERE id = :id');
		} else if ($type == 'postsimages') {
			$database->query('UPDATE postsimages SET position = :position WHERE id = :id');
		}		
		
		$database->bind(':id', $id);
		$database->bind(':position', $position);
		
		
		if($database->execute()){
			return true;
		} else {
			$this->msg = 'Ha ocurrido un problema al guardar los datos. Inténtalo más tarde.';
			return false;
		}
    }
	
}
	
?>