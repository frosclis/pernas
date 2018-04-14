<?php
class GalleriesFront{

    private $galleriesFront;

    public function getGalleriesFront(){
        return $this->galleriesFront;
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


    public function galleriesHead($data) {
        print $this->renderData(galleriesHead, "", $data);
    }

    public function galleriesMiddle($data) {
        print $this->renderData(galleriesMiddle, "", $data);
    }

    public function galleriesMenu($menu_index, $data) {
        print $this->renderData(galleriesMenu, $menu_index, $data);
    }

    public function galleryMiddle($data) {
        print $this->renderData(galleryMiddle, "", $data);
    }

    public function galleryCategoryMiddle($data) {
        print $this->renderData(galleryCategoryMiddle, "", $data);
    }

    public function getGalleries(){
        $database = new Database();

        $database->query('SELECT * FROM galleries WHERE estado = 1 ORDER BY id DESC');
        $code = $database->resultset();
        if($database->rowCount() > 0){
            return $code;
        } else {
            return false;
        }

    }

    public function getCategory($url){
        $database = new Database();

        if((isset($_SESSION['user']['id']) && $_SESSION['user']['id'] !== '')) {
            $database->query('SELECT * FROM categories WHERE friendly_url = :url LIMIT 1');
        } else {
            $database->query('SELECT * FROM categories WHERE friendly_url = :url AND estado = 1 LIMIT 1');
        }

        $database->bind(':url', $url);
        $code = $database->resultset();
        return $code;
    }

    public function getGalleriesCategory($id){
        $database = new Database();

        $database->query('SELECT * FROM galleries WHERE categoria = :id AND estado = 1');

        $database->bind(':id', $id);
        $code = $database->resultset();
        return $code;
    }


    public function getSingleGallery($url){

        $database = new Database();

        if((isset($_SESSION['user']['id']) && $_SESSION['user']['id'] !== '')) {
            $database->query('SELECT * FROM galleries WHERE friendly_url = :url LIMIT 1');
        } else {
            $database->query('SELECT * FROM galleries WHERE friendly_url = :url AND estado = 1 LIMIT 1');
        }

        $database->bind(':url', $url);
        $code = $database->single();

        return $code;

    }

    public function getImagesGallery($galleryID){

        $database = new Database();

        $database->query("SELECT * FROM galleriesimages WHERE gallery = :gallery");
        $database->bind(':gallery', $galleryID);

        $resultado = $database->resultset();

        echo json_encode($resultado);
    }

    public function getCategoryImage($id){
        $database = new Database();

        $database->query('SELECT * FROM categoryimages WHERE category = :category ORDER BY id LIMIT 1');
        $database->bind(':category', $id);
        $code = $database->resultset();
        return $code;
    }

    public function getCategories(){

        $database = new Database();

        $database->query('SELECT * FROM categories WHERE estado = 1 ORDER BY id DESC');
        $code = $database->resultset();
        if($database->rowCount() > 0){
            return $code;
        } else {
            return false;
        }

    }


    function url_origin( $s, $use_forwarded_host = false )
    {
        $ssl      = ( ! empty( $s['HTTPS'] ) && $s['HTTPS'] == 'on' );
        $sp       = strtolower( $s['SERVER_PROTOCOL'] );
        $protocol = substr( $sp, 0, strpos( $sp, '/' ) ) . ( ( $ssl ) ? 's' : '' );
        $port     = $s['SERVER_PORT'];
        $port     = ( ( ! $ssl && $port=='80' ) || ( $ssl && $port=='443' ) ) ? '' : ':'.$port;
        $host     = ( $use_forwarded_host && isset( $s['HTTP_X_FORWARDED_HOST'] ) ) ? $s['HTTP_X_FORWARDED_HOST'] : ( isset( $s['HTTP_HOST'] ) ? $s['HTTP_HOST'] : null );
        $host     = isset( $host ) ? $host : $s['SERVER_NAME'] . $port;
        return $protocol . '://' . $host;
    }

    function full_url( $s, $use_forwarded_host = false )
    {
        return $this->url_origin( $s, $use_forwarded_host ) . $s['REQUEST_URI'];
    }


}

?>