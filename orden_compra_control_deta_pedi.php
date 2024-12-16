<!--Desde aqui el nuevo controlador-->
<?php
require './clases/conexion.php';
session_start();

if($_REQUEST['accion'] == 1){

    foreach ($_REQUEST['detalles'] as $key => $detOrdenComp){

      $sql_deta= "insert into det_orden_compra values("
        .$_REQUEST['vorden'].","
        .$detOrdenComp['cod_art'].","
        .$detOrdenComp['prec_unit_ordencomp'].","
        .$detOrdenComp['cantidad'].","
        .$detOrdenComp['subtototal'].",'"
        .$detOrdenComp['esta_detalle']."')";
        $resultado_deta = consultas::ejecutar_sql($sql_deta);

    $sql_esta_pedi = " update deta_pedido_comp set estado='CONFIRMADO' where cod_pedi_comp = " .$_REQUEST['vpedi']. " and cod_art = " .$detOrdenComp['cod_art'];
    $resul_esta = consultas::ejecutar_sql($sql_esta_pedi);
    }
    //if insercion
if ($resultado_deta == FALSE) {
    $json['mensaje'] = "Ocurrio un error";
    $json['success'] = FALSE;
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
   header('location:./'.$_REQUEST['pagina']);
} else {
    $json['mensaje'] = "Grabado con exito";
    $json['success'] = TRUE;  
//    header('location:./'.$_REQUEST['pagina']);
//    header('location:./'.$_REQUEST['pagina']." ? vorden=".$_REQUEST['vorden'].'&vpedi='.$_REQUEST['vpedi'].'&vpresu='.$_REQUEST['vpresu']);
}
echo json_encode($json);
}

        
//BORRAR DETALLE DE ORDEN COMPRA QUE SE GUARDO CON LOS DATOS DEL PEDIDO Y MODIFICAR EL ESTADO DEL DETA PEDIDO A PENDIENTE
if($_REQUEST['accion'] == 2){
    
    $sql_delete = " delete from det_orden_compra where id_orden_compra = " .$_REQUEST['vorden']. " and cod_art = " .$_REQUEST['varti'];
    $resultado = consultas::get_datos($sql_delete);

    if ($resultado == null) {
        $_SESSION['mensaje'] = "BORRADO CON EXITO_".$_REQUEST['accion'];
        header('location:./'.$_REQUEST['pagina']."?vorden=".
        $_REQUEST['vorden'].'&vpedi='.$_REQUEST['vpedi'].'&vpresu='.$_REQUEST['vpresu']);
    } 
    
    //CAMBIAR ESTADO DEL DETA PEDIDO A PENDIENTE
    $sql_esta_pedido = " update deta_pedido_comp set estado='RECHAZADO' where cod_pedi_comp = " .$_REQUEST['vpedi']. " and cod_art = " .$_REQUEST['varti']." and pedi_canti = " .$_REQUEST['vcant'];
    $resul_estado = consultas::ejecutar_sql($sql_esta_pedido);
    
    echo json_encode($json);
}

?>



