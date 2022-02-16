<html>
    <head>
        <meta charset="utf-8">
        <title>Dataset Maps</title>
        <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
              integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
              crossorigin="anonymous"/>
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
                integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin="anonymous"></script>
        <style>
            body { margin: 0; padding: 0; }
            #mapid { height: 600px; }

            .info {
                padding: 6px 8px;
                font: 14px/16px Arial, Helvetica, sans-serif;
                background: white;
                background: rgba(255,255,255,0.8);
                box-shadow: 0 0 15px rgba(0,0,0,0.2);
                border-radius: 5px;
            }
            .info h4 {
                margin: 0 0 5px;
                color: #777;
            }

            .legend {
                line-height: 18px;
                color: #555;
            }
            .legend i {
                width: 18px;
                height: 18px;
                float: left;
                margin-right: 8px;
                opacity: 0.7;
            }
            .leaflet-control-attribution.leaflet-control{
                display: none;
            }
        </style>
    </head>
    <body>
        <div id="mapid"></div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script>
            var _url = "{{ asset('json/provinsi_banten.geojson') }}";
            var mymap = L.map('mapid').setView([-6.44538, 106.13756], 9);
            var geojson;
            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiaGVyaWhhbmQyNDAyIiwiYSI6ImNrcDBsOWh3eDEzcXIybmxkMHZpMjVqN2kifQ.gbu7xDRMTm6VpyXRVbaHNQ', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 18,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'pk.eyJ1IjoiaGVyaWhhbmQyNDAyIiwiYSI6ImNrcDBsOWh3eDEzcXIybmxkMHZpMjVqN2kifQ.gbu7xDRMTm6VpyXRVbaHNQ'
            }).addTo(mymap);

            var legend = L.control({position: 'bottomright'});
            legend.onAdd = function (map) {

                var div = L.DomUtil.create('div', 'info legend');
                var grades = [0, 10, 20, 50, 100, 200, 500, 1000];
                var labels = [];
                for (var i = 0; i < grades.length; i++) {
                    div.innerHTML +=
                            '<i style="background:' + getColor(grades[i] + 1) + '"></i> ' +
                            grades[i] + (grades[i + 1] ? '&ndash;' + grades[i + 1] + '<br>' : '+');
                }

                return div;
            };

            legend.addTo(mymap);

            $.getJSON(_url, function (data) {
                geojson = L.geoJson(data, {
                    style: style,
                    onEachFeature: onEachFeature
                }).addTo(mymap);
            });

            var info = L.control();
            info.onAdd = function (map) {
                this._div = L.DomUtil.create('div', 'info'); // create a div with a class "info"
                this.update();
                return this._div;
            };
            info.update = function (props) {
                this._div.innerHTML = '<h4>Provinsi Banten</h4>' + (props ?
                        '<b>' + props.NAMOBJ + '</b><br />' + props.WADMPR + ' <sup>2</sup>'
                        : 'Hover over a state');
            };
            info.addTo(mymap);

            function onEachFeature(feature, layer) {
                layer.on({
                    mouseover: highlightFeature,
                    mouseout: resetHighlight,
                    click: zoomToFeature
                });
            }

            function highlightFeature(e) {
                var layer = e.target;

                layer.setStyle({
                    weight: 2,
                    color: 'red',
                    dashArray: '',
                    fillOpacity: 0.7
                });

                if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
                    layer.bringToFront();
                }
                info.update(layer.feature.properties);
            }

            function resetHighlight(e) {
                geojson.resetStyle(e.target);
                info.update();
            }

            function zoomToFeature(e) {
                mymap.fitBounds(e.target.getBounds());
            }

//            $.ajax({
//                url: 'https://dev.cybermedia.co.id/api/dindik/{{ $slug }}',
//                success: function (json) {
//                    console.log(json.data);
//                },
//                dataType: "json"
//            });

            function style(feature) {
//                return {
//                    fillColor: feature.properties.Warna,
//                    weight: 2,
//                    opacity: 1,
//                    color: 'white',
//                    dashArray: '3',
//                    fillOpacity: 0.9
//                };
                return {
                    fillColor: getColor(200),
                    weight: 2,
                    opacity: 1,
                    color: 'red',
                    dashArray: '3',
                    fillOpacity: 0.1
                };
            }

            function getColor(d) {
                return d > 1000 ? '#800026' :
                        d > 500 ? '#BD0026' :
                        d > 200 ? '#E31A1C' :
                        d > 100 ? '#FC4E2A' :
                        d > 50 ? '#FD8D3C' :
                        d > 20 ? '#FEB24C' :
                        d > 10 ? '#FED976' :
                        '#FFEDA0';
            }
        </script>
    </body>
</html>