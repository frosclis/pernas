<?php
	require_once '../class/user.php';
	require_once '../class/dashboard.class.php';
	require_once '../class/databass.class.php';
	require_once '../../../config.php';
	
	$dashboard = new Dashboard();
	
	$nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_EMAIL);
    $ruta = filter_input(INPUT_POST, 'ruta', FILTER_DEFAULT);

    if( $dashboard->setMenu($name, $url, 0) ) {
        die;
    } else {
        $dashboard->printMsg();
        die;
    }
