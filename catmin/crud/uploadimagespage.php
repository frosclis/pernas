<?php
	require_once '../class/user.php';
	require_once '../class/page.class.php';
	require_once '../class/databass.class.php';
	require_once '../../../config.php';

    $page = new Page();
	
	$pageID = filter_input(INPUT_POST, 'pageID', FILTER_DEFAULT);
	
	
	if(!empty($_FILES)){
		
		$destino = "../../uploads/pages/";
		$original = $_FILES['file']['name'];
		$ext = pathinfo($original,PATHINFO_EXTENSION);
		$unique = uniqid();
		$nuevo = $unique.".".$ext;
		$targetFile = $destino.$nuevo;
		
		if(move_uploaded_file($_FILES['file']['tmp_name'],$targetFile)){
			
			$page->resizeImage($targetFile, $nuevo, 1080);
			$page->resizeImage($targetFile, $nuevo, 770);
			$page->resizeImage($targetFile, $nuevo, 440);
			$page->resizeImage($targetFile, $nuevo, 70);
			if($page->uploadImages($pageID, $nuevo)){
				die;
			} else {
				$page->printMsg();
			}
		}
	} else {
		if($page->getImages($pageID)){
			die;
		} 
	}