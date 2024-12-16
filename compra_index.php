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
        // require './anular_sesion.php'; #este es para bloquear la url
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
                        
                        <h2 class="page-header text-center">Listado de Compras
                            
                            <!--Llama al modal con el boton de cruz para compra directa-->
                            <a data-toggle="modal" data-target="#registrar_directo" 
                               class="btn btn-info btn-microsoft pull-left" 
                               rel="tooltip" data-title="Registrar Compra Directa">
                                <i class="fa fa-plus"></i>
                            </a>
                            
                            
                            <!--Llama al modal con el boton de cruz-->
                            <a data-toggle="modal" data-target="#registrar" 
                               class="btn btn-primary btn-microsoft pull-right" 
                               rel="tooltip" data-title="Registrar con Pedido u Orden">
                                <i class="fa fa-plus"></i>
                            </a>
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
                            $compras = consultas::get_datos("select * from v_compras where cod_suc=".$_SESSION['cod_suc']. "
                             and suc_descri='".$_SESSION['suc_descri']. "' and cod_pedi_comp IS NOT NULL OR id_orden_compra IS NOT NULL order by cod_comp asc ");
                            if (!empty($compras)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Proveedores</th>                                        
                                                    <th class="text-center">#Factura</th>                                        
                                                    <th class="text-center">Fecha</th>
                                                    <th class="text-center">Sucursal</th>
                                                    <th class="text-center">Funcionario</th>
                                                    <th class="text-center">Condicion</th>
                                                    <th class="text-center">N° Orden</th>
                                                    <th class="text-center">N° Pedido</th>
                                                    <th class="text-center">Monto</th>
                                                    <th class="text-center">Estado</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($compras as $compra) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $compra['cod_comp']; ?></td>
                                                        <td class="text-center"><?php echo $compra['persona']; ?></td>
                                                        <td class="text-center"><?php echo $compra['nro_factura']; ?></td>
                                                        <td class="text-center"><?php echo $compra['vfecha']; ?></td>
                                                        <td class="text-center"><?php echo $compra['suc_descri']; ?></td>
                                                        <td class="text-center"><?php echo $compra['usuario']; ?></td>
                                                        <td class="text-center"><?php echo $compra['com_condicion']; ?></td>
                                                        <td class="text-center"><?php echo $compra['id_orden_compra']; ?></td>
                                                        <td class="text-center"><?php echo $compra['cod_pedi_comp']; ?></td>
                                                        <td class="text-center"><?php echo number_format($compra['total'], 0, ',', '.'); ?></td>
                                                        <td class="text-center"><?php echo $compra['com_estado']; ?></td>
                                                        <td class="text-center">

                                                            <?php if ($compra['com_estado'] == 'ANULADO' || $compra['com_estado'] == 'CONFIRMADO') { ?>
                                                            <a href="imprimir_factura_compra.php?vcodcomp=<?php echo $compra['cod_comp']; ?> "
                                                                   target="blank"
                                                                   class="btn btn-xs btn-primary" 
                                                                   rel="tooltip" data-title="Imprimir">
                                                                    <span class="glyphicon glyphicon-print"></span>
                                                                </a>
                                                            <a href="compra_agregar.php?vcodcomp=<?= $compra['cod_comp'] ?><?= "&vorden=" . $compra['id_orden_compra'] ?><?= "&vpedi=" . $compra['cod_pedi_comp'] ?>"
                                                                       class="btn btn-xs btn-success" rel='tooltip' data-title="Detalles" >
                                                                        <span class="glyphicon glyphicon-th-list"></span></a>
                                                            
                                                            
                                                            <?php } else { ?>
                                                                <?php if ($compra['total']>'0' && ($compra['id_orden_compra'] || $compra['cod_pedi_comp'])) { ?>

                                                                    <a href="compra_agregar.php?vcodcomp=<?= $compra['cod_comp'] ?><?= "&vorden=" . $compra['id_orden_compra'] ?><?= "&vpedi=" . $compra['cod_pedi_comp'] ?>"
                                                                       class="btn btn-xs btn-success" rel='tooltip' data-title="Detalles" >
                                                                        <span class="glyphicon glyphicon-th-list"></span></a>
                                                                   
                                                                <a href="imprimir_factura_compra.php?vcodcomp=<?php echo $compra['cod_comp']; ?> "
                                                                   target="blank"
                                                                   class="btn btn-xs btn-primary" 
                                                                   rel="tooltip" data-title="Imprimir">
                                                                    <span class="glyphicon glyphicon-print"></span>
                                                                </a>

                                                                <a onclick="anular(<?php echo "'".$compra['cod_comp']."_".
                                                                    $compra['persona']."_".$compra['id_orden_compra']."_".$compra['cod_pedi_comp']."'"; ?>)"
                                                               class="btn btn-xs btn-danger" rel='tooltip' data-title="Anular Orden"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-ban-circle"></span></a>
                                                                
                                                                <a onclick="confirmar(<?php echo "'".$compra['cod_comp']."_". $compra['persona']."_".
                                                                    $compra['id_orden_compra']."_". $compra['cod_pedi_comp']."'"; ?>)"
                                                               class="btn btn-xs btn-warning" rel='tooltip' data-title="Confirmar Compra"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-ok-sign"></span></a>

                                                                   <?php } else { ?>
                                                                   <a href="compra_agregar.php?vcodcomp=<?= $compra['cod_comp'] ?><?= "&vorden=" . $compra['id_orden_compra'] ?><?= "&vpedi=" . $compra['cod_pedi_comp'] ?>"
                                                                       class="btn btn-xs btn-success" rel='tooltip' data-title="Detalles" >
                                                                        <span class="glyphicon glyphicon-th-list"></span></a>
                                                                   
                                                                <a href="imprimir_factura_compra.php?vcodcomp=<?php echo $compra['cod_comp']; ?> "
                                                                   target="blank"
                                                                   class="btn btn-xs btn-primary" 
                                                                   rel="tooltip" data-title="Imprimir">
                                                                    <span class="glyphicon glyphicon-print"></span>
                                                                </a>

                                                                <a onclick="anular(<?php echo "'".$compra['cod_comp']."_".
                                                                    $compra['persona']."_".$compra['id_orden_compra']."_".$compra['cod_pedi_comp']."'"; ?>)"
                                                               class="btn btn-xs btn-danger" rel='tooltip' data-title="Anular Orden"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-ban-circle"></span></a>
                                                            </td>
                                                        </tr>
                                                        <?php } ?>
                                                    <?php } ?>  
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
                            <div class="modal-header">
                                <button type="button" class="close" 
                                        data-dismiss="modal" arial-label="Close">x</button>
                               
                                <h4 class="modal-title"><strong>Registrar Compra</strong></h4>
                            </div>
                            <form action="compra_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body se">
                                    <input type="hidden" name="accion" value="1">
                                    <input type="hidden" name="vcodcomp" value="0">
                                    <input type="hidden" name="vtotal" value="0">
                                    <input type="hidden" name="estado" value="PENDIENTE">
                                    <input type="hidden" name="vusu" value="<?php echo $_SESSION['cod_usu']; ?>">
                                    <input type="hidden" name="pagina" value="compra_agregar.php">

                                    <!--Inicio Tipo de Articulo-->
                                 <!--Fin Tipo de articulo-->
                                  <!--Inicio Marca-->
                                  
                                  
                                  <div class="form-group">
                                        <label class="col-md-2 control-label">Tipo de Compra</label>
                                        <div class="row">
                                            <div class="radio col-md-8">
                                                <label>
                                                    <input type="radio" name="tipo" value="SO"  id="check"> Con pedido
                                                </label>
                                                <label>
                                                    <input type="radio" name="tipo" value="CO" id="check_1"> Con Orden
                                                </label>                                       
                                            </div>
                                        </div>                                  
                                    </div>
                            <div class="form-group">
                                    <label class="col-md-2 control-label">Fecha</label>
                                    <div class="col-md-3">
                                        <input type="date" required="" id="desde"
                                               placeholder="Especifique fecha"
                                               class="form-control"
                                               value="<?php echo date("Y-m-d") ?>" name="vfecha" 
                                               onchange="validar_desde()"
                                               onmouseup="validar()"
                                               onkeyup="validar()"
                                               onchange="validar()"
                                               onclick="validar()"
                                               onkeypress="validar()">
                                    </div>
                                    
                                    <label class="col-md-2 control-label">Vigencia Tim:</label>
                                    <div class="col-md-3">
                                        <input type="date" required="" id="hasta"
                                               placeholder="Especifique fecha"
                                               class="form-control"
                                               value="<?php echo date("Y-m-d") ?>" name="vfecha_vigen" 
                                               onchange="validar_desde()">
                                    </div>
                                </div>
                                  
                                  
                                 <div class="form-group">
                                    <label class="col-md-2 control-label">N° Factura</label>
                                    <div class="col-md-3">
                                        <input type="text" required="" id="factura"
                                               placeholder="Ingrese el numero de factura"
                                               class="form-control"
                                               required min="12" name="vfactura" 
                                               onkeyup="nronegativo()"
                                               onchange="nronegativo()"
                                               pattern="[0-9 and -]{13,15}"title="La factura debe tener de manera obligatoria 13 digitos"
                                               minlength="13" maxlength="15" 
                                               autofocus="">

                                    </div>
                                    
                                     <label class="col-md-2 control-label">Timbrado:</label>
                                    <div class="col-md-3">
                                        <input type="text" required="" 
                                               placeholder="Ingrese el numero de Timbrado"
                                               class="form-control" id="timbra"
                                                onkeyup="nronegativo2()"
                                               onchange="nronegativo2()"
                                               pattern="[0-9]{8,8}"title="Timbrado debe tener 8 digitos"
                                               minlength="8" maxlength="8" 
                                               name="vtim">

                                    </div>
                                 </div>
                                    
                            <div class="form-group" style="display: none" id="ocultar">
                                <label class="col-md-2 control-label">Compra con Orden:</label>
                                <div class="col-md-6">
                                    <?php $ordenescompras = consultas::get_datos("select * from v_orden_compra3 where estado_orden_compra='CONFIRMADO' AND total_orden!= 0 order by id_orden_compra asc"); ?>
                                    <select name="vorden" 
                                            class="form-control" id="orden" 
                                            onchange="proveedor()"
                                            onkeyup="proveedor()">
                                        <option value="0">Seleccione una Orden</option>
                                        <?php
                                        if (!empty($ordenescompras)) {
                                            foreach ($ordenescompras as $ordencompra) {
                                                ?>  
                                                <option value="<?php echo $ordencompra['id_orden_compra']; ?>">
                                                    <?php echo $ordencompra['datos_orden']; ?>
                                                </option>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <option value="">Debe insertar una Orden</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                             
                                <div class="form-group" style="display: none" id="ocultarproveedor2">
                                        <label class="col-md-2 control-label">Proveedor:</label>
                                        <div class="col-md-6" id="detalles">
                                            <select class="form-control" required>
                                                <option>Seleccione un proveedor</option>
                                            </select>
                                        </div>
                                    </div>
                                  
                            <div class="form-group" style="display: none" id="ocultar_pedido">
                                        <label class="col-md-2 control-label">Compra con Pedido:</label>
                                        <div class="col-md-6">
                                        <?php $pedidoscompras = consultas::get_datos("select * from v_pedido_compra where estado_pedido='CONFIRMADO' order by cod_pedi_comp asc"); ?>
                                            <select name="vpedi" 
                                                    class="form-control" id="pedi" 
                                                    onchange="proveedor()"
                                                    onkeyup="proveedor()">
                                                <option value="">Seleccione un Pedido</option>
                                                <?php
                                                if (!empty($pedidoscompras)) {
                                                    foreach ($pedidoscompras as $pedidocompra) {
                                                        ?>  
                                                        <option value="<?php echo $pedidocompra['cod_pedi_comp']; ?>">
                                                        <?php echo $pedidocompra['datos_pedido']; ?>
                                                        </option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="">Debe insertar un Pedido</option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                <div class="form-group" style="display: none" id="ocultarproveedor_pedi">
                                        <label class="col-md-2 control-label">Proveedor</label>
                                        <div class="col-md-6">
                                            <?php $proveedores = consultas::get_datos("select * from v_proveedor3 where estado='ACTIVO' order by cod_prov asc"); ?>
                                            <select name="vprov" class="form-control">
                                                
                                                <?php
                                                if (!empty($proveedores)) {
                                                    foreach ($proveedores as $proveedor) {
                                                        ?>
                                                        <option value="<?php echo $proveedor['cod_prov']; ?>">
                                                            <?php echo $proveedor['datos_proveedor']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="0">Debe seleccionar un Proveedor</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                 <div class="form-group">
                                        <label class="col-md-2 control-label">Sucursal</label>
                                        <div class="col-md-6">
                                            <?php $sucursales = consultas::get_datos("select * from v_sucursal where cod_suc=".$_SESSION['cod_suc']. " order by cod_suc"); ?>
                                            <select name="vsuc" class="form-control">
                                                <?php
                                                if (!empty($sucursales)) {
                                                    foreach ($sucursales as $sucursal) {
                                                        ?>
                                                        <option value="<?php echo $sucursal['cod_suc']; ?>">
                                                            <?php echo $sucursal['suc_descri']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="0">Debe ingresar una Sucursal</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                  <div class="form-group">
                                        <label class="col-md-2 control-label">Tipo Comprobante</label>
                                        <div class="col-md-6">
                                            <?php $tiposcomprobantes = consultas::get_datos("select * from tipo_comprobante where cod_tipo_comp = 1 order by cod_tipo_comp asc"); ?>
                                            <select name="vtipo_comp" class="form-control">
                                                <?php
                                                if (!empty($tiposcomprobantes)) {
                                                    foreach ($tiposcomprobantes as $tipocomprobante) {
                                                        ?>
                                                        <option value="<?php echo $tipocomprobante['cod_tipo_comp']; ?>">
                                                            <?php echo $tipocomprobante['comprobante_des']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="0">Debe ingresar un comprobante</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                <div class="form-group">
                                        <label class="col-md-2 control-label">Condicion</label>
                                        <div class="col-md-6">
                                            <select name="vcondicion" class="form-control"
                                                    id="vcondicion" onchange="tiposelect();">
                                                <option value="CONTADO">CONTADO</option>
                                                <option value="CREDITO">CREDITO</option>
                                            </select>
                                        </div>
                                    </div>
                               <div class="form-group">
                                    <label class="col-md-2 control-label">Cantidad Cuota</label>
                                    <div class="col-md-2">
                                        <input type="hidden" class="form-control"
                                               name="vcancuo" value="1">
                                        <input type="number" class="form-control"
                                               name="vcancuo" disabled="" min="2"
                                               id="vcancuo">
                                    </div>
                                    <label class="col-md-2 control-label">Intervalo</label>
                                    <div class="col-md-2">
                                        <input  type="number" required="" id="interval"
                                                    placeholder="Especifique Intervalo"
                                                    class="form-control" min="10" max="60" 
                                                     name="vinterval">
                                    </div>
                                </div>

                                <br>
                                  
                                    </div>
                                <div class="modal-footer">
                                    <button type="reset" data-dismiss="modal" class="btn btn-default pull-left">
                                        <i class="fa fa-close"></i> Cerrar</button>
                                    <button type="submit" class="btn btn-primary pull-right">
                                        <i class="fa fa-floppy-o"></i> Registrar</button>
                                </div>
                            </form>
                                </div>
                                
                                </div>
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
        </div>
            <!--archivos js-->  
            <?php require 'menu/js.ctp'; ?>
            
<script>
    
  
             function validar_desde() {
                var hoy = new Date($('#desde').val());
                var fechaFormulario = new Date($('#hasta').val());
                if (fechaFormulario < hoy) {
                    alert('El timbrado ya vencio!!!');
                    $('#hasta').val(hoy);
                    $('#desde').val(hoy);
                }
                else {
                }
            }
            
//            function validar_otro() {
//                var hoy = new Date();
//                var fechaFormulario = new Date($('#hasta').val());
//                if (fechaFormulario > hoy) {
//                    alert('Fecha superior al actual!!!');
//                    $('#fecha').val(hoy);
//                    $('#hasta').val(hoy);
//                }
//                else  {
////                    $("#ocultar").css("display", "block");
//                }
//            } 
     
     //para que no permita numeros negativos ni letras ci
            function nronegativo() {

                var numero = document.getElementById("factura").value;
                if (numero.match(/^-?[0-9--]+(\.[0-9--]{1,2})?$/))
                {
//                    alert("numero ok");
                }
                else
                {
                    notificacion('Atencion','Ingrese su numero sin puntos, letras ni espacios', 'mensaje');
                    document.getElementById("factura").value = "";
                }
            }
            
            function nronegativo2() {

                var numero = document.getElementById("timbra").value;
                if (numero.match(/^-?[0-9--]+(\.[0-9--]{1,2})?$/))
                {
//                    alert("numero ok");
                }
                else
                {
                    notificacion('Atencion','Ingrese su numero sin puntos, letras ni espacios', 'mensaje');
                    document.getElementById("timbra").value = "";
                }
            }
  
    
        </script>
</script>      
<script>
            function tiposelect(){
                if (document.getElementById('vcondicion').
                        value === "CONTADO") {
                    //cantidad de cuotas
                    document.getElementById('vcancuo').
                            setAttribute('disabled','true');
                    document.getElementById('vcancuo').
                            value = '1';
                    //intervalo
                    document.getElementById('interval').
                            setAttribute('disabled','true');
                    document.getElementById('interval').
                            value = '0';
                    
                }else {
                    //cantidad de cuotas
                    document.getElementById('vcancuo').
                            removeAttribute('disabled');
                    document.getElementById('vcancuo').
                            value = '2';
                    document.getElementById('vcancuo').
                            min = '2';
                    //intervalo
                     document.getElementById('interval').
                            removeAttribute('disabled');
                    document.getElementById('interval').
                            value = '10';
                     document.getElementById('interval').
                            min = '10';
                    document.getElementById('interval').
                            max = '60';
                 
                }
            }
            window.onload = tiposelect();
            
            function proveedor(){
                    if ((parseInt($('#orden').val()) > 0) || ($('#orden').val() !== "")) {
                        $.ajax({
                            type: "GET",
                            url: "/servitech/lista_proveedor_orden.php?vorden=" + 
                                    $('#orden').val (),
                            cache: false,
                            beforeSend: function () {
                                $('#detalles').
                            html('<img src="/servitech/img/cargando.GIF">\n\
                            <strong><i>Cargando...</i><strong>');
                            },
                                    success: function (msg){
                                        $('#detalles').html(msg);
//                                        obtenerprecio();
                                    }
                        });
                    }
                    else if ((parseInt($('#orden').val() == "0"))){
                        $('#orden').val('');
                 }       
                }
                

        </script>
        <script>
            function anular(datos) {
                var dat = datos.split("_");
                $('#si').attr('href'
                , 'compra_control.php?vcodcomp=' + dat[0] + 
                        '&vfecha=1900-01-01'+
                        '&estado=ANULADO'+
                        '&vsuc=null' +
                        '&vprov=null' +
                        '&vusu=null' +
                        '&vcondicion=null' +
                        '&vorden='+ dat[2] +
                        '&vpedi='+ dat[3] +
                        '&vfactura=null'+ 
                        '&vcancuo=null'+ 
                        '&vinterval=null'+ 
                        '&vtim=null'+ 
                        '&vfecha_vigen=1900-01-01'+
                        '&vtipo_comp=null'+
                        '&vtotal=null'+
                        '&accion=2'+
                        '&pagina=compra_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Anular la Compra del Proveedor <i><strong>' + dat[1] + '</strong></i>?');
            }
            
            function confirmar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href'
                , 'compra_control.php?vcodcomp=' + dat[0] + 
                        '&vfecha=1900-01-01'+
                        '&estado=CONFIRMADO'+
                        '&vsuc=null' +
                        '&vprov=null' +
                        '&vusu=null' +
                        '&vcondicion=null' +
                        '&vorden='+ dat[2] +
                        '&vpedi='+ dat[3] +
                        '&vfactura=null'+ 
                        '&vcancuo=null'+ 
                        '&vinterval=null'+ 
                        '&vtim=null'+ 
                        '&vfecha_vigen=1900-01-01'+
                        '&vtipo_comp=null'+
                        '&vtotal=null'+
                        '&accion=4'+
                        '&pagina=compra_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Confirmar la Compra del Proveedor <i><strong>' + dat[1] + '</strong></i>?');
            }
        </script>
        
        <script>
            function validar() {
                var hoy = new Date();
                var fechaFormulario = new Date($('#desde').val());
                if (fechaFormulario > hoy) {
                    alert('Fecha superior al actual!!!');
                    $('#fecha').val(hoy);
                    $('#desde').val(hoy);
                }
                else {
//                    $("#ocultar").css("display", "block");
                }
            }  
  
    
        </script>
        <script>
            $("#check").click(function () {
                $("#ocultar").css("display", "none");
            });

            $("#check_1").click(function () {
                $("#ocultar").css("display", "block");
            });

        </script>
        <script>
            $("#check").click(function () {
                $("#ocultarproveedor2").css("display", "none");
            });

            $("#check_1").click(function () {
                $("#ocultarproveedor2").css("display", "block");
            });

        </script>

        <script>
            $("#check").click(function () {
                $("#ocultarproveedor_pedi").css("display", "block");
            });

            $("#check_1").click(function () {
                $("#ocultarproveedor_pedi").css("display", "none");
            });


            $("#check").click(function () {
                $("#ocultar_pedido").css("display", "block");
            });

            $("#check_1").click(function () {
                $("#ocultar_pedido").css("display", "none");
            });

        </script>
    </body>
</html>




