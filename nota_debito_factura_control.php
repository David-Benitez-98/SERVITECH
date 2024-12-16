<?php

require './clases/conexion.php';
session_start();
$cod = "select coalesce(max(cod_not_debi_vent),0)+1 as vdetdebifact from nota_debito_venta ";
$res = consultas::get_datos($cod);
$inte = ($_REQUEST['vinter']) ? $_REQUEST['vinter'] : 0;
$aumen = ($_REQUEST['vaumen']) ? $_REQUEST['vaumen'] : 0;

//If ($_REQUEST['vdesc'] == 0){
//    $subt = !empty($_REQUEST['vtotal']) ? $_REQUEST['vtotal'] : 0 ;
//    
//}  else {
//   $subt = !empty($_REQUEST['subtotal_nota']) ? $_REQUEST['subtotal_nota'] :0 ; 
//}

$sql = "SELECT sp_notadebito_venta(" . $_REQUEST['accion'] . ","
        . $_REQUEST['vdebit'] . "," .
        $_REQUEST['vusu'] . "," .
        $_REQUEST['vsuc'] . "," .
        $_REQUEST['vfact'] . "," .
        $_REQUEST['vclie'] . "," .
        $_REQUEST['vtim'] . ",'" .
        $_REQUEST['vfecha'] . "','" .
        $_REQUEST['vmotiv'] . "','" .
        $_REQUEST['vdescrip'] . "'," .
        $inte . "," .
        $aumen . ",'" .
        $_REQUEST['vestado'] . "','" .
        $_REQUEST['vnrodebi'] . "'," .
        $_REQUEST['vtotal'] . ") as debitofactura;";


$resultado = consultas::get_datos($sql);

//if ($_REQUEST['accion'] == 1){
//$sql_esta_comp = "update compras set compra_estado='CONFRIMADO/NOTA' where id_compra = ".$_REQUEST['vcompr'];
//$reul_estado = consultas::ejecutar_sql($sql_esta_comp);
//    
//}

if ($resultado[0]['debitofactura'] == null) {
    $_SESSION['mensaje'] = 'Error de prceso ' + $sql;
    header('location:./' . $_REQUEST['pagina']);
} else {
    $_SESSION['mensaje'] = $resultado[0]['debitofactura'] . "_" . $_REQUEST['accion'];

    header('location:./' . $_REQUEST['pagina'] . '?vdetdebifact=' . $res[0]['vdetdebifact'] . '&vfact=' . $_REQUEST['vfact']);
}
?>
        

