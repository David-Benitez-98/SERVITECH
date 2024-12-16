<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SERVITECH SYS</title>

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
                        <h3 class="page-header">Listado de Articulos en STOCK
                            <a href="imprimir_stock.php" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Imprimir" target="_blank">
                                <i class="fa fa-print"></i>
                            </a>
                            <a href="stock_agregar.php" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Registrar">
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
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Datos
                            </div>
                            <?php
                            $stocks = consultas::get_datos("select * from v_stock
                                         order by cod_dep asc ");
                            if (!empty($stocks)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Cod. Deposito</th>
                                                    <th class="text-center">Sucursal</th>
                                                    <th class="text-center">Deposito</th>
                                                    <th class="text-center">Cod. Articulo</th>
                                                    <th class="text-center">Articulo</th>
                                                    <th class="text-center">IMAGEN</th>
                                                    <th class="text-center">Cantidad</th>
<!--                                                    <th class="text-center">Acciones</th>-->
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($stocks as $stock) { ?> 
                                                    <tr>
                                                        <td><?php echo $stock['cod_dep']; ?></td>
                                                        <td class="text-center"><?php echo  $stock['suc_descri']; ?></td>
                                                        <td class="text-center"><?php echo  $stock['dep_descri']; ?></td>
                                                        <td class="text-center"><?php echo  $stock['cod_art']; ?></td>
                                                        <td class="text-center"><?php echo  $stock['art_descri']; ?></td>
                                                        <td class="text-center"> 
                                                    <img height="45px" src="img/<?php echo $stock['art_imagen'];?>" /> </td>
                                                        <td class="text-center"><?php echo  $stock['cantidad']; ?></td>
<!--                                                            <td class="text-center">
                                                            
                                                            <a onclick="borrar(<?php echo "'". $stock['cod_dep']."_".
                                                                    $stock['cod_art']."_".
                                                                    $stock['art_descri']."_".
                                                                    $stock['dep_descri']."'"; ?>)" 
                                                               class="btn btn-xs btn-primary" rel='tooltip' data-title="Borrar"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-trash"></span></a>
                                                        </td>-->
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>                         
                                    </div>
                                <?php } else { ?>
                                    <div class="alert alert-info alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <strong>No se encontraron registro....!</strong>
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

            function borrar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href'
                , 'stock_control.php?vdep=' + dat[0] + 
                        '&vart=' + dat[1] +
                        '&vcant=null'+
                        '&accion=2'+
                        '&pagina=stock_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Borrar el Articulo <i><strong>' + dat[2] +' del Deposito </strong></i>\n\
            <i><strong>' + dat[3] + '</strong></i> existente en Stock?');
            }
        </script>


    </body>
</html>



