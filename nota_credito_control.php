<?php
require './clases/conexion.php';
session_start();
$cod = "select coalesce(max(id_nota_credito),0)+1 as vdetcred from nota_credito_compra ";
$res = consultas::get_datos($cod);
$desc = ($_REQUEST['vdesc'])? $_REQUEST['vdesc'] : 0 ;

$sql = "SELECT sp_notacredcompra(".$_REQUEST['accion'].","
        .$_REQUEST['vcred'].",".
        $_REQUEST['vusu'].",".
        $_REQUEST['vsuc'].",".
        $_REQUEST['vcompr'].",".
        $_REQUEST['vprov'].",'".
        $_REQUEST['vfecha']."','".
        $_REQUEST['vmotiv']."','".
        $_REQUEST['vdescrip']."',".
        $desc.",'".
        $_REQUEST['vestado']."',".
        $_REQUEST['vtotal'].",".
        $_REQUEST['vtimb'].",'".
        $_REQUEST['vvigen']."',".
        $_REQUEST['vtip'].",'".
        $_REQUEST['vnro_nota']."') as credito;";
        
        

$resultado = consultas::get_datos($sql);

//if ($_REQUEST['accion'] == 1){
//$sql_esta_comp = "update compras set compra_estado='CONFRIMADO/NOTA' where id_compra = ".$_REQUEST['vcompr'];
//$reul_estado = consultas::ejecutar_sql($sql_esta_comp);
//    
//}

if ($resultado[0]['credito']== null) {
    $_SESSION['mensaje'] = 'Error de prceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['credito']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina'].'?vdetcred='.$res[0]['vdetcred'].'&vcompr='.$_REQUEST['vcompr']);
            
}
?>
        

