<?php
include "../config/conexion.php";

if (isset($_GET['ids'])) {
    $idsCorreos = $_GET['ids'];

    // Divide los IDs separados por comas en un array
    $arrayIds = explode(",", $idsCorreos);

    // Escapa cada ID para evitar inyecciones SQL
    $escapedIds = array_map('intval', $arrayIds);

    // Convierte el array de IDs nuevamente en una cadena separada por comas
    $escapedIdsString = implode(",", $escapedIds);

    // Realiza la eliminación de los correos seleccionados
    $query = "DELETE FROM custom_orders WHERE id IN ($escapedIdsString)";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Correos eliminados exitosamente";
    } else {
        echo "Error al intentar eliminar los correos seleccionados: " . mysqli_error($conn);
    }
} else {
    echo "IDs de correos no proporcionados";
}
?>