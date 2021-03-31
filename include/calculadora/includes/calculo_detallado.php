<?php

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    $pais               = "Chile";


   // RECURSOS TECNOLOGICOS
    
    $diseno_marca       = "on";
    $marketing_digital  = "on";

    // RECURSOS EJECUCION
    
    $click_to_call      = "on";
    $whatsapp           = "on";
    $rrss               = "on";
    $ecommerce          = "on";

    // RECURSOS ESTRATEGICOS

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
            <td style="text-align: center; background-color: #66CCCC; font-weight: bold;">'.mb_strtoupper($fun_nom_capacidad).'</td>
            </tr>
            <tr>
            <td style="width: 200px; background-color: #fdc100; font-weight: bold;">PERIODICIDAD</td>
            <td style="width: 250px; background-color: #fdc100; font-weight: bold;">CAPACIDAD</td>
            <td style="width: 150px; background-color: #fdc100; font-weight: bold; ">PLATAFORMA</td>
            <td style="width: 250px; background-color: #fdc100; font-weight: bold;">PRODUCTO</td>
            <td style="width: 100px; background-color: #fdc100; font-weight: bold;">COSTO</td>
            </tr>';

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

                echo '
                <tr>
                <td style="width: 200px;">COBRO '.$row_diseno['periodicidad'].'</td>
                <td style="width: 250px;">'.$row_diseno['capacidad'].'</td>
                <td style="width: 150px;">'.$row_diseno['plataforma'].'</td>
                <td style="width: 250px;">'.$row_diseno['producto'].'</td>
                <td style="width: 100px; text-align: right;">$ '.$valor_total_diseno.'</td>
                </tr>';
                        
            }

                echo '
                <tr>
                <td style="width: 200px;"></td>
                <td style="width: 250px;"></td>
                <td style="width: 150px;"></td>
                <td style="width: 250px;  font-weight: bold; background-color: #a1d7ed;">COSTO TOTAL CAPACIDAD</td>
                <td style="width: 100px; text-align: right; font-weight: bold; background-color: #CCCCCC;">$ '.$valor_total_diseno_suma.'</td>
                </tr>
                </tbody></table>';
        

        }

    }

    function titulo_capacidad($fun_titulo){

        echo '
        <table style="width: 100%;" border="1" cellpadding="1">
        <tbody>
        <tr>
        <td style="font-weight: bold; background-color:#93ce3b;">'.$fun_titulo.'</td>
        </tr>
        </tbody>
        </table>';

    }

// LLAMAR A FUNCION SEGUN SOLUCION

    if ($diseno_marca == 'on' | $marketing_digital == 'on'){

        titulo_capacidad('RECURSOS TECNOLOGICOS');
        tabla_capacidades($pais, 'Diseño Marca', $diseno_marca, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
        tabla_capacidades($pais, 'Marketing Digital', $marketing_digital, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
    }

    if ($click_to_call == 'on' | $whatsapp == 'on' | $rrss == 'on' | $ecommerce == 'on'){
    
        echo '</br>';
        titulo_capacidad('RECURSOS EJECUCIÓN');
        tabla_capacidades($pais, 'Click to Call', $click_to_call, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
        tabla_capacidades($pais, 'Whatsapp', $whatsapp, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
        tabla_capacidades($pais, 'RRSS', $rrss, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
        tabla_capacidades($pais, 'E-Commerce', $ecommerce, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
    }

    if ($ejecutivos == 'on' | $back_office == 'on' | $consultoria == 'on' | $sac == 'on'){
        
        echo '</br>';
        titulo_capacidad('RECURSOS ESTRATEGICOS');
        tabla_capacidades($pais, 'Ejecutivos', $ejecutivos, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
        tabla_capacidades($pais, 'Back Office', $back_office, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
        tabla_capacidades($pais, 'Consultoria', $consultoria, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
        tabla_capacidades($pais, 'SAC', $sac, $ventas_mes, $interacciones_mes, $potenciales_mes, $volumetria);
    }

?>