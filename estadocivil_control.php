<?php
require './clases/conexion.php';
session_start();
$sql = "SELECT sp_estadocivil(".$_REQUEST['accion'].","
        .$_REQUEST['vec_cod'].",'".$_REQUEST['vec_nom']."') as estado_civil;";

$resultado = consultas::get_datos($sql);

if($resultado[0]['estado_civil']== NULL) {
    $_SESSION['mensaje']= 'Error de Proceso '+$sql;
    header('location:./'.$_REQUEST['pagina']);
} else {
  $_SESSION['mensaje']=$resultado[0]['estado_civil']."_".$_REQUEST['accion'];
  
  header('location:./'.$_REQUEST['pagina']);
}
?>
