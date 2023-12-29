	<?php
	session_start();
	include '../config/conexion.php';

	// Consultar los productos desde la base de datos
	$query = "SELECT id_product, nombre, precio, imagen1 FROM products";
	$resultado = mysqli_query($conn, $query);

	if (isset($_SESSION["usuario"]) && isset($_SESSION["usuario_id"])) {
		// Si el usuario está conectado, muestra el nombre, enlace al perfil y enlace de logout
		echo '<span class="username">' . $_SESSION["usuario"] . '</span>';
		echo '<a href="perfil.php"><i class="fa-solid fa-user"></i></a>';
		echo '<a href="../config/logout.php" class="logout-button" ><i class="fa-solid fa-right-from-bracket"></i></a>';
		// ... Resto del código
	}
	?>

		<!DOCTYPE html>
		<html lang="en" dir="ltr">	
		<head>
			<meta charset="UTF-8">
			<title>Ericiosa - Catalogo</title>
			<link rel="stylesheet" href="css/catalogostyle.css">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">


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
								echo '<a href="login.php"><i class="fa-solid fa-user"></i></a>';
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
				<section>
			<main class="main-content">
				<h1 class="heading-1">Catálogo de productos</h1>

				<div class="catalogo-content">
					<!-- Iterar sobre los resultados de la consulta y mostrar la información de cada producto -->
					<?php while ($fila = mysqli_fetch_assoc($resultado)) : ?>
    <div class="card-product">
        <div class="container-img">
            <!-- Enlace a la página de producto con el ID del producto -->
            <a href="product.php?id=<?php echo $fila['id_product']; ?>" class="ws">
                <img class="card-img" src="../private/images_product/<?php echo $fila['imagen1']; ?>" alt="" />
            </a>
            <div class="button-group">
                <!-- Agregar la clase "like-button" y el atributo data-post-id al contenedor span -->
                <span class="like-button" >
                    <i class="fa-regular fa-heart"></i>
                </span>
                <span>
                    <i class="fa-solid fa-code-compare"></i>
                </span>
            </div>
        </div>
        <div class="content-card-product">
            <div class="separe"></div>
            <!-- Enlace a la página de producto con el ID del producto -->
            <a href="product.php?id=<?php echo $fila['id_product']; ?>" class="product-link"><?php echo $fila['nombre']; ?></a>
            <span class="add-cart">
                <i class="fa-solid fa-basket-shopping"></i>
            </span>
            <p class="price">$<?php echo $fila['precio']; ?></p>
        </div>
    </div>
<?php endwhile; ?>
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
									<a href=""><i class="fa-brands fa-x-twitter"></i></a>
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
				</footer>


				<script src="https://kit.fontawesome.com/81581fb069.js" crossorigin="anonymous"></script>
	<script src="../config/navbar.js"></script>

	<!-- Asegúrate de que no haya etiquetas <script> con código PHP aquí -->

	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

	<script defer src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js" type="module"></script>
	<script defer nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

	</body>
	</html>

	<?php
	// Cerrar la conexión a la base de datos
	mysqli_close($conn);
	?>