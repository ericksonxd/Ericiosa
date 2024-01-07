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
 <link rel="icon" type="image/png" href="../private/logos/logoadmin.png">
    <title>Nueva imagen</title>
  </head>
  <body>
   <div class="container">  
   
<center>
<h1>Nuevo producto</h1>
        </center>
        <br>
        <form action="../config/insert.php" method="POST" enctype="multipart/form-data" onsubmit="return validarFormulario()">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre del Producto</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Descripción del producto (al menos 15 caracteres)</label>
                <input type="text" class="form-control" name="descripcion" minlength="15" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Precio del Producto</label>
                <input type="number" class="form-control" name="precio">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Enlace de Twitter</label>
                <input type="text" class="form-control" name="link_twitter" value="https://twitter.com/ericiosa?lang=es">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Enlace de Pinterest</label>
                <input type="text" class="form-control" name="link_pinterest" value="https://www.pinterest.com/ericiosa/">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Enlace de Instagram</label>
                <input type="text" class="form-control" name="link_instagram" value="https://www.instagram.com/ericiosa/?hl=es">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Enlace de Youtube</label>
                <input type="text" class="form-control" name="link_youtube" value="https://www.youtube.com/channel/UC8qlHJRf2-TgMw99GjoJQrg">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Primera Imagen</label>
                <input type="file" class="form-control" name="imagen1" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Segunda Imagen</label>
                <input type="file" class="form-control" name="imagen2" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Tercera Imagen</label>
                <input type="file" class="form-control" name="imagen3" required>
            </div>
            <button type="submit" class="btn btn-primary">Subir Producto</button>
            <a href="./dashboard.php" class="btn btn-success">Regresar al dashboard</a>
        </form>
    </div>

    <script>
        function validarFormulario() {
            // Validación adicional, por ejemplo, para los enlaces
            var enlaces = ['link_twitter', 'link_youtube', 'link_pinterest', 'link_instagram'];
            for (var i = 0; i < enlaces.length; i++) {
                var enlace = document.getElementsByName(enlaces[i])[0].value.trim();
                // Validar si el enlace es válido (puedes agregar lógica adicional)
                if (enlace !== '' && !isValidURL(enlace)) {
                    alert('Por favor, ingrese un enlace válido para ' + enlaces[i] + '.');
                    return false;
                }
            }
            return true;
        }

        function isValidURL(url) {
            // Lógica para validar URL (puedes usar expresiones regulares u otros métodos)
            // En este ejemplo, simplemente verifica si comienza con 'http://' o 'https://'
            return url.startsWith('http://') || url.startsWith('https://');
        }
    </script>
</body>
</html>