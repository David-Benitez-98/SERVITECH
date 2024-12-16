!--Desde aqui el nuevo controlador-->
<?php
require './clases/conexion.php';
session_start();
//if($vacio['observacion_detalle'] === NULL){
//    
//   $_SESSION['mensaje'] = "NO SE PERMITEN ESPACIOS VACIOS";  
//} 
if($_REQUEST['accion'] == "1"){ //Accion 1 "Insertar Pedido Cabecera"
    $cod = "select coalesce(max(cod_recep),0)+ 1 as codigo from recepcion";
    $res = consultas::get_datos($cod);
    
    $sql = "insert into recepcion values(".$res[0]['codigo'].", upper('"
        .$_REQUEST['vdescri']."'),'"
        .$_REQUEST['vfecha']."','"
        .$_REQUEST['vestado']."',"
        .$_REQUEST['vcod_usu'].","
        .$_REQUEST['vsucursal'].","
        .$_REQUEST['vcliente'].")";
    $resultado = consultas::ejecutar_sql($sql);
//hasta aqui cabecera
   
//Insertar Detalle pedido
    foreach ($_REQUEST['detalles'] as $key => $detRecepServi){
     //ESTE ES PARA QUE EL CAMPO OBSERVACION NO SE GUARDEN CON ESPACIOS   
      $sql_deta= "insert into deta_recep values(".$res[0]['codigo'].","
        .$detRecepServi['cod_equipo'].", upper('"
        .trim($detRecepServi['observacion_detalle'])."'),'"
        .$detRecepServi['estado_detalle']."')";
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
//Hasta aqui Accion 1


//Accion 2 "Anular el Pedido con Update:Editar"
if($_REQUEST['accion'] == "2"){
 
    $sql_anular = " update recepcion set estado= '" .$_REQUEST['vestado']."' where cod_recep=" . $_REQUEST['codigo'];
    $resul_anular = consultas::ejecutar_sql($sql_anular);
    
    if ($resul_anular == FALSE) {
        $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
        header ('location:./'.$_REQUEST['pagina']);
    } else {
        $_SESSION['mensaje'] = "RECEPCION ANULADO CON EXITO_".$_REQUEST['accion'];
        header('location:./'.$_REQUEST['pagina']);
    }
    echo json_encode($json);
}

//Accion 4 "Confirmar el Pedido con Update:Editar"
if($_REQUEST['accion'] == "4"){
 
    $sql_anular = " update recepcion set estado= '" .$_REQUEST['vestado']."' where cod_recep=" . $_REQUEST['codigo'];
    $resul_anular = consultas::ejecutar_sql($sql_anular);
    
    if ($resul_anular == FALSE) {
        $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
        header ('location:./'.$_REQUEST['pagina']);
    } else {
        $_SESSION['mensaje'] = "RECEPCION CONFIRMADO CON EXITO_".$_REQUEST['accion'];
        header('location:./'.$_REQUEST['pagina']);
    }
    echo json_encode($json);
}
?>