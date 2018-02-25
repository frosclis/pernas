<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<?php echo $datos[0]['description']; ?>">
<meta name="author" content="">
<link rel="shortcut icon" href="/theme/style/images/favicon.png">
<title><?php echo $datos[0]['nombre_web']; ?></title>
<!-- Bootstrap core CSS -->
<link href="/theme/style/css/bootstrap.min.css" rel="stylesheet">
<link href="/theme/style/css/plugins.css" rel="stylesheet">
<link href="/theme/style.css" rel="stylesheet">
<link href="/theme/style/css/color/blue.css" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Karla:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
<link href="/theme/style/type/icons.css" rel="stylesheet">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
<div id="preloader"><div class="textload">Cargando</div><div id="status"><div class="spinner"></div></div></div>
<main class="body-wrapper">
  <nav class="navbar">
    <div class="navbar-header">
      <div class="basic-wrapper"> 
        <div class="navbar-brand"> <a href="/"><img src="/uploads/logo.png" class="img-responsive max-logo" alt="<?php echo $datos[0]['nombre_web']; ?>" /></a> </div>
        <a class="btn responsive-menu" data-toggle="collapse" data-target=".navbar-collapse"><i></i></a>
      </div>
      <!-- /.basic-wrapper -->  
    </div>
    <!-- /.navbar-header -->