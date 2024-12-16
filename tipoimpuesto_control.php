<?php
require './clases/conexion.php';
session_start();
$sql = "SELECT sp_tipoimpuesto(".$_REQUEST['accion'].","
        .$_REQUEST['vimp_cod'].",'".$_REQUEST['vimp_nom']."',".$_REQUEST['vimp_porc'].") as tiposimpuestos;";

$resultado = consultas::get_datos($sql);

if($resultado[0]['tiposimpuestos']== NULL) {
    $_SESSION['mensaje']= 'Error de Proceso '+$sql;
    header('location:./'.$_REQUEST['pagina']);
} else {
  $_SESSION['mensaje']=$resultado[0]['tiposimpuestos']."_".$_REQUEST['accion'];
  
  header('location:./'.$_REQUEST['pagina']);
}
?>

