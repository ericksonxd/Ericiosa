<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Ericiosa - Inicia Sesión </title>
    <link rel="stylesheet" href="css/loginstyle.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
<div class="nav">
<a class="return-btn" href="index.php">Pagina Principal</a>   

<a class="login-btn" href="register.php">Registrate</a>
</div>
<hr>
    <div class="title"> Inicia Sesión en Ericiosa</div>
    <div class="content">
      <form action="login.php" method="POST">
        <div class="user-details">
          <div class="input-box">
         
          <div class="input-box">
            <span class="details"><ion-icon name="mail-outline"></ion-icon> Correo electrónico</span>
            <input type="email" name="email"  autocomplete="email" placeholder="Ingrese su correo electrónico" required>
          </div>
        
          <div class="input-box">
            <span class="details"><ion-icon name="lock-open-outline"></ion-icon>Contraseña</span>
            <input type="password" name="password"autocomplete="current-password" placeholder="Ingrese su contraseña" required>
          </div>
        
        </div>         
        <div class="button">
          <input type="submit" name="login" value="Inicia Sesion">
        </div>
      </form>
 

      <?php
session_start();
include '../config/conexion.php';

if (isset($_SESSION['usuario'])) {
    header("Location: index.php");
}

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM `usuarios` WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['usuario'] = $row['nombre'];
            header("Location: catalogo.php");
        } else {
            echo '<script>alert("Contraseña incorrecta")</script>';
        }
    } else {
        echo '<script>alert("Usuario no encontrado")</script>';
    }
}

mysqli_close($conn);
?>



      <div class="media-options">
        <a href="#" class="field google">
            <img src="./css/images/google.png" alt="" class="google-img">
            <span>Ingresa con Google</span>
        </a>
    </div>
      </div>
  </div>

</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>
