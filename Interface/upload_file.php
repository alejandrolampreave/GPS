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

}
?>