<?php
require './clases/conexion.php';
session_start();
$cod = "select coalesce(max(cod_factura),0)+1 as vdetcod from factura_cab ";
$res = consultas::get_datos($cod);
$pres = ($_REQUEST['vpresu'])? $_REQUEST['vpresu'] : 0 ;
$intervalo = ($_REQUEST['vinter'])? $_REQUEST['vinter'] : 1 ;

$sql = "SELECT sp_factura(".$_REQUEST['accion'].","
        .$_REQUEST['vcod'].",".
        $_REQUEST['vusu'].",".
        $_REQUEST['vclie'].",'".
//        $_REQUEST['vaper'].",".
        $_REQUEST['vfecha']."','".
        $_REQUEST['vcondicion']."',".
        $_REQUEST['vtotal'].",'".
        $_REQUEST['vestado']."',".
        $_REQUEST['vcuota'].",".
        $intervalo.",".
        $_REQUEST['vaper'].",".
        $_REQUEST['vtim'].",'".
        $_REQUEST['vnrofact']."',".
        $pres.",".
        $_REQUEST['vsuc'].") as factura;";
        
        

$resultado = consultas::get_datos($sql);


if ($resultado[0]['factura']== null) {
    $_SESSION['mensaje'] = 'Error de prceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['factura']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina'].'?vdetcod='.$res[0]['vdetcod'].'&vpresu='.$_REQUEST['vpresu']);
            
}
?>
        

