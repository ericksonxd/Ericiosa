<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/autoload.php';
include "../config/credentials.php";
include "../config/conexion.php";

$email = $_POST['email'];
$query = "SELECT * FROM usuarios WHERE email = '$email' AND status = 1";
$result = $conn->query($query);
$row = $result->fetch_assoc();

if($result->num_rows > 0){

    $updateStatusQuery = "UPDATE usuarios SET status = 1 WHERE email = '$email'";
    $conn->query($updateStatusQuery);

  $mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
    $mail->isSMTP();
    $mail->Host       = $config['smtp_host'];
    $mail->SMTPAuth   = true;
    $mail->Username   = $config['smtp_username'];
    $mail->Password   = $config['smtp_password'];   
    $mail->Port       = 587;

    $mail->setFrom($config['smtp_username'], 'Ericiosa');
    $mail->addAddress($email, $row['nombre']);
    $mail->isHTML(true);
    $mail->Subject = 'Ericiosa - Password Recover';
    $mail->Body    = 'Hola, este es un correo generado para solicitar tu recuperación de contraseña, por favor, visita la página de <a href="localhost/ericiosa/public/change_password.php?id=' . $row['id'] . '">Recuperación de contraseña</a>';

    $mail->send();
    header("Location: ../public/forget_password.php?message=ok");
} catch (Exception $e) {
  header("Location: ../public/forget_password.php?message=error");
}

}else{
  header("Location: ../public/forget_password.php?message=not_found");
}

$updateStatusQuery = "UPDATE usuarios SET status = 1 WHERE email = '$email'";
$conn->query($updateStatusQuery);

?>