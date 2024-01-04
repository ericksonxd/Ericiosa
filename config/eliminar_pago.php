<?php
// verificar si se proporciona un ID para eliminar
if (isset($_GET['id'])) {
    $idPago = $_GET['id'];

    include '../config/conexion.php';
    
    // Eliminar el pago de la base de datos
    $sql = "DELETE FROM pagos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idPago);
    
    if ($stmt->execute()) {
        echo "Pago eliminado con éxito";
    } else {
        echo "Error al intentar eliminar el pago: " . $stmt->error;
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();
} else {
    echo "ID de pago no proporcionado";
}
?>