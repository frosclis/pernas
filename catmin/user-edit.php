<?php
	require_once 'class/user.php';
	require_once 'class/dashboard.class.php';
	require_once 'class/databass.class.php';
	require_once '../../config.php';
	$user = new User();
	$dashboard = new Dashboard();
	
	if(isset($_GET['user'])){
		$user_id = $_GET['user'];
	} else{
		header('Location: dashboard.php');
	}
	
	if(isset($_SESSION['user']['id']) && $_SESSION['user']['id'] !== ''){
		$dashboard->dashboardHead();
		$dashboard->dashboardTop();
		$datos = $user->getSingleUser($user_id);
		$user->userEditAdmin($datos);
		$user->userEditFooterAdmin();
	}else{
		header('Location: index.php');
	}
?>