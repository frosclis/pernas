<?php
	require_once '../class/user.php';
	require_once '../class/blog.class.php';
	require_once '../class/databass.class.php';
	require_once '../../../config.php';

    $blog = new Blog();
	
	$imageID = filter_input(INPUT_POST, 'imageID', FILTER_DEFAULT);
	$ruta = filter_input(INPUT_POST, 'ruta', FILTER_DEFAULT);
	
	
	if($blog->deleteImage($imageID, $ruta)){
		die;
	}