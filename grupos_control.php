<?php
require './clases/conexion.php';
session_start();
$sql = "SELECT sp_grupos(".$_REQUEST['accion'].","
        .$_REQUEST['vgru_cod'].",'".$_REQUEST['vgru_nom']."') as grupos;";

$resultado = consultas::get_datos($sql);

if($resultado[0]['grupos']== NULL) {
    $_SESSION['mensaje']= 'Error de Proceso '+$sql;
    header('location:./'.$_REQUEST['pagina']);
} else {
  $_SESSION['mensaje']=$resultado[0]['grupos']."_".$_REQUEST['accion'];
  
  header('location:./'.$_REQUEST['pagina']);
}
?>


