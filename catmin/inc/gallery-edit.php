<?php

	if(isset($_GET['updated'])){
		$alert = '<div class="alert alert-success"><strong>¡Hecho!</strong> Página actualizada correctamente.</div>';
	}
	
	if($datos == ""){
		$alert = '<div class="alert alert-danger"><strong>¡Error!</strong> No hemos encontrado la página que buscas. Prueba a volver al menú y selecciona de nuevo la página.</div>';
	} else {
		$gallery_id = $datos['id'];
		$friendly_url = $datos['friendly_url'];
		$titulo = $datos['titulo'];
		$meta_description = $datos['meta_description'];
		$keywords = $datos['keywords'];
		$subtitulo = $datos['subtitulo'];
		$principal = $datos['principal'];
		$ultima_edicion = $datos['ultima_edicion'];
		$estado = $datos['estado'];
		$categoria = $datos['categoria'];
		if($estado == 1){
			$publicado = "checked";
		} else {
			$publicado = "";
		}
	}
	

	
?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
	<div class="page-title">
	  <div class="title_left">
		<h3>Editando <?php echo $titulo; ?></h3>
	  </div>

	  <div class="title_right">
		<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
		</div>
	  </div>
	</div>
	<div class="clearfix"></div>
	<div class="row">
	  <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
		  <div class="x_title">
			<h2>Última edición: <small><?php echo $ultima_edicion; ?></small></h2>
			<div class="clearfix"></div>
		  </div>
		  <div class="x_content">
			<?php if(isset($alert)){echo $alert;} ?>
			<br />
			<form data-parsley-validate class="form-horizontal form-label-left" method="post" action="" >
				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-12">
					  <div class="form-group">
						<label for="titulo">Título <span class="required">*</span>
						</label>
						<div>
						  <input type="text" id="titulo" name="titulo" required="required" value="<?php echo $titulo; ?>" class="form-control col-md-7 col-xs-12">
						  <input type="hidden" name="gallery_id" id="gallery_id" value="<?php echo $gallery_id; ?>" />
						</div>
					  </div>
					  <div class="form-group">
						<label  for="subtitulo">Subtítulo
						</label>
						<div >
						  <input type="text" id="subtitulo" name="subtitulo" value="<?php echo $subtitulo; ?>" class="form-control col-md-7 col-xs-12">
						</div>
					  </div>
					  <div class="form-group">
						<label  for="subtitulo">Categoría
						</label>
						<div >
						  <select class="select2_single form-control" id="categoria" name="categoria" tabindex="-1">
                            <option></option>
							<?php
								$gallery = new Gallery();
								$categorias = $gallery->getCategories(1);
								
								
								foreach($categorias as $categorie){
									$id = $categorie['id'];
									$nombre = $categorie['nombre'];
									if($categoria == $id){
										$check = "selected";
									} else {
										$check = "";
									}
									?>
										<option value="<?php echo $id; ?>" <?php echo $check; ?>><?php echo $nombre;?></option>
									<?php
								}
							?>
                          </select>
						</div>
					  </div>
					  <div class="form-group">
						<label  for="principal">Portada
						</label>
						<div >
						  <input type="text" id="principal" name="principal" value="<?php echo $principal; ?>" class="form-control col-md-7 col-xs-12">
						</div>
					  </div>
					  <div class="form-group">
						<label  for="friendly_url">URL <span class="required">*</span>
						</label>
						<div >
						  <input type="text" id="friendly_url" name="friendly_url" required="required" value="<?php echo $friendly_url; ?>" class="form-control col-md-7 col-xs-12">
						</div>
					  </div>
					  <div class="form-group">
						<label  for="meta_description">Meta-description 
						</label>
						<div >
						  <input type="text" id="meta_description" name="meta_description" value="<?php echo $meta_description; ?>" class="form-control col-md-7 col-xs-12">
						</div>
					  </div>
					  <div class="form-group">
						<label >Palabras Clave</label>
						<div >
						  <input id="tags_1" name="keywords" type="text" class="tags form-control" value="<?php echo $keywords; ?>" />
						  <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
						</div>
					  </div>
					  <div class="form-group">
						<label >Publicar</label>
						<div >
						  <div class="">
							<label>
							  <input type="checkbox" id="estado" name="estado" class="js-switch" value="1" <?php echo $publicado; ?> />
							</label>
						  </div>
						</div>
					  </div>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<form> </form>
						<div class="image_upload_div">
							<form id="mydropzone" class="dropzone">
							</form>
						</div>
					</div>
				</div>
			  <div class="ln_solid"></div>
				<div class="row">
				  <div class="clearfix"></div>
				  <div class="ln_solid"></div>
				  <div class="form-group">
					<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
					  <a href="/catmin/galleries.php"><button class="btn btn-primary" type="button">Cancelar</button></a>
					  <button id="updategallery" name="updategallery" type="submit" class="btn btn-success">Guardar</button>
					</div>
				  </div>
				</div>
			</form>
		  </div>
		</div>
	  </div>
	</div>
  </div>
</div>
<!-- /page content -->