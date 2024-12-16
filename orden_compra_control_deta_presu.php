<?php
require './clases/conexion.php';
session_start();
//$articulo = explode("_", $_REQUEST['varti']);

$sql = "SELECT sp_det_orden_compra_conpresu(".$_REQUEST['accion'].","
        .$_REQUEST['vorden'].","
        .$_REQUEST['varti'].","
        .$_REQUEST['vprecio'].","
        .$_REQUEST['vcant'].","
        .$_REQUEST['vsubtotal'].",'"
        .$_REQUEST['vorden_estado']."') as deta_orden_compra_conpresu;";
        
$resultado = consultas::get_datos($sql);

if ($resultado[0]['deta_orden_compra_conpresu']== null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['deta_orden_compra_conpresu']."_".
            $_REQUEST['accion'];
   header('location:./'.$_REQUEST['pagina']."?vorden=".
            $_REQUEST['vorden'].'&vpresu='.$_REQUEST['vpresu']);
}


?>

