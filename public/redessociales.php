<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Ericiosa - Redes Sociales</title>
		<link rel="stylesheet" href="../public/css/redesstyle.css" />
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
                        echo '<a href="login.php"><i class="fa-solid fa-user"></i></a>';
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


<main class="main-content">

<section class="container top-categories">
				<h1 class="heading-1">Redes Sociales</h1>		
				<div class="container-categories">
					<div class="card-category category-instagram">
						<p>Instagram</p>
						<a href="https://www.instagram.com/ericiosa/?hl=es" class="ws"><span>Seguir</span></a>  
					</div>
					<div class="card-category category-youtube">
						<p>Youtube</p>
						<a href="https://www.youtube.com/@ericiosa" class="ws"><span>Suscribirse</span></a>  
					</div>
					<div class="card-category category-x">
						<p>X</p>
						<a href="https://twitter.com/ericiosa?lang=es" class="ws"><span>Seguir</span></a>  
					</div>
					<div class="card-category category-pinterest">
						<p>Pinterest</p>
						<a href="https://www.pinterest.com/ericiosa/" class="ws"><span>Seguir</span></a>  
					</div>
            
				</div>
			</section>

			<br>
</main>











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

    // Resto de tu script JavaScript existente...

</script>
	</body>
</html>
