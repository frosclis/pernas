<?php
	require_once 'class/user.php';
    require_once 'class/blog.class.php';
    require_once 'class/comon.class.php';
	require_once 'class/databass.class.php';
	require_once '../config-front.php';

	if(isset($_GET["pag"]) && $_GET["pag"] != "") {
		$pag = $_GET["pag"];
	} else {
		$pag = 1;
	}

	$blog = new BlogFront();

	$comon = new Comon();

	$opciones = $comon->getOptions();

	$datos = $blog->getPosts($pag);


	$menu_index = "Blog";
	$opciones[0]['description'] = "¡Bienvenidos a mi blog! Desde este pequeño espacio os haré llegar las últimas novedades de la web, nuevos proyectos y experiencias.";
    $opciones[0]['meta_title'] = $opciones[0]['nombre_web'] . " - Blog";
    $opciones[0]['keywords'] = "Alba Pernas, Fotografía, Fotografía Lugo, Fotografía Galicia, Blog";
    $opciones[0]['pagina'] = $pag;
    $opciones = array_merge($opciones, $datos);


	if($opciones[0]['mantenimiento'] == 0 || (isset($_SESSION['user']['id']) && $_SESSION['user']['id'] !== '')){
	  	$blog->blogHead($opciones);
		$blog->blogMenu($menu_index, $opciones);
		$blog->blogMiddle($opciones);
        $blog->blogMiddleside($opciones);
		$comon->comonFooter($opciones);
	}else{
		header('Location: maintenance.php');
	}
?>
