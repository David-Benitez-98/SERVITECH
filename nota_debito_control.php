<?php
require './clases/conexion.php';
session_start();
$cod = "select coalesce(max(id_nota_debito),0)+1 as vdetdebi from nota_debito_compra ";
$res = consultas::get_datos($cod);
$inte = ($_REQUEST['vinter'])? $_REQUEST['vinter'] : 0 ;
$tras = ($_REQUEST['vtras'])? $_REQUEST['vtras'] : 0 ;
$sql = "SELECT sp_notadebitocompra(".$_REQUEST['accion'].","
        .$_REQUEST['vdebi'].",".
        $_REQUEST['vusu'].",".
        $_REQUEST['vsuc'].",".
        $_REQUEST['vcompr'].",".
        $_REQUEST['vprov'].",'".
        $_REQUEST['vfecha']."','".
        $_REQUEST['vmotiv']."','".
        $_REQUEST['vdescrip']."',".
        $inte.",".
        $tras.",'".
        $_REQUEST['vestado']."',".
        $_REQUEST['vtotal'].",".
        $_REQUEST['vtimb'].",'".
        $_REQUEST['vvigen']."',".
        $_REQUEST['vtip'].",'".
        $_REQUEST['vnro_nota']."') as debito;";
        
        

$resultado = consultas::get_datos($sql);

if ($resultado[0]['debito']== null) {
    $_SESSION['mensaje'] = 'Error de prceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['debito']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina'].'?vdetdebi='.$res[0]['vdetdebi'].'&vcompr='.$_REQUEST['vcompr']);
            
}
?>
        

