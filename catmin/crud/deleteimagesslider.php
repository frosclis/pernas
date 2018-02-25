<?php
	require_once '../class/user.php';
	require_once '../class/sliders.class.php';
	require_once '../class/databass.class.php';
	require_once '../../../config.php';

    $slider = new Slider();
	
	$sliderID = filter_input(INPUT_POST, 'sliderID', FILTER_DEFAULT);
	$ruta = filter_input(INPUT_POST, 'ruta', FILTER_DEFAULT);
	
	
	if($slider->deleteImage($sliderID, $ruta)){
		die;
	}