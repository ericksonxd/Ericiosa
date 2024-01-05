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

$query = "UPDATE usuarios SET password = '$hashedPassword', status = 0 WHERE id = $id";
$conn->query($query);

header("Location: ../public/login.php?message=success_password");
?>