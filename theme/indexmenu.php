<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav">
        <?php
			$index = new Index();
			$menus = $index->getMenus(0);

        foreach ($menus as $menu) {
            $current = "";
            $id = $menu['id'];
            $name = $menu['name'];
            $url = $menu['url'];

            if($vars == $name){
            $current = "current";
        }

        $submenus = $index->getMenus($id);

            if($submenus){
            ?>
            <li class="<?php echo $current; ?> dropdown"><a data-target="<?php echo $url; ?>" href="<?php echo $url; ?>" class="dropdown-toggle js-activated" data-toggle="dropdown"><?php echo $name; ?> <span class="caret"></span></a>
            <?php
            echo "<ul class='dropdown-menu'>";
                foreach ($submenus as $menu2){
                $subid = $menu2['id'];
                $subname = $menu2['name'];
                $suburl = $menu2['url'];
                $subposition = $menu2['position'];
                $subfather = $menu2['father'];

                ?>
                <li><a href="<?php echo $suburl; ?>"><?php echo $subname; ?></a></li>
                <?php
						}
						echo "</ul>";
                } else {
                    ?>
                        <li class="<?php echo $current; ?>"><a href="<?php echo $url; ?>"><?php echo $name; ?></a>
                    <?php
                }
                echo "</li>";
                }
                ?>
            </ul>
            <!-- /.navbar-nav -->
</div>
<!-- /.navbar-collapse -->
<div class="social-wrapper">
    <ul class="social naked">
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
    <!-- /.social -->
</div>
<!-- /.social-wrapper -->
</nav>
<!-- /.navbar -->

<div class="tp-fullscreen-container revolution">
    <div class="tp-fullscreen">
        <ul>
            <?php
			$sliders = $index->getSliders();

            foreach($sliders as $slider){
            $id = $slider['id'];
            $titulo = $slider['titulo'];
            $subtitulo = $slider['subtitulo'];
            $contenido = $slider['contenido'];

            $imagenfetch = $index->getSliderImage($id);
            $imagen = "/uploads/sliders/".$imagenfetch[0]['file_name'];
            ?>
            <li data-transition="fade"> <img src="<?php echo $imagen; ?>"  alt="<?php echo $titulo; ?>" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat" />
                <h1 class="tp-caption large sfr" data-x="30" data-y="263" data-speed="900" data-start="800" data-easing="Sine.easeOut"><?php echo $titulo; ?></h1>
                <div class="tp-caption medium sfr" data-x="30" data-y="348" data-speed="900" data-start="1500" data-easing="Sine.easeOut"><a href="<?php echo $contenido; ?>"><?php echo $subtitulo; ?></a></div>
            </li>
            <?php
			}
		?>
        </ul>
        <div class="tp-bannertimer tp-bottom"></div>
    </div>
    <!-- /.tp-fullscreen-container -->
</div>
<!-- /.revolution -->