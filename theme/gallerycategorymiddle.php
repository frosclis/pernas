<section id="conceptual" class="light-wrapper">
    <div class="container inner">
        <h3 class="section-title text-center">Categoría <?php echo $datos[1]["nombre"]; ?></h3>
        <p class="text-center"><?php echo $datos[1]["description"]; ?>.</p>
        <div class="divide20"></div>
        <div id="" class="image-grid col3">
            <div class="items-wrapper">
                <ul class="isotope items">
                <?php

                $galleries = new GalleriesFront();

                $galerias = $galleries->getGalleriesCategory($datos[1]["id"]);

                foreach ($galerias as $galeria) {

                    $galeria_url = $galeria["friendly_url"];
                    $galeria_titulo = $galeria["friendly_url"];
                    $galeria_principal = "/uploads/galleries/560/".$galeria["principal"];

                    ?>
                    <li class="item">
                        <figure class="icon-overlay"><a href="/galeria/<?php echo $galeria_url; ?>"><img src="<?php echo $galeria_principal; ?>" alt="<?php echo $galeria_titulo; ?>" /></a></figure>
                        <div class="slide-portfolio-item-info box">
                            <h4 class="post-title"><?php echo $galeria_titulo; ?></h4>
                        </div>
                    </li>
                    <?php
                }
                ?>
                </ul>

            </div>
            <!--/.cbp -->

        </div>
        <!--/.cbp-panel -->
    </div>
    <!-- /.container -->
</section>
<!-- /#conceptual -->