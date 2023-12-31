<?php
session_start();
include "../config/conexion.php";
require '../vendor/autoload.php'; // Incluye el autoloader de Composer
include "../config/credentials.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Verifica la conexión con la base de datos
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Configuración de PHPMailer
$mail = new PHPMailer(true);
$errors = [];

try {
    // Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      // Enable verbose debug output
    $mail->isSMTP();                                         // Send using SMTP
    $mail->Host       = $config['smtp_host'];
    $mail->SMTPAuth   = true;
    $mail->Username   = $config['smtp_username'];
    $mail->Password   = $config['smtp_password'];            // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;       // Enable implicit TLS encryption
    $mail->Port       = 587;                                 // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Procesar el formulario de pedido personalizado
        $user_name = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : (isset($_POST['user_name']) ? $_POST['user_name'] : '');
        $user_email = isset($_SESSION['usuario_email']) ? $_SESSION['usuario_email'] : (isset($_POST['user_email']) ? $_POST['user_email'] : '');
        $event_date = isset($_POST['event_date']) ? $_POST['event_date'] : '';
        $contact_number = isset($_POST['contact_number']) ? $_POST['contact_number'] : '';
        $address = isset($_POST['address']) ? $_POST['address'] : '';
        $order_details = isset($_POST['order_details']) ? $_POST['order_details'] : '';

        // Validación del número de teléfono
        if (!preg_match('/^\+\d{1,3}\d+$/', $contact_number)) {
            $errors[] = "Formato de número de teléfono inválido. Debe ser +código de área + número de teléfono";
        }

        // Validación de otros campos
        if (empty($user_name) || empty($user_email) || empty($event_date) || empty($contact_number) || empty($address) || empty($order_details)) {
            $errors[] = "Todos los campos son obligatorios";
        }

        if (empty($errors)) {
            // Configuración del correo
            $mail->setFrom($config['smtp_username'], $user_name);
            $mail->addAddress($config['smtp_username'], 'Ericiosa');

            // Contenido del correo
            $mail->isHTML(true);
			$mail->Subject = 'Pedido personalizado de ' . $user_name . ' - Ericiosa';
			$mail->Body    = "Nombre: $user_name <br> Correo: $user_email <br> Fecha del evento: $event_date <br> Teléfono: $contact_number <br> Dirección: $address <br> Detalles: $order_details";
            // Envío del correo
            $mail->send();

            echo '<script>alert("Correo enviado correctamente");</script>';
        }
    }
} catch (Exception $e) {
    $errors[] = 'Error en el envío del formulario: ' . $e->getMessage();
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Ericiosa - Custom Order</title>
		<link rel="stylesheet" href="../public/css/customstyle.css"/>
		<link rel="icon" type="image/png" href="../private/logos/logo 7.png">
		<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	</head>
	<body>
		<header>
			<div class="container-hero">
				<div class="container hero">
					<div class="customer-support">
					<i class="fa-solid fa-mobile"></i>
						<div class="content-customer-support">
							<span class="text">Contactanos</span>
							<span class="number"><a class="ws" href="">000-000-000</a></span>
						</div>
					</div>

					<div class="container-logo">
					
						<h1 class="logo"><a href="index.php"><img  class="logo-img" src="../private/logos/logo 9.png" alt=""></a></h1>
					</div>

					<div class="container-user">
					<?php
                    // Verifica si hay una sesión iniciada
                    if (isset($_SESSION["usuario"])) {
                        // Si el usuario está conectado, muestra el nombre, enlace al perfil y enlace de logout
                        echo '<span class="username">' . $_SESSION["usuario"] . '</span>';
                        echo '<a href="perfil.php"><i class="fa-solid fa-user"></i></a>';
                        echo '<a href="../config/logout.php" class="logout-button" ><i class="fa-solid fa-right-from-bracket"></i></a>';
                    } else {
                        // Si el usuario no está conectado, muestra el enlace de inicio de sesión
                        echo '<a href="login.php"  ><i class="fa-solid fa-user"></i></a>';
                    }
                    ?>
				
				
		
					</div>
				</div>
			</div>

			<div class="container-navbar">
   <nav class="navbar container">
      <i class="fa-solid fa-bars" id="mobile-menu-btn"></i>
      <ul class="menu-mobile">
         <li><a href="index.php">Inicio</a></li>
         <li><a href="catalogo.php">Catalogo</a></li>
         <li><a href="cursos.php">Cursos</a></li>
         <li><a href="custom.php">Encargos</a></li>
         <li><a href="redessociales.php">Redes Sociales</a></li>
      </ul>
      <ul class="menu">
         <li><a href="index.php">Inicio</a></li>
         <li><a href="catalogo.php">Catalogo</a></li>
         <li><a href="cursos.php">Cursos</a></li>
         <li><a href="custom.php">Encargos</a></li>
         <li><a href="redessociales.php">Redes Sociales</a></li>
      </ul>
   </nav>
</div>
		</header>

<main class="main-content" >  

<div class="container-product">

<div class="box">
<h1>Encargo Personalizado</h1>
<br>
<h2>Por favor usa el siguiente formulario para enviar tu orden. Te contactaremos en el menor tiempo posible via texto o e-mail para discutir los detalles y el precio. </h2>
<br>


<div class="custom-order-form">
    <form action="" method="POST">
        <div class="form-body">
            <i class="fa-regular fa-user"></i>
			<input type="text" name="user_name" placeholder="Nombre Completo" value="<?php echo isset($_POST['user_name']) ? htmlspecialchars($_POST['user_name']) : ''; ?>">
                            <i class="fa-regular fa-envelope"></i>
                            <input type="email" name="user_email" placeholder="Ingresa tu correo electrónico" value="<?php echo isset($_POST['user_email']) ? htmlspecialchars($_POST['user_email']) : ''; ?>">
                            <i class="fa-regular fa-calendar-days"></i><span>Fecha del evento</span>
                            <input type="date" name="event_date" value="<?php echo isset($_POST['event_date']) ? $_POST['event_date'] : ''; ?>">
                            <i class="fa-brands fa-whatsapp"></i>
                            <input type="text" name="contact_number" placeholder="Ingresa tu número de contacto" value="<?php echo isset($_POST['contact_number']) ? $_POST['contact_number'] : ''; ?>">
                            <input type="text" name="address" placeholder="Ingresa tu Dirección" value="<?php echo isset($_POST['address']) ? $_POST['address'] : ''; ?>">
                            <i class="fa-solid fa-circle-info"></i>
                            <span>Detalles de la orden</span>
                            <br>
                            <textarea name="order_details" id="description" cols="30" rows="10" minlength="20" maxlength="569" required placeholder="Ingresa una breve descripción del producto..."><?php echo isset($_POST['order_details']) ? htmlspecialchars($_POST['order_details']) : ''; ?></textarea>
                            <br>
            <input type="submit" class="send" value="Enviar Orden">
        </div>
    </form>
</div>

</div>



</div>


	 </main>


</section>
		
<footer class="footer">
			<div class="container container-footer">
				<div class="menu-footer">
					<div class="contact-info">
						<p class="title-footer">Información de Contacto</p>
						<ul>
							<li>
								Dirección:
							</li>
							<li>Teléfono: 000-000-000</li>
							<li>EmaiL: ericiosa@noemail.com</li>
						</ul>
						<div class="social-icons">
							  <span class="facebook">
							  <a href="https://twitter.com/ericiosa?lang=es"><i class="fa-brands fa-x-twitter"></i></a>
							</span>

							<span class="youtube">

							<a href="https://www.youtube.com/channel/UC8qlHJRf2-TgMw99GjoJQrg"><i class="fa-brands fa-youtube"></i></a>
				
							</span>
							<span class="pinterest">
							<a href="https://www.pinterest.com/ericiosa/"><i class="fa-brands fa-pinterest-p"></i></a>
								
							</span>
							<span class="instagram">
								<a href="https://www.instagram.com/ericiosa/?hl=es"><i class="fa-brands fa-instagram"></i></a>
				
							</span>
						</div>
					</div>

					<div class="information">
						<p class="title-footer">Información</p>
						<ul>
							<li><a href="index.php">Acerca de Nosotros</a></li>
							<li><a href="#">Contactános</a></li>
						</ul>
					</div>

					<div class="my-account">
						<p class="title-footer">Mi cuenta</p>

						<ul>
							<li><a href="perfil.php">Mi cuenta</a></li>
							<li><a href="perfil.php">Favoritos</a></li>
						</ul>
					</div>

					<div class="emailcampaing">
						<p class="title-footer">Campañas de correo</p>

						<div class="content">
							<p>
							Suscribete a nuestra campaña de correos para recibir catalogos exclusivos
							</p>
							<form action="../config/campaign_sender.php" method="POST" id="subscribe-form">
    <input type="hidden" name="current_url" id="current-url">
    <input type="email" placeholder="Ingresa el correo aquí..." name="email">
    <button type="submit">Suscribirse</button>
</form>
						</div>
					</div>
				</div>

				<div class="copyright">
					<p>
						Ericiosa &copy; Todos los derechos reservados
					</p>

				</div>
			</div>
		</footer>

</main>
      


		<script
		
			src="https://kit.fontawesome.com/81581fb069.js"
			crossorigin="anonymous"
		></script>
		<script src="../config/navbar.js" ></script>
		<script>
    $(document).ready(function() {
        // Agrega un listener para actualizar la URL actual antes de enviar el formulario
        $('#subscribe-form').submit(function() {
            // Obtén la URL actual
            var currentUrl = window.location.href;
            
            // Actualiza el valor del campo oculto
            $('#current-url').val(currentUrl);
        });
    });

    
	$(document).ready(function() {
                // Pasar los errores al script JavaScript para mostrar alertas y mensajes en la parte inferior
                <?php if (!empty($errors)): ?>
                    var errors = <?php echo json_encode($errors); ?>;
                    for (var i = 0; i < errors.length; i++) {
                        alert(errors[i]);
                    }
                    $(".form-body").prepend("<div class=\"error-message\">" + errors.join("<br>") + "</div>");
                <?php endif; ?>
            });


</script>
	</body>
</html>
