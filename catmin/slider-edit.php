<?php
	require_once 'class/user.php';
	require_once 'class/sliders.class.php';
	require_once 'class/dashboard.class.php';
	require_once 'class/databass.class.php';
	require_once '../../config.php';
	$slider = new Slider();
	$dashboard = new Dashboard();
	
	if(isset($_GET['slider'])){
		$slider_id = $_GET['slider'];
	} else{
		header('Location: dashboard.php');
	}
	
	if(isset($_SESSION['user']['id']) && $_SESSION['user']['id'] !== ''){
		$slider->slidereditHead();
		$dashboard->dashboardTop();
		$datos = $slider->getSingleSlider($slider_id);
		$slider->sliderEdit($datos);
		$slider->slidereditFooter();
	}else{
		header('Location: index.php');
	}
?>