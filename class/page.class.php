<?php
class Page{

    private $page;

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

    /**
     * Templates del Dashboad
     * @return void*/


    public function pageMiddle($data) {
        print $this->renderData(pageMiddle, "", $data);
    }


    public function getPageData($url){
        $database = new Database();

        if((isset($_SESSION['user']['id']) && $_SESSION['user']['id'] !== '')) {
            $database->query('SELECT * FROM pages WHERE friendly_url = :url LIMIT 1');
        } else {
            $database->query('SELECT * FROM pages WHERE friendly_url = :url AND estado = 1 LIMIT 1');
        }

        $database->bind(':url', $url);
        $code = $database->resultset();
        return $code;
    }

}

?>