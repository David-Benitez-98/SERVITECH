<?php

require './clases/conexion.php';
session_start();
$sub = $_REQUEST['vdevol'] * $_REQUEST['vprecio'];

$sql = "SELECT  sp_detanotacredcompra(" . $_REQUEST['accion'] . ","
        . $_REQUEST['vdetdebi'] . "," .
        $_REQUEST['varti'] . "," .
        $_REQUEST['vdepo'] . "," .
        $_REQUEST['vprecio'] . "," .
        $_REQUEST['vcant'] . "," .
        $sub . "," .
        $_REQUEST['vdevol'] . ",'" .
        $_REQUEST['vestado'] . "',".
        $_REQUEST['vsobrante'] . ") as detcred;";



$resultado = consultas::get_datos($sql);

if ($resultado[0]['detcred'] == null) {
    $_SESSION['mensaje'] = 'Error de prceso ' + $sql;
    header('location:./' . $_REQUEST['pagina']);
} else {
    $_SESSION['mensaje'] = $resultado[0]['detcred'] . "_" . $_REQUEST['accion'];

    header('location:./' . $_REQUEST['pagina'] . "?vdetdebi=" .
            $_REQUEST['vdetdebi'] . "&vcompr=" . $_REQUEST['vcompr']);
}
?>
        

