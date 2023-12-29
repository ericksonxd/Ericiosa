<?php
include 'conexion.php';

$idProducto = $_GET['id'];
$destacar = $_GET['destacar'];

$query = "UPDATE products SET destacado = $destacar WHERE id_product = $idProducto";
$result = mysqli_query($conn, $query);

if ($result) {
    echo ($destacar == 1) ?"Producto destacado exitosamente" : "Producto quitado de destacados exitosamente";
} else {
    echo 'Error al procesar la solicitud';
}

mysqli_close($conn);

?>