<!DOCTYPE html>
<html>
    <head>
     <link rel="shortcut icon"  href=" img/logo_negro.ico"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SERVITECH SYS - NOTA DEBITO</title>

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
                              <h3 class="page-header text-center"> <strong>LISTADO DE NOTA DE DEBITO </strong>
                            <?php
                            $aperturas = consultas::get_datos("select *from v_apertura_cierre_calculo where cod_usu = " . $_SESSION['cod_usu'] . " and ape_estado = 'ACTIVO' ");
                            if (empty($aperturas)) {
                                $_SESSION['ape_nro'] = null;
                                ?>
                                <a href="apertura_cierre.php"
                                   class="btn btn-info btn-circle pull-right" 
                                   rel="tooltip" data-title="Debe realizar una apertura">
                                    <i class="fa fa-info"></i>
                                </a> 
                                <?php
                            } else {
                                $timbrado = consultas::get_datos("select * from timbrado where cod_tipo_comp = 3 AND  estado='ACTIVO'");
                                if (empty($timbrado)) {
                                    ?>
                                    <a href="timbrado_index.php"
                                       class="btn btn-info btn-circle pull-right" 
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
                            $debitos = consultas::get_datos("select * from v_nota_debito_fac"
                                            . " where cod_suc=" . $_SESSION['cod_suc'] . " order by cod_not_debi_vent asc ");
                            if (!empty($debitos)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">FUNCIONARIO</th>                                        
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
                                                    <th class="text-center">ACCIONES</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
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
                                                          <td class="text-center"><?php echo $debito['nota_estado']; ?></td>
                                                        <td class="text-center">
                                                         
                                                               
                                                            <a  
                                                                href="notadebito_detalle_factura.php?vdetdebifact=<?php echo $debito['cod_not_debi_vent']; ?>&vfact=<?php echo $debito['cod_factura']; ?>"
                                                                class="btn btn-xs btn-success" rel='tooltip' data-title="Detalles" >
                                                                <span class="fa fa-th-list"></span></a>
                                                                         
                                                            <a href="imprimir_factura_nota_debito_venta.php?vcod=<?php echo $debito['cod_not_debi_vent']; ?>&vfact=<?php echo $debito['cod_factura']; ?>"
                                                               target="_blank"
                                                               class="btn btn-xs btn-primary"
                                                               rel="tooltip" data-title="imprimir">
                                                                <span class="glyphicon glyphicon-print"></span></a>
                                                                
                                                            
                                                                  
                                                            <?php if ($debito['nota_estado'] == 'ACTIVO') { ?>  
                                                                <a onclick="anular(<?php
                                                                echo "'" . $debito['cod_not_debi_vent'] . "_" .
//                                                             
                                                                $debito['cod_suc'] . "'";
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
                                <h4 class="modal-title"><strong>REGISTRAR NOTA DEBITO FACTURA</strong></h4>
                            </div>
                            <?php $fecha = consultas::get_datos("select * from v_fecha2"); ?>
                            <?php $timbradoo = consultas::get_datos("select * from v_timbrado  where cod_tipo_comp = 3 and estado='ACTIVO' "); ?>
                            <?php $siguientefactu = consultas::get_datos("select * from v_notadebito_siguientenumero"); ?>
                            <form action="nota_debito_factura_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body se">
                                    <input type="hidden" name="accion"  value="1">
                                    <input type="hidden" name="vdebit" value="0"/> 
                                    <input type="hidden" name="vusu" 
                                           value="<?php echo $_SESSION['cod_usu']; ?>">
                                    <input type="hidden" name="vsuc" 
                                           value="<?php echo $_SESSION['cod_suc']; ?>">
                                    <input type="hidden" name="vestado" value="ACTIVO">
                                    <input type="hidden" name="vtim" value="<?php echo $timbradoo[0]['cod_timbrado'] ?>">
                                        <input type="hidden" name="pagina" value="notadebito_detalle_factura.php">


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
                                                     onchange="cliente(), costo()"
                                                     onkeyup="cliente(), costo()"> 
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
                                                $tipocomprobantess = consultas::get_datos("select * from tipo_comprobante where cod_tipo_comp = 3"
                                                                . " order by cod_tipo_comp");
                                                ?>                                 

                                                <?php
                                                if (!empty($tipocomprobantess)) {
                                                    foreach ($tipocomprobantess as $tipocomprobantes) {
                                                        ?>
                                                        <option  value="<?php echo $tipocomprobantes['cod_tipo_comp']; ?>">
                                                            <?php echo $tipocomprobantes['cod_tipo_comp']; ?> </option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="">Debe insertar un tipo de comprobante</option>
                                                <?php } ?>
                                            </select>
                                        </div> -->

                                        <div class="col-md-5">
                                            <label  class="control-label col-md-3"><h3>Cliente:</h3></label>
                                            <select class="form-control"  required="" name="vclie" id="detalles" >
                                                <option  value="0">Seleccione un cliente</option>
                                                <?php $clientes = consultas::get_datos("select * from v_clientes "); ?> 
                                                <?php foreach ($clientes as $cliente) { ?>
                                                    <option value="<?php echo $cliente['id_cliente']; ?>"><?php echo $cliente['datos_ciente']; ?></option>
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
                                                   class="form-control" name="vnrodebi" value="<?php echo $siguientefactu[0]['siguientedebito'] ?>">
                                        </div>

                                        </div>
                                    
                                    
                                       
                                        <BR>
                                        
                                    <div class="form-group">
                                        <div class="row">
                                            <div seclass="radio col-md-12">
                                                <label class="col-md-2 control-label" >Motivo:</label>

                                                <input  required="" type="radio"  name="vmotiv"  value="AUMENTO" id="check"  > AUMENTO

                                                <BR>
                                                <input  required="" type="radio" name="vmotiv" value="INTERES" id="check_1"> INTERES

                                            </div>
                                        </div>                                  
                                    </div>



                                    <span class="col-md-1"></span>
                                    <div class="form-group">

                                        <div class="col-md-4">
                                            <label class="col-md-2 control-label"><h3>Motivo|Descri:</h3></label>
                                            <input type="text" required="" id="descrip"
                                                   placeholder="Ingrese descripcion" autocomplete="off"
                                                   class="form-control" onchange="sololetras()" onkeyup="sololetras()"
                                                   name="vdescrip">

                                        </div>
                                            <div class="form-group" style="display: none" id="oculdescuento">
                                            <div class="col-md-3">
                                                <label class="col-md-3 control-label"><h3>Interes:</h3></label>
                                                <input  type="number"  id="descuento"
                                                        placeholder="Especifique el descuento"
                                                        class="form-control" min="0" 
                                                        onkeyup="calsubtotall(),solo_interes()"
                                                        onmouseup="calsubtotall(),solo_interes()"
                                                        max="100" 
                                                        name="vinter"
                                                        value="0">

                                            </div>
                                            </div>
                                            <div class="form-group" style="display: none" id="ocultransporte">
                                            <div class="col-md-3">
                                                <label class="col-md-3 control-label"><h3>Aumento:</h3></label>
                                                <input  type="number"  id="transporte"
                                                        placeholder="Especifique el monto"
                                                        class="form-control" min="0" 
                                                        onkeyup="caltransporte(),solo_transporte()"
                                                        onmouseup="caltransporte(),solo_transporte()"
                                                        max="1000000" 
                                                        name="vaumen"
                                                        value="0">

                                            </div>
                                            </div>
                                        </div>
                                    
                                   
                                        <span class="col-md-1"></span>
                                            <div class="col-md-4">
                                                <label class="col-md-2 control-label"><h3>Subtotal:</h3></label>
                                                <input type="number" required=""
                                                       placeholder="Subtotal del producto"
                                                       class="form-control" value="0"
                                                       readonly="" name="vtotal" id="subtotal" >
                                            </div>
                                        
                                     <div class="form-group" >
                                        
                                        <div class="col-md-4" id="detalless">
                                            <label class="col-md-4 control-label"><h3>TOTAL</h3></label>
                                            <input type="number" required="" readonly="" 
                                                   placeholder="Total" value="0"

                                                   class="form-control" >
                                            <!--                                            onkeyup="calsubtotall()" -->
                                        </div>
                                        </div>

                                    
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
        $("document").ready(function () {
            cliente();
            calsubtotall();
            costo();

        });
               function solo_interes() {
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
                     function solo_transporte() {
                var numero = document.getElementById("transporte").value;
                if (numero.match(/^-?[0-9]+(\.[0-9](1,2))?$/))
                {

                } else {
                    notificacion('Atencion', 'No se permiten letras o espacios ', 'window.alert(message);');
//                    notificacion("Solo numeros");
                    document.getElementById("transporte").value = "0";
                    calsubtotall();

                }
            }
          function sololetras() {
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
                    'nota_debito_factura_control.php?vdebit=' + dat[0] +
                    '&vtim=null' +
                    '&vusu=' + dat[1] +
                    '&vsuc=null' +
                    '&vclie= null' +
                    '&vfact= null' +
                    '&vfecha=1900-01-01' +
                    '&vmotiv=null' +
                    '&vdescrip=null' +
                    '&vinter=null' +
                    '&vaumen=null' +
                    '&vtotal=null' +
                    '&vestado=ANULADO' +
                    '&vnrodebi=null' +
                  
                    '&accion=2' +
                    '&pagina=nota_debito_factura.php');
            $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
       Desea anular la nota de Debito');
        }

        function cliente() {

            if ((parseInt($('#facturaa').val()) > 0) || ($('#facturaa').val() === "") || ($('#facturaa').val() !== "")) {
                $.ajax({
                    type: "GET",
                    url: "/servitech_tesis/lista_cliente_debito_fact.php?vfact=" + $('#facturaa').val(),
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
                    url: "/servitech_tesis/lista_montos_fact_debito.php?vfact=" + $('#facturaa').val(),
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
             var subtotal = 0;
            var subtotal_fin = 0;
            var descuento = parseInt($('#descuento').val());
            var monto = parseInt($('#total').val());
            subtotal = (descuento * monto) / 100;
            subtotal_fin = monto + subtotal;

            console.log(descuento);
            console.log(monto);
            console.log(subtotal);

            $("#subtotal").val(subtotal_fin);
        }
        function caltransporte() {
             var subtotaltrasnporte = 0;
          
            var transporte = parseInt($('#transporte').val());
            var monto = parseInt($('#total').val());
            subtotaltrasnporte = monto + transporte;
        

            $("#subtotal").val(subtotaltrasnporte);
        }



        $("#check").click(function () {
         
//            var montoo = parseInt($('#total').val());
            $("#oculdescuento").css("display", "none");
            $("#ocultransporte").css("display", "block");
            $("#descuento").val('0');
              document.getElementById('descuento').min = '0';
              document.getElementById('transporte').min = '1000';
            
      
//                $("#subtotal").val(montoo);
            calsubtotall();

        });
   

        $("#check_1").click(function () {
            $("#oculdescuento").css("display", "block");
            $("#ocultransporte").css("display", "none");
            $("#transporte").val('0');
           document.getElementById('descuento').min = '1';
           document.getElementById('transporte').min = '0';
            caltransporte();
        });




    </script>



</body>
</html>
