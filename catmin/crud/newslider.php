<?php
	require_once '../class/user.php';
	require_once '../class/sliders.class.php';
	require_once '../class/databass.class.php';
	require_once '../../../config.php';
	
	$slider = new Slider();

	$nombre = filter_input(INPUT_POST, 'titulo', FILTER_DEFAULT);
	$autor = filter_input(INPUT_POST, 'autor', FILTER_DEFAULT);
	
	
    if( $slider->newSlider($nombre, $autor) ) {
        $slider->printMsg();
    } else {
        $slider->printMsg();
        die;
    }