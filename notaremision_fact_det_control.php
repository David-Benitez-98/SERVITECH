<?php

require './clases/conexion.php';
session_start();


$sql = "SELECT  sp_detanotaremisionfact(" . $_REQUEST['accion'] . ","
        . $_REQUEST['vdetremifact'] . "," .
        $_REQUEST['varti'] . "," .
        $_REQUEST['vcant'] . ",'" .
         $_REQUEST['vestado'] . "') as detremisionfact;";



$resultado = consultas::get_datos($sql);

if ($resultado[0]['detremisionfact'] == null) {
    $_SESSION['mensaje'] = 'Error de prceso ' + $sql;
    header('location:./' . $_REQUEST['pagina']);
} else {
    $_SESSION['mensaje'] = $resultado[0]['detremisionfact'] . "_" . $_REQUEST['accion'];

    header('location:./' . $_REQUEST['pagina'] . "?vdetremifact=" .
            $_REQUEST['vdetremifact'] . "&vfact=" . $_REQUEST['vfact']);
}
?>
        

