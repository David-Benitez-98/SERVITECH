<?php
require './clases/conexion.php';
session_start();
$sql = "SELECT sp_deposito(".$_REQUEST['accion'].","
        .$_REQUEST['vdepo_cod'].",'".$_REQUEST['vdepo_nom']."') as deposito;";

$resultado = consultas::get_datos($sql);

if($resultado[0]['deposito']== NULL) {
    $_SESSION['mensaje']= 'Error de Proceso '+$sql;
    header('location:./'.$_REQUEST['pagina']);
} else {
  $_SESSION['mensaje']=$resultado[0]['deposito']."_".$_REQUEST['accion'];
  
  header('location:./'.$_REQUEST['pagina']);
}
?>


