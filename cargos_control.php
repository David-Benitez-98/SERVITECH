<?php
require './clases/conexion.php';
session_start();
$sql = "SELECT sp_cargos(".$_REQUEST['accion'].","
        .$_REQUEST['vcarg_cod'].",'".$_REQUEST['vcarg_nom']."') as cargos;";

$resultado = consultas::get_datos($sql);

if($resultado[0]['cargos']== NULL) {
    $_SESSION['mensaje']= 'Error de Proceso '+$sql;
    header('location:./'.$_REQUEST['pagina']);
} else {
  $_SESSION['mensaje']=$resultado[0]['cargos']."_".$_REQUEST['accion'];
  
  header('location:./'.$_REQUEST['pagina']);
}
?>

