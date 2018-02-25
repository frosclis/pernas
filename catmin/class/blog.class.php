<?php
class Blog{
	
    private $blog;
	
	private $msg;
	
	public function getBlog(){
        return $this->blog;
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
	
	public function postsMiddle($data) {
        print $this->renderData(postsMiddle, "", $data);
    }
	
	public function postsFooter() {
        print $this->render(postsFooter);
    }
	
	public function postEdit($data){
		print $this->renderData(postEdit, "", $data);
	}
	
	public function posteditFooter() {
        print $this->render(posteditFooter);
    }
	
	public function posteditHead() {
        print $this->render(posteditHead);
    }
	
	/**
	* Obtener el listado de páginas
	* @return void*/
	
	public function getPosts($estado){
		$database = new Database();
		
		if(isset($estado) && $estado !== ""){
			$database->query('SELECT * FROM posts WHERE estado = :estado ORDER BY id DESC');
			$database->bind(':estado', $estado);
			$code = $database->resultset();
			if($database->rowCount() > 0){
				return $code;
			} else {
				return false;
			}
		} else {
			$database->query('SELECT * FROM posts ORDER BY id DESC');
			$code = $database->resultset();
			if($database->rowCount() > 0){
				return $code;
			} else {
				return false;
			}
		}
    }
	
	 /**
    * Print error msg function
    * @return void.
    */
    public function printMsg(){
        print $this->msg;
    }
	
	public function checkFriendly($friendly_url, $pagina_id){
		$databasecheck = new Database();
		
		$databasecheck->query('SELECT friendly_url FROM posts WHERE (friendly_url = :friendly_url AND id NOT IN ( :pagina_id ))');	
		$databasecheck->bind(':pagina_id', $pagina_id);
		$databasecheck->bind(':friendly_url', $friendly_url);
		$databasecheck->execute();
		
		if ($databasecheck->rowCount() > 0){
			return false;
		} else {
			return true;
		}
	}
	
	public function checkFriendlyNew($friendly_url){
		$databasecheck = new Database();
		

		$databasecheck->query('SELECT friendly_url FROM posts WHERE friendly_url = :friendly_url');
		$databasecheck->bind(':friendly_url', $friendly_url);
		$databasecheck->execute();
		
		if ($databasecheck->rowCount() > 0){
			return false;
		} else {
			return true;
		}
	}
	
	public function friendlyURL($string){
		return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));
	}
	
	public function getSinglePost($id){
		$database = new Database();
		
		if(isset($id) && $id !== ""){
			$database->query('SELECT * FROM posts WHERE id = :id ORDER BY id DESC');
			$database->bind(':id', $id);
			$code = $database->single();
			if($database->rowCount() > 0){
				return $code;
			} else {
				return false;
			}
		} 
    }
	
	public function updatePost($pagina_id, $friendly_url, $meta_description, $keywords, $subtitulo, $contenido, $estado, $titulo, $fecha_publicacion, $portada, $categoria){
		$database = new Database();
		
		$friendly_original = $friendly_url;
		$contador = 1;
			
		while ($this->checkFriendly($friendly_url, $pagina_id) == false){
			$friendly_url = $friendly_original . "-" .$contador;
			$contador++;
		}
		

		$database->query('UPDATE posts SET friendly_url = :friendly_url, meta_description = :meta_description, keywords = :keywords, subtitulo = :subtitulo, contenido = :contenido, estado = :estado, titulo = :titulo, ultima_edicion = NOW(), fecha_publicacion = :fecha_publicacion, portada = :portada, categoria = :categoria WHERE id = :pagina_id');
		$database->bind(':friendly_url', $friendly_url);
		$database->bind(':meta_description', $meta_description);
		$database->bind(':keywords', $keywords);
		$database->bind(':fecha_publicacion', $fecha_publicacion);
		$database->bind(':portada', $portada);
		$database->bind(':subtitulo', $subtitulo);
		$database->bind(':estado', $estado);
		$database->bind(':pagina_id', $pagina_id);
		$database->bind(':contenido', $contenido);
		$database->bind(':titulo', $titulo);
		$database->bind(':categoria', $categoria);
		
		if($database->execute()){
			return true;
		} else {
			$this->msg = 'Ha ocurrido un problema con tu actualización. Inténtalo más tarde.';
			return false;
		}
    }
	
	public function delPost($id){
		$database = new Database();
		
		if(isset($id) && $id !== ""){
			
			$database->query('DELETE FROM posts WHERE id = :id');
			$database->bind(':id', $id);
			
			if($database->execute()){
				return true;
			} else {
				$this->msg = 'Ha ocurrido un error durante el borrado de la página. Inténtalo más tarde.';
				return false;
			}
		} else {
			$this->msg = 'Ha ocurrido un error durante el borrado de la página. Inténtalo más tarde.';
			return false;
		}
	}
	
	public function newPost($nombre, $autor){
		$database = new Database();
		
		if(isset($nombre) && $nombre !== ""){
			$friendly_url = $this->friendlyURL($nombre);
			
			$friendly_original = $friendly_url;
			$contador = 1;
			while ($this->checkFriendlyNew($friendly_url) == false){
				$friendly_url = $friendly_original . "-" .$contador;
				$contador++; 
			}
			
			$database->query('INSERT INTO posts (id, titulo, friendly_url, estado, autor, meta_description, keywords, subtitulo, contenido, ultima_edicion, fecha_publicacion, portada, categoria) VALUES (:id, :titulo, :friendly_url, :estado, :autor, :meta_description, :keywords, :subtitulo, :contenido, NOW(), :fecha_publicacion, :portada, :categoria)');
			$database->bind(':id', NULL);
			$database->bind(':meta_description', "");
			$database->bind(':keywords', "");
			$database->bind(':subtitulo', "");
			$database->bind(':contenido', "");
			$database->bind(':fecha_publicacion', "");
			$database->bind(':portada', "");
			$database->bind(':titulo', $nombre);
			$database->bind(':friendly_url', $friendly_url);
			$database->bind(':estado', 0);
			$database->bind(':autor', $autor);
			$database->bind(':categoria', "");
			
			if($database->execute()){
				$this->msg = $database->lastInsertId();
				return true;
			} else {
				$this->msg = 'Ha ocurrido un error creando tu nueva página. Inténtalo más tarde.';
				return false;
			}
		}
		$this->msg = 'Ha ocurrido un error creando tu nueva página. Inténtalo más tarde.';
		return false;
	}
	
	
	public function uploadImages($pageID, $nuevo){
		
		$database = new Database();
		
		if(isset($pageID) && $pageID !== "" && isset($nuevo) && $nuevo !== ""){
			$database->query("INSERT INTO postsimages (file_name, uploaded, post) VALUES(:file_name, NOW(), :page)");
			$database->bind(':file_name', $nuevo);
			$database->bind(':page', $pageID);
			
			if($database->execute()){
				return true;
			} else {
				$this->msg = 'Ha ocurrido un error registrando las imágenes. Inténtalo más tarde.';
				return false;
			}
		} else {
			$this->msg = 'Ha ocurrido un error registrando las imágenes. Inténtalo más tarde.';
			return false;
		}
	}
	
	public function getImages($pageID){
		
		$database = new Database();
		
		$database->query("SELECT * FROM postsimages WHERE post = :page");
		$database->bind(':page', $pageID);
		
		$resultado = $database->resultset();
		
		echo json_encode($resultado);
	}
	
	public function deleteImage($imageID, $ruta){
		$database = new Database();
		
		$database->query("DELETE FROM postsimages WHERE id = :id");
		$database->bind(':id', $imageID);
		
		if($database->execute()){
			$name = basename($ruta);
			$ruta = "../" . $ruta;
			unlink("{$ruta}");
			unlink("../../uploads/posts/1080/" . $name);
			unlink("../../uploads/posts/770/" . $name);
			unlink("../../uploads/posts/440/" . $name);
			unlink("../../uploads/posts/thumbnail/" . $name);
		}
	}
	
	public function getBlogCategories($estado){
		
		$database = new Database();
		
		if(isset($estado) && $estado !== ""){
			$database->query('SELECT * FROM categoriesblog WHERE estado = :estado ORDER BY id DESC');
			$database->bind(':estado', $estado);
			$code = $database->resultset();
			if($database->rowCount() > 0){
				return $code;
			} else {
				return false;
			}
		} else {
			$database->query('SELECT * FROM categoriesblog ORDER BY id DESC');
			$code = $database->resultset();
			if($database->rowCount() > 0){
				return $code;
			} else {
				return false;
			}
		}
    }
	
	public function resizeImage($target, $name, $size){
		
		if($size == 70){
			$targetFile = "../../uploads/posts/thumbnail/" . $name;
		} else {
			$targetFile = "../../uploads/posts/" . $size . "/" . $name;
		}
		
		copy($target, $targetFile);
		
		list($width, $height) = getimagesize($targetFile);
		$ratio = $width / $height;
		if( $ratio > 1) {
			$resized_width = $size; //suppose 500 is max width or height
			$resized_height = $size/$ratio;
		}
		else {
			$resized_width = $size*$ratio;
			$resized_height = $size;
		}

		$imageFileType = pathinfo($targetFile,PATHINFO_EXTENSION);
		
			if ($imageFileType == 'png') {
				$image = imagecreatefrompng($targetFile);
			} else if ($imageFileType == 'gif') {
				$image = imagecreatefromgif($targetFile);
			} else {
				$image = imagecreatefromjpeg($targetFile);
			}

		$resized_image = imagecreatetruecolor($resized_width, $resized_height);
		imagecopyresampled($resized_image, $image, 0, 0, 0, 0, $resized_width, $resized_height, $width, $height);
		imagejpeg($resized_image, $targetFile, 100);
	}
}
	
?>