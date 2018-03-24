<?php
	require_once 'class/user.php';
    require_once 'class/blog.class.php';
    require_once 'class/comon.class.php';
	require_once 'class/databass.class.php';
	require_once '../config-front.php';

	$url = $_GET["url"];

	$blog = new BlogFront();

	$comon = new Comon();

	$opciones = $comon->getOptions();

	$datos = $blog->getSinglePost($url);

	if(empty($datos)) {
		header('Location:../error');
	}

	$absolute_url = $blog->full_url( $_SERVER );

	$menu_index = "Blog";
	$opciones[0]['description'] = $datos["meta_description"];
    $opciones[0]['meta_title'] = $opciones[0]['nombre_web'] . " - " . $datos["titulo"];
    $opciones[0]['keywords'] = $datos["keywords"];
    $datosCategoria = $blog->getSingleBlogCategory($datos["categoria"]);
    $opciones[0]["full_url"] = $absolute_url;
    $opciones = array_merge($opciones, $datos);
	$opciones = array_merge($opciones, $datosCategoria);

	if($opciones[0]['mantenimiento'] == 0 || (isset($_SESSION['user']['id']) && $_SESSION['user']['id'] !== '')){
	  	$blog->blogHead($opciones);
		$blog->blogMenu($menu_index, $opciones);
		$blog->postMiddle($opciones);
        $blog->blogMiddleside($opciones);
		$comon->comonFooter($opciones);
	}else{
		header('Location: maintenance.php');
	}
?>
