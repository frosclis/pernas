<?php
	require_once '../class/user.php';
	require_once '../../../config.php';

    $id = filter_input(INPUT_POST, 'id', FILTER_DEFAULT);
	
    $avatar = $_FILES["file"]["name"];
	$temporal = $_FILES['file']['tmp_name'];
	$imageFileType = pathinfo($avatar,PATHINFO_EXTENSION);
	$destino = '../../uploads/avatar/' . $id . '.' . $imageFileType;
	
	
    if(move_uploaded_file($temporal, $destino)){
		if($user->updateAvatar($id, $imageFileType)){
			die;
		} else {
			$user->printMsg();
			die;
		}
	}
