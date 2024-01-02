<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $idProducto = $_GET['id'];

    // Obtener nombres de archivo de las imágenes antes de eliminar el producto
    $query_select_images = "SELECT imagen1, imagen2, imagen3 FROM products WHERE id_product = $idProducto";
    $result_select_images = mysqli_query($conn, $query_select_images);

    if ($result_select_images) {
        $row_images = mysqli_fetch_assoc($result_select_images);

        // Eliminar el producto de la base de datos
        $query_delete_product = "DELETE FROM products WHERE id_product = $idProducto";
        $result_delete_product = mysqli_query($conn, $query_delete_product);

        if ($result_delete_product) {
            // Eliminar las imágenes de la carpeta
            $imagen1 = $row_images['imagen1'];
            $imagen2 = $row_images['imagen2'];
            $imagen3 = $row_images['imagen3'];

            unlink("../private/images_product/$imagen1");
            unlink("../private/images_product/$imagen2");
            unlink("../private/images_product/$imagen3");

            echo "Producto eliminado correctamente, junto con sus imágenes";
        } else {
            echo "Error al eliminar el producto: " . mysqli_error($conn);
        }
    } else {
        echo "Error al obtener los nombres de archivo de las imágenes: " . mysqli_error($conn);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
} else {
    echo "Solicitud inválida";
}
?>