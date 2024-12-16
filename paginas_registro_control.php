<?php
require './clases/conexion.php';
session_start();
$sql = "SELECT sp_paginas_abm(".$_REQUEST['accion'].","
        .$_REQUEST['vpag'].",'".$_REQUEST['vdirec']."','".$_REQUEST['vnom']."',".$_REQUEST['vmod'].") as paginas_registros;";

$resultado = consultas::get_datos($sql);

if($resultado[0]['paginas_registros']== NULL) {
    $_SESSION['mensaje']= 'Error de Proceso '+$sql;
    header('location:./'.$_REQUEST['pagina']);
} else {
  $_SESSION['mensaje']=$resultado[0]['paginas_registros']."_".$_REQUEST['accion'];
  
  header('location:./'.$_REQUEST['pagina']);
}
?>

