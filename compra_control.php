<?php
require './clases/conexion.php';
session_start();
$cod = "select coalesce(max(cod_comp),0)+ 1 as vcodcomp from compras";
$res = consultas::get_datos($cod);

$orden = ($_REQUEST['vorden']) ? $_REQUEST['vorden'] : 0;
$pedido = ($_REQUEST['vpedi']) ? $_REQUEST['vpedi'] : 0;
$interval = ($_REQUEST['vinterval']) ? $_REQUEST['vinterval'] : 1;

$sql = "SELECT sp_compras(".$_REQUEST['accion'].","
        .$_REQUEST['vcodcomp'].",'"
        .$_REQUEST['vfecha']."','"
         .$_REQUEST['estado']."',"
        .$_REQUEST['vsuc'].","
        .$_REQUEST['vprov'].","
        .$_REQUEST['vusu'].",'"
        .$_REQUEST['vcondicion']."',"
        .$orden.","
        .$pedido.",'"
        .$_REQUEST['vfactura']."',"
        .$_REQUEST['vcancuo'].","
        .$interval.","
        .$_REQUEST['vtim'].",'"
        .$_REQUEST['vfecha_vigen']."',"
        .$_REQUEST['vtipo_comp'].","
        .$_REQUEST['vtotal'].") as compras_cabecera;";


$resultado = consultas::get_datos($sql);

//if($pedido[0]== 0 && $orden[0]== 0) {
//    $_SESSION['mensaje'] = "DEBE INGRESAR UN PEDIDO O UNA ORDEN";
//    header('location:./'.$_REQUEST['pagina']);
//    
//}

if ($resultado[0]['compras_cabecera']== null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['compras_cabecera']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina'].'?vcodcomp='.$res[0]['vcodcomp'].'&vorden='.$_REQUEST['vorden'].'&vpedi='.$_REQUEST['vpedi']);
}
?>
  