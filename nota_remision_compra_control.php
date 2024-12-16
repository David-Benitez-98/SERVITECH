<?php
require './clases/conexion.php';
session_start();

$cod = "select coalesce(max(cod_nota_remi_comp),0)+ 1 as vnota from nota_remision_compra";
$res = consultas::get_datos($cod);
$sql = "SELECT sp_nota_remi(".$_REQUEST['accion'].","
        .$_REQUEST['vnota'].","
        .$_REQUEST['vcodcomp'].",'"
        .$_REQUEST['vestado']."','"
        .$_REQUEST['vfecha_inicial']."','"
        .$_REQUEST['vfecha_final']."','"
        .$_REQUEST['vmotivo']."','"
        .$_REQUEST['vatraso']."','"
        .$_REQUEST['vtransporte']."','"
        .$_REQUEST['vrua']."','"
        .$_REQUEST['vconductor']."','"
        .$_REQUEST['vci']."','"
        .$_REQUEST['vtelef']."',"
        .$_REQUEST['vkm'].","
        .$_REQUEST['vprov'].","
        .$_REQUEST['vsuc'].","
        .$_REQUEST['vcod_usu'].",'"
        .$_REQUEST['vnro_remi']."',"
        .$_REQUEST['vtim'].","
        .$_REQUEST['vtipo_comp'].") as nota_remi_comp;";
        
$resultado = consultas::get_datos($sql);

if ($resultado[0]['nota_remi_comp']== null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['nota_remi_comp']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina'].'?vnota='.$res[0]['vnota'].'&vcodcomp='.$_REQUEST['vcodcomp']);
    
    
}
?>