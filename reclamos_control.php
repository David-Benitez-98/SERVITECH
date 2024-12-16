<?php
require './clases/conexion.php';
session_start();
//$cod = "select coalesce(max(cod_nota_remi_comp),0)+ 1 as vnota from nota_remision_compra";
//$res = consultas::get_datos($cod);
$sql = "SELECT sp_reclamos(".$_REQUEST['accion'].","
        .$_REQUEST['vrecla'].",'"
        .$_REQUEST['vmotivo']."','"
        .$_REQUEST['vfecha']."','"
        .$_REQUEST['vestado']."',"
        .$_REQUEST['vsuc'].","
        .$_REQUEST['vcod_usu'].","
        .$_REQUEST['vfactu'].","
        .$_REQUEST['vcli'].") as reclamo;";
        
$resultado = consultas::get_datos($sql);

if ($resultado[0]['reclamo']== null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['reclamo']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']);
    
    
}
?>