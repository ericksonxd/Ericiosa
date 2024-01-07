<?php
// Obtén el id de la URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Verifica si 'id' está presente en la URL
if ($id === null) {
    // Manejar el caso en que 'id' no está presente en la URL
    // Puedes redirigir al usuario o mostrar un mensaje de error
    die("Error: El parámetro 'id' no está presente.");
}

// Obtén el nombre de usuario de la base de datos
include "../config/conexion.php";
$query = "SELECT nombre, status FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->bind_result($nombreDeUsuario, $status);
$stmt->fetch();
$stmt->close();

// Verifica si el status es 0
if ($status == 0) {
    die("Error: El usuario está inactivo.");
}

// Función para mostrar mensajes de alerta
function showAlert($message) {
    echo '<div class="alert alert-danger" role="alert">' . $message . '</div>';
}

// Procesamiento del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y procesar la contraseña
    $newPassword = $_POST['new_password'];
    $authNewPassword = $_POST['auth_new_password'];

    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*(),.?":{}|<>]).{8,}$/', $newPassword)) {
        showAlert('<script>alert("La contraseña debe contener al menos una mayúscula, una minúscula, un carácter especial y tener al menos 8 caracteres");</script>');
    } elseif ($newPassword !== $authNewPassword) {
        showAlert('<script>alert("Las Contraseñas no coinciden");</script>');
    } else {
        // Actualizar la contraseña en la base de datos (utiliza password_hash)
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $updateQuery = "UPDATE usuarios SET password = ?, status = 0 WHERE id = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param('si', $hashedPassword, $id);

        if ($updateStmt->execute()) {
            echo  '<script>';
            echo 'alert("Contraseña Actualizada Correctamente");';
            echo 'window.location.href="../public/login.php?message=success_password";';
            echo '</script>';
        } else {
            showAlert('<script>alert("Error al Actualizar Contraseña");</script>');
        }

        $updateStmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Ericiosa - Olvidé mi contraseña</title>
    <link rel="stylesheet" href="css/loginstyle.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../private/logos/logo 7.png">
</head>
<body>
<div class="container">
    <div class="nav">
        <a class="return-btn" href="index.php">Página Principal</a>
    </div>
    <hr>
    <div class="title">Cambia tu Contraseña</div>
    <div class="content">
        <span>Bienvenid@: <?php echo $nombreDeUsuario; ?> Por favor ingresa tu nueva contraseña</span>
        <br>
        <br>
        <form action="" method="POST">
            <div class="user-details">
                <div class="input-box">
                    <span class="details"><ion-icon name="lock-closed-outline"></ion-icon>Ingrese su nueva contraseña</span>
                    <input type="password" name="new_password" autocomplete="new-password"
                           placeholder="Ingrese su nueva contraseña" required>
                    <span class="details"><ion-icon name="refresh-outline"></ion-icon>Confirme su nueva contraseña</span>
                    <input type="password" name="auth_new_password" id="auth_new_password" autocomplete="off"
                           placeholder="Confirme su nueva contraseña" required>
                </div>
            </div>
            <div class="button">
                <input type="submit" name="login" value="Cambiar Contraseña">
            </div>
        </form>
    </div>
</div>
</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>
