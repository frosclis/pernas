<?php
    require_once 'class/user.php';
    require_once 'class/galleries.class.php';
    require_once 'class/comon.class.php';
    require_once 'class/databass.class.php';
    require_once '../config-front.php';

    $galleries = new GalleriesFront();

    $comon = new Comon();

    $opciones = $comon->getOptions();

    if($opciones[0]['mantenimiento'] == 0 || (isset($_SESSION['user']['id']) && $_SESSION['user']['id'] !== '')){
        $datos = $galleries->getCategories();
        $opciones[0]['description'] = "Desde esta sección puedes acceder a las diferentes galerías, ¡espero que os gusten!";
        $opciones[0]['meta_title'] = $opciones[0]['nombre_web'] . " - Galería";
        $opciones[0]['keywords'] = "Alba Pernas, Fotografía, Fotografía Lugo, Fotografía Galicia, Galerías, Bodas, Prebodas";

        $menu_index = "Galerías";
        $opciones = array_merge($opciones, $datos);
        $galleries->galleriesHead($opciones);
        $galleries->galleriesMenu($menu_index, $opciones);
        $galleries->galleriesMiddle($opciones);
        $comon->comonFooter($opciones);
    }else{
        header('Location: maintenance.php');
    }
?>