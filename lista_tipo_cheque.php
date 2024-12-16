<?php
session_start();
require './clases/conexion.php';
$tiposcheques = consultas::get_datos("select * from tipo_cheque where descri like upper ('%". $_REQUEST['q']."%') or cod_tipo_cheque::varchar like upper ('%". $_REQUEST['q']."%')");


echo json_encode($tiposcheques);
?>



