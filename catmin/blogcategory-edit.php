<?php
	require_once 'class/user.php';
	require_once 'class/blog.categories.class.php';
	require_once 'class/dashboard.class.php';
	require_once 'class/databass.class.php';
	require_once '../../config.php';
	$blogcategory = new BlogCategory();
	$dashboard = new Dashboard();
	
	if(isset($_GET['category'])){
		$category_id = $_GET['category'];
	} else{
		header('Location: dashboard.php');
	}
	
	if(isset($_SESSION['user']['id']) && $_SESSION['user']['id'] !== ''){
		$blogcategory->blogCategoryeditHead();
		$dashboard->dashboardTop();
		$datos = $blogcategory->getSingleBlogCategory($category_id);
		$blogcategory->blogCategoryEdit($datos);
		$blogcategory->blogCategoryeditFooter();
	}else{
		header('Location: index.php');
	}
?>