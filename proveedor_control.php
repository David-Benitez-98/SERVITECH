<?php

require './clases/conexion.php';

session_start();

$sql = "SELECT sp_proveedor(".$_REQUEST['accion'].","
        .$_REQUEST['vprov'].","
        .$_REQUEST['vper'].",'"
        .$_REQUEST['vestado']."') as proveedores;";
$resultado = consultas::get_datos($sql);


if ($resultado[0]['proveedores'] == null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header('location:./'.$_REQUEST['pagina']);
} else {
    $_SESSION['mensaje'] = $resultado[0]['proveedores']."_".$_REQUEST['accion'];

    header('location:./'.$_REQUEST['pagina']);
}
?>

