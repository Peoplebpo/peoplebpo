<?php 
   ob_start(); 
?>

<?php

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    $pais               = "Chile";

    $nombre_solicitante = 'Iván Ruiz Delfín';


   // RECURSOS TECNOLOGICOS

    $rec_tecnologicos   = "on";
    $diseno_marca       = "on";
    $marketing_digital  = "on";

    // RECURSOS EJECUCION

    $rec_ejecucion      = "on";
    $click_to_call      = "on";
    $whatsapp           = "on";
    $rrss               = "on";
    $ecommerce          = "on";

    // RECURSOS ESTRATEGICOS

    $rec_estrategicos   = "on";
    $ejecutivos         = "on";
    $back_office        = "on";
    $consultoria        = "on";
    $sac                = "on";

    // VOLUMETRIA

    $ventas_mes         = 1;
    $interacciones_mes  = 1;
    $potenciales_mes    = 1;

    if (($ventas_mes + $interacciones_mes + $potenciales_mes) > 0 ){
        
        $volumetria         = 'SI';

    }else{

        $volumetria         = 'NO';

    }

// FUNCION CALCULO VALOR CAPACIDADES Y SUMA TOTAL

function tabla_capacidades($fun_pais, $fun_nom_capacidad, $fun_capacidad, $fun_ventas_mes, $fun_interacciones_mes, $fun_potenciales_mes, $fun_volumetria){

    require '../conexion/conexion.php';

    if ($fun_pais == 'Chile' & $fun_capacidad == 'on' ){

        $query_diseno                    = "SELECT * FROM qxcosto_chile WHERE solucion = '$fun_nom_capacidad'";

        $result_diseno                   = mysqli_query($conn, $query_diseno);

        // suma total valores capacidades

        $query_diseno_suma               = "SELECT SUM(qxcosto) AS total_qxcosto FROM qxcosto_chile WHERE solucion = '$fun_nom_capacidad'";

        $result_diseno_suma              = mysqli_query($conn, $query_diseno_suma);

        $resultado_diseno_suma           = mysqli_fetch_array($result_diseno_suma);

        $qxcosto_diseno_suma             = $resultado_diseno_suma['total_qxcosto'];
    

        // muestra capacidades con sus valores individuales

        echo '
        <table style="width: 100%; border-collapse: collapse;" border="1" >
        <tbody>
        <tr>
        <td style="width: 250px;">'.$fun_nom_capacidad.'</td>';

        global $valor_total_diseno_suma;

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

            $valor_total_diseno              = round($calculo_capacidad_diseno);

            //valor total de la capacidad

            if ($volumetria_capacidad == 'SI' & $fun_volumetria == 'SI'){
            
                $calculo_capacidad_diseno_suma   = ($qxcosto_diseno_suma) * (($fun_ventas_mes / 30) + ($fun_interacciones_mes / 700) + ($fun_potenciales_mes / 400));
                
            }else if ($volumetria_capacidad == 'SI' & $fun_volumetria == 'NO'){
                
                $calculo_capacidad_diseno_suma   = $qxcosto_diseno_suma;
                
            }else if ($volumetria_capacidad == 'NO' & $fun_volumetria == 'SI'){
                
                $calculo_capacidad_diseno_suma   = $qxcosto_diseno_suma;
            
            }else if ($volumetria_capacidad == 'NO' & $fun_volumetria == 'NO'){
                
                $calculo_capacidad_diseno_suma   = $qxcosto_diseno_suma;
            }

                $valor_total_diseno_suma         = round($calculo_capacidad_diseno_suma);

        }

        echo '
        <td style="width: 100px; text-align: right; font-weight: bold;">$ '.number_format($valor_total_diseno_suma,'0',',','.').'</td>
        </tr></tbody></table>';

    }

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
    </br>
    </br>
    <table style="width: 100%;" >
    <tbody>
    <tr>
        <td style="width: 100%; font-weight: bold;">Sr/Sra. '.$nombre_solicitante.'</td>
    </tr>
    <tr>
        <td style="width: 100%; border-collapse: collapse;" border="1">Gracias por confiar en nosotros. En respuesta a su solicitud, es de nuestro agrado adjuntar la siguiente simulación mensual de contratación de servicios, de acuerdo al detalle indicado:</td>
    </tr>
    </tbody>
    </table>
    </br>
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
    
    echo '</br>';
    titulo_capacidad('RECURSOS TECNOLOGICOS');

        if ($diseno_marca == 'on'){
            
            tabla_capacidades($pais, 'Diseño Marca', $diseno_marca, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
            $valor_suma_diseno_total    =  $valor_total_diseno_suma;

        }else{

            $valor_suma_diseno_total    =  0;

        }
        
        if($marketing_digital == 'on'){
            
            tabla_capacidades($pais, 'Marketing Digital', $marketing_digital, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
            $valor_suma_marketing_total =  $valor_total_diseno_suma;

        }else{

            $valor_suma_marketing_total =  0;

        }

}else{

    $valor_suma_diseno_total    =  0;
    $valor_suma_marketing_total =  0;

}

// mostrar cuadro recursos ejecucion

if ($rec_ejecucion == 'on' & ($click_to_call == 'on' | $whatsapp == 'on' | $rrss == 'on' | $ecommerce == 'on')){
    
    echo '</br>';
    titulo_capacidad('RECURSOS EJECUCIÓN');

        if ($click_to_call == 'on'){
            
            tabla_capacidades($pais, 'Click to Call', $click_to_call, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
            $valor_suma_call_total  =  $valor_total_diseno_suma;

        }else{

            $valor_suma_call_total  =  0;

        }
        
        if($whatsapp == 'on'){
            
            tabla_capacidades($pais, 'Whatsapp', $whatsapp, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
            $valor_suma_whatsapp_total  =  $valor_total_diseno_suma;

        }else{

            $valor_suma_whatsapp_total  =  0;

        }

        if($rrss == 'on'){
            
            tabla_capacidades($pais, 'RRSS', $rrss, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
            $valor_suma_rrss_total  =  $valor_total_diseno_suma;

        }else{

            $valor_suma_rrss_total  =  0;

        }

        if($ecommerce == 'on'){
            
            tabla_capacidades($pais, 'E-Commerce', $ecommerce, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
            $valor_suma_commerce_total  =  $valor_total_diseno_suma;

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

    echo '</br>';
    titulo_capacidad('RECURSOS ESTRATEGICOS');

    if ($ejecutivos == 'on'){

            tabla_capacidades($pais, 'Ejecutivos', $ejecutivos, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
            $valor_suma_ejecutivos_total    =  $valor_total_diseno_suma;

    }else{

            $valor_suma_ejecutivos_total    = 0;

    }

    if ($back_office == 'on'){

            tabla_capacidades($pais, 'Back Office', $back_office, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
            $valor_suma_office_total    =  $valor_total_diseno_suma;

    }else{

            $valor_suma_office_total        = 0;

    }
    
    if ($consultoria == 'on'){

            tabla_capacidades($pais, 'Consultoria', $consultoria, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
            $valor_suma_consultoria_total    =  $valor_total_diseno_suma;

    }else{

            $valor_suma_consultoria_total    =  0;

    }
    
    if ($sac == 'on'){

            tabla_capacidades($pais, 'SAC', $sac, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
            $valor_suma_sac_total    =  $valor_total_diseno_suma;

    }else{

            $valor_suma_sac_total    =  0;

    }

}else{

    $valor_suma_ejecutivos_total    = 0;
    $valor_suma_office_total        = 0;
    $valor_suma_consultoria_total    =  0;
    $valor_suma_sac_total    =  0;
}

// mostrar cuadro suma de todas las capacidades mas iva

    $suma_total= $valor_suma_diseno_total +  $valor_suma_marketing_total + $valor_suma_call_total + $valor_suma_whatsapp_total + $valor_suma_rrss_total + $valor_suma_commerce_total + $valor_suma_ejecutivos_total + $valor_suma_office_total + $valor_suma_consultoria_total + $valor_suma_sac_total;

    $iva = 0.19 * $suma_total;

    $iva_format = number_format($iva,'0',',','.');

    $total_mas_iva = $suma_total + $iva;

    $total = number_format($total_mas_iva,'0',',','.');

    echo'</br>
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