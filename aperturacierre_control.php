<?php
require './clases/conexion.php';
session_start();

$sql = "SELECT sp_abm_apertura_cierre (".$_REQUEST['accion'].","
        .$_REQUEST['vcod'].","
        .$_REQUEST['vmonto'].","
        .$_REQUEST['vcaja'].","
        .$_REQUEST['vusu'].",'"
        .$_REQUEST['vestado']."') as apertura_cierres;";
        
        

$resultado = consultas::get_datos($sql);

if ($resultado[0]['apertura_cierres']== null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['apertura_cierres']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']);
}
?>
