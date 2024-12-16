<?php
session_start();
require './clases/conexion.php';
$entidades = consultas::get_datos("select * from entidad_emisoras where ent_descripcion like upper ('%". $_REQUEST['q']."%') or id_entidad::varchar like upper ('%". $_REQUEST['q']."%')");


echo json_encode($entidades);
?>

