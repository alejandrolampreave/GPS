<?php
/*
* Script que se encarga de subir un fichero al servidor en formato GeoJSON.
* @author Alejandro Fernández Lampreave.
*/

if ($_FILES['archivo']["error"] > 0)
  {
  echo "Error: " . $_FILES['archivo']['error'] . "<br>";
  }
else
  {
  date_default_timezone_set('CET');
  $hoy = date("j-m-Y_H-i-s_");
  $_FILES['archivo']['name']=$hoy.$_FILES['archivo']['name'];
  //echo "Nombre: " . $_FILES['archivo']['name'] . "<br>"; //nombre del archivo + extension.
  //echo "Tipo: " . $_FILES['archivo']['type'] . "<br>";
  //echo "Tamaño: " . ($_FILES["archivo"]["size"] / 1024) . " kB<br>";
  //echo "Carpeta temporal: " . $_FILES['archivo']['tmp_name'] . "<br>";
  
/*
* Primero, movemos el archivo con formato NMEA que hemos subido de la carpeta de
* temporales donde se almacena por defecto, a la carpeta donde almacenamos 
* nuestros archivos (subidas).
* move_uploaded_file(string $rutaArchivo , string $destino+nombredeseado);
*/
$movido=move_uploaded_file($_FILES['archivo']['tmp_name'],"subidas/" . $_FILES['archivo']['name']);
if( $movido ) {
  //echo "Movido a la carpeta subidas";         
} else {
  echo "No se ha podido mover el archivo deseado";
}

/*
*Segundo, vamos a llamar a un script hecho en Python que se encarga de 
*transformar los mensajes NMEA a GeoJSON.
*De no tener python configurado en el path, indicar donde esta instalado,
*ej: C:/Users/Alejandro/Anaconda3/python
*shell_exec('/path/to/python /path/to/your/script.py ' . $nombreArchivo);*/
shell_exec('python ./subidas/convert_NMEA-GeoJSON.py ./subidas/'.$_FILES['archivo']['name'] );
  	
  

//si no gacemos un formulario, pasando la variable que deseemos.
//<a href="http://url.pagina.destino/?variable1=valor1&variable2=valor2">Enlace a página de destino</a>

 //En caso de querer volver a la página de origen directamente
 //header("Location: interfaz.php");


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
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> <!--Librería para descargar la imagen--> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" /> <!--Libreria botones-->

    <style>
        body { margin:0; padding:0; }
        #map { position:fixed; top:2.8em; bottom:0; width:100%; float:left;}
        #imagen {  display:inline-block; top:0; bottom:0;  float:right; margin-right: 1em }
        #volar {position:relative; display:inline-block; top:0; bottom:0;  float:left; margin-left: 1em }
        #home {position:relative; display:inline-block; top:0; bottom:0;  float:left; margin-left: 1em }
    </style>
</head>
<body>

<!--Botón para descargar la imagen del mapa--> 
<div id="imagen">
  <a class="btn btn-success" id="enlaceDescarga" href="" download="map.png">Descargar mapa</a> 
</div>
<!--Botón para volar a tu posición--> 
<button class="btn btn-success" id='volar'>Centrar en mi posición</button>
<!--Regresar a la página de inicio-->
<a class="btn btn-success" id="home" href="index.html">Volver a inicio</a>

<div id='map'> 
<script>
mapboxgl.accessToken = 'pk.eyJ1IjoiYWxlamFuZHJvbGFtcHJlYXZlIiwiYSI6ImNqcHFzbHBzbTB4NHc0NW9nbjJ5eDNqbmgifQ.TbEYVxeQlVtCp93MXTAZJQ';
var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v9',
    zoom: 16,
    center: [-3.689192, 42.349850], 
    pitch: 20,
    preserveDrawingBuffer: true,
});

//https://raw.githubusercontent.com/alejandrolampreave/GPS/master/Mygeodata%20gjson/mygeodata_merged.json
var extension = ".kml-Tracks-Layer0.geojson";
var src = "./mygeodata/" + "<?php echo $_FILES['archivo']['name'] ?>" + extension;

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

    //Obtener la imagen del mapa mostrado en pantala.
    $('#enlaceDescarga').click(function() {
        var img = map.getCanvas().toDataURL('image/png')
        this.href = img
    })

    //Geolocalizar tu posición y centrar el mapa en ella.
    document.getElementById('volar').addEventListener('click', function () {
    if ('geolocation' in navigator) {
      navigator.geolocation.getCurrentPosition(function(position) {
        'use strict';
        map.flyTo({center: [position.coords.longitude,
            position.coords.latitude], zoom: 14});
      });
    }
    });
});

</script>
</div>

<?php
	}
?>