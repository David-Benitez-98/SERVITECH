<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon"  href=" img/logo_negro.ico"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SERVITECH SYS- NOTA DE FACTURACION</title>

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
                        <h3 class="page-header text-center"><strong>LISTADO DE FACTURAS </strong>
                            <?php
                            $aperturas = consultas::get_datos("select *from v_apertura_cierre_calculo where cod_usu = " . $_SESSION['cod_usu'] . " and ape_estado = 'ACTIVO' ");
                            if (empty($aperturas)) {
                                $_SESSION['ape_nro'] = null;
                                ?>
                                <a href="apertura_cierre.php"
                                   class="btn btn-danger btn-circle pull-right" 
                                   rel="tooltip" data-title="Debe realizar una apertura">
                                    <i class="fa fa-info"></i>
                                </a> 
                                <?php
                            } else {
                                $timbrado = consultas::get_datos("select * from timbrado where cod_tipo_comp = 1 AND  estado='ACTIVO'");
                                if (empty($timbrado)) {
                                    ?>
                                    <a href="timbrado_index.php"
                                       class="btn btn-info btn-circle pull-right" 
                                       rel="tooltip" data-title="Timbrado Vencido!!!">
                                        <i class="fa fa-info"></i>
                                    </a> 
                                <?php } else { ?>
                                    <a data-toggle="modal" data-target="#registrar" 
                                       class="btn btn-info btn-microsoft pull-right" 
                                       rel="tooltip" data-title="Registrar" >
                                        <i class="fa fa-plus"></i>

                                    </a>   

                                <?php } ?>
                            <?php } ?>

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
                            $facturas = consultas::get_datos("select * from v_factura_cab"
                                            . " where cod_suc=" . $_SESSION['cod_suc'] . " order by cod_factura asc");
                            if (!empty($facturas)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>                             
                                                    <th class="text-center">NRO. FACTURA</th>
                                                    <th class="text-center">CLIENTE</th>
    <!--                                                    <th class="text-center">NRO.APERTURA</th>-->
                                                    <th class="text-center">SUCURSAL</th>                                        
                                                    <th class="text-center">USUARIOS</th> 
                                                    <th class="text-center">TIMBRADO</th>
                                                    <th class="text-center">FECHA</th>
                                                    <th class="text-center">CONDICION</th>
                                                    <th class="text-center">CUOTA</th>
                                                    <th class="text-center">SERVICIO|VIGEN</th>
                                                    <th class="text-center">TOTAL</th>
                                                    <th class="text-center">ESTADO</th>
                                                    <th class="text-center">ACCIONES</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($facturas as $factura) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $factura['cod_factura']; ?></td>
                                                        <td class="text-center"><?php echo $factura['nro_factura']; ?></td>
                                                        <td class="text-center"><?php echo $factura['cliente']; ?></td>
                                                        <td class="text-center"><?php echo $factura['suc_descri']; ?></td>
                                                        <td class="text-center"><?php echo $factura['usuario']; ?></td>
        <!--                                                          <td class="text-center"><?php echo $factura['ape_nro'] . "-" . $factura['vfecha_cierre']; ?></td>-->
                                                        <td class="text-center"><?php echo $factura['nro_timbrado']; ?></td>
                                                        <td class="text-center"><?php echo $factura['fecha']; ?></td>
                                                        <td class="text-center"><?php echo $factura['ven_condicion']; ?></td>
                                                        <td class="text-center"><?php echo $factura['cant_cuo']; ?></td>
                                                        <td class="text-center"><?php echo $factura['cod_presu_servi'] . "  |  |  " . $factura['vfecha_vigen'] ?></td>
                                                        <td class="text-center"><?php echo number_format($factura['ven_total'], 0, ',', '.'); ?></td>

                                                        <td class="text-center"><?php echo $factura['ven_estado']; ?></td>
                                                        <td class="text-center">
                                                             <?php if ($factura['ven_estado'] == 'ACTIVO' ) { ?>  
                                                            <a  
                                                                href="fact_detalle.php?vdetcod=<?php echo $factura['cod_factura']; ?>&vpresu=<?php echo $factura['cod_presu_servi']; ?>"
                                                                class="btn btn-xs btn-primary" rel='tooltip' data-title="Detalles" >
                                                                <span class="fa fa-th-list"></span></a>

                                                            <a href="imprimir_factura_1.php?vdetcod=<?php echo $factura['cod_factura']; ?>"
                                                               target="_blank"  
                                                               class="btn btn-xs btn-success"
                                                               rel="tooltip" data-title="imprimir">
                                                                <span class="glyphicon glyphicon-print"></span></a>
                                                                  <?php } else { ?>
                                                            <?php } ?>
                                                             <?php if ($factura['ven_estado'] == 'ANULADO' || $factura['ven_estado'] == 'CONFIRMADO' ) { ?>  
                                                            <a  
                                                                href="fact_detalle_1.php?vdetcod=<?php echo $factura['cod_factura']; ?>&vpresu=<?php echo $factura['cod_presu_servi']; ?>"
                                                                class="btn btn-xs btn-primary" rel='tooltip' data-title="Detalles" >
                                                                <span class="fa fa-th-list"></span></a>

                                                            <a href="imprimir_factura_1.php?vdetcod=<?php echo $factura['cod_factura']; ?>"
                                                               target="_blank"  
                                                               class="btn btn-xs btn-success"
                                                               rel="tooltip" data-title="imprimir">
                                                                <span class="glyphicon glyphicon-print"></span></a>
                                                                  <?php } else { ?>
                                                            <?php } ?>
                                                            <?php if ($factura['ven_estado'] == 'ACTIVO' && $factura['ven_total'] > 0) { ?>  
                                                                <a onclick="confirmar(<?php
                                                                echo "'" . $factura['ven_estado'] . "_" .
                                                                $factura['cod_factura'] . "'";
                                                                ?>)"
                                                                   class="btn btn-xs btn-warning" rel='tooltip' data-title="Confirmar"
                                                                   data-toggle="modal"
                                                                   data-target="#delete">
                                                                    <span class="glyphicon glyphicon-ok-sign"></span></a>
                                                                <a onclick="anular(<?php
                                                                echo "'" . $factura['ven_estado'] . "_" .
                                                                $factura['cod_factura'] . "'";
                                                                ?>)"
                                                                   class="btn btn-xs btn-danger" rel='tooltip' data-title="Anular"
                                                                   data-toggle="modal"
                                                                   data-target="#delete">
                                                                    <span class="glyphicon glyphicon-ban-circle"></span></a>
                                                            <?php } else { ?>
                                                            <?php } ?>

                                                        </td>
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

                <!--registrar-->
                <div id="registrar" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header alert-success">
                                <button type="button" class="close" 
                                        data-dismiss="modal" arial-label="Close">x</button>
                                <h4 class="modal-title"><strong>REGISTRAR FACTURACION</strong></h4>
                            </div>
                            <?php $fecha = consultas::get_datos("select * from v_fecha2"); ?>
                            <?php $apertutaa = consultas::get_datos("select * from v_apertura_cierre where ape_estado ='ACTIVO'"); ?>
                            <?php $facturaaaa = consultas::get_datos("select * from v_timbrado where cod_tipo_comp = 1 and estado ='ACTIVO'"); ?>
                            <form action="facturacion_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body se">
                                    <input type="hidden" name="accion"  value="1">
                                    <input type="hidden" name="vcod" value="0"/> 
                                    <input type="hidden" name="vusu" 
                                           value="<?php echo $_SESSION['cod_usu']; ?>">
                                    <input type="hidden" name="vsuc" 
                                           value="<?php echo $_SESSION['cod_suc']; ?>">
                                    <input type="hidden" name="vfecha" value="<?php echo $fecha[0]['fecha'] ?>">
                                    <input type="hidden" name="vestado" value="ACTIVO">
                                    <input type="hidden" name="vtotal" value="0">
                                    <input type="hidden" name="vaper" 
                                           value="<?php echo $apertutaa[0]['ape_nro']; ?>">
                                    <input type="hidden" name="vnrofact" 
                                           value="<?php echo $apertutaa[0]['siguiente_factura']; ?>">
                                    <input type="hidden" name="vtim" 
                                           value="<?php echo $facturaaaa[0]['cod_timbrado']; ?>">
                                    <input type="hidden" name="pagina" value="fact_detalle.php">



                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                        <div class="col-md-3 " >
                                            <label  class="control-label col-md-2"><h3>Fecha:</h3></label>
                                            <input type="date" required="" placeholder="Ingrese fecha" readonly=""
                                                   class="form-control" name="vfecha" value="<?php echo $fecha[0]['fecha'] ?>">
                                        </div>
                                        <div class="col-md-3 " >
                                            <label  class="control-label col-md-2"><h3>Vigencia:</h3></label>
                                            <input type="date" required="" placeholder="Ingrese fecha" readonly=""
                                                   class="form-control"  value="<?php echo $facturaaaa[0]['fecha_fin'] ?>">
                                        </div>
                                        

                                        <div class="col-md-4 " >
                                            <label  class="control-label col-md-2"><h3>Sucursal:</h3></label>
                                            <input type="text" required="" placeholder="Ingrese fecha" readonly=""
                                                   class="form-control" value="<?php echo $_SESSION['suc_descri'] ?>">
                                        </div>


                                    </div>
                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                        <div class="col-md-3 " >
                                            <label  class="control-label col-md-1"><h3>Factura:</h3></label>
                                            <input type="text"  required="" placeholder="Ingrese numero de factura" readonly=""
                                                   class="form-control"  value="<?php echo $apertutaa[0]['siguiente_factura'] ?>">
                                        </div>
                                        <div class="col-md-3 " >
                                            <label  class="control-label col-md-1"><h3>Timbrado:</h3></label>
                                            <input type="text" required="" placeholder="Ingrese numero de factura" readonly=""
                                                   class="form-control"  value="<?php echo $facturaaaa[0]['nro_timbrado'] ?>">
                                        </div>
                                        
                                        
                                        <div class="col-md-4">
                                            <label control-label class="col-md-3 "><h3>Comprobante:</h3></label>
                                            <select required="" name="vtip" class="form-control select"  >
                                                <?php
                                                $tipocomprobantess = consultas::get_datos("select * from tipo_comprobante where cod_tipo_comp = 1"
                                                                . " order by comprobante_des");
                                                ?>                                 

                                                <?php
                                                if (!empty($tipocomprobantess)) {
                                                    foreach ($tipocomprobantess as $tipocomprobantes) {
                                                        ?>
                                                        <option  value="<?php echo $tipocomprobantes['cod_tipo_comp']; ?>">
                                                            <?php echo $tipocomprobantes['comprobante_des']; ?> </option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="">Debe insertar un tipo de comprobante</option>
                                                <?php } ?>
                                            </select>
                                        </div> 
                                    </div>
                                   
                                     <span class="col-md-1"></span>
                                    <div class="form-group">
                                        <div class="col-md-10">
                                        <span class="col-md-4"></span><label  class="control-label col-md-3"><h3>Servicio|Presupuestado:</h3></label>
                                       
                                        <select class="form-control"   required="" name="vpresu"  id="presu" 
                                                    onchange="presupuesto()"
                                                    onkeyup="presupuesto()">  
                                                <option value="0">Seleccione Servicio Terminado</option>
                                                <?php
                                                $presupuestoservis = consultas::get_datos("select * from v_presupuesto_servi WHERE"
                                                                . " cod_suc=" . $_SESSION['cod_suc']
                                                                . " and estado ='TERMINADO' "
                                                                . "order by cod_presu_servi");
                                                ?> 
                                                <?php foreach ($presupuestoservis as $presupuestoservi) { ?>
                                                    <option value="<?php echo $presupuestoservi['cod_presu_servi']; ?>">
                                                        <?php echo $presupuestoservi['datos_presupuesto'] . " Vigen- " . $presupuestoservi['vfecha']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>


                                    </div>
                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                       
                                        <div class="col-md-5">
                                            <label  class="control-label col-md-3"><h3>Cliente:</h3></label>
                                            <select class="form-control" required="" name="vclie" id="detalles" >
                                                <option value="" >Seleccione un Cliente</option>

                                                <?php $clientes = consultas::get_datos("select * from v_clientes "); ?> 
                                                <?php foreach ($clientes as $cliente) { ?>
                                                    <option value="<?php echo $cliente['id_cliente']; ?>"><?php echo $cliente['cliente']; ?></option>
                                                <?php } ?>
                                            </select>
                                            
                                        </div>

                                        <div class="col-md-5 ">
                                            <label  class="control-label col-md-3"><h3>Condicion</h3></label>
                                            <select name="vcondicion" class="form-control"
                                                    id="vcondicion" onchange="factura();">
                                                <option value="CONTADO">CONTADO</option>
                                                <option value="CREDITO">CREDITO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <span class="col-md-1"></span>
                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                        

                                        <div class="col-md-4">
                                            <label  class="control-label col-md-3"><h3>Cuota</h3></label>
                                            <input type="hidden" class="form-control"
                                                   name="vcuota" value="1">
                                            <input type="number" class="form-control"
                                                   name="vcuota" disabled="" min="1"
                                                   id="vcancuo">
                                        </div>


                                        <div class="col-md-4">
                                            <label class="control-label col-md-3" ><H3>Intervalo</h3></label>

                                            <select  class="form-control" required="" id="vintervalo" name="vinter">
                                                <option  value=""  >Seleccione intervalo si es credito</option>
                                                <option value="5"  >5</option>
                                                <option value="10" >10</option>
                                                <option value="15" >15</option>
                                                <option value="30" >30</option>
                                                <option value="40" >45</option>
                                                <option value="40" >60</option>
                                            </select>
                                        </div>
                                    </div>

                                    <br>

                                    <br>
                                    <br>



                                    <div class="modal-footer">
                                        <button type="reset" data-dismiss="modal" class="btn btn-default pull-left">
                                            <i class="fa fa-close"></i> Cerrar</button>
                                        <button type="submit" class="btn btn-primary pull-right">
                                            <i class="fa fa-floppy-o"></i> Registrar</button>
                                    </div>
                                </div>
                            </form>

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
            function factura() {

                if (document.getElementById('vcondicion').
                        value === "CONTADO") {
                    document.getElementById('vcancuo').
                            setAttribute('disabled', 'true');
                    document.getElementById('vcancuo').
                            value = '1';


                    document.getElementById('vintervalo').
                            setAttribute('disabled', 'true');
                    document.getElementById('vintervalo').value = '';


                } else {
                    document.getElementById('vcancuo').
                            removeAttribute('disabled');
                    document.getElementById('vcancuo').value = '2';
                    document.getElementById('vcancuo').min = '2';


                    document.getElementById('vintervalo').
                            removeAttribute('disabled');
                    document.getElementById('vintervalo').value = '5';
                    document.getElementById('vintervalo').min = '5';



                }
            }
            window.onload = factura();

            function anular(datos) {
                var dat = datos.split("_");
                $('#si').attr('href',
                        'facturacion_control.php?vcod=' + dat[1] +
                        '&vsuc=null' +
                        '&vusu=null' +
                        '&vclie=null' +
                        '&vaper= null' +
                        '&vtim= null' +
                        '&vfecha=1900-01-01' +
                        '&vcondicion=null' +
                        '&vcuota=null' +
                        '&vestado=ANULADO' +
                        '&vpresu=null' +
                        '&vnrofact=null' +
                        '&vtotal=null' +
                        '&vinter=null' +
                        '&accion=2' +
                        '&pagina=facturacion.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
           Desea anular la Factura');
            }
            function confirmar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href',
                        'facturacion_control.php?vcod=' + dat[1] +
                        '&vsuc=null' +
                        '&vusu=null' +
                        '&vclie=null' +
                        '&vaper= null' +
                        '&vtim= null' +
                        '&vfecha=1900-01-01' +
                        '&vcondicion=null' +
                        '&vcuota=null' +
                        '&vestado=CONFIRMADO' +
                        '&vpresu=null' +
                        '&vnrofact=null' +
                        '&vtotal=null' +
                        '&vinter=null' +
                        '&accion=4' +
                        '&pagina=facturacion.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
           Desea confirmar la Factura');
            }
            function presupuesto() {

                if ((parseInt($('#presu').val()) > 0) || ($('#presu').val() === "") || ($('#presu').val() !== "")) {
                    $.ajax({
                        type: "GET",
                        url: "/servitech_tesis/lista_cliente_factura.php?vpresu=" + $('#presu').val(),
                        cache: false,
                        beforeSend: function () {
                            $('#detalles').html('<img src="/servitech_tesis/img/cargando.GIF">  \n\
                          <strong><i>Cargando...</i></strong>');
                        },
                        success: function (msg) {
                            $('#detalles').html(msg);

                        }
                    });
                } else {
                    $("#detalles").val('');

                }
            }

            //console.log(cliente);


        </script>



    </body>
</html>
