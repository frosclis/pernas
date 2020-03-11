<?php
	require_once '../class/user.php';
	require_once '../class/dashboard.class.php';
	require_once '../class/databass.class.php';
	require_once '../../../config.php';
	
	$dashboard = new Dashboard();
	
	$contador = 1;
	
	$listado = $_POST['listado'];
	$type = $_POST['type'];	

	foreach($listado as $item){
		
		$id = intval($item['id']);
		$puesto = $contador;
		
		$dashboard->updateImagesPosition($id, $type, $puesto);
		$contador++;
	}

	return $dashboard;