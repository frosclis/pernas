<?php
	require_once '../class/user.php';
	require_once '../class/blog.class.php';
	require_once '../class/databass.class.php';
	require_once '../../../config.php';
	
	$blog = new Blog();

	$nombre = filter_input(INPUT_POST, 'titulo', FILTER_DEFAULT);
	$autor = filter_input(INPUT_POST, 'autor', FILTER_DEFAULT);
	
	
    if( $blog->newPost($nombre, $autor) ) {
        $blog->printMsg();
    } else {
        $blog->printMsg();
        die;
    }