<?php
	require_once 'class/user.php';
	require_once 'class/categories.class.php';
	require_once 'class/dashboard.class.php';
	require_once 'class/databass.class.php';
	require_once '../../config.php';
	$category = new Category();
	$dashboard = new Dashboard();
	
	if(isset($_GET['category'])){
		$category_id = $_GET['category'];
	} else{
		header('Location: dashboard.php');
	}
	
	if(isset($_SESSION['user']['id']) && $_SESSION['user']['id'] !== ''){
		$category->categoryeditHead();
		$dashboard->dashboardTop();
		$datos = $category->getSingleCategory($category_id);
		$category->categoryEdit($datos);
		$category->categoryeditFooter();
	}else{
		header('Location: index.php');
	}
?>