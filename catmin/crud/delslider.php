<?php
	require_once '../class/user.php';
	require_once '../class/sliders.class.php';
	require_once '../class/databass.class.php';
	require_once '../../../config.php';
	
	$slider = new Slider();

    $slider_id = filter_input(INPUT_POST, 'slider_id', FILTER_DEFAULT);
	
	
    if( $slider->delSlider($slider_id) ) {
        die;
    } else {
        $user->printMsg();
        die;
    }