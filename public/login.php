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
        <div class="title">Inicia Sesión en Ericiosa</div>
        <div class="content">
            <form action="login.php" method="POST">
                <div class="user-details">
                    <div class="input-box">

                    <?php 
    if(isset($_GET['message'])){
     
    ?>
      <div class="alert" role="alert">
        <?php 
        switch ($_GET['message']) {
          case 'ok':
            echo 'Por favor, revisa tu correo';
            break;
          case 'success_password':
            echo 'Inicia sesión con tu nueva contraseña';
            break;
            
          default:
            echo 'Algo salió mal, intenta de nuevo';
            break;
        }
        ?>
      </div>
      <br>
    <?php
    }
    ?>

                        <span class="details"><ion-icon name="mail-outline"></ion-icon> Correo electrónico</span>
                        <input type="email" name="email" id="email" autocomplete="email" placeholder="Ingrese su correo electrónico" required>
                    </div>
                    <div class="input-box">
                        <span class="details"><ion-icon name="lock-open-outline"></ion-icon> Contraseña</span>
                        <input type="password" name="password" id="password" autocomplete="current-password" placeholder="Ingrese su contraseña" required>
                    </div>
                </div>
               <a href="forget_password.php" class="google" >Olvidaste tu contraseña?</a> 
               <br>
               <br>

                <div class="button">
                    <input type="submit" name="login" value="Inicia Sesion">
                </div>
            </form>


            </div>



        </div>
    </div>
    
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
            $_SESSION['usuario_id'] = $row['id'];  // Asegúrate de cambiar 'id' al nombre real de tu columna
            $_SESSION['usuario'] = $row['nombre'];
            header("Location: index.php");
        } else {
            echo '<script>alert("Contra-seña incorrecta")</script>';
        }
    } else {
        echo '<script>alert("Usuario no encontrado")</script>';
    }
 }    
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>

     
          </div>
      </div>

    </body>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    </html>
