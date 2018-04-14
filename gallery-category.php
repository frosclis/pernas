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

    $datos = $galleries->getCategory($url);

    if(empty($datos)) {
        header('Location:../error');
    }

    $absolute_url = $galleries->full_url( $_SERVER );

    if($opciones[0]['mantenimiento'] == 0 || (isset($_SESSION['user']['id']) && $_SESSION['user']['id'] !== '')){
        $menu_index = "Galerías";
        $opciones[0]['description'] = $datos[0]["description"];
        $opciones[0]['subtitulo'] = "";
        $opciones[0]['meta_title'] = $opciones[0]['nombre_web'] . " - Categoría " . $datos[0]["nombre"];
        $opciones[0]['keywords'] = $datos[0]["keywords"];
        $opciones[0]["full_url"] = $absolute_url;
        $categoriaImagen = $galleries->getCategoryImage($datos[0]["id"]);

        $opciones[0]["principal"] = "/uploads/categories/1080/".$categoriaImagen[0]['file_name'];

        $opciones = array_merge($opciones, $datos);
        $comon->comonHead($opciones);
        $comon->comonMenu($menu_index, $opciones);
        $galleries->galleryCategoryMiddle($opciones);
        $comon->comonFooter($opciones);
    }else{
        header('Location: maintenance.php');
    }
?>