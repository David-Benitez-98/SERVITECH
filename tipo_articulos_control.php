<?php
require './clases/conexion.php';
session_start();
$sql = "SELECT sp_tipo_articulo(".$_REQUEST['accion'].","
        .$_REQUEST['vtipo_art'].",'".$_REQUEST['vtipo_des']."') as tipo_articulos;";

$resultado = consultas::get_datos($sql);

if($resultado[0]['tipo_articulos']== NULL) {
    $_SESSION['mensaje']= 'Error de Proceso '+$sql;
    header('location:./'.$_REQUEST['pagina']);
} else {
  $_SESSION['mensaje']=$resultado[0]['tipo_articulos']."_".$_REQUEST['accion'];
  
  header('location:./'.$_REQUEST['pagina']);
}
?>

