<?php
	require_once 'class/user.php';
	require_once 'class/galleries.class.php';
	require_once 'class/dashboard.class.php';
	require_once 'class/databass.class.php';
	require_once '../../config.php';
	$gallery = new Gallery();
	$dashboard = new Dashboard();
	
	
	if(isset($_SESSION['user']['id']) && $_SESSION['user']['id'] !== ''){
		$galerias = $gallery->getGalleries("");
		$dashboard->dashboardHead();
		$dashboard->dashboardTop();
		$gallery->galleriesMiddle($galerias);
		$gallery->galleriesFooter();
	}else{
		header('Location: index.php');
	}
?>