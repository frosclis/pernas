<?php
	require_once 'class/user.php';
	require_once 'class/index.class.php';
	require_once 'class/databass.class.php';
	require_once '../config-front.php';
	$index = new Index();
	
	$opciones = $index->getOptions();
	$menu_index = "Inicio";

	if($opciones[0]['mantenimiento'] == 0 || (isset($_SESSION['user']['id']) && $_SESSION['user']['id'] !== '')){
	  	$index->indexHead($opciones);
		$index->indexMenu($menu_index, $opciones);
		$index->indexMiddle($opciones);
		$index->indexFooter($opciones);
	}else{
		header('Location: /proximamente');
	}
?>
