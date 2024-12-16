<?php
require './clases/conexion.php';
session_start();
$ape_total = $_REQUEST['vrecauda'];
$sql = "SELECT sp_aper_cierre2(".$_REQUEST['vcod'].","
        .$_SESSION['cod_usu'].","
        .$_REQUEST['vcaja'].","
        .$_REQUEST['vmonto'].","
        .$_REQUEST['vmoncierre'].","
        .$_SESSION['cod_suc'].","
        .$ape_total.","
        .$_REQUEST['accion'].") as apertura;";

$resultado = consultas::get_datos($sql);


if ($resultado[0]['apertura'] == null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header('location:./'.$_REQUEST['pagina']);
} else {
    $_SESSION['mensaje'] = $resultado[0]['apertura']."_".$_REQUEST['accion'];

    header('location:./'.$_REQUEST['pagina']);
}
?>


 