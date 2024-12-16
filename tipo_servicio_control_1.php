<?php
require './clases/conexion.php';
session_start();

$sql = "SELECT sp_tipo_servicios(".$_REQUEST['accion'].",".
        $_REQUEST['vtipo'].",".
        $_REQUEST['vprecio'].",'".
        $_REQUEST['vdescri']."',".
        $_REQUEST['vimp'].",'".
        $_REQUEST['vplazo']."') as tipos_servicios;";

$resultado = consultas::get_datos($sql);

if($resultado[0]['tipos_servicios']== NULL) {
    $_SESSION['mensaje']= 'Error de Proceso '+$sql;
    header('location:./'.$_REQUEST['pagina']);
} else {
  $_SESSION['mensaje']=$resultado[0]['tipos_servicios']."_".$_REQUEST['accion'];
  
  header('location:./'.$_REQUEST['pagina']."?vdiag=". $_REQUEST['vdiag'].'&vrecep='.$_REQUEST['vrecep']);
}
?>

