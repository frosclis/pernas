<?php
	require_once 'class/user.php';
	require_once 'class/page.class.php';
	require_once 'class/dashboard.class.php';
	require_once 'class/databass.class.php';
	require_once '../../config.php';
	$page = new Page();
	$dashboard = new Dashboard();
	
	
	if(isset($_SESSION['user']['id']) && $_SESSION['user']['id'] !== ''){
		$paginas = $page->getPages("");
		$dashboard->dashboardHead();
		$dashboard->dashboardTop();
		$page->pagesMiddle($paginas);
		$page->pagesFooter();
	}else{
		header('Location: index.php');
	}
?>