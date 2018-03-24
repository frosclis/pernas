<div class="container inner2">
    <?php
        if(isset($datos[0]["categoria_titulo"])){
            echo $datos[0]["categoria_titulo"];
        }
    ?>
    <div class="blog grid-view col2 row">
        <div class="col-sm-8 blog-content">
            <div class="blog-posts">
                <div class="isotope row">
                    <?php
                        if($datos[1] == false) {
                            ?>
                            <div class="col-md-12 col-sm-12 grid-view-post">
                                <div class="post">
                                    <div class="box text-center">
                                        <h4 class="post-title"><a href="/">Tu búsqueda no ha obtenido resultados.</a></h4>
                                        <p><a href="/">Vuelve a la página de inicio</a> o prueba con otras palabras.</p>
                                        <div class="widget">
                                            <h4 class="widget-title">Buscar</h4>
                                            <form class="searchform" method="post" action="/buscar">
                                                <input type="text" id="busqueda" name="busqueda" value="" placeholder="Tu búsqueda">
                                                <button type="submit" class="btn btn-default">Buscar</button>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /.box -->
                                </div>
                            </div>
                            <?php
                        } else {
                            foreach ($datos as $post){
                                if(isset($post["friendly_url"]) && isset($post["contenido"])) {
                                    $tipo = $post["tipo"];
                                    $titulo = $post['titulo'];
                                    $contenido = substr(strip_tags($post['contenido']), 0, 200);

                                    if($tipo == "pagina") {
                                        $imagen = "/uploads/pages/770/" . $post['portada'];
                                        $friendly_url = "/contenido/" . $post['friendly_url'];
                                    } else {
                                        $imagen = "/uploads/posts/770/" . $post['portada'];
                                        $friendly_url = "/post/" . $post['friendly_url'];
                                    }

                                    ?>
                                    <div class="col-md-6 col-sm-12 grid-view-post">
                                        <div class="post">
                                            <figure class="main"><a href="<?php echo $friendly_url; ?>"><img src="<?php echo $imagen; ?>" alt="<?php echo $titulo; ?>" /></a></figure>
                                            <div class="box text-center">
                                                <h4 class="post-title"><a href="<?php echo $friendly_url; ?>"><?php echo $titulo; ?></a></h4>
                                                <?php echo $contenido; ?>
                                            </div>
                                            <!-- /.box -->
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
        <!-- /.pagination -->