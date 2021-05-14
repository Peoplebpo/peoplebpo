<?php 
    ob_start(); 
?>
<!-- Inicio estilos -->
<head>
    <style type="text/css">
        html {
        margin: 0;
        }

        @font-face {
            font-family: 'Geometria';
            src: url('lib/dompdf/fonts/Geometria.ttf') format(truetype); 
        }

        @font-face {
            font-family: 'Geometria-ExtraBold';
            src: url('lib/dompdf/fonts/Geometria-ExtraBold.ttf') format(truetype); 
        }

        @font-face {
            font-family: 'Geometria-Heavy';
            src: url('lib/dompdf/fonts/Geometria-Heavy.ttf') format(truetype);
        }

        @font-face {
            font-family: 'Geometria-Light';
            src: url('url(lib/dompdf/fonts/Geometria-Light.ttf') format(truetype);
        }

        @font-face {
            font-family: 'Geometria-LightItalic';
            src: url('lib/dompdf/fonts/Geometria-LightItalic.ttf') format(truetype);
        }

        .titulo{
            font-family: 'Geometria-ExtraBold', sans-serif;
            font-size: 3rem;
            color: #312945;
            font-weight: 900;
            margin-left: 5rem;
        }

        .linea{
            background-color: #C9D115;
            height: 7px;
            margin-top: 0.2rem;
        }

        .nombre_persona{
            font-family: 'Geometria-Heavy', sans-serif;
            font-size: 1.5rem;
            color: #312945;
            font-weight: bold;
            margin-left: 5rem;
        }

        .texto_persona{
            font-family: '/Geometria-Light', Arial, Helvetica, sans-serif;
            font-size: 1rem;
            color: #312945;
            font-weight: normal;
            margin-left: 5rem;
            margin-right: 5rem;
        }

        .linea_volumetria{
            background-color: #312945;
            height: 7px;
            margin-left: 5rem;
            margin-right: 5rem;
            margin-top: 0.8rem;
        }

        .texto_titulo_volumetria{
            font-family: 'Geometria-ExtraBold', sans-serif;
            font-size: 0.8rem;
            color: #312945;
            font-weight: 600;
            font-style: oblique;

        }

        .valor_volumetria{
            font-family: 'Geometria-ExtraBold', sans-serif;
            font-size: 1rem;
            color: #312945;
            font-weight: 800;
            font-style: bold;

        }

        /* DivTable.com */
        .divTable{
            display: table;
            width: 100%;
            
        }
        .divTableRow {
            display: table-row;
        }
        .divTableHeading {
            display: table-header-group;
        }
        .divTableCell, .divTableHead {
            border: 0px;
            display: table-cell;
        }
        .divTableHeading {
            display: table-header-group;
            font-weight: bold;
        }
        .divTableFoot {
            display: table-footer-group;
            font-weight: bold;
        }
        .divTableBody {
            display: table-row-group;
        }

        .titulo_capacidad{
            font-family: 'Geometria-ExtraBold', sans-serif;
            font-size: 1.2rem;
            color: #C9D115;
            font-weight: 700;
            font-style: oblique;
        }

        .texto_titulo_capacidad{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 1rem;
            color: #312945;
            font-weight: 400;
            font-style: normal;
        }

        .texto_nombre_capacidad{
            font-family: 'Geometria-ExtraBold', sans-serif;
            font-size: 1rem;
            color: #312945;
            font-weight: 700;
            font-style: bold;
            margin-left: 30px;

        }

        .valor_nombre_capacidad{
            font-family: 'Geometria-ExtraBold', sans-serif;
            font-size: 1rem;
            color: #312945;
            font-weight: 800;
            font-style: bold;

        }

        .valor_nombre_periodicidad{
            font-family: 'Geometria-ExtraBold', sans-serif;
            font-size: 1rem;
            color: #312945;
            font-weight: 800;
            font-style: bold;

        }

        .titulo_texto_totales{
            font-family: 'Geometria', sans-serif;
            font-size: 1rem;
            color: #312945;
            font-weight: 800;
            text-align: right;
        }

        .valor_texto_totales{
            font-family: 'Geometria', sans-serif;
            font-size: 1.5rem;
            color: #999999;
            font-weight: 800;
            text-align: left;

        }

        .valor_total_totales{
            font-family: 'Geometria', sans-serif;
            font-size: 1.5rem;
            color: #312945;
            font-weight: 800;
            text-align: left;

        }

        footer {
            position: fixed; 
            bottom: 0cm; 
            left: 0cm; 
            right: 0cm;
            height: 2cm;
        }
    </style>
