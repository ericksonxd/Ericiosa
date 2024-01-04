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

// Consultar todos los pagos desde la base de datos, incluyendo información del usuario
$query = "SELECT pagos.*, usuarios.nombre AS nombre_usuario FROM pagos LEFT JOIN usuarios ON pagos.payer_id = usuarios.id";
$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Ericiosa - Pagos</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../public/css/adminstyle.css">
</head>

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
                <div class="nav_list"> <a href="dashboard.php" class="nav_link"> <i
                            class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> </a> <a
                        href="adminusers.php" class="nav_link"> <i class='bx bx-user nav_icon'></i> <span
                            class="nav_name">Usuarios</span> </a> <a href="adminproduct.php" class="nav_link"> <i
                            class='bx bx-folder nav_icon'></i> <span class="nav_name">Productos</span> </a> <a
                        href="adminstats.php" class="nav_link active"> <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span
                            class="nav_name">Stats</span> </a>
                        <a href="adminmail.php" class="nav_link"><i class='bx bx-envelope'></i><span class="nav_name">Mails</span> </a>
                </div>
            </div> <a href="../config/logout.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span
                    class="nav_name">Cerrar Sesion</span> </a>
        </nav>
    </div>

    <!-- Container Main start -->
    <div class="height-100 bg-light">
        <h4>Pagos</h4>

        <!-- Search Form -->
        <form method="POST" action="">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Buscar pago" name="search">
                <button class="btn btn-outline-secondary" type="submit" name="submit">Buscar</button>
            </div>
        </form>

        <?php
        // Procesar la búsqueda
        if (isset($_POST['submit'])) {
            $search = $_POST['search'];
            $query = "SELECT pagos.*, usuarios.nombre AS nombre_usuario FROM pagos LEFT JOIN usuarios ON pagos.payer_id = usuarios.id WHERE pagos.id LIKE '%$search%' OR pagos.order_id LIKE '%$search%' OR pagos.payer_id LIKE '%$search%' OR pagos.payment_details LIKE '%$search%' OR usuarios.nombre LIKE '%$search%'";
        } else {
            // Consultar todos los pagos desde la base de datos
            $query = "SELECT pagos.*, usuarios.nombre AS nombre_usuario FROM pagos LEFT JOIN usuarios ON pagos.payer_id = usuarios.id";
        }

        // Ejecutar la consulta
        $result = mysqli_query($conn, $query);

        if (!$result) {
            echo "Error en la consulta: " . mysqli_error($conn);
            exit();
        }

        // Mostrar los pagos en la tabla
        echo '<form method="POST" action="">';
        echo '<table class="table">';
        echo '<thead>';
        echo '<tr>';
        echo '<th scope="col">Seleccionar</th>';
        echo '<th scope="col">ID</th>';
        echo '<th scope="col">Order ID</th>';
        echo '<th scope="col">Payer ID</th>';
        echo '<th scope="col">Usuario</th>';
        echo '<th scope="col">Detalles del Pago</th>';
        echo '<th scope="col">Acciones</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        // Iterar a través de los resultados de la consulta
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td><input type="checkbox" name="selectedPayments[]" value="' . $row['id'] . '"></td>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['order_id'] . '</td>';
            echo '<td>' . $row['payer_id'] . '</td>';
            echo '<td>' . $row['nombre_usuario'] . '</td>';
            echo '<td>' . nl2br(formatPaymentDetails($row['payment_details'])) . '</td>';
            echo '<td>';
            echo '<button class="btn btn-danger" onclick="eliminarPago(' . $row['id'] . ')">Eliminar</button>';
            echo '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
        echo '<button class="btn btn-danger mb-2" onclick="eliminarPagosSeleccionados()">Eliminar Seleccionados</button>';
        echo '</form>';

        function formatPaymentDetails($paymentDetails) {
            $details = json_decode($paymentDetails, true);
        
            // Obtener información del comprador
            $buyerEmail = $details['payer']['email_address'] ?? '';
            $amount = $details['purchase_units'][0]['amount']['value'] ?? '';
            $currency = $details['purchase_units'][0]['amount']['currency_code'] ?? '';
        
            // Verificar si 'name' está presente y no está vacío en 'payer'
            $buyerName = '';
            if (isset($details['payer']['name'])) {
                if (isset($details['payer']['name']['full_name']) && !empty($details['payer']['name']['full_name'])) {
                    $buyerName = $details['payer']['name']['full_name'];
                } elseif (isset($details['payer']['name']['given_name']) && isset($details['payer']['name']['surname'])) {
                    $buyerName = $details['payer']['name']['given_name'] . ' ' . $details['payer']['name']['surname'];
                }
            }
        
            $shippingAddress = $details['purchase_units'][0]['shipping']['address'] ?? [];
            $paymentId = $details['id'] ?? '';
            $createTime = $details['create_time'] ?? '';
        
            // Formatear la descripción
            $formattedDescription = "Email del comprador: $buyerEmail\n";
            $formattedDescription .= "Monto y divisa: $amount $currency\n";
            $formattedDescription .= "Nombre completo del comprador: $buyerName\n";
            $formattedDescription .= "Dirección y área: " . formatAddress($shippingAddress) . "\n";
            $formattedDescription .= "ID del pago: $paymentId\n";
            $formattedDescription .= "Fecha: $createTime\n";
        
            return $formattedDescription;
        }
        function formatAddress($address) {
            return "{$address['address_line_1']}, {$address['admin_area_2']}, {$address['admin_area_1']} {$address['postal_code']}, {$address['country_code']}";
        }
        ?>
    </div>

    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js'></script>
    <script src="../config/sidebar.js"></script>
    <script type='text/javascript'>
        function eliminarPago(idPago) {
            console.log('ID del pago a eliminar:', idPago);

            if (confirm('¿Seguro que deseas eliminar este pago?')) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4) {
                        if (xhr.status == 200) {
                            // Manejar la respuesta del servidor (puedes mostrar un mensaje de éxito, recargar la página, etc.)
                            alert(xhr.responseText);
                            // Puedes recargar la página para actualizar la lista de pagos
                            location.reload();
                        } else {
                            // Manejar cualquier error
                            alert('Error al intentar eliminar el pago');
                        }
                    }
                };
                xhr.open('GET', '../config/eliminar_pago.php?id=' + idPago, true);
                xhr.send();
            }
        }
    </script>
</body>

</html>
