<?php
	require_once 'class/user.php';
	require_once 'class/blog.class.php';
	require_once 'class/dashboard.class.php';
	require_once 'class/databass.class.php';
	require_once '../../config.php';
	$blog = new Blog();
	$dashboard = new Dashboard();
	
	if(isset($_GET['post'])){
		$page_id = $_GET['post'];
	} else{
		header('Location: dashboard.php');
	}
	
	if(isset($_SESSION['user']['id']) && $_SESSION['user']['id'] !== ''){
		$blog->posteditHead();
		$dashboard->dashboardTop();
		$datos = $blog->getSinglePost($page_id);
		$blog->postEdit($datos);
		$blog->posteditFooter();
	}else{
		header('Location: index.php');
	}
?>