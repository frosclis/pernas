<?php
	require_once 'class/user.php';
	require_once 'class/categories.class.php';
	require_once 'class/dashboard.class.php';
	require_once 'class/databass.class.php';
	require_once '../../config.php';
	$category = new Category();
	$dashboard = new Dashboard();
	
	
	if(isset($_SESSION['user']['id']) && $_SESSION['user']['id'] !== ''){
		$categorias = $category->getCategories("");
		$dashboard->dashboardHead();
		$dashboard->dashboardTop();
		$category->categoriesMiddle($categorias);
		$category->categoriesFooter();
	}else{
		header('Location: index.php');
	}
?>