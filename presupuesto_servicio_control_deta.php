<?php
require './clases/conexion.php';
session_start();

$arti = !empty($_REQUEST['articuloinvisible']) ? $_REQUEST['articuloinvisible'] : $_REQUEST['varti'];
$depo = !empty($_REQUEST['vdepo_oculto']) ? $_REQUEST['vdepo_oculto'] : 0;
$precio_art = !empty($_REQUEST['vprecio_art_oculto']) ? $_REQUEST['vprecio_art_oculto'] : 0;
$desc = !empty($_REQUEST['vdesc_oculto']) ? $_REQUEST['vdesc_oculto'] : 0;
//$precio_servi = !empty($_REQUEST['vprecio_servi_oculto']) ? $_REQUEST['vprecio_servi_oculto'] : $_REQUEST['vprecio_servi'];
$sql = "SELECT sp_deta_presu_servi(".$_REQUEST['accion'].","
        .$_REQUEST['vpresu_servi'].","
        .$_REQUEST['vtipo_servi'].","
        .$_REQUEST['vequi'].","
        .$arti.","
        .$depo.","
        .$_REQUEST['vcant'].","
        .$_REQUEST['vtotal_presu_servi'].","
        .$precio_art.",'"
        .$_REQUEST['vestado']."',"
        .$_REQUEST['vdiferencia'].","
        .$desc.") as deta_presu_servicio;";
        
$resultado = consultas::get_datos($sql);

if ($resultado[0]['deta_presu_servicio']== null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['deta_presu_servicio']."_".
            $_REQUEST['accion'];
   header('location:./'.$_REQUEST['pagina']."?vpresu_servi=".
            $_REQUEST['vpresu_servi'].'&vdiag='.$_REQUEST['vdiag']);
}


?>