<?php
    require_once 'class/user.php';
    require_once 'class/galleries.class.php';
    require_once 'class/comon.class.php';
    require_once 'class/databass.class.php';
    require_once '../config-front.php';

    $url = $_GET["url"];

    $galleries = new GalleriesFront();

    $comon = new Comon();

    $opciones = $comon->getOptions();

    $datos = $galleries->getSingleGallery($url);

    if(empty($datos)) {
        header('Location:../error');
    }

    $absolute_url = $galleries->full_url( $_SERVER );

    if($opciones[0]['mantenimiento'] == 0 || (isset($_SESSION['user']['id']) && $_SESSION['user']['id'] !== '')){
        $menu_index = "Galerías";
        $opciones[0]['description'] = $datos["meta_description"];
        $opciones[0]['subtitulo'] = $datos["subtitulo"];
        $opciones[0]['meta_title'] = $opciones[0]['nombre_web'] . " - Galería " . $datos["titulo"];
        $opciones[0]['keywords'] = $datos["keywords"];
        $opciones[0]["full_url"] = $absolute_url;
        $opciones[0]["principal"] = "/uploads/galleries/1080/".$datos["principal"];

        $opciones = array_merge($opciones, $datos);
        $opciones["imagenes"] = $galleries->getImagesGallery($datos["id"]);
        $comon->comonHead($opciones);
        $comon->comonMenu($menu_index, $opciones);
        $galleries->galleryMiddle($opciones);
        $comon->comonFooter($opciones);
    }else{
        header('Location: maintenance.php');
    }
?>