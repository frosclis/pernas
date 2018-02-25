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
									<div class="dd-handle dd3-handle"></div><div class="dd3-content" onclick="addLink(<?php echo "'".$friendly_url. "'"; ?>, <?php echo "'".$pagina['titulo']. "'"; ?>, 0);"><?php echo $pagina['titulo']; ?></div>
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
									<div class="dd-handle dd3-handle"></div><div class="dd3-content" onclick="addLink(<?php echo "'".$friendly_url. "'"; ?>, <?php echo "'".$categoria['nombre']. "'"; ?>, 1);"><?php echo $categoria['nombre']; ?></div>
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
									<div class="dd-handle dd3-handle"></div><div class="dd3-content" onclick="addLink(<?php echo "'".$friendly_url. "'"; ?>, <?php echo "'".$galeria['titulo']. "'"; ?>, 2);"><?php echo $galeria['titulo']; ?></div>
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