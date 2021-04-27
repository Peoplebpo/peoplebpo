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

            echo '
            <table style="width: 100%; border-collapse: collapse;" border="1" >
            <tbody>
            <tr>
            <td style="width: 250px;">'.$fun_nom_capacidad.'</td>';

            $query_diseno = "SELECT * FROM qxcosto_chile WHERE solucion = '$fun_nom_capacidad'";
            
            $result_diseno                   = mysqli_query($conn, $query_diseno);
            
            global $valor_total2;
            
            $valor_total2 = 0;

            while ($row_diseno2 = mysqli_fetch_array($result_diseno)) {

                //valor por capacidad

                $qxcosto_diseno2                  = $row_diseno2['qxcosto'];
                $volumetria_capacidad2            = $row_diseno2['volumetria'];

                if ($volumetria_capacidad2 == 'SI' & $fun_volumetria == 'SI'){
                    
                    $calculo_capacidad_diseno2    = ($qxcosto_diseno2) * (($fun_ventas_mes / 30) + ($fun_interacciones_mes / 700) + ($fun_potenciales_mes / 400));
                    
                }else if ($volumetria_capacidad2 == 'SI' & $fun_volumetria == 'NO'){
                    
                    $calculo_capacidad_diseno2   = $qxcosto_diseno2;
                    
                }else if ($volumetria_capacidad2 == 'NO' & $fun_volumetria == 'SI'){
                    
                    $calculo_capacidad_diseno2   = $qxcosto_diseno2;
                
                }else if ($volumetria_capacidad2 == 'NO' & $fun_volumetria == 'NO'){
                    
                    $calculo_capacidad_diseno2   = $qxcosto_diseno2;
                }

                $valor_total_diseno2             = round($calculo_capacidad_diseno2);

                
                $valor_total2 += $valor_total_diseno2;
                
            }


    //MUESTRA EL CUADRO DE CALCULO DE PERIODICIDAD

            $query_diseno2                   = "SELECT * FROM qxcosto_chile WHERE solucion = '$fun_nom_capacidad'";
            $result_diseno2                  = mysqli_query($conn, $query_diseno);

            global $valor_total_mensual;
            global $valor_total_demanda;
            global $valor_total_unico;

            $valor_total_mensual    = 0;
            $valor_total_demanda    = 0;
            $valor_total_unico      = 0;

            while ($row_diseno = mysqli_fetch_array($result_diseno2)) {

                //valor por capacidad

                $qxcosto_diseno                  = $row_diseno['qxcosto'];
                $volumetria_capacidad            = $row_diseno['volumetria'];
                $periodicidad                    = $row_diseno['periodicidad'];

            if ($periodicidad == "MENSUAL"){            

                if ($volumetria_capacidad == 'SI' & $fun_volumetria == 'SI'){
                    
                    $calculo_capacidad_diseno    = ($qxcosto_diseno) * (($fun_ventas_mes / 30) + ($fun_interacciones_mes / 700) + ($fun_potenciales_mes / 400));
                    
                }else if ($volumetria_capacidad == 'SI' & $fun_volumetria == 'NO'){
                    
                    $calculo_capacidad_diseno   = $qxcosto_diseno;
                    
                }else if ($volumetria_capacidad == 'NO' & $fun_volumetria == 'SI'){
                    
                    $calculo_capacidad_diseno   = $qxcosto_diseno;
                
                }else if ($volumetria_capacidad == 'NO' & $fun_volumetria == 'NO'){
                    
                    $calculo_capacidad_diseno   = $qxcosto_diseno;
                }
                
                $valor_periodicidad                     = "MENSUAL";
                $valor_total_diseno_mensual             = round($calculo_capacidad_diseno);
                $valor_total_mensual                    += $valor_total_diseno_mensual;

            }

            if ($periodicidad == "BAJO DEMANDA") {

                if ($volumetria_capacidad == 'SI' & $fun_volumetria == 'SI'){
                    
                    $calculo_capacidad_diseno    = ($qxcosto_diseno) * (($fun_ventas_mes / 30) + ($fun_interacciones_mes / 700) + ($fun_potenciales_mes / 400));
                    
                }else if ($volumetria_capacidad == 'SI' & $fun_volumetria == 'NO'){
                    
                    $calculo_capacidad_diseno   = $qxcosto_diseno;
                    
                }else if ($volumetria_capacidad == 'NO' & $fun_volumetria == 'SI'){
                    
                    $calculo_capacidad_diseno   = $qxcosto_diseno;
                
                }else if ($volumetria_capacidad == 'NO' & $fun_volumetria == 'NO'){
                    
                    $calculo_capacidad_diseno   = $qxcosto_diseno;
                }
                $valor_periodicidad                     = "BAJO DEMANDA";
                $valor_total_diseno_demanda             = round($calculo_capacidad_diseno);
                $valor_total_demanda                    += $valor_total_diseno_demanda;

            }

            if ($periodicidad == "UNICO") {

                if ($volumetria_capacidad == 'SI' & $fun_volumetria == 'SI'){
                    
                    $calculo_capacidad_diseno    = ($qxcosto_diseno) * (($fun_ventas_mes / 30) + ($fun_interacciones_mes / 700) + ($fun_potenciales_mes / 400));
                    
                }else if ($volumetria_capacidad == 'SI' & $fun_volumetria == 'NO'){
                    
                    $calculo_capacidad_diseno   = $qxcosto_diseno;
                    
                }else if ($volumetria_capacidad == 'NO' & $fun_volumetria == 'SI'){
                    
                    $calculo_capacidad_diseno   = $qxcosto_diseno;
                
                }else if ($volumetria_capacidad == 'NO' & $fun_volumetria == 'NO'){
                    
                    $calculo_capacidad_diseno   = $qxcosto_diseno;
                }

                $valor_periodicidad                     = "UNICO";
                $valor_total_diseno_unico               = round($calculo_capacidad_diseno);
                $valor_total_unico                      += $valor_total_diseno_unico;

            }

        }

        }

        echo '
        <td style="width: 100px; text-align: right; font-weight: bold;">$ '.number_format($valor_total2,'0',',','.').'</td>
        </tr></tbody></table>';

    }

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
    </table><br>';

    require '../conexion/conexion.php';

    // LLAMAR FUNCION POR CAPACIDAD PARA LA MUESTRA DE CUADROS

    if ($rec_tecnologicos == 'on' & ($diseno_marca == 'on' | $marketing_digital == 'on')){

    echo '</br>';
    titulo_capacidad('RECURSOS TECNOLOGICOS');

        if ($diseno_marca == 'on'){
            
            tabla_capacidades('RECURSOS TECNOLOGICOS' ,'Diseño Marca', $diseno_marca, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
            $valor_suma_diseno_total    =  $valor_total2;
            $valor_suma_mensual_diseno  =  $valor_total_mensual;
            $valor_suma_demanda_diseno  =  $valor_total_demanda;
            $valor_suma_unico_diseno    =  $valor_total_unico;

        }else{

            $valor_suma_diseno_total    =  0;
            $valor_suma_mensual_diseno  =  0;
            $valor_suma_demanda_diseno  =  0;
            $valor_suma_unico_diseno    =  0;

        }
        
        if($marketing_digital == 'on'){
            
            tabla_capacidades('RECURSOS TECNOLOGICOS' ,'Marketing Digital', $marketing_digital, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
            $valor_suma_marketing_total     =  $valor_total2;
            $valor_suma_mensual_marketing   =  $valor_total_mensual;
            $valor_suma_demanda_marketing   =  $valor_total_demanda;
            $valor_suma_unico_marketing     =  $valor_total_unico;

        }else{

            $valor_suma_marketing_total     =  0;
            $valor_suma_mensual_marketing   =  0;
            $valor_suma_demanda_marketing   =  0;
            $valor_suma_unico_marketing     =  0;

        }

    }else{

    $valor_suma_diseno_total        =  0;
    $valor_suma_marketing_total     =  0;

    $valor_suma_mensual_diseno      =  0;
    $valor_suma_demanda_diseno      =  0;
    $valor_suma_unico_diseno        =  0;

    $valor_suma_mensual_marketing   =  0;
    $valor_suma_demanda_marketing   =  0;
    $valor_suma_unico_marketing     =  0;

    }

    if ($rec_ejecucion == 'on' & ($click_to_call == 'on' | $whatsapp == 'on' | $rrss == 'on' | $ecommerce == 'on')){

    echo '</br>';
    titulo_capacidad('RECURSOS EJECUCIÓN');

        if ($click_to_call == 'on'){
            
            tabla_capacidades('RECURSOS EJECUCION', 'Click to Call', $click_to_call, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
            $valor_suma_call_total      =  $valor_total2;
            $valor_suma_mensual_call    =  $valor_total_mensual;
            $valor_suma_demanda_call    =  $valor_total_demanda;
            $valor_suma_unico_call      =  $valor_total_unico;

        }else{

            $valor_suma_call_total      =  0;
            $valor_suma_mensual_call    =  0;
            $valor_suma_demanda_call    =  0;
            $valor_suma_unico_call      =  0;

        }

        if($whatsapp == 'on'){
            
            tabla_capacidades('RECURSOS EJECUCION', 'Whatsapp', $whatsapp, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
            $valor_suma_whatsapp_total      =  $valor_total2;
            $valor_suma_mensual_whatsapp    =  $valor_total_mensual;
            $valor_suma_demanda_whatsapp    =  $valor_total_demanda;
            $valor_suma_unico_whatsapp      =  $valor_total_unico;

        }else{

            $valor_suma_whatsapp_total      =  0;
            $valor_suma_mensual_whatsapp    =  0;
            $valor_suma_demanda_whatsapp    =  0;
            $valor_suma_unico_whatsapp      =  0;

        }

        if($rrss == 'on'){
            
            tabla_capacidades('RECURSOS EJECUCION', 'RRSS', $rrss, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
            $valor_suma_rrss_total      =  $valor_total2;
            $valor_suma_mensual_rrss    =  $valor_total_mensual;
            $valor_suma_demanda_rrss    =  $valor_total_demanda;
            $valor_suma_unico_rrss      =  $valor_total_unico;

        }else{

            $valor_suma_rrss_total      =  0;
            $valor_suma_mensual_rrss    =  0;
            $valor_suma_demanda_rrss    =  0;
            $valor_suma_unico_rrss      =  0;

        }

        if($ecommerce == 'on'){
            
            tabla_capacidades('RECURSOS EJECUCION', 'E-Commerce', $ecommerce, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
            $valor_suma_commerce_total      =  $valor_total2;
            $valor_suma_mensual_commerce    =  $valor_total_mensual;
            $valor_suma_demanda_commerce    =  $valor_total_demanda;
            $valor_suma_unico_commerce      =  $valor_total_unico;

        }else{

            $valor_suma_commerce_total      =  0;
            $valor_suma_mensual_commerce    =  0;
            $valor_suma_demanda_commerce    =  0;
            $valor_suma_unico_commerce      =  0;

        }

    }else{

    $valor_suma_call_total          =  0;
    $valor_suma_whatsapp_total      =  0;
    $valor_suma_rrss_total          =  0;
    $valor_suma_commerce_total      =  0;

    $valor_suma_mensual_call        =  0;
    $valor_suma_demanda_call        =  0;
    $valor_suma_unico_call          =  0;

    $valor_suma_mensual_whatsapp    =  0;
    $valor_suma_demanda_whatsapp    =  0;
    $valor_suma_unico_whatsapp      =  0;

    $valor_suma_mensual_rrss        =  0;
    $valor_suma_demanda_rrss        =  0;
    $valor_suma_unico_rrss          =  0;

    $valor_suma_mensual_commerce    =  0;
    $valor_suma_demanda_commerce    =  0;
    $valor_suma_unico_commerce      =  0;

    }

    if ($rec_estrategicos == 'on' & ($ejecutivos == 'on' | $back_office == 'on' | $consultoria == 'on' | $sac == 'on')){

    echo '</br>';
    titulo_capacidad('RECURSOS ESTRATEGICOS');

    if ($ejecutivos == 'on'){

            tabla_capacidades($pais, 'Ejecutivos', $ejecutivos, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
            $valor_suma_ejecutivos_total    =  $valor_total2;
            $valor_suma_mensual_ejecutivos  =  $valor_total_mensual;
            $valor_suma_demanda_ejecutivos  =  $valor_total_demanda;
            $valor_suma_unico_ejecutivos    =  $valor_total_unico;

    }else{

            $valor_suma_ejecutivos_total    = 0;
            $valor_suma_mensual_ejecutivos  = 0;
            $valor_suma_demanda_ejecutivos  = 0;
            $valor_suma_unico_ejecutivos    = 0;

    }

    if ($back_office == 'on'){

            tabla_capacidades($pais, 'Back Office', $back_office, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
            $valor_suma_office_total    =  $valor_total2;
            $valor_suma_mensual_office  =  $valor_total_mensual;
            $valor_suma_demanda_office  =  $valor_total_demanda;
            $valor_suma_unico_office    =  $valor_total_unico;

    }else{

            $valor_suma_office_total    = 0;
            $valor_suma_mensual_office  = 0;
            $valor_suma_demanda_office  = 0;
            $valor_suma_unico_office    = 0;

    }

    if ($consultoria == 'on'){

            tabla_capacidades($pais, 'Consultoria', $consultoria, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
            $valor_suma_consultoria_total       =  $valor_total2;
            $valor_suma_mensual_consultoria     =  $valor_total_mensual;
            $valor_suma_demanda_consultoria     =  $valor_total_demanda;
            $valor_suma_unico_consultoria       =  $valor_total_unico;

    }else{

            $valor_suma_consultoria_total    =  0;
            $valor_suma_mensual_consultoria  =  0;
            $valor_suma_demanda_consultoria  =  0;
            $valor_suma_unico_consultoria    =  0;

    }

    if ($sac == 'on'){

            tabla_capacidades($pais, 'SAC', $sac, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
            $valor_suma_sac_total       =  $valor_total2;
            $valor_suma_mensual_sac     =  $valor_total_mensual;
            $valor_suma_demanda_sac     =  $valor_total_demanda;
            $valor_suma_unico_sac       =  $valor_total_unico;

    }else{

            $valor_suma_sac_total       =  0;
            $valor_suma_mensual_sac     =  0;
            $valor_suma_demanda_sac     =  0;
            $valor_suma_unico_sac       =  0;

    }

    }else{

    $valor_suma_ejecutivos_total    = 0;
    $valor_suma_office_total        = 0;
    $valor_suma_consultoria_total   = 0;
    $valor_suma_sac_total           = 0;

    $valor_suma_mensual_ejecutivos  = 0;
    $valor_suma_demanda_ejecutivos  = 0;
    $valor_suma_unico_ejecutivos    = 0;

    $valor_suma_mensual_office      = 0;
    $valor_suma_demanda_office      = 0;
    $valor_suma_unico_office        = 0;

    $valor_suma_mensual_consultoria = 0;
    $valor_suma_demanda_consultoria = 0;
    $valor_suma_unico_consultoria   = 0;

    $valor_suma_mensual_sac         = 0;
    $valor_suma_demanda_sac         = 0;
    $valor_suma_unico_sac           = 0;

    }

    // MOSTRAR CUADRO PERIODICIDAD

    $suma_periodicidad_mensual_tecnologicos = $valor_suma_mensual_diseno + $valor_suma_mensual_marketing;
    $suma_periodicidad_demanda_tecnologicos = $valor_suma_demanda_diseno + $valor_suma_demanda_marketing;
    $suma_periodicidad_unico_tecnologicos   = $valor_suma_unico_diseno + $valor_suma_unico_marketing;

    $suma_periodicidad_mensual_ejecucion    = $valor_suma_mensual_call + $valor_suma_mensual_whatsapp  + $valor_suma_mensual_rrss + $valor_suma_mensual_commerce;
    $suma_periodicidad_demanda_ejecucion    = $valor_suma_demanda_call + $valor_suma_demanda_whatsapp  + $valor_suma_demanda_rrss + $valor_suma_demanda_commerce;
    $suma_periodicidad_unico_ejecucion      = $valor_suma_unico_call + $valor_suma_unico_whatsapp  + $valor_suma_unico_rrss + $valor_suma_unico_commerce;

    $suma_periodicidad_mensual_estrategicos = $valor_suma_mensual_ejecutivos + $valor_suma_mensual_office  + $valor_suma_mensual_consultoria + $valor_suma_mensual_sac;
    $suma_periodicidad_demanda_estrategicos = $valor_suma_demanda_ejecutivos + $valor_suma_demanda_office  + $valor_suma_demanda_consultoria + $valor_suma_demanda_sac;
    $suma_periodicidad_unico_estrategicos   = $valor_suma_unico_ejecutivos + $valor_suma_unico_office  + $valor_suma_unico_consultoria + $valor_suma_unico_sac;

    $suma_mensual = $suma_periodicidad_mensual_tecnologicos + $suma_periodicidad_mensual_ejecucion + $suma_periodicidad_mensual_estrategicos;
    $suma_demanda = $suma_periodicidad_demanda_tecnologicos + $suma_periodicidad_demanda_ejecucion + $suma_periodicidad_demanda_estrategicos;
    $suma_unico = $suma_periodicidad_unico_tecnologicos + $suma_periodicidad_unico_ejecucion + $suma_periodicidad_unico_estrategicos;

    echo'<br>
    <table style="width: 100%; border-collapse: collapse;" border="1"" border="1">
    <tbody>
    <tr>
    <td style="width: 250px; background-color: #F5F5F5; font-weight: bold; text-align: left;">TOTAL PAGO UNICO</td>
    <td style="width: 100px; background-color: #fdc100; font-weight: bold; text-align: right;">$ '.number_format($suma_unico,'0',',','.').'</td>
    </tr>
    <tr>
    <td style="width: 250px; background-color: #F5F5F5; font-weight: bold; text-align: left;">TOTAL PAGO BAJO DEMANDA</td>
    <td style="width: 100px; background-color: #fdc100; font-weight: bold; text-align: right;">$ '.number_format($suma_demanda,'0',',','.').'</td>
    </tr>
    <tr>
    <td style="width: 250px; background-color: #F5F5F5; font-weight: bold; text-align: left;">TOTAL PAGO MENSUAL</td>
    <td style="width: 100px; background-color: #fdc100; font-weight: bold; text-align: right;">$ '.number_format($suma_mensual,'0',',','.').'</td>
    </tr>
    </tbody>
    </table>';

    // MOSTRAR CUADRO DE SUMAS DE TODAS LAS CAPACIDADES MAS IVA

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
    $mail->Subject 	= "🤖 Simulación Costos de Servicios";
    $mensajeHtml 	= nl2br($mensaje);
    $archivo = 'simulacion.pdf';
    $mail->AddAttachment($archivo,$archivo);
    $mail->Body 	= "

    <html> 
    <body> 
    <h1>SIMULACIÓN DE SERVICIOS A CONTRATAR</h1>
    <p><h3>Don:</h3> {$nombre_solicitante}</p>
    <p><h3>Don:</h3> {$pais}</p>
    <p><a href='https://b24-nuujfg.bitrix24.site/volver_llamar/'><img src='https://adnprogen.com.ar/wp-content/uploads/2015/04/botones-web-quiero-que-me-llamen.png'></img></a></p>
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

?>