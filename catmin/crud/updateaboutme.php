<?php
	require_once '../class/user.php';
	require_once '../../../config.php';

    $avatar = $_FILES["file"]["name"];
	$temporal = $_FILES['file']['tmp_name'];
	$imageFileType = pathinfo($avatar,PATHINFO_EXTENSION);
	$destino = '../../uploads/aboutme.png';
	
	
    if(move_uploaded_file($temporal, $destino)){
		die;
	}
