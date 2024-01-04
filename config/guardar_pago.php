<?php
// guardar_pago.php
include '../config/conexion.php';

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir detalles del pago desde la solicitud POST
$paymentDetails = $_POST['paymentDetails'];

// Guardar detalles del pago en la base de datos
$sql = "INSERT INTO pagos (order_id, payer_id, payment_details) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

// Crear variables para almacenar los valores antes de pasarlos por referencia
$orderID = $paymentDetails['orderID'];
$payerID = $paymentDetails['payerID'];
$details = json_encode($paymentDetails['details']);

$stmt->bind_param("sss", $orderID, $payerID, $details);
$stmt->execute();
$stmt->close();

// Cerrar la conexión
$conn->close();

// Responder con éxito al cliente
echo json_encode(['success' => true]);
?>