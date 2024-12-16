<?php
require './clases/conexion.php';
session_start();
$sql = "SELECT sp_nacionalidad(".$_REQUEST['accion'].","
        .$_REQUEST['vnac_cod'].",'".$_REQUEST['vnac_nom']."') as nacionalidad;";

$resultado = consultas::get_datos($sql);

if($resultado[0]['nacionalidad']== NULL) {
    $_SESSION['mensaje']= 'Error de Proceso '+$sql;
    header('location:./'.$_REQUEST['pagina']);
} else {
  $_SESSION['mensaje']=$resultado[0]['nacionalidad']."_".$_REQUEST['accion'];
  
  header('location:./'.$_REQUEST['pagina']);
}
?>
