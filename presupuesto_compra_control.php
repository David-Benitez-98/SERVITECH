<?php
require './clases/conexion.php';
session_start();
//$pedido = ($_REQUEST['vpedi']) ? $_REQUEST['vpedi'] : 0;
$cod = "select coalesce(max(cod_presu_comp),0)+ 1 as vpresu from presupuesto_compra";
$res = consultas::get_datos($cod);
$sql = "SELECT sp_presupuesto_compra(".$_REQUEST['accion'].","
        .$_REQUEST['vpresu'].","
        .$_REQUEST['vcod_usu'].","
        .$_REQUEST['vprov'].","
        .$_REQUEST['vsuc'].",'"
        .$_REQUEST['vfecha']."','"
        .$_REQUEST['vigencia']."','"
        .$_REQUEST['vestado']."',"
        .$_REQUEST['vpedi'].","
        .$_REQUEST['vtotal'].") as presupuesto_compra;";
        
$resultado = consultas::get_datos($sql);

if ($resultado[0]['presupuesto_compra']== null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['presupuesto_compra']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina'].'?vpresu='.$res[0]['vpresu'].'&vpedi='.$_REQUEST['vpedi']);
    
    
}
?>
