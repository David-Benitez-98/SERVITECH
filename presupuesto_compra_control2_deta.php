<!--Desde aqui el nuevo controlador-->
<?php
require './clases/conexion.php';
session_start();

if($_REQUEST['accion'] == 1){

    foreach ($_REQUEST['detalles'] as $key => $detPresuComp){

      $sql_deta= "insert into deta_presu_compra values("
        .$_REQUEST['vpresu'].","
        .$detPresuComp['cod_art'].","
        .$detPresuComp['presu_prec_comp'].","
        .$detPresuComp['detalle_cantidad'].","
        .$detPresuComp['subtotal_presu'].",'"
        .$detPresuComp['estado_deta_presu']."')";
        $resultado_deta = consultas::ejecutar_sql($sql_deta);
        
    $sql_esta_pedi = " update deta_pedido_comp set estado='CONFIRMADO' where cod_pedi_comp = " .$_REQUEST['vpedi']. " and cod_art = " .$detPresuComp['cod_art'];
    $resul_esta = consultas::ejecutar_sql($sql_esta_pedi);
    }


if ($resultado_deta == FALSE) {
    $json['mensaje'] = "Ocurrio un error";
    $json['success'] = FALSE;
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
   header('location:./'.$_REQUEST['pagina']);
} else {
    $json['mensaje'] = "Grabado con exito";
    $json['success'] = TRUE;  
}

    $sql_total = " update presupuesto_compra set total_presu_comp= " .$_REQUEST['total_presu_comp']." where cod_presu_comp=" . $_REQUEST['vpresu'];
    $resul_total = consultas::ejecutar_sql($sql_total);
echo json_encode($json);
}

?>
