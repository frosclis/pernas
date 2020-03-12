<?php
	require_once '../class/user.php';
	require_once '../class/dashboard.class.php';
	require_once '../class/databass.class.php';
	require_once '../../../config.php';
	
    $dashboard = new Dashboard();
    
	$menuID = $_POST['menuID'];

    if( $dashboard->delMenu($menuID) ) {
        return True;
    } else {
        return False;
    }
