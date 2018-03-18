<footer class="footer inverse-wrapper">
    <div class="container inner">
      <div class="row">
        <div class="col-sm-4">
          <div class="widget">
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
        </div>
        <!-- /column -->
        
        <div class="col-sm-4">
          <div class="widget">
            <h4 class="widget-title">Etiquetas</h4>
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
          
          <div class="widget">
            <h4 class="widget-title">Redes Sociales</h4>
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
            <!-- .social --> 
            
          </div>
        </div>
        <!-- /column -->
        
        <div class="col-sm-4">
          <div class="widget">
            <h4 class="widget-title">Buscar</h4>
            <form class="searchform" method="get">
              <input type="text" id="s2" name="s" value="Tu Búsqueda" onfocus="this.value=''" onblur="this.value='Search something'">
              <button type="submit" class="btn btn-default">Buscar</button>
            </form>
          </div>
          <!-- /.widget -->
          <div class="widget">
            <h4 class="widget-title">Contacto</h4>
            <p>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p>
            <div class="contact-info"> <i class="icon-location"></i> <?php echo $datos[0]['direccion']; ?> <br />
              <i class="icon-phone"></i><?php echo $datos[0]['telefono']; ?> <br />
              <i class="icon-mail"></i> <a href="mailto:<?php echo $datos[0]['email']; ?>"><?php echo $datos[0]['email']; ?></a> </div>
          </div>
          <!-- /.widget --> 
          
        </div>
        <!-- /column --> 
        
      </div>
      <!-- /.row --> 
    </div>
    <!-- .container -->
    
    <div class="sub-footer">
      <div class="container inner">
        <p class="text-center">&copy; 2017 <?php echo $datos[0]['nombre_web']; ?>. Todos los derechos reservados.</p>
      </div>
      <!-- .container --> 
    </div>
    <!-- .sub-footer --> 
  </footer>
  <!-- /footer --> 
  
</main>
<!--/.body-wrapper --> 
<script src="/theme/style/js/jquery.min.js"></script>
<script src="/theme/style/js/bootstrap.min.js"></script>
<script src="/theme/style/js/plugins.js"></script>
<script src="/theme/style/js/classie.js"></script>
<script src="/theme/style/js/jquery.themepunch.tools.min.js"></script>
<script src="/theme/style/js/scripts.js"></script>
</body>
</html>