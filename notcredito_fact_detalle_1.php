<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon"  href=" img/logo_negro.ico"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SERVITECH SYS - NOTAS</title>

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
                        <h3 class="page-header text-center"><strong>DETALLE DE NOTA DE CREDITO</strong>
                            <a href="nota_credito_factura.php" 
                               class="btn btn-primary btn-microsoft pull-right" 
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
                                <strong>   DATOS CABECERA</strong>
                            </div>
                            <?php
                            $creditos = consultas::get_datos("select * from v_nota_credito_factura_1 where cod_not_credi_vent=" .
                                            $_REQUEST ['vdetcred_fact'] . " order by cod_not_credi_vent asc ");
                            if (!empty($creditos)) {
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
                                                    <th class="text-center">NRO.CREDITO</th>
                                                    <th class="text-center">FECHA</th>
                                                    <th class="text-center">MOTIVO</th>
                                                    <th class="text-center">MOT. DESCRIP</th>
                                                    <th class="text-center">DESCUENTO</th>
                                                     <?php if (isset($credito[0]['cod_not_credi_vent'])) { ?>
                                                     <?php if ($creditos['tipo_motivo'] == 'DEVOLUCION') { ?> 
                                                    <?php } ?>
                                                    <th class="text-center">TOTAL</th>
                                                         <?php } else { ?>
                                                    <th class="text-center">TOTAL</th>
                                                      <?php } ?>
                                                    
                                                    <th class="text-center">ESTADO</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($creditos as $credito) { ?> 
                                                    <tr>

                                                        <td class="text-center"><?php echo $credito['cod_not_credi_vent']; ?></td>
                                                        <td class="text-center"><?php echo $credito['suc_descri']; ?></td>
                                                        <td class="text-center"><?php echo $credito['usuario']; ?></td>
                                                        <td class="text-center"><?php echo $credito['cod_factura'] . "-" . $credito['nro_factura']; ?></td>
                                                        <td class="text-center"><?php echo $credito['cliente']; ?></td>
                                                        <td class="text-center"><?php echo $credito['nro_nota']; ?></td>
                                                        <td class="text-center"><?php echo $credito['fecha_credi']; ?></td>
                                                        <td class="text-center"><?php echo $credito['tipo_motivo']; ?></td>
                                                        <td class="text-center"><?php echo $credito['descri_motivo']; ?></td>
                                                        <td class="text-center"><?php echo $credito['credi_descuento']; ?></td>
                                                        
                                                         <?php if ($credito['tipo_motivo'] == 'DEVOLUCION') { ?> 
                                                        <td class="text-center"><?php echo number_format($credito['total_devolucion'], 0, ',', '.'); ?></td>
                                                        <?php } else { ?>
                                                        <td class="text-center"><?php echo number_format($credito['total_nota'], 0, ',', '.'); ?></td>
                                                            <?php } ?>
                                                        <td class="text-center"><?php echo $credito['estado_nota']; ?></td>
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
                                        <strong>Numero de nota de credito repetido, favor verificar....!</strong>
                                    </div>
                                </div>
                            <?php } ?> 
                        </div>

                        <!-- comienzo para el detalle de COMPRA-->

                        <?php
                        $detanotas = consultas::get_datos
                                        ("select * from  v_notacredito_fac_imprimir_detalle_2"
                                        . " where cod_not_credi_vent=" . $_REQUEST['vdetcred_fact'] .
                                        "order by cod_not_credi_vent asc");
                        ?>


                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <strong>  DETALLE DE LA NOTA DE CREDITO FACTURA</strong>
                            </div>
                            <?php if (!empty($detanotas)) { ?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center"> ARTICULO</th>
                                                <th class="text-center"> SERVICIO</th>
                                                <th class="text-center"> CANTIDAD</th>
                                                <th class="text-center"> PRECIO</th>
                                                <th class="text-center"> MONT|SERV</th>
                                                <th class="text-center"> SOBRANTE</th>
                                                <th class="text-center"> SUBTOTAL</th>
                                                <th class="text-center"> DEVOLUCION</th>
                                                <th class="text-center"> TOTAL DEVO.</th>
                                                <th class="text-center"> IVA 5</th>
                                                <th class="text-center"> GRABADA 5</th>
                                                <th class="text-center"> IVA 10</th>
                                                <th class="text-center"> GRABADA 10</th>
                                                <th class="text-center"> ESTADO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($detanotas as $detanota) { ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $detanota['cod_not_credi_vent']; ?></td>
                                                    <td class="text-center"><?php echo $detanota['dato_articulo']; ?></td>
                                                    <td class="text-center"><?php echo $detanota['descri_servicio']; ?></td>
                                                    <td class="text-center"><?php echo number_format($detanota['deta_nota_cantidad'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detanota['det_nota_precio'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detanota['monto_servicio'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detanota['canti_tot_sobrante'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detanota['sub_cal_sobran'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detanota['det_canti_devolucion'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detanota['det_nota_subtotal'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detanota['iva_5'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detanota['gravada_5'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detanota['iva_10'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detanota['gravada_10'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo $detanota['estado']; ?></td>
                                                    <th class="text-center">
                                                       
                                                    </th>

                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } else { ?>
                                    <div class="col-md-12">
                                        <div class="alert alert-info alert-dismissable">
                                            <button type="button" class="close"
                                                    data-dismiss="alert" aria-hidden="true">&times;
                                            </button>
                                            <strong>No se encontraron detalles de la nota....!</strong>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <?php if (isset($_REQUEST['vfact'])) { ?>
                        <?php $detafacts = consultas::get_datos("select * from v_det_factura_iva where (det_estado='CONFIRMADO' OR  det_estado='CONFIRMADO/R')  and  cod_factura= " . $_REQUEST ['vfact']); ?>

                    <?php } ?> 


                    <div class="panel-body">



                        <?php if (isset($_REQUEST['vdetcred_fact'])) { ?>
                            <?php $detanotas = consultas::get_datos("select * from v_nota_cre_factdet_ivatotal_imprimir where  cod_not_credi_vent= " . $_REQUEST ['vdetcred_fact']); ?>

                        <?php } ?> 

                        <div class="panel-body">

                            <?php if (!empty($detanotas)) {
                                ?>   
                                <div class="panel-heading text-center">
                                     <h4>  <strong>DETALLE DEL IVA</strong></h4>
                                </div>


                                <div class="table-responsive">
                                    <div>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"> TOTAL IVA 5</th>
                                                    <th class="text-center">TOTAL  IVA 10</th>
                                                    <th class="text-center"> TOTAL EXENTA</th>
                                                    <th class="text-center">TOTAL IVA</th>

                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($detanotas as $detanota) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo number_format($detanota['total_iva5'], 0, ',', '.'); ?></td>
                                                        <td class="text-center"><?php echo number_format($detanota['total_iva_10'], 0, ',', '.'); ?></td>
                                                        <td class="text-center"><?php echo number_format($detanota['total_exenta'], 0, ',', '.'); ?></td>
                                                        <td class="text-center"><?php echo number_format($detanota['total_ivas'], 0, ',', '.'); ?></td>

                                                    </tr>

                                                <?php } ?>
                                            </tbody>
                                        </table>  

                                    <?php } else { ?>

                                    <?php } ?>

                                </div>
                            </div>


                            <div id="editar" class="modal fade" role="dialog">
                                <div class="modal-dialog modal-lg ">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" 
                                                    data-dismiss="modal" arial-label="Close">x</button>
                                            <h4 class="modal-title"><strong>REGISTRAR NOTA DE CREDITO </strong></h4>
                                        </div>
                                        <form action="notacred_fact_det_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                            <div class="panel-body">
                                                <input name="accion" value="1" type="hidden"/>
                                                <input type="hidden" name="pagina" value="notcredito_fact_detalle.php">
                                                <input type="hidden" name="vdetcred_fact" value="<?php echo $_REQUEST['vdetcred_fact'] ?>">
                                                <input type="hidden" name="vfact" value="<?php echo $_REQUEST['vfact'] ?>">
                                                <input type="hidden" name="vestado" value="ACTIVO">
                                                <input type="hidden"  id="subtotal" name="vsubt" value="0">
                                                <input type="hidden"  id="articod" name="varti" value="0">
                                                <input type="hidden"  id="depocod" name="vdepo" value="0">
                                                <input type="hidden"  name="vid" value="0">
                                                <input type="hidden"  id="servcod" name="vserv" value="0">
                                                <input type="hidden"  id="monto" name="vmonto" value="0">
                                                <input type="hidden"  id="equi" name="vequi" value="0">


                                                <span class="col-md-1"></span>
                                                <div class="form-group">

                                                    <div class="col-md-4">
                                                        <label class="col-md-2 control-label"><h3>ARTICULO</h3></label>
                                                        <input  type="text" required="" readonly=""
                                                                placeholder="Especifique articulo"
                                                                class="form-control" id="art">

                                                    </div>

                                                    <div class="col-md-3">
                                                        <label class="col-md-2 control-label"><h3>SERVICIO</h3></label>
                                                        <input  type="text" required="" readonly=""
                                                                placeholder="Especifique Servicio"
                                                                class="form-control" id="servdesc">

                                                    </div>

                                                    <div class="col-md-3">
                                                        <label class="col-md-2 control-label"><h3>DEPOSITO</h3></label>
                                                        <input  type="text" required="" readonly=""
                                                                placeholder="Especifique deposito"
                                                                class="form-control" id="depodesc">

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
                                                                class="form-control" id="canti" 
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

                                    <div class="alert alert-success" id="confirmacion"></div>

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
                    $('#depodesc').val(dat[3]);
                    $('#articod').val(dat[4]);
                    $('#servcod').val(dat[5]);
                    $('#servdesc').val(dat[6]);
                    $('#canti').val(dat[7]);
                    $('#prec').val(dat[8]);
                    $('#monto').val(dat[9]);
                    $('#equi').val(dat[10]);
                    calsubtotal();
                }

                function calsubtotal() {
                    $('#total').val(parseInt($('#canti').val()) - parseInt($('#devolu').val()));
                }


                function stock() {
                    var cant = parseInt($('#devolu').val());
                    var canti = parseInt($('#canti').val());
                    if (cant > 0) {
                        if (parseInt($('#devolu').val()) > canti) {
                            notificacion('Atencion','SOLO HAY ' + canti +
                                    ' EN ESTA NOTA DE CREDITO','window.alert(message);');
                            $('#devolu').val('0');
                            calsubtotal();

                        }
                    } else {
                        $('#devolu').val('0');
                       
                        {
//                            alert('ESTA VACIO ');
                            notificacion('Atencion','ESTA VACIO ','window.alert(message);');
//                              calsubtotal();
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
                            '&vcant=null' +
                            '&vdevol=null' +
                            '&vestado=null' +
                            '&vsobrante=null' +
                            '&accion=3' +
                            '&pagina=notcredito_detalle.php');
                    $('#confirmacion').html
                            ('<span class="glyphicon glyphicon-warning-sign"></span>\n\
                   Desea borrar el detalle?');
                }
                                             
                function confirmar(datos) {
                    var dat = datos.split("_");
                    $('#si').attr('href',
                            'notacred_fact_det_control.php?vdetcred_fact=' + dat[0] +
                            '&varti=' + dat[1] +
                            '&vserv=' + dat[7] +
                            '&vdepo=' + dat[2] +
                            '&vequi=' + dat[9] +
                            '&vprecio=' + dat[3] +
                            '&vcant=' + dat[4] +
                            '&vdevol=0' +
                            '&vestado=ACTIVO' +
                            '&vsobrante=' + dat[4] +
                            '&vid=null' +
                            '&vmonto=' + dat[8] +
                            '&vfact=' + dat[10] +
                            '&accion=1' +
                            '&pagina=notcredito_fact_detalle.php');
                    $('#confirmacion').html
                            ('<span class="glyphicon glyphicon-warning-sign"></span>\n\
                  <strong>  Desea NO Realizar una Devolución al Item del Detalle de esta Factura?</strong>');

                }


            </script>



    </body>
</html>
