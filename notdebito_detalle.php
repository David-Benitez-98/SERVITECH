<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon"  href=" img/logo_negro.ico"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>DETALLE NOTA DEBITO</title>

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
                        <h3 class="page-header text-center">DATOS DE LA NOTA DEBITO CABECERA
                            <a href="nota_debito.php" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel='tooltip' title="Atras">
                                <i class="glyphicon glyphicon-arrow-left"></i>
                            </a> 

                        </h3>
                    </div>     
                    <!--Buscador-->

                </div>
                
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                Datos Cabecera
                            </div>
                           <?php if (isset($_REQUEST['vdetdebi'])) { ?>
                            <?php
                            $debitos = consultas::get_datos("select * from v_notadebito_compra where id_nota_debito=" .
                                            $_REQUEST ['vdetdebi']);
                            ?>         
                            <?php } ?>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table width="100%"
                                           class="table table-bordered">
                                        <thead>
                                            <tr class="primary-font">
                                                <th class="text-center">#</th>
                                                <th class="text-center"># FACTURA</th>                                        
                                                <th class="text-center"># NOTA</th>                                        
                                                <th class="text-center">FECHA</th>                                        
                                                <th class="text-center">TIMBRADO</th>                                        
                                                <th class="text-center">MOTIVO</th>                                        
                                                <th class="text-center">INTERES</th>                                        
                                                <th class="text-center">AUMENTO</th>                                        
                                                <th class="text-center">TOTAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($debitos as $debito) { ?> 
                                                <tr>
                                                    <td class="text-center"><?php echo $debito['id_nota_debito']; ?></td>
                                                    <td class="text-center"><?php echo $debito['cod_comp'] . " - " . $debito['nro_factura']; ?></td>
                                                    <td class="text-center"><?php echo $debito['nro_nota_debito']; ?></td>
                                                    <td class="text-center"><?php echo $debito['vfecha']; ?></td>
                                                    <td class="text-center"><?php echo $debito['nro_timbrado']; ?></td>
                                                    <td class="text-center"><?php echo $debito['debi_motivo']; ?></td>
                                                    <td class="text-center"><?php echo $debito['debi_interes']; ?></td>
                                                    <td class="text-center"><?php echo number_format($debito['debi_aumento'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($debito['debi_total'], 0, ',', '.'); ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>                         
                                </div>
                            </div>
                        </div>

                        <!-- comienzo para el detalle de COMPRA-->
<!--
                       <?php if (isset($_REQUEST['vcompr'])) { ?>
                        <?php $detacompras = consultas::get_datos("select * from v_detcompras where (det_estado='ACTIVO' OR det_estado='CONFIRMADO') and cod_comp= " . $_REQUEST ['vcompr']); ?>

                    <?php } ?> 


                    <div class="panel-body">

                            <?php if (!empty($detacompras)) {
                                ?>   
-->                                <div class="panel-heading alert-success">
                                    
                                        DETALLE DE LA COMPRA 
                                    </div>

                                    <div class="table-responsive">
                                        
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center"> ARTICULO</th>
                                                    <th class="text-center"> DEPOSITO</th>
                                                    <th class="text-center"> CANTIDAD</th>
                                                    <th class="text-center"> PRECIO</th>
                                                    <th class="text-center"> SUBTOTAL</th>
                                                    <th class="text-center"> ESTADO</th>

                                            </tr>
                                        </thead>
                                        <tbody class="buscar">
                                            <?php foreach ($detacompras as $detacompra) { ?> 
                                                <tr>
                                                        <td class="text-center"><?php echo $detacompra['cod_comp']; ?></td>
                                                        <td class="text-center"><?php echo $detacompra['dato_articulo']; ?></td>
                                                        <td class="text-center"><?php echo $detacompra['dep_descri']; ?></td>
                                                        <td class="text-center"><?php echo number_format($detacompra['det_cantidad'], 0, ',', '.'); ?></td>
                                                        <td class="text-center"><?php echo number_format($detacompra['det_prec_comp'], 0, ',', '.'); ?></td>
                                                        <td class="text-center"><?php echo number_format($detacompra['subtotal'], 0, ',', '.'); ?></td>
                                                        <td class="text-center"><?php echo $detacompra['det_estado']; ?></td>
                                                        
                                                </tr>

                                            <?php } ?>
                                        </tbody>
                                    </table>  

                                <?php } else { ?>
                                        NO TIENEN DETALLES
                                <?php } ?>

                            </div>
                        
                    </div>



                    </div>
                </div>


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



            </div>



        </div> 
        <!--archivos js-->  
        <?php require 'menu/js.ctp'; ?>
        <script>
            function notacredi(datos) {
                var dat = datos.split("_");
                $('#cod').val(dat[0]);
                $('#art').val(dat[1]);
                $('#depocod').val(dat[2]);
                $('#depo').val(dat[3]);
                $('#articod').val(dat[4]);
                $('#cant').val(dat[5]);
                $('#prec').val(dat[6]);
                calsubtotal();
            }

            function calsubtotal() {
                $('#total').val(parseInt($('#cant').val()) - parseInt($('#devolu').val()));
            }


            function stock() {
                var cant = parseInt($('#cant').val());
                if (cant > 0) {
                    if (parseInt($('#devolu').val()) > cant) {
                        alert('SOLO HAY ' + cant +
                                ' EN ESTA NOTA DE CREDITO');
                        $('#devolu').val(cant);

                    }
                } else {
                    $('#devolu').val('0');
                    {
                        alert('ESTA VACIO ');
                    }

                }
            }


            $("document").ready(function () {
                calsubtotal;
            });


            function borrar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href',
                        'notacred_det_control.php?vdetcred=' + dat[1] +
                        '&vcompr=' + dat[2] +
                        '&varti=' + dat[3] +
                        '&vdepo=null' +
                        '&vprecio=null' +
                        '&vcant=null'  +
                        '&vdevol=null' +
                        '&vestado=null' +
                        '&vsobrante=null'+
                        '&accion=3' +
                        '&pagina=notcredito_detalle.php');
                $('#confirmacion').html
                        ('<span class="glyphicon glyphicon-warning-sign"></span>\n\
               Desea borrar el detalle?');
            }
                  function confirmar(datos) {
            var dat = datos.split("_");
            $('#si').attr('href',
                    'notacred_det_control.php?vdetcred=' + dat[0] +
                    '&varti=' + dat[1] +
                    '&vdepo=' + dat[2] +
                    '&vprecio=' + dat[3] +
                    '&vcant=' + dat[4] +
                    '&vdevol=0'+ 
                    '&vsobrante=' + dat[4] +
                    '&vestado=ACTIVO'+
                    '&vcompr=' + dat[7] +
                    '&accion=1' +
                    '&pagina=notcredito_detalle.php');
            $('#confirmacion').html
                    ('<span class="glyphicon glyphicon-warning-sign"></span>\n\
                No desea devolver este item del Detalle de Compra?');

        }


        </script>



    </body>
</html>
