<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/autoload.php';
include "../config/credentials.php";

if (isset($_POST['current_url'])) {
    $redirect_url = $_POST['current_url'];
} else {
    // Establece una URL predeterminada si no se proporciona
    $redirect_url = "index.php";
}

// Verifica si se proporcionó un correo electrónico
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $enlaceCatalogo = "URL_DEL_CATALOGO"; // Reemplaza esto con la URL real del catálogo

    // Lógica para suscribir al usuario con el correo proporcionado
    // Asegúrate de definir $asunto según tu lógica

    // Luego, llama a tu función enviarCorreoConEnlace
    enviarCorreoConEnlace($email, $enlaceCatalogo, 'Gracias por suscribirte a Ericiosa', '<p>¡Gracias por suscribirte a Ericiosa!</p><p>Estamos emocionados de tenerte como parte de nuestra comunidad. Para explorar nuestro catálogo, simplemente haz clic en el enlace a continuación:</p>', $redirect_url);
} else {
    // Redirige con un mensaje de error si no se proporcionó un correo
    header('Location: ' . $redirect_url . '?message=error_no_email');
    exit(); // Termina el script PHP
}

function enviarCorreoConEnlace($destinatario, $enlaceCatalogo, $asunto, $cuerpo, $redireccion) {
    global $config;

    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->isSMTP();
        $mail->Host       = $config['smtp_host'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $config['smtp_username'];
        $mail->Password   = $config['smtp_password'];   
        $mail->Port       = 587;

        $mail->setFrom($config['smtp_username'], 'Ericiosa');
        $mail->addAddress($destinatario);

        $mail->isHTML(true);
        $mail->Subject = $asunto;
        $mail->Body    = $cuerpo . '<br><br><a href="' . $enlaceCatalogo . '">Descarga el catálogo</a>';

        $mail->send();

        // Redirige con JavaScript después de enviar el correo
        header('Location: ' . $redireccion . '?message=success');
        exit(); // Termina el script PHP

    } catch (Exception $e) {
        // Registra el error en el registro del servidor
        error_log("Error al enviar el correo: " . $e->getMessage());

        // Redirige con JavaScript en caso de error
        header('Location: ' . $redireccion . '?message=error');
        exit(); // Termina el script PHP
    }
}
?>
