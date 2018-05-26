<div class="offset"></div>
<div id="map"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1xdEVYy8IZdBKJGQp_QpDWaNQT7ZHGhY&amp;sensor=false&amp;extension=.js"></script>
<script> google.maps.event.addDomListener(window, 'load', init);
    var map;
    function init() {
        var mapOptions = {
            center: new google.maps.LatLng(43.019302, -7.566494),
            zoom: 17,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.DEFAULT,
            },
            disableDoubleClickZoom: false,
            mapTypeControl: true,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
            },
            scaleControl: true,
            scrollwheel: false,
            streetViewControl: true,
            draggable : true,
            overviewMapControl: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            styles: [{stylers:[{saturation:-100},{gamma:1}]},{elementType:"labels.text.stroke",stylers:[{visibility:"off"}]},{featureType:"poi.business",elementType:"labels.text",stylers:[{visibility:"off"}]},{featureType:"poi.business",elementType:"labels.icon",stylers:[{visibility:"off"}]},{featureType:"poi.place_of_worship",elementType:"labels.text",stylers:[{visibility:"off"}]},{featureType:"poi.place_of_worship",elementType:"labels.icon",stylers:[{visibility:"off"}]},{featureType:"road",elementType:"geometry",stylers:[{visibility:"simplified"}]},{featureType:"water",stylers:[{visibility:"on"},{saturation:50},{gamma:0},{hue:"#50a5d1"}]},{featureType:"administrative.neighborhood",elementType:"labels.text.fill",stylers:[{color:"#333333"}]},{featureType:"road.local",elementType:"labels.text",stylers:[{weight:0.5},{color:"#333333"}]},{featureType:"transit.station",elementType:"labels.icon",stylers:[{gamma:1},{saturation:50}]}]
        }

        var mapElement = document.getElementById('map');
        var map = new google.maps.Map(mapElement, mapOptions);
        var locations = [
            ['Alba Pernas Fotografía', 43.019302, -7.566494]
        ];
        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                icon: '/theme/style/images/favicon.png',
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map
            });
        }
    }
</script>
<div class="light-wrapper">
    <div class="container inner">
        <div class="row">
            <div class="col-sm-8">
                <h2 class="section-title">Contacta conmigo</h2>
                <p>Si necesitas más información, quieres consultar disponibiliad de fechas, ver mis trabajos o pedir un presupuesto no dudes en ponerte en contacto conmigo a través de este formulario de contacto, por e-mail o teléfono. Sin ningún compromiso.</p>
                <div class="divide10"></div>
                <div class="form-container">
                    <form action="contact/vanilla-form.php" method="post" class="vanilla vanilla-form" novalidate="novalidate">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-field">
                                    <label>
                                        <input type="text" name="name" placeholder="tu nombre" required="required">
                                    </label>
                                </div>
                                <!--/.form-field -->
                            </div>
                            <!--/column -->
                            <div class="col-sm-6">
                                <div class="form-field">
                                    <label>
                                        <input type="email" name="email" placeholder="Tu e-mail" required="required">
                                    </label>
                                </div>
                                <!--/.form-field -->
                            </div>
                            <!--/column -->
                            <div class="col-sm-6">
                                <div class="form-field">
                                    <label>
                                        <input type="tel" name="tel" placeholder="Teléfono">
                                    </label>
                                </div>
                                <!--/.form-field -->
                            </div>
                            <!--/column -->
                        </div>
                        <!--/.row -->
                        <textarea name="message" placeholder="Escribe aquí tu consulta" required="required"></textarea>
                        <div class="radio-set">
                            <input class="checkbox-pernas" type="checkbox" value="" name="agree" required="required"> Acepto los <a href="/terminos-y-condiciones">Términos y Condiciones</a>
                        </div>
                        <!--/.radio-set -->
                        <input type="submit" class="btn" value="Enviar" data-error="Hay errores" data-processing="Enviando..." data-success="¡Gracias!">
                        <footer class="notification-box"></footer>
                    </form>
                    <!--/.vanilla-form -->
                </div>
                <!--/.form-container -->

            </div>
            <!--/column -->

            <aside class="col-sm-4">
                <div class="sidebox widget">
                    <h3 class="widget-title">Dirección</h3>
                    <p>Puedes contactar conmigo desde nuestro formulario, teléfono, e-mail o visitándome en mi local.</p>
                    <address>
                        <strong><?php echo $datos[0]['nombre_web']; ?></strong><br>
                        <?php echo $datos[0]['direccion']; ?><br>
                        <abbr title="Teléfono">T:</abbr> <?php echo $datos[0]['telefono']; ?> <br>
                        <abbr title="E-mail">E:</abbr> <a href="mailto:<?php echo $datos[0]['email']; ?>"><?php echo $datos[0]['email']; ?></a>
                    </address>
                </div>
                <!-- /.widget -->

            </aside>
            <!--/column -->

        </div>
        <!--/.row -->

    </div>
    <!--/.container -->
</div>
<!--/.light-wrapper -->