<?php
require './clases/conexion.php';
session_start();
$sql = "SELECT sp_equipos(".$_REQUEST['accion'].",".
        $_REQUEST['vequi'].",'".
        trim($_REQUEST['vdescri'])."',".
        $_REQUEST['vmar'].",".
        $_REQUEST['vtipo'].",".
        $_REQUEST['vcolor'].") as equipos;";

$resultado = consultas::get_datos($sql);

if($resultado[0]['equipos']== NULL) {
    $_SESSION['mensaje']= 'Error de Proceso '+$sql;
    header('location:./'.$_REQUEST['pagina']);
} else {
  $_SESSION['mensaje']=$resultado[0]['equipos']."_".$_REQUEST['accion'];
  
  header('location:./'.$_REQUEST['pagina']);
}
?>

