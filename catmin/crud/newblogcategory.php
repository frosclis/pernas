<?php
	require_once '../class/user.php';
	require_once '../class/blog.categories.class.php';
	require_once '../class/databass.class.php';
	require_once '../../../config.php';
	
	$blogcategory = new BlogCategory();

	$nombre = filter_input(INPUT_POST, 'categoria_nombre', FILTER_DEFAULT);
	
	
    if( $blogcategory->newBlogCategory($nombre) ) {
        $blogcategory->printMsg();
    } else {
        $blogcategory->printMsg();
        die;
    }