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
                        
                        <h3 class="page-header">Listado de Ordenes de Compras
                            
                            <!--Llama al modal con el boton de cruz-->
                            <a data-toggle="modal" data-target="#registrar" 
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
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                Datos
                            </div>
                            <?php
                            $ordenescompras = consultas::get_datos("select * from v_orden_compra3 order by id_orden_compra asc ");
                            if (!empty($ordenescompras)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Funcionario</th>
                                                    <th class="text-center">Proveedor</th>                                        
                                                    <th class="text-center">Fecha</th>
                                                    <th class="text-center">Monto</th>
                                                    <th class="text-center">Estado</th>
                                                    <th class="text-center">#Pedi</th>
                                                    <th class="text-center">#Presu</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($ordenescompras as $ordencompra) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $ordencompra['id_orden_compra']; ?></td>
                                                        <td class="text-center"><?php echo $ordencompra['usuario']; ?></td>
                                                        <td class="text-center"><?php echo $ordencompra['proveedor']; ?></td>
                                                        <td class="text-center"><?php echo $ordencompra['vfecha']; ?></td>
                                                        <td class="text-center"><?php echo $ordencompra['total_orden']; ?></td>
                                                        <td class="text-center"><?php echo $ordencompra['estado_orden_compra']; ?></td> 
                                                        <td class="text-center"><?php echo $ordencompra['cod_pedi_comp']; ?></td>
                                                        <td class="text-center"><?php echo $ordencompra['cod_presu_comp']; ?></td>
                                                        
                                                        <td class="text-center">
                                                             <?php if($ordencompra['estado_orden_compra']=='REALIZADO' || $ordencompra['estado_orden_compra']=='ANULADO' 
                                                                     || $ordencompra['estado_orden_compra']=='CONFIRMADO' || $ordencompra['estado_orden_compra']=='FACTURADO'){ ?>
                                                                
                                                            <a href="imprimir_ordencompra.php?vorden=<?php echo $ordencompra['id_orden_compra']; ?>"
                                                                   target="_blank"
                                                                   class="btn btn-xs btn-primary"
                                                                   rel="tooltip" data-title="imprimir">
                                                                    <span class="glyphicon glyphicon-print"></span></a>
                                                                
                                                                <a href="orden_compra_agregar.php?vorden=<?= $ordencompra['id_orden_compra']?><?= "&vpedi=".$ordencompra['cod_pedi_comp']?><?= "&vpresu=".$ordencompra['cod_presu_comp']?>"
                                                                class="btn btn-xs btn-success" rel='tooltip' data-title="Detalles" >
                                                                <span class="glyphicon glyphicon-th-list"></span></a>
                                                                
                                                                <?php }else if($ordencompra['total_orden']!= '0'){?>
                                                            
                                                               <a href="orden_compra_agregar.php?vorden=<?= $ordencompra['id_orden_compra']?>"
                                                                class="btn btn-xs btn-success" rel='tooltip' data-title="Detalles" >
                                                                <span class="glyphicon glyphicon-th-list"></span></a>
                                                                
                                                                <a onclick="anular(<?php echo "'".$ordencompra['id_orden_compra']."_".
                                                                    $ordencompra['proveedor']."_".$ordencompra['cod_pedi_comp']."_".$ordencompra['cod_presu_comp']."'"; ?>)"
                                                               class="btn btn-xs btn-danger" rel='tooltip' data-title="Anular Orden"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-ban-circle"></span></a>
                                                                
                                                                <a onclick="confirmar(<?php echo "'".$ordencompra['id_orden_compra']."_". $ordencompra['proveedor']."_".
                                                                    $ordencompra['cod_pedi_comp']."_". $ordencompra['cod_presu_comp']."'"; ?>)"
                                                               class="btn btn-xs btn-info" rel='tooltip' data-title="Confirmar Orden"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-ok-sign"></span></a>
                                                           <?php }else{?>  
                                                            <?php   if($ordencompra['cod_pedi_comp'] || $ordencompra['cod_presu_comp']){?>
                                                            
                                                            <a href="orden_compra_agregar.php?vorden=<?= $ordencompra['id_orden_compra']?><?= "&vpedi=".$ordencompra['cod_pedi_comp']?><?= "&vpresu=".$ordencompra['cod_presu_comp']?>"
                                                                class="btn btn-xs btn-success" rel='tooltip' data-title="Detalles" >
                                                                <span class="glyphicon glyphicon-th-list"></span></a>
                                                                
                                                               <?php }else{?>
                                                            
                                                            <a href="orden_compra_agregar.php?vorden=<?= $ordencompra['id_orden_compra']?>"
                                                                class="btn btn-xs btn-success" rel='tooltip' data-title="Detalles" >
                                                                <span class="glyphicon glyphicon-th-list"></span></a>
                                                                
                                                                
                                                                <?php }?>
<!--                                                                <a  
                                                                href="orden_compra_agregar.php?vorden=<?= $ordencompra['id_orden_compra']; ?>"
                                                                class="btn btn-xs btn-warning" rel='tooltip' data-title="Detalle" >
                                                                <span class="glyphicon glyphicon-pencil"></span></a>-->
                                                                
                                                                <a onclick="anular(<?php echo "'".$ordencompra['id_orden_compra']."_".
                                                                    $ordencompra['proveedor']."_".$ordencompra['cod_pedi_comp']."_".$ordencompra['cod_presu_comp']."'"; ?>)"
                                                               class="btn btn-xs btn-danger" rel='tooltip' data-title="Anular Orden"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-ban-circle"></span></a>
                                                              
