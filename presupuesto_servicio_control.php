<?php
require './clases/conexion.php';
session_start();
//$pedido = ($_REQUEST['vpedi']) ? $_REQUEST['vpedi'] : 0;

$cod = "select coalesce(max(cod_presu_servi),0)+ 1 as vpresu_servi from presupuesto_servi";
$res = consultas::get_datos($cod);
$sql = "SELECT sp_presupuesto_servi(".$_REQUEST['accion'].","
        .$_REQUEST['vpresu_servi'].",'"
        .$_REQUEST['vestado']."',"
        .$_REQUEST['vtotal'].",'"
        .$_REQUEST['vfecha']."','"
        .$_REQUEST['vfecha_vigen']."',"
        .$_REQUEST['vcod_usu'].","
        .$_REQUEST['vsuc'].","
        .$_REQUEST['vdiag'].","
        .$_REQUEST['vcli'].") as presupuesto_servicio;";
        
$resultado = consultas::get_datos($sql);

if ($resultado[0]['presupuesto_servicio']== null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['presupuesto_servicio']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina'].'?vpresu_servi='.$res[0]['vpresu_servi'].'&vdiag='.$_REQUEST['vdiag']);
    
    
}
?>
