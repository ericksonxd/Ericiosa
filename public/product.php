<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
<meta charset="UTF-8">
<title>Ericiosa - Detalles</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/productstyle.css">
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

					<a href="login.php">	<i class="fa-solid fa-user"></i></a>
				
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
						<li><a href="#">Encargos</a></li>	
						<li><a href="#">Redes Sociales</a></li>
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

      

<section>

<main class="main-content" >
	
		<div class="container-product">
  <div class="box">
  <div class="images">
  <div class="img-holder active" onclick="changeImage('css/images/producto1.jpg')">
    <img id="mainImage" src="css/images/producto1.jpg">
  </div>
  <div class="img-holder" onclick="changeImage('css/images/producto1.jpg')">
    <img src="css/images/producto1.jpg">
  </div>
  <div class="img-holder" onclick="changeImage('css/images/producto2.jpg')">
    <img src="css/images/producto2.jpg">
  </div>
  <div class="img-holder" onclick="changeImage('css/images/producto3.jpg')">
    <img src="css/images/producto3.jpg">
  </div>
</div>
	  <div class="basic-info">
		  <h1>Nombre de producto</h1>
		  <span class="actions" > <i class="fa-solid fa-heart" ></i> <i class="fa-solid fa-code-compare"></i> </span>

	
		  <span>$0.00</span>
		  <div class="options">
			  <a href="#" >Comprar Ahora</a>
			  <a href="#">Añadir Al carrito</a>
		  </div>
	  </div>
	  <div class="description">
		  <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Natus temporibus corporis repudiandae, consectetur nostrum nisi commodi placeat rerum molestias numquam nihil accusantium deleniti! Enim, nesciunt a quis amet hic officia. Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae nemo accusantium tempora facere doloremque cum iusto, ut neque, fuga omnis libero laborum ullam. At dolorum qui atque labore illo dignissimos.</p>
		  
		 <span><h2>Ver Producto en:</h2></span>
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
		</footer>



		<script>
  function changeImage(newSrc) {
    var mainImage = document.getElementById('mainImage');
    mainImage.src = newSrc;
  }
</script>
		<script
		
			src="https://kit.fontawesome.com/81581fb069.js"
			crossorigin="anonymous"
		></script>
		<script src="simpleParallax.js"></script>

</body>

</html>