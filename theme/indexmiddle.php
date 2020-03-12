<div class="light-wrapper">
    <div class="container inner">
      <div class="thin">
        <h3 class="section-title text-center">Categorías Destacadas</h3>
        <p class="text-center">Estas son las tres categorías con más galerías pero tenemos muchas más, ¡échales un vistazo! </p>
      </div>
      <!-- /.thin -->
      <div class="divide10"></div>
      <div class="row">
		<?php
			$index = new Index();
			$categoriasIndex = $index->getGaleriasIndex();
			
			foreach($categoriasIndex as $categorie){
				$nombre = $categorie['nombre'];
				$frienfly_url = $categorie['friendly_url'];
				$id = $categorie['categoria'];
				
				$imagenCat = $index->getCategoryImage($id);
				$imagen = "/uploads/categories/440/".$imagenCat[0]['file_name'];
				
				?>
						<div class="col-sm-4">
						  <div class="caption-overlay">
							<figure><a href="/categoria-galerias/<?php echo $frienfly_url; ?>"><img src="<?php echo $imagen; ?>" alt="<?php echo $nombre; ?>" /> </a></figure>
							<div class="caption bottom-right">
							  <div class="title">
								<h3 class="main-title layer"><?php echo $nombre; ?></h3>
							  </div>
							  <!--/.title --> 
							</div>
							<!--/.caption --> 
						  </div>
						</div>
						<!-- /column -->
				<?php
			}
		?>

      </div>
      <!-- /.row --> 
      
    </div>
    <!-- /.container --> 
  </div>
  <!-- /.light-wrapper -->
  
  <div class="dark-wrapper">
    <div class="container inner">
      <div class="thin">
        <h3 class="section-title text-center">Últimas Galerías</h3>
        <p class="text-center">A continuación puedes ver un listado con mis últimos trabajos.</p>
      </div>
      <!-- /.thin -->
      <div class="divide10"></div>
      <div class="cbp-panel">
        <div id="js-filters-mosaic" class="cbp-filter-container text-center">
          <div data-filter="*" class="cbp-filter-item-active cbp-filter-item"> Todas </div>
		  <?php
			$categoriasFiltro = $index->getCategoriasIndex();
			
			foreach ($categoriasFiltro as $cat){
				$nombre = $cat['nombre'];
				?>
					<div data-filter=".<?php echo $nombre; ?>" class="cbp-filter-item"> <?php echo $nombre; ?> </div>
				<?php
			}
		  ?>
        </div>
        <div id="js-grid-mosaic" class="cbp">
		  <?php
			$galeriasMoisaic = $index->getGalerias();
			$contador = 1;
			foreach($galeriasMoisaic as $galerieMosaic){
				$url = $galerieMosaic['friendly_url'];
				$titulo = $galerieMosaic['titulo'];
				$imagenMosaic = "/uploads/galleries/560/".$galerieMosaic['principal'];
				$categoria_id = $galerieMosaic['categoria'];
				$categorieName = $index->GetCategorieName($categoria_id);
				$categorieFilter = $categorieName[0]['nombre'];
				
				?>
					<div id="item-mosaic-<?php echo $contador; ?>" class="cbp-item <?php echo $categorieFilter; ?>"> <a class="cbp-caption" href="/galeria/<?php echo $url;?>">
						<div class="cbp-caption-defaultWrap"> <img src="<?php echo $imagenMosaic; ?>" alt="<?php echo $titulo; ?>" /> </div>
						<div class="cbp-caption-activeWrap">
						  <div class="cbp-l-caption-alignCenter">
							<div class="cbp-l-caption-body">
							  <div class="cbp-l-caption-title"><span><?php echo $titulo; ?></span></div>
							</div>
						  </div>
						</div>
						<!--/.cbp-caption-activeWrap --> 
						</a>
					</div>
					  <!--/.cbp-item -->
				<?php
				$contador++;
			}
		  ?>
          
        </div>
        <!--/.cbp --> 
        
      </div>
      <!--/.cbp-panel -->
      <div class="divide30"></div>
    </div>
    <!-- /.container --> 
  </div>
  <!-- /.dark-wrapper -->
  
  <div class="light-wrapper">
    <div class="col-image">
      <div class="bg-wrapper col-md-6">
        <div class="bg-holder" style="background-image: url(/uploads/12909539_10156660282460487_5046713904011428184_o.jpg);"></div>
      </div>
      <!--/.bg-wrapper -->
      <div class="container">
        <div class="row">
          <div class="col-md-5 col-md-offset-7 inner-col">
            <h3 class="section-title">a little about me</h3>
            <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Donec ullamcorper nulla non metus auctor fringilla. Etiam porta sem malesuada magna mollis euismod.</p>
            <ul class="progress-list">
              <li>
                <p>Photoshop <em>90%</em></p>
                <div class="progress plain">
                  <div class="bar" data-width="90"></div>
                </div>
              </li>
              <li>
                <p>Final Cut <em>80%</em></p>
                <div class="progress plain">
                  <div class="bar" data-width="80"></div>
                </div>
              </li>
              <li>
                <p>Studio Photography <em>85%</em></p>
                <div class="progress plain">
                  <div class="bar" data-width="85"></div>
                </div>
              </li>
              <li>
                <p>Motion Video <em>75%</em></p>
                <div class="progress plain">
                  <div class="bar" data-width="75"></div>
                </div>
              </li>
            </ul>
            <!-- /.progress-list --> 
          </div>
          <!--/column --> 
        </div>
        <!--/.row --> 
      </div>
      <!--/.container --> 
    </div>
    <!--/.col-image --> 
    
  </div>
  <!-- /.light-wrapper -->
  
  <div class="dark-wrapper">
    <div class="container inner">
      <h3 class="section-title text-center">Mi blog</h3>
      <div class="divide10"></div>
      <div class="carousel-wrapper">
        <div class="carousel carousel-boxed blog">
			<?php
				$posts = $index->getPosts(6);
				
				foreach ($posts as $post){
					$id = $post['id'];
					$imagen = "/uploads/posts/440/" . $post['portada'];
					$cat_id = $post['categoria'];
					$catdata = $index->getCategorieBlogName($cat_id);
					$categoria = $catdata[0]['nombre'];
                    $color = $catdata[0]['color'];
					$titulo = $post['titulo'];
					$friendly_url = $post['friendly_url'];
					$fecha_publicacion = $post['fecha_publicacion'];
					$contenido = substr(strip_tags($post['contenido']), 0, 150);
					
					?>
						<div class="item post">
							<figure class="main"><img src="<?php echo $imagen; ?>" alt="<?php echo $titulo; ?>" /></figure>
							<div class="box text-center">
							  <div class="category <?php echo $color; ?>"><span><a href="/categoria-blog/<?php echo $categoria; ?>"><?php echo $categoria; ?></a></span></div>
							  <h4 class="post-title"><a href="/post/<?php echo $friendly_url; ?>"><?php echo $titulo; ?></a></h4>
							  <div class="meta"><span class="date"><?php echo $fecha_publicacion; ?></span><span class="comentarios"><a href="/post/<?php echo $friendly_url; ?>"><i class="icon-chat-1"></i> 15</a></span></div>
							  <p><?php echo $contenido; ?>...</p>
							</div>
							<!-- /.box --> 
							
						  </div>
						  <!-- /.post -->
					<?php
				}
			?>
          
          </div>
          <!-- /.post --> 
        </div>
        <!--/.carousel --> 
      </div>
      <!--/.carousel-wrapper --> 
    </div>
    <!--/.container --> 
    
  </div>
  <!-- /.dark-wrapper -->
  <div class="light-wrapper">
    <div class="container inner">
      <div class="row">
        <div class="col-sm-4 col-md-3">
          <h2>Instagram</h2>
          <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Duis mollis, est non commodo luctus, nisi erat. Nullam quis risus eget urna mollis ornare vel eu leo. Duis mollis, est non commodo.</p>
          <div class="divide10"></div>
          <a href="https://instagram.com/urbanshots/" class="btn btn-icon"><i class="icon-s-instagram"></i> Instagram Page</a> </div>
        <!--/column -->
        <div class="col-sm-8 col-md-9">
          <div class="image-grid col5">
            <div class="items-wrapper">
              <div id="instafeed" class="isotope items" data-limit="5"></div>
              
              <!--/.isotope --> 
            </div>
            <!--/.items-wrapper --> 
          </div>
          <!--/.image-grid --> 
        </div>
        <!--/column --> 
      </div>
      <!--/.row --> 
    </div>
    <!--/.container --> 
    
  </div>
  <!-- /.light-wrapper -->