<?php
	require_once '../class/user.php';
	require_once '../class/page.class.php';
	require_once '../class/databass.class.php';
	require_once '../../../config.php';
	
	$page = new Page();

    $pagina_id = filter_input(INPUT_POST, 'pagina_id', FILTER_DEFAULT);
    $friendly_url = filter_input(INPUT_POST, 'friendly_url', FILTER_DEFAULT);
	$titulo = filter_input(INPUT_POST, 'titulo', FILTER_DEFAULT);
	$meta_description = filter_input(INPUT_POST, 'meta_description', FILTER_DEFAULT);
	$keywords = filter_input(INPUT_POST, 'keywords', FILTER_DEFAULT);
	$subtitulo = filter_input(INPUT_POST, 'subtitulo', FILTER_DEFAULT);
    $contenido = filter_input(INPUT_POST, 'contenido', FILTER_DEFAULT);
	$estado = filter_input(INPUT_POST, 'estado', FILTER_DEFAULT);
	$principal = filter_input(INPUT_POST, 'principal', FILTER_DEFAULT);
	
	
    if( $page->updatePage($pagina_id, $friendly_url, $meta_description, $keywords, $subtitulo, $contenido, $estado, $titulo, $principal) ) {
        die;
    } else {
        $page->printMsg();
        die;
    }