<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir el archivo de conexión a la base de datos
    include '../config/conexion.php';

    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $link_twitter = $_POST['link_twitter']; // Cambiado a $link_twitter
    $link_pinterest = $_POST['link_pinterest'];
    $link_instagram = $_POST['link_instagram'];
    $link_youtube = $_POST['link_youtube'];

    // Procesar las imágenes (asumo que solo necesitas el nombre de archivo)
    $imagen1 = $_FILES['imagen1']['name'];
    $imagen2 = $_FILES['imagen2']['name'];
    $imagen3 = $_FILES['imagen3']['name'];

    // Mover las imágenes a la carpeta deseada (asegúrate de que la carpeta tenga permisos de escritura)
    move_uploaded_file($_FILES['imagen1']['tmp_name'], '../private/images_product/' . $imagen1);
    move_uploaded_file($_FILES['imagen2']['tmp_name'], '../private/images_product/' . $imagen2);
    move_uploaded_file($_FILES['imagen3']['tmp_name'], '../private/images_product/' . $imagen3);

    // Insertar los datos en la base de datos
    $query = "INSERT INTO products (nombre, descripcion, precio, imagen1, imagen2, imagen3, link_x, link_pinterest, link_instagram, link_youtube) VALUES ('$nombre', '$descripcion', $precio, '$imagen1', '$imagen2', '$imagen3', '$link_twitter', '$link_pinterest', '$link_instagram', '$link_youtube')"; // Cambiado de link_twitter a link_x

    $resultado = mysqli_query($conn, $query);

    if ($resultado) {
        echo "Producto insertado correctamente";
        header("Location: ../public/adminproduct.php");
    } else {
        echo "Error al insertar el producto: " . mysqli_error($conn);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
}
?>