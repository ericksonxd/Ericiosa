<?php
session_start();
session_destroy();
header("Location: ../public/index.php"); // o a la página a la que quieres redirigir después del cierre de sesión
exit();
?>