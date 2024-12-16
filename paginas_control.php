<?php

require './clases/conexion.php';

session_start();

$sql = "SELECT sp_permisos(".$_REQUEST['accion'].","
        .$_REQUEST['vgru'].",'".$_REQUEST['vpag']."','".$_REQUEST['consul']."','"
        .$_REQUEST['agre']."','".$_REQUEST['editar']."','".$_REQUEST['borrar']."') as permisos;";
$resultado = consultas::get_datos($sql);


if ($resultado[0]['permisos'] == null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header('location:./'.$_REQUEST['pagina']);
} else {
    $_SESSION['mensaje'] = $resultado[0]['permisos']."_".$_REQUEST['accion'];

    header('location:./'.$_REQUEST['pagina'] . "?vgrup=" . $_REQUEST['vgru']. '&vgrunombre=' . $_REQUEST['vgrunombre']);
}
?>



