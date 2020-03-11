<?php
	require_once 'class/user.php';
	require_once 'class/galleries.class.php';
	require_once 'class/dashboard.class.php';
	require_once 'class/databass.class.php';
	require_once '../../config.php';
	$gallery = new Gallery();
	$dashboard = new Dashboard();
	
	if(isset($_GET['gallery'])){
		$gallery_id = $_GET['gallery'];
	} else{
		header('Location: dashboard.php');
	}
	
	if(isset($_SESSION['user']['id']) && $_SESSION['user']['id'] !== ''){
		$gallery->galleryeditHead();
		$dashboard->dashboardTop();
		$datos = $gallery->getSingleGallery($gallery_id);
		$datos["imagenes"] = $gallery->getImagesGallery($gallery_id);
		$gallery->galleryEdit($datos);
		$gallery->galleryeditFooter();
	}else{
		header('Location: index.php');
	}
?>