</head>

<!-- fin estilos -->
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

    echo '
<div style="width: 100%;">
    <img src="../images/header.png" style="width: 100%; margin-bottom: 1rem; ">
</div>

<div>
    <label class="titulo">SIMULADOR</label>
</div>

<div class="linea"></div>

<div style="margin-top: 0.8rem;">
    <label class="nombre_persona">Sr. '.$nombre_solicitante.'</label>
</div>

<div>
    <label><p class="texto_persona">*Gracias por confiar en nosotros. En respuesta a su solicitud, es de nuestro agrado adjuntar la siguiente simulación mensual de contratacion de servicios de acuerdo al detalle indicado</p></label>
</div>

<div>
    <label class="nombre_persona">VOLUMETRÍA</label>
</div>

<!-- inicio volumetria -->
<div style="margin-left: 5rem; margin-right: 5rem; margin-top: 1rem;">
<div class="divTable" style="width: 100%;" >
    <div class="divTableBody">
    <div class="divTableRow">
    <div class="divTableCell" style="width: 25%;"><center><img src="../images/cartera.png"></center></div>
    <div class="divTableCell" style="width: 40%;"><center><img src="../images/mano.png"></center></div>
    <div class="divTableCell" style="width: 35%;"><center><img src="../images/personas.png"></center></div>
    </div>
    <div class="divTableRow">
    <div class="divTableCell"><label class="texto_titulo_volumetria"><center>VENTAS</center></label></div>
    <div class="divTableCell"><label class="texto_titulo_volumetria"><center>CLIENTES POTENCIALES</center></label></div>
    <div class="divTableCell"><label class="texto_titulo_volumetria"><center>INTERACCIONES</center></label></div>
    </div>
    <div class="divTableRow">
    <div class="divTableCell"><center><label class="valor_volumetria">'.$ventas_mes.'</label></center></div>
    <div class="divTableCell"><center><label class="valor_volumetria">'.$potenciales_mes.'</label></center></div>
    <div class="divTableCell"><center><label class="valor_volumetria">'.$interacciones_mes.'</label></center></div>
    </div>
    </div>
    </div>
</div>

<div class="linea_volumetria"></div>

