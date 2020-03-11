<?php
class Gallery{
	
    private $gallery;
	
	private $msg;
	
	public function getGallery(){
        return $this->gallery;
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
	
	public function galleriesMiddle($data) {
        print $this->renderData(galleriesMiddle, "", $data);
    }
	
	public function galleriesFooter() {
        print $this->render(galleriesFooter);
    }
	
	public function galleryEdit($data){
		print $this->renderData(galleryEdit, "", $data);
	}
	
	public function galleryeditFooter() {
        print $this->render(galleryeditFooter);
    }
	
	public function galleryeditHead() {
        print $this->render(pageeditHead);
    }
	
	/**
	* Obtener el listado de páginas
	* @return void*/
	
	public function getGalleries($estado){
		$database = new Database();
		
		if(isset($estado) && $estado !== ""){
			$database->query('SELECT * FROM galleries WHERE estado = :estado ORDER BY id DESC');
			$database->bind(':estado', $estado);
			$code = $database->resultset();
			if($database->rowCount() > 0){
				return $code;
			} else {
				return false;
			}
		} else {
			$database->query('SELECT * FROM galleries ORDER BY id DESC');
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
	
	public function checkFriendly($friendly_url, $gallery_id){
		$databasecheck = new Database();
		
		$databasecheck->query('SELECT friendly_url FROM galleries WHERE (friendly_url = :friendly_url AND id NOT IN ( :gallery_id ))');	
		$databasecheck->bind(':gallery_id', $gallery_id);
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
		

		$databasecheck->query('SELECT friendly_url FROM galleries WHERE friendly_url = :friendly_url');
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
	
	public function getSingleGallery($id){
		$database = new Database();
		
		if(isset($id) && $id !== ""){
			$database->query('SELECT * FROM galleries WHERE id = :id ORDER BY id DESC');
			$database->bind(':id', $id);
			$code = $database->single();
			if($database->rowCount() > 0){
				return $code;
			} else {
				return false;
			}
		} 
    }
	
	public function updateGallery($gallery_id, $friendly_url, $meta_description, $keywords, $subtitulo, $principal, $estado, $titulo, $categoria){
		$database = new Database();
		
		$friendly_original = $friendly_url;
		$contador = 1;
			
		while ($this->checkFriendly($friendly_url, $gallery_id) == false){
			$friendly_url = $friendly_original . "-" .$contador;
			$contador++;
		}
		

		$database->query('UPDATE galleries SET friendly_url = :friendly_url, meta_description = :meta_description, keywords = :keywords, subtitulo = :subtitulo, principal = :principal, estado = :estado, titulo = :titulo, categoria = :categoria, ultima_edicion = NOW() WHERE id = :gallery_id');
		$database->bind(':friendly_url', $friendly_url);
		$database->bind(':meta_description', $meta_description);
		$database->bind(':keywords', $keywords);
		$database->bind(':subtitulo', $subtitulo);
		$database->bind(':estado', $estado);
		$database->bind(':gallery_id', $gallery_id);
		$database->bind(':principal', $principal);
		$database->bind(':titulo', $titulo);
		$database->bind(':categoria', $categoria);
		
		if($database->execute()){
			return true;
		} else {
			$this->msg = 'Ha ocurrido un problema con tu actualización. inténtalo más tarde.';
			return false;
		}
    }
	
	public function delGallery($id){
		$database = new Database();
		
		if(isset($id) && $id !== ""){
			
			$database->query('DELETE FROM galleries WHERE id = :id');
			$database->bind(':id', $id);
			
			if($database->execute()){
				return true;
			} else {
				$this->msg = 'Ha ocurrido un error durante el borrado de la página. inténtalo más tarde.';
				return false;
			}
		} else {
			$this->msg = 'Ha ocurrido un error durante el borrado de la página. inténtalo más tarde.';
			return false;
		}
	}
	
	public function newGallery($nombre, $autor){
		$database = new Database();
		
		if(isset($nombre) && $nombre !== ""){
			$friendly_url = $this->friendlyURL($nombre);
			
			$friendly_original = $friendly_url;
			$contador = 1;
			while ($this->checkFriendlyNew($friendly_url) == false){
				$friendly_url = $friendly_original . "-" .$contador;
				$contador++; 
			}
			
			$database->query('INSERT INTO galleries (id, titulo, friendly_url, estado, autor, meta_description, keywords, subtitulo, principal, categoria, ultima_edicion) VALUES (:id, :titulo, :friendly_url, :estado, :autor, :meta_description, :keywords, :subtitulo, :principal, :categoria, NOW())');
			$database->bind(':id', NULL);
			$database->bind(':meta_description', "");
			$database->bind(':keywords', "");
			$database->bind(':subtitulo', "");
			$database->bind(':principal', "");
			$database->bind(':titulo', $nombre);
			$database->bind(':friendly_url', $friendly_url);
			$database->bind(':estado', 0);
			$database->bind(':autor', $autor);
			$database->bind(':categoria', "");
			
			if($database->execute()){
				$this->msg = $database->lastInsertId();
				return true;
			} else {
				$this->msg = 'Ha ocurrido un error creando tu nueva página. inténtalo más tarde.';
				return false;
			}
		}
		$this->msg = 'Ha ocurrido un error creando tu nueva página. inténtalo más tarde.';
		return false;
	}
	
	
	public function uploadImagesGalleries($galleryID, $nuevo){
		
		$database = new Database();
		
		if(isset($galleryID) && $galleryID !== "" && isset($nuevo) && $nuevo !== ""){
			$database->query("INSERT INTO galleriesimages (file_name, uploaded, gallery) VALUES(:file_name, NOW(), :gallery)");
			$database->bind(':file_name', $nuevo);
			$database->bind(':gallery', $galleryID);
			
			if($database->execute()){
				return true;
			} else {
				$this->msg = 'Ha ocurrido un error registrando las imágenes. inténtalo más tarde.';
				return false;
			}
		} else {
			$this->msg = 'Ha ocurrido un error registrando las imágenes. inténtalo más tarde.';
			return false;
		}
	}
	
	public function getImagesGallery($galleryID){
		
		$database = new Database();
		
		$database->query("SELECT * FROM galleriesimages WHERE gallery = :gallery ORDER BY position");
		$database->bind(':gallery', $galleryID);
		
		$resultado = $database->resultset();
		
		return $resultado;
	}
	
	public function deleteImageGallery($imageID, $ruta){
		$database = new Database();
		
		$database->query("DELETE FROM galleriesimages WHERE id = :id");
		$database->bind(':id', $imageID);
		
		if($database->execute()){
			$name = basename($ruta);
			$ruta = "../" . $ruta;
			unlink("{$ruta}");
			unlink("../../uploads/galleries/1080/" . $name);
			unlink("../../uploads/galleries/560/" . $name);
			unlink("../../uploads/galleries/280/" . $name);
			unlink("../../uploads/galleries/thumbnail/" . $name);
		}
	}
	
	public function getCategories($estado){
		
		$database = new Database();
		
		if(isset($estado) && $estado !== ""){
			$database->query('SELECT * FROM categories WHERE estado = :estado ORDER BY id DESC');
			$database->bind(':estado', $estado);
			$code = $database->resultset();
			if($database->rowCount() > 0){
				return $code;
			} else {
				return false;
			}
		} else {
			$database->query('SELECT * FROM categories ORDER BY id DESC');
			$code = $database->resultset();
			if($database->rowCount() > 0){
				return $code;
			} else {
				return false;
			}
		}
    }
	
	public function getCategoryImage($id){
		
		$database = new Database();
		
		$database->query("SELECT file_name FROM categoryimages WHERE id = :id LIMIT 1");
		$database->bind(':id', $id);
		
		$resultado = $database->resultset();
		
		echo json_encode($resultado);
	}
	
	public function resizeImage($target, $name, $size){
		
		if($size == 70){
			$targetFile = "../../uploads/galleries/thumbnail/" . $name;
		} else {
			$targetFile = "../../uploads/galleries/" . $size . "/" . $name;
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