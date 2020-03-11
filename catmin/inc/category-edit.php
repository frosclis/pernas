<?php

	if(isset($_GET['updated'])){
		$alert = '<div class="alert alert-success"><strong>¡Hecho!</strong> Categoría actualizada correctamente.</div>';
	}
	
	if($datos == ""){
		$alert = '<div class="alert alert-danger"><strong>¡Error!</strong> No hemos encontrado la categoría que buscas. Prueba a volver al menú y selecciona la de nuevo.</div>';
	} else {
		$categoria_id = $datos['id'];
		$friendly_url = $datos['friendly_url'];
		$categoria_nombre = $datos['nombre'];
		$categoria_description = $datos['description'];
		$keywords = $datos['keywords'];
		$categoria_padre = $datos['padre'];
		$ultima_edicion = $datos['ultima_edicion'];
		$estado = $datos['estado'];
		$imagenes = $datos['imagenes'];
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
		<h3>Editando <?php echo $categoria_nombre; ?></h3>
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
						<label for="categoria_nombre">Título <span class="required">*</span>
						</label>
						<div>
						  <input type="text" id="categoria_nombre" name="categoria_nombre" required="required" value="<?php echo $categoria_nombre; ?>" class="form-control col-md-7 col-xs-12">
						  <input type="hidden" name="categoria_id" id="categoria_id" value="<?php echo $categoria_id; ?>" />
						</div>
					  </div>
					  <div class="form-group">
						<label  for="padre">Categoría Padre
						</label>
						<div >
						  <input type="text" id="padre" name="padre" value="<?php echo $categoria_padre; ?>" class="form-control col-md-7 col-xs-12">
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
						<label  for="categoria_description">Meta-description 
						</label>
						<div >
						  <input type="text" id="categoria_description" name="categoria_description" value="<?php echo $categoria_description; ?>" class="form-control col-md-7 col-xs-12">
						</div>
					  </div>
					  <div class="form-group">
						<label for="tags_1">Palabras Clave</label>
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
						<ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#images_div">Imágenes</a></li>
							<li><a data-toggle="tab" href="#image_upload_div">Subir</a></li>
						</ul>
						<div class="tab-content">
							<div id="images_div" class="tab-pane fade in active image_upload_div dd">
								<ol class="dd-list">
									<?php
										if ($imagenes){
											foreach($imagenes as $imagen){
												?>
													<li class="dd-item" data-id="<?php echo $imagen['id'];?>">
														<div class="dd-handle" style="height: auto;">
															<img src="../uploads/categories/thumbnail/<?php echo $imagen['file_name'];?>"/>
														</div>
														<div class="options">
															<span class="remove" style="color:red; position:absolute; float: right; top: 5%; right: 5%;" data-id="<?php echo $imagen['id'];?>" data-file="<?php echo $imagen['file_name'];?>">
																<i class="fa fa-minus-circle" aria-hidden="true"></i>
															</span>
														</div>
													</li>
												<?php
											}
										}
									?>
								</ol>
							</div>
							<form> </form>
							<div id="image_upload_div" class="tab-pane fade image_upload_div">
								<form id="mydropzone" class="dropzone">
								</form>
							</div>
						</div>
					</div>
				</div>
			  <div class="ln_solid"></div>
				<div class="row">
				  <div class="form-group">
					<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
					  <a href="/catmin/categories.php"><button class="btn btn-primary" type="button">Cancelar</button></a>
					  <button id="updatecategory" name="updatecategory" type="submit" class="btn btn-success">Guardar</button>
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