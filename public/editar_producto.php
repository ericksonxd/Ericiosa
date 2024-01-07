<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['usuario_tipo'] !== 'admin') {
    header("Location: index.php");
    exit();
}

include "../config/conexion.php";

$producto_id = isset($_GET['id']) ? $_GET['id'] : null;

if ($producto_id) {
    $query = "SELECT * FROM products WHERE id_product = $producto_id";
    $resultado = mysqli_query($conn, $query);

    if ($fila = mysqli_fetch_assoc($resultado)) {
        $nombre = $fila['nombre'];
        $descripcion = $fila['descripcion'];
        $precio = $fila['precio'];
        $link_twitter = $fila['link_x'];
        $link_pinterest = $fila['link_pinterest'];
        $link_instagram = $fila['link_instagram'];
        $link_youtube = $fila['link_youtube'];
        $imagen1 = $fila['imagen1'];
        $imagen2 = $fila['imagen2'];
        $imagen3 = $fila['imagen3'];
    } else {
        echo "Producto no encontrado.";
        exit();
    }
}

// Función para subir imágenes
function subirImagen($nombre_input)
{
    $carpeta_destino = "../private/images_product/";
    $archivo_subido = $carpeta_destino . basename($_FILES[$nombre_input]['name']);
    move_uploaded_file($_FILES[$nombre_input]['tmp_name'], $archivo_subido);
    return basename($_FILES[$nombre_input]['name']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="./img/logo.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="../private/logos/logoadmin.png">
    <title>Actualizar Producto</title>
</head>
<body>
    <div class="container">
        <center>
            <h1>Actualizar Producto</h1>
        </center>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
            $descripcion = mysqli_real_escape_string($conn, $_POST["descripcion"]);
            $precio = mysqli_real_escape_string($conn, $_POST["precio"]);
            $link_twitter = mysqli_real_escape_string($conn, $_POST["link_twitter"]);
            $link_pinterest = mysqli_real_escape_string($conn, $_POST["link_pinterest"]);
            $link_instagram = mysqli_real_escape_string($conn, $_POST["link_instagram"]);
            $link_youtube = mysqli_real_escape_string($conn, $_POST["link_youtube"]);

            $imagen1_actual = $fila['imagen1'];
            $imagen2_actual = $fila['imagen2'];
            $imagen3_actual = $fila['imagen3'];

            // Procesar nuevas imágenes si se han subido
            if (!empty($_FILES["imagen1"]["name"])) {
                $imagen1 = subirImagen("imagen1");
            } else {
                $imagen1 = $imagen1_actual;
            }

            if (!empty($_FILES["imagen2"]["name"])) {
                $imagen2 = subirImagen("imagen2");
            } else {
                $imagen2 = $imagen2_actual;
            }

            if (!empty($_FILES["imagen3"]["name"])) {
                $imagen3 = subirImagen("imagen3");
            } else {
                $imagen3 = $imagen3_actual;
            }

            $query = "UPDATE products SET nombre='$nombre', descripcion='$descripcion', precio='$precio', link_x='$link_twitter', link_pinterest='$link_pinterest', link_instagram='$link_instagram', link_youtube='$link_youtube', imagen1='$imagen1', imagen2='$imagen2', imagen3='$imagen3' WHERE id_product=$producto_id";

            if (mysqli_query($conn, $query)) {
                echo '<div class="alert alert-success" role="alert">';
                echo 'Producto actualizado con éxito. Redirigiendo a adminproduct.php...';
                echo '</div>';
                echo '<meta http-equiv="refresh" content="2;url=adminproduct.php">';
                exit();
            } else {
                echo '<div class="alert alert-danger" role="alert">';
                echo 'Error al actualizar el producto: ' . mysqli_error($conn);
                echo '</div>';
            }

            mysqli_close($conn);
        }
        ?>

        <form action="editar_producto.php?id=<?php echo $producto_id; ?>" method="POST" enctype="multipart/form-data" onsubmit="return validarFormulario()">    
            <!-- Agrega un campo oculto para el ID del producto -->
            <input type="hidden" name="id_producto" value="<?php echo $producto_id; ?>">
            
            <div class="mb-3">
                <!-- Campos del formulario -->
                <!-- Usa los valores obtenidos de la base de datos para poblar los campos -->
                <label for="exampleInputEmail1" class="form-label">Nombre del Producto</label>
                <input type="text" class="form-control" name="nombre" value="<?php echo $nombre; ?>">
                
                <label for="exampleInputPassword1" class="form-label">Descripción del producto</label>
                <input type="text" class="form-control" name="descripcion" value="<?php echo $descripcion; ?>">

                <label for="exampleInputPassword1" class="form-label">Precio del Producto</label>
                <input type="number" class="form-control" name="precio" value="<?php echo $precio; ?>">

                <label for="exampleInputPassword1" class="form-label">Enlace de Twitter</label>
                <input type="text" class="form-control" name="link_twitter" value="<?php echo $link_twitter; ?>">

                <label for="exampleInputPassword1" class="form-label">Enlace de Pinterest</label>
                <input type="text" class="form-control" name="link_pinterest" value="<?php echo $link_pinterest; ?>">

                <label for="exampleInputPassword1" class="form-label">Enlace de Instagram</label>
                <input type="text" class="form-control" name="link_instagram" value="<?php echo $link_instagram; ?>">

                <label for="exampleInputPassword1" class="form-label">Enlace de Youtube</label>
                <input type="text" class="form-control" name="link_youtube" value="<?php echo $link_youtube; ?>">

                <!-- Campos de imágenes -->
                <label for="exampleInputPassword1" class="form-label">Primera Imagen</label>
                <input type="file" class="form-control" name="imagen1">
                <input type="hidden" name="imagen1_actual" value="<?php echo $imagen1_actual; ?>">
                
                <label for="exampleInputPassword1" class="form-label">Segunda Imagen</label>
                <input type="file" class="form-control" name="imagen2">
                <input type="hidden" name="imagen2_actual" value="<?php echo $imagen2_actual; ?>">

                <label for="exampleInputPassword1" class="form-label">Tercera Imagen</label>
                <input type="file" class="form-control" name="imagen3">
                <input type="hidden" name="imagen3_actual" value="<?php echo $imagen3_actual; ?>">
                <img src="../private/images_product/<?php echo $imagen3; ?>" alt="Imagen 3" width="50">
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Producto</button>
            <a href="./dashboard.php" class="btn btn-success">Regresar al Dashboard</a>
        </form>
    </div>

    <script>
        function validarFormulario() {
            var nombre = document.getElementsByName('nombre')[0].value.trim();
            var descripcion = document.getElementsByName('descripcion')[0].value.trim();
            
            if (nombre === '' || descripcion === '') {
                alert('Por favor, complete todos los campos.');
                return false; 
            }
            return true; 
        }
    </script>

</body>
</html>