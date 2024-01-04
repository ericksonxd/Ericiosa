
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Ericiosa - Recuperar Contraseña</title>
    <link rel="stylesheet" href="css/loginstyle.css">
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="nav">
            <a class="return-btn" href="index.php">Pagina Principal</a>
            <div>
                <a class="login-btn" href="login.php">Inicia sesión</a>
                <span> ó </span>
                <a class="login-btn" href="register.php">Regístrate</a>
            </div>
        </div>
        <hr>
        <div class="title">Olvidé mi contraseña</div>
        <div class="content">
            <form action="" >
                <div class="user-details">
                    <div class="input-box">
                        <span class="details"><ion-icon name="mail-outline"></ion-icon> Correo electrónico</span>
                        <input type="email" name="email" id="email" autocomplete="email" placeholder="Ingrese el correo electrónico de su cuenta" required>
                    </div>
                    <div class="button">
                        <input type="submit" name="verify" class="send-button" value="Enviar">
                    </div>
                </div>
            </form>
        </div>
    </div>
  

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
