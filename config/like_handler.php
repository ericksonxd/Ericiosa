<?php
session_start();
include '../config/conexion.php';

// Verificar si es una solicitud POST y si está presente el parámetro 'like'
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['like'])) {
    // Asegurarse de que la sesión esté iniciada y 'usuario_id' esté definido
    if (isset($_SESSION['usuario_id'])) {
        $user_id = $_SESSION['usuario_id'];
        $product_id = mysqli_real_escape_string($conn, $_POST['like']);

        // Verificar si el usuario ya le dio like a este producto
        $check_like_query = "SELECT * FROM user_likes WHERE id_user = $user_id AND id_product = $product_id";
        $check_like_result = mysqli_query($conn, $check_like_query);

        if (mysqli_num_rows($check_like_result) > 0) {
            // Si ya dio like, eliminar el like
            $delete_like_query = "DELETE FROM user_likes WHERE id_user = $user_id AND id_product = $product_id";
            mysqli_query($conn, $delete_like_query);

            // Restar 1 al contador de likes en la tabla products
            $update_likes_query = "UPDATE products SET likes = likes - 1 WHERE id_product = $product_id";
            mysqli_query($conn, $update_likes_query);

            // Devolver respuesta al cliente
            echo json_encode(['action' => 'Unlike', 'like_id' => null]);
        } else {
            // Si no dio like, agregar el like
            $add_like_query = "INSERT INTO user_likes (id_user, id_product) VALUES ($user_id, $product_id)";
            mysqli_query($conn, $add_like_query);

            // Incrementar el contador de likes en la tabla products
            $update_likes_query = "UPDATE products SET likes = likes + 1 WHERE id_product = $product_id";
            mysqli_query($conn, $update_likes_query);

            // Obtener el ID del nuevo like
            $like_id = mysqli_insert_id($conn);

            // Devolver respuesta al cliente
            echo json_encode(['action' => 'Like', 'like_id' => $like_id]);
        }
    } else {
        // La sesión no está iniciada, manejar el error según tus necesidades
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Error de autenticación: Inicia sesion para dar Like']);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
}
?>