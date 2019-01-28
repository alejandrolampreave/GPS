<!DOCTYPE html>
<html>
<body>

<?php
print("Hola mundo");
$fp = fopen("./LOG_GPS.txt", "r");
while (!feof($fp)){
    $linea = fgets($fp);
    echo $linea;
}
fclose($fp);
?>

<script type="text/javascript">
    var milinea = '<?php echo $linea;?>'
    console.log('ejemplo');
    console.log(milinea);
</script>

 <script type="text/javascript">
 	var i;
    for (i = 0; i < cars.length; i++) { 
    var img[i]= [ <?php echo implode("\$",$linea);?> ]
	}
</script
//centrar mapa en un recuadro. Puntos NorteOeste/SurEste coordenadas cambiadas.
map.fitBounds([[ 
         -3.699149, 
         42.349200
    ], [
        -3.676876,
        42.340857
        
    ]]);

</body>
</html>



