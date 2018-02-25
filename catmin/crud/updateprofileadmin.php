<?php
	require_once '../class/user.php';
	require_once '../../../config.php';

    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_EMAIL);
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_DEFAULT);
	$apellido = filter_input(INPUT_POST, 'apellido', FILTER_DEFAULT);
	$email = filter_input(INPUT_POST, 'email', FILTER_DEFAULT);

    if( $user->updateProfile($id, $nombre, $apellido, $email) ) {
        die;
    } else {
        $user->printMsg();
        die;
    }