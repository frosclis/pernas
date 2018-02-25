<?php
	require_once 'class/user.php';
	require_once 'class/blog.categories.class.php';
	require_once 'class/dashboard.class.php';
	require_once 'class/databass.class.php';
	require_once '../../config.php';
	$blogcategory = new BlogCategory();
	$dashboard = new Dashboard();
	
	
	if(isset($_SESSION['user']['id']) && $_SESSION['user']['id'] !== ''){
		$categorias = $blogcategory->getBlogCategories("");
		$dashboard->dashboardHead();
		$dashboard->dashboardTop();
		$blogcategory->blogCategoriesMiddle($categorias);
		$blogcategory->blogCategoriesFooter();
	}else{
		header('Location: index.php');
	}
?>