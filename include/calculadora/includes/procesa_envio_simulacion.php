<?php 
    ob_start(); 
?>

<?php

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    require("../../../vendor/phpmailer/class.phpmailer.php");
    require("../../../vendor/phpmailer/class.smtp.php");

    date_default_timezone_set('America/Argentina/Buenos_Aires');

    $hora = date("H:i:s");
    $fecha = date("Y-m-d"); 

    unlink('simulacion.pdf');

// DATOS CLIENTE

    $nombre_solicitante = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
    $nombre_empresa     = (isset($_POST['nombre_empresa'])) ? $_POST['nombre_empresa'] : '';
    $rut                = (isset($_POST['rut_empresa'])) ? $_POST['rut_empresa'] : '';
    $email_solicitante  = (isset($_POST['email'])) ? $_POST['email'] : '';
    $telefono           = (isset($_POST['telefono'])) ? $_POST['telefono'] : '';
    $pais               = (isset($_POST['pais'])) ? $_POST['pais'] : '';
    
// RECURSOS TECNOLOGICOS

    $rec_tecnologicos   = (isset($_POST['rec_tecnologicos'])) ? $_POST['rec_tecnologicos'] : '';
    $diseno_marca       = (isset($_POST['diseno_marca'])) ? $_POST['diseno_marca'] : '';
    $marketing_digital  = (isset($_POST['marketing_digital'])) ? $_POST['marketing_digital'] : '';

// RECURSOS EJECUCION

    $rec_ejecucion      = (isset($_POST['rec_ejecucion'])) ? $_POST['rec_ejecucion'] : '';
    $click_to_call      = (isset($_POST['click_to_call'])) ? $_POST['click_to_call'] : '';
    $whatsapp           = (isset($_POST['whatsapp'])) ? $_POST['whatsapp'] : '';
    $rrss               = (isset($_POST['rrss'])) ? $_POST['rrss'] : '';
    $ecommerce          = (isset($_POST['ecommerce'])) ? $_POST['ecommerce'] : '';

// RECURSOS ESTRATEGICOS

    $rec_estrategicos   = (isset($_POST['rec_estrategicos'])) ? $_POST['rec_estrategicos'] : '';
    $ejecutivos         = (isset($_POST['ejecutivos'])) ? $_POST['ejecutivos'] : '';
    $back_office        = (isset($_POST['back_office'])) ? $_POST['back_office'] : '';
    $consultoria        = (isset($_POST['consultoria'])) ? $_POST['consultoria'] : '';
    $sac                = (isset($_POST['sac'])) ? $_POST['sac'] : '';

// VOLUMETRIA

    $ventas_mes         = (isset($_POST['ventas_mes'])) ? $_POST['ventas_mes'] : '';
    $interacciones_mes  = (isset($_POST['interacciones_mes'])) ? $_POST['interacciones_mes'] : '';
    $potenciales_mes    = (isset($_POST['potenciales_mes'])) ? $_POST['potenciales_mes'] : '';

// GENERAR PDF PARA LUEGO ADJUNTAR EN CORREO

?>

<?php

    if (($ventas_mes + $interacciones_mes + $potenciales_mes) > 0 ){
        
        $volumetria         = 'SI';

    }else{

        $volumetria         = 'NO';

    }

// FUNCION CALCULO VALOR CAPACIDADES Y SUMA TOTAL

