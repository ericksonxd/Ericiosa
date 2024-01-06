<?php
require_once('../config/conexion.php');

$id = isset($_GET['id']) ? $_GET['id'] : null;
if ($id === null) {
    // Manejar el caso en que 'id' no está presente en la URL
    // Puedes redirigir al usuario o mostrar un mensaje de error
    die("Error: El parámetro 'id' no está presente.");
}

$newPassword = $_POST['new_password'];
$authNewPassword = $_POST['auth_new_password'];

// Verificar si las contraseñas coinciden
if ($newPassword !== $authNewPassword) {
    $error = "Las contraseñas no coinciden.";
    header("Location: ../public/change_password.php?id=$id&error=$error");
    exit();
}

// Hash de la nueva contraseña
$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

// Actualizar la contraseña y establecer el estado en 0
$query = "UPDATE usuarios SET password = ?, status = 0 WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('si', $hashedPassword, $id);

if ($stmt->execute()) {
    echo '<script>';
    echo 'alert("Contraseña Actualizada Correctamente");';
    echo 'window.location.href="../public/login.php?message=success_password";';
    echo '</script>';
} else {
    showAlert('<script>alert("Error al Actualizar Contraseña: ' . $stmt->error . '");</script>');
}

$stmt->close();
$conn->close();
?>