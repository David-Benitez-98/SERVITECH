<?php
require './clases/conexion.php';
session_start();
$cod = "select coalesce(max(cod_ajuste),0)+ 1 as vajuste from ajustes_productos";
$res = consultas::get_datos($cod);
$sql = "SELECT sp_ajuste_inventario(".$_REQUEST['accion'].","
        .$_REQUEST['vajuste'].","
        .$_REQUEST['vcod_usu'].","
        .$_REQUEST['vsuc_ori'].",'"
        .$_REQUEST['vfecha_inicial']."','"
        .$_REQUEST['vestado']."') as ajuste_inventarios;";
        
$resultado = consultas::get_datos($sql);

if ($resultado[0]['ajuste_inventarios']== null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['ajuste_inventarios']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina'].'?vajuste='.$res[0]['vajuste']);
    
    
}
?>


