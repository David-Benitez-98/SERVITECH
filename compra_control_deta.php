<?php
require './clases/conexion.php';
session_start();
if ($_REQUEST['vorden'] && $_REQUEST['vgarantia']=='CON') {
  $arti = !empty($_REQUEST['articulo_oculto']) ? $_REQUEST['articulo_oculto'] : $_REQUEST['varti'];  
  $depo = !empty($_REQUEST['deposito_oculto']) ? $_REQUEST['deposito_oculto'] : $_REQUEST['vdepo'];
  $descri_garan = $_REQUEST['vdescri_garan']; 
  $plazo_garan = $_REQUEST['vplazo_garan']; 
  $condi_garan = $_REQUEST['vcondi_garan']; 
}else if ($_REQUEST['vorden'] && $_REQUEST['vgarantia']=='SIN') {
  $arti = !empty($_REQUEST['articulo_oculto']) ? $_REQUEST['articulo_oculto'] : $_REQUEST['varti'];  
  $depo = !empty($_REQUEST['deposito_oculto']) ? $_REQUEST['deposito_oculto'] : $_REQUEST['vdepo'];
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

//$sub = $_REQUEST['vprecio'] * $_REQUEST['vcant'];
$sql = "SELECT sp_deta_compra(".$_REQUEST['accion'].","
        .$_REQUEST['vcodcomp'].","
        .$arti.","
        .$depo.","
        .$_REQUEST['vprecio']."," //le deje nomas el mismo nombre de los campos de la orden porque solo es un variable
        .$_REQUEST['vcant'].","
        .$_REQUEST['vsubt'].",'"
        .$descri_garan."',"
        .$plazo_garan.",'"
        .$condi_garan."','"
        .$_REQUEST['vestado']."') as deta_compra;";
        
$resultado = consultas::get_datos($sql);

if ($resultado[0]['deta_compra']== null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['deta_compra']."_".
            $_REQUEST['accion'];
   header('location:./'.$_REQUEST['pagina']."?vcodcomp=".
            $_REQUEST['vcodcomp'].'&vorden='.$_REQUEST['vorden'].'&vpedi='.$_REQUEST['vpedi']);
}


?>


