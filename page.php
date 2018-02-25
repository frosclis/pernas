<?php
	require_once 'class/user.php';
    require_once 'class/page.class.php';
    require_once 'class/comon.class.php';
	require_once 'class/databass.class.php';
	require_once '../config-front.php';

	$url = $_GET["url"];

	$page = new Page();

	$comon = new Comon();

	$opciones = $comon->getOptions();

	$datos = $page->getPageData($url);

	if(!$datos) {
        header('Location: 404.php');
    }

	$menu_index = $datos[0]["titulo"];
	$opciones[0]['description'] = $datos[0]["meta_description"];
    $opciones[0]['meta_title'] = $opciones[0]['nombre_web'] . " - " . $datos[0]["titulo"];
    $opciones[0]['subtitulo'] = $datos[0]["subtitulo"];
    $opciones[0]['principal'] = $datos[0]["principal"];
    $opciones[0]['keywords'] = $datos[0]["keywords"];
    $opciones[0]['contenido'] = $datos[0]["contenido"];

	if($opciones[0]['mantenimiento'] == 0 || (isset($_SESSION['user']['id']) && $_SESSION['user']['id'] !== '')){
	  	$comon->comonHead($opciones);
		$comon->comonMenu($menu_index, $opciones);
		$page->pageMiddle($opciones);
		$comon->comonFooter($opciones);
	}else{
		header('Location: maintenance.php');
	}
?>