<div style="margin-left: 5rem; margin-right: 5rem; margin-top: 1.2rem;">
    <div class="divTable" style="width: 100%; " >
        <div class="divTableBody">
            <div class="divTableRow">

                <div class="divTableCell" style="width: 68%;">
                    <label class="titulo_capacidad">CAPACIDAD</label>   
                </div>

                <div class="divTableCell" style="width: 33%;">
                    <label class="titulo_capacidad">COSTO</label>   
                </div>

            </div>
        </div> 
        
    ';

    function titulo_capacidad($fun_titulo){ 

        echo '
        <div class="divTableBody" >
            <div class="divTableRow">

                <div class="divTableCell" style="width: 100%; padding-bottom: 0.5rem; padding-top: 0.5rem;">
                    <label class="texto_titulo_capacidad">'.$fun_titulo.'</label>   
                </div>

            </div>
        </div>
        
        
        
        
';
    }

    // FUNCION CALCULO VALOR CAPACIDADES Y SUMA TOTAL

    function tabla_capacidades($fun_nom_recurso, $fun_nom_capacidad, $fun_capacidad, $fun_ventas_mes, $fun_interacciones_mes, $fun_potenciales_mes, $fun_volumetria){

        require '../conexion/conexion.php';

        if ($fun_capacidad == 'on' ){

            echo '
            <div class="divTableBody">
                <div class="divTableRow">
    
                    <div class="divTableCell" style="width: 68%;">
                        <label class="texto_nombre_capacidad">'.$fun_nom_capacidad.'</label>   
                    </div>';

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
        <div class="divTableCell" style="width: 33%;">
            <label class="valor_nombre_capacidad">$ '.number_format($valor_total2,'0',',','.').'</label>   
        </div>

    </div>
</div>';

    }

    // LLAMAR A FUNCION SEGUN SOLUCION 



    require '../conexion/conexion.php';

    // LLAMAR FUNCION POR CAPACIDAD PARA LA MUESTRA DE CUADROS

    if ($rec_tecnologicos == 'on' & ($diseno_marca == 'on' | $marketing_digital == 'on')){

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

    echo'</div>
    <div class="divTable" style="width: 100%; margin-top: 0.8rem;" >

        <div class="divTableRow">
    
                    <div class="divTableCell" style="width: 75%;">
                        <label class="valor_nombre_periodicidad">TOTAL MENSUAL</label>   
                    </div>
    
                    <div class="divTableCell" style="width: 25%;">
                        <label class="titulo_texto_totales">$ '.number_format($suma_mensual,'0',',','.').'</label>   
                    </div>
                    
        </div>
    
        <div class="divTableRow">
    
            <div class="divTableCell" style="width: 75%;">
                <label class="valor_nombre_periodicidad">TOTAL BAJO DEMANDA</label>   
            </div>
    
            <div class="divTableCell" style="width: 25%;">
                <label class="titulo_texto_totales">$ '.number_format($suma_demanda,'0',',','.').'</label>   
            </div>
            
        </div>
    
        <div class="divTableRow">
    
            <div class="divTableCell" style="width: 75%;">
                <label class="valor_nombre_periodicidad">TOTAL UNICO</label>   
            </div>
    
            <div class="divTableCell" style="width: 25%;">
                <label class="titulo_texto_totales">$ '.number_format($suma_unico,'0',',','.').'</label>   
            </div>
            
        </div>
    
    </div>';

    // MOSTRAR CUADRO DE SUMAS DE TODAS LAS CAPACIDADES MAS IVA

    $suma_total= $valor_suma_diseno_total +  $valor_suma_marketing_total + $valor_suma_call_total + $valor_suma_whatsapp_total + $valor_suma_rrss_total + $valor_suma_commerce_total + $valor_suma_ejecutivos_total + $valor_suma_office_total + $valor_suma_consultoria_total + $valor_suma_sac_total;

    $iva = 0.19 * $suma_total;

    $iva_format = number_format($iva,'0',',','.');

    $total_mas_iva = $suma_total + $iva;

    $total = number_format($total_mas_iva,'0',',','.');

    echo'
    
    <div class="divTable" style="width: 100%; margin-top: 0.8rem;" >

        <div class="divTableRow">
    
                    <div class="divTableCell" style="width: 75%; text-align: right; vertical-align: bottom; padding-right: 0.5rem;">
                        <label class="texto_nombre_capacidad">TOTAL NETO :</label>   
                    </div>
    
                    <div class="divTableCell" style="width: 25%; vertical-align: bottom;">
                        <label class="valor_texto_totales">$ '.number_format($suma_total,'0',',','.').'</label>   
                    </div>
                    
        </div>
    
        <div class="divTableRow">
    
            <div class="divTableCell" style="width: 75%; text-align: right; vertical-align: bottom; padding-right: 0.5rem;">
                <label class="texto_nombre_capacidad">IVA :</label>   
            </div>
    
            <div class="divTableCell" style="width: 25%; vertical-align: bottom;">
                <label class="valor_texto_totales">$ '.$iva_format.'</label>   
            </div>
            
        </div>
    
        <div class="divTableRow">
    
            <div class="divTableCell" style="width: 75%; text-align: right; vertical-align: bottom; padding-right: 0.5rem;">
                <label class="texto_nombre_capacidad">TOTAL NETO +IVA :</label>   
            </div>
    
            <div class="divTableCell" style="width: 25%; vertical-align: bottom;">
                <label class="valor_total_totales">$ '.$total.'</label>   
            </div>
            
        </div>
    
    </div>
    
    </div>
    
    
    <footer>
    
        <div style="width: 100%;">
            <img src="../images/footer.png" style="width: 100%; margin-bottom: 1.5rem; ">
        </div>
    </footer>
    
    
    
    
    
    
    ';
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