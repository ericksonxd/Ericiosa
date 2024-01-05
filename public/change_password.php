<?php
$id = isset($_GET['id']) ? $_GET['id'] : null;
if ($id === null) {
    // Manejar el caso en que 'id' no está presente en la URL
    // Puedes redirigir al usuario o mostrar un mensaje de error
    die("Error: El parámetro 'id' no está presente.");
}


?>


<!DOCTYPE html>
    <html lang="en" dir="ltr">
      <head>
        <meta charset="UTF-8">
        <title> Ericiosa - Olvide mi contraseña </title>
        <link rel="stylesheet" href="css/loginstyle.css">
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
      </head>
    <body>
    <div class="container">
        <div class="nav">
            <a class="return-btn" href="index.php">Pagina Principal</a>
           
        </div>
        <hr>
        <div class="title">Cambia tu Contraseña</div>
        <div class="content">
        <?php
          // Obtén el id de la URL
          if (isset($_GET['error'])) {
            $error = $_GET['error'];
            echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
        }
          
          $id = isset($_GET['id']) ? $_GET['id'] : null;


          
          // Verifica si 'id' está presente en la URL
          if ($id === null) {
            // Manejar el caso en que 'id' no está presente en la URL
            // Puedes redirigir al usuario o mostrar un mensaje de error
            die("Error: El parámetro 'id' no está presente.");
          }

          // Obtén el nombre de usuario de la base de datos
          include "../config/conexion.php";
          $query = "SELECT nombre FROM usuarios WHERE id = ?";
          $stmt = $conn->prepare($query);
          $stmt->bind_param('i', $id);
          $stmt->execute();
          $stmt->bind_result($nombreDeUsuario);
          $stmt->fetch();
          $stmt->close();
        ?>

        <span>Bienvinid@: <?php echo $nombreDeUsuario; ?> Por favor ingresa tu nueva contraseña</span>
        <br>
        <br>
        <form action="../config/change_pass.php?id=<?php echo $id; ?>" method="POST">
          <div class="user-details">
            <div class="input-box">
              <span class="details"><ion-icon name="lock-closed-outline"></ion-icon>Ingrese su nueva contraseña</span>
              <input type="password" name="new_password" autocomplete="new-password" placeholder="Ingrese su nueva contraseña" required>
              <span class="details"><ion-icon name="refresh-outline"></ion-icon></ion-icon>Confirme su nueva contraseña</span>
              <input type="password" name="auth_new_password" id="auth_new_password" autocomplete="off" placeholder="Confirme su nueva contraseña" required>
            </div>
          </div>
          <div class="button">
            <input type="submit" name="login" value="Cambiar Contraseña">
          </div>
        </form>

            </div>
        </div>
    </div>

    
    </div>
      </div>

    </body>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    </html>
