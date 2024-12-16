<?php
session_start();
require './clases/conexion.php';
$articulos = consultas::get_datos("select * from v_articulos_2 where datos_articulos like upper ('%". $_REQUEST['q']."%') or cod_art::varchar like upper ('%". $_REQUEST['q']."%')");


echo json_encode($articulos);
?>


