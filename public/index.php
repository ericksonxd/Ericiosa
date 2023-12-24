

<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Ericiosa - Home</title>
		<link rel="stylesheet" href="../public/css/indexstyle.css" />
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
					<i class="fa-solid fa-bars"></i>
					<ul class="menu">
						<li><a href="index.php">Inicio</a></li>
						<li><a href="catalogo.php">Catalogo</a></li>
						<li><a href="cursos.php">Cursos</a></li>
						<li><a href="custom.php">Encargos</a></li>	
						<li><a href="redessociales.php">Redes Sociales</a></li>
					</ul>

					<form class="search-form">
						<input type="search" placeholder="Buscar..." />
						<button class="btn-search">
							<i class="fa-solid fa-magnifying-glass"></i>
						</button>
					</form>
				</nav>
			</div>
		</header>

		<section class="banner">
			<div class="content-banner">
				<p>Magia en papel</p>
				<h2>Clases Online y Tutoriales	<br />Papelería Creativa para cumpleaños y eventos</h2>
				<a href="catalogo.php">explora el catálogo</a>
			</div>
		</section>

		<main class="main-content">
			<section class="container container-features">
				<div class="card-feature">
				<i class="fa-solid fa-globe"></i>
					<div class="feature-content">
				<a href="custom.php" class="ws" >	<span>Encargos a nivel Nacional</span></a>	
					
						<p> Realiza tu pedido ya</p>
					</div>
				</div>
				<div class="card-feature">
				<i class="fa-solid fa-book-open"></i>
					<div class="feature-content">
                     <a href="catalogo.php" class="ws" ><span>Catalogo de Productos</span></a>
						<p>Explora nuestros mejores productos</p>
					</div>
				</div>
				<div class="card-feature">
					<i class="fa-solid fa-gift"></i>
					<div class="feature-content">
					<a href="cursos.php" class="ws" >	<span>Aprende con nuestros cursos</span></a>

						<p>Papeleria Creativa, Decoraciones y más</p>
					</div>
				</div>
				<div class="card-feature">
				<i class="fa-solid fa-mobile"></i>
					<div class="feature-content">
						<a class="ws" href="">	<span>Contactanos</span></a>
			
						<p>LLámenos 000-000-000</p>
					</div>
				</div>
			</section>

			<section class="container top-categories">
				<h1 class="heading-1">Secciones</h1>		
				<div class="container-categories">
					<div class="card-category category-encargos">
						<p>Encargos</p>
						<a href="custom.php" class="ws"><span>Ver más</span></a>  
					</div>
					<div class="card-category category-productos">
						<p>Productos</p>
						<a href="catalogo.php" class="ws"><span>Ver más</span></a>  
					</div>
					<div class="card-category category-cursos">
						<p>Cursos</p>
						<a href="cursos.php" class="ws"><span>Ver más</span></a>  
					</div>
				</div>
			</section>

			<section class="container top-products">
				<h1 class="heading-1">Productos Destacados</h1>
				<div class="container-products">
					<!-- Producto 1 -->
					<div class="card-product">
						
						<div class="container-img">
						<a href="" class="ws" ><img class="card-img" src="../public/css/images/producto1.jpg" alt="" /></a>	
							<span class="discount">-0%</span>
							<div class="button-group">
								<span>
									<i class="fa-regular fa-eye"></i>
								</span>
								<span>
									<i class="fa-regular fa-heart"></i>
								</span>
								<span>
									<i class="fa-solid fa-code-compare"></i>
								</span>
							</div>
						</div>
						<div class="content-card-product">
							<div class="separe">
	
							</div>
		                    <a href="" class="product-link" > Primera Comunion</a>
							<span class="add-cart">
								<i class="fa-solid fa-basket-shopping"></i>
							</span>
							<p class="price">$0.00 <span>$0.00</span></p>
						</div>
					</div>
					<!-- Producto 2 -->
					<div class="card-product">
						<div class="container-img">

						<a href="" class="ws" ><img class="card-img" src="../public/css/images/producto2.jpg" alt="" /></a>
							
							<span class="discount">-0%</span>
							<div class="button-group">
								<span>
									<i class="fa-regular fa-eye"></i>
								</span>
								<span>
									<i class="fa-regular fa-heart"></i>
								</span>
								<span>
									<i class="fa-solid fa-code-compare"></i>
								</span>
							</div>
						</div>
						<div class="content-card-product">
							<div class="separe">
							</div>
							<a href="" class="product-link">Cajitas Princess</a>
							<span class="add-cart">
								<i class="fa-solid fa-basket-shopping"></i>
							</span>
							<p class="price">$0.00 <span>$0.00</span></p>
						</div>
					</div>
					<!--  -->
					<div class="card-product">
						<div class="container-img">
							<a href="" class="ws" >	<img class="card-img" src="../public/css/images/producto3.jpg" alt="" /></a>
						
							<span class="discount">-0%</span>
							<div class="button-group">
								<span>
									<i class="fa-regular fa-eye"></i>
								</span>
								<span>
									<i class="fa-regular fa-heart"></i>
								</span>
								<span>
									<i class="fa-solid fa-code-compare"></i>
								</span>
							</div>
						</div>
						<div class="content-card-product">
							<div class="separe">
							</div>
				            <a href="" class="product-link">Cajita Cat in The Hat</a>
							<span class="add-cart">
								<i class="fa-solid fa-basket-shopping"></i>
							</span>
							<p class="price">$0.00 <span>$0.00</span></p>
						</div>
					</div>
					<!--  -->
					<div class="card-product">
						<div class="container-img">

						<a href="" class="ws" ><img class="card-img" src="../public/css/images/producto4.jpg" alt="" /></a>
					
							<span class="discount">-0%</span>
							<div class="button-group">
								<span>
									<i class="fa-regular fa-eye"></i>
								</span>
								<span>
									<i class="fa-regular fa-heart"></i>
								</span>
								<span>
									<i class="fa-solid fa-code-compare"></i>
								</span>
							</div>
						</div>
						<div class="content-card-product">
							<div class="separe">
							</div>
							<a href="" class="product-link">Spiderman Cake Topper</a>
							<span class="add-cart">
								<i class="fa-solid fa-basket-shopping"></i>
							</span>
							<p class="price">$0.00 <span>$0.00</span></p>
						</div>
					</div>
			</section>

			<section class="gallery">
				<img
					src="../public/css/images/gallery1.jpg"
					alt="Gallery Img1"
					class="gallery-img-1"
				/><img
					src="../public/css/images/gallery2.jpg"
					alt="Gallery Img2"
					class="gallery-img-2"
				/><img
					src="../public/css/images/banner2.jpg"
					alt="Gallery Img3"
					class="banner2"
				/><img
					src="../public/css/images/gallery4.jpg"
					alt="Gallery Img4"
					class="gallery-img-4"
				/><img
					src="../public/css/images/gallery5.jpg"
					alt="Gallery Img5"
					class="gallery-img-5"
				/>
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
		</footer>

		<script
		
			src="https://kit.fontawesome.com/81581fb069.js"
			crossorigin="anonymous"
		></script>
		<script src="simpleParallax.js"></script>

	</body>
</html>
