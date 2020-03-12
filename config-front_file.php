<?php
session_start();
define('conString', 'mysql:host=localhost;dbname=;charset=utf8;port=');
define('dbUser', '');
define('dbPass', '');
define('dbName', '');



//template files index
define('indexHead', 'theme/indexhead.php');
define('indexMenu', 'theme/indexmenu.php');
define('indexMiddle', 'theme/indexmiddle.php');
define('indexFooter', 'theme/indexfooter.php');

//template files comon
define('comonHead', 'theme/comonhead.php');
define('comonFooter', 'theme/comonfooter.php');
define('comonMenu', 'theme/comonmenu.php');

//template files page
define('pageMiddle', 'theme/pagemiddle.php');

//template files blog
define('blogHead', 'theme/bloghead.php');
define('blogMiddleSide', 'theme/blogmiddleside.php');
define('blogMiddle', 'theme/blogmiddle.php');
define('blogMenu', 'theme/blogmenu.php');
define('postMiddle', 'theme/postmiddle.php');
define('searchMiddle', 'theme/searchmiddle.php');

//template files galleries
define('galleriesHead', 'theme/gallerieshead.php');
define('galleriesMiddle', 'theme/galleriesmiddle.php');
define('galleriesMenu', 'theme/galleriesmenu.php');
define('galleryMiddle', 'theme/gallerymiddle.php');
define('galleryCategoryMiddle', 'theme/gallerycategorymiddle.php');

//template files contact
define('contactHead', 'theme/contacthead.php');
define('contactMenu', 'theme/contactmenu.php');
define('contactMiddle', 'theme/contactmiddle.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$user = new User();
$user->dbConnect(conString, dbUser, dbPass);
