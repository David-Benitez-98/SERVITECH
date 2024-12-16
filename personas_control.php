<?php

require './clases/conexion.php';

session_start();

//para validar que si la persona es juridica me guarde apellido y estado civil vacio y sexo vacio
if($_REQUEST['vtipoperso'] =='JURIDICA'){
   $_REQUEST['vapellido']=NULL;
   $_REQUEST['vec']= 0;
   $_REQUEST['vsexo']=NULL;
}  

$sql = "SELECT sp_personas(".$_REQUEST['accion'].","
        .$_REQUEST['vper'].",'"
        .trim($_REQUEST['vnombre'])."','"
        .trim($_REQUEST['vapellido'])."','"
        .$_REQUEST['vtipoperso']."','"
        .trim($_REQUEST['vci'])."','"
        .trim($_REQUEST['vtel'])."',"
        .$_REQUEST['vnac'].","
        .$_REQUEST['vec'] .","
        .$_REQUEST['vciu'].","
        .$_REQUEST['vdepar'].",'"
        .trim($_REQUEST['vdirec'])."',"
        .$_REQUEST['vtipodocu'].",'"
        .$_REQUEST['vfecnac']."','"
        .$_REQUEST['vsexo']."') as personas;";
$resultado = consultas::get_datos($sql);


if ($resultado[0]['personas'] == null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header('location:./'.$_REQUEST['pagina']);
} else {
    $_SESSION['mensaje'] = $resultado[0]['personas']."_".$_REQUEST['accion'];

    header('location:./'.$_REQUEST['pagina']);
}
?>

