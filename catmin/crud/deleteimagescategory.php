<?php
	require_once '../class/user.php';
	require_once '../class/categories.class.php';
	require_once '../class/databass.class.php';
	require_once '../../../config.php';

    $category = new Category();
	
	$imageID = filter_input(INPUT_POST, 'imageID', FILTER_DEFAULT);
	$ruta = filter_input(INPUT_POST, 'ruta', FILTER_DEFAULT);
	
	
	if($category->deleteImageCategory($imageID, $ruta)){
		die;
	}