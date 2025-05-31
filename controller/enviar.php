<?php


error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php';

require 'config.php'; // Archivo con las credenciales

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"] ?? '';
    $apellido = $_POST["apellido"] ?? '';
    $telefono = $_POST["telefono"] ?? '';
    $correo = $_POST["correo"] ?? '';
    $servicio = $_POST["servicio"] ?? '';

    if (empty($nombre) || empty($apellido) || empty($telefono) || empty($correo) || empty($servicio)) {
        echo "error_campos"; // Respuesta en caso de campos vacíos
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USER;
        $mail->Password = SMTP_PASSWORD;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Configuración del correo
        $mail->setFrom(SMTP_USER, 'Impulso Code & Design');
        $mail->addAddress(SMTP_USER); // A quién se enviará el mensaje
        $mail->Subject = 'Nuevo mensaje de contacto';

        // Cuerpo del correo
        $mail->Body = "Nombre: $nombre\nApellido: $apellido\nTeléfono: $telefono\nCorreo: $correo\nServicio: $servicio";

        // Enviar el correo
        if ($mail->send()) {
            echo "success"; // Respuesta para JS
        } else {
            echo "error_envio";
        }
    } catch (Exception $e) {
        echo "error_servidor";
    }
}
?>

