<?php


include "config/conexion.php";

$Id = $_REQUEST['ID'];

$sql = "DELETE FROM imagenes WHERE Id = $Id";

$resultado = $conexion->query($sql);

if ($resultado) {
    header("location: dashboard.php");
}else {
    echo "no se elimino la imagen";
}





?>