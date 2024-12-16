<?php
require './clases/conexion.php';
session_start();

$imagen= !empty($_REQUEST['vimagen']) ? $_REQUEST['vimagen'] : '';
$precio= !empty($_REQUEST['vprecio']) ? $_REQUEST['vprecio'] : '0';
$plazo= !empty($_REQUEST['vplazo']) ? $_REQUEST['vplazo'] : '0';
$garan_desc= !empty($_REQUEST['vgaran_descri']) ? $_REQUEST['vgaran_descri'] : '';
$garan_condi= !empty($_REQUEST['vgaran_condi']) ? $_REQUEST['vgaran_condi'] : '';

$sql = "SELECT sp_articulos(".$_REQUEST['accion'].","
        .$_REQUEST['varti'].",'"
        .$_REQUEST['vdescri']."',"
        .$precio.","
        .$_REQUEST['vmar'].","
        .$_REQUEST['vimpues'].","
        .$_REQUEST['vtipo_arti'].",'"
        .$imagen."','"
        .$_REQUEST['vcapacidad']."',"
        .$plazo.",'"
        .$garan_desc."','"
        .$garan_condi."') as articulos;";
        
// echo $sql;       
$resultado = consultas::get_datos($sql);

if ($resultado[0]['articulos']== null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['articulos']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']);
}
?>
        
