
<?php
session_start();
include '../config/conexion.php';


$queryDestacados = "SELECT p.id_product, p.nombre, p.precio, p.imagen1, COUNT(l.id_like) as likes_count 
                   FROM products p 
                   LEFT JOIN likes l ON p.id_product = l.id_product
                   WHERE p.destacado = 1
                   GROUP BY p.id_product
                   LIMIT 4";

$resultadoDestacados = mysqli_query($conn, $queryDestacados);




?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Ericiosa - Home</title>
		<link rel="stylesheet" href="../public/css/indexstyle.css" />
		<link rel="icon" type="image/png" href="../private/logos/logo 7.png">
		<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
            <script src="../config/cookies.js" ></script>
			<script src="https://cdn.jsdelivr.net/npm/simple-parallax-js@5.5.1/dist/simpleParallax.min.js"></script>
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
					// hola papu
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
        <?php while ($filaDestacado = mysqli_fetch_assoc($resultadoDestacados)) : ?>
            <div class="card-product">
                <div class="container-img">
                    <a href="product.php?id=<?php echo $filaDestacado['id_product']; ?>" class="ws">
                        <img class="card-img" src="../private/images_product/<?php echo $filaDestacado['imagen1']; ?>" alt="" />
                    </a>
                    <div class="button-group">
                        <span class="like-button" data-post-id="<?php echo $filaDestacado['id_product']; ?>">
                            <i class="fa-regular fa-heart"></i>
                        </span>
                    
                    </div>
                </div>
                <div class="content-card-product">
                    <div class="separe"></div>
                    <a href="product.php?id=<?php echo $filaDestacado['id_product']; ?>" class="product-link"><?php echo $filaDestacado['nombre']; ?></a>
                    <span class="add-cart">
					<a class="ws"  href="product.php?id=<?php echo $filaDestacado['id_product']; ?>" class="add-cart">
                    <i class="fa-solid fa-wallet"></i> <!-- Este es el icono de cartera -->
                </a>
                    </span>
                    <p class="price">$<?php echo $filaDestacado['precio']; ?></p>
                </div>
            </div>
        <?php endwhile; ?>
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
					src="../private/logos/banner.png"
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
		<script>
$(document).ready(function() {
    $('.like-button').each(function() {
        var postId = $(this).data('post-id');
        var likeButton = $(this);

        // Verificar si existe una cookie para este like
        var likeCookie = getCookie("like_" + <?php echo isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : 0; ?> + "_" + postId);
        if (likeCookie === '1') {
            likeButton.addClass('liked');
        }

        likeButton.click(function() {
            $.ajax({
                type: 'POST',
                url: '../config/like_handler.php',
                data: { like: postId },
                dataType: 'json',
                success: function(response) {
                    console.log(response);

                    if (response.alert) {
                        alert(response.alert);
                        window.location.href = response.redirect;
                        return;
                    }

                    likeButton.toggleClass('liked', response.status === 'Like');

                    if (response.status === 'Like') {
                        setCookie("like_" + <?php echo isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : 0; ?> + "_" + postId, "1", + (86400 * 30), '/');
                    } else {
                        setCookie("like_" + <?php echo isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : 0; ?> + "_" + postId, "0", -1, '/');
                    }
                },
                error: function(error) {
                    console.error('Error al procesar la solicitud: ', error);
                }
            });
        });
    });

    // ... (otras funciones JavaScript si las tienes)
});

// Función para obtener el valor de una cookie
function getCookie(name) {
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length == 2) return parts.pop().split(";").shift();
}

// Función para establecer una cookie
function setCookie(name, value, seconds, path) {
    var expires = "";
    if (seconds) {
        var date = new Date();
        date.setTime(date.getTime() + (seconds * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=" + (path || "/");
}
</script>


<script src="../config/parallax.js" ></script>
	</body>
</html>
