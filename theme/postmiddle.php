<div class="container inner2">
    <div class="blog row">
        <div class="col-sm-8 blog-content">
            <div class="blog-posts classic-view">
                <div class="post">
                    <div class="box text-center">
                        <div class="category <?php echo $datos['color']; ?>"><span><a href="/categoria-blog/<?php echo $datos['friendly_url']; ?>"><?php echo $datos['nombre']; ?></a></span></div>
                        <h1 class="post-title"><?php echo $datos['titulo']; ?></h1>
                        <div class="meta"><span class="date"><?php echo $datos['fecha_publicacion']; ?></span><span class="comments"><a href="#"><i class="icon-chat-1"></i> 15</a></span></div>
                        <figure class="main"><img src="/uploads/posts/770/<?php echo $datos['portada']; ?>" alt="<?php echo $datos['titulo']; ?>" /></figure>
                        <div class="post-content text-left">
                            <?php echo $datos['contenido'] ?>
                        </div>
                        <!-- /.post-content -->
                        <div class="post-footer">
                            <div class="meta tags pull-left"></div>
                            <ul class="social naked pull-right">
                                <li><a href="http://www.facebook.com/sharer.php?u=<?php echo $datos[0]['full_url']; ?>" target="_blank"><i class="icon-s-facebook"></i></a></li>
                                <li><a href="https://twitter.com/share?url=<?php echo $datos[0]['full_url']; ?>&amp;text=<?php echo $datos['titulo']; ?>" target="_blank"><i class="icon-s-twitter"></i></a></li>
                                <li><a href="http://pinterest.com/pin/create/button/?url=<?php echo $datos[0]['full_url']; ?>&media=/uploads/posts/770/<?php echo $datos['portada']; ?>&description=<?php echo $datos['titulo']; ?>" class="pin-it-button" count-layout="horizontal" target="_blank"><i class="icon-s-pinterest"></i></a></li>
                                <li><a href="https://plus.google.com/share?url=<?php echo $datos[0]['full_url']; ?>" target="_blank"><i class="icon-s-gplus"></i></a></li>
                            </ul>
                            <!-- .social -->
                            <div class="clearfix"></div>
                        </div>
                        <!-- .post-footer -->
                    </div>
                    <!-- /.box -->

                </div>
                <!-- .post -->

                <!-- /.box -->
                <div class="divide30"></div>
                <div class="box">
                    <div id="disqus_thread"></div>
                    <!-- Aquí el disquss -->
                </div>
                <!-- /.box -->

            </div>
            <!-- /.classic-view -->

        </div>
        <!-- /.blog-content -->