<?php
session_start();
include '../config/conexion.php';

// Obtener el usuario_id de la sesión
$usuario_id = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : null;

// Verificar si se ha proporcionado un ID de producto
if (isset($_GET['id'])) {
    // Obtener el ID del producto desde la URL
    $id_producto = $_GET['id'];

    // Consultar la información del producto desde la base de datos
    $queryProducto = "SELECT p.*, COUNT(l.id_like) as likes_count,
        (SELECT COUNT(*) FROM likes WHERE id_user = ? AND id_product = p.id_product) as is_liked
        FROM products p 
        LEFT JOIN likes l ON p.id_product = l.id_product
        WHERE p.id_product = ?
        GROUP BY p.id_product";

    // Preparar la consulta
    $stmt = mysqli_prepare($conn, $queryProducto);

    // Vincular los parámetros
    mysqli_stmt_bind_param($stmt, "ii", $usuario_id, $id_producto);

    // Ejecutar la consulta
    mysqli_stmt_execute($stmt);

    // Obtener el resultado
    $resultadoProducto = mysqli_stmt_get_result($stmt);

    // Verificar si se encontró el producto
    if ($producto = mysqli_fetch_assoc($resultadoProducto)) {
        // Extraer información del producto
        $nombre_producto = $producto['nombre'];
        $precio_producto = $producto['precio'];
        $descripcion_producto = $producto['descripcion'];
        $imagen_principal = $producto['imagen1'];
        $imagen1 = $producto['imagen1'];
        $imagen2 = $producto['imagen2'];
        $imagen3 = $producto['imagen3'];
        $link_twitter = $producto['link_x'];
        $link_youtube = $producto['link_youtube'];
        $link_pinterest = $producto['link_pinterest'];
        $link_instagram = $producto['link_instagram'];
        
        // Verificar si el usuario ha dado "Me gusta" al producto
        $isLiked = checkIfUserLikedProduct($usuario_id, $id_producto);

        // Número de likes del producto actual
        $likes_count = $producto['likes_count'];
    } else {
        // Manejo si el producto no se encuentra
        echo "Producto no encontrado.";
        exit;
    }

    // Cerrar la consulta preparada
    mysqli_stmt_close($stmt);
} else {
    // Manejo si no se proporciona un ID de producto
    echo "ID de producto no proporcionado.";
    header("Location: catalogo.php");
    exit;
}

function checkIfUserLikedProduct($userId, $productId)
{
    global $conn;

    // Verifica si el usuario ha dado "Me gusta" al producto
    $query = "SELECT COUNT(*) FROM likes WHERE id_user = ? AND id_product = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ii", $userId, $productId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $likeCount);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    return $likeCount > 0;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="icon" type="image/png" href="../private/logos/logo 7.png">
    <script src="../config/cookies.js"></script>
    <title>Ericiosa - <?php echo $nombre_producto; ?></title>
    <link rel="stylesheet" href="../public/css/productstyle.css" />
	<script src="https://www.paypal.com/sdk/js?client-id=AR5rBM_I9QVrutOwC4bktQbUhGA1HYxBHwikTnIrMkv0W2ZmzwHB4vFylCcSscWPhAu88NtTbzxF1ize"></script>
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




	<section>
		<main class="main-content">
			<div class="container-product">
				<div class="box">
					<div class="images">
						<div class="img-holder active" onclick="changeImage('<?php echo $imagen_principal; ?>')">
							<img id="mainImage" src="../private/images_product/<?php echo $imagen_principal; ?>">
						</div>
						<div class="img-holder"
							onclick="changeImage('../private/images_product/<?php echo $imagen1; ?>')">
							<img src="../private/images_product/<?php echo $imagen1; ?>">
						</div>
						<div class="img-holder"
							onclick="changeImage('../private/images_product/<?php echo $imagen2; ?>')">
							<img src="../private/images_product/<?php echo $imagen2; ?>">
						</div>
						<div class="img-holder"
							onclick="changeImage('../private/images_product/<?php echo $imagen3; ?>')">
							<img src="../private/images_product/<?php echo $imagen3; ?>">
						</div>
					</div>
					<div class="basic-info">
    <h1><?php echo $nombre_producto; ?></h1>
    <span class="actions">
        <!-- Agregar la clase "like-button" y el atributo data-post-id al contenedor span -->
		<span class="like-button" data-post-id="<?php echo $id_producto; ?>">
        <i class="fa-regular fa-heart"></i>
    </span>
    <!-- Mostrar el número de likes -->
	<span class="likes-count">(<?php echo $likes_count; ?>)</span>
