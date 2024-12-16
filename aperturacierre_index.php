<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SERVITECH SYS - FACTURACION</title>

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
                        <h3 class="page-header">APERTURA Y CIERRE DE CAJA
                            
                            <a href="aperturacierre_agregar.php" 
                               class="btn btn-success btn-circle pull-right" 
                               rel="tooltip" data-title="Registrar" >
                                <i class="fa fa-plus"></i>
                            </a>                       
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
                                Datos
                            </div>
                            <?php
                            $aperturascierres = consultas::get_datos("select * from v_apertura_cierre where ape_estado='ABIERTA'
                                         order by ape_nro asc ");
                            if (!empty($aperturascierres)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Caja</th>
                                                    <th class="text-center">Fecha Apertura</th> 
                                                    <th class="text-center">Funcionario</th>
                                                    <th class="text-center">Estado</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($aperturascierres as $aperturascierre) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $aperturascierre['ape_nro']; ?></td>
                                                        <td class="text-center"><?php echo $aperturascierre['caj_descri']; ?></td>
                                                        <td class="text-center"><?php echo $aperturascierre['fecha_ini']; ?></td>
                                                        <td class="text-center"><?php echo $aperturascierre['per_nom']; ?></td>
                                                        <td class="text-center"><?php echo $aperturascierre['ape_estado']; ?></td>
                                                        <td class="text-center">
                                                            
                                                                
                                                            <a href="aperturacierre_cerrar.php?vcod=<?php echo $aperturascierre['ape_nro'];?>" 
                                                               class="btn btn-xs btn-danger" rel='tooltip' data-title="Cerrar Caja"
                                                               data-toggle="modal">
                                                                <span class="glyphicon glyphicon-remove-sign fa-2x"></span></a>
                                                                                                                       
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>                         
                                    </div>
                                <?php } else { ?>
                                    <div class="alert alert-success alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <strong>No se encontraron cajas abiertas....!</strong>
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
                            <a id="si" role="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Si</a>
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
            function cerrar(datos) {
                var dat = datos.split("_");
                $('#cod').val(dat[0]);
                $('#monto').val(dat[1]);
                $('#caja').val(dat[2]);
                $('#usuario').val(dat[3]);
                $('#estado').val(dat[4]);

            }

//             function cerrar(datos) {
//                var dat = datos.split("_");
//                $('#si').attr('href'
//                , 'aperturacierre_control.php?vcod=' + dat[0] + 
//                        '&vmonto=null' +
//                        '&vcaja=null'+
//                        '&vusu=null'+
//                        '&vestado=CERRADO'+
//                        '&accion=2'+
//                        '&pagina=aperturacierre_index.php');
//                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
//            Estado: <i><strong>' + dat[4] + '</strong></i> del Funcionario: <i><strong>' + dat[3] + '</strong></i>. \n\
//            Desea <i><strong>CERRAR</strong><i> la Caja <i><strong>' + dat[2] + '</strong></i>?');
//            }
        </script>


    </body>
</html>

