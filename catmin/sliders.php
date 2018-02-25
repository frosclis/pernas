<?php
	require_once 'class/user.php';
	require_once 'class/sliders.class.php';
	require_once 'class/dashboard.class.php';
	require_once 'class/databass.class.php';
	require_once '../../config.php';
	$slider = new Slider();
	$dashboard = new Dashboard();
	
	
	if(isset($_SESSION['user']['id']) && $_SESSION['user']['id'] !== ''){
		$sliders = $slider->getSliders("");
		$dashboard->dashboardHead();
		$dashboard->dashboardTop();
		$slider->slidersMiddle($sliders);
		$slider->slidersFooter();
	}else{
		header('Location: index.php');
	}
?>