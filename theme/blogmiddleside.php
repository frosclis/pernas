    <aside class="col-sm-4 sidebar">
        <div class="sidebox widget">
            <h3 class="widget-title">Buscar</h3>
            <form class="searchform" method="get">
                <input type="text" id="s1" name="s" value="Tu búsqueda" onfocus="this.value=''" onblur="this.value='Search something'">
                <button type="submit" class="btn btn-default">Buscar</button>
            </form>
        </div>
        <!-- /.widget -->
        <div class="sidebox widget">
            <h3 class="widget-title">Últimos Posts</h3>
            <ul class="post-list">
                <?php
                $comon = new Comon();
                $posts = $comon->getPosts(3);

                foreach ($posts as $post){
                    $imagen = "/uploads/posts/thumbnail/" . $post['portada'];
                    $titulo = $post['titulo'];
                    $friendly_url = $post['friendly_url'];
                    $fecha_publicacion = $post['fecha_publicacion'];

                    ?>

                    <li>
                        <div class="icon-overlay"> <a href="/post/<?php echo $friendly_url; ?>"><img src="<?php echo $imagen; ?>" alt="<?php echo $titulo; ?>" /> </a> </div>
                        <div class="meta">
                            <h5><a href="/post/<?php echo $friendly_url; ?>"><?php echo $titulo; ?></a></h5>
                            <em><span class="date"><?php echo $fecha_publicacion; ?></span> <span class="comentarios"><a href="/post/<?php echo $friendly_url; ?>"><i class="icon-chat-1"></i> 8</a></span></em> </div>
                    </li>

                    <?php
                }
                ?>
            </ul>
            <!-- /.post-list -->
        </div>
        <!-- /.widget -->

        <div class="sidebox widget">
            <h3 class="widget-title">Redes Sociales</h3>
            <p>También puedes seguir mis publicaciones en las redes sociales.</p>
            <ul class="social">
                <?php
                if($datos[0]['facebook'] != ""){
                    ?>
                    <li><a href="<?php echo $datos[0]['facebook']; ?>" target="_blank"><i class="icon-s-facebook"></i></a></li>
                    <?php
                }
                if($datos[0]['twitter'] != ""){
                    ?>
                    <li><a href="<?php echo $datos[0]['twitter']; ?>" target="_blank"><i class="icon-s-twitter"></i></a></li>
                    <?php
                }
                if($datos[0]['instagram'] != ""){
                    ?>
                    <li><a href="<?php echo $datos[0]['instagram']; ?>" target="_blank"><i class="icon-s-instagram"></i></a></li>
                    <?php
                }
                if($datos[0]['flickr'] != ""){
                    ?>
                    <li><a href="<?php echo $datos[0]['flickr']; ?>" target="_blank"><i class="icon-s-flickr"></i></a></li>
                    <?php
                }
                if($datos[0]['pinterest'] != ""){
                    ?>
                    <li><a href="<?php echo $datos[0]['pinterest']; ?>" target="_blank"><i class="icon-s-pinterest"></i></a></li>
                    <?php
                }
                if($datos[0]['linkedin'] != ""){
                    ?>
                    <li><a href="<?php echo $datos[0]['linkedin']; ?>" target="_blank"><i class="icon-s-linkedin"></i></a></li>
                    <?php
                }
                ?>
            </ul>
            <div class="clearfix"></div>
        </div>
        <!-- /.widget -->

        <div class="sidebox widget">
            <h3 class="widget-title">Categorías</h3>
            <ul class="circled">
                <?php
                $object = new BlogFront();
                $categorias_list = $object->getBlogCategories(1);

                foreach ($categorias_list as $categoria_objeto) {
                    $categoria_id = $categoria_objeto["id"];
                    $categoria_url = $categoria_objeto["friendly_url"];
                    $categoria_nombre = $categoria_objeto["nombre"];
                    $categoria_posts = $object->getNumberPosts($categoria_id);

                    ?>
                        <li><a href="/categoria-blog/<?php echo $categoria_url; ?>"><?php echo $categoria_nombre; ?> (<?php echo $categoria_posts[0]["cantidad"]; ?>)</a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <!-- /.widget -->

        <div class="sidebox widget">
            <h3 class="widget-title">Etiquetas</h3>
            <ul class="tag-list">
                <li><a href="#" class="btn">Web</a></li>
                <li><a href="#" class="btn">Photography</a></li>
                <li><a href="#" class="btn">Illustation</a></li>
                <li><a href="#" class="btn">Fun</a></li>
                <li><a href="#" class="btn">Blog</a></li>
                <li><a href="#" class="btn">Commercial</a></li>
                <li><a href="#" class="btn">Journal</a></li>
                <li><a href="#" class="btn">Nature</a></li>
                <li><a href="#" class="btn">Still Life</a></li>
            </ul>
        </div>
        <!-- /.widget -->

        <div class="sidebox widget">
            <h3 class="widget-title">Instagram</h3>
            <div class="image-grid col3">
                <div class="items-wrapper">
                    <div id="instafeed-widget" class="isotope items"></div>

                    <!--/.isotope -->
                </div>
                <!--/.items-wrapper -->
            </div>
            <!--/.image-grid -->
        </div>
        <!-- /.widget -->

    </aside>
    <!-- /column .sidebar -->

    </div>
    <!-- /.blog -->
</div>