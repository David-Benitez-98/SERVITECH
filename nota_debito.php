<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon"  href=" img/logo_negro.ico"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>NOTA DE DEBITO</title>

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
                        <h3 class="page-header text-center">LISTADO DE NOTAS DE DEBITO

                            <a data-toggle="modal" data-target="#registrar" 
                               class="btn btn-info btn-microsoft pull-right" 
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
                            $debitos = consultas::get_datos("select * from v_notadebito_compra"
                                            . " where cod_suc=" . $_SESSION['cod_suc'] . " order by id_nota_debito asc ");
                            if (!empty($debitos)) {
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
                                                    <th class="text-center"># FACTURA</th>
                                                    <th class="text-center">PROVEEDOR</th>
                                                    <th class="text-center">FECHA</th>
                                                    <th class="text-center">MOTIVO</th>
                                                    <th class="text-center">DESCRI</th>
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
                                                        <td class="text-center"><?php echo $debito['id_nota_debito']; ?></td>
                                                        <td class="text-center"><?php echo $debito['suc_descri']; ?></td>
                                                        <td class="text-center"><?php echo $debito['usuario']; ?></td>
                                                        <td class="text-center"><?php echo $debito['cod_comp'] . "-" . $debito['nro_factura']; ?></td>
                                                        <td class="text-center"><?php echo $debito['persona']; ?></td>
                                                        <td class="text-center"><?php echo $debito['nota_debi_fecha']; ?></td>
                                                        <td class="text-center"><?php echo $debito['debi_motivo']; ?></td>
                                                        <td class="text-center"><?php echo $debito['debi_descri']; ?></td>
                                                        <td class="text-center"><?php echo $debito['debi_interes']; ?></td>
                                                        <td class="text-center"><?php echo $debito['debi_aumento']; ?></td>
                                                        <td class="text-center"><?php echo number_format($debito['debi_total'], 0, ',', '.'); ?></td>

                                                        <td class="text-center"><?php echo $debito['nota_debi_estado']; ?></td>
                                                        <td class="text-center">
                                                            <a  
                                                                href="notdebito_detalle.php?vdetdebi=<?php echo $debito['id_nota_debito']; ?>&vcompr=<?php echo $debito['cod_comp']; ?>"
                                                                class="btn btn-xs btn-primary" rel='tooltip' data-title="Detalles" >
                                                                <span class="fa fa-th-list"></span></a>

                                                            <a href="imprimir_factura_nota_debito.php?vcod=<?php echo $debito['id_nota_debito']; ?>&vcompr=<?php echo $debito['cod_comp']; ?>"
                                                               target="_blank"
                                                               class="btn btn-xs btn-success"
                                                               rel="tooltip" data-title="imprimir">
                                                                <span class="glyphicon glyphicon-print"></span></a>
                                                            <?php if ($debito['nota_debi_estado'] == 'ACTIVO') { ?>  
                                                                <a onclick="anular(<?php
                                                                echo "'" . $debito['id_nota_debito'] . "_" .
                                                                $debito['debi_motivo']. "_" .
                                                                $debito['persona'] . "'";
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
                                    <div class="alert alert-success alert-dismissable">
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
                            <div class="modal-header">
                                <button type="button" class="close" 
                                        data-dismiss="modal" arial-label="Close">x</button>
                                <h4 class="modal-title"><strong>REGISTRAR NOTA DEBITO</strong></h4>
                            </div>
                            <?php $fecha = consultas::get_datos("select * from v_fecha2"); ?>
                            <form action="nota_debito_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body se">
                                    <input type="hidden" name="accion"  value="1">
                                    <input type="hidden" name="vdebi" value="0"/> 
                                    <input type="hidden" name="vusu" 
                                           value="<?php echo $_SESSION['cod_usu']; ?>">
                                    <input type="hidden" name="vsuc" 
                                           value="<?php echo $_SESSION['cod_suc']; ?>">
                                    <input type="hidden" name="vestado" value="ACTIVO">
                                    <input type="hidden" name="vfechasis" id="fec" value="<?php echo $fecha[0]['fecha'] ?>">
                                    <input type="hidden" name="pagina" value="notdebito_detalle.php">


                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                        <div class="col-md-3 ">
                                            <label  class="control-label col-md-2"><h3>Fecha:</h3></label>
                                            <input type="date" required="" id="desde" placeholder="Ingrese fecha" 
                                                   class="form-control" name="vfecha" value="<?php echo $fecha[0]['fecha'] ?>"
                                               onchange="validar_desde()"
                                               onblur="validar_desde()"
                                               onmouseup="validar()"
                                               onkeyup="validar()"
                                               onchange="validar()"
                                               onclick="validar()"
                                               onkeypress="validar()">
                                        </div>
                                        <div class="col-md-3 ">
                                            <label  class="control-label col-md-1"><h3>Vigencia:</h3></label>
                                            <input type="date" required="" placeholder="Ingrese fecha" id="hasta"  onblur="validar_desde()"
                                                   class="form-control" name="vvigen" value="<?php echo $fecha[0]['fecha'] ?>">
                                        </div>

                                        <div class="col-md-4 " >
                                            <label  class="control-label col-md-2"><h3>Sucursal</h3></label>
                                            <input type="text" required="" placeholder="Ingrese fecha" readonly=""
                                                   class="form-control" value="<?php echo $_SESSION['suc_descri'] ?>">
                                        </div>


                                    </div>
                                    <span class="col-md-1"></span>

                                    <div class="form-group">
                                        <div class="col-md-4" >
                                            <label  class="control-label col-md-2"><h3>Factura:</h3></label>
                                            <select  required="" class="form-control"   name="vcompr" id="compra" 
                                                     onchange="proveedor(), costo()"
                                                     onkeyup="proveedor(), costo()"> 
                                                <?php
                                                $compras = consultas::get_datos("select * from v_compras where cod_comp NOT IN(select cod_comp from nota_credito_compra where nota_cred_estado != 'ANULADO') "
                                                . " and cod_comp NOT IN(select cod_comp from nota_debito_compra where nota_debi_estado != 'ANULADO') and "
                                                                . " cod_suc=" . $_SESSION['cod_suc']
                                                                . " and com_estado ='CONFIRMADO' "
                                                                . "order by cod_comp");
                                                ?> 
                                                <?php
                                                if (!empty($compras)) {
                                                    foreach ($compras as $compra) {
                                                        ?>
                                                        <option  value="<?php echo $compra['cod_comp']; ?>">
                                                            <?php echo $compra['cod_comp'] . " - " . $compra['nro_factura'] . " - " . $compra['total']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="0">No hay facturas compras confirmadas</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label  class="control-label col-md-2"><h3>Timbrado</h3></label>

                                            <input type="text" required=""
                                                   placeholder="Especifique Cantidad"
                                                   class="form-control"
                                                   name="vtimb" id="timbrad"
                                                    onkeyup="nronegativo2()"
                                                    onchange="nronegativo2()"
                                                    maxlength="8" minlength="8"
                                                   pattern="[0-9]{8,8}"title="SOLO SE PERMITEN 8 DIGITOS" autofocus="">

                                        </div>
                                         

                                        <div class="col-md-3">
                                            <label  class="control-label col-md-3"><h3>Proveedor</h3></label>
                                            <select class="form-control"  required="" name="vprov" id="detalles" >
                                                <option  value="0">Seleccione un proveedor</option>
                                                <?php $proveedors = consultas::get_datos("select * from v_proveedor3 "); ?> 
                                                <?php foreach ($proveedors as $proveedor) { ?>
                                                    <option value="<?php echo $proveedor['cod_prov']; ?>"><?php echo $proveedor['persona']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                    </div>
                                    <br>
                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                        
                                        <div class="col-md-3">
                                            <label control-label class="col-md-3 "><h3>Tipo</h3></label>
                                            <select required="" name="vtip" class="form-control select"  >
                                                <?php
                                                $tipocomprobantess = consultas::get_datos("select * from tipo_comprobante where cod_tipo_comp = 3"
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
                                        
                                        <div class="col-md-4">
                                        <label class="col-md-3 control-label"><h3>N°Nota</h3></label>
                                        <input type="text" required="" id="nro_nota"
                                               placeholder="Ingrese el numero de factura"
                                               class="form-control"
                                               required min="12" name="vnro_nota" 
                                               onkeyup="nronegativo()"
                                               onchange="nronegativo()"
                                               pattern="[0-9 and -]{13,15}"title="La Nota de Debito debe tener de manera obligatoria 13 digitos"
                                               minlength="13" maxlength="15" 
                                               autofocus="">

                                    </div>
                                        <div class="row">
                                            
                                            <div seclass="radio col-md-12">
                                                <label class="col-md-2 control-label" ><h3>Motivo:</h3></label>
                                                
                                                <BR>
                                                <BR>
                                                <input  required="" type="radio"  name="vmotiv"  value="AUMENTO" id="check"  > AUMENTO

                                                <BR>
                                                <input  required="" type="radio" name="vmotiv" value="INTERES" id="check_1"> INTERES

                                            </div>
                                        </div>                                  
                                    </div>



                                    <span class="col-md-1"></span>
                                    <div class="form-group">

                                        <div class="col-md-4">
                                            <label class="col-md-2 control-label"><h3>MOTI.DESCRIPCION</h3></label>
                                            <input type="text" required="" id="descrip"
                                                   placeholder="Ingrese descripcion"
                                                   class="form-control" 
                                                   name="vdescrip">

                                        </div>
                                            <div class="form-group" style="display: none" id="oculdescuento">
                                             <div class="col-md-3">
                                                <label class="col-md-3 control-label"><h3>INTERES:</h3></label>
                                                <input  type="number"  id="descuento"
                                                        placeholder="Especifique el descuento"
                                                        class="form-control" min="0" 
                                                        onkeyup="calsubtotall()"
                                                        onmouseup="calsubtotall()"
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
                                                        onkeyup="caltransporte()"
                                                        onmouseup="caltransporte()"
                                                        
                                                        name="vtras"
                                                        value="0">

                                            </div>
                                            </div>
                                        </div>
                                    
                                   
                                        <span class="col-md-1"></span>
                                            <div class="col-md-4">
                                                <label class="col-md-2 control-label"><h3>SUBTOTAL:</h3></label>
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
            proveedor();
            calsubtotall;
            costo();
            oculto() ;
            
        });
        
        function anular(datos) {
            var dat = datos.split("_");
            $('#si').attr('href',
                    'nota_debito_control.php?vdebi=' + dat[0] +
                    '&vusu=null' +
                    '&vsuc=null' +
                    '&vcompr=null' +
                    '&vprov= null' +
                    '&vfecha=1900-01-01' +
                    '&vmotiv=null' +
                    '&vdescrip=null' +
                    '&vinter=null' +
                    '&vtras=null' +
                    '&vestado=ANULADO' +
                    '&vtotal=null' +
                    '&vtimb=null' +
                    '&vvigen=1900-01-01' +
                    '&vtip= null' +
                    '&vnro_nota=null' +
                    '&accion=2' +
                    '&pagina=nota_debito.php');
            $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
       Desea Anular la Nota de Debito del Proveedor<i><strong> ' + dat[2] + ' con Motivo de  ' + dat[1] + ' </strong></i>?');
        }

        function proveedor() {

            if ((parseInt($('#compra').val()) > 0) || ($('#compra').val() === "") || ($('#compra').val() !== "")) {
                $.ajax({
                    type: "GET",
                    url: "/servitech_tesis/lista_proveedor_2.php?vcompr=" + $('#compra').val(),
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
                $("#compra").val('');

            }
        }
        function costo() {
            if (parseInt($('#compra').val()) > 0) {
                $.ajax({
                    type: "GET",
                    url: "/servitech_tesis/lista_montos_comp_debi.php?vcompr=" + $('#compra').val(),
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
            var montoo = parseInt($('#total').val());
            $("#oculdescuento").css("display", "none");
            $("#ocultransporte").css("display", "block");
            $("#descuento").val('0');
//                $("#subtotal").val(montoo);
            calsubtotall();

        });
   

        $("#check_1").click(function () {
            $("#oculdescuento").css("display", "block");
            $("#ocultransporte").css("display", "none");
            $("#transporte").val('0');
            caltransporte();
        });
        
        
       function validar_desde() {
                var hoy = new Date($('#desde').val());
                var fechaFormulario = new Date($('#hasta').val());
                var fec = $('#fec').val();
                if (fechaFormulario < hoy) {
                    alert('El timbrado ya vencio!!!');
                    $('#hasta').val(fec);
                    $('#desde').val(fec);
                }
                else {
                }
            }
            
        function validar() {
                var hoy = new Date();
                var fechaFormulario = new Date($('#desde').val());
                var fec = $('#fec').val();
                if (fechaFormulario > hoy) {
                    alert('Fecha superior al actual!!!');
                    $('#fecha').val(fec);
                    $('#desde').val(fec);
                }
                else {
//                    $("#ocultar").css("display", "block");
                }
            }
            
            function nronegativo() {

                var numero = document.getElementById("nro_nota").value;
                if (numero.match(/^-?[0-9--]+(\.[0-9--]{1,2})?$/))
                {
//                    alert("numero ok");
                }
                else
                {
                    notificacion('Atencion','Ingrese su numero sin puntos, letras ni espacios', 'mensaje');
                    document.getElementById("nro_nota").value = "";
                }
            }
            function nronegativo2() {

                var numero = document.getElementById("timbrad").value;
                if (numero.match(/^-?[0-9--]+(\.[0-9--]{1,2})?$/))
                {
//                    alert("numero ok");
                }
                else
                {
                    notificacion('Atencion','Ingrese su numero sin puntos, letras ni espacios', 'mensaje');
                    document.getElementById("timbrad").value = "";
                }
            }
  

    </script>



</body>
</html>
