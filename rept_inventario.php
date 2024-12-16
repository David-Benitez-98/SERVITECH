<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>SERVITECH</title>
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
                        <h3 class="page-header">Inventario de Deposito</h3>
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
                                                    <a  href="#" onclick="obtener_sucursal()" 
                                                        class="list-group-item">Por Sucursal</a>
                                                    <a href="#" onclick="obtener_descripcion()" 
                                                       class="list-group-item">Por Deposito</a>
                                                       <a href="#" onclick="obtener_articulo()" 
                                                       class="list-group-item">Por Articulo</a>
                                                       <a href="#" onclick="obtener_tipoarticulo()" 
                                                       class="list-group-item">Por Tipo Articulo</a>
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
            function obtener_sucursal() {
                $.ajax({
                    type: "POST",
                    url: "/servitech_tesis/inf_depo_sucur.php/",
                    cache: false,
                    beforeSend: function () {
                        $('#cargando').html('<img src="/servitech_tesis/img/ajax-loader.gif">  <strong><i>Cargando...</i></strong>');
                    },
                    success: function (msg) {
                        $('#cargando').html(msg);
                    }
                });
            }   
             function obtener_descripcion() {
                $.ajax({
                    type: "POST",
                    url: "/servitech_tesis/inf_depo_descri.php/",
                    cache: false,
                    beforeSend: function () {
                        $('#cargando').html('<img src="/servitech_tesis/img/ajax-loader.gif">  <strong><i>Cargando...</i></strong>');
                    },
                    success: function (msg) {
                        $('#cargando').html(msg);
                    }
                });
            }
            
            function obtener_articulo() {
                $.ajax({
                    type: "POST",
                    url: "/servitech_tesis/inf_depo_arti.php/",
                    cache: false,
                    beforeSend: function () {
                        $('#cargando').html('<img src="/servitech_tesis/img/ajax-loader.gif">  <strong><i>Cargando...</i></strong>');
                    },
                    success: function (msg) {
                        $('#cargando').html(msg);
                    }
                });
            }
            function obtener_tipoarticulo() {
                $.ajax({
                    type: "POST",
                    url: "/servitech_tesis/inf_depo_tipoarti.php/",
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





