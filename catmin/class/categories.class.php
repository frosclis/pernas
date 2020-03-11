<?php
class Category{
	
    private $category;
	
	private $msg;
	
	public function getCategory(){
        return $this->category;
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
	
	public function categoriesMiddle($data) {
        print $this->renderData(categoriesMiddle, "", $data);
    }
	
	public function categoriesFooter() {
        print $this->render(categoriesFooter);
    }
	
	public function categoryEdit($data){
		print $this->renderData(categoryEdit, "", $data);
	}
	
	public function categoryeditFooter(){
		print $this->render(categoryeditFooter);
	}
	
	public function categorieseditFooter() {
        print $this->render(categorieseditFooter);
    }
	
	public function categoryeditHead() {
        print $this->render(categoryeditHead);
    }
	
	/**
	* Obtener el listado de páginas
	* @return void*/
	
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
	
	 /**
    * Print error msg function
    * @return void.
    */
    public function printMsg(){
        print $this->msg;
    }
	
	public function delCategory($id){
		$database = new Database();
		
		if(isset($id) && $id !== ""){
			
			$database->query('DELETE FROM categories WHERE id = :id');
			$database->bind(':id', $id);
			
			if($database->execute()){
				return true;
			} else {
				$this->msg = 'Ha ocurrido un error durante el borrado de la categoría. inténtalo más tarde.';
				return false;
			}
		} else {
			$this->msg = 'Ha ocurrido un error durante el borrado de la categoría. inténtalo más tarde.';
			return false;
		}
	}
		
	public function checkFriendly($friendly_url, $categoria_id){
		$databasecheck = new Database();
		
		$databasecheck->query('SELECT friendly_url FROM categories WHERE (friendly_url = :friendly_url AND id NOT IN ( :categoria_id ))');	
		$databasecheck->bind(':categoria_id', $categoria_id);
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
		

		$databasecheck->query('SELECT friendly_url FROM categories WHERE friendly_url = :friendly_url');
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
	
	public function getSingleCategory($id){
		$database = new Database();
		
		if(isset($id) && $id !== ""){
			$database->query('SELECT * FROM categories WHERE id = :id ORDER BY id DESC');
			$database->bind(':id', $id);
			$code = $database->single();
			if($database->rowCount() > 0){
				return $code;
			} else {
				return false;
			}
		} 
    }
	
	public function updateCategory($categoria_id, $categoria_nombre, $friendly_url, $categoria_description, $keywords, $categoria_padre, $estado){
		$database = new Database();
		
		$friendly_original = $friendly_url;
		$contador = 1;
		
		while ($this->checkFriendly($friendly_url, $categoria_id) == false){
			$friendly_url = $friendly_original . "-" .$contador;
			$contador++;
		}
		

		$database->query('UPDATE categories SET friendly_url = :friendly_url, description = :categoria_description, keywords = :keywords, padre = :categoria_padre, nombre = :categoria_nombre, estado = :estado, ultima_edicion = NOW() WHERE id = :categoria_id');
		$database->bind(':friendly_url', $friendly_url);
		$database->bind(':categoria_description', $categoria_description);
		$database->bind(':keywords', $keywords);
		$database->bind(':categoria_padre', $categoria_padre);
		$database->bind(':estado', $estado);
		$database->bind(':categoria_id', $categoria_id);
		$database->bind(':categoria_nombre', $categoria_nombre);
		
		if($database->execute()){
			return true;
		} else {
			$this->msg = 'Ha ocurrido un problema con tu actualización. inténtalo más tarde.';
			return false;
		}
    }
	
	public function newCategory($nombre){
		$database = new Database();
		
		if(isset($nombre) && $nombre !== ""){
			$friendly_url = $this->friendlyURL($nombre);
			
			$friendly_original = $friendly_url;
			$contador = 1;

			 while ($this->checkFriendlyNew($friendly_url) == false){
				$friendly_url = $friendly_original . "-" .$contador;
				$contador++; 
			 }
			
			$database->query('INSERT INTO categories (id, nombre, friendly_url, estado, description, keywords, padre, ultima_edicion) VALUES (:id, :categoria_nombre, :friendly_url, :estado, :meta_description, :keywords, :categoria_padre, NOW())');
			$database->bind(':id', NULL);
			$database->bind(':meta_description', "");
			$database->bind(':keywords', "");
			$database->bind(':categoria_padre', "");
			$database->bind(':categoria_nombre', $nombre);
			$database->bind(':friendly_url', $friendly_url);
			$database->bind(':estado', 0);
			
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
	
	
	public function uploadImagesCategory($categoryID, $nuevo){
		
		$database = new Database();
		
		if(isset($categoryID) && $categoryID !== "" && isset($nuevo) && $nuevo !== ""){
			$database->query("INSERT INTO categoryimages (file_name, uploaded, category) VALUES(:file_name, NOW(), :category)");
			$database->bind(':file_name', $nuevo);
			$database->bind(':category', $categoryID);
			
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
	
	public function getImagesCategory($categoryID){
		
		$database = new Database();
		
		$database->query("SELECT * FROM categoryimages WHERE category = :category ORDER BY position");
		$database->bind(':category', $categoryID);
		
		$resultado = $database->resultset();
		
		return $resultado;
	}
	
	public function deleteImageCategory($categoryID, $ruta){
		$database = new Database();
		
		$database->query("DELETE FROM categoryimages WHERE id = :id");
		$database->bind(':id', $categoryID);
		
		if($database->execute()){
			$name = basename($ruta);
			$ruta = "../../uploads/categories/" . $ruta;
			unlink("{$ruta}");
			unlink("../../uploads/categories/1080/" . $name);
			unlink("../../uploads/categories/770/" . $name);
			unlink("../../uploads/categories/440/" . $name);
			unlink("../../uploads/categories/thumbnail/" . $name);
		}
	}
	
	public function resizeImage($target, $name, $size){
		
		if($size == 70){
			$targetFile = "../../uploads/categories/thumbnail/" . $name;
		} else {
			$targetFile = "../../uploads/categories/" . $size . "/" . $name;
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