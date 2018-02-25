<?php
	require_once 'class/user.php';
	require_once 'class/dashboard.class.php';
	require_once 'class/databass.class.php';
	require_once '../../config.php';
	$user = new User();
	$dashboard = new Dashboard();
	
	
	if(isset($_SESSION['user']['id']) && $_SESSION['user']['id'] !== ''){
		$users = $user->getUsers();
		$dashboard->dashboardHead();
		$dashboard->dashboardTop();
		$user->usersMiddle($users);
		$user->usersFooter();
	}else{
		header('Location: index.php');
	}
?>