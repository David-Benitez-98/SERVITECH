<?php

require './clases/conexion.php';

session_start();

$sql = "SELECT sp_usuarios(".$_REQUEST['accion'].","
        .$_REQUEST['vcodusu'].","
        .$_REQUEST['vcodfun'].","
        .$_REQUEST['vcodgru'].",'"
        .$_REQUEST['vnickusu']."','"
        .$_REQUEST['vclaveusu']."','"
        .$_REQUEST['vestado']."',"
        .$_REQUEST['vsuc'].",'"
        .$_REQUEST['vperfil']."','"
        .$_REQUEST['vcla']."') as usuarios;";
$resultado = consultas::get_datos($sql);


if ($resultado[0]['usuarios'] == null) {
    $_SESSION['mensaje'] = 'Error de Proceso '+$sql;
    header('location:./'.$_REQUEST['pagina']);
} else {
    $_SESSION['mensaje'] = $resultado[0]['usuarios']."_".$_REQUEST['accion'];

    header('location:./'.$_REQUEST['pagina']);
}
?>



