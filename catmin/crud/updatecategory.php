<?php
	require_once '../class/user.php';
	require_once '../class/categories.class.php';
	require_once '../class/databass.class.php';
	require_once '../../../config.php';
	
	$category = new Category();

    $categoria_id = filter_input(INPUT_POST, 'categoria_id', FILTER_SANITIZE_EMAIL);
    $friendly_url = filter_input(INPUT_POST, 'friendly_url', FILTER_DEFAULT);
	$categoria_nombre = filter_input(INPUT_POST, 'categoria_nombre', FILTER_DEFAULT);
	$categoria_description = filter_input(INPUT_POST, 'categoria_description', FILTER_DEFAULT);
	$keywords = filter_input(INPUT_POST, 'keywords', FILTER_DEFAULT);
	$categoria_padre = filter_input(INPUT_POST, 'categoria_padre', FILTER_SANITIZE_EMAIL);
	$estado = filter_input(INPUT_POST, 'estado', FILTER_DEFAULT);
	
	
    if( $category->updateCategory($categoria_id, $categoria_nombre, $friendly_url, $categoria_description, $keywords, $categoria_padre, $estado) ) {
        die;
    } else {
        $category->printMsg();
        die;
    }