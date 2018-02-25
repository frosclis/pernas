<?php
	require_once '../class/user.php';
	require_once '../class/sliders.class.php';
	require_once '../class/databass.class.php';
	require_once '../../../config.php';

    $slider = new Slider();
	
	$sliderID = filter_input(INPUT_POST, 'sliderID', FILTER_DEFAULT);
	
	
	if(!empty($_FILES)){
		
		$destino = "../../uploads/sliders/";
		$original = $_FILES['file']['name'];
		$ext = pathinfo($original,PATHINFO_EXTENSION);
		$unique = uniqid();
		$nuevo = $unique.".".$ext;
		$targetFile = $destino.$nuevo;
		
		if(move_uploaded_file($_FILES['file']['tmp_name'],$targetFile)){
			if($slider->uploadImages($sliderID, $nuevo)){
				die;
			} else {
				$slider->printMsg();
			}
		}
	} else {
		if($slider->getImages($sliderID)){
			die;
		} 
	}