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
                                        <h4 class="post-title"><a href="/blog">No hay resultados para esta página</a></h4>
                                        <p><a href="/blog">Volver a la página principal del blog.</a></p>
                                    </div>
                                    <!-- /.box -->
                                </div>
                            </div>
                            <?php
                        } else {
                            foreach ($datos as $post){
                                if(isset($post["friendly_url"]) && isset($post["contenido"])) {
                                    $imagen = "/uploads/posts/770/" . $post['portada'];
                                    $titulo = $post['titulo'];
                                    $friendly_url = $post['friendly_url'];
                                    $fecha_publicacion = $post['fecha_publicacion'];
                                    $categoria_id = $post['categoria'];
                                    $contenido = substr(strip_tags($post['contenido']), 0, 200);

                                    $object = new BlogFront();
                                    $categoriaDatos = $object->getSingleBlogCategory($categoria_id);

                                    ?>
                                    <div class="col-md-6 col-sm-12 grid-view-post">
                                        <div class="post">
                                            <figure class="main"><a href="/post/<?php echo $friendly_url; ?>"><img src="<?php echo $imagen; ?>" alt="<?php echo $titulo; ?>" /></a></figure>
                                            <div class="box text-center">
                                                <div class="category <?php  echo $categoriaDatos["color"]; ?>"><span><a href="/categoria-blog/<?php echo $categoriaDatos["friendly_url"]; ?>"><?php  echo $categoriaDatos["nombre"]; ?></a></span></div>
                                                <h4 class="post-title"><a href="/post/<?php echo $friendly_url; ?>"><?php echo $titulo; ?></a></h4>
                                                <div class="meta"><span class="date"><?php echo $fecha_publicacion; ?></span><span class="comments"><a href="#"><i class="icon-chat-1"></i> 15</a></span></div>
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
            <!-- .post -->
            <div class="pagination">
                <ul>
                    <?php
                        echo $datos[0]["paginacion"];
                    ?>
                </ul>
            </div>
        </div>
        <!-- /.pagination -->