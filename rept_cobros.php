<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>SERVITECH-COBROS</title>
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="shortcut icon" href="favicon_16.ico"/>
        <link rel="bookmark" href="favicon_16.ico"/>

        <?php
        require './ver_sesion.php';
        require 'menu/css.ctp';
        ?>
    </head>

    <body>
      <div id="wrapper">
            <?php require 'menu/navbar.php'; ?><!--BARRA DE HERRAMIENTAS-->
            <div id="page-wrapper">
                <div class="row">
                    <!--impresion del titulo de la pagina-->
                    <div class="col-lg-12">
                        <h3 class="page-header">Listado de Reportes de Cobros</h3>
                    </div>     
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-10">                                             
                                <div class="box box-primary">                                                          
                                    <div class="box-body no-padding">                                   
                                        <div class="row">                                        
                                            <div class="col-md-4 col-md-offset-0">
                                                <div class="list-group">
                                                    <a href="#" class="list-group-item active">
                                                        Reportes
                                                    </a>
                                                    <a  href="#" onclick="obtener_fecha()" class="list-group-item">Por Rango de Fecha</a>
                                                    <a href="#" onclick="obtener_usuario()" class="list-group-item">Por Usuario</a>
                                                    <a href="#" onclick="obtener_estado()" class="list-group-item">Por Estado</a>
                                                    <a href="#" onclick="obtener_tarjeta()" class="list-group-item">Por Tarjeta</a>
                                                    <a href="#" onclick="obtener_cheque()" class="list-group-item">Por Cheque</a>
<!--                                                    <a href="#" class="list-group-item">Cursos</a>                                                                          -->
                                                </div>                                                
                                            </div>
                                            <div id="cargando"></div>
                                        </div>
                                    </div>
                                </div>                      
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>

        <?php require 'menu/js.ctp'; ?>
        <script>
            function obtener_fecha() {
                $.ajax({
                    type: "POST",
                    url: "/servitech_tesis/inf_cobros_fecha.php/",
                    cache: false,
                    beforeSend: function () {
                        $('#cargando').html('<img src="/servitech_tesis/img/ajax-loader.gif">  <strong><i>Cargando...</i></strong>');
                    },
                    success: function (msg) {
                        $('#cargando').html(msg);
                    }
                });
            }  
             function obtener_usuario() {
                $.ajax({
                    type: "POST",
                    url: "/servitech_tesis/inf_cobros_usuario.php/",
                    cache: false,
                    beforeSend: function () {
                        $('#cargando').html('<img src="/servitech_tesis/img/ajax-loader.gif">  <strong><i>Cargando...</i></strong>');
                    },
                    success: function (msg) {
                        $('#cargando').html(msg);
                    }
                });
            }
             function obtener_estado() {
                $.ajax({
                    type: "POST",
                    url: "/servitech_tesis/inf_cobros_estado.php/",
                    cache: false,
                    beforeSend: function () {
                        $('#cargando').html('<img src="/servitech_tesis/img/ajax-loader.gif">  <strong><i>Cargando...</i></strong>');
                    },
                    success: function (msg) {
                        $('#cargando').html(msg);
                    }
                });
            }
             function obtener_tarjeta() {
                $.ajax({
                    type: "POST",
                    url: "/servitech_tesis/inf_cobros_tarjetas.php/",
                    cache: false,
                    beforeSend: function () {
                        $('#cargando').html('<img src="/servitech_tesis/img/ajax-loader.gif">  <strong><i>Cargando...</i></strong>');
                    },
                    success: function (msg) {
                        $('#cargando').html(msg);
                    }
                });
            }
            function obtener_cheque() {
                $.ajax({
                    type: "POST",
                    url: "/servitech_tesis/inf_cobros_cheque.php/",
                    cache: false,
                    beforeSend: function () {
                        $('#cargando').html('<img src="/servitech_tesis/img/ajax-loader.gif">  <strong><i>Cargando...</i></strong>');
                    },
                    success: function (msg) {
                        $('#cargando').html(msg);
                    }
                });
            }
           
            
             </script>
    </body>
</html>


