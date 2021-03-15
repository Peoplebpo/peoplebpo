<?php

// Primera ventana

    $nombre_solicitante = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
    $nombre_empres      = (isset($_POST['nombre_empresa'])) ? $_POST['nombre_empresa'] : '';
    $rut                = (isset($_POST['rut'])) ? $_POST['rut'] : '';
    $email_solicitante  = (isset($_POST['email'])) ? $_POST['email'] : '';
    $telefono           = (isset($_POST['telefono'])) ? $_POST['telefono'] : '';
    $pais               = (isset($_POST['pais'])) ? $_POST['pais'] : '';
    
// Segunda Ventana

    $rec_tecnologicos   = (isset($_POST['rec_tecnologicos'])) ? $_POST['rec_tecnologicos'] : '';
    $rec_ejecucion      = (isset($_POST['rec_ejecucion'])) ? $_POST['rec_ejecucion'] : '';
    $rec_estrategicos   = (isset($_POST['rec_estrategicos'])) ? $_POST['rec_estrategicos'] : '';
    $diseno_marca       = (isset($_POST['diseno_marca'])) ? $_POST['diseno_marca'] : '';
    $click_to_call      = (isset($_POST['click_to_call'])) ? $_POST['click_to_call'] : '';
    $ejecutivos         = (isset($_POST['ejecutivos'])) ? $_POST['ejecutivos'] : '';

    $marketing_digital  = (isset($_POST['marketing_digital'])) ? $_POST['marketing_digital'] : '';
    $whatsapp           = (isset($_POST['whatsapp'])) ? $_POST['whatsapp'] : '';
    $back_office        = (isset($_POST['back_office'])) ? $_POST['back_office'] : '';
    $rrss               = (isset($_POST['rrss'])) ? $_POST['rrss'] : '';
    $consultoria        = (isset($_POST['consultoria'])) ? $_POST['consultoria'] : '';
    $ecommerce          = (isset($_POST['ecommerce'])) ? $_POST['ecommerce'] : '';
    $sac                = (isset($_POST['sac'])) ? $_POST['sac'] : '';

// Tercera Ventana

    $ventas_mes         = (isset($_POST['ventas_mes'])) ? $_POST['ventas_mes'] : '';
    $interacciones_mes  = (isset($_POST['interacciones_mes'])) ? $_POST['interacciones_mes'] : '';
    $potenciales_mes    = (isset($_POST['potenciales_mes'])) ? $_POST['potenciales_mes'] : '';

// Inicio enviar simulacion

    include ("email.php");



?>