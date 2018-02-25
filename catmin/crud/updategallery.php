<?php
	require_once '../class/user.php';
	require_once '../class/galleries.class.php';
	require_once '../class/databass.class.php';
	require_once '../../../config.php';
	
	$gallery = new Gallery();

    $gallery_id = filter_input(INPUT_POST, 'gallery_id', FILTER_SANITIZE_EMAIL);
    $friendly_url = filter_input(INPUT_POST, 'friendly_url', FILTER_DEFAULT);
	$titulo = filter_input(INPUT_POST, 'titulo', FILTER_DEFAULT);
	$meta_description = filter_input(INPUT_POST, 'meta_description', FILTER_DEFAULT);
	$keywords = filter_input(INPUT_POST, 'keywords', FILTER_DEFAULT);
	$subtitulo = filter_input(INPUT_POST, 'subtitulo', FILTER_SANITIZE_EMAIL);
    $principal = filter_input(INPUT_POST, 'principal', FILTER_DEFAULT);
	$estado = filter_input(INPUT_POST, 'estado', FILTER_DEFAULT);
	$categoria = filter_input(INPUT_POST, 'categoria', FILTER_DEFAULT);
	
	
    if( $gallery->updateGallery($gallery_id, $friendly_url, $meta_description, $keywords, $subtitulo, $principal, $estado, $titulo, $categoria) ) {
        die;
    } else {
        $gallery->printMsg();
        die;
    }