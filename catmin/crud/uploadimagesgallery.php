<?php
	require_once '../class/user.php';
	require_once '../class/galleries.class.php';
	require_once '../class/databass.class.php';
	require_once '../../../config.php';

    $gallery = new Gallery();
	
	$galleryID = filter_input(INPUT_POST, 'galleryID', FILTER_DEFAULT);
	
	
	if(!empty($_FILES)){
		
		$destino = "../../uploads/galleries/";
		$original = $_FILES['file']['name'];
		$ext = pathinfo($original,PATHINFO_EXTENSION);
		$unique = uniqid();
		$nuevo = $unique.".".$ext;
		$targetFile = $destino.$nuevo;
		
		if(move_uploaded_file($_FILES['file']['tmp_name'],$targetFile)){
			
			$gallery->resizeImage($targetFile, $nuevo, 1080);
			$gallery->resizeImage($targetFile, $nuevo, 560);
			$gallery->resizeImage($targetFile, $nuevo, 280);
			$gallery->resizeImage($targetFile, $nuevo, 70);
			if($gallery->uploadImagesGalleries($galleryID, $nuevo)){
				die;
			} else {
				$gallery->printMsg();
			}
		}
	} else {
		if($gallery->getImagesGallery($galleryID)){
			die;
		} 
	}