<?php
class Contact{

    private $contact;

    public function getContact(){
        return $this->contact;
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


    public function contactMiddle($data) {
        print $this->renderData(contactMiddle, "", $data);
    }

    public function contactHead($data) {
        print $this->renderData(contactHead, "", $data);
    }

    public function contactMenu($menu_index, $data) {
        print $this->renderData(contactMenu, $menu_index, $data);
    }

}

?>