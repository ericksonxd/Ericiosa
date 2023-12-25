<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['usuario_tipo'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Fetch the administrator's name from the database
include "../config/conexion.php";
$admin_email = $_SESSION['usuario'];
$sql = "SELECT nombre FROM admin WHERE email = '$admin_email'";
$result = mysqli_query($conn, $sql);

// Check for errors and initialize $admin_nombre
if (!$result) {
    echo "Error en la consulta: " . mysqli_error($conn);
    exit();
} else if (mysqli_num_rows($result) == 0) {
    echo "No se encontró el administrador con el correo electrónico: " . $admin_email;
    exit();
} else {
    $admin_data = mysqli_fetch_assoc($result);
    $admin_nombre = $admin_data['nombre'] ?? ''; // Initialize $admin_nombre with an empty string if not set
}

// Close the database connection
mysqli_close($conn);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Dashboard Ericiosa</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css' rel='stylesheet'>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
 <link rel="stylesheet" href="../public/css/adminstyle.css">
</head>

<body>

    <body className='snippet-body'>

        <body id="body-pd">
            <header class="header" id="header">
                <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i></div>

                <div class="header_img">

                    <h6> Bienvenid@ Administrador@:
                        <?php echo $admin_nombre; ?>
                    </h6>
                </div>
            </header>
            <div class="l-navbar" id="nav-bar">
                <nav class="nav">
                    <div> <a href="#" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span
                                class="nav_logo-name">Ericiosa - Admin</span> </a>
                        <div class="nav_list"> <a href="#" class="nav_link active"> <i
                                    class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> </a> <a
                                href="#" class="nav_link"> <i class='bx bx-user nav_icon'></i> <span
                                    class="nav_name">Usuarios</span> </a> <a href="adminproduct.php" class="nav_link"> <i
                                    class='bx bx-folder nav_icon'></i> <span class="nav_name">Productos</span> </a> <a
                                href="#" class="nav_link"> <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span
                                    class="nav_name">Stats</span> </a>
                        </div>
                    </div> <a href="../config/logout.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span
                            class="nav_name">Cerrar Sesion</span> </a>
                </nav>
            </div>
            <!--Container Main start-->
            <div class="height-100 bg-light">
                <h4>Main Components</h4>


           


            </div>
            <!--Container Main end-->
            <script type='text/javascript'
                src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js'></script>
            <script type='text/javascript' src='#'></script>
            <script type='text/javascript' src='#'></script>
            <script type='text/javascript' src='#'></script>
            <script type='text/javascript'></script>
            </script>
            <script src="../config/sidebar.js"></script>
            <script type='text/javascript'>var myLink = document.querySelector('a[href="#"]');
                myLink.addEventListener('click', function (e) {
                    e.preventDefault();
                });
                            
                                </body >
                            </html >