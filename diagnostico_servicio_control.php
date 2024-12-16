<?php
require './clases/conexion.php';
session_start();
//$pedido = ($_REQUEST['vpedi']) ? $_REQUEST['vpedi'] : 0;
$cod = "select coalesce(max(cod_diagnostico),0)+ 1 as vdiag from diagnostico";
$res = consultas::get_datos($cod);
$sql = "SELECT sp_diagnostico(".$_REQUEST['accion'].","
        .$_REQUEST['vdiag'].",'"
        .$_REQUEST['vfecha']."','"
        .$_REQUEST['vestado']."','"
        .$_REQUEST['vobser']."',"
        .$_REQUEST['vrecep'].","
        .$_REQUEST['vcod_usu'].","
        .$_REQUEST['vsuc'].","
        .$_REQUEST['vcli'].") as diagnostico_servi;";
        
$resultado = consultas::get_datos($sql);

if ($resultado[0]['diagnostico_servi']== null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['diagnostico_servi']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina'].'?vdiag='.$res[0]['vdiag'].'&vrecep='.$_REQUEST['vrecep']);
    
    
}
?>
