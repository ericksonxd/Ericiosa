<?php
session_start();

include '../config/conexion.php';

// Process form submission
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM `admin` WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo "Error en la consulta: " . mysqli_error($conn);
        exit();
    }

    if (mysqli_num_rows($result) == 1) {
        $user_data = mysqli_fetch_assoc($result);

        if ($user_data) {
            if (password_verify($password, $user_data['password'])) {
                // Successful login
                $_SESSION['usuario'] = $user_data['email'];
                $_SESSION['usuario_tipo'] = 'admin'; // Store user type in session
                header("Location: dashboard.php");
                exit();
            } else {
                // Invalid password
                $error_message = "Contraseña incorrecta";
            }
        } else {
            // Unexpected data error
            $error_message = "Error al obtener la información del usuario";
        }
    } else {
        // Usuario no encontrado
        $error_message = "Usuario no existe";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Ericiosa - administrador</title>
    <link rel="stylesheet" href="css/loginstyle.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../private/logos/logoadmin.png">
</head>
<body>
    <div class="container">
        <hr>
        <div class="title">Inicia Sesión Como administrador en Ericiosa</div>
        <div class="content">
            <form action="adminlogin.php" method="POST">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details"><ion-icon name="person-circle-outline"></ion-icon>Ingrese su Email de administrador</span>
                        <input type="email" name="email" autocomplete="email" placeholder="Ingrese su Usuario" required>
                    </div>

                    <div class="input-box">
                        <span class="details"><ion-icon name="lock-open-outline"></ion-icon>Contraseña</span>
                        <input type="password" name="password" autocomplete="current-password" placeholder="Ingrese su contraseña" required>
                    </div>
                </div>         
                <div class="button">
                    <input type="submit" name="login" value="Inicia Sesion">
                </div>
            </form>
            <div class="button">
                <a href="index.php" class="return">Regresa a la pagina principal</a>
            </div>

            <?php
            if (isset($error_message)) {
                echo '<div class="error-message">' . $error_message . '</div>';
            }
            ?>
        </div>
    </div>
</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>