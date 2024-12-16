<?php
require './clases/conexion.php';
session_start();
$sql = "SELECT sp_funcionarios(".$_REQUEST['accion'].","
        .$_REQUEST['vfun'].",".$_REQUEST['vper'].",".$_REQUEST['vcarg'].",".$_REQUEST['vsuc'].") as funcionarios;";

$resultado = consultas::get_datos($sql);

if($resultado[0]['funcionarios']== NULL) {
    $_SESSION['mensaje']= 'Error de Proceso '+$sql;
    header('location:./'.$_REQUEST['pagina']);
} else {
  $_SESSION['mensaje']=$resultado[0]['funcionarios']."_".$_REQUEST['accion'];
  
  header('location:./'.$_REQUEST['pagina']);
}
?>

