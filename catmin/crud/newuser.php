<?php
	require_once '../class/user.php';
	require_once '../class/databass.class.php';
	require_once '../../../config.php';
	
	$user = new User();

	$nombre = filter_input(INPUT_POST, 'nombre', FILTER_DEFAULT);
	
	
    if( $user->newUser($nombre) ) {
        $user->printMsg();
    } else {
        $user->printMsg();
        die;
    }