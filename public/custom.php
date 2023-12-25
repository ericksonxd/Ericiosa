<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Ericiosa - Custom Order</title>
		<link rel="stylesheet" href="../public/css/customstyle.css" />
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
					
						<h1 class="logo"><a href="#">Ericiosa</a></h1>
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
				
				
						<i class="fa-solid fa-basket-shopping"></i>
						<div class="content-shopping-cart">
							<span class="text">Carrito</span>
							<span class="number">(0)</span>
						</div>
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


<div class="custom-order-form"  >
<form action="order.php" method="POST"  >
<div class="form-body">
<i class="fa-regular fa-user"></i>
<input type="text" placeholder="Nombre Completo">
<i class="fa-regular fa-envelope"></i>
<input type="email" placeholder="Ingresa tu correo electrónico">
<i class="fa-regular fa-calendar-days"></i><span>Fecha del evento</span>
<input type="date">
<i class="fa-brands fa-whatsapp"></i>
<input type="number" placeholder="Ingresa tu número de contacto">
<i class="fa-solid fa-location-dot"></i>
<input type="text" placeholder="ingresa tu Dirección">  
<i class="fa-solid fa-circle-info"></i>
<span>Detalles de la orden</span>
<br>
 <textarea id="description" cols="30" rows="10" minlength="20"  maxlength="569" required  placeholder="Ingresa una breve descripcion del producto..." ></textarea>

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
							  <a href=""><i class="fa-brands fa-facebook-f"></i></a>
							</span>

							<span class="youtube">

							<a href=""><i class="fa-brands fa-youtube"></i></a>
				
							</span>
							<span class="pinterest">
							<a href=""><i class="fa-brands fa-pinterest-p"></i></a>
								
							</span>
							<span class="instagram">
								<a href=""><i class="fa-brands fa-instagram"></i></a>
				
							</span>
						</div>
					</div>

					<div class="information">
						<p class="title-footer">Información</p>
						<ul>
							<li><a href="#">Acerca de Nosotros</a></li>
							<li><a href="#">Términos y condiciones</a></li>
							<li><a href="#">Contactános</a></li>
						</ul>
					</div>

					<div class="my-account">
						<p class="title-footer">Mi cuenta</p>

						<ul>
							<li><a href="#">Mi cuenta</a></li>
							<li><a href="#">Lista de deseos</a></li>
						</ul>
					</div>

					<div class="emailcampaing">
						<p class="title-footer">Campañas de correo</p>

						<div class="content">
							<p>
							Suscribete a nuestra campaña de correos para recibir catalogos exclusivos
							</p>
							<form action="">
							<input type="email" placeholder="Ingresa el correo aquí...">
<button type="submit" >suscribete</button>
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


</main>
        


		<script
		
			src="https://kit.fontawesome.com/81581fb069.js"
			crossorigin="anonymous"
		></script>
		<script src="../config/navbar.js" ></script>
      
	</body>
</html>
