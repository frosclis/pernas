<?php
	require_once '../class/user.php';
	require_once '../class/blog.categories.class.php';
	require_once '../class/databass.class.php';
	require_once '../../../config.php';

    $blogcategory = new BlogCategory();
	
	$imageID = filter_input(INPUT_POST, 'imageID', FILTER_DEFAULT);
	$ruta = filter_input(INPUT_POST, 'ruta', FILTER_DEFAULT);
	
	
	if($blogcategory->deleteImageBlogCategory($imageID, $ruta)){
		die;
	}