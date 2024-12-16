<?php
require './clases/conexion.php';
session_start();
//$articulo = explode("_", $_REQUEST['varti']);

$sql = "SELECT sp_deta_nota_remi_comp(".$_REQUEST['accion'].","
        .$_REQUEST['vnota'].","
        .$_REQUEST['varti'].","
        .$_REQUEST['vcant'].",'"
        .$_REQUEST['vestado']."') as deta_nota_remi_compra;";
        
        

$resultado = consultas::get_datos($sql);

if ($resultado[0]['deta_nota_remi_compra']== null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['deta_nota_remi_compra']."_".
            $_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']."?vnota=".
            $_REQUEST['vnota'].'&vcodcomp='.$_REQUEST['vcodcomp']);
}
?>

