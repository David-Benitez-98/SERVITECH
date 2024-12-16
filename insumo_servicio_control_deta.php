<?php
require './clases/conexion.php';
session_start();

$depo = !empty($_REQUEST['vdepo']) ? $_REQUEST['vdepo'] : 0;
$sql = "SELECT sp_deta_insumos_uti(".$_REQUEST['accion'].","
        .$_REQUEST['vinsu_uti'].","
        .$_REQUEST['varticulo'].","
        .$depo.","
        .$_REQUEST['vcantidad'].",'"
        .$_REQUEST['vestado']."') as deta_insumos;";
        
$resultado = consultas::get_datos($sql);

if ($resultado[0]['deta_insumos']== null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['deta_insumos']."_".
            $_REQUEST['accion'];
   header('location:./'.$_REQUEST['pagina']."?vinsu_uti=".
            $_REQUEST['vinsu_uti'].'&vorden_trab='.$_REQUEST['vorden_trab']);
}


?>