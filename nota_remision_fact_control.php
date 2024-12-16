<?php

require './clases/conexion.php';
session_start();
$cod = "select coalesce(max(cod_nota_remi_vent),0)+1 as vdetremifact from nota_remision_venta ";
$res = consultas::get_datos($cod);

    $mot = !empty($_REQUEST['vmotiv']) ? $_REQUEST['vmotiv'] : 'VENTA';
    $km = !empty($_REQUEST['vmotiv']) ? $_REQUEST['vmotiv'] : 0;

$sql = "SELECT sp_notaremisionfact(" . $_REQUEST['accion'] . ",". 
        $_REQUEST['vremi'] . "," .
        $_REQUEST['vfact'] . "," .
        $_REQUEST['vclie'] . "," .
        $_REQUEST['vusu'] . "," .
        $_REQUEST['vpers'] . "," .
        $_REQUEST['vtimb'] . "," .
        $_REQUEST['vsuc'] . "," .
        $_REQUEST['vmarc'] . ",'" .
        $_REQUEST['vchap']. "','" .
        $_REQUEST['vsali'] . "','" .
        $_REQUEST['vestado'] . "','" .
        $mot . "'," .
        $km . ",'" .
        $_REQUEST['vllega'] . "','" .
        $_REQUEST['vnroremi'] . "') as remisionfact;";



$resultado = consultas::get_datos($sql);

//if ($_REQUEST['accion'] == 1){
//$sql_esta_comp = "update compras set compra_estado='CONFRIMADO/NOTA' where id_compra = ".$_REQUEST['vcompr'];
//$reul_estado = consultas::ejecutar_sql($sql_esta_comp);
//    
//}

if ($resultado[0]['remisionfact'] == null) {
    $_SESSION['mensaje'] = 'Error de prceso ' + $sql;
    header('location:./' . $_REQUEST['pagina']);
} else {
    $_SESSION['mensaje'] = $resultado[0]['remisionfact'] . "_" . $_REQUEST['accion'];

    header('location:./' . $_REQUEST['pagina'] . '?vdetremifact=' . $res[0]['vdetremifact'] . '&vfact=' . $_REQUEST['vfact']);
}
?>
        

