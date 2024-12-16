!--Desde aqui el nuevo controlador-->
<?php
require './clases/conexion.php';
session_start();

if($_REQUEST['accion'] == "1"){ //Accion 1 "Insertar Pedido Cabecera"
    $cod = "select coalesce(max(cod_desc_servi),0)+ 1 as codigo from descuento_servicio";
    $res = consultas::get_datos($cod);
    
    $sql = "insert into descuento_servicio values(".$res[0]['codigo'].",'"
        .$_REQUEST['vfecha_ini']."','"
        .$_REQUEST['vfecha_fin']."','"
        .$_REQUEST['vestado']."',"
        .$_REQUEST['vcod_usu'].","
        .$_REQUEST['vsucursal'].")";
   // $resultado = consultas::ejecutar_sql($sql);
    
//hasta aqui cabecera
  
//Insertar Detalle
    foreach ($_REQUEST['detalles'] as $key => $detPromoDesc){
     //ESTE ES PARA QUE EL CAMPO OBSERVACION NO SE GUARDEN CON ESPACIOS   
 $consulta_repe_tipo = "select * from tipo_servicio where cod_tipo_servi IN (select cod_tipo_servi from deta_descuento_servi where "
         . "cod_tipo_servi=" .$detPromoDesc['cod_tipo_servi']. " and estado = '" .$detPromoDesc['estado_detalle']. 
         "' OR cod_tipo_servi=" .$detPromoDesc['cod_tipo_servi']. " and estado = 'ACTIVO') "
         . "or cod_tipo_servi IN (select cod_tipo_servi from deta_promo where cod_tipo_servi=" .$detPromoDesc['cod_tipo_servi']. " and estado = '" .$detPromoDesc['estado_detalle']. "'"
         . " OR cod_tipo_servi=" .$detPromoDesc['cod_tipo_servi']. " and estado = 'ACTIVO') ";
 $resul_consulta_repe_tipo = consultas::get_datos($consulta_repe_tipo);
 
 if($resul_consulta_repe_tipo == NULL) {
      $sql_deta= "insert into deta_descuento_servi values(".$res[0]['codigo'].","
        .$detPromoDesc['cod_tipo_servi'].", upper('"
        .trim($detPromoDesc['estado_detalle'])."'),"
        .$detPromoDesc['valor_porcentual_detalle'].")";
    $resultado = consultas::ejecutar_sql($sql);
    $resultado_deta = consultas::ejecutar_sql($sql_deta);
       #$resuldet = consultas::ejecutar_sql($det);
 }
  
 }
//hasta aqui detalle pedido


if ($resultado == FALSE || $resultado_deta == FALSE || $resul_consulta_repe_tipo != NULL ) {
    $json['mensaje'] = "Tipo de Servicio ya esta activo en una promocion o ya existe una descripcion de promocion igual";
   // $json['mensaje'] = "Ocurrio un error";
    $json['success'] = FALSE;
    $json['mensaje'] = 'Error de Proceso '+$sql;
    header('location:http://localhost/servitech_tesis/promocion_servicio_index.php');
} else {
    $json['mensaje'] = "Grabado con exito";
    $json['success'] = TRUE;
}
echo json_encode($json);
}//Hasta aqui Accion 1


//Accion 2 "Anular el Pedido con Update:Editar"
if($_REQUEST['accion'] == "2"){
 
    $sql_anular = " update descuento_servicio set estado= '" .$_REQUEST['vestado']."' where cod_desc_servi=" . $_REQUEST['codigo'];
    $resul_anular = consultas::ejecutar_sql($sql_anular);
    
    if ($resul_anular == FALSE) {
        $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
        header ('location:./'.$_REQUEST['pagina']);
    } else {
        $_SESSION['mensaje'] = "DESCUENTO ANULADO CON EXITO_".$_REQUEST['accion'];
        header('location:./'.$_REQUEST['pagina']);
    }
    echo json_encode($json);
}

//Accion 3 "Confirmar el Pedido con Update:Editar"
if($_REQUEST['accion'] == "4"){
 
    $sql_confirmar = " update descuento_servicio set estado= '" .$_REQUEST['vestado']."' where cod_desc_servi=" . $_REQUEST['codigo'];
    
    $resul_confirmar = consultas::ejecutar_sql($sql_confirmar);
    
  //  update deta_recep set estado='CONFIRMADO' where cod_recep=codrecep and cod_equipo=codequipo;
    $sql_confirmar_deta = " update deta_descuento_servi set estado= 'ACTIVO' where cod_desc_servi=" . $_REQUEST['codigo'];
    $resul_confirmar_deta = consultas::ejecutar_sql($sql_confirmar_deta);
    
    if ($resul_confirmar == FALSE || $resul_confirmar_deta ==FALSE) {
        $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
        header ('location:./'.$_REQUEST['pagina']);
    } else {
        $_SESSION['mensaje'] = "DESCUENTO CONFIRMADO CON EXITO_".$_REQUEST['accion'];
        header('location:./'.$_REQUEST['pagina']);
    }
    echo json_encode($json);
    
}
?>