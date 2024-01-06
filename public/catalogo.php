
<?php
session_start();
include '../config/conexion.php';

// Consultar los productos desde la base de datos con el recuento de likes
$query = "SELECT p.id_product, p.nombre, p.precio, p.imagen1, COUNT(l.id_like) as likes_count 
          FROM products p 
          LEFT JOIN likes l ON p.id_product = l.id_product
          GROUP BY p.id_product";
$resultado = mysqli_query($conn, $query);

?>

		<!DOCTYPE html>
		<html lang="en" dir="ltr">	
		<head>
			<meta charset="UTF-8">
			<title>Ericiosa - Catalogo</title>
			<link rel="stylesheet" href="css/catalogostyle.css">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
            <script src="../config/cookies.js" ></script>
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
				<span class="like-button" data-post-id="<?php echo $fila['id_product']; ?>">
    <i class="fa-regular fa-heart"></i>
</span>
           
            </div>
        </div>
        <div class="content-card-product">
            <div class="separe"></div>
            <!-- Enlace a la página de producto con el ID del producto -->
            <a href="product.php?id=<?php echo $fila['id_product']; ?>" class="product-link"><?php echo $fila['nombre']; ?></a>
            <span class="add-cart">
			<a class="ws" href="product.php?id=<?php echo $fila['id_product']; ?>" class="add-cart">
            <i class="fa-solid fa-wallet"></i> <!-- Este es el icono de cartera -->
        </a>
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


	<script defer src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js" type="module"></script>
	<script defer nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
	<script>
$(document).ready(function() {
    $('.like-button').each(function() {
        var postId = $(this).data('post-id');
        var likeButton = $(this);

        // Verificar si existe una cookie para este like
        var likeCookie = getCookie("like_" + <?php echo isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : 0; ?> + "_" + postId);
        if (likeCookie === '1') {
            // Si existe la cookie, aplicar estilo de 'liked'
            likeButton.addClass('liked');
        }

        // Configurar el evento de clic
        likeButton.click(function() {
            // Aplicar la clase 'liked' y actualizar el color según el estado del like
            likeButton.toggleClass('liked');
            likeButton.find('i').css('color', likeButton.hasClass('liked') ? 'red' : 'black');

            // Realizar la solicitud AJAX
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

                    // Actualizar la cookie del like
                    if (response.status === 'Like') {
                        setCookie("like_" + <?php echo isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : 0; ?> + "_" + postId, "1", + (86400 * 30), '/');
                    } else {
                        setCookie("like_" + <?php echo isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : 0; ?> + "_" + postId, "", - 3600, '/');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error al procesar la solicitud: ', error);
                }
            });
        });
    });
});
</script>
	</body>
	</html>

	<?php
	// Cerrar la conexión a la base de datos
	mysqli_close($conn);
	?>
