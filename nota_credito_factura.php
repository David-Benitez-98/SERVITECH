<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon"  href=" img/logo_negro.ico"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SERVITECH SYS- NOTAS</title>

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
                              <h3 class="page-header text-center"><strong>LISTADO DE NOTA DE CREDITO - VENTAS</strong>
                            <?php
                            $aperturas = consultas::get_datos("select * from v_apertura_cierre where cod_usu = " . $_SESSION['cod_usu'] . " and ape_estado = 'ACTIVO' ");
                            if (empty($aperturas)) {
                                $_SESSION['ape_nro'] = null;
                                ?>
                                <a href="apertura_cierre.php"
                                   class="btn btn-warning btn-microsoft pull-right" 
                                   rel="tooltip" data-title="Debe realizar una apertura">
                                    <i class="fa fa-info"></i>
                                </a> 
                                <?php
                            } else {
                                $timbrado = consultas::get_datos("select * from timbrado where cod_tipo_comp = 2 AND  estado='ACTIVO'");
                                if (empty($timbrado)) {
                                    ?>
                                    <a href="timbrado_index.php"
                                       class="btn btn-primary btn-microsoft pull-right" 
                                       rel="tooltip" data-title="Debe tener Timbrado!!!">
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
                            $creditos = consultas::get_datos("select * from v_nota_credito_factura_1"
                                            . " where cod_suc=" . $_SESSION['cod_suc'] . " order by cod_not_credi_vent asc ");
                            if (!empty($creditos)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
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
                                                     <?php if ($creditos['cod_not_credi_vent'] == 'DEVOLUCION') { ?> 
                                                    <?php } ?>
                                                    <th class="text-center">TOTAL</th>
                                                         <?php } else { ?>
                                                    <th class="text-center">TOTAL</th>
                                                      <?php } ?>
                                                    
                                                    <th class="text-center">ESTADO</th>
                                                    <th class="text-center">ACCIONES</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
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
                                                        <td class="text-center">
                                                             <?php if ($credito['estado_nota'] == 'ANULADO' || $credito['estado_nota'] == 'CONFIRMADO') { ?> 
                                                            <a  
                                                                href="notcredito_fact_detalle_1.php?vdetcred_fact=<?php echo $credito['cod_not_credi_vent']; ?>&vfact=<?php echo $credito['cod_factura']; ?>"
                                                                class="btn btn-xs btn-primary" rel='tooltip' data-title="Detalles" >
                                                                <span class="fa fa-th-list"></span></a>
                                                                <?php } else { ?>
                                                            <a  
                                                                href="notcredito_fact_detalle.php?vdetcred_fact=<?php echo $credito['cod_not_credi_vent']; ?>&vfact=<?php echo $credito['cod_factura']; ?>"
                                                                class="btn btn-xs btn-primary" rel='tooltip' data-title="Detalles" >
                                                                <span class="fa fa-th-list"></span></a>
                                                                         <?php } ?>
                                                             <?php if ($credito['tipo_motivo'] == 'DEVOLUCION') { ?> 
                                                            <a href="imprimir_factura_nota_credito_venta.php?vcod=<?php echo $credito['cod_not_credi_vent']; ?>"
                                                               target="_blank"
                                                               class="btn btn-xs btn-success"
                                                               rel="tooltip" data-title="imprimir">
                                                                <span class="glyphicon glyphicon-print"></span></a>
                                                                <?php } else { ?>
                                                            <a href="imprimir_factura_nota_credito_venta_1.php?vcod=<?php echo $credito['cod_not_credi_vent']; ?>"
                                                               target="_blank"
                                                               class="btn btn-xs btn-success"
                                                               rel="tooltip" data-title="imprimir">
                                                                <span class="glyphicon glyphicon-print"></span></a>
                                                                   <?php } ?>
                                                            <?php if ($credito['estado_nota'] == 'ACTIVO') { ?>  
                                                                <a onclick="anular(<?php
                                                                echo "'" . $credito['cod_not_credi_vent'] . "_" .
                                                                $credito['fecha_credi'] . "_" .
                                                                $credito['cod_suc'] . "'";
                                                                ?>)"
                                                                   class="btn btn-xs btn-danger" rel='tooltip' data-title="Anular"
                                                                   data-toggle="modal"
                                                                   data-target="#delete">
                                                                    <span class="glyphicon glyphicon-ban-circle"></span></a>
                                                                <a onclick="confirmar(<?php
                                                                echo "'" . $credito['cod_not_credi_vent'] . "_" .
                                                                     $credito['fecha_credi'] . "_" .
                                                                     $credito['cod_suc'] . "'";
                                                                ?>)"
                                                                   class="btn btn-xs btn-warning" rel='tooltip' data-title="Confirmar"
                                                                   data-toggle="modal"
                                                                   data-target="#delete">
                                                                    <span class="glyphicon glyphicon-ok-sign"></span></a>
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
                                <h4 class="modal-title"><strong>REGISTRAR NOTA CREDITO FACTURA</strong></h4>
                            </div>
                            <?php $fecha = consultas::get_datos("select * from v_fecha2"); ?>
                            <?php $timbradoo = consultas::get_datos("select * from v_timbrado where cod_tipo_comp = 2 and estado='ACTIVO' "); ?>
                            <?php $siguientefactu = consultas::get_datos("select * from v_notacredito_siguientefactura"); ?>
                            <form action="nota_credito_factura_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body se">
                                    <input type="hidden" name="accion"  value="1">
                                    <input type="hidden" name="vcred" value="0"/> 
                                    <input type="hidden" name="vusu" 
                                           value="<?php echo $_SESSION['cod_usu']; ?>">
                                    <input type="hidden" name="vsuc" 
                                           value="<?php echo $_SESSION['cod_suc']; ?>">
                                    <input type="hidden" name="vestado" value="ACTIVO">
                                    <input type="hidden" name="vtimb" value="<?php echo $timbradoo[0]['cod_timbrado'] ?>">
                                    <input type="hidden" name="pagina" value="notcredito_fact_detalle.php">


                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                        <div class="col-md-3 " >
                                            <label  class="control-label col-md-2"><h3>Fecha:</h3></label>
                                            <input type="date" required="" placeholder="Ingrese fecha" id="desde" readonly=""
                                                   class="form-control" name="vfecha" value="<?php echo $fecha[0]['fecha'] ?>">
                                        </div>
                                        <div class="col-md-3 " >
                                            <label  class="control-label col-md-1"><h3>Vigencia:</h3></label>
                                            <input type="date" required="" placeholder="Ingrese fecha" id="hasta" readonly=""  onchange="validarvigencia()"
                                                   class="form-control" name="vvigen" value="<?php echo $timbradoo[0]['fecha_fin'] ?>">
                                        </div>

                                        <div class="col-md-3 " >
                                            <label  class="control-label col-md-2"><h3>Sucursal:</h3></label>
                                            <input type="text" required="" placeholder="Ingrese fecha" readonly=""
                                                   class="form-control" value="<?php echo $_SESSION['suc_descri'] ?>">
                                        </div>


                                    </div>
                                    <br>
                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                        <div class="col-md-4" >
                                            <label  class="control-label col-md-2"><h3>Factura:</h3></label>
                                            <select  required="" class="form-control"   name="vfact" id="facturaa" 
                                                     onchange="proveedor(), costo()"
                                                     onkeyup="proveedor(), costo()"> 
                                                <!--                                                <option  value="0">Seleccione una compra</option>-->

                                                <?php
                                                $facturas = consultas::get_datos("select * from v_factura_cab where cod_factura NOT IN(select cod_factura from nota_credi_venta where estado_nota !='ANULADO') "
                                                                                 . "and cod_factura NOT IN(select cod_factura from nota_debito_venta where nota_estado !='ANULADO') and"
                                                                . " cod_suc=" . $_SESSION['cod_suc']
                                                                . " and ven_estado ='CONFIRMADO' "
                                                                . "order by cod_factura");
                                                ?> 
                                                <?php
                                                if (!empty($facturas)) {
                                                    foreach ($facturas as $factura) {
                                                        ?>
                                                        <option  value="<?php echo $factura['cod_factura']; ?>">
                                                            <?php echo $factura['cod_factura'] . " - " . $factura['nro_factura'] . " - " . $factura['ven_total']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="0">No hay facturas confirmadas</option>
                                                <?php } ?>
                                            </select>
                                        </div>
<!--                                        <div class="col-md-3">
                                            <label control-label class="col-md-3 "><h3>TIPO</h3></label>
                                            <select required="" name="vtip" class="form-control select"  >
                                                <?php
                                                $tipocomprobantess = consultas::get_datos("select * from tipo_comprobante where cod_tipo_comp = 2"
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
                                        </div> -->

                                        <div class="col-md-5">
                                            <label  class="control-label col-md-3"><h3>Clinte:</h3></label>
                                            <select class="form-control"  required="" name="vclie" id="detalles" >
                                                <option  value="0">Seleccione un cliente</option>
                                                <?php $clientes = consultas::get_datos("select * from v_clientes "); ?> 
                                                <?php foreach ($clientes as $cliente) { ?>
                                                    <option value="<?php echo $cliente['id_cliente']; ?>"><?php echo $cliente['cliente']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                    </div>
                                     <span class="col-md-1"></span>
                                    <div class="form-group">
                                        <div class="col-md-3 " >
                                            <label  class="control-label col-md-2"><h3>Timbrado:</h3></label>
                                            <input type="text" required="" placeholder="Ingrese fecha" readonly="" 
                                                   class="form-control" value="<?php echo $timbradoo[0]['nro_timbrado'] ?>">
                                        </div>
                                          <span class="col-md-1"></span>
                                              <div class="col-md-3 " >
                                            <label  class="control-label col-md-2"><h3>N°Nota:</h3></label>
                                            <input type="text" required="" placeholder="Ingrese fecha" readonly=""
                                                   class="form-control" name="vnrocredi" value="<?php echo isset($siguientefactu[0]['siguientefacturacredito']) ?>">
                                        </div>

                                        </div>
                                   
                                        <BR>
                                        
                                    <div class="form-group">
                                        <span class="col-md-1"></span>
                                        <div class="col-md-4">
                                            <label class="col-md-2 control-label"><h3>Descripcion|Mot.</h3></label>
                                            <input type="text" required="" id="descrip"
                                                   placeholder="Ingrese descripcion"
                                                   class="form-control" onchange="solo_observacion()" onkeyup="solo_observacion()"
                                                   name="vdescrip">

                                        </div>
                                        <div class="row">
                                            <div seclass="radio col-md-8">
                                                <label class="col-md-2 control-label" >Motivo:</label>
                                                <br>
                                                <input  required="" type="radio"  name="vmotiv"  value="DEVOLUCION" checked=""id="check"  > DEVOLUCION
                                                
                                                <br>
                                                 <span class="col-md-1"></span><span class="col-md-1"></span>
                                                <input  required="" type="radio" name="vmotiv" value="DESCUENTO" id="check_1"> DESCUENTO
                                                  <br> 
                                                 <span class="col-md-1"></span><span class="col-md-1"></span>
                                                <input  required="" type="radio" name="vmotiv" value="ANULACION" id="check_2"> ANULACION

                                            </div>
                                            
                                        </div>                                  
                                    </div>



                                    <span class="col-md-1"></span>
                                    <div class="form-group">

                                        
                                        <div class="form-group" style="display: none" id="oculdescuento">
                                            <div class="col-md-3">
                                                <label class="col-md-3 control-label"><h3>Descuento:</h3></label>
                                                <input  type="number"  id="descuento"
                                                        placeholder="Especifique el descuento"
                                                        class="form-control" min="0" 
                                                        onchange="solo_descuento()"
                                                        onkeyup="calsubtotall(), solo_descuento()"
                                                        onmouseup="calsubtotall(),solo_descuento()"
                                                        max="100"
                                                        name="vdesc"
                                                        value="0">

                                            </div>
                                            <div class="col-md-3">
                                                <label class="col-md-4 control-label"><h3>Subtotal:</h3></label>
                                                <input type="number" required=""
                                                       placeholder="Subtotal del producto"
                                                       class="form-control" value="0"
                                                       readonly="" name="vtotal" id="subtotal" >
                                            </div>
                                        </div>
                                         
                            <div class="form-group" style="display: none" id="ocultaranular">
                                        <div class="col-md-3">
                                                <label class="col-md-4 control-label"><h3>Subtotal:</h3></label>
                                                <input type="number" required=""
                                                       placeholder="Subtotal del producto"
                                                       class="form-control" value="0"
                                                       readonly=""  id="subtotalL"  >
                                            </div>
                                            </div>
                                        <span class="col-md-1"></span>
                                        <span class="col-md-1"></span>
                                        <span class="col-md-1"></span>
                                        <div class="col-md-4" id="detalless">
                                            <label class="col-md-5 control-label"><h3>Total:</h3></label>
                                            <input type="number" required="" readonly="" 
                                                   placeholder="Total" value="0"

                                                   class="form-control" >
                                            <!--                                            onkeyup="calsubtotall()" -->
                                        </div>

                                    </div>
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
        $("document").ready(function () {
            proveedor();
            calsubtotall;
            costo();

        });

   function validarvigencia() {
            
              
                var hoy = new Date($('#desde').val());
                var fechaFormulario = new Date($('#hasta').val());
                if (fechaFormulario < hoy) {
                    
                     notificacion('Atencion', 'Fecha inferior a la fecha !!!', 'window.alert(message);');
//                    $('#desde').val(hoyy);
                    $('#hasta').val(hoy);
                }
                else {

                }
            }
                           function solo_timbrado() {
                var numero = document.getElementById("timbrad").value;
                if (numero.match(/^-?[0-9]+(\.[0-9](1,2))?$/))
                {

                } else {
                    notificacion('Atencion', 'No se permiten letras o espacios ', 'window.alert(message);');
//                    notificacion("Solo numeros");
                    document.getElementById("timbrad").value = "";

                }
            }
                           function solo_credi() {
                var numero = document.getElementById("credi").value;
                if (numero.match(/^-?[0-9--]+(\.[0-9--](1,2))?$/))
                {

                } else {
                    notificacion('Atencion', 'No se permiten letras o espacios ', 'window.alert(message);');
//                    notificacion("Solo numeros");
                    document.getElementById("credi").value = "000-000-0000000";

                }
            }
                           function solo_descuento() {
                var numero = document.getElementById("descuento").value;
                if (numero.match(/^-?[0-9]+(\.[0-9](1,2))?$/))
                {

                } else {
                    notificacion('Atencion', 'No se permiten letras o espacios ', 'window.alert(message);');
//                    notificacion("Solo numeros");
                    document.getElementById("descuento").value = "0";
                    calsubtotall();

                }
            }
                 function solo_observacion() {
//                      var numero = trim(numero);
                var numero = document.getElementById("descrip").value;
                if (numero.length === 0 || numero === " ") {
                    notificacion('Atencion', 'No se permiten campos vacios', 'window.alert(message);');
                   
                    document.getElementById("descrip").value = "";
                    
                    
                } else {

                }
            }
            
        function anular(datos) {
            var dat = datos.split("_");
            $('#si').attr('href',
                    'nota_credito_factura_control.php?vcred=' + dat[0] +
                    '&vsuc=' + dat[2] +
                    '&vusu=null' +
                    '&vfact= null' +
                    '&vclie= null' +
                    '&vtimb=null' +
                    '&vfecha=1900-01-01' +
                    '&vmotiv=null' +
                    '&vdescrip=null' +
                    '&vdesc=null' +
                    '&vestado=ANULADO' +
                    '&vtotal=null' +
                    '&vnrocredi=null' +
                    '&accion=2' +
                    '&pagina=nota_credito_factura.php');
            $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
     <strong>  Desea Anular la Nota de Credito de la fecha'+ dat[2] + '</strong>');
        }
        function confirmar(datos) {
            var dat = datos.split("_");
            $('#si').attr('href',
                    'nota_credito_factura_control.php?vcred=' + dat[0] +
                    '&vsuc=' + dat[2] +
                    '&vusu=null' +
                    '&vfact= null' +
                    '&vclie= null' +
                    '&vtimb=null' +
                    '&vfecha=1900-01-01' +
                    '&vmotiv=null' +
                    '&vdescrip=null' +
                    '&vdesc=null' +
                    '&vestado=CONFIRMADO' +
                    '&vtotal=null' +
                    '&vnrocredi=null' +
                    '&accion=4' +
                    '&pagina=nota_credito_factura.php');
            $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
      <strong>  Desea Confirmar la Nota de Credito de la fecha'+ dat[1] + '</strong>');
        }

        function proveedor() {

            if ((parseInt($('#facturaa').val()) > 0) || ($('#facturaa').val() === "") || ($('#facturaa').val() !== "")) {
                $.ajax({
                    type: "GET",
                    url: "/servitech_tesis/lista_cliente_credito.php?vfact=" + $('#facturaa').val(),
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
                $("#facturaa").val('');

            }
        }
        function costo() {
            if (parseInt($('#facturaa').val()) > 0) {
                $.ajax({
                    type: "GET",
                    url: "/servitech_tesis/lista_montos_fact_cred.php?vfact=" + $('#facturaa').val(),
                    cache: false,
                    beforeSend: function () {
                        $('#detalless').html('<img src="/servitech_tesis/img/ajax-loader.GIF">  \n\
                      <strong><i>Cargando...</i></strong>');
                    },
                    success: function (msg) {
                        $('#detalless').html(msg);
                        calsubtotall();

                    }
                });
            }
        }
//            console.log(subtotal);
        function calsubtotall() {

//            if($(("#compra").val()) !== 0){
            var subtotal = 0;
            var subtotal_fin = 0;
            var descuento = parseInt($('#descuento').val());
            var monto = parseInt($('#total').val());
            subtotal = (descuento * monto) / 100;
            subtotal_fin = monto - subtotal;

            console.log(descuento);
            console.log(monto);
            console.log(subtotal);

            $("#subtotal").val(subtotal_fin);
            $("#subtotalL").val(monto);
        }
//                  else  if($(("#compra").val()) == 0) 
//                  {
//                      $("#subtotal").val(monto); }
//              }



        $("#check").click(function () {
            var montoo = parseInt($('#total').val());
            $("#oculdescuento").css("display", "none");
            $("#ocultaranular").css("display", "none");
             $("#descuento").val('0');
//                $("#subtotal").val(montoo);
            calsubtotall();

        });


        $("#check_1").click(function () {
            $("#oculdescuento").css("display", "block");
              $("#ocultaranular").css("display", "none");
        });
        $("#check_2").click(function () {
            $("#ocultaranular").css("display", "block");
             $("#oculdescuento").css("display", "none");
            $("#descuento").val('0');
            calsubtotall();
        });



    </script>


</body>
</html>
