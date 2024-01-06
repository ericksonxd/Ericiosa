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


function obtenerNumeroProductosCatalogo()
{
    include "../config/conexion.php";
    $query = "SELECT COUNT(*) AS total FROM products";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $data = mysqli_fetch_assoc($result);
        return $data['total'];
    } else {
        return 0; // Manejo de errores
    }
}

function obtenerNumeroUsuariosIngresados()
{
    include "../config/conexion.php";
    $query = "SELECT COUNT(*) AS total FROM usuarios";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $data = mysqli_fetch_assoc($result);
        return $data['total'];
    } else {
        return 0; // Manejo de errores
    }
}

function obtenerNumeroPagosRegistrados()
{
    include "../config/conexion.php";
    $query = "SELECT COUNT(*) AS total FROM pagos";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $data = mysqli_fetch_assoc($result);
        return $data['total'];
    } else {
        return 0; // Manejo de errores
    }
}

function obtenerNumeroPedidosPersonalizados()
{
    include "../config/conexion.php";
    $query = "SELECT COUNT(*) AS total FROM custom_orders";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $data = mysqli_fetch_assoc($result);
        return $data['total'];
    } else {
        return 0; // Manejo de errores
    }
}

// Close the database connection
mysqli_close($conn);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Dashboard - Ericiosa</title>
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
                        <div class="nav_list"> <a href="dashboard.php" class="nav_link active"> <i
                                    class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> </a> <a
                                href="adminusers.php" class="nav_link"> <i class='bx bx-user nav_icon'></i> <span
                                    class="nav_name">Usuarios</span> </a> <a href="adminproduct.php" class="nav_link">
                                <i class='bx bx-folder nav_icon'></i> <span class="nav_name">Productos</span> </a> <a
                                href="adminstats.php" class="nav_link"> <i class='bx bx-bar-chart-alt-2 nav_icon'></i>
                                <span class="nav_name">Stats</span> </a>
                            <a href="adminmail.php" class="nav_link"><i class='bx bx-envelope'></i><span
                                    class="nav_name">Mails</span> </a>
                        </div>
                    </div> <a href="../config/logout.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span
                            class="nav_name">Cerrar Sesion</span> </a>
                </nav>
            </div>
            <!--Container Main start-->
            <div class="height-100 bg-light">
                <h1>Bienvinid@ Al dashboard</h1>
                <div class="height-100 bg-light">


                    <div class="row">
                        <div class="col-md-3">
                            <div class="card bg-info text-white mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="adminproduct.php" class="text-decoration-none text-reset">
                                            Número de Productos añadidos al catálogo:
                                        </a>
                                    </h5>
                                    <p class="card-text">
                                        <?php echo obtenerNumeroProductosCatalogo(); ?>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card bg-success text-white mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="adminusers.php" class="text-decoration-none text-reset">
                                            Número de Usuarios ingresados:
                                        </a>
                                    </h5>
                                    <p class="card-text">
                                        <?php echo obtenerNumeroUsuariosIngresados(); ?>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card bg-warning text-white mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="adminstats.php" class="text-decoration-none text-reset">
                                            <!-- Ajusta aquí la ruta del enlace -->
                                            Número de Pagos Registrados:
                                        </a>
                                    </h5>
                                    <p class="card-text">
                                        <?php echo obtenerNumeroPagosRegistrados(); ?>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card bg-danger text-white mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="adminmail.php" class="text-decoration-none text-reset">
                                            <!-- Ajusta aquí la ruta del enlace -->
                                            Número de Pedidos Personalizados:
                                        </a>
                                    </h5>
                                    <p class="card-text">
                                        <?php echo obtenerNumeroPedidosPersonalizados(); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>




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
                </script>     
     </body >
 </html >