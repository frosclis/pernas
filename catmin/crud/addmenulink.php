<?php
	require_once '../class/user.php';
	require_once '../class/dashboard.class.php';
	require_once '../class/databass.class.php';
	require_once '../../../config.php';
	
    $dashboard = new Dashboard();
    
	$name = $_POST['nombre'];
    $url = $_POST['ruta'];
    
    echo $_POST['ruta'];

    if( $dashboard->setMenu($name, $url, 0) ) {
        return True;
    } else {
        return False;
    }
