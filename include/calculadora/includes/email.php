    require("../../../vendor/phpmailer/class.phpmailer.php");
    require("../../../vendor/phpmailer/class.smtp.php");

// Inicio enviar correo de simulacion

    $mensaje 		= "Mensaje Simulación Solicitada";

    $destinatario 	= $email;

    $nombre 		= "Simulador de Soluciones a Adquirir";

    $email 			= "noreply@peoplebpo.com";

    $smtpHost 		= "mail.peoplebpo.com";  // Dominio alternativo brindado en el email de alta 

    $smtpUsuario 	= "noreply@peoplebpo.com";  // Mi cuenta de correo

    $smtpClave 		= "413471*Iio";  // Mi contraseña

    $mail 			= new PHPMailer();

    $mail->IsSMTP();

    $mail->SMTPAuth = true;

    $mail->Port 	= 25; 

    $mail->IsHTML(true); 

    $mail->CharSet 	= "utf-8";

    $mail->Host 	= $smtpHost; 

    $mail->Username = $smtpUsuario; 

    $mail->Password = $smtpClave;

    $mail->From 	= $email; // Email desde donde envío el correo.

    $mail->FromName = $nombre;

    $mail->AddAddress($destinatario); // Esta es la dirección a donde enviamos los datos del formulario

    $mail->Subject 	= "Simulación Solicitada"; // Este es el titulo del email.

    $mensajeHtml 	= nl2br($mensaje);

    $mail->Body 	= "

<html> 

<body> 



    <h1>SOLICITUD DE SIMULACIÓN DE SOLUCIONES</h1>


    <p><h3>Don:</h3> {$nombre_solicitante}</p>



    <p><h3>Email:</h3> {$email_solicitante}</p>



</body> 

</html>



<br />"; // Texto del email en formato HTML

$mail->AltBody = "{$mensaje} \n\n "; // Texto sin formato HTML

// FIN - VALORES A MODIFICAR //



$mail->SMTPOptions = array(

    'ssl' => array(

    'verify_peer' => false,

    'verify_peer_name' => false,

    'allow_self_signed' => true

)

);

$estadoEnvio = $mail->Send(); 