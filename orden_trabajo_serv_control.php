<?php
require './clases/conexion.php';
session_start();
//$pedido = ($_REQUEST['vpedi']) ? $_REQUEST['vpedi'] : 0;
$cod = "select coalesce(max(cod_orden_trabajo),0)+ 1 as vorden_trab from orden_trabajo";
$res = consultas::get_datos($cod);
$sql = "SELECT sp_orden_trabajo(".$_REQUEST['accion'].","
        .$_REQUEST['vorden_trab'].","
        .$_REQUEST['vpresu_servi'].","
        .$_REQUEST['vcli'].","
        .$_REQUEST['vcod_usu'].","
        .$_REQUEST['vsuc'].",'"
        .$_REQUEST['vestado']."','"
        .$_REQUEST['vfecha_ini']."','"
        .$_REQUEST['vfecha_fin']."') as orden_trab;";
        
$resultado = consultas::get_datos($sql);

if ($resultado[0]['orden_trab']== null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['orden_trab']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina'].'?vorden_trab='.$res[0]['vorden_trab'].'&vpresu_servi='.$_REQUEST['vpresu_servi']);
    
    
}
?>
