<?php
		

	

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
	<div class="page-title">
	  <div class="title_left">
		<h3>Menú Principal</h3>
	  </div>
	</div>
	
	<div class="clearfix"></div>

	<div class="row">
		<div class="col-md-6 col-sm-6 col-xs-6">
			<div class="dd">
				<h4>Personalizada:</h4>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">Título</span>
					</div>
					<input type="text" class="form-control" id="customTITLE" placeholder="Título" aria-label="Título" aria-describedby="basic-addon1">
				</div>

				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">URL</span>
					</div>
					<input type="text" class="form-control" id="customURL" placeholder="URL" aria-label="URL" aria-describedby="basic-addon1">
				</div>
				<div class="options">
					<span class="custom_add" style="color:green; position:absolute; float: right; top: 5%; right: 5%; cursor: pointer;">
						<i class="fa fa-plus-circle" aria-hidden="true"></i>
					</span>
				</div>
				<h4>Páginas:</h4>
				<ol class="dd-list">
					<?php
						$dashboard = new Dashboard();
						$paginas = $dashboard->getPaginas();
						foreach($paginas as $pagina){
							
							if(!isset($pagina['friendly_url']) || $pagina['friendly_url'] == ""){
								$friendly_url = "sinlink";
							} else {
								$friendly_url = $pagina['friendly_url'];
							}
							?>
								<li class="dd-item dd3-item">
									<div class="dd-handle dd3-handle"></div><div class="dd3-content"><?php echo $pagina['titulo']; ?></div>
									<div class="options">
										<span class="add" style="color:green; position:absolute; float: right; top: 5%; right: 5%;" data-url="<?php echo $friendly_url;?>" data-title="<?php echo $pagina['titulo']; ?>" data-type=0>
											<i class="fa fa-plus-circle" aria-hidden="true"></i>
										</span>
									</div>
								</li>
							<?php
						}
					?>
				</ol>
				<h4>Categorías (Galerías):</h4>
				<ol class="dd-list">
					<?php
						$categorias = $dashboard->getCategories();
						foreach($categorias as $categoria){
							if(!isset($categoria['friendly_url']) || $categoria['friendly_url'] == ""){
								$friendly_url = "sinlink";
							} else {
								$friendly_url = $categoria['friendly_url'];
							}
							
							?>
								<li class="dd-item dd3-item">
									<div class="dd-handle dd3-handle"></div><div class="dd3-content"><?php echo $categoria['nombre']; ?></div>
									<div class="options">
										<span class="add" style="color:green; position:absolute; float: right; top: 5%; right: 5%;" data-url="<?php echo $friendly_url;?>" data-title="<?php echo $categoria['nombre']; ?>" data-type=1>
											<i class="fa fa-plus-circle" aria-hidden="true"></i>
										</span>
									</div>
								</li>
							<?php
						}
					?>
				</ol>
				<h4>Galerías:</h4>
				<ol class="dd-list">
					<?php
						$galerias = $dashboard->getGalerias();
						foreach($galerias as $galeria){
							
							if(!isset($galeria['friendly_url']) || $galeria['friendly_url'] == ""){
								$friendly_url = "sinlink";
							} else {
								$friendly_url = $galeria['friendly_url'];
							}
							?>
								<li class="dd-item dd3-item">
									<div class="dd-handle dd3-handle"></div><div class="dd3-content"><?php echo $galeria['titulo']; ?></div>
									<div class="options">
										<span class="add" style="color:green; position:absolute; float: right; top: 5%; right: 5%;" data-url="<?php echo $friendly_url;?>" data-title="<?php echo $galeria['titulo']; ?>" data-type=2>
											<i class="fa fa-plus-circle" aria-hidden="true"></i>
										</span>
									</div>
								</li>
							<?php
						}
					?>
				</ol>
			</div>
		</div>
	  <div class="col-md-6 col-sm-6 col-xs-6">
		<h4>Menú:</h4>
		<div class="dd" id="nestable3">
            <ol class="dd-list" id="addlist">
			
				<?php
					foreach ($datos as $menu){
						$id = $menu['id'];
						$name = $menu['name'];
						$url = $menu['url'];
						$position = $menu['position'];
						$father = $menu['father'];
						
						
						?>
						<li class="dd-item dd3-item" data-id="<?php echo $id; ?>">
							<div class="dd-handle dd3-handle"></div><div class="dd3-content"><?php echo $name; ?></div>
							<div class="options">
								<span class="remove" style="color:red; position:absolute; float: right; top: 5%; right: 5%;" data-id="<?php echo $id;?>">
									<i class="fa fa-minus-circle" aria-hidden="true"></i>
								</span>
							</div>
							<?php
								$menus = $dashboard->getMenus($id);
								if($menus){
									echo "<ol class='dd-list'>";
									foreach ($menus as $menu2){
										$subid = $menu2['id'];
										$subname = $menu2['name'];
										$suburl = $menu2['url'];
										$subposition = $menu2['position'];
										$subfather = $menu2['father'];
										
										?>
											<li class="dd-item dd3-item" data-id="<?php echo $subid; ?>">
												<div class="dd-handle dd3-handle"></div><div class="dd3-content"><?php echo $subname; ?></div>
												<div class="options">
													<span class="remove" style="color:red; position:absolute; float: right; top: 5%; right: 5%;" data-id="<?php echo $subid;?>">
														<i class="fa fa-minus-circle" aria-hidden="true"></i>
													</span>
												</div>
												<?php
													$menus2 = $dashboard->getMenus($subid);
													if($menus2){
														echo "<ol class='dd-list'>";
														foreach ($menus2 as $menu3){
															$subid2 = $menu3['id'];
															$subname2 = $menu3['name'];
															$suburl2 = $menu3['url'];
															$subposition2 = $menu3['position'];
															$subfather2 = $menu3['father'];
															
															?>
																<li class="dd-item dd3-item" data-id="<?php echo $subid2; ?>">
																	<div class="dd-handle dd3-handle"></div><div class="dd3-content"><?php echo $subname2; ?></div>
																	<div class="options">
																		<span class="remove" style="color:red; position:absolute; float: right; top: 5%; right: 5%;" data-id="<?php echo $subid2;?>">
																			<i class="fa fa-minus-circle" aria-hidden="true"></i>
																		</span>
																	</div>
																</li>
															<?php
														}
														echo "</ol>";
													}
												?>
											</li>
										<?php
									}
									echo "</ol>";
								}
							?>
						</li>
						<?php
					} 		
				?>
            </ol>
        </div>
	  </div>
	</div>
  </div>
</div>
<!-- /page content -->