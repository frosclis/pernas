<?php
	require_once '../class/user.php';
	require_once '../class/blog.categories.class.php';
	require_once '../class/databass.class.php';
	require_once '../../../config.php';

	$blogcategory = new BlogCategory();

    $categoria_id = filter_input(INPUT_POST, 'categoria_id', FILTER_DEFAULT);
    $friendly_url = filter_input(INPUT_POST, 'friendly_url', FILTER_DEFAULT);
	$categoria_nombre = filter_input(INPUT_POST, 'categoria_nombre', FILTER_DEFAULT);
	$categoria_description = filter_input(INPUT_POST, 'categoria_description', FILTER_DEFAULT);
	$keywords = filter_input(INPUT_POST, 'keywords', FILTER_DEFAULT);
	$estado = filter_input(INPUT_POST, 'estado', FILTER_DEFAULT);
    $color = filter_input(INPUT_POST, 'color', FILTER_DEFAULT);

    if( $blogcategory->updateBlogCategory($categoria_id, $categoria_nombre, $friendly_url, $categoria_description, $keywords, $estado, $color) ) {
        die;
    } else {
        $blogcategory->printMsg();
        die;
    }