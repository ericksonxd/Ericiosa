<?php
include 'conexion.php';

$idProducto = $_GET['id'];
$destacar = $_GET['destacar'];

$query = "UPDATE products SET destacado = $destacar WHERE id_product = $idProducto";
$result = mysqli_query($conn, $query);

if ($result) {
    // Verifica el estado actualizado de 'destacado'
    $query_select_destacado = "SELECT destacado FROM products WHERE id_product = $idProducto";
    $result_select_destacado = mysqli_query($conn, $query_select_destacado);

    if ($result_select_destacado) {
        $row_destacado = mysqli_fetch_assoc($result_select_destacado);
        $estado_destacado_actualizado = $row_destacado['destacado'];

        echo ($estado_destacado_actualizado == 1) ? "Producto destacado exitosamente" : "Producto quitado de destacados exitosamente";
    } else {
        echo 'Error al obtener el estado actualizado de destacado';
    }
} else {
    echo 'Error al procesar la solicitud';
}

mysqli_close($conn);
?>