<?php
	require_once '../class/user.php';
	require_once '../../../config.php';

    $id = filter_input(INPUT_POST, 'id', FILTER_DEFAULT);
    $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);
	
    if( $user->passwordChange( $id, $password) ) {
        die;
    } else {
        $user->printMsg();
        die;
    }