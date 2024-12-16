<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon"  href=" img/logo_negro.ico"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SERVITECH SYS - DETALLE NOTA DEBITO</title>

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
                        <h3 class="page-header text-center"><strong>DETALLES DE NOTA DEBITO</strong>
                            <a href="nota_debito_factura.php" 
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
                            <?php
                            $debitos = consultas::get_datos("select * from v_nota_debito_fac where cod_not_debi_vent=" .
                                            $_REQUEST ['vdetdebifact'] . " order by cod_not_debi_vent asc ");
                               if (!empty($debitos)) {
                            ?> 
                            
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table width="100%"
                                           class="table table-bordered">
                                        <thead>
                                            <tr class="primary-font">
                                                <th class="text-center">#</th>
                                                    <th class="text-center">SUCURSAL</th>                                        
                                                    <th class="text-center">USUARIOS</th>                                        
                                                    <th class="text-center">NRO. FACTURA</th>
                                                    <th class="text-center">CLIENTE</th>
                                                    <th class="text-center">NRO.DEBITO</th>
                                                    <th class="text-center">FECHA</th>
                                                    <th class="text-center">MOTIVO</th>
                                                    <th class="text-center">MOT. DESCRIP</th>
                                                    <th class="text-center">INTERES</th>
                                                    <th class="text-center">AUMENTO</th>
                                                     <th class="text-center">TOTAL</th>
                                                      <th class="text-center">ESTADO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($debitos as $debito) { ?> 
                                                <tr>
                                                 
                                                       <td class="text-center"><?php echo $debito['cod_not_debi_vent']; ?></td>
                                                        <td class="text-center"><?php echo $debito['suc_descri']; ?></td>
                                                        <td class="text-center"><?php echo $debito['usu_nick']; ?></td>
                                                        <td class="text-center"><?php echo $debito['cod_factura'] . "-" . $debito['nro_factura']; ?></td>
                                                        <td class="text-center"><?php echo $debito['datos_ciente']; ?></td>
                                                        <td class="text-center"><?php echo $debito['numero_debito']; ?></td>
                                                        <td class="text-center"><?php echo $debito['fecha_not_debi']; ?></td>
                                                        <td class="text-center"><?php echo $debito['tipo_motivo']; ?></td>
                                                        <td class="text-center"><?php echo $debito['descri_motivo']; ?></td>
                                                        <td class="text-center"><?php echo $debito['porc_interes']; ?></td>
                                                        <td class="text-center"><?php echo $debito['nota_aumento_monto']; ?></td>
                                                        <td class="text-center"><?php echo number_format($debito['total_nota'], 0, ',', '.'); ?></td>
                                                          <td class="text-center"><?php echo $debito['cod_not_debi_vent']; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>                         
                                </div>
                            </div>
                            <?php } else { ?>
                                        <div class="col-md-12">
                                        <div class="alert alert-info alert-dismissable">
                                            <button type="button" class="close"
                                                    data-dismiss="alert" aria-hidden="true">&times;
                                            </button>
                                            <strong>Numero de nota de debito repetido, favor verificar....!</strong>
                                        </div>
                                    </div>
                                <?php } ?> 
                        </div>

         


                <?php if (isset($_REQUEST['vfact'])) { ?>
                        <?php $detafacts = consultas::get_datos("select * from v_det_factura_iva where det_estado='CONFIRMADO' and cod_factura= " . $_REQUEST ['vfact']); ?>

                    <?php } ?> 


                    <div class="panel-body">

                        <?php if (isset($debitos[0]['cod_not_debi_vent'])) { ?>
                            <?php if ($debito['cod_not_debi_vent'] == 'ACTIVO') { ?> 
                            <?php } ?> 
                            <?php if (!empty($detafacts)) {
                                ?>   
                                <div class="panel-heading alert-success">
                                   
                                        DETALLE DE LA FACTURA 
                                    </div>
   
                        

                                    <div class="table-responsive">
                                                                            <div>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                     <th class="text-center">#Fac-#Det</th>
                                                <th class="text-center"> ITEM</th>
                                                <th class="text-center"> IMG</th>
                                                <th class="text-center"> CANT</th>
                                                <th class="text-center"> PREC</th>
                                                <th class="text-center"> SERVICIO</th>
                                                <th class="text-center"> MONTO|SERV</th>
                                                <th class="text-center"> SUBTOTAL</th>
                                                <th class="text-center"> ESTDADO</th>

                                            


                                               
                                            </tr>
                                        </thead>
                                        <tbody class="buscar">
                                            <?php foreach ($detafacts as $detafact) { ?> 
                                                <tr>
                                                    
                                                             <td class="text-center"><?php echo $detafact['cod_factura'] . "  -  " . $detafact['cod_deta_factu']; ?></td>
                                                    <td class="text-center"><?php echo $detafact['dato_articulo']; ?></td>
                                                    <td class="text-center"> 
                                                         <img height="40px" src="img/<?php echo $detafact['art_imagen'];?>" /> </td>
                                                    <td class="text-center"><?php echo number_format($detafact['det_cantidad'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detafact['det_precio_unit'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo $detafact['descri_servicio']; ?></td>
                                                    <td class="text-center"><?php echo number_format($detafact['monto_servicio'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detafact['subtotal'], 0, ',', '.'); ?></td>
                                                        <td class="text-center"><?php echo $detafact['det_estado']; ?></td>
                                                        
                                                         

                                                        

                                                    </td>
                                                </tr>

                                            <?php } ?>
                                        </tbody>
                                    </table>  

                                <?php } else { ?>

                                <?php } ?>

                            </div>
                        <?php } else { ?>
                        <?php } ?>



                        <div id="editar" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg ">
                                 Modal content
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" 
                                                data-dismiss="modal" arial-label="Close">x</button>
                                        <h4 class="modal-title"><strong>REGISTRAR NOTA DE CREDITO </strong></h4>
                                    </div>
                                    <form action="notacred_det_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                        <div class="panel-body">
                                            <input name="accion" value="1" type="hidden"/>
                                            <input type="hidden" name="pagina" value="notcredito_detalle.php">
                                            <input type="hidden" name="vdetcred" value="<?php echo $_REQUEST['vdetcred'] ?>">
                                            <input type="hidden" name="vcompr" value="<?php echo $_REQUEST['vcompr'] ?>">
                                            <input type="hidden" name="vestado" value="ACTIVO">
                                            <input type="hidden"  id="subtotal" name="vsubt" value="0">
                                            <input type="hidden"  id="articod" name="varti" value="0">
                                            <input type="hidden"  id="depocod" name="vdepo" value="0">


                                            <span class="col-md-1"></span>
                                            <div class="form-group">

                                                <div class="col-md-5">
                                                    <label class="col-md-2 control-label"><h3>ARTICULO</h3></label>
                                                    <input  type="text" required="" readonly=""
                                                            placeholder="Especifique articulo"
                                                            class="form-control" id="art">

                                                </div>

                                                <div class="col-md-3">
                                                    <label class="col-md-2 control-label"><h3>DEPOSITO</h3></label>
                                                    <input  type="text" required="" readonly=""
                                                            placeholder="Especifique deposito"
                                                            class="form-control" id="depo">

                                                </div>

                                                <br>


                                            </div>
                                            <BR>
                                            <span class="col-md-1"></span>
                                            <div class="form-group">
                                                <div class="col-md-5"> 
                                                    <label class="col-md-2 control-label"><h3>PRECIO:</h3></label>
                                                    <input   type="number" required=""readonly=""
                                                             placeholder="Especifique precio"
                                                             class="form-control" id="prec"
                                                             min="100"  name="vprecio"
                                                             value="0">
                                                </div>





                                                <div class="col-md-3">
                                                    <label class="col-md-2 control-label"><h3>Cantidad</h3></label>
                                                    <input  type="number" required="" readonly=""
                                                            placeholder="Especifique Cantidad"
                                                            class="form-control" id="cant" 
                                                            min="1" name="vcant"
                                                            onchange="calsubtotal(), stock()"
                                                            onkeyup="calsubtotal(), stock()"

                                                            value ="0" >

                                                </div>


                                            </div>

                                            <div class="form-group">
                                                <span class="col-md-1"></span>

                                                <div class="col-md-5">
                                                    <label class="col-md-2 control-label"><h3>DEVOLUCION</h3></label>
                                                    <input   type="number" required=""
                                                             placeholder="Especifique devolucion"
                                                             class="form-control"  
                                                             required  id="devolu"
                                                             onchange="calsubtotal(), stock()"
                                                             onkeyup="calsubtotal(), stock()"
                                                             onmouseup="calsubtotal()"

                                                             name="vdevol"
                                                             value="0" >

                                                </div>

                                                <div class="col-md-5">
                                                    <label class="col-md-2 control-label"><h3>TOTAL</h3></label>
                                                    <input   type="number" required=""
                                                             placeholder="Especifique devolucion"
                                                             class="form-control" min="1" 
                                                             required  name="vsobrante" readonly=""

                                                             value="0"  id="total">

                                                </div>
                                            </div>



                                            <div class="modal-footer">
                                                <button type="reset" data-dismiss="modal" class="btn btn-default pull-left">
                                                    <i class="fa fa-close"></i> CERRAR</button>
                                                <button type="submit" class="btn btn-primary pull-right">
                                                    <i class="fa fa-refresh"></i> REGISTRAR</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
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
                var cant = parseInt($('#devolu').val());
                var canti = parseInt($('#cant').val());
                if (cant > 0) {
                    if (parseInt($('#devolu').val()) > canti) {
                        notificacion('Atencion','SOLO HAY ' + canti +
                                ' EN ESTA NOTA DE CREDITO','window.alert(message);');
                        $('#devolu').val(canti);
                        calsubtotal();

                    }
                } else {
                    $('#devolu').val('0');
                    {
                        notificacion('Atencion','ESTA VACIO ','window.alert(message);');
                    }
calsubtotal();
                }
            }


            $("document").ready(function () {
                calsubtotal();
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