</span>
    <span>$<?php echo $precio_producto; ?></span>
    <div class="options">
	<div id="paypal-button-container"></div>

	<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Función para inicializar el botón de PayPal
    function initializePayPal() {
        paypal.Buttons({
            style: {
                color: 'blue',
                shape: 'pill',
                label: 'pay'
            },
            createOrder: function (data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '<?php echo $precio_producto; ?>',
                            currency_code: 'USD'
                        }
                    }]
                });
            },
            onApprove: function (data, actions) {
                return actions.order.capture().then(function (details) {
                    // Detalles del pago
                    var paymentDetails = {
                        orderID: data.orderID,
                        payerID: data.payerID,
                        details: details
                    };

                    // Llamada AJAX para enviar los detalles al servidor
                    $.ajax({
                        type: 'POST',
                        url: '../config/guardar_pago.php',
                        data: { paymentDetails: paymentDetails },
                        success: function (response) {
                            console.log(response);
                        },
                        error: function (error) {
                            console.error('Error al enviar detalles de pago:', error);
                        }
                    });

                    alert('Pago completado. Gracias por tu compra!');
                });
            },
            onError: function (err) {
                console.error('Error en el pago:', err);
            }
        }).render('#paypal-button-container');
    }

    // Asegurarse de que el SDK de PayPal esté cargado antes de inicializar
    if (window.paypal) {
        initializePayPal();
    } else {
        var script = document.createElement('script');
        script.src = 'https://www.paypal.com/sdk/js?client-id=AR5rBM_I9QVrutOwC4bktQbUhGA1HYxBHwikTnIrMkv0W2ZmzwHB4vFylCcSscWPhAu88NtTbzxF1ize';
        script.async = true;
        script.onload = initializePayPal;
        document.head.appendChild(script);
    }
	
});
</script>
    </div>
</div>
					<div class="description">
						<p>
							<?php echo $descripcion_producto; ?>
						</p>
						<span>
							<h2>Ver Producto en:</h2>
						</span>
						<div class="social-icons">
							<span class="facebook">
								<a href="<?php echo $link_twitter; ?>"><i class="fa-brands fa-x-twitter"></i></a>
							</span> <span class="youtube">
								<a href="<?php echo $link_youtube; ?>"><i class="fa-brands fa-youtube"></i></a>
							</span>
							<span class="pinterest">
								<a href="<?php echo $link_pinterest; ?>"><i class="fa-brands fa-pinterest-p"></i></a>
							</span>
							<span class="instagram">
								<a href="<?php echo $link_instagram; ?>"><i class="fa-brands fa-instagram"></i></a>
							</span>
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

	<script>
		function changeImage(newSrc) {
			var mainImage = document.getElementById('mainImage');
			mainImage.src = newSrc;
		}
	</script>
	<script src="https://kit.fontawesome.com/81581fb069.js" crossorigin="anonymous"></script>
	<script src="../config/navbar.js"></script>
	<script>
$(document).ready(function() {
    var productId = <?php echo $id_producto; ?>;
    var likeButton = $('.like-button');
    var likesCount = $('.likes-count');

    var isLiked = <?php echo $isLiked ? 'true' : 'false'; ?>;
    
    // Aplicar la clase 'liked' y actualizar el color según el estado del like
    likeButton.toggleClass('liked', isLiked);
    likeButton.find('i').css('color', isLiked ? 'red' : 'black');

    likeButton.click(function() {
        likeButton.toggleClass('liked');
        likeButton.find('i').css('color', likeButton.hasClass('liked') ? 'red' : 'black');

        $.ajax({
            type: 'POST',
            url: '../config/like_handler.php',
            data: { like: productId },
            dataType: 'json',
            success: function(response) {
                console.log(response);

                if (response.alert) {
                    alert(response.alert);
                    window.location.href = response.redirect;
                    return;
                }

                likeButton.toggleClass('liked', response.status === 'Like');
                likeButton.find('i').css('color', response.status === 'Like' ? 'red' : 'black');

                likesCount.text('(' + response.likes_count + ')');
                console.log('Número de likes actualizado:', response.likes_count);

                if (response.status === 'Like') {
                    setCookie("like_" + <?php echo isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : 0; ?> + "_" + productId, "1", + (86400 * 30), '/');
                } else {
                    setCookie("like_" + <?php echo isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : 0; ?> + "_" + productId, "0", -1, '/');
                }
            },
            error: function(error) {
                console.error('Error al procesar la solicitud: ', error);
            }
        });
    });

    // Otras funciones JavaScript si las tienes
});
</script>
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

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>