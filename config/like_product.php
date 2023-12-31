<?php
session_start();

// Incluir la conexión a la base de datos
include '../config/conexion.php';

// ... other code ...

// In the darLike function, use the session variable:
function darLike($idUsuario, $idProducto, $conn) {
    global $conn;

    $query = "SELECT * FROM likes WHERE id_usuario = $idUsuario AND id_producto = $idProducto";

}

// When calling darLike:
$numeroLikes = darLike($_SESSION['usuario_id'], $id_producto, $conn);
// Verificar si se ha proporcionado un ID de producto
if (isset($_GET['id'])) {
  // Obtener el ID del producto desde la URL
  $id_producto = mysqli_real_escape_string($conn, $_GET['id']);

  // Verificar si el usuario está conectado
  if (isset($_SESSION["usuario"])) {
    // Usuario está conectado, procesar el like
    $id_usuario = $_SESSION["id_usuario"];

    // Función para dar like a un producto
    function darLike($idUsuario, $idProducto, $conn) {
      // Verificar si el usuario ya ha dado like al producto
      $query = "SELECT * FROM likes WHERE id_usuario = $idUsuario AND id_producto = $idProducto";
      $resultado = mysqli_query($conn, $query);

      if (mysqli_num_rows($resultado) > 0) {
        // El usuario ya ha dado like al producto
        // Actualizar el estado del like a activo
        $query = "UPDATE likes SET activo = true WHERE id_usuario = $idUsuario AND id_producto = $idProducto";
        mysqli_query($conn, $query);
      } else {
        // El usuario no ha dado like al producto
        // Insertar un nuevo like
        $query = "INSERT INTO likes (id_usuario, id_producto, activo) VALUES ($idUsuario, $idProducto, true)";
        mysqli_query($conn, $query);
      }

      // Obtener el número de likes del producto
      $query = "SELECT COUNT(*) AS likes FROM likes WHERE id_producto = $idProducto AND activo = true";
      $resultado = mysqli_query($conn, $query);
      $fila = mysqli_fetch_assoc($resultado);
      $numeroLikes = $fila['likes'];

      return $numeroLikes;
    }

    // Obtener el número de likes después de dar like
    $numeroLikes = darLike($id_usuario, $id_producto, $conn);

    // Enviar el número de likes como respuesta
    echo $numeroLikes;
  } else {
    // Usuario no está conectado, redirigir a login
    header("Location: login.php");
  }
} else {
  // No se ha proporcionado un ID de producto
  echo "Error: No se ha proporcionado un ID de producto.";
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>