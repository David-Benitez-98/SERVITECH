<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SYSMAD - LIBRO IVA VENTA</title>

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
                        <h2 class="page-header text-center">LISTADO DEL LIBRO IVA VENTA
                                                 
                        </h2>
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
                            $libros_compras = consultas::get_datos("select * from libro_iva_venta 
                                         order by cod_libro_iva_vent asc ");
                            if (!empty($libros_compras)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#Libro</th>                                        
                                                    <th class="text-center">#Factura</th>
                                                    <th class="text-center">Fecha</th>
                                                    <th class="text-center">N° Factura</th>
                                                    <th class="text-center">Total IVA5%</th>
                                                    <th class="text-center">Total Grav5%</th>
                                                    <th class="text-center">Total IVA10%</th>
                                                    <th class="text-center">Total Grav10%</th>
                                                    <th class="text-center">Total FACTURA</th>
                                                    <th class="text-center">Estado</th>
<!--                                                    <th class="text-center">Acciones</th>-->
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($libros_compras as $libro_compra) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $libro_compra['cod_libro_iva_vent']; ?></td>
                                                        <td class="text-center"><?php echo $libro_compra['cod_factura']; ?></td>
                                                        <td class="text-center"><?php echo $libro_compra['fecha']; ?></td>
                                                        <td class="text-center"><?php echo $libro_compra['num_factura']; ?></td>
                                                        <td class="text-center"><?php echo number_format($libro_compra['iva_5'], 0, ',', '.'); ?></td>
                                                        <td class="text-center"><?php echo number_format($libro_compra['grabada_5'], 0, ',', '.'); ?></td>
                                                        <td class="text-center"><?php echo number_format($libro_compra['iva_10'], 0, ',', '.'); ?></td>
                                                        <td class="text-center"><?php echo number_format($libro_compra['gravada_10'], 0, ',', '.'); ?></td>
                                                        <td class="text-center"><?php echo number_format($libro_compra['total_factu'], 0, ',', '.'); ?></td>
                                                        <td class="text-center"><?php echo $libro_compra['estado']; ?></td>
<!--                                                        <td class="text-center">
                                                            
                                                        <a   href="imprimir_libro_iva_comp.php"
                                                             class="btn btn-xs btn-success" rel='tooltip' data-title="Imprimir Libro Iva" target="_blank">
                                                             <span class="glyphicon glyphicon-print"></span></a>
                                                                
                                                            <a href="#" class="btn btn-xs btn-primary" rel="tooltip" data-title="Imprimir"
                                                               <span class="glyphicon glyphicon-print"></span></a>
                                                        </td>-->
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

            function pagar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href'
                , 'ctaspagar_control.php?vcodctapag=' + dat[0] + 
                        '&vcomcod=null' +
                        '&vvto=1900-01-01'+
                        '&vimporte=null'+
                        '&vcuo_nro=null'+
                        '&vestado=PAGADO'+
                        '&accion=1'+
                        '&pagina=ctaspagar_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Pagar la Cuenta <i><strong>' + dat[0] + '</strong></i> Pendiente de la Compra Nro: <i><strong>' + dat[1] + '</strong></i>?');
            }
        </script>


    </body>
</html>
