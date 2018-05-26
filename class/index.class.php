<?php
class Index{
	
    private $index;
	
	public function getIndex(){
        return $this->index;
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
	
	public function indexFooter($data) {
        print $this->renderData(indexFooter, "", $data);
    }
	
	public function indexMenu($menu_index, $data) {
        print $this->renderData(indexMenu, $menu_index, $data);
    }
	
	public function indexMiddle() {
        print $this->render(indexMiddle);
    }
	
	public function indexHead($data) {
        print $this->renderData(indexHead, "", $data);
    }

	
	public function getOptions(){
		$database = new Database();
		
		$database->query('SELECT * FROM parameters');
		$code = $database->resultset();
		return $code;
    }
	
	public function getMenus($father){
		$database = new Database();
		
		$database->query('SELECT * FROM menu WHERE father = :father ORDER BY position');
		$database->bind(':father', $father);
		$code = $database->resultset();
		return $code;
    }
	
	
	public function getGalerias(){
		$database = new Database();
		
		$database->query('SELECT * FROM galleries WHERE estado = 1 ORDER BY id DESC LIMIT 12');
		$code = $database->resultset();
		return $code;
    }
	
	public function getGaleriasMore(){
		$database = new Database();
		
		$database->query('SELECT * FROM galleries WHERE estado = 1 ORDER BY id DESC LIMIT 14,26');
		$code = $database->resultset();
		return $code;
    }
	
	public function getGaleriasIndex(){
		$database = new Database();
		
		$database->query('SELECT COUNT(g.id) as cantidad, c.nombre,c.friendly_url, g.categoria FROM galleries g
LEFT JOIN categories c ON g.categoria = c.id GROUP BY categoria ORDER BY cantidad LIMIT 3');
		$code = $database->resultset();
		return $code;
    }
	
	public function getCategoriasIndex(){
		$database = new Database();
		
		$database->query('SELECT nombre FROM categories WHERE estado = 1 ORDER BY id');
		$code = $database->resultset();
		return $code;
    }

    public function getCategoriasFooterIndex(){
        $database = new Database();

        $database->query('SELECT nombre, friendly_url FROM categories WHERE estado = 1 ORDER BY id LIMIT 9');
        $code = $database->resultset();
        return $code;
    }
	
	public function getCategorieName($id){
		$database = new Database();
		
		$database->query('SELECT nombre FROM categories WHERE id = :id');
		$database->bind(':id', $id);
		$code = $database->resultset();
		return $code;
    }
	
	public function getCategoryImage($id){
		$database = new Database();
		
		$database->query('SELECT * FROM categoryimages WHERE category = :category ORDER BY id LIMIT 1');
		$database->bind(':category', $id);
		$code = $database->resultset();
		return $code;
    }
	
	public function getSliders(){
		$database = new Database();
		
		$database->query('SELECT * FROM sliders WHERE estado = 1 ORDER BY id LIMIT 10');
		$code = $database->resultset();
		return $code;
    }
	
	public function getSliderImage($slider){
		$database = new Database();
		
		$database->query('SELECT * FROM slidersimages WHERE slider = :slider ORDER BY id LIMIT 10');
		$database->bind(':slider', $slider);
		$code = $database->resultset();
		return $code;
    }
	
	public function getPosts($num){
		$database = new Database();
		
		$database->query('SELECT * FROM posts WHERE estado = 1 AND fecha_publicacion < Now()  ORDER BY fecha_publicacion DESC LIMIT :num');
		$database->bind(':num', $num);
		$code = $database->resultset();
		if($database->rowCount() > 0){
			return $code;
		} else {
			return false;
		}

    }
	
	public function getCategorieBlogName($id){
		$database = new Database();
		
		$database->query('SELECT nombre, color FROM categoriesblog WHERE id = :id');
		$database->bind(':id', $id);
		$code = $database->resultset();
		return $code;
    }
		
}
	
?>