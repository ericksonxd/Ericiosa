<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['usuario_tipo'] !== 'admin') {
    header("Location: index.php");
    exit();
}

include "../config/conexion.php";

// Inicializar $admin_nombre
$admin_nombre = '';

// Consultar el nombre del administrador
$sql_admin = "SELECT nombre FROM admin WHERE email = '{$_SESSION['usuario']}'";
$result_admin = mysqli_query($conn, $sql_admin);

if (!$result_admin) {
    echo "Error en la consulta del administrador: " . mysqli_error($conn);
    exit();
}

// Verificar si se encontró el administrador y obtener el nombre
if (mysqli_num_rows($result_admin) > 0) {
    $admin_data = mysqli_fetch_assoc($result_admin);
    $admin_nombre = $admin_data['nombre'] ?? '';
}

// Procesar la búsqueda
if (isset($_POST['submit'])) {
    $search = $_POST['search'];
    $query_messages = "SELECT * FROM custom_orders WHERE 
                        user_name LIKE '%$search%' OR
                        user_email LIKE '%$search%' OR
                        event_date LIKE '%$search%' OR
                        contact_number LIKE '%$search%' OR
                        address LIKE '%$search%' OR
                        order_details LIKE '%$search%'
                        ORDER BY created_at DESC";
} else {
    // Consultar todos los mensajes de correo electrónico
    $query_messages = "SELECT * FROM custom_orders ORDER BY created_at DESC";
}

// Ejecutar la consulta
$result_messages = mysqli_query($conn, $query_messages);

if (!$result_messages) {
    echo "Error en la consulta de mensajes de correo electrónico: " . mysqli_error($conn);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Correos - Ericiosa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
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
            <div>
                <a href="#" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span
                        class="nav_logo-name">Ericiosa - Admin</span> </a>
                <div class="nav_list">
                    <a href="dashboard.php" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span
                            class="nav_name">Dashboard</span> </a>
                    <a href="adminusers.php" class="nav_link"> <i class='bx bx-user nav_icon'></i> <span
                            class="nav_name">Usuarios</span> </a>
                    <a href="adminproduct.php" class="nav_link"> <i class='bx bx-folder nav_icon'></i> <span
                            class="nav_name">Productos</span> </a>
                    <a href="adminstats.php" class="nav_link"> <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span
                            class="nav_name">Stats</span> </a>
                    <a href="adminmail.php" class="nav_link active"><i class='bx bx-envelope'></i><span
                            class="nav_name">Mails</span> </a>
                </div>
            </div>
            <a href="../config/logout.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span
                    class="nav_name">Cerrar Sesion</span> </a>
        </nav>
    </div>

  
    <div class="height-100 bg-light">
        <h4>Lista de Mensajes de Correo Electrónico</h4>

        <!-- Search Form -->
        <form method="POST" action="">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Buscar mensaje" name="search">
                <button class="btn btn-outline-secondary" type="submit" name="submit">Buscar</button>
            </div>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo Electrónico</th>
                    <th scope="col">Fecha del Evento</th>
                    <th scope="col">Número de Contacto</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Detalles del Pedido</th>
                    <th scope="col">Fecha de Creación</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>

         
                <?php
                while ($row = mysqli_fetch_assoc($result_messages)) {
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['user_name'] . '</td>';
                    echo '<td>' . $row['user_email'] . '</td>';
                    echo '<td>' . $row['event_date'] . '</td>';
                    echo '<td>' . $row['contact_number'] . '</td>';
                    echo '<td>' . $row['address'] . '</td>';
                    echo '<td>' . $row['order_details'] . '</td>';
                    echo '<td>' . $row['created_at'] . '</td>';
                    echo '<td>';
                    echo ' <input type="checkbox" name="marcar_leido[]" value="' . $row['id'] . '"> Marcar';
                    echo '<button class="btn btn-danger" onclick="eliminarCorreo(' . $row['id'] . ')">Eliminar</button>';
                    echo '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
        
        <!-- Botón para eliminar correos seleccionados -->
        <button class="btn btn-danger" onclick="eliminarCorreosSeleccionados()">Eliminar Correos Seleccionados</button>
    </div>

    <script type='text/javascript'
        src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js'></script>
    <script src="../config/sidebar.js"></script>
    <script type='text/javascript'>
        function eliminarCorreo(idCorreo) {
            console.log('ID del correo a eliminar:', idCorreo);

            if (confirm('¿Seguro que deseas eliminar este correo?')) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4) {
                        if (xhr.status == 200) {
                            // Manejar la respuesta del servidor (puedes mostrar un mensaje de éxito, recargar la página, etc.)
                            alert(xhr.responseText);
                            // Puedes recargar la página para actualizar la lista de correos
                            location.reload();
                        } else {
                            // Manejar cualquier error
                            alert('Error al intentar eliminar el correo');
                        }
                    }
                };
                xhr.open('GET', '../config/eliminar_correo.php?id=' + idCorreo, true);
                xhr.send();
            }
        }

        function eliminarCorreosSeleccionados() {
            var checkboxes = document.getElementsByName('marcar_leido[]');
            var correosSeleccionados = [];

            checkboxes.forEach(function (checkbox) {
                if (checkbox.checked) {
                    correosSeleccionados.push(checkbox.value);
                }
            });

            if (correosSeleccionados.length === 0) {
                alert('Por favor, selecciona al menos un correo para eliminar.');
                return;
            }

            if (confirm('¿Seguro que deseas eliminar los correos seleccionados?')) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4) {
                        if (xhr.status == 200) {
                            // Manejar la respuesta del servidor (puedes mostrar un mensaje de éxito, recargar la página, etc.)
                            alert(xhr.responseText);
                            // Puedes recargar la página para actualizar la lista de correos
                            location.reload();
                        } else {
                            // Manejar cualquier error
                            alert('Error al intentar eliminar los correos seleccionados');
                        }
                    }
                };
                xhr.open('GET', '../config/eliminar_correos_seleccionados.php?ids=' + correosSeleccionados.join(','), true);
                xhr.send();
            }
        }
    </script>

    <script type='text/javascript'
        src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js'></script>
    <script src="../config/sidebar.js"></script>
    <script type='text/javascript'>
        var myLink = document.querySelector('a[href="#"]');
        myLink.addEventListener('click', function (e) {
            e.preventDefault();
        });
    </script>
    <script src="../config/sidebar.js" ></script>
</body>

</html>