<!DOCTYPE html>
    <html lang="en" dir="ltr">
      <head>
        <meta charset="UTF-8">
        <title> Ericiosa - Olvide mi contraseña </title>
        <link rel="stylesheet" href="css/loginstyle.css">
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
      </head>
    <body>
    <div class="container">
        <div class="nav">
            <a class="return-btn" href="index.php">Pagina Principal</a>

            <div> <a class="login-btn" href="register.php">Registrate</a><span> ó </span> <a class="login-btn"  href="login.php">Inicia sesion</a></div>
           
        </div>
        <hr>
        <div class="title">Olvidaste tu contraseña?</div>
        <div class="content">
            <span>Por favor ingresa el correo electronico de tu cuenta:</span>
            <br>
            <form action="../config/forget.php" method="POST">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details"><ion-icon name="mail-outline"></ion-icon> Correo electrónico</span>
                        <input type="email" name="email" id="email" autocomplete="email" placeholder="Ingrese su correo electrónico" required>
                    </div>
         
                </div>

                <div class="button">
                    <input type="submit" name="login" value="Enviar">
                </div>
            </form>

            <?php 
    if(isset($_GET['message'])){
     
    ?>
      <div class="message" role="alert">
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
    <?php
    }
    ?>

            </div>
        </div>
    </div>

    
    </div>
      </div>

    </body>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    </html>
