!--Desde aqui el nuevo controlador-->
<?php
require './clases/conexion.php';
session_start();

if($_REQUEST['accion'] == "1"){ //Accion 1 "Insertar Pedido Cabecera"
    $cod = "select coalesce(max(cod_promocion),0)+ 1 as codigo from promocion";
    $res = consultas::get_datos($cod);
    
 $consulta_repe_descri = "select * from promocion where descri_promo = upper ('" .$_REQUEST['vdescri']. "') and estado = '" .$_REQUEST['vestado'].
         "' OR descri_promo = upper ('" .$_REQUEST['vdescri']. "') and estado = 'ACTIVO'";
 $resul_consulta_repe_descri = consultas::get_datos($consulta_repe_descri);
 if($resul_consulta_repe_descri == NULL) {
    $sql = "insert into promocion values(".$res[0]['codigo'].",'"
        .$_REQUEST['vfecha_ini']."','"
        .$_REQUEST['vfecha_fin']."',"
        .$_REQUEST['vcod_usu'].","
        .$_REQUEST['vsucursal'].",upper('"
        .$_REQUEST['vdescri']."'),'"
        .$_REQUEST['vestado']."')";
   // $resultado = consultas::ejecutar_sql($sql);
}
    
//hasta aqui cabecera
  
//Insertar Detalle
    foreach ($_REQUEST['detalles'] as $key => $detPromoServi){
     //ESTE ES PARA QUE EL CAMPO OBSERVACION NO SE GUARDEN CON ESPACIOS   
 $consulta_repe_tipo = "select * from tipo_servicio where "
         . "cod_tipo_servi IN (select cod_tipo_servi from deta_promo where cod_tipo_servi=" .$detPromoServi['cod_tipo_servi']. " and estado = '" .$detPromoServi['estado_detalle']. 
         "' OR cod_tipo_servi=" .$detPromoServi['cod_tipo_servi']. " and estado = 'ACTIVO' ) "
         . "OR cod_tipo_servi IN (select cod_tipo_servi from deta_descuento_servi where cod_tipo_servi= " .$detPromoServi['cod_tipo_servi']. " and estado = '" .$detPromoServi['estado_detalle']. "' OR cod_tipo_servi=" .$detPromoServi['cod_tipo_servi']. " and estado = 'ACTIVO')";
 $resul_consulta_repe_tipo = consultas::get_datos($consulta_repe_tipo);
 
 if($resul_consulta_repe_tipo == NULL) {
      $sql_deta= "insert into deta_promo values(".$res[0]['codigo'].","
        .$detPromoServi['cod_tipo_servi'].", upper('"
        .trim($detPromoServi['estado_detalle'])."'),"
        .$detPromoServi['valor_porcentual_detalle'].")";
    $resultado = consultas::ejecutar_sql($sql);
    $resultado_deta = consultas::ejecutar_sql($sql_deta);
       #$resuldet = consultas::ejecutar_sql($det);
 }
  
 }
//hasta aqui detalle pedido


if ($resul_consulta_repe_tipo != NULL || $resul_consulta_repe_descri != NULL || $resultado == FALSE || $resultado_deta == FALSE ) {
  //  $json['mensaje'] = "Tipo de Servicio ya esta activo en una promocion o ya existe una descripcion de promocion igual";
   $json['mensaje'] = "Ocurrio un error";
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
 
    $sql_anular = " update promocion set estado= '" .$_REQUEST['vestado']."' where cod_promocion=" . $_REQUEST['codigo'];
    $resul_anular = consultas::ejecutar_sql($sql_anular);
    
    if ($resul_anular == FALSE) {
        $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
        header ('location:./'.$_REQUEST['pagina']);
    } else {
        $_SESSION['mensaje'] = "PROMOCION ANULADO CON EXITO_".$_REQUEST['accion'];
        header('location:./'.$_REQUEST['pagina']);
    }
    echo json_encode($json);
}

//Accion 3 "Confirmar el Pedido con Update:Editar"
if($_REQUEST['accion'] == "4"){
 
    $sql_confirmar = " update promocion set estado= '" .$_REQUEST['vestado']."' where cod_promocion=" . $_REQUEST['codigo'];
    
    $resul_confirmar = consultas::ejecutar_sql($sql_confirmar);
    
  //  update deta_recep set estado='CONFIRMADO' where cod_recep=codrecep and cod_equipo=codequipo;
    $sql_confirmar_deta = " update deta_promo set estado= 'ACTIVO' where cod_promocion=" . $_REQUEST['codigo'];
    $resul_confirmar_deta = consultas::ejecutar_sql($sql_confirmar_deta);
    
    if ($resul_confirmar == FALSE || $resul_confirmar_deta ==FALSE) {
        $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
        header ('location:./'.$_REQUEST['pagina']);
    } else {
        $_SESSION['mensaje'] = "PROMOCION CONFIRMADO CON EXITO_".$_REQUEST['accion'];
        header('location:./'.$_REQUEST['pagina']);
    }
    echo json_encode($json);
    
}
?>