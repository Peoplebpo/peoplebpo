// Inicio enviar correo de simulacion

    $mensaje 		= "Mensaje Simulación Solicitada";

    $destinatario 	= $email_solicitante;

    $nombre 		= "Peoplebpo";

    $email 			= "noreply@peoplebpo.com";

    $smtpHost 		= "mail.peoplebpo.com"; 

    $smtpUsuario 	= "noreply@peoplebpo.com";

    $smtpClave 		= "413471*Iio";

    $mail 			= new PHPMailer();

    $mail->IsSMTP();

    $mail->SMTPAuth = true;

    $mail->Port 	= 25; 

    $mail->IsHTML(true); 

    $mail->CharSet 	= "utf-8";

    $mail->Host 	= $smtpHost; 

    $mail->Username = $smtpUsuario; 

    $mail->Password = $smtpClave;

    $mail->From 	= $email;

    $mail->FromName = $nombre;

    $mail->AddAddress($destinatario);

    $mail->Subject 	= "🤖 Simulación costos de Servicios a contratar";

    $mensajeHtml 	= nl2br($mensaje);

    $mail->Body 	= "

    <html> 

    <body> 



    <h1>SIMULACIÓN DE SERVICIOS A CONTRATAR</h1>


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