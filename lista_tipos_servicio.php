<?php
session_start();
require './clases/conexion.php';
$tipos_servicios = consultas::get_datos("select * from v_tipo_servicios2 where datos_tipo_servicio like upper ('%". $_REQUEST['q']."%') or cod_tipo_servi::varchar like upper ('%". $_REQUEST['q']."%')");


echo json_encode($tipos_servicios);
?>




