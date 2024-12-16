<?php
require './clases/conexion.php';
session_start();
$sql = "SELECT sp_modulos(".$_REQUEST['accion'].","
        .$_REQUEST['vmod_cod'].",'".$_REQUEST['vmod_nom']."') as modulos;";

$resultado = consultas::get_datos($sql);

if($resultado[0]['modulos']== NULL) {
    $_SESSION['mensaje']= 'Error de Proceso '+$sql;
    header('location:./'.$_REQUEST['pagina']);
} else {
  $_SESSION['mensaje']=$resultado[0]['modulos']."_".$_REQUEST['accion'];
  
  header('location:./'.$_REQUEST['pagina']);
}
?>

