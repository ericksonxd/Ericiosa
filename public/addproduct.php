<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['usuario_tipo'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Fetch the administrator's name from the database
include "../config/conexion.php";
$admin_email = $_SESSION['usuario'];
$sql = "SELECT nombre FROM admin WHERE email = '$admin_email'";
$result = mysqli_query($conn, $sql);

// Check for errors and initialize $admin_nombre
if (!$result) {
    echo "Error en la consulta: " . mysqli_error($conn);
    exit();
} else if (mysqli_num_rows($result) == 0) {
    echo "No se encontró el administrador con el correo electrónico: " . $admin_email;
    exit();
} else {
    $admin_data = mysqli_fetch_assoc($result);
    $admin_nombre = $admin_data['nombre'] ?? ''; // Initialize $admin_nombre with an empty string if not set
}

// Close the database connection
mysqli_close($conn);
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
            <h1>  Nuevo producto  </h1>
        </center>
   
  
<br>
<form action="../config/insert.php" method="POST" enctype="multipart/form-data" onsubmit="return validarFormulario()">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Nombre del Producto</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="nombre">
   
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">descripcion del producto</label>
    <input type="text" class="form-control" name="descripcion">
<br>  
    <label for="exampleInputPassword1" class="form-label">Precio del Producto</label>
    <input type="number" class="form-control" name="precio">
<br>
<label for="exampleInputPassword1" class="form-label">Enlace de Twitter</label>
    <input type="text" class="form-control" name="link_twitter">
<br>
<label for="exampleInputPassword1" class="form-label">Enlace de Pinterest</label>
    <input type="text" class="form-control" name="link_pinterest">
    <br>
<label for="exampleInputPassword1" class="form-label">Enlace de Instagram</label>
    <input type="text" class="form-control" name="link_instagram">  

    <br>
<label for="exampleInputPassword1" class="form-label">Enlace de Youtube</label>
    <input type="text" class="form-control" name="link_youtube"> 
  </div>
    <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Primera Imagen</label>
    <input type="file" class="form-control" name="imagen1">
<br>
    <label for="exampleInputPassword1" class="form-label">Segunda Imagen</label>
    <input type="file" class="form-control" name="imagen2">
<br>
    <label for="exampleInputPassword1" class="form-label">Tercera Imagen</label>
    <input type="file" class="form-control" name="imagen3">
  </div>
  
    <button type="submit" class="btn btn-primary">Subir Producto</button>
<a href="./dashboard.php"  class="btn btn-success"> regresar al dashboard <a>
<br>
<br>
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