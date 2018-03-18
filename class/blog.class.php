<?php
class BlogFront{

    private $blogFront;

    public function getBlogFront(){
        return $this->blogFront;
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


    public function blogHead($data) {
        print $this->renderData(blogHead, "", $data);
    }

    public function blogMiddle($data) {
        print $this->renderData(blogMiddle, "", $data);
    }

    public function blogMiddleSide($data) {
        print $this->renderData(blogMiddleSide, "", $data);
    }

    public function blogMenu($menu_index, $data) {
        print $this->renderData(blogMenu, $menu_index, $data);
    }


    public function getPosts($pag){

        if($pag == 1) {
            $inicio = 0;
            $final = 6;
        } else {
            $inicio = (($pag-1)*6);
            $final = $inicio + 6;
        }
        $database = new Database();

        $database->query('SELECT * FROM posts WHERE estado = 1 AND fecha_publicacion <= NOW() ORDER BY cast(fecha_publicacion as datetime) DESC LIMIT :inicio, :final');
        $database->bind(':inicio', $inicio);
        $database->bind(':final', $final);
        $code = $database->resultset();
        if($database->rowCount() > 0){
            return $code;
        } else {
            return $array = [false];
        }
    }

    public function getMaxPags(){

        $database = new Database();

        $database->query('SELECT COUNT(id) as total FROM posts WHERE estado = 1 AND fecha_publicacion <= NOW() ORDER BY fecha_publicacion');
        return $code = $database->resultset();
    }

    public function getSingleBlogCategory($id){
        $database = new Database();

        if(isset($id) && $id !== ""){
            $database->query('SELECT * FROM categoriesblog WHERE id = :id ORDER BY id DESC');
            $database->bind(':id', $id);
            $code = $database->single();
            if($database->rowCount() > 0){
                return $code;
            } else {
                return false;
            }
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

    public function getNumberPosts($id) {

        $database = new Database();

        $database->query('SELECT count(*) as cantidad FROM posts WHERE estado = 1 and categoria = :categoria');
        $database->bind(':categoria', $id);
        $code = $database->resultset();
        return $code;
    }

}

?>