<?php
	require_once '../class/user.php';
	require_once '../class/blog.categories.class.php';
	require_once '../class/databass.class.php';
	require_once '../../../config.php';

    $blogcategory = new BlogCategory();
	
	$categoryID = filter_input(INPUT_POST, 'categoryID', FILTER_DEFAULT);
	
	
	if(!empty($_FILES)){
		
		$destino = "../../uploads/blogcategories/";
		$original = $_FILES['file']['name'];
		$ext = pathinfo($original,PATHINFO_EXTENSION);
		$unique = uniqid();
		$nuevo = $unique.".".$ext;
		$targetFile = $destino.$nuevo;
		
		if(move_uploaded_file($_FILES['file']['tmp_name'],$targetFile)){
			
			$blogcategory->resizeImage($targetFile, $nuevo, 1080);
			$blogcategory->resizeImage($targetFile, $nuevo, 770);
			$blogcategory->resizeImage($targetFile, $nuevo, 440);
			$blogcategory->resizeImage($targetFile, $nuevo, 70);
			if($blogcategory->uploadImagesBlogCategory($categoryID, $nuevo)){
				die;
			} else {
				$blogcategory->printMsg();
			}
		}
	} else {
		if($blogcategory->getImagesBlogCategory($categoryID)){
			die;
		} 
	}