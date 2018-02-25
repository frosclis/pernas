<?php
	require_once 'class/user.php';
	require_once 'class/dashboard.class.php';
	require_once 'class/databass.class.php';
	require_once '../../config.php';
	$dashboard = new Dashboard();

	if(isset($_SESSION['user']['id']) && $_SESSION['user']['id'] !== ''){
	  	$dashboard->dashboardHead();
		$dashboard->dashboardTop();
		$dashboard->dashboardMiddle();
		$dashboard->dashboardFooter();
	}else{
		header('Location: index.php');
	}
?>
