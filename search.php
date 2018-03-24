<?php
	require_once 'class/user.php';
    require_once 'class/blog.class.php';
    require_once 'class/comon.class.php';
	require_once 'class/databass.class.php';
	require_once '../config-front.php';

	$blog = new BlogFront();

	$comon = new Comon();

	$opciones = $comon->getOptions();

	if(isset($_POST["busqueda"]) AND !empty($_POST["busqueda"])){
        $datos = $blog->getPostsSearch($_POST["busqueda"]);
        $opciones[0]['categoria_titulo'] = "<h1>Resultados de tu búsqueda: ".$_POST["busqueda"]."</h1>";
	} else {
        $datos[0] = false;
    }

    $opciones[0]['description'] = "¡Bienvenidos a mi blog! Desde este pequeño espacio os haré llegar las últimas novedades de la web, nuevos proyectos y experiencias.";
    $opciones[0]['meta_title'] = $opciones[0]['nombre_web'] . " - Blog";
    $opciones[0]['keywords'] = "Alba Pernas, Fotografía, Fotografía Lugo, Fotografía Galicia, Blog";
    $menu_index = "Blog";
    $opciones = array_merge($opciones, $datos);


	if($opciones[0]['mantenimiento'] == 0 || (isset($_SESSION['user']['id']) && $_SESSION['user']['id'] !== '')){
	  	$blog->blogHead($opciones);
		$blog->blogMenu($menu_index, $opciones);
		$blog->searchMiddle($opciones);
        $blog->blogMiddleside($opciones);
		$comon->comonFooter($opciones);
	}else{
		header('Location: maintenance.php');
	}
?>
