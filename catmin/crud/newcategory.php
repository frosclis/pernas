<?php
	require_once '../class/user.php';
	require_once '../class/categories.class.php';
	require_once '../class/databass.class.php';
	require_once '../../../config.php';
	
	$category = new Category();

	$nombre = filter_input(INPUT_POST, 'categoria_nombre', FILTER_DEFAULT);
	
	
    if( $category->newCategory($nombre) ) {
        $category->printMsg();
    } else {
        $category->printMsg();
        die;
    }