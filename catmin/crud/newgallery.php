<?php
	require_once '../class/user.php';
	require_once '../class/galleries.class.php';
	require_once '../class/databass.class.php';
	require_once '../../../config.php';
	
	$gallery = new Gallery();

	$nombre = filter_input(INPUT_POST, 'titulo', FILTER_DEFAULT);
	$autor = filter_input(INPUT_POST, 'autor', FILTER_DEFAULT);
	
	
    if( $gallery->newGallery($nombre, $autor) ) {
        $gallery->printMsg();
    } else {
        $gallery->printMsg();
        die;
    }