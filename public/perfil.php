<?php
session_start();
require_once '../config/conexion.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];


$usuario_id = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : 0;

// Obtener información del usuario
$query = "SELECT nombre, usuario, email, telefono FROM usuarios WHERE id = $usuario_id";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error en la consulta: " . mysqli_error($conn));
}

$usuario = mysqli_fetch_assoc($result);


$query = "SELECT nombre, usuario, email, telefono FROM usuarios WHERE id = $usuario_id";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error en la consulta: " . mysqli_error($conn));
}

$usuario = mysqli_fetch_assoc($result);

// Obtener productos favoritos del usuario
$queryProductosFavoritos = "SELECT p.id_product, p.nombre, p.imagen1 FROM products p
                            JOIN user_likes ul ON p.id_product = ul.id_product
                            WHERE ul.id_user = $usuario_id";
$resultProductosFavoritos = mysqli_query($conn, $queryProductosFavoritos);

if (!$resultProductosFavoritos) {
    die("Error en la consulta de productos favoritos: " . mysqli_error($conn));
}

$productos_favoritos = mysqli_fetch_all($resultProductosFavoritos, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Ericiosa - Mi perfil</title>
	<link rel="stylesheet" href="../public/css/profilestyle.css" />
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

  <section class="profile">
        <div class="wrapper">
            <div class="box">
                <h1><span>Mi perfil de Ericiosa:</span></h1>
                <h1><span><?php echo $usuario['nombre']; ?></span></h1>
                <p>Nombre de usuario: <?php echo $usuario['usuario']; ?></p>
                <p>Correo electrónico: <?php echo $usuario['email']; ?></p>
                <p>Número de teléfono: <?php echo $usuario['telefono']; ?></p>
                <p class="favorites">Productos Favoritos:</p>



				<div class="favorite-products">
    <?php foreach ($productos_favoritos as $producto) : ?>
        <a href="product.php?id=<?php echo $producto['id_product']; ?>">
            <div class="favorite-product-container">
                <img src="../private/images_product/<?php echo $producto['imagen1']; ?>" alt="">
                <p><?php echo $producto['nombre']; ?></p>
            </div>
        </a>
    <?php endforeach; ?>
</div>
            </div>
        </div>
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
							<button type="submit">suscribete</button>
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
	<script src="../config/navbar.js" ></script>
</body>