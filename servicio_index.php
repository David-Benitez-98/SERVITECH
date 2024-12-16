<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon"  href=" img/logo_negro.ico"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SERVITECH S.A SERVICIOS</title>

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
                        <h3 class="page-header text-center">LISTADO DE SERVICIOS
                                                 
                        </h3>
                    </div>     
                    <!--Buscador-->
                    <div class="col-lg-12">
                        <div class="panel-heading">
                            <div class="input-group custom-search-form">
                                <input id="filtrar" type="text" class="form-control" placeholder="Buscar...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" rel="tooltip" title="Buscar">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>                      
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                Datos de Servicios
                            </div>
                            <?php
                            $servicios = consultas::get_datos("select * from v_servicio "
                                         . " where cod_suc=".$_SESSION['cod_suc']. " order by cod_servicio asc ");
                            if (!empty($servicios)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>                                        
                                                    <th class="text-center">#ORDEN</th>
                                                    <th class="text-center">#PRESU</th>
                                                    <th class="text-center">FECHA</th>
                                                    <th class="text-center">SUCURSAL</th>
                                                    <th class="text-center">CLIENTE</th>
                                                    <th class="text-center">ESTADO</th>
                                                    <th class="text-center">ACCION</th>
                                                   
<!--                                                    <th class="text-center">Acciones</th>-->
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($servicios as $servicio) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $servicio['cod_servicio']; ?></td>
                                                        <td class="text-center"><?php echo $servicio['cod_orden_trabajo']; ?></td>
                                                        <td class="text-center"><?php echo $servicio['cod_presu_servi']; ?></td>
                                                        <td class="text-center"><?php echo $servicio['fecha']; ?></td>
                                                        <td class="text-center"><?php echo $servicio['suc_descri']; ?></td>
                                                        <td class="text-center"><?php echo $servicio['datos_ciente']; ?></td>
                                                        <td class="text-center"><?php echo $servicio['estado']; ?></td>
                                                         <td class="text-center">
                                                             
                                                              <a  
                                                                href="servicio_detalle.php?vservi=<?php echo $servicio['cod_servicio']; ?><?= "&vorden_trab=" . $servicio['cod_orden_trabajo'] ?><?= "&vpresu_servi=" . $servicio['cod_presu_servi'] ?>"
                                                                class="btn btn-xs btn-info" rel='tooltip' data-title="Detalles" >
                                                                <span class="fa fa-th-list"></span></a> 
                                                          
                                                           
                                                       </td>
                                                    </tr>
                                             
                                                <?php } ?>
                                            </tbody>
                                        </table>                         
                                    </div><!--
                                <?php } else { ?>
                                    <div class="alert alert-info alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <strong>No se encontraron registros....!</strong>
                                    </div>
                                <?php } ?>  
                                <!-- /.panel-body -->
                            </div>
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
            <!--borrar-->
            <div class="modal fade" id="delete" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title custom_align" id="Heading">Atenci&oacute;n!!!</h4>
                        </div>
                        <div class="modal-body">

                            <div class="alert alert-warning" id="confirmacion"></div>

                        </div>
                        <div class="modal-footer">
                            <a id="si" role="button" class="btn btn-primary" ><span class="glyphicon glyphicon-ok-sign"></span> Si</a>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                        </div>
                    </div>
                </div>
            </div> 
            <!--fin-->
        </div> 
        <!--archivos js-->  
        <?php require 'menu/js.ctp'; ?>


        <script>
            function editar(datos) {
                var dat = datos.split("_");
                $('#cod').val(dat[0]);
                $('#descri').val(dat[1]);

            }

            function cancelar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href'
                , 'ctaspagar_control.php?vcodctapag=' + dat[0] + 
                        '&vcomcod=null' +
                        '&vvto=1900-01-01'+
                        '&vimporte=null'+
                        '&vcuo_nro=null'+
                        '&vestado=CANCELADO'+
                        '&accion=1'+
                        '&pagina=ctascobrar_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Cancelar la Cuenta <i><strong>' + dat[0] + '</strong></i> Pendiente a Pagar de la Compra Nro: <i><strong>' + dat[1] + '</strong></i>?');
            }
        </script>


    </body>
</html>