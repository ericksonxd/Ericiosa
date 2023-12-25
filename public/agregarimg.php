<?php
session_start();

// Verificar si no hay una sesión activa
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="./img/logo.ico">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <title>Nueva imagen</title>
  </head>
  <body>
   <div class="container">  
   
<center>
            <h1>  Nueva imagen  </h1>
        </center>
   
  
<br>
<form action="insert.php" method="POST" enctype="multipart/form-data" onsubmit="return validarFormulario()">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Nombre de la imagen</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="nombre">
   
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">descripcion de la imagen</label>
    <input type="text" class="form-control" name="descripcion">
  </div>
    <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Imagen</label>
    <input type="file" class="form-control" name="imagen">
  </div>
  
    <button type="submit" class="btn btn-primary">Enviar</button>
<a href="./dashboard.php"  class="btn btn-success"> regresar al dashboard <a>

   </div>
 
   </div>


   <script>
        function validarFormulario() {
            
            var nombre = document.getElementsByName('nombre')[0].value.trim();
            var descripcion = document.getElementsByName('descripcion')[0].value.trim();
            var imagen = document.getElementsByName('imagen')[0].value.trim();

            
            if (nombre === '' ||  descripcion=== '' || imagen === '') {
                alert('Por favor, complete todos los campos.');
                return false; 
            }
            return true; 
        }
    </script>

 
 
</form>
  </body>
</html>