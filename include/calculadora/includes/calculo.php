<style>
/* DivTable.com */
.divTable{
	display: table;
	width: 100%;
}
.divTableRow {
	display: table-row;
}
.divTableHeading {
	background-color: #EEE;
	display: table-header-group;
}
.divTableCell, .divTableHead {
	border: 1px solid #999999;
	display: table-cell;
	padding: 3px 10px;
}
.divTableHeading {
	background-color: #EEE;
	display: table-header-group;
	font-weight: bold;
}
.divTableFoot {
	background-color: #EEE;
	display: table-footer-group;
	font-weight: bold;
}
.divTableBody {
	display: table-row-group;
}

</style>

<?php

    error_reporting(E_ALL);
    ini_set('display_errors', '1');


    // Primera ventana
/*
    $nombre_solicitante = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
    $nombre_empresa     = (isset($_POST['nombre_empresa'])) ? $_POST['nombre_empresa'] : '';
    $rut                = (isset($_POST['rut_empresa'])) ? $_POST['rut_empresa'] : '';
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
*/

// Primera ventana

    $pais               = "Chile";

    // Segunda Ventana

    $rec_tecnologicos   = "on";
    $rec_ejecucion      = "on";
    $rec_estrategicos   = "on";
    $diseno_marca       = "on";
    $click_to_call      = "on";
    $ejecutivos         = "on";

    $marketing_digital  = "on";
    $whatsapp           = "on";
    $back_office        = "on";
    $rrss               = "on";
    $consultoria        = "on";
    $ecommerce          = "on";
    $sac                = "on";

    // Tercera Ventana

    $ventas_mes         = 1;
    $interacciones_mes  = 1;
    $potenciales_mes    = 1;


    $iva = 19;
    $margen = 

    require '../conexion/conexion.php';


    // capacidad diseño marca CHILE

    echo '<div style="">RECURSOS TECNOLOGICOS</div><br>';

    if ($pais == 'Chile' & $diseno_marca == 'on'){

        $query_diseno                    = "SELECT * FROM qxcosto_chile WHERE solucion = 'Diseño Marca' AND volumetria = 'SI'";

        $result_diseno                   = mysqli_query($conn, $query_diseno);

        // suma total valores capacidades

        $query_diseno_suma               = "SELECT SUM(qxcosto) AS total_qxcosto FROM qxcosto_chile WHERE solucion = 'Diseño Marca' AND volumetria = 'SI'";

        $result_diseno_suma              = mysqli_query($conn, $query_diseno_suma);

        $resultado_diseno_suma           = mysqli_fetch_array($result_diseno_suma);

        $qxcosto_diseno_suma             = $resultado_diseno_suma['total_qxcosto'];

        $calculo_capacidad_diseno_suma   = ($qxcosto_diseno_suma) * (($ventas_mes / 30) + ($interacciones_mes / 700) + ($potenciales_mes / 400));

        $valor_total_diseno_suma         = round($calculo_capacidad_diseno_suma);

        // muestra capacidades con sus valores individuales

        echo '<div class="divTable" style="width: 100%;border: 1px solid #000;" >
        <div class="divTableBody">
        <div class="divTableRow">
        <div class="divTableCell">DISEÑO MARCA</div>
        </div>
        </div>
        </div>';

        while ($row_diseno = mysqli_fetch_array($result_diseno)) {

        $qxcosto_diseno                  = $row_diseno['qxcosto'];

        $calculo_capacidad_diseno        = ($qxcosto_diseno) * (($ventas_mes / 30) + ($interacciones_mes / 700) + ($potenciales_mes / 400));

        $valor_total_diseno              = round($calculo_capacidad_diseno);

        echo '
        
        <div style="width= 100%; margin-bottom: 5px;">
        
            <div style="float: left; width: 25%;">'.$row_diseno['periodicidad'].'</div>
            <div style="float: left; width: 25%;">'.$row_diseno['plataforma'].'</div>
            <div style="float: left; margin-left: 5px; width: 25%;">: $ '.$valor_total_diseno.'</div>
            </div>';
        
        }

        echo '
        <div style="width= 100%;">
            <div style="float: left; width: 25%;">.</div>
            <div style="float: left; width: 25%;">COSTO TOTAL CAPACIDAD</div>
            <div style="float: left; margin-left: 5px; width: 25%; background-color: #fdd100;">: $ '.$valor_total_diseno_suma.'</div>
        </div></div><br><br><br>';
        

    }

     // capacidad marketing CHILE

    if ($pais == 'Chile' & $marketing_digital == 'on'){

        $query_marketing                    = "SELECT * FROM qxcosto_chile WHERE solucion = 'Marketing Digital' AND volumetria = 'SI'";

        $result_marketing                   = mysqli_query($conn, $query_marketing);

        // suma total valores capacidades

        $query_marketing_suma               = "SELECT SUM(qxcosto) AS total_qxcosto FROM qxcosto_chile WHERE solucion = 'Marketing Digital' AND volumetria = 'SI'";

        $result_marketing_suma              = mysqli_query($conn, $query_marketing_suma);

        $resultado_marketing_suma           = mysqli_fetch_array($result_marketing_suma);

        $qxcosto_marketing_suma             = $resultado_marketing_suma['total_qxcosto'];

        $calculo_capacidad_marketing_suma   = ($qxcosto_marketing_suma) * (($ventas_mes / 30) + ($interacciones_mes / 700) + ($potenciales_mes / 400));

        $valor_total_marketing_suma         = round($calculo_capacidad_marketing_suma);

        // muestra capacidades con sus valores individuales

        echo '<div class="divTable" style="width: 100%;border: 1px solid #000;" >
        <div class="divTableBody">
        <div class="divTableRow"">
        <div class="divTableCell">MARKETING DIGITAL</div>
        </div>
        </div>
        </div>';

        while ($row_marketing = mysqli_fetch_array($result_marketing)) {

        $qxcosto_marketing                  = $row_marketing['qxcosto'];

        $calculo_capacidad_marketing        = ($qxcosto_marketing) * (($ventas_mes / 30) + ($interacciones_mes / 700) + ($potenciales_mes / 400));

        $valor_total_marketing              = round($calculo_capacidad_marketing);

        echo '
        
        <div style="width= 100%; margin-bottom: 5px;">
        
            <div style="float: left; width: 25%;">'.$row_marketing['periodicidad'].'</div>
            <div style="float: left; width: 25%;">'.$row_marketing['plataforma'].'</div>
            <div style="float: left; margin-left: 5px; width: 25%;">: $ '.$valor_total_marketing.'</div>
            </div>';
        
        }

        echo '
        <div style="width= 100%;">
            <div style="float: left; width: 25%;">.</div>
            <div style="float: left; width: 25%;">COSTO TOTAL CAPACIDAD</div>
            <div style="float: left; margin-left: 5px; width: 25%; background-color: #fdd100;">: $ '.$valor_total_marketing_suma.'</div>
        </div></div>';
        

    }

    
?>