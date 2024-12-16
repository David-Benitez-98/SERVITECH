<?php
require 'clases/conexion.php'; //llamar a la conexion
$sql= "select * from v_usuarios where usu_nick='".
        $_REQUEST['per_nom_razon']. "' "
      . " and usu_clav = md5 ('". $_REQUEST ['pass']."')";
//realiza el recorrido de la consulta
$resultado = consultas::get_datos($sql);
//reanudar una sesion o pregunta si existe una sesion activa 
session_start();
//compara el resultado de la consulta 

//verifica si la consulta esta o no vacia
if ($resultado[0]['cod_usu'] == NULL) {
    //si esta vacia imprime el error y es asignada una variable 
    //$_Session ['error']
    $_SESSION['error'] = 'Usuario o contraseña incorrectos';
    header('location:index.php');
}else{
    //recupera las variables en variables de sesion al momento de ingresar
    $_SESSION['cod_usu'] = $resultado[0]['cod_usu'];
    $_SESSION['cod_fun'] = $resultado[0]['cod_fun'];
    $_SESSION['nombres'] = $resultado[0]['per_nom_razon'];
    $_SESSION['cod_gru'] = $resultado[0]['cod_gru'];
    $_SESSION['usu_nick'] = $resultado[0]['usu_nick'];
    $_SESSION['usu_estado'] = $resultado[0]['usu_estado'];
    $_SESSION['gru_nom'] = $resultado[0]['gru_nom'];
    $_SESSION['cod_suc'] = $resultado[0]['cod_suc'];
    $_SESSION['suc_descri'] = $resultado[0]['suc_descri'];
    header('location:menu.php');//direccionar al menu principal
}


