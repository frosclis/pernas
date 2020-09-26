<section id="gallerie-page" class="light-wrapper">
    <div class="container inner">
        <h3 class="section-title text-center"><?php echo $datos["titulo"]; ?></h3>
        <p class="text-center"><?php echo $datos["subtitulo"]; ?></p>
        <div class="divide20"></div>
        <div class="cbp-panel">
            <div class="cbp cbp-onepage-grid">
                <?php
                    foreach ($datos["imagenes"] as $imagen) {
                        ?>
                        <div class="cbp-item">
                            <a class="cbp-caption fancybox-media" data-rel="portfolio" href="/uploads/galleries/1080/<?php echo $imagen["file_name"]; ?>">
                                <div class="cbp-caption-defaultWrap"> <img src="/uploads/galleries/560/<?php echo $imagen["file_name"]; ?>" alt="<?php echo $datos["titulo"]; ?>" /> </div>
                                <div class="cbp-caption-activeWrap">
                                    <div class="cbp-l-caption-alignCenter">
                                        <div class="cbp-l-caption-body">
                                            <div class="cbp-l-caption-title"></div>
                                        </div>
                                    </div>
                                </div>
                                <!--/.cbp-caption-activeWrap -->
                            </a>
                        </div>
                        <!--/.cbp-item -->
                        <?php
                    }
                ?>
            </div>
            <div class="divide30"></div>
            <div class="box">
                <div id="disqus_thread"></div>
                <script>                  
                var disqus_config = function () {
                    this.page.url = "<?php echo $datos[0]['full_url']; ?>";
                    this.page.identifier = "2000<?php echo $datos['id']; ?>";
                };
                (function() {
                    var d = document, s = d.createElement('script');
                    s.src = 'https://albapernasfotografia.disqus.com/embed.js';
                    s.setAttribute('data-timestamp', +new Date());
                    (d.head || d.body).appendChild(s);
                })();
                </script>
                <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
            </div>
        </div>
    </div>
    <!-- /.container -->
</section>
<!-- /#conceptual -->