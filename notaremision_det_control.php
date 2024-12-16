<?php

require './clases/conexion.php';
session_start();
$sub = $_REQUEST['vdevol'] * $_REQUEST['vprecio'];

$sql = "SELECT  sp_detanotaremision(" . $_REQUEST['accion'] . ","
        . $_REQUEST['vdetremi'] . "," .
        $_REQUEST['varti'] . "," .
        $_REQUEST['vcant'] . ",'" .
         $_REQUEST['vestado'] . "') as detremision;";



$resultado = consultas::get_datos($sql);

if ($resultado[0]['detremision'] == null) {
    $_SESSION['mensaje'] = 'Error de prceso ' + $sql;
    header('location:./' . $_REQUEST['pagina']);
} else {
    $_SESSION['mensaje'] = $resultado[0]['detremision'] . "_" . $_REQUEST['accion'];

    header('location:./' . $_REQUEST['pagina'] . "?vdetremi=" .
            $_REQUEST['vdetremi'] . "&vcompr=" . $_REQUEST['vcompr']);
}
?>
        

