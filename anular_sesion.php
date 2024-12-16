<?php

require_once './clases/conexion.php';
//Reanudamos la sesión

//Validamos si existe realmente una sesion activa o no

//if ($_SESSION['cod_usu']==NULL || ['cod_gru'] ==NULL )  {
//    $_SESSION['error1']='No puede acceder a esta pagina!';
//    header('location:http://localhost/servitech_tesis/error404.php');
//    exit();
//}
//in_array($_SESSION['cod_gru'])

#session_start();
$URL = $_SERVER['REQUEST_URI'];
$pagina = explode("/", $URL);
$result = consultas::get_datos("select * from v_permisos where pag_direc='".$pagina[2]."' and cod_gru=".$_SESSION['cod_gru']. "
                             and cod_usu=".$_SESSION['cod_usu']);

#print_r($pagina[2]);
if (empty($result))  { 
    $_SESSION['error1']='No puede acceder a esta pagina!';
    header('location:http://localhost/servitech_tesis/error404.php');
    exit();
}

//header('location:http://localhost/servitech_tesis');
?>