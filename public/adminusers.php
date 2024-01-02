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

// No cerrar la conexión aquí para poder realizar la consulta después

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Usuarios - Ericiosa</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css' rel='stylesheet'>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
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
                        href="adminusers.php" class="nav_link active"> <i class='bx bx-user nav_icon'></i> <span
                            class="nav_name">Usuarios</span> </a> <a href="adminproduct.php" class="nav_link"> <i
                            class='bx bx-folder nav_icon'></i> <span class="nav_name">Productos</span> </a> <a
                        href="adminstats.php" class="nav_link"> <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span
                            class="nav_name">Stats</span> </a>
                        <a href="adminmail.php" class="nav_link"><i class='bx bx-envelope'></i><span class="nav_name">Mails</span> </a>
                </div>
            </div> <a href="../config/logout.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span
                    class="nav_name">Cerrar Sesion</span> </a>
        </nav>
    </div>

    <!-- Container Main start -->
    <div class="height-100 bg-light">
        <h4>Usuarios</h4>

        <!-- Search Form -->
        <form method="POST" action="">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Buscar usuario" name="search">
                <button class="btn btn-outline-secondary" type="submit" name="submit">Buscar</button>
            </div>
        </form>

        <?php
        // Procesar la búsqueda
        if (isset($_POST['submit'])) {
            $search = $_POST['search'];
            $query = "SELECT * FROM usuarios WHERE id LIKE '%$search%' OR nombre LIKE '%$search%' OR email LIKE '%$search%' OR telefono LIKE '%$search%' OR usuario LIKE '%$search%'";
        } else {
            // Consultar todos los usuarios desde la base de datos
            $query = "SELECT * FROM usuarios";
        }

        // Ejecutar la consulta
        $result = mysqli_query($conn, $query);

        if (!$result) {
            echo "Error en la consulta: " . mysqli_error($conn);
            exit();
        }

        // Mostrar los usuarios en la tabla
        echo '<table class="table">';
        echo '<thead>';
        echo '<tr>';
        echo '<th scope="col">ID</th>';
        echo '<th scope="col">Nombre</th>';
        echo '<th scope="col">Username</th>';
        echo '<th scope="col">Email</th>';
        echo '<th scope="col">Telefono</th>';
        echo '<th scope="col">Acciones</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['nombre'] . '</td>';
            echo '<td>' . $row['usuario'] . '</td>';
            echo '<td>' . $row['email'] . '</td>';
            echo '<td>' . $row['telefono'] . '</td>';
            echo '<td>';
            echo '<button class="btn btn-danger" onclick="eliminarUsuario(' . $row['id'] . ')">Eliminar</button>';
            echo '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
        ?>
    </div>

    <script type='text/javascript'
        src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js'></script>
    <script src="../config/sidebar.js"></script>
    <script type='text/javascript'>
        function eliminarUsuario(idUsuario) {
            console.log('ID del usuario a eliminar:', idUsuario);

            if (confirm('¿Seguro que deseas eliminar este usuario?')) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4) {
                        if (xhr.status == 200) {
                            // Manejar la respuesta del servidor (puedes mostrar un mensaje de éxito, recargar la página, etc.)
                            alert(xhr.responseText);
                            // Puedes recargar la página para actualizar la lista de usuarios
                            location.reload();
                        } else {
                            // Manejar cualquier error
                            alert('Error al intentar eliminar el usuario');
                        }
                    }
                };
                xhr.open('GET', '../config/eliminar_usuario.php?id=' + idUsuario, true);
                xhr.send();
            }
        }
    </script>
</body>

</html>
