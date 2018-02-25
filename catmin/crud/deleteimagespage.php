<?php
	require_once '../class/user.php';
	require_once '../class/page.class.php';
	require_once '../class/databass.class.php';
	require_once '../../../config.php';

    $page = new Page();
	
	$imageID = filter_input(INPUT_POST, 'imageID', FILTER_DEFAULT);
	$ruta = filter_input(INPUT_POST, 'ruta', FILTER_DEFAULT);
	
	
	if($page->deleteImage($imageID, $ruta)){
		die;
	}