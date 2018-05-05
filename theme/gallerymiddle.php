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
                                            <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
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
        </div>
    </div>
    <!-- /.container -->
</section>
<!-- /#conceptual -->