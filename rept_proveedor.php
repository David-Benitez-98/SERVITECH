<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>SERVITECH-COMPRAS</title>
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
                        <h3 class="page-header">Informe de Proveedores</h3>
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
                                                    <a  href="#" onclick="obtener_ciudad()" 
                                                        class="list-group-item">Por Ciudad</a>
                                                    <a href="#" onclick="obtener_departamento()" 
                                                       class="list-group-item">Por Departamento</a>
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
            function obtener_ciudad() {
                $.ajax({
                    type: "POST",
                    url: "/servitech_tesis/inf_prov_ciu.php/",
                    cache: false,
                    beforeSend: function () {
                        $('#cargando').html('<img src="/servitech_tesis/img/ajax-loader.gif">  <strong><i>Cargando...</i></strong>');
                    },
                    success: function (msg) {
                        $('#cargando').html(msg);
                    }
                });
            }   
             function obtener_departamento() {
                $.ajax({
                    type: "POST",
                    url: "/servitech_tesis/inf_prov_dep.php/",
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



