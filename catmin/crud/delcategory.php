<?php
	require_once '../class/user.php';
	require_once '../class/categories.class.php';
	require_once '../class/databass.class.php';
	require_once '../../../config.php';
	
	$category = new Category();

    $category_id = filter_input(INPUT_POST, 'category_id', FILTER_DEFAULT);
	
	
    if( $category->delCategory($category_id) ) {
        die;
    } else {
        $category->printMsg();
        die;
    }