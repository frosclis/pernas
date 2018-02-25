<?php
	require_once '../class/user.php';
	require_once '../class/blog.class.php';
	require_once '../class/databass.class.php';
	require_once '../../../config.php';

    $blog = new Blog();
	
	$pageID = filter_input(INPUT_POST, 'pageID', FILTER_DEFAULT);
	
	
	if(!empty($_FILES)){
		
		$destino = "../../uploads/posts/";
		$original = $_FILES['file']['name'];
		$ext = pathinfo($original,PATHINFO_EXTENSION);
		$unique = uniqid();
		$nuevo = $unique.".".$ext;
		$targetFile = $destino.$nuevo;
		
		if(move_uploaded_file($_FILES['file']['tmp_name'],$targetFile)){
			
			$blog->resizeImage($targetFile, $nuevo, 1080);
			$blog->resizeImage($targetFile, $nuevo, 770);
			$blog->resizeImage($targetFile, $nuevo, 440);
			$blog->resizeImage($targetFile, $nuevo, 70);
			if($blog->uploadImages($pageID, $nuevo)){
				die;
			} else {
				$page->printMsg();
			}
		}
	} else {
		if($blog->getImages($pageID)){
			die;
		} 
	}