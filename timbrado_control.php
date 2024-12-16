<?php
require './clases/conexion.php';
session_start();
$sql = "SELECT sp_timbrado(".$_REQUEST['accion'].",".
        $_REQUEST['vtim'].",".
        $_REQUEST['vusu'].",'".
        $_REQUEST['vfecha_ini']."','".
        $_REQUEST['vfecha_fin']."','".
        $_REQUEST['vnro']."','".
        $_REQUEST['vestado']."',".
        $_REQUEST['vsuc'].",".
        $_REQUEST['vtipo_comp'].",".
        $_REQUEST['vdesde'].",".
        $_REQUEST['vhasta'].") as timbrados;";

$resultado = consultas::get_datos($sql);

if($resultado[0]['timbrados']== NULL) {
    $_SESSION['mensaje']= 'Error de Proceso '+$sql;
    header('location:./'.$_REQUEST['pagina']);
} else {
  $_SESSION['mensaje']=$resultado[0]['timbrados']."_".$_REQUEST['accion'];
  
  header('location:./'.$_REQUEST['pagina']);
}
?>

