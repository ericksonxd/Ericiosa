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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Ericiosa</title>
    <link rel="icon" href="./img/logo.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>

<nav class="navbar bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
        <a href="dashboard.php" class="navbar-brand">GaleryU</a>
        <form class="d-flex">
            <h1 class="navbar-brand" href="#">Bienvenid@ Administrador(@): <?php echo $admin_nombre; ?></h1>  <a class="btn btn-danger" href="../config/logout.php">Cerrar sesión</a>
        </form>
    </div>
</nav>

    <div class="container">

        <br>

        <center>
            <h1> Añadir un producto</h1>
        </center>
        <br>
        <div class="container">

            <a class="btn btn-dark" href="./agregarimg.php "> Añadir producto</a>
            <hr>

            <div class="container">

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">imagen</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        include "../config/conexion.php";

                        $sql = " SELECT * FROM imagenes ";
                        $resultado = $conexion->query($sql);

                        while ($fila = $resultado->fetch_assoc()) { ?>

                            <tr>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo $fila['ID']?></th>
                                <td> <?php echo $fila['nombre']?> </td>
                                <td><?php echo $fila['descripcion']?> </td>
                                <td><img style="width: 300px;"   src="data:image/jpg;base64,<?php echo base64_encode($fila['imagen'])?>" alt=""></td>
                                <td> 
                                    <a href="vista_editar.php?ID=<?php echo $fila['ID']?>" class="btn btn-warning">editar</a>
                                    <a href="eliminarimagen.php?ID=<?php echo $fila['ID']?>" class="btn btn-danger">Eliminar </a>
                            
                            
                            </td>
                            </tr>
                            <tr>
                 
                        
                    </tbody>

                <?php  } ?>
                </table>
            </div>

        </div>





    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>
</html>