<?php
//reanudamos la sesion 
//validamos si existe realmente una sesion activa ono
session_start();
if($_SESSION['cod_usu'] == NULL){
    $_SESSION['error']='Inicio de Sesion';
    header('location:http//:localhost/bd_servitech_tesis');
    exit();
}

?>
