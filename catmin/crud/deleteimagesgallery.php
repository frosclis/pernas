<?php
	require_once '../class/user.php';
	require_once '../class/galleries.class.php';
	require_once '../class/databass.class.php';
	require_once '../../../config.php';

    $gallery = new Gallery();
	
	$imageID = filter_input(INPUT_POST, 'imageID', FILTER_DEFAULT);
	$ruta = filter_input(INPUT_POST, 'ruta', FILTER_DEFAULT);
	
	
	if($gallery->deleteImageGallery($imageID, $ruta)){
		die;
	}