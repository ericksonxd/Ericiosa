<?php
session_start();
include '../config/conexion.php';


if(isset($_SESSION['usuario']))
{
  header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Ericiosa - Registrate </title>
    <link rel="stylesheet" href="css/registerstyle.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
<div class="nav">
<a class="return-btn" href="">Página Principal</a>   

<a class="login-btn" href="login.php">Inicia sesión</a>
</div>
<hr>
    <div class="title"> Registrate en Ericiosa</div>
    <div class="content">
      <form action="register.php" method="POST">
        <div class="user-details">
          <div class="input-box">
            <span class="details"><ion-icon name="people-outline"></ion-icon> Nombre Completo</span>
            <input type="text"  autocomplete="name" name="nombre"  placeholder="Ingrese su nombre completo" required>
          </div>
          <div class="input-box">
            <span class="details"><ion-icon name="person-outline"></ion-icon> Nombre de Usuario</span>
            <input type="text" name="user" autocomplete="username" placeholder="Ingrese su nombre de Usuario" required>
          </div>
          <div class="input-box">
            <span class="details"><ion-icon name="mail-outline"></ion-icon> Correo electrónico</span>
            <input type="email" name="email"  autocomplete="email" placeholder="Ingrese su correo electrónico" required>
          </div>
          <div class="input-box">
            <span class="details"><ion-icon name="phone-portrait-outline"></ion-icon> Numero de teléfono</span>
            <input type="number" name="telefono"  autocomplete="tel"  placeholder="Ingresa tu numero de teléfono" required>
          </div>
          <div class="input-box">
            <span class="details"><ion-icon name="lock-open-outline"></ion-icon>Contraseña</span>
            <input type="password" name="password"autocomplete="current-password" placeholder="Ingrese su contraseña" required>
          </div>
          <div class="input-box">
            <span class="details"> <ion-icon name="lock-closed-outline"></ion-icon>Confirmar Contraseña</span>
            <input type="password" name="confpassword"  placeholder="Confirme su contraseña" required>
          </div>
        </div>
      
        <div class="button">
          <input type="submit" name="registrar" value="Registrate">
        </div>
        <hr>
        <center> <span> Ó </span> </center>
       
        <hr>
        <div class="media-options">
                    <a href="#" class="field google">
                        <img src="./css/images/google.png" alt="" class="google-img">
                        <span>Ingresa con Google</span>
                    </a>
                </div>
      </form>

      <?php

// Incluimos el archivo de conexión
require_once '../config/conexion.php';

// Comprobamos si el formulario ha sido enviado
// ...

if (isset($_POST['registrar'])) {
  // Recogemos los datos del formulario
  $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
  $usuario = mysqli_real_escape_string($conn, $_POST['user']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $telefono = mysqli_real_escape_string($conn, $_POST['telefono']);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $confpassword = password_hash($_POST['confpassword'], PASSWORD_DEFAULT);

  // Validamos los datos
  if (empty($nombre) || empty($usuario) || empty($email) || empty($_POST['password']) || empty($_POST['confpassword'])) {
      echo '<script>alert("Todos los campos son obligatorios")</script>';
  } elseif ($_POST['password'] != $_POST['confpassword']) {
      echo '<script>alert("Las contraseñas no coinciden")</script>';
  } else {
      // Verificamos si el email ya existe
      $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $stmt->store_result();

      if ($stmt->num_rows == 1) {
          echo '<script>alert("El email ya existe")</script>';
      } else {
          // Insertamos los datos en la base de datos
          $stmt = $conn->prepare("INSERT INTO usuarios (nombre, usuario, email, password, telefono) VALUES (?, ?, ?, ?, ?)");
          $stmt->bind_param("sssss", $nombre, $usuario, $email, $password, $telefono);

          if ($stmt->execute()) {
              echo '<script>alert("Registro exitoso")</script>';
              // Redireccionar a la página de inicio de sesión
              header("Location: login.php");
          } else {
              echo '<script>alert("Error al registrarse")</script>';
          }
      }
      $stmt->close();
  }
}

?>

     
    </div>
  </div>

</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>
