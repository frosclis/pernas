<?php
	require_once '../class/user.php';
	require_once '../class/sliders.class.php';
	require_once '../class/databass.class.php';
	require_once '../../../config.php';
	
	$slider = new Slider();

    $slider_id = filter_input(INPUT_POST, 'slider_id', FILTER_DEFAULT);
	$titulo = filter_input(INPUT_POST, 'titulo', FILTER_DEFAULT);
	$subtitulo = filter_input(INPUT_POST, 'subtitulo', FILTER_DEFAULT);
    $contenido = filter_input(INPUT_POST, 'contenido', FILTER_DEFAULT);
	$estado = filter_input(INPUT_POST, 'estado', FILTER_DEFAULT);
	
	
    if( $slider->updateSlider($slider_id, $subtitulo, $contenido, $estado, $titulo) ) {
        die;
    } else {
        $slider->printMsg();
        die;
    }