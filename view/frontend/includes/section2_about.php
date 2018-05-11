<section id="about">
    <div class="box">
        <h2 class="section-title">Qui suis-je ?</h2>
        <div class="row">
            <div class="col-md-3 col-md-push-9 col-sm-4 col-sm-push-4 col-xs-4 col-xs-push-4">
                <figure>
                    <img src="public/images/Philippe.jpeg" alt="" />
                </figure>
            </div>
            <div class="col-md-9 col-md-pull-3 col-sm-12 col-xs-12">
                <p class="lead">Depuis plusieurs années, je m'intéresse aux nouvelles technologies et me suis découvert une passion pour le développement. Travaillant en autodidacte depuis 2016 sur différents aspects du web, j'ai rejoint courant avril 2017 un cursus de 3mois en développement chez G2R Formation à Paris avant d'effectuer un stage durant juillet-août.
                <br> Je suis, aujourd'hui, en formation "Développeur d'applications PHP/Symfony" avec Openclassrooms ( formation du 11 décembre 2017 au 11 décembre 2018).</p>
                <p class="lead">Je suis aujourd'hui disponible pour un contrat ou une mission en région parisienne.</p>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="divide40"></div>
        <h2 class="section-title"></h2>
        <div class="divide10"></div>
        <div class="services-1">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="section-title"></h3>
                    <div id="map"></div>
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1xdEVYy8IZdBKJGQp_QpDWaNQT7ZHGhY&sensor=false&extension=.js"></script>
                    <script>
                        google.maps.event.addDomListener(window, 'load', init);
                        var map;

                        function init() {
                            var mapOptions = {
                                center: new google.maps.LatLng(48.884247, 2.343017)
                                , zoom: 12
                                , zoomControl: true
                                , zoomControlOptions: {
                                            style: google.maps.ZoomControlStyle.DEFAULT
                                , }
                                , disableDoubleClickZoom: false
                                , mapTypeControl: true
                                , mapTypeControlOptions: {
                                    style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
                                , }
                                , scaleControl: true
                                , scrollwheel: false
                                , streetViewControl: true
                                , draggable: true
                                , overviewMapControl: false
                                , mapTypeId: google.maps.MapTypeId.ROADMAP
                                , styles: [{
                                    stylers: [{
                                        saturation: -100
                                    }, {
                                        gamma: 1
                                    }]
                                }, {
                                    elementType: "labels.text.stroke"
                                    , stylers: [{
                                        visibility: "off"
                                    }]
                                }, {
                                    featureType: "poi.business"
                                    , elementType: "labels.text"
                                    , stylers: [{
                                        visibility: "off"
                                    }]
                                }, {
                                    featureType: "poi.business"
                                    , elementType: "labels.icon"
                                    , stylers: [{
                                        visibility: "off"
                                    }]
                                }, {
                                    featureType: "poi.place_of_worship"
                                    , elementType: "labels.text"
                                    , stylers: [{
                                        visibility: "off"
                                    }]
                                }, {
                                    featureType: "poi.place_of_worship"
                                    , elementType: "labels.icon"
                                    , stylers: [{
                                        visibility: "off"
                                    }]
                                }, {
                                    featureType: "road"
                                    , elementType: "geometry"
                                    , stylers: [{
                                        visibility: "simplified"
                                    }]
                                }, {
                                    featureType: "water"
                                    , stylers: [{
                                        visibility: "on"
                                    }, {
                                        saturation: 50
                                    }, {
                                        gamma: 0
                                    }, {
                                        hue: "#50a5d1"
                                    }]
                                }, {
                                    featureType: "administrative.neighborhood"
                                    , elementType: "labels.text.fill"
                                    , stylers: [{
                                        color: "#333333"
                                    }]
                                }, {
                                    featureType: "road.local"
                                    , elementType: "labels.text"
                                    , stylers: [{
                                        weight: 0.5
                                    }, {
                                        color: "#333333"
                                    }]
                                }, {
                                    featureType: "transit.station"
                                    , elementType: "labels.icon"
                                    , stylers: [{
                                        gamma: 1
                                    }, {
                                        saturation: 50
                                    }]
                                }]
                            }
                            var mapElement = document.getElementById('map');
                            var map = new google.maps.Map(mapElement, mapOptions);
                            var locations = [['17 Place Saint-Pierre 75018 PARIS', 48.884247, 2.343017]];
                            for (i = 0; i < locations.length; i++) {
                                marker = new google.maps.Marker({
                                    icon: 'public/images/map.png'
                                    , position: new google.maps.LatLng(locations[i][1], locations[i][2])
                                    , map: map
                                });
                            }
                        }
                    </script>
                </div>
                <div class="divide30"></div>
            </div>
        </div>
    </div>
</section>