<?php

require './clases/conexion.php';
session_start();
$monto = ($_REQUEST['vmonto'])? $_REQUEST['vmonto'] : 0 ;
$sub = $_REQUEST['vdevol'] * $_REQUEST['vprecio'] + $monto;
$arti = ($_REQUEST['varti'])? $_REQUEST['varti'] : 0 ;
$depo = ($_REQUEST['vdepo'])? $_REQUEST['vdepo'] : 0 ;
$tiposer = ($_REQUEST['vserv'])? $_REQUEST['vserv'] : 0 ;
$equi = ($_REQUEST['vequi'])? $_REQUEST['vequi'] : 0 ;

$sql = "SELECT  sp_deta_not_credi_venta(" . $_REQUEST['accion'] . ","
        . $_REQUEST['vdetcred_fact'] . "," .
        $arti. "," .
        $tiposer . "," .
        $depo . "," .
        $equi . "," .
        $_REQUEST['vprecio'] . "," .
        $_REQUEST['vcant'] . "," .
        $sub . "," .
        $_REQUEST['vdevol'] . ",'" .
        $_REQUEST['vestado'] . "',".
        $_REQUEST['vsobrante'] . "," .
        $_REQUEST['vid'] . "," .
        $monto . ") as detcredfact;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['detcredfact'] == null) {
    $_SESSION['mensaje'] = 'Error de prceso ' + $sql;
    header('location:./' . $_REQUEST['pagina']);
} else {
    $_SESSION['mensaje'] = $resultado[0]['detcredfact'] . "_" . $_REQUEST['accion'];

    header('location:./' . $_REQUEST['pagina'] . "?vdetcred_fact=" .
            $_REQUEST['vdetcred_fact'] . "&vfact=" . $_REQUEST['vfact']);
}
?>
        

