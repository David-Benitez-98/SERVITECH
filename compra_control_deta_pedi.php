<!--Desde aqui el nuevo controlador-->
<?php
require './clases/conexion.php';
session_start();
if ($_REQUEST['vpedi'] && $_REQUEST['vgarantia']=='CON') {
  $arti = !empty($_REQUEST['articuloinvisible']) ? $_REQUEST['articuloinvisible'] : $_REQUEST['varti'];  
  $depo = !empty($_REQUEST['depositoinvisible']) ? $_REQUEST['depositoinvisible'] : $_REQUEST['vdepo'];
  $descri_garan = $_REQUEST['vdescri_garan']; 
  $plazo_garan = $_REQUEST['vplazo_garan']; 
  $condi_garan = $_REQUEST['vcondi_garan']; 
}else if ($_REQUEST['vpedi'] && $_REQUEST['vgarantia']=='SIN') {
  $arti = !empty($_REQUEST['articuloinvisible']) ? $_REQUEST['articuloinvisible'] : $_REQUEST['varti'];  
  $depo = !empty($_REQUEST['depositoinvisible']) ? $_REQUEST['depositoinvisible'] : $_REQUEST['vdepo'];
  $descri_garan = empty($_REQUEST['vdescri_garan']) ? $_REQUEST['vdescri_garan'] : '';
  $plazo_garan = empty($_REQUEST['vplazo_garan']) ? $_REQUEST['vplazo_garan'] : 0;
  $condi_garan = empty($_REQUEST['vcondi_garan']) ? $_REQUEST['vcondi_garan'] : '';
}  else {
    $arti = $_REQUEST['varti']; 
    $depo = $_REQUEST['vdepo']; 
    $descri_garan = $_REQUEST['vdescri_garan']; 
    $plazo_garan = $_REQUEST['vplazo_garan']; 
    $condi_garan = $_REQUEST['vcondi_garan']; 
}
if($_REQUEST['accion'] == 1){

      $sql_deta= "insert into det_comp values("
        .$_REQUEST['vcodcomp'].","
        .$arti.","
        .$depo.","
        .$_REQUEST['vprecio']."," //le deje nomas el mismo nombre de los campos de la orden porque solo es un variable
        .$_REQUEST['vcant'].","
        .$_REQUEST['vsubt'].",'"
        .$descri_garan."',"
        .$plazo_garan.",'"
        .$condi_garan."','"
        .$_REQUEST['vestado']."')";
        $resultado_deta = consultas::ejecutar_sql($sql_deta);

    $sql_esta_pedi = " update deta_pedido_comp set estado='CONFIRMADO' where cod_pedi_comp = " .$_REQUEST['vpedi']. " and cod_art = " .$arti;
    $resul_esta = consultas::ejecutar_sql($sql_esta_pedi);
    
    //if insercion
if ($resultado_deta == FALSE) {
    $json['mensaje'] = "Ocurrio un error";
    $json['success'] = FALSE;
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
   header('location:./'.$_REQUEST['pagina']);
} else {
    $_SESSION['mensaje'] = "GUARDADO EXITOSAMENTE_".$_REQUEST['accion']; 
    header('location:./'.$_REQUEST['pagina']."?vcodcomp=".
    $_REQUEST['vcodcomp'].'&vorden='.$_REQUEST['vorden'].'&vpedi='.$_REQUEST['vpedi']);
}
echo json_encode($json);
}

        
//BORRAR DETALLE DE ORDEN COMPRA QUE SE GUARDO CON LOS DATOS DEL PEDIDO Y MODIFICAR EL ESTADO DEL DETA PEDIDO A PENDIENTE
if($_REQUEST['accion'] == 2){
    
    $sql_delete = " delete from det_comp where cod_comp = " .$_REQUEST['vcodcomp']. " and cod_art = " .$arti;
    $resultado = consultas::get_datos($sql_delete);

    if ($resultado == null) {
        $_SESSION['mensaje'] = "BORRADO CON EXITO_".$_REQUEST['accion'];
         header('location:./'.$_REQUEST['pagina']."?vcodcomp=".
            $_REQUEST['vcodcomp'].'&vorden='.$_REQUEST['vorden'].'&vpedi='.$_REQUEST['vpedi']);
    } 
    
    //CAMBIAR ESTADO DEL DETA PEDIDO A PENDIENTE
    $sql_esta_pedido = " update deta_pedido_comp set estado='PENDIENTE' where cod_pedi_comp = " .$_REQUEST['vpedi']. " and cod_art = " .$_REQUEST['varti'];
    $resul_estado = consultas::ejecutar_sql($sql_esta_pedido);
    
    echo json_encode($json);
}

?>




