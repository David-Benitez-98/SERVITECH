<?php

require './clases/conexion.php';

session_start();

$sql = "SELECT sp_clientes(".$_REQUEST['accion'].","
        .$_REQUEST['vcli'].","
        .$_REQUEST['vper'].") as clientes;";
$resultado = consultas::get_datos($sql);


if ($resultado[0]['clientes'] == null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header('location:./'.$_REQUEST['pagina']);
} else {
    $_SESSION['mensaje'] = $resultado[0]['clientes']."_".$_REQUEST['accion'];

    header('location:./'.$_REQUEST['pagina']);
}
?>

