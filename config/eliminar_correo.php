<?php
include "../config/conexion.php";

if (isset($_GET['id'])) {
    $idCorreo = $_GET['id'];

    // Realiza la eliminación del correo con el ID proporcionado
    $query = "DELETE FROM custom_orders WHERE id = $idCorreo";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Correo eliminado exitosamente";
    } else {
        echo "Error al intentar eliminar el correo: " . mysqli_error($conn);
    }
} else {
    echo "ID del correo no proporcionado";
}
?>