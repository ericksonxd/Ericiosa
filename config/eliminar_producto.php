<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $idProducto = $_GET['id'];

    // Realizar la eliminación en la base de datos
    $query = "DELETE FROM products WHERE id_product = $idProducto";
    $resultado = mysqli_query($conn, $query);

    if ($resultado) {
        echo "Producto eliminado correctamente";
    } else {
        echo "Error al eliminar el producto: " . mysqli_error($conn);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
} else {
    echo "Solicitud inválida";
}
?>