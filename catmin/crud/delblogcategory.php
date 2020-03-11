<?php
	require_once '../class/user.php';
	require_once '../class/blog.categories.class.php';
	require_once '../class/databass.class.php';
	require_once '../../../config.php';
	
	$blogcategory = new BlogCategory();

    $category_id = filter_input(INPUT_POST, 'category_id', FILTER_DEFAULT);
	
	
    if( $blogcategory->delBlogCategory($category_id) ) {
        die;
    } else {
        $blogcategory->printMsg();
        die;
    }