<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['usuario_tipo'] !== 'admin') {
    header("Location: index.php");
    exit();
}

include "../config/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_producto"])) {
    $producto_id = $_POST["id_producto"];

    $nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
    $descripcion = mysqli_real_escape_string($conn, $_POST["descripcion"]);
    $precio = mysqli_real_escape_string($conn, $_POST["precio"]);
    $link_twitter = mysqli_real_escape_string($conn, $_POST["link_twitter"]);
    $link_pinterest = mysqli_real_escape_string($conn, $_POST["link_pinterest"]);
    $link_instagram = mysqli_real_escape_string($conn, $_POST["link_instagram"]);
    $link_youtube = mysqli_real_escape_string($conn, $_POST["link_youtube"]);

    $imagen1_actual = mysqli_real_escape_string($conn, $_POST["imagen1_actual"]);
    $imagen2_actual = mysqli_real_escape_string($conn, $_POST["imagen2_actual"]);
    $imagen3_actual = mysqli_real_escape_string($conn, $_POST["imagen3_actual"]);

    if (!empty($_FILES["imagen1"]["name"])) {
        $imagen1 = subirImagen("imagen1");
    } else {
        $imagen1 = $imagen1_actual;
    }

    if (!empty($_FILES["imagen2"]["name"])) {
        $imagen2 = subirImagen("imagen2");
    } else {
        $imagen2 = $imagen2_actual;
    }

    if (!empty($_FILES["imagen3"]["name"])) {
        $imagen3 = subirImagen("imagen3");
    } else {
        $imagen3 = $imagen3_actual;
    }

    $query = "UPDATE products SET nombre='$nombre', descripcion='$descripcion', precio='$precio', link_x='$link_twitter', link_pinterest='$link_pinterest', link_instagram='$link_instagram', link_youtube='$link_youtube', imagen1='$imagen1', imagen2='$imagen2', imagen3='$imagen3' WHERE id_product=$producto_id";

    if (mysqli_query($conn, $query)) {
        echo "Producto actualizado correctamente.";
        header("Location: ../public/adminproduct.php");
    } else {
        echo "Error al actualizar el producto: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "Parámetros no válidos.";
}

function subirImagen($input_name) {
    $target_dir = "../private/images_product/";
    $target_file = $target_dir . basename($_FILES[$input_name]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES[$input_name]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "El archivo no es una imagen.";
        $uploadOk = 0;
    }

    if ($_FILES[$input_name]["size"] > 500000) {
        echo "La imagen es muy grande.";
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Solo se permiten archivos JPG, JPEG, PNG y GIF.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Hubo un error al subir la imagen.";
    } else {
        if (move_uploaded_file($_FILES[$input_name]["tmp_name"], $target_file)) {
            return basename($_FILES[$input_name]["name"]);
        } else {
            echo "Hubo un error al subir la imagen.";
        }
    }
}
?>