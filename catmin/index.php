<?php
	require_once 'class/user.php';
	require_once '../../config.php';
	
	if(isset($_SESSION['user']['id']) && $_SESSION['user']['id'] !== ''){
		header('Location: dashboard.php');
	}else{
		$user->indexHead();
		$user->indexTop();
		$user->loginForm();
		$user->indexMiddle();
		$user->indexFooter();
	}
?>
