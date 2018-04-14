<div class="container inner2">
    <h3 class="section-title text-center">Mis galerías</h3>
    <p class="text-center">Desde esta sección puedes acceder a las diferentes categorías de la galería, ¡espero que os gusten!</p>
    <div class="divide30"></div>
    <div id="" class="image-grid col3">
        <div class="items-wrapper">
            <ul class="isotope items">
                <?php
                if($datos[1] == false) {
                    ?>
                    <div class="col-md-12 col-sm-12 grid-view-post">
                        <div class="post">
                            <div class="box text-center">
                                <h4 class="post-title"><a href="/">No existen categorías actualmente.</a></h4>
                                <p><a href="/">Volver a la página principal.</a></p>
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>
                    <?php
                } else {
                    foreach ($datos as $categoria){
                        if(isset($categoria["friendly_url"])) {
                            $id_categoria = $categoria["id"];
                            $nombre_categoria = $categoria["nombre"];
                            $url_categoria = $categoria["friendly_url"];
                            $descripcion_categoria = $categoria["description"];

                            $object = new GalleriesFront();
                            $categoriaImagen = $object->getCategoryImage($id_categoria);

                            $imagenCategoria = "/uploads/categories/440/".$categoriaImagen[0]['file_name'];

                            ?>
                            <li class="item">
                                <figure class="icon-overlay"><a href="/categoria-galerias/<?php echo $url_categoria; ?>"><img src="<?php echo $imagenCategoria; ?>" alt="<?php echo $descripcion_categoria; ?>" /></a></figure>
                                <div class="slide-portfolio-item-info box">
                                    <h4 class="post-title"><?php echo $nombre_categoria; ?></h4>
                                </div>
                            </li>
                            <?php
                        }
                    }
                }
                ?>
            </ul>
        </div>
        <!--/.items-wrapper -->
    </div>
    <!-- slide-portfolio -->

</div>
<!-- /.container -->