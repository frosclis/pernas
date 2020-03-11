<?php
	require_once '../class/user.php';
	require_once '../class/galleries.class.php';
	require_once '../class/databass.class.php';
	require_once '../../../config.php';
	
	$gallery = new Gallery();

    $gallery_id = filter_input(INPUT_POST, 'gallery_id', FILTER_DEFAULT);
	
	
    if( $gallery->delGallery($gallery_id) ) {
        die;
    } else {
        $user->printMsg();
        die;
    }