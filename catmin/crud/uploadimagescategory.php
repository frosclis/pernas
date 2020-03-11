<?php
	require_once '../class/user.php';
	require_once '../class/categories.class.php';
	require_once '../class/databass.class.php';
	require_once '../../../config.php';

    $category = new Category();
	
	$categoryID = filter_input(INPUT_POST, 'categoryID', FILTER_DEFAULT);
	
	
	if(!empty($_FILES)){
		
		$destino = "../../uploads/categories/";
		$original = $_FILES['file']['name'];
		$ext = pathinfo($original,PATHINFO_EXTENSION);
		$unique = uniqid();
		$nuevo = $unique.".".$ext;
		$targetFile = $destino.$nuevo;
		
		if(move_uploaded_file($_FILES['file']['tmp_name'],$targetFile)){
			
			$category->resizeImage($targetFile, $nuevo, 1080);
			$category->resizeImage($targetFile, $nuevo, 770);
			$category->resizeImage($targetFile, $nuevo, 440);
			$category->resizeImage($targetFile, $nuevo, 70);
			if($category->uploadImagesCategory($categoryID, $nuevo)){
				die;
			} else {
				$category->printMsg();
			}
		}
	}