function tabla_capacidades($fun_nom_recurso, $fun_nom_capacidad, $fun_capacidad, $fun_ventas_mes, $fun_interacciones_mes, $fun_potenciales_mes, $fun_volumetria){

    require '../conexion/conexion.php';

    if ($fun_capacidad == 'on' ){

        // muestra capacidades con sus valores individuales

        echo '
        <table style="width: 100%; border-collapse: collapse;" border="1" >
        <tbody>
        <tr>
        <td style="width: 250px;">'.$fun_nom_capacidad.'</td>';

        
        global $valor_total;

        $query_diseno                    = "SELECT * FROM qxcosto_chile WHERE solucion = '$fun_nom_capacidad'";
        $result_diseno                   = mysqli_query($conn, $query_diseno);

        $valor_total = 0;

        while ($row_diseno = mysqli_fetch_array($result_diseno)) {

                //valor por capacidad
    
                $qxcosto_diseno                  = $row_diseno['qxcosto'];
                $volumetria_capacidad            = $row_diseno['volumetria'];
    
                if ($volumetria_capacidad == 'SI' & $fun_volumetria == 'SI'){
                    
                    $calculo_capacidad_diseno    = ($qxcosto_diseno) * (($fun_ventas_mes / 30) + ($fun_interacciones_mes / 700) + ($fun_potenciales_mes / 400));
                    
                }else if ($volumetria_capacidad == 'SI' & $fun_volumetria == 'NO'){
                    
                    $calculo_capacidad_diseno   = $qxcosto_diseno;
                    
                }else if ($volumetria_capacidad == 'NO' & $fun_volumetria == 'SI'){
                    
                    $calculo_capacidad_diseno   = $qxcosto_diseno;
                
                }else if ($volumetria_capacidad == 'NO' & $fun_volumetria == 'NO'){
                    
                    $calculo_capacidad_diseno   = $qxcosto_diseno;
                }
    
                $valor_total_diseno             = round($calculo_capacidad_diseno);
    
                
                $valor_total += $valor_total_diseno;
                
            }
        
        }
        echo '
        <td style="width: 100px; text-align: right; font-weight: bold;">$ '.number_format($valor_total,'0',',','.').'</td>
        </tr></tbody></table>';

    }

//}

function titulo_capacidad($fun_titulo){

    echo '
    <table style="width: 100%; border-collapse: collapse;" border="1">
    <tbody>
    <tr>
    <td style="font-weight: bold; background-color:#93ce3b;">'.$fun_titulo.'</td>
    </tr>
    </tbody>
    </table>

    <table style="width: 100%; border-collapse: collapse;" border="1">
    <tbody>
    <tr>
    <td style="width: 250px; background-color: #fdc100; font-weight: bold;">CAPACIDAD</td>
    <td style="width: 100px; background-color: #fdc100; font-weight: bold;">COSTO</td>
    </tr>
    </tbody>
    </table>    
    ';

}

// LLAMAR A FUNCION SEGUN SOLUCION

    echo '
    <table style="width: 100%;" >
    <tbody>
    <tr>
    <td><img src="../images/logo.png"></img></td>
        <td>&nbsp;</td>
    </tr>
    </tbody>
    </table>
    <br>
    <br>
    <table style="width: 100%;" >
    <tbody>
    <tr>
        <td style="width: 100%; font-weight: bold;">Sr/Sra. '.$nombre_solicitante.'</td>
    </tr>
    <tr>
        <td style="width: 100%; border-collapse: collapse;" border="1">Gracias por confiar en nosotros. En respuesta a su solicitud, es de nuestro agrado adjuntar la siguiente
        simulación mensual de contratación de servicios, de acuerdo al detalle indicado:</td>
    </tr>
    </tbody>
    </table>
    <br>
    <table style="width: 100%; border-collapse: collapse;" border="1">
    <tr>
        <td style="width: 100%; font-weight: bold; text-align: center; background-color: #D3D3D3;">VOLUMETRIA</td>
    </tr>
    </tbody>
    </table>
    <table style="width: 100%; border-collapse: collapse;" border="1">
    <tbody>
    <tr>
        <td style="width: 33%; font-weight: bold; text-align: center; background-color: #F4A460;">VENTAS</td>
        <td style="width: 33%; font-weight: bold; text-align: center; background-color: #F4A460;">INTERACCIONES</td>
        <td style="width: 33%; font-weight: bold; text-align: center; background-color: #F4A460;">CLIENTES POTENCIALES</td>
    </tr>
    <tr>
        <td style="width: 33%; font-weight: bold; text-align: center;">'.$ventas_mes.'</td>
        <td style="width: 33%; font-weight: bold; text-align: center;">'.$interacciones_mes.'</td>
        <td style="width: 33%; font-weight: bold; text-align: center;">'.$potenciales_mes.'</td>
    </tr>
    </tbody>
    </table>';

