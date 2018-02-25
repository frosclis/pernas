<?php
	require_once '../class/user.php';
	require_once '../class/page.class.php';
	require_once '../class/databass.class.php';
	require_once '../../../config.php';
	
	$page = new Page();

    $pagina_id = filter_input(INPUT_POST, 'pagina_id', FILTER_SANITIZE_EMAIL);
	
	
    if( $page->delPage($pagina_id) ) {
        die;
    } else {
        $user->printMsg();
        die;
    }