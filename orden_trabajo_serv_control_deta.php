<?php
require './clases/conexion.php';
session_start();

$depo = !empty($_REQUEST['vdepo_oculto']) ? $_REQUEST['vdepo_oculto'] : 0;
$desc = !empty($_REQUEST['vdesc_oculto']) ? $_REQUEST['vdesc_oculto'] : $_REQUEST['vdesc'];
$sql = "SELECT sp_deta_orden_trabajo(".$_REQUEST['accion'].","
        .$_REQUEST['vorden_trab'].","
        .$_REQUEST['vtipo_oculto'].","
        .$_REQUEST['vfun'].","
        .$_REQUEST['vequipo_oculto'].","
        .$_REQUEST['articulo_oculto'].","
        .$depo.",'"
        .$_REQUEST['vestado']."',"
        .$_REQUEST['vcantidad_oculto'].") as deta_orden_trab;";
        
$resultado = consultas::get_datos($sql);

if ($resultado[0]['deta_orden_trab']== null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['deta_orden_trab']."_".
            $_REQUEST['accion'];
   header('location:./'.$_REQUEST['pagina']."?vorden_trab=".
            $_REQUEST['vorden_trab'].'&vpresu_servi='.$_REQUEST['vpresu_servi']);
}


?>