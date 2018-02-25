<?php
	require_once '../class/user.php';
	require_once '../class/page.class.php';
	require_once '../class/databass.class.php';
	require_once '../../../config.php';
	
	$page = new Page();

	$nombre = filter_input(INPUT_POST, 'titulo', FILTER_DEFAULT);
	$autor = filter_input(INPUT_POST, 'autor', FILTER_DEFAULT);
	
	
    if( $page->newPage($nombre, $autor) ) {
        $page->printMsg();
    } else {
        $page->printMsg();
        die;
    }