<?php
require './clases/conexion.php';
session_start();
$cod = "select coalesce(max(cod_not_credi_vent),0)+1 as vdetcred_fact from nota_credi_venta    ";
$res = consultas::get_datos($cod);
$desc = ($_REQUEST['vdesc'])? $_REQUEST['vdesc'] : 0 ;

$sql = "SELECT sp_notacredfact(".$_REQUEST['accion'].","
        .$_REQUEST['vcred'].",".
        $_REQUEST['vsuc'].",".
        $_REQUEST['vusu'].",".
        $_REQUEST['vfact'].",".
        $_REQUEST['vclie'].",".
        $_REQUEST['vtimb'].",'".
        $_REQUEST['vfecha']."','".
        $_REQUEST['vmotiv']."','".
        $_REQUEST['vdescrip']."',".
        $desc.",'".
        $_REQUEST['vestado']."',".
        $_REQUEST['vtotal'].",'".
        $_REQUEST['vnrocredi']."') as creditofact;";
        
$resultado = consultas::get_datos($sql);


if ($resultado[0]['creditofact']== null) {
    $_SESSION['mensaje'] = 'Error de prceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['creditofact']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina'].'?vdetcred_fact='.$res[0]['vdetcred_fact'].'&vfact='.$_REQUEST['vfact']);
            
}
?>
        

