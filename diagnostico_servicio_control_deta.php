<?php
require './clases/conexion.php';
session_start();
//$articulo = explode("_", $_REQUEST['varti']);

$sql = "SELECT sp_deta_diagnostico(".$_REQUEST['accion'].","
        .$_REQUEST['vdiag'].","
        .$_REQUEST['vtipo_servi'].","
        .$_REQUEST['vequi'].",'"
        .$_REQUEST['vestado']."') as deta_diag;";
        
$resultado = consultas::get_datos($sql);

if ($resultado[0]['deta_diag']== null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['deta_diag']."_".
            $_REQUEST['accion'];
   header('location:./'.$_REQUEST['pagina']."?vdiag=".
            $_REQUEST['vdiag'].'&vrecep='.$_REQUEST['vrecep']);
}


?>