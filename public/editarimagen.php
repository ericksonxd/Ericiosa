<?php

error_reporting(1);

include "config/conexion.php";

$Id = $_REQUEST['IdEditar'];

$nombre = $_POST['nombreImagen'];

$descripcion = $_POST['descripcionImagen'];

$imagen = addslashes(file_get_contents($_FILES['imagenEdit']['tmp_name']));


$sql = "UPDATE imagenes SET 

nombre= '$nombre', descripcion= '$descripcion', imagen= '$imagen' WHERE ID =$Id";

$resultado=$conexion->query($sql);

if ($resultado) {
header("location: dashboard.php");
}else {
    echo "no se edito la imagen";
}


?>