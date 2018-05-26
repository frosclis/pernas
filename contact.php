<?php
	require_once 'class/user.php';
    require_once 'class/contact.class.php';
    require_once 'class/comon.class.php';
	require_once 'class/databass.class.php';
	require_once '../config-front.php';

	$contact = new Contact();

	$comon = new Comon();

	$opciones = $comon->getOptions();

	if(isset($_POST["busqueda"]) AND !empty($_POST["busqueda"])){
        $datos = $blog->getPostsSearch($_POST["busqueda"]);
        $opciones[0]['categoria_titulo'] = "<h1>Resultados de tu búsqueda: ".$_POST["busqueda"]."</h1>";
	} else {
        $datos[0] = false;
    }

    $opciones[0]['description'] = "Si quieres hacer una consulta o necesitas más información no dudes en ponerte en conmigo.";
    $opciones[0]['meta_title'] = $opciones[0]['nombre_web'] . " - Contacto";
    $opciones[0]['keywords'] = "Alba Pernas, Fotografía, Fotografía Lugo, Fotografía Galicia, Contacto";
    $menu_index = "Contacto";
    $opciones = array_merge($opciones, $datos);


	if($opciones[0]['mantenimiento'] == 0 || (isset($_SESSION['user']['id']) && $_SESSION['user']['id'] !== '')){
        $contact->contactHead($opciones);
        $contact->contactMenu($menu_index, $opciones);
		$contact->contactMiddle($opciones);
		$comon->comonFooter($opciones);
	}else{
		header('Location:/proximamente');
	}
?>
