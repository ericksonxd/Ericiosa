<?php
include 'conexion.php'; // Asegúrate de incluir el archivo de conexión

if (isset($_GET['id'])) {
    $idUsuario = $_GET['id'];

    // Realizar la consulta para eliminar el usuario
    $query = "DELETE FROM usuarios WHERE id = $idUsuario";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo 'Usuario eliminado exitosamente';
    } else {
        echo 'Error al intentar eliminar el usuario';
    }
} else {
    echo 'ID de usuario no proporcionado';
}

mysqli_close($conn); // Cerrar la conexión a la base de datos
?>