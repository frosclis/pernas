<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav">
        <?php
        $comon = new Comon();
        $menus = $comon->getMenus(0);

        foreach ($menus as $menu) {
        $current = "";
        $id = $menu['id'];
        $name = $menu['name'];
        $url = $menu['url'];

        if($vars == $name){
            $current = "current";
        }

        $submenus = $comon->getMenus($id);

        if($submenus){
            ?>
        <li class="<?php echo $current; ?> dropdown"><a href="<?php echo $url; ?>" class="dropdown-toggle js-activated" data-toggle="dropdown"><?php echo $name; ?> <span class="caret"></span></a>
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

<div class="post-parallax parallax inverse-wrapper parallax1" style="background-image: url(<?php echo $datos[0]['principal']; ?>);">
    <div class="container inner text-center">
        <div class="headline text-center">
            <h2><?php echo $vars; ?></h2>
            <p class="lead"><?php echo $datos[0]['subtitulo']; ?></p>
        </div>
        <!-- /.headline -->
    </div>
    <!--/.container -->
</div>