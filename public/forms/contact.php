<?php

// Definir la dirección de correo electrónico del destinatario
$receiving_email_address = 'contact@example.com';

// Cargar la biblioteca PHP Email Form
if (file_exists('../assets/vendor/php-email-form/php-email-form.php')) {
  include('../assets/vendor/php-email-form/php-email-form.php');
} else {
  die('No se pudo cargar la biblioteca "PHP Email Form".');
}

// Inicializar el formulario de contacto
$contact = new PHP_Email_Form;
$contact->ajax = true;

// Configurar los destinatarios y la información del remitente
$contact->to = $receiving_email_address;
$contact->from_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
$contact->from_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$contact->subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);

// Agregar contenido del mensaje
$contact->add_message($_POST['name'], 'Nombre');
$contact->add_message($_POST['email'], 'Correo electrónico');
$contact->add_message($_POST['message'], 'Mensaje', 10);

// Enviar el correo electrónico
try {
  $contact->send();
  echo '{"success": true, "message": "Correo electrónico enviado correctamente."}';
} catch (Exception $e) {
  echo '{"success": false, "message": "Error al enviar el correo electrónico: ' . $e->getMessage() . '"}';
}

?>
