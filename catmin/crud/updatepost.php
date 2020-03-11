<?php
	require_once '../class/user.php';
	require_once '../class/blog.class.php';
	require_once '../class/databass.class.php';
	require_once '../../../config.php';
	
	$blog = new Blog();

    $pagina_id = filter_input(INPUT_POST, 'pagina_id', FILTER_DEFAULT);
    $friendly_url = filter_input(INPUT_POST, 'friendly_url', FILTER_DEFAULT);
	$titulo = filter_input(INPUT_POST, 'titulo', FILTER_DEFAULT);
	$meta_description = filter_input(INPUT_POST, 'meta_description', FILTER_DEFAULT);
	$keywords = filter_input(INPUT_POST, 'keywords', FILTER_DEFAULT);
	$subtitulo = filter_input(INPUT_POST, 'subtitulo', FILTER_DEFAULT);
    $contenido = filter_input(INPUT_POST, 'contenido', FILTER_DEFAULT);
	$estado = filter_input(INPUT_POST, 'estado', FILTER_DEFAULT);
	$portada = filter_input(INPUT_POST, 'portada', FILTER_DEFAULT);
	$fecha_publicacion = filter_input(INPUT_POST, 'fecha_publicacion', FILTER_DEFAULT);
	$categoria = filter_input(INPUT_POST, 'categoria', FILTER_DEFAULT);
	
	
    if( $blog->updatePost($pagina_id, $friendly_url, $meta_description, $keywords, $subtitulo, $contenido, $estado, $titulo, $fecha_publicacion, $portada, $categoria) ) {
        die;
    } else {
        $blog->printMsg();
        die;
    }