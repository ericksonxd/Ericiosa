<?php
session_start();
include '../config/conexion.php';

$response = array(); // Crear un arreglo para almacenar la respuesta

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['like'])) {
    // Asegúrate de que la sesión esté iniciada y 'usuario_id' esté definido
    if (isset($_SESSION['usuario_id'])) {
        $user_id = $_SESSION['usuario_id'];
        $product_id = mysqli_real_escape_string($conn, $_POST['like']);

        // Verificar si el usuario ya le dio like a este producto
        $check_like_query = "SELECT * FROM likes WHERE id_user = $user_id AND id_product = $product_id";
        $check_like_result = mysqli_query($conn, $check_like_query);

        if (mysqli_num_rows($check_like_result) > 0) {
            // Si ya dio like, eliminar el like
            $delete_like_query = "DELETE FROM likes WHERE id_user = $user_id AND id_product = $product_id";
            mysqli_query($conn, $delete_like_query);

            // Eliminar el like de la tabla user_likes
            $delete_user_like_query = "DELETE FROM user_likes WHERE id_user = $user_id AND id_product = $product_id";
            mysqli_query($conn, $delete_user_like_query);

            // Obtener el número actualizado de likes para el producto
            $likes_count_query = "SELECT COUNT(id_like) as likes_count FROM likes WHERE id_product = $product_id";
            $likes_count_result = mysqli_query($conn, $likes_count_query);
            $likes_count_row = mysqli_fetch_assoc($likes_count_result);
            $likes_count = $likes_count_row['likes_count'];

            // Actualizar la columna likes en la tabla products
            $update_likes_count_query = "UPDATE products SET likes = $likes_count WHERE id_product = $product_id";
            mysqli_query($conn, $update_likes_count_query);

            // Asignar la respuesta al arreglo
            $response['likes_count'] = $likes_count;
            $response['status'] = 'Unlike';
        } else {
            // Si no dio like, agregar el like
            $add_like_query = "INSERT INTO likes (id_user, id_product) VALUES ($user_id, $product_id)";
            mysqli_query($conn, $add_like_query);

            // Agregar el like a la tabla user_likes (usando INSERT IGNORE para evitar duplicados)
            $insert_user_like_query = "INSERT IGNORE INTO user_likes (id_user, id_product) VALUES ($user_id, $product_id)";
            mysqli_query($conn, $insert_user_like_query);

            // Obtener el número actualizado de likes para el producto
            $likes_count_query = "SELECT COUNT(id_like) as likes_count FROM likes WHERE id_product = $product_id";
            $likes_count_result = mysqli_query($conn, $likes_count_query);
            $likes_count_row = mysqli_fetch_assoc($likes_count_result);
            $likes_count = $likes_count_row['likes_count'];

            // Actualizar la columna likes en la tabla products
            $update_likes_count_query = "UPDATE products SET likes = $likes_count WHERE id_product = $product_id";
            mysqli_query($conn, $update_likes_count_query);

            // Asignar la respuesta al arreglo
            $response['likes_count'] = $likes_count;
            $response['status'] = 'Like';
        }
    } else {
        // La sesión no está iniciada, asignar un mensaje de error a la respuesta
        $response['error'] = 'Error: Sesión no iniciada';
    }
} else {
    // Si no es una solicitud POST válida, asignar un mensaje de error a la respuesta
    $response['error'] = 'Error: Solicitud no válida';
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);

// Redireccionar a catalogo.php (solo si es una solicitud AJAX y el usuario no está loggeado)
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    if (!isset($_SESSION['usuario_id'])) {
        $response['alert'] = 'Debes iniciar sesión para dar "like" a un producto.';
        $response['redirect'] = 'login.php';
    }
}

// Devolver la respuesta como un objeto JSON
echo json_encode($response);
?>