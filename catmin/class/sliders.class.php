<?php
class Slider{
	
    private $slider;
	
	private $msg;
	
	public function getSlider(){
        return $this->slider;
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
	
	public function slidersMiddle($data) {
        print $this->renderData(slidersMiddle, "", $data);
    }
	
	public function slidersFooter() {
        print $this->render(slidersFooter);
    }
	
	public function sliderEdit($data){
		print $this->renderData(sliderEdit, "", $data);
	}
	
	public function slidereditFooter() {
        print $this->render(slidereditFooter);
    }
	
	public function slidereditHead() {
        print $this->render(slidereditHead);
    }
	
	/**
	* Obtener el listado de páginas
	* @return void*/
	
	public function getSliders($estado){
		$database = new Database();
		
		if(isset($estado) && $estado !== ""){
			$database->query('SELECT * FROM sliders WHERE estado = :estado ORDER BY id DESC');
			$database->bind(':estado', $estado);
			$code = $database->resultset();
			if($database->rowCount() > 0){
				return $code;
			} else {
				return false;
			}
		} else {
			$database->query('SELECT * FROM sliders ORDER BY id DESC');
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
	
	
	public function getSingleSlider($id){
		$database = new Database();
		
		if(isset($id) && $id !== ""){
			$database->query('SELECT * FROM sliders WHERE id = :id ORDER BY id DESC');
			$database->bind(':id', $id);
			$code = $database->single();
			if($database->rowCount() > 0){
				return $code;
			} else {
				return false;
			}
		} 
    }
	
	public function updateSlider($slider_id, $subtitulo, $contenido, $estado, $titulo){
		$database = new Database();
		
		$database->query('UPDATE sliders SET subtitulo = :subtitulo, contenido = :contenido, estado = :estado, titulo = :titulo, ultima_edicion = NOW() WHERE id = :slider_id');
		$database->bind(':subtitulo', $subtitulo);
		$database->bind(':estado', $estado);
		$database->bind(':slider_id', $slider_id);
		$database->bind(':contenido', $contenido);
		$database->bind(':titulo', $titulo);
		
		if($database->execute()){
			return true;
		} else {
			$this->msg = 'Ha ocurrido un problema con tu actualización. Inténtalo más tarde.';
			return false;
		}
    }
	
	public function delSlider($id){
		$database = new Database();
		
		if(isset($id) && $id !== ""){
			
			$database->query('DELETE FROM sliders WHERE id = :id');
			$database->bind(':id', $id);
			
			if($database->execute()){
				return true;
			} else {
				$this->msg = 'Ha ocurrido un error durante el borrado dela slider. Inténtalo más tarde.';
				return false;
			}
		} else {
			$this->msg = 'Ha ocurrido un error durante el borrado del slider. Inténtalo más tarde.';
			return false;
		}
	}
	
	public function newslider($nombre, $autor){
		$database = new Database();
		
		if(isset($nombre) && $nombre !== ""){
						
			$database->query('INSERT INTO sliders (id, titulo, estado, autor, subtitulo, contenido, ultima_edicion) VALUES (:id, :titulo, :estado, :autor, :subtitulo, :contenido, NOW())');
			$database->bind(':id', NULL);
			$database->bind(':subtitulo', "");
			$database->bind(':contenido', "");
			$database->bind(':titulo', $nombre);
			$database->bind(':estado', 0);
			$database->bind(':autor', $autor);
			
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
	
	
	public function uploadImages($sliderID, $nuevo){
		
		$database = new Database();
		
		if(isset($sliderID) && $sliderID !== "" && isset($nuevo) && $nuevo !== ""){
			$database->query("INSERT INTO slidersimages (file_name, uploaded, slider) VALUES(:file_name, NOW(), :slider)");
			$database->bind(':file_name', $nuevo);
			$database->bind(':slider', $sliderID);
			
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
	
	public function getImages($sliderID){
		
		$database = new Database();
		
		$database->query("SELECT * FROM slidersimages WHERE slider = :slider");
		$database->bind(':slider', $sliderID);
		
		$resultado = $database->resultset();
		
		echo json_encode($resultado);
	}
	
	public function deleteImage($imageID, $ruta){
		$database = new Database();
		
		$database->query("DELETE FROM slidersimages WHERE id = :id");
		$database->bind(':id', $imageID);
		
		if($database->execute()){
			$ruta = "../" . $ruta;
			unlink("{$ruta}");
		}
	}
}
	
?>