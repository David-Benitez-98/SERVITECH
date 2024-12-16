<?php
require './clases/conexion.php';
session_start();
//$pedido = ($_REQUEST['vpedi']) ? $_REQUEST['vpedi'] : 0;
$cod = "select coalesce(max(cod_insumo_uti),0)+ 1 as vinsu_uti from insumos_utilizados";
$res = consultas::get_datos($cod);
$sql = "SELECT sp_insumos_utilizados(".$_REQUEST['accion'].","
        .$_REQUEST['vinsu_uti'].","
        .$_REQUEST['vorden_trab'].","
        .$_REQUEST['vcod_usu'].","
        .$_REQUEST['vsuc'].",'"
        .$_REQUEST['vestado']."','"
        .$_REQUEST['vfecha']."') as insumo_uti;";
        
$resultado = consultas::get_datos($sql);

if ($resultado[0]['insumo_uti']== null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['insumo_uti']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina'].'?vinsu_uti='.$res[0]['vinsu_uti'].'&vorden_trab='.$_REQUEST['vorden_trab']);
    
    
}
?>
