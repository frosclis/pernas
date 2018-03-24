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

    public function postMiddle($data) {
        print $this->renderData(postMiddle, "", $data);
    }

    public function searchMiddle($data) {
        print $this->renderData(searchMiddle, "", $data);
    }


    public function getPosts($pag, $categoria){

        if($pag == 1) {
            $inicio = 0;
            $final = 6;
        } else {
            $inicio = (($pag-1)*6);
            $final = $inicio + 6;
        }
        $database = new Database();

        if($categoria == 0) {
            $database->query('SELECT * FROM posts WHERE estado = 1 AND fecha_publicacion <= NOW() ORDER BY cast(fecha_publicacion as datetime) DESC LIMIT :inicio, :final');
        } else {
            $database->query('SELECT * FROM posts WHERE estado = 1 AND categoria = :categoria AND fecha_publicacion <= NOW() ORDER BY cast(fecha_publicacion as datetime) DESC LIMIT :inicio, :final');
            $database->bind(':categoria', $categoria);
        }

        $database->bind(':inicio', $inicio);
        $database->bind(':final', $final);
        $code = $database->resultset();
        if($database->rowCount() > 0){
            return $code;
        } else {
            return $array = [false];
        }
    }

    public function getMaxPags($categoria){

        $database = new Database();

        if($categoria == 0) {
            $database->query('SELECT COUNT(id) as total FROM posts WHERE estado = 1 AND fecha_publicacion <= NOW() ORDER BY fecha_publicacion');
        } else {
            $database->query('SELECT COUNT(id) as total FROM posts WHERE estado = 1 AND categoria = :categoria AND fecha_publicacion <= NOW() ORDER BY fecha_publicacion');
            $database->bind(':categoria', $categoria);
        }

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

    public function getSinglePost($url){
        $database = new Database();

        if((isset($_SESSION['user']['id']) && $_SESSION['user']['id'] !== '')) {
            $database->query('SELECT * FROM posts WHERE friendly_url = :url');
        } else {
            $database->query('SELECT * FROM posts WHERE friendly_url = :url AND estado = 1');
        }


        $database->bind(':url', $url);
        $code = $database->single();
        if($database->rowCount() > 0){
            return $code;
        } else {
            return false;
        }

    }

    public function getCategoryByURL($url){

        $database = new Database();

        $database->query('SELECT * FROM categoriesblog WHERE friendly_url = :url LIMIT 1');
        $database->bind(':url', $url);
        $code = $database->single();

        return $code;

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


    public function getPostsSearch($busqueda){

        $database = new Database();


        $database->query('SELECT "pagina" as tipo, friendly_url, titulo, contenido, principal as portada FROM pages WHERE titulo LIKE :busqueda OR contenido LIKE :busqueda AND estado = 1 UNION SELECT "post" as tipo, friendly_url, titulo, contenido, portada FROM posts WHERE titulo LIKE :busqueda OR contenido LIKE :busqueda AND estado = 1');

        $database->bind(':busqueda', "%".$busqueda."%");
        $code = $database->resultset();
        if($database->rowCount() > 0){
            return $code;
        } else {
            return $array = [false];
        }
    }

}

?>