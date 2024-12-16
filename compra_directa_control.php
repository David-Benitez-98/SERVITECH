<?php
require './clases/conexion.php';
session_start();
$cod = "select coalesce(max(cod_comp),0)+ 1 as vdetcompra from compras";
$res = consultas::get_datos($cod);

$orden = ($_REQUEST['vorden']) ? $_REQUEST['vorden'] : 0;
$pedido = ($_REQUEST['vpedi']) ? $_REQUEST['vpedi'] : 0;
$interval = ($_REQUEST['vinter']) ? $_REQUEST['vinter'] : 1;

$sql = "SELECT sp_compras_directas(".$_REQUEST['accion'].","
        .$_REQUEST['vcompra'].",'"
        .$_REQUEST['vfechafact']."','"
         .$_REQUEST['vestad']."',"
        .$_REQUEST['vsucursal'].","
        .$_REQUEST['vprov'].","
        .$_REQUEST['vusuario'].",'"
        .$_REQUEST['vcondicion']."',"
        .$orden.","
        .$pedido.",'"
        .$_REQUEST['vfact']."',"
        .$_REQUEST['vcuota'].","
        .$interval.","
        .$_REQUEST['vtim'].",'"
        .$_REQUEST['vfin']."',"
        .$_REQUEST['vtipo'].","
        .$_REQUEST['vtotal'].") as compras_cabeceras;";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['compras_cabeceras']== null) {
    $_SESSION['mensaje'] = 'Error de prceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['compras_cabeceras']."_".$_REQUEST['accion'];
    
       header('location:./'.$_REQUEST['pagina'].'?vdetcompra='.$res[0]['vdetcompra']);
}
?>
        

