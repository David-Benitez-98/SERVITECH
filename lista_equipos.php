<?php
session_start();
require './clases/conexion.php';
$equipos = consultas::get_datos("select * from v_equipos where datos_equipos like upper ('%". $_REQUEST['q']."%') or cod_equipo::varchar like upper ('%". $_REQUEST['q']."%')");


echo json_encode($equipos);
?>




