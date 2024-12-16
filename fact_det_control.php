<?php

require './clases/conexion.php';
session_start();
//$sub = $_REQUEST['vcant'] * $_REQUEST['vprecio'];

$arti = ($_REQUEST['varti'])? $_REQUEST['varti'] : 0 ;
$depo = ($_REQUEST['vdepo'])? $_REQUEST['vdepo'] : 0 ;
$tiposer = ($_REQUEST['vserv'])? $_REQUEST['vserv'] : 0 ;
$equi = ($_REQUEST['vequi'])? $_REQUEST['vequi'] : 0 ;
$monto_ser = ($_REQUEST['vmonto_ser'])? $_REQUEST['vmonto_ser'] : 0 ;
$prec_art = ($_REQUEST['vprecio'])? $_REQUEST['vprecio'] : 0 ;

$sql = "SELECT  sp_det_factura(" . $_REQUEST['accion'] . ","
        . $_REQUEST['vdetcod'] . "," .
        $tiposer. ",".
        $arti."," .
        $depo . "," .
        $equi . "," .
        $prec_art . "," .
        $_REQUEST['vcant'] . "," .
        $_REQUEST['vsubt'] . ",'" .
        $_REQUEST['vestado'] . "',".
        $_REQUEST['vid'] . ",".
        $monto_ser.") as detfact;";



$resultado = consultas::get_datos($sql);

if ($resultado[0]['detfact'] == null) {
    $_SESSION['mensaje'] = 'Error de prceso ' + $sql;
    header('location:./' . $_REQUEST['pagina']);
} else {
    $_SESSION['mensaje'] = $resultado[0]['detfact'] . "_" . $_REQUEST['accion'];

    header('location:./' . $_REQUEST['pagina'] . "?vdetcod=" .
            $_REQUEST['vdetcod'] . "&vpresu=" . $_REQUEST['vpresu']);
}
?>
        

