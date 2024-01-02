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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Ericiosa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
                    <a href="adminproduct.php" class="nav_link active"> <i class='bx bx-folder nav_icon'></i> <span
                            class="nav_name">Productos</span> </a>
                    <a href="adminstats.php" class="nav_link"> <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span
                            class="nav_name">Stats</span> </a>
                    <a href="adminmail.php" class="nav_link"><i class='bx bx-envelope'></i><span
                            class="nav_name">Mails</span> </a>
                </div>
            </div>
            <a href="../config/logout.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">Cerrar Sesion</span> </a>
        </nav>
    </div>
    <div class="height-100 bg-light">
        <h4>Productos</h4>
        <a class="btn btn-dark" href="./addproduct.php ">Añadir Producto</a>
        <hr>
        <!-- Search Form -->
        <form method="POST" action="">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Buscar producto" name="search">
                <button class="btn btn-outline-secondary" type="submit" name="submit">Buscar</button>
            </div>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Precio</th>
                    <th scope="col">likes</th>
                    <th scope="col">links</th>
                    <th scope="col">imagen1</th>
                    <th scope="col">imagen2</th>
                    <th scope="col">imagen3</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Incluir el archivo de conexión a la base de datos
                include '../config/conexion.php';

                // Procesar la búsqueda
                if (isset($_POST['submit'])) {
                    $search = $_POST['search'];
                    $query = "SELECT * FROM products WHERE nombre LIKE '%$search%' OR descripcion LIKE '%$search%' OR precio LIKE '%$search%' OR likes LIKE '%$search%'";
                } else {
                    // Consultar todos los productos desde la base de datos
                    $query = "SELECT * FROM products";
                }

                // Ejecutar la consulta
                $resultado = mysqli_query($conn, $query); // Cambiado de $conexion a $conn

                // Mostrar los productos en la tabla
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo '<tr>';
                    echo '<td>' . $fila['id_product'] . '</td>';
                    echo '<td>' . $fila['nombre'] . '</td>';
                    echo '<td>' . $fila['descripcion'] . '</td>';
                    echo '<td>' . $fila['precio'] . '</td>';
                    echo '<td>' . $fila['likes'] . '</td>';  /* aca esta donde aparecen los likes */
                    echo '<td>';
                    echo '<a href="' . $fila['link_x'] . '">Twitter</a> | ';
                    echo '<a href="' . $fila['link_pinterest'] . '">Pinterest</a> | ';
                    echo '<a href="' . $fila['link_instagram'] . '">Instagram</a> | ';
                    echo '<a href="' . $fila['link_youtube'] . '">YouTube</a>';
                    echo '</td>';
                    echo '<td>';
                    echo '<img src="../private/images_product/' . $fila['imagen1'] . '" alt="Imagen 1" width="50">';
                    echo '</td>';
                    echo '<td>';
                    echo '<img src="../private/images_product/' . $fila['imagen2'] . '" alt="Imagen 2" width="50">';
                    echo '</td>';
                    echo '<td>';
                    echo '<img src="../private/images_product/' . $fila['imagen3'] . '" alt="Imagen 3" width="50">';
                    echo '</td>';
                    echo '<td>';
                    if ($fila['destacado'] == 1) {
                        echo '<button class="btn btn-info" onclick="toggleDestacado(' . $fila['id_product'] . ', false)">Quitar Destacado</button>';
                    } else {
                        echo '<button class="btn btn-warning" onclick="toggleDestacado(' . $fila['id_product'] . ', true)">Destacar</button>';
                    }
                    echo ' | <a class="btn btn-success" href="editar_producto.php?id=' . $fila['id_product'] . '">Editar</a> | <button class="btn btn-danger" onclick="eliminarProducto(' . $fila['id_product'] . ')">Eliminar</button>';
                    echo '</td>';
                    echo '</tr>';
                }

                // Cerrar la conexión a la base de datos
                mysqli_close($conn); // Cambiado de $conexion a $conn
                ?>
            </tbody>
        </table>
    </div>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../config/sidebar.js"></script>
    <script type="text/javascript">
        function eliminarProducto(idProducto) {
            console.log('ID del producto a eliminar:', idProducto);

            if (confirm('¿Seguro que deseas eliminar este producto?')) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4) {
                        if (xhr.status == 200) {
                            // Manejar la respuesta del servidor (puedes mostrar un mensaje de éxito, recargar la página, etc.)
                            alert(xhr.responseText);
                            // Puedes recargar la página para actualizar la lista de productos
                            location.reload();
                        } else {
                            // Manejar cualquier error
                            alert('Error al intentar eliminar el producto');
                        }
                    }
                };
                xhr.open('GET', '../config/eliminar_producto.php?id=' + idProducto, true);
                xhr.send();
            }
        }

        function toggleDestacado(idProducto, destacar) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        // Manejar la respuesta del servidor
                        alert(xhr.responseText);
                        // Recargar la página para reflejar los cambios
                        location.reload();
                    } else {
                        alert('Error al intentar destacar/quitar destacado el producto');
                    }
                }
            };
            xhr.open('GET', '../config/toggle_destacado.php?id=' + idProducto + '&destacar=' + destacar, true);
            xhr.send();
        }
    </script>
</body>

</html>
