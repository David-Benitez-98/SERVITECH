<?php
require './clases/conexion.php';
session_start();

$sql = "SELECT sp_caja(".$_REQUEST['accion'].","
        .$_REQUEST['vcod'].",'".
        $_REQUEST['vdescrip']."',".
        $_REQUEST['vult'].",".
        $_REQUEST['vpunto'].",'".
        $_REQUEST['vestado']."',".
        $_REQUEST['vsuc'].") as caja;";
        
        

$resultado = consultas::get_datos($sql);

if ($resultado[0]['caja']== null) {
    $_SESSION['mensaje'] = 'Error de prceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['caja']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']);
}
?>
