<?php
	if(isset($_GET['changed'])){
		$alert = '<div class="alert alert-success"><strong>¡Hecho!</strong> Contraseña cambiada correctamente.</div>';
	}
	
	if(isset($_GET['updated'])){
		$alert = '<div class="alert alert-success"><strong>¡Hecho!</strong> Perfil actualizado correctamente.</div>';
	}
	
	if(isset($_GET['updatedavatar'])){
		$alert = '<div class="alert alert-success"><strong>¡Hecho!</strong> Su imagen de perfil se ha actualizado correctamente.</div>';
	}
	
	if(isset($_SESSION['user']['avatar']) && $_SESSION['user']['avatar'] != ""){
		$avatar = "../uploads/avatar/" . $_SESSION['user']['avatar'];
	} else {
		$avatar = "../uploads/avatar/0.jpg";
	}

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
	<div class="page-title">
	  <div class="title_left">
		<h3><?php print $_SESSION['user']['fname'].' '.$_SESSION['user']['lname']; ?></h3>
	  </div>
	</div>
	
	<div class="clearfix"></div>

	<div class="row">
	  <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
		  <div class="x_content">
			<div class="col-md-3 col-sm-3 col-xs-12 profile_left">
			  <div class="profile_img">
				<div id="crop-avatar">
				  <!-- Current avatar -->
				  <img class="img-responsive avatar-view" src="<?php echo $avatar; ?>" alt="Avatar" title="<?php print $_SESSION['user']['fname'].' '.$_SESSION['user']['lname']; ?>">
				</div>
			  </div>
			  <h3>Cambia tu imagen</h3>

				<form action="" method="post" enctype="multipart/form-data">
					Elige tu imagen:
					<input type="file" name="file" id="file">
					<input type="button" class="btn btn-success" id="update-avatar" value="Enviar" name="submit">
					<input type="hidden" name="userid" id="userid" value="<?php echo $_SESSION['user']['id']; ?>" />
				</form>

			</div>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<?php if(isset($alert)){echo $alert;} ?>
				<div class="" role="tabpanel" data-example-id="togglable-tabs">
					<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
					  <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Perfil</a>
					  </li>
					  <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Contraseña</a>
					  </li>
					</ul>
					<div id="myTabContent" class="tab-content">
					  <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
						<?php if($_SESSION['user']['user_role'] == 2){
							foreach ($vars as $user) {
							?>
								<div class="form-group">
									<input type="text" name="nombre" id="nombre" class="form-control" value="<?=$user['fname']?>" placeholder="Nombre" >
									<input type="text" name="apellido" id="apellido" class="form-control" value="<?=$user['lname']?>" placeholder="Apellido" >
									<input type="email" name="email" id="email" class="form-control" value="<?=$user['email']?>" placeholder="E-mail" >
									<input type="hidden" name="userid" id="userid" value="<?=$user['id']?>" />
								</div>
							<?php
							}
						}else{ ?>
								<div class="form-group">
									<input type="text" name="nombre" id="nombre" class="form-control" value="<?=$_SESSION['user']['fname']?>" placeholder="Nombre" >
									<input type="text" name="apellido" id="apellido" class="form-control" value="<?=$_SESSION['user']['lname']?>" placeholder="Apellido" >
									<input type="email" name="email" id="email" class="form-control" value="<?=$_SESSION['user']['email']?>" placeholder="E-mail" >
									<input type="hidden" name="userid" id="userid" value="<?=$_SESSION['user']['id']?>" />
								</div>
						<?php } ?>
						<div class="form-group">
							<div class="row">
								<div class="col-sm-6 col-sm-offset-3">
									<input type="button" name="profile-update" id="profile-update" tabindex="4" class="btn btn-success" value="Actualizar">
								</div>
							</div>
						</div>
					  </div>
					  <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
						<div class="form-group">
							<input type="hidden" name="userid" id="userid" value="<?php echo $_SESSION['user']['id']; ?>" />
							<input type="password" name="password" id="password" tabindex="1" class="form-control" placeholder="Nueva Contraseña" >
						</div>
						<div class="form-group">
							<input type="password" name="password1" id="password1" tabindex="2" class="form-control" placeholder="Repita la Contraseña">
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-sm-6 col-sm-offset-3">
									<input type="button" name="pass-change" id="pass-change" tabindex="4" class="btn btn-success" value="Cambiar">
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
</div>
<!-- /page content -->