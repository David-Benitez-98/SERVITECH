<?php
require './clases/conexion.php';
session_start();
$sql = "SELECT sp_tipo_cheque(".$_REQUEST['accion'].","
        .$_REQUEST['vciu_cod'].",'".$_REQUEST['vciu_nom']."') as tipo_cheq;";

$resultado = consultas::get_datos($sql);

if($resultado[0]['tipo_cheq']== NULL) {
    $_SESSION['mensaje']= 'Error de Proceso '+$sql;
    header('location:./'.$_REQUEST['pagina']);
} else {
  $_SESSION['mensaje']=$resultado[0]['tipo_cheq']."_".$_REQUEST['accion'];
  
  header('location:./'.$_REQUEST['pagina']);
}
?>


