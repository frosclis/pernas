<?php
	require_once '../class/user.php';
	require_once '../class/databass.class.php';
	require_once '../../../config.php';
	
	$user = new User();

    $user_id = filter_input(INPUT_POST, 'user_id', FILTER_DEFAULT);
	
	
    if( $user->delUser($user_id) ) {
        die;
    } else {
        $user->printMsg();
        die;
    }