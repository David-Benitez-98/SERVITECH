<?php

require './clases/conexion.php';

session_start();

$sql = "SELECT sp_stock(".$_REQUEST['accion'].","
        .$_REQUEST['vart'].","
        .$_REQUEST['vdep'].","
        .$_REQUEST['vcant'].") as stocks;";
$resultado = consultas::get_datos($sql);


if ($resultado[0]['stocks'] == null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header('location:./'.$_REQUEST['pagina']);
} else {
    $_SESSION['mensaje'] = $resultado[0]['stocks']."_".$_REQUEST['accion'];

    header('location:./'.$_REQUEST['pagina']);
}
?>