require '../conexion/conexion.php';

// mostrar cuadro recursos tecnologicos

if ($rec_tecnologicos == 'on' & ($diseno_marca == 'on' | $marketing_digital == 'on')){
    
    echo '<br>';
    titulo_capacidad('RECURSOS TECNOLOGICOS');

        if ($diseno_marca == 'on'){
            
            tabla_capacidades('RECURSOS TECNOLOGICOS' ,'Diseño Marca', $diseno_marca, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
            $valor_suma_diseno_total    =  $valor_total;

        }else{

            $valor_suma_diseno_total    =  0;

        }
        
        if($marketing_digital == 'on'){
            
            tabla_capacidades('RECURSOS TECNOLOGICOS' ,'Marketing Digital', $marketing_digital, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
            $valor_suma_marketing_total =  $valor_total;

        }else{

            $valor_suma_marketing_total =  0;

        }

}else{

    $valor_suma_diseno_total    =  0;
    $valor_suma_marketing_total =  0;

}



// mostrar cuadro recursos ejecucion

if ($rec_ejecucion == 'on' & ($click_to_call == 'on' | $whatsapp == 'on' | $rrss == 'on' | $ecommerce == 'on')){
    
    echo '<br>';
    titulo_capacidad('RECURSOS EJECUCIÓN');

        if ($click_to_call == 'on'){
            
            tabla_capacidades('RECURSOS EJECUCION', 'Click to Call', $click_to_call, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
            $valor_suma_call_total  =  $valor_total;

        }else{

            $valor_suma_call_total  =  0;

        }

        if($whatsapp == 'on'){
            
            tabla_capacidades('RECURSOS EJECUCION', 'Whatsapp', $whatsapp, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
            $valor_suma_whatsapp_total  =  $valor_total;

        }else{

            $valor_suma_whatsapp_total  =  0;

        }

        if($rrss == 'on'){
            
            tabla_capacidades('RECURSOS EJECUCION', 'RRSS', $rrss, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
            $valor_suma_rrss_total  =  $valor_total;

        }else{

            $valor_suma_rrss_total  =  0;

        }

        if($ecommerce == 'on'){
            
            tabla_capacidades('RECURSOS EJECUCION', 'E-Commerce', $ecommerce, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
            $valor_suma_commerce_total  =  $valor_total;

        }else{

            $valor_suma_commerce_total  =  0;

        }

}else{

    $valor_suma_call_total      =  0;
    $valor_suma_whatsapp_total  =  0;
    $valor_suma_rrss_total      =  0;
    $valor_suma_commerce_total  =  0;

}

if ($rec_estrategicos == 'on' & ($ejecutivos == 'on' | $back_office == 'on' | $consultoria == 'on' | $sac == 'on')){

    echo '<br>';
    titulo_capacidad('RECURSOS ESTRATEGICOS');

    if ($ejecutivos == 'on'){

            tabla_capacidades($pais, 'Ejecutivos', $ejecutivos, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
            $valor_suma_ejecutivos_total    =  $valor_total;

    }else{

            $valor_suma_ejecutivos_total    = 0;

    }

    if ($back_office == 'on'){

            tabla_capacidades($pais, 'Back Office', $back_office, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
            $valor_suma_office_total    =  $valor_total;

    }else{

            $valor_suma_office_total        = 0;

    }
    
    if ($consultoria == 'on'){

            tabla_capacidades($pais, 'Consultoria', $consultoria, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
            $valor_suma_consultoria_total    =  $valor_total;

    }else{

            $valor_suma_consultoria_total    =  0;

    }
    
    if ($sac == 'on'){

            tabla_capacidades($pais, 'SAC', $sac, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
            $valor_suma_sac_total    =  $valor_total;

    }else{

            $valor_suma_sac_total    =  0;

    }

}else{

    $valor_suma_ejecutivos_total    = 0;
    $valor_suma_office_total        = 0;
    $valor_suma_consultoria_total   = 0;
    $valor_suma_sac_total           = 0;
}

// mostrar cuadro suma de todas las capacidades mas iva

    $suma_total= $valor_suma_diseno_total +  $valor_suma_marketing_total + $valor_suma_call_total + $valor_suma_whatsapp_total + $valor_suma_rrss_total + $valor_suma_commerce_total + $valor_suma_ejecutivos_total + $valor_suma_office_total + $valor_suma_consultoria_total + $valor_suma_sac_total;

    $iva = 0.19 * $suma_total;

    $iva_format = number_format($iva,'0',',','.');

    $total_mas_iva = $suma_total + $iva;

    $total = number_format($total_mas_iva,'0',',','.');

    echo'<br>
    <table style="width: 100%; border-collapse: collapse;" border="1"" border="1">
    <tbody>
    <tr>
    <td style="width: 250px; background-color: #F5F5F5; font-weight: bold; text-align: right;">TOTAL NETO: $</td>
    <td style="width: 100px; background-color: #fdc100; font-weight: bold; text-align: right;">'.number_format($suma_total,'0',',','.').'</td>
    </tr>
    <tr>
    <td style="width: 250px; background-color: #F5F5F5; font-weight: bold; text-align: right;">IVA : $</td>
    <td style="width: 100px; background-color: #fdc100; font-weight: bold; text-align: right;">'.$iva_format.'</td>
    </tr>
    <tr>
    <td style="width: 250px; background-color: #F5F5F5; font-weight: bold; text-align: right;">TOTAL NETO + IVA : $</td>
    <td style="width: 100px; background-color: #fdc100; font-weight: bold; text-align: right;">'.$total.'</td>
    </tr>
    </tbody>
    </table>';
?>


<?php

    require_once '../lib/dompdf/autoload.inc.php';
    use Dompdf\Dompdf;
    $dompdf = new DOMPDF();
    $dompdf->load_html(ob_get_clean());
    $dompdf->render();
    $dompdf->set_option("isPhpEnabled", true); 
    $pdf = $dompdf->output(); 
    $filename = "simulacion.pdf";
    file_put_contents($filename, $pdf);
    $dompdf->stream($filename);


?>

<?php

// INGRESA A TABLA SOLICITUDES LOS DATOS DEL CLIENTE

    require '../conexion/conexion.php';


    $sSQL= "INSERT INTO solicitudes Set
    nombre_solicitante='$nombre_solicitante',
    nombre_empresa='$nombre_empresa',
    rut='$rut',
    email='$email_solicitante',
    telefono='$telefono',
    pais='$pais',
    fecha='$fecha',
    hora='$hora'";

    mysqli_query($conn, $sSQL); 

// ENVIO CORREO ELECTRONICO CON ARCHIVO SIMULACION ADJUNTA 
/*
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
    $archivo = 'simulacion.pdf';
    $mail->AddAttachment($archivo,$archivo);
    $mail->Body 	= "

    <html> 
    <body> 
    <h1>SIMULACIÓN DE SERVICIOS A CONTRATAR</h1>
    <p><h3>Don:</h3> {$nombre_solicitante}</p>
    <p><a href='https://b24-nuujfg.bitrix24.site/crm_form4/'><img src='https://adnprogen.com.ar/wp-content/uploads/2015/04/botones-web-quiero-que-me-llamen.png'></img></a></p>
    </body> 
    </html>
    <br />"; // Texto del email en formato HTML

    $mail->AltBody = "{$mensaje} \n\n "; // Texto sin formato HTML
    $mail->SMTPOptions = array(

    'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true
    )
    );

    $estadoEnvio = $mail->Send();
*/
?>