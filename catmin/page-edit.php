<?php
	require_once 'class/user.php';
	require_once 'class/page.class.php';
	require_once 'class/dashboard.class.php';
	require_once 'class/databass.class.php';
	require_once '../../config.php';
	$page = new Page();
	$dashboard = new Dashboard();
	
	if(isset($_GET['page'])){
		$page_id = $_GET['page'];
	} else{
		header('Location: dashboard.php');
	}
	
	if(isset($_SESSION['user']['id']) && $_SESSION['user']['id'] !== ''){
		$page->pageeditHead();
		$dashboard->dashboardTop();
		$datos = $page->getSinglePage($page_id);
		$datos["imagenes"] = $page->getImages($page_id);
		$page->pageEdit($datos);
		$page->pageeditFooter();
	}else{
		header('Location: index.php');
	}
?>