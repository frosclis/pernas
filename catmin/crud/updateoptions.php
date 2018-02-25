<?php
	require_once '../class/user.php';
	require_once '../class/dashboard.class.php';
	require_once '../class/databass.class.php';
	require_once '../../../config.php';
	
	$dashboard = new Dashboard();
	

    $nombre_web = filter_input(INPUT_POST, 'nombre_web', FILTER_DEFAULT);
	$description = filter_input(INPUT_POST, 'description', FILTER_DEFAULT);
	$email = filter_input(INPUT_POST, 'email', FILTER_DEFAULT);
	$facebook = filter_input(INPUT_POST, 'facebook', FILTER_DEFAULT);
	$twitter = filter_input(INPUT_POST, 'twitter', FILTER_DEFAULT);
	$instagram = filter_input(INPUT_POST, 'instagram', FILTER_DEFAULT);
	$flickr = filter_input(INPUT_POST, 'flickr', FILTER_DEFAULT);
	$linkedin = filter_input(INPUT_POST, 'linkedin', FILTER_DEFAULT);
	$pinterest = filter_input(INPUT_POST, 'pinterest', FILTER_DEFAULT);
	$telefono = filter_input(INPUT_POST, 'telefono', FILTER_DEFAULT);
	$direccion = filter_input(INPUT_POST, 'direccion', FILTER_DEFAULT);
	$latitud = filter_input(INPUT_POST, 'latitud', FILTER_DEFAULT);
	$longitud = filter_input(INPUT_POST, 'longitud', FILTER_DEFAULT);
	$mantenimiento = filter_input(INPUT_POST, 'mantenimiento', FILTER_DEFAULT);
	

    if($dashboard->setOptions($nombre_web, $description, $email, $facebook, $twitter, $instagram, $flickr, $pinterest, $linkedin, $telefono, $direccion, $latitud, $longitud, $mantenimiento)) {
        die;
    } else {
        $dashboard->printMsg();
        die;
    }