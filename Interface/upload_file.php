<?php
if ($_FILES['archivo']["error"] > 0)
  {
  echo "Error: " . $_FILES['archivo']['error'] . "<br>";
  }
else
  {
  echo "Nombre: " . $_FILES['archivo']['name'] . "<br>";
  echo "Tipo: " . $_FILES['archivo']['type'] . "<br>";
  echo "Tamaño: " . ($_FILES["archivo"]["size"] / 1024) . " kB<br>";
  echo "Carpeta temporal: " . $_FILES['archivo']['tmp_name'];
 
  $movido=move_uploaded_file($_FILES['archivo']['tmp_name'],"subidas/" . $_FILES['archivo']['name']);
if( $movido ) {
  echo "Movido a la carpeta subidas";         
} else {
  echo "No se ha podido mover el archivo deseado";
}

//shell_exec('/path/to/python /path/to/your/script.py ' . $nombreArchivo);*/
shell_exec('python ./subidas/convert_NMEA-GeoJSON.py ./subidas/'.$_FILES['archivo']['name'] );

$compressed = new ZipArchive; 
$flag = $compressed->open('mygeodata.zip');
if ($flag === TRUE) {
  $compressed->extractTo('./mygeodata');
  $compressed->close();
  // Archivo descomprimido.
} else {
   // Error en la descompresión...
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8' />
    <title>Interfaz GPS</title>
    <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.51.0/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.51.0/mapbox-gl.css' rel='stylesheet' />
    <style>
        body { margin:0; padding:0; }
        #map { position:absolute; top:0; bottom:0; width:60%; float:left; }
        #upload {  display:inline-block; top:0; bottom:0;  float:right; }
    </style>
</head>
<body>

<div id='map'> 
<script>
mapboxgl.accessToken = 'pk.eyJ1IjoiYWxlamFuZHJvbGFtcHJlYXZlIiwiYSI6ImNqcHFzbHBzbTB4NHc0NW9nbjJ5eDNqbmgifQ.TbEYVxeQlVtCp93MXTAZJQ';
var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v9',
    zoom: 16,
    center: [-3.689192, 42.349850], 
    pitch: 20,
});

//https://raw.githubusercontent.com/alejandrolampreave/GPS/master/Mygeodata%20gjson/mygeodata_merged.json
var src = "./mygeodata/"+"<?php echo $_FILES['archivo']['name'] ?>"+".kml-Tracks-Layer0.geojson"


map.on('load', function () {

    var layers = map.getStyle().layers;

    var labelLayerId;
    for (var i = 0; i < layers.length; i++) {
        if (layers[i].type === 'symbol' && layers[i].layout['text-field']) {
            labelLayerId = layers[i].id;
            break;
        }
    }
    
     map.addSource("my_data", {
        type: "geojson",
        data: src
    });

     map.addLayer({
        'id': 'population',
        'type': 'circle',
        source: 'my_data',
        // 'source-layer': 'my_data',
        'paint': {
            // make circles larger as the user zooms from z12 to z22
            'circle-radius': {
                'base': 1.75,
                'stops': [[12, 2], [22, 180]]
            },
            // color circles by ethnicity, using a match expression
            // https://www.mapbox.com/mapbox-gl-js/style-spec/#expressions-match
            'circle-color': '#f00'
        }
    });

    map.addLayer({ //3D de los edificios
        'id': '3d-buildings',
        'source': 'composite',
        'source-layer': 'building',
        'filter': ['==', 'extrude', 'true'],
        'type': 'fill-extrusion',
        'minzoom': 15,
        'paint': {
            'fill-extrusion-color': '#aaa',

            /* Usar un 'interpolate' para conseguir una transición mas natural 
               en los edificios a medida que hacemos zoom.*/ 
            
            'fill-extrusion-height': [
                "interpolate", ["linear"], ["zoom"],
                15, 0,
                15.05, ["get", "height"]
            ],
            'fill-extrusion-base': [
                "interpolate", ["linear"], ["zoom"],
                10, 0,
                15.05, ["get", "min_height"]
            ],
            'fill-extrusion-opacity': .6
        }
    }, labelLayerId);

    // Añadir botonera de zoom y rotación del mapa. 
    map.addControl(new mapboxgl.NavigationControl()); 

});

</script>
</div>

<?php
	}
?>