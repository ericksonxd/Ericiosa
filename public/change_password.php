
    <!DOCTYPE html>
    <html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <title> Ericiosa - Reestablecer Contraseña </title>
        <link rel="stylesheet" href="css/loginstyle.css">
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> 
    </head>
    <body>
    <div class="container">
        <div class="nav">
            <a class="return-btn" href="index.php">Pagina Principal</a>
            <div>
                <a class="login-btn" href="register.php">Regístrate</a>
            </div>
        </div>
        <hr>
        <div class="title">Reestablecer Contraseña</div>
        <div class="content">
            <form action="login.php" method="POST">
                <div class="user-details">
                    <div class="input-box">
                         
                        <span>Bienvenido:</span>

                        <span class="details"><ion-icon name="lock-open-outline"></ion-icon>Ingrese Su nueva contraseña</span>
                        <input type="password" name="new_password" id="password" autocomplete="current-password" placeholder="Ingrese su nueva contraseña" required>
                        <span class="details"><ion-icon name="refresh-outline"></ion-icon>Confirme su contraseña</span>
                        <input type="password" name="auth_password" id="auth_password" autocomplete="current-password" placeholder="Confirme su contraseña" required>
                        <span class="details"><ion-icon name="lock-closed-outline"></ion-icon>Código de verificación</span>

                    </div>
                </div>
                <div class="button">
                    <input type="submit" name="change" value="Cambiar Contraseña">
                </div>
            </form>
            <div class="media-options"></div>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    </body>
    </html>
