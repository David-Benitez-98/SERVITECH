<!--Desde aqui el nuevo controlador-->
<?php
require './clases/conexion.php';
session_start();

//Accion 1 "Insertar Pedido Cabecera"
if($_REQUEST['accion'] == "1"){
    $cod = "select coalesce(max(cod_pedi_comp),0)+ 1 as codigo from pedido_compra";
    $res = consultas::get_datos($cod);
    
    $sql = "insert into pedido_compra values(".$res[0]['codigo'].","
        .$_REQUEST['vcod_usu'].","
        .$_REQUEST['vsucursal'].",'"
        .$_REQUEST['vfecha']."','"
        .$_REQUEST['vestado']."', upper('"
        .$_REQUEST['vdescri']."'))";
    $resultado = consultas::ejecutar_sql($sql);
//hasta aqui cabecera
    
//Insertar Detalle pedido
    foreach ($_REQUEST['detalles'] as $key => $detPedComp){

      $sql_deta= "insert into deta_pedido_comp values(".$res[0]['codigo'].","
        .$detPedComp['cod_art'].","
        .$detPedComp['cantidad_detalle'].",'"
        .$detPedComp['estado_detalle']."')";
    $resultado_deta = consultas::ejecutar_sql($sql_deta);
       #$resuldet = consultas::ejecutar_sql($det);
    }
//hasta aqui detalle pedido
    
    //Consulta si los datos se guardaron bien
if ($resultado == FALSE) {
    $json['mensaje'] = "Ocurrio un error";
    $json['success'] = FALSE;
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header('location:./'.$_REQUEST['pagina']);
} else {
    $json['mensaje'] = "Grabado con exito";
    $json['success'] = TRUE;
}
echo json_encode($json);
}//Hasta aqui Accion 1

//Accion 2 "Anular el Pedido con Update:Editar"
if($_REQUEST['accion'] == "2"){
 
    $sql_anular = " update pedido_compra set estado_pedido= '" .$_REQUEST['vestado']."' where cod_pedi_comp=" . $_REQUEST['codigo'];
    $resul_anular = consultas::ejecutar_sql($sql_anular);
    
    if ($resul_anular == FALSE) {
        $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
        header ('location:./'.$_REQUEST['pagina']);
    } else {
        $_SESSION['mensaje'] = "PEDIDO ANULADO CON EXITO_".$_REQUEST['accion'];
        header('location:./'.$_REQUEST['pagina']);
    }
    echo json_encode($json);
}

//Accion 4 "Confirmar el Pedido con Update:Editar"
if($_REQUEST['accion'] == "4"){
 
    $sql_anular = " update pedido_compra set estado_pedido= '" .$_REQUEST['vestado']."' where cod_pedi_comp=" . $_REQUEST['codigo'];
    $resul_anular = consultas::ejecutar_sql($sql_anular);
    
    if ($resul_anular == FALSE) {
        $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
        header ('location:./'.$_REQUEST['pagina']);
    } else {
        $_SESSION['mensaje'] = "PEDIDO CONFIRMADO CON EXITO_".$_REQUEST['accion'];
        header('location:./'.$_REQUEST['pagina']);
    }
    echo json_encode($json);
}
?>