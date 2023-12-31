<<<<<<< HEAD
<?php
session_start();
include '../config/conexion.php';

// Verificar si es una solicitud POST y si está presente el parámetro 'like'
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['like'])) {
    // Asegurarse de que la sesión esté iniciada y 'usuario_id' esté definido
    if (isset($_SESSION['usuario_id'])) {
        $user_id = $_SESSION['usuario_id'];
        $product_id = mysqli_real_escape_string($conn, $_POST['like']);

        // Verificar si el usuario ya le dio like a este producto
        $check_like_query = "SELECT * FROM user_likes WHERE id_user = $user_id AND id_product = $product_id";
        $check_like_result = mysqli_query($conn, $check_like_query);

        if (mysqli_num_rows($check_like_result) > 0) {
            // Si ya dio like, eliminar el like
            $delete_like_query = "DELETE FROM user_likes WHERE id_user = $user_id AND id_product = $product_id";
            mysqli_query($conn, $delete_like_query);

            // Restar 1 al contador de likes en la tabla products
            $update_likes_query = "UPDATE products SET likes = likes - 1 WHERE id_product = $product_id";
            mysqli_query($conn, $update_likes_query);

            // Devolver respuesta al cliente
            echo json_encode(['action' => 'Unlike', 'like_id' => null]);
        } else {
            // Si no dio like, agregar el like
            $add_like_query = "INSERT INTO user_likes (id_user, id_product) VALUES ($user_id, $product_id)";
            mysqli_query($conn, $add_like_query);

            // Incrementar el contador de likes en la tabla products
            $update_likes_query = "UPDATE products SET likes = likes + 1 WHERE id_product = $product_id";
            mysqli_query($conn, $update_likes_query);

            // Obtener el ID del nuevo like
            $get_like_id_query = "SELECT id_like FROM user_likes WHERE id_user = $user_id AND id_product = $product_id";
            $result = mysqli_query($conn, $get_like_id_query);
            $row = mysqli_fetch_assoc($result);
            $like_id = $row['id_like'];

            // Devolver respuesta al cliente
            echo json_encode(['action' => 'Like', 'like_id' => $like_id]);
        }
    } else {
        // La sesión no está iniciada, manejar el error según tus necesidades
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Error de autenticación: Inicia sesion para dar Like']);
=======
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
                        <span class="details"><ion-icon name="mail-outline"></ion-icon> Correo electrónico</span>
                        <input type="email" name="email" id="email" autocomplete="email" placeholder="Ingrese su correo electrónico" required>
                    </div>
                    <div class="input-box">
                        <span class="details"><ion-icon name="lock-open-outline"></ion-icon> Contraseña</span>
                        <input type="password" name="password" id="password" autocomplete="current-password" placeholder="Ingrese su contraseña" required>
                    </div>
                </div>
                <div class="button">
                    <input type="submit" name="login" value="Inicia Sesion">
                </div>
            </form>
            <div class="media-options">
                <a href="#" class="field google">
                    <img src="./css/images/google.png" alt="" class="google-img">
                    <span>Ingresa con Google</span>
                </a>
            </div>
        </div>
    </div>
    

          <?php
    session_start();
    include '../config/conexion.php';

    if (isset($_SESSION['usuario'])) {
        header("Location: index.php");
>>>>>>> parent of 762d727 (Sistema de Likes en Catalogo.php)
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
                header("Location: index.php");
            } else {
                echo '<script>alert("Contraseña incorrecta")</script>';
            }
        } else {
            echo '<script>alert("Usuario no encontrado")</script>';
        }
    }

    mysqli_close($conn);
    ?>



     
          </div>
      </div>

    </body>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    </html>
