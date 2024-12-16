<?php
require './clases/conexion.php';
session_start();
$sql = "SELECT sp_sucursal(".$_REQUEST['accion'].",".
        $_REQUEST['vsuc'].",".
        $_REQUEST['vemp'].",'".
        $_REQUEST['vdescri']."',".
        $_REQUEST['vciu'].",".
        $_REQUEST['vdepar'].",'".
        $_REQUEST['vtelf']."','".
        $_REQUEST['vdirec']."','".
        $_REQUEST['vestado']."') as sucursales;";

$resultado = consultas::get_datos($sql);

if($resultado[0]['sucursales']== NULL) {
    $_SESSION['mensaje']= 'Error de Proceso '+$sql;
    header('location:./'.$_REQUEST['pagina']);
} else {
  $_SESSION['mensaje']=$resultado[0]['sucursales']."_".$_REQUEST['accion'];
  
  header('location:./'.$_REQUEST['pagina']);
}
?>

