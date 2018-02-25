<?php
	require_once '../class/user.php';
	require_once '../class/blog.class.php';
	require_once '../class/databass.class.php';
	require_once '../../../config.php';
	
	$blog = new Blog();

    $pagina_id = filter_input(INPUT_POST, 'post_id', FILTER_SANITIZE_EMAIL);
	
	
    if( $blog->delPost($pagina_id) ) {
        die;
    } else {
        $user->printMsg();
        die;
    }