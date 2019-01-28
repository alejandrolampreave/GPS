//JavaScript
function leerArchivo(e) {
  var archivo = e.target.files[0];
  if (!archivo) {
    return;
  }
  var lector = new FileReader();
  lector.onload = function(e) {
    var contenido = e.target.result;
    mostrarContenido(contenido);
  };
  lector.readAsText(archivo);
}

function mostrarContenido(contenido) {
  var elemento = document.getElementById('contenido-archivo');
  elemento.innerHTML = contenido;
}

/*document.getElementById('file-input').addEventListener('change', leerArchivo, false);
<input type="file" id="file-input" />
<h3>Contenido del archivo:</h3>
<pre id="contenido-archivo"></pre>*/
