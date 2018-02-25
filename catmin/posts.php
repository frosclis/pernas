<?php
	require_once 'class/user.php';
	require_once 'class/blog.class.php';
	require_once 'class/dashboard.class.php';
	require_once 'class/databass.class.php';
	require_once '../../config.php';
	$blog = new Blog();
	$dashboard = new Dashboard();
	
	
	if(isset($_SESSION['user']['id']) && $_SESSION['user']['id'] !== ''){
		$posts = $blog->getPosts("");
		$dashboard->dashboardHead();
		$dashboard->dashboardTop();
		$blog->postsMiddle($posts);
		$blog->postsFooter();
	}else{
		header('Location: index.php');
	}
?>