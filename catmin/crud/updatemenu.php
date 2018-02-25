<?php
	require_once '../class/user.php';
	require_once '../class/dashboard.class.php';
	require_once '../class/databass.class.php';
	require_once '../../../config.php';
	
	$dashboard = new Dashboard();
	
	$contador = 1;
	
	$menus = $_POST['menus'];
	

	foreach($menus as $menu){
		$id = $menu['id'];
		$puesto = $contador;
		
		$dashboard->updateMenu($id, $puesto, 0);
		$contador++;
		
		if(isset($menu['children'])){
			$contador_hijo = 1;
			foreach($menu['children'] as $hijo){
				$id_hijo = $hijo['id'];
				$puesto_hijo = $contador_hijo;
				$padre = $id;
				$dashboard->updateMenu($id_hijo, $puesto_hijo, $padre);
				$contador_hijo++;
				
				if(isset($hijo['children'])){
					$contador_nieto = 1;
					foreach($hijo['children'] as $nieto){
						$id_nieto = $nieto['id'];
						$puesto_nieto = $contador_nieto;
						$padre_nieto = $id_hijo;
						$dashboard->updateMenu($id_nieto, $puesto_nieto, $padre_nieto);
						$contador_nieto++;
					}
				}
			}
		}
	}
	

     die;
