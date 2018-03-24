<?php
	require_once 'class/user.php';
    require_once 'class/blog.class.php';
    require_once 'class/comon.class.php';
	require_once 'class/databass.class.php';
	require_once '../config-front.php';

	if(isset($_GET["pag"]) && $_GET["pag"] != "") {
		$pag = $_GET["pag"];
	} else {
		$pag = 1;
	}

	$blog = new BlogFront();

	$comon = new Comon();

	$opciones = $comon->getOptions();

	if(isset($_GET["url"]) AND !empty($_GET["url"])){
		$categoria = $blog->getCategoryByURL($_GET["url"]);
        $datos = $blog->getPosts($pag, $categoria["id"]);
        $opciones[0]['description'] = $categoria["description"];
        $opciones[0]['meta_title'] = $opciones[0]['nombre_web'] . "- Categoría" . $categoria["nombre"] . " del blog";
        $opciones[0]['keywords'] = $categoria["keywords"];
        $opciones[0]['categoria_titulo'] = "<h1>Entradas de la categoría: ".$categoria["nombre"]."</h1>";

        $opciones[0]["paginacion"] = "";
        $anterior = $pag-1;
        $siguiente = $pag+1;

        $object = new BlogFront();
        $total_posts = $object->getMaxPags($categoria["id"]);
        $max_pages = ceil($total_posts[0]["total"]/6);

        if($anterior > 0) {
            if($anterior == 1){
                $opciones[0]["paginacion"] .= '<li><a href="/categoria-blog/'.strtolower($categoria["nombre"]).'">Anterior</a></li>';
                $opciones[0]["paginacion"] .= '<li><a href="/categoria-blog/'.strtolower($categoria["nombre"]).'"><span>1</span></a></li>';
            } else {
                $opciones[0]["paginacion"] .= '<li><a href="/categoria-blog/'.strtolower($categoria["nombre"]).'/'.$anterior.'">Anterior</a></li>';
                $opciones[0]["paginacion"] .= '<li><a href="/categoria-blog/'.strtolower($categoria["nombre"]).'/'.$anterior.'"><span>'.$anterior.'</span></a></li>';
            }
        }

        $opciones[0]["paginacion"] .= '<li class="active"><a href="/categoria-blog/'.strtolower($categoria["nombre"]).'/'.$pag.'"><span>'.$pag.'</span></a></li>';

        if($siguiente <= $max_pages) {
            $opciones[0]["paginacion"] .= '<li><a href="/categoria-blog/'.strtolower($categoria["nombre"]).'/'.$siguiente.'"><span>'.$siguiente.'</span></a></li>';
            $opciones[0]["paginacion"] .= '<li><a href="/categoria-blog/'.strtolower($categoria["nombre"]).'/'.$siguiente.'">Siguiente</a></li>';
        }

	} else {
        $datos = $blog->getPosts($pag, 0);
        $opciones[0]['description'] = "¡Bienvenidos a mi blog! Desde este pequeño espacio os haré llegar las últimas novedades de la web, nuevos proyectos y experiencias.";
        $opciones[0]['meta_title'] = $opciones[0]['nombre_web'] . " - Blog";
        $opciones[0]['keywords'] = "Alba Pernas, Fotografía, Fotografía Lugo, Fotografía Galicia, Blog";

		$opciones[0]["paginacion"] = "";
		$anterior = $pag-1;
		$siguiente = $pag+1;

		$object = new BlogFront();
		$total_posts = $object->getMaxPags(0);
		$max_pages = ceil($total_posts[0]["total"]/6);

		if($anterior > 0) {
			if($anterior == 1){
                $opciones[0]["paginacion"] .= '<li><a href="/blog">Anterior</a></li>';
                $opciones[0]["paginacion"] .= '<li><a href="/blog"><span>1</span></a></li>';
			} else {
                $opciones[0]["paginacion"] .= '<li><a href="/blog/'.$anterior.'">Anterior</a></li>';
                $opciones[0]["paginacion"] .= '<li><a href="/blog/'.$anterior.'"><span>'.$anterior.'</span></a></li>';
			}
		}

        $opciones[0]["paginacion"] .= '<li class="active"><a href="/blog/'.$pag.'"><span>'.$pag.'</span></a></li>';

		if($siguiente <= $max_pages) {
            $opciones[0]["paginacion"] .= '<li><a href="/blog/'.$siguiente.'"><span>'.$siguiente.'</span></a></li>';
            $opciones[0]["paginacion"] .= '<li><a href="/blog/'.$siguiente.'">Siguiente</a></li>';
		}
	}

	$menu_index = "Blog";
    $opciones[0]['pagina'] = $pag;
    $opciones = array_merge($opciones, $datos);


	if($opciones[0]['mantenimiento'] == 0 || (isset($_SESSION['user']['id']) && $_SESSION['user']['id'] !== '')){
	  	$blog->blogHead($opciones);
		$blog->blogMenu($menu_index, $opciones);
		$blog->blogMiddle($opciones);
        $blog->blogMiddleside($opciones);
		$comon->comonFooter($opciones);
	}else{
		header('Location: maintenance.php');
	}
?>
