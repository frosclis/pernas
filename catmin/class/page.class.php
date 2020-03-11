<?php
class Page{
	
    private $page;
	
	private $msg;
	
	public function getPage(){
        return $this->page;
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
	
	public function pagesMiddle($data) {
        print $this->renderData(pagesMiddle, "", $data);
    }
	
	public function pagesFooter() {
        print $this->render(pagesFooter);
    }
	
	public function pageEdit($data){
		print $this->renderData(pageEdit, "", $data);
	}
	
	public function pageeditFooter() {
        print $this->render(pageeditFooter);
    }
	
	public function pageeditHead() {
        print $this->render(pageeditHead);
    }
	
	/**
	* Obtener el listado de p�ginas
	* @return void*/
	
	public function getPages($estado){
		$database = new Database();
		
		if(isset($estado) && $estado !== ""){
			$database->query('SELECT * FROM pages WHERE estado = :estado ORDER BY id DESC');
			$database->bind(':estado', $estado);
			$code = $database->resultset();
			if($database->rowCount() > 0){
				return $code;
			} else {
				return false;
			}
		} else {
			$database->query('SELECT * FROM pages ORDER BY id DESC');
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
		
		$databasecheck->query('SELECT friendly_url FROM pages WHERE (friendly_url = :friendly_url AND id NOT IN ( :pagina_id ))');	
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
		

		$databasecheck->query('SELECT friendly_url FROM pages WHERE friendly_url = :friendly_url');
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
	
	public function getSinglePage($id){
		$database = new Database();
		
		if(isset($id) && $id !== ""){
			$database->query('SELECT * FROM pages WHERE id = :id ORDER BY id DESC');
			$database->bind(':id', $id);
			$code = $database->single();
			if($database->rowCount() > 0){
				return $code;
			} else {
				return false;
			}
		} 
    }
	
	public function updatePage($pagina_id, $friendly_url, $meta_description, $keywords, $subtitulo, $contenido, $estado, $titulo, $principal){
		$database = new Database();
		
		$friendly_original = $friendly_url;
		$contador = 1;
			
		while ($this->checkFriendly($friendly_url, $pagina_id) == false){
			$friendly_url = $friendly_original . "-" .$contador;
			$contador++;
		}
		

		$database->query('UPDATE pages SET friendly_url = :friendly_url, meta_description = :meta_description, keywords = :keywords, subtitulo = :subtitulo, contenido = :contenido, estado = :estado, titulo = :titulo, principal = :principal, ultima_edicion = NOW() WHERE id = :pagina_id');
		$database->bind(':friendly_url', $friendly_url);
		$database->bind(':meta_description', $meta_description);
		$database->bind(':keywords', $keywords);
        $database->bind(':subtitulo', $subtitulo);
		$database->bind(':estado', $estado);
		$database->bind(':pagina_id', $pagina_id);
		$database->bind(':contenido', $contenido);
		$database->bind(':titulo', $titulo);
		$database->bind(':principal', $principal);
		
		if($database->execute()){
			return true;
		} else {
			$this->msg = 'Ha ocurrido un problema con tu actualizaci�n. Int�ntalo m�s tarde.';
			return false;
		}
    }
	
	public function delPage($id){
		$database = new Database();
		
		if(isset($id) && $id !== ""){
			
			$database->query('DELETE FROM pages WHERE id = :id');
			$database->bind(':id', $id);
			
			if($database->execute()){
				return true;
			} else {
				$this->msg = 'Ha ocurrido un error durante el borrado de la p�gina. Int�ntalo m�s tarde.';
				return false;
			}
		} else {
			$this->msg = 'Ha ocurrido un error durante el borrado de la p�gina. Int�ntalo m�s tarde.';
			return false;
		}
	}
	
	public function newPage($nombre, $autor){
		$database = new Database();
		
		if(isset($nombre) && $nombre !== ""){
			$friendly_url = $this->friendlyURL($nombre);
			
			$friendly_original = $friendly_url;
			$contador = 1;
			while ($this->checkFriendlyNew($friendly_url) == false){
				$friendly_url = $friendly_original . "-" .$contador;
				$contador++; 
			}
			
			$database->query('INSERT INTO pages (id, titulo, friendly_url, estado, autor, meta_description, keywords, subtitulo, contenido, ultima_edicion) VALUES (:id, :titulo, :friendly_url, :estado, :autor, :meta_description, :keywords, :subtitulo, :contenido, NOW())');
			$database->bind(':id', NULL);
			$database->bind(':meta_description', "");
			$database->bind(':keywords', "");
			$database->bind(':subtitulo', "");
			$database->bind(':contenido', "");
			$database->bind(':titulo', $nombre);
			$database->bind(':friendly_url', $friendly_url);
			$database->bind(':estado', 0);
			$database->bind(':autor', $autor);
			
			if($database->execute()){
				$this->msg = $database->lastInsertId();
				return true;
			} else {
				$this->msg = 'Ha ocurrido un error creando tu nueva p�gina. Int�ntalo m�s tarde.';
				return false;
			}
		}
		$this->msg = 'Ha ocurrido un error creando tu nueva p�gina. Int�ntalo m�s tarde.';
		return false;
	}
	
	
	public function uploadImages($pageID, $nuevo){
		
		$database = new Database();
		
		if(isset($pageID) && $pageID !== "" && isset($nuevo) && $nuevo !== ""){
			$database->query("INSERT INTO pagesimages (file_name, uploaded, page) VALUES(:file_name, NOW(), :page)");
			$database->bind(':file_name', $nuevo);
			$database->bind(':page', $pageID);
			
			if($database->execute()){
				return true;
			} else {
				$this->msg = 'Ha ocurrido un error registrando las im�genes. Int�ntalo m�s tarde.';
				return false;
			}
		} else {
			$this->msg = 'Ha ocurrido un error registrando las im�genes. Int�ntalo m�s tarde.';
			return false;
		}
	}
	
	public function getImages($pageID){
		
		$database = new Database();
		
		$database->query("SELECT * FROM pagesimages WHERE page = :page ORDER BY position");
		$database->bind(':page', $pageID);
		
		$resultado = $database->resultset();
		
		return $resultado;
	}
	
	public function deleteImage($imageID, $ruta){
		$database = new Database();
		
		$database->query("DELETE FROM pagesimages WHERE id = :id");
		$database->bind(':id', $imageID);
		
		if($database->execute()){
			$name = basename($ruta);
			$ruta = "../" . $ruta;
			unlink("{$ruta}");
			unlink("../../uploads/pages/1080/" . $name);
			unlink("../../uploads/pages/770/" . $name);
			unlink("../../uploads/pages/440/" . $name);
			unlink("../../uploads/pages/thumbnail/" . $name);
		}
	}
	
	public function resizeImage($target, $name, $size){
		
		if($size == 70){
			$targetFile = "../../uploads/pages/thumbnail/" . $name;
		} else {
			$targetFile = "../../uploads/pages/" . $size . "/" . $name;
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