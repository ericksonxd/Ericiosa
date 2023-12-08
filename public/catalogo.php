<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Ericiosa - Inicio</title>
    <link rel="stylesheet" href="css/indexstyle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="container">
        <div class="content">
            <h2>Bienvenido, <?php echo $_SESSION['usuario']; ?>!</h2>
            <a href="../config/logout.php">Cerrar Sesión</a>
        </div>
    </div>
</body>
</html>
