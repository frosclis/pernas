<?php
class Comon{

    private $comon;

    public function getComon(){
        return $this->comon;
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

    public function comonFooter($data) {
        print $this->renderData(comonFooter, "", $data);
    }

    public function comonMenu($menu_index, $data) {
        print $this->renderData(comonMenu, $menu_index, $data);
    }

    public function comonHead($data) {
        print $this->renderData(comonHead, "", $data);
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

}

?>