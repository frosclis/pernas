<?php
		
	if(isset($_GET['updated'])){
		$alert = '<div class="alert alert-success"><strong>¡Hecho!</strong> Opciones actualizadas correctamente.</div>';
	}
	
	if(isset($_GET['updatedavatar'])){
		$alert = '<div class="alert alert-success"><strong>¡Hecho!</strong> El logo se ha actualizado correctamente.</div>';
	}
	

	$avatar = "../uploads/logo.png";
	
	$nombre_web = $datos[0]['nombre_web'];
	$email = $datos[0]['email'];
	$description = $datos[0]['description'];
	$direccion = $datos[0]['direccion'];
	$telefono = $datos[0]['telefono'];
	$longitud = $datos[0]['longitud'];
	$latitud = $datos[0]['latitud'];
	$facebook = $datos[0]['facebook'];
	$twitter = $datos[0]['twitter'];
	$instagram = $datos[0]['instagram'];
	$flickr = $datos[0]['flickr'];
	$pinterest = $datos[0]['pinterest'];
	$linkedin = $datos[0]['linkedin'];
	$mantenimiento = $datos[0]['mantenimiento'];
	if($mantenimiento == 1){
		$publicado = "checked";
	} else {
		$publicado = "";
	}

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
	<div class="page-title">
	  <div class="title_left">
		<h3>Opciones generales</h3>
	  </div>
	</div>
	
	<div class="clearfix"></div>

	<div class="row">
	  <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
		  <div class="x_content">
			<div class="col-md-3 col-sm-3 col-xs-12 profile_left">
				<div class="x_panel">
                  <div class="x_title">
                    <h2>Logo</h2>
					<div class="clearfix"></div>
                  </div>
				  <div class="x_content">
					  <div class="profile_img">
						<div id="crop-avatar">
						  <!-- Current avatar -->
						  <img class="img-responsive avatar-view" src="<?php echo $avatar; ?>" alt="Avatar" title="Logo Página">
						</div>
					  </div>
					  <br/><br/>
					  <div class="x_title">
						<h2>Cambia tu imagen <small>Se sobreescribe la anterior</small></h2>
						<div class="clearfix"></div>
					  </div>

						<form action="" method="post" enctype="multipart/form-data">
							Elige tu imagen:
							<input type="file" name="file" id="file">
							<input type="button" class="btn btn-success" id="update-logo" value="Enviar" name="submit">
						</form>
					</div>
                </div>
			</div>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<?php if(isset($alert)){echo $alert;} ?>
				<div class="x_panel">
                  <div class="x_title">
                    <h2>Datos básicos <small>Configuración</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <div class="form-horizontal form-label-left input_mask">

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input class="form-control has-feedback-left" id="nombre_web" placeholder="Nombre de la página" type="text" value="<?php echo $nombre_web; ?>">
                        <span class="fa fa-copyright form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input class="form-control" id="description" placeholder="Descripción de la página" type="text" value="<?php echo $description; ?>">
                        <span class="fa fa-comment form-control-feedback right" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input class="form-control has-feedback-left" id="email" placeholder="Email" type="text" value="<?php echo $email; ?>">
                        <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input class="form-control" id="telefono" placeholder="Teléfono" type="text" value="<?php echo $telefono; ?>">
                        <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                      </div>
					  
					  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input class="form-control has-feedback-left" id="direccion" placeholder="Dirección" type="text" value="<?php echo $direccion; ?>">
                        <span class="fa fa-home form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-3 col-sm-3 col-xs-6 form-group has-feedback">
                        <input class="form-control" id="longitud" placeholder="Longitud" type="text" value="<?php echo $longitud; ?>">
                        <span class="fa fa-map-marker form-control-feedback right" aria-hidden="true"></span>
                      </div>
					  
					  <div class="col-md-3 col-sm-3 col-xs-6 form-group has-feedback">
                        <input class="form-control" id="latitud" placeholder="Latitud" type="text" value="<?php echo $latitud; ?>">
                        <span class="fa fa-map-marker form-control-feedback right" aria-hidden="true"></span>
                      </div>
					  
					  <div class="x_title">
						<h2>Redes sociales <small>Si no se rellenan no se muestran</small></h2>
						<div class="clearfix"></div>
					  </div>
					  
					  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input class="form-control has-feedback-left" id="facebook" placeholder="Link a perfil de Facebook" type="text" value="<?php echo $facebook; ?>">
                        <span class="fa fa-facebook form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input class="form-control" id="twitter" placeholder="Link a perfil de Twitter" type="text" value="<?php echo $twitter; ?>">
                        <span class="fa fa-twitter form-control-feedback right" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input class="form-control has-feedback-left" id="instagram" placeholder="Link a perfil de Instagram" type="text" value="<?php echo $instagram; ?>">
                        <span class="fa fa-instagram form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input class="form-control" id="flickr" placeholder="Link a perfil de Flickr" type="text" value="<?php echo $flickr; ?>">
                        <span class="fa fa-flickr form-control-feedback right" aria-hidden="true"></span>
                      </div>
					  
					  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input class="form-control has-feedback-left" id="pinterest" placeholder="Link a perfil de Pinterest" type="text" value="<?php echo $pinterest; ?>">
                        <span class="fa fa-pinterest form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input class="form-control" id="linkedin" placeholder="Link a perfil de Linkedin" type="text" value="<?php echo $linkedin; ?>">
                        <span class="fa fa-linkedin form-control-feedback right" aria-hidden="true"></span>
                      </div>
                      
					  <div class="clearfix"></div>
					  
					  <div class="x_title">
						<h2>Mantenimiento <small>Para realizar labores de administración</small></h2>
						<div class="clearfix"></div>
					  </div>
					  
					  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="checkbox" id="mantenimiento" name="mantenimiento" class="js-switch" value="1" <?php echo $publicado; ?> />
                      </div>
					  
					  <div class="clearfix"></div>
					  
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-5">
						  <a href="/catmin/dashboard.php"><button class="btn btn-primary" type="button">Cancelar</button></a>
						  <button id="options-update" class="btn btn-success">Guardar</button>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
			</div>
		  </div>
		</div>
	  </div>
	</div>
  </div>
</div>
<!-- /page content -->