<!--                                                            <a href="#" class="btn btn-xs btn-primary" rel="tooltip" data-title="Imprimir"
                                                               <span class="glyphicon glyphicon-print"></span></a>-->
                                                        </td>
                                                    </tr>
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
                               
                                <h4 class="modal-title"><strong>Registrar Orden</strong></h4>
                            </div>
                            <form action="orden_compra_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body se">
                                    <input type="hidden" name="accion" value="1">
                                    <input type="hidden" name="vorden" value="0">
                                    <input type="hidden" name="vtotal" value="0">
                                    <input type="hidden" name="estado" value="PENDIENTE">
                                    <input type="hidden" name="vusu" value="<?php echo $_SESSION['cod_usu']; ?>">
                                   <input type="hidden" name="pagina" value="orden_compra_agregar.php">

                                    <!--Inicio Tipo de Articulo-->
                                 <!--Fin Tipo de articulo-->
                                  <!--Inicio Marca-->
                                  
                                  
                                  
                                  <div class="form-group">
                                    <label class="col-md-2 control-label">Tipo de Orden</label>
                                  <div class="row">
                                    <div class="radio col-md-8">
                                        <label>
                                            <input type="radio" name="tipo" value="CPRESU" id="check"> Con Presupuesto
                                        </label>
                                        <label>
                                            <input type="radio" name="tipo" value="CPEDI"  id="check_1"> Con Pedido
                                        </label>                                       
                                    </div>
                                  </div>                                  
                                </div>
                            <div class="form-group">
                                    <label class="col-md-2 control-label">Fecha</label>
                                    <div class="col-md-4">
                                        <input type="date" required="" id="fec"
                                               placeholder="Especifique fecha"
                                               class="form-control"
                                               value="<?php echo date("Y-m-d") ?>" name="vfecha" 
                                               onmouseup="validar()"
                                               onkeyup="validar()"
                                               onchange="validar()"
                                               onclick="validar()"
                                               onkeypress="validar()">
                                    </div>
                                </div>
                                
                                    
                            <div class="form-group" style="display: none" id="ocultar_presupuesto">
                                <label class="col-md-2 control-label">Orden con Presupuesto:</label>
                                <div class="col-md-4">
                                    <?php $ordenescompras = consultas::get_datos("select * from v_presupuesto_compra where estado_presu='CONFIRMADO' order by cod_presu_comp asc"); ?>
                                    <select name="vpresu" 
                                            class="form-control" id="presu" 
                                            onchange="proveedor()"
                                            onkeyup="proveedor()">
                                        <option value="">Seleccione un Presupuesto</option>
                                        <?php
                                        if (!empty($ordenescompras)) {
                                            foreach ($ordenescompras as $ordencompra) {
                                                ?>  
                                                <option value="<?php echo $ordencompra['cod_presu_comp']; ?>">
                                                    <?php echo $ordencompra['descripcion_pedido']; ?>
                                                </option>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <option value="">Debe insertar un Presupuesto</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                             
                                <div class="form-group" style="display: none" id="ocultarproveedor_presu">
                                <label class="col-md-2 control-label">Proveedor:</label>
                                <div class="col-md-4" id="deta_prov_presu">
                                    <select class="form-control" required="">
                                        <option>Seleccione un Proveedor</option>
                                    </select>
                                </div>
                            </div>
                                  
                            <div class="form-group" style="display: none" id="ocultar_pedido">
                                <label class="col-md-2 control-label">Orden con Pedido:</label>
                                <div class="col-md-4">
                                    <?php $ordenescompras = consultas::get_datos("select * from v_pedido_compra where estado_pedido='CONFIRMADO' order by cod_pedi_comp asc"); ?>
                                    <select name="vpedi" 
                                            class="form-control" id="pedi">
                                        <option value="">Seleccione un Pedido</option>
                                        <?php
                                        if (!empty($ordenescompras)) {
                                            foreach ($ordenescompras as $ordencompra) {
                                                ?>  
                                                <option value="<?php echo $ordencompra['cod_pedi_comp']; ?>">
                                                    <?php echo $ordencompra['pedido']; ?>
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
                                    <div class="col-md-4">
                                        <?php
                                        $proveedores = consultas::get_datos("select * from v_proveedor3 order by cod_prov asc"); ?>
                                        <select name="vprov" class="form-control">
                                            <?php 
                                            if (!empty($proveedores)) {
                                                foreach ($proveedores as $proveedor) {
                                                    ?>
                                            <option value="<?php echo $proveedor['cod_prov']; ?>">
                                                    <?php echo $proveedor['persona']; ?></option>
                                            <?php
                                                }
                                            }else {
                                                ?>
                                            <option value="0">Debe seleccionar un Proveedor</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                  
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
            
            function anular(datos) {
                var dat = datos.split("_");
                $('#si').attr('href'
                , 'orden_compra_control.php?vorden=' + dat[0] + 
                        '&vusu=null' +
                        '&vprov=null' +
                        '&vfecha=1900-01-01'+
                        '&estado=ANULADO'+
                        '&vpedi='+ dat[2] +
                        '&vpresu='+ dat[3] +
                        '&vtotal=null'+
                        '&accion=2'+
                        '&pagina=orden_compra_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Anular la Orden del Proveedor <i><strong>' + dat[1] + '</strong></i>?');
            }
            
            function confirmar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href'
                , 'orden_compra_control.php?vorden=' + dat[0] +
                       '&vusu=null' +
                        '&vprov=null' +
                        '&vfecha=1900-01-01'+
                        '&estado=CONFIRMADO'+
                        '&vpedi='+ dat[2] +
                        '&vpresu='+ dat[3] +
                        '&vtotal=null'+
                        '&accion=4'+
                        '&pagina=orden_compra_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Confirmar la Orden del Proveedor: <i><strong>' + dat[1] + '</strong></i>?');
            }
        </script>
        <script>
                        
            function proveedor(){
                    if ((parseInt($('#presu').val()) > 0) || ($('#presu').val() !== "")) {
                        $.ajax({
                            type: "GET",
                            url: "/servitech_tesis/lista_proveedor_presupuesto.php?vpresu=" + 
                                    $('#presu').val (),
                            cache: false,
                            beforeSend: function () {
                                $('#deta_prov_presu').
                            html('<img src="/servitech_tesis/img/cargando.GIF">\n\
                            <strong><i>Cargando...</i><strong>');
                            },
                                    success: function (msg){
                                        $('#deta_prov_presu').html(msg);
//                                        obtenerprecio();
                                    }
                        });
                    }
                }
        </script>
        <script>
            function validar() {
                var hoy = new Date();
                var fechaFormulario = new Date($('#fec').val());
                if (fechaFormulario < hoy) {
                    alert('La fecha debe ser mayor o igual a la actual!!!');
                    $('#fecha').val(hoy);
                    $('#fec').val(hoy);
                }
                else {
//                    $("#ocultar").css("display", "block");
                }
            }
        
            $("#check").click(function() {
                $("#ocultar_presupuesto").css("display", "block");
            });
            
            $("#check_1").click(function() {
                $("#ocultar_presupuesto").css("display", "none");
            });
            
            
             $("#check").click(function() {
                $("#ocultarproveedor_presu").css("display", "block");
            });
            
            $("#check_1").click(function() {
                $("#ocultarproveedor_presu").css("display", "none");
            });
            
        
        
             $("#check_1").click(function() {
                $("#ocultar_pedido").css("display", "block");
            });
            
            $("#check").click(function() {
                $("#ocultar_pedido").css("display", "none");
            });
        
         
        $("#check_1").click(function() {
                $("#ocultarproveedor_pedi").css("display", "block");
            });
            
            $("#check").click(function() {
                $("#ocultarproveedor_pedi").css("display", "none");
            });
        
        
        
        </script>
    </body>
</html>




