<?php
require './clases/conexion.php';
session_start();
//consulta el ultimo codigo de la orden
$cod = "select coalesce(max(id_orden_compra),0)+ 1 as vorden from orden_compra";
$res = consultas::get_datos($cod);

$pedido = ($_REQUEST['vpedi']) ? $_REQUEST['vpedi'] : 0;
$presupuesto = ($_REQUEST['vpresu']) ? $_REQUEST['vpresu'] : 0;
$sql = "SELECT sp_orden_compra(".$_REQUEST['accion'].","
        .$_REQUEST['vorden'].","
        .$_REQUEST['vusu'].","
        .$_REQUEST['vprov'].",'"
        .$_REQUEST['vfecha']."','"
        .$_REQUEST['estado']."',"
        .$pedido.","
        .$presupuesto.","
        .$_REQUEST['vtotal'].") as orden_compra;";
        
$resultado = consultas::get_datos($sql);

//if($pedido[0]== 0 && $orden[0]== 0 && $_REQUEST['accion']==1) {
//   // $_SESSION['mensaje'] = "DEBE INGRESAR UN PEDIDO O UNA ORDEN";
//    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
//    header('location:./'.$_REQUEST['orden_compra_index.php']);
//    
//}

if ($resultado[0]['orden_compra']== null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['orden_compra']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina'].'?vorden='.$res[0]['vorden'].'&vpedi='.$_REQUEST['vpedi'].'&vpresu='.$_REQUEST['vpresu']);
    
    
}


?>

