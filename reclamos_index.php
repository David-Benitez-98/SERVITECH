<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SERVITECH SYS-RECLAMOS</title>

        <?php
        require './ver_sesion.php';
        //require './anular_sesion.php'; #este es para bloquear la url
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
                        
                        <h2 class="page-header text-center">Listado de Reclamos de Servicios
                            
                            <a data-toggle="modal" data-target="#registrar" 
                               class="btn btn-primary btn-microsoft pull-right" 
                               rel="tooltip" data-title="Registrar Nota">
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
                
                <!--                       Tabla para el listado de salidas-->
                <div class="row">
                    <div class="col-lg-12">

                        <div class="panel panel-success panel-body">
                            <div class="panel-heading">
                                Datos de Notas de Reclamos
                            </div>
                            <?php
                            $reclamos= consultas::get_datos("select * from v_reclamos where cod_suc=".$_SESSION['cod_suc']. "
                             and suc_descri='".$_SESSION['suc_descri']. "' order by cod_reclamo asc ");
                            if (!empty($reclamos)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">#Serv</th>
                                                    <th class="text-center">N°Factu</th>
                                                    <th class="text-center">Cliente</th>
                                                    <th class="text-center">Fecha</th>
                                                    <th class="text-center">Motivo</th>
                                                    <th class="text-center">Recepcionista</th>
                                                    <th class="text-center">Sucursal</th>
                                                    <th class="text-center">Estado</th>
                                                    <th class="text-center">Accion</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($reclamos as $reclamo) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $reclamo['cod_reclamo']; ?></td>
                                                        <td class="text-center"><?php echo $reclamo['cod_presu_servi']; ?></td>
                                                        <td class="text-center"><?php echo $reclamo['nro_factura']; ?></td>
                                                        <td class="text-center"><?php echo $reclamo['cliente']; ?></td>
                                                        <td class="text-center"><?php echo $reclamo['vfecha']; ?></td>
                                                        <td class="text-center"><?php echo $reclamo['motivo']; ?></td>
                                                        <td class="text-center"><?php echo $reclamo['usuario']; ?></td>
                                                        <td class="text-center"><?php echo $reclamo['suc_descri']; ?></td>
                                                        <td class="text-center"><?php echo $reclamo['estado']; ?></td>
                                                        
                                                        <td class="text-center">
                                                            
                                                            <?php if($reclamo['estado']=='PENDIENTE'){ ?>
                                                            
                                                            <a href="imprimir_reclamos.php?vrecla=<?php echo $reclamo['cod_reclamo']; ?>"
                                                                   target="_blank"
                                                                   class="btn btn-xs btn-success"
                                                                   rel="tooltip" data-title="imprimir">
                                                                    <span class="glyphicon glyphicon-print"></span></a>
                                                                
                                                                <a onclick="rechazar(<?php echo "'".$reclamo['cod_reclamo']."_".$reclamo['cod_factura']."_".$reclamo['nro_factura']."_".$reclamo['cliente']."'"; ?>)"
                                                               class="btn btn-xs btn-danger" rel='tooltip' data-title="Rechazar Reclamo"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-ban-circle"></span></a>
                                                                
                                                           <?php }else if($reclamo['estado']=='RECHAZADO'){?>
                                                                 <a href="imprimir_reclamos.php?vrecla=<?php echo $reclamo['cod_reclamo']; ?>"
                                                                   target="_blank"
                                                                   class="btn btn-xs btn-success"
                                                                   rel="tooltip" data-title="imprimir">
                                                                    <span class="glyphicon glyphicon-print"></span></a>
                                                                
                                                            <?php }?>
                                                            
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
                        

                        <!-- /.panel -->
                    </div>
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
                               
                                <h4 class="modal-title"><strong>Registrar Reclamo</strong></h4>
                            </div>
                            <form action="reclamos_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body se">
                                    <input type="hidden" name="accion" id="accion" value="1">
                                    <input type="hidden" name="vrecla" id="vrecla" value="0">
                                    <input type="hidden" name="vestado" value="ACTIVO">
                                    <input type="hidden" name="vcod_usu" id="vcod_usu" value="<?php echo $_SESSION['cod_usu']; ?>">
                                    <input type="hidden" name="vsuc" value="<?php echo $_SESSION['cod_suc']; ?>">
                                    <input type="hidden" name="pagina" value="reclamos_index.php">
                                    
                                <!--Inicio campos Presupuesto-->
                                
                                <!-- Grupo de la primera fila-->
                                    <!--desde aqui-->
                                    <!-- Campo fecha-->
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Fecha Inicio:</label>
                                        <div class="col-md-4">
                                            
                                            <input type="date" required="" id="vfecha"
                                                   placeholder="Especifique fecha"
                                                   class="form-control"
                                                   name="vfecha"
                                                   value="<?php echo date("Y-m-d") ?>"
                                                   readonly=""
                                       </div>
                                    </div>
                                
                                 </div>
                                <br>
                                <div class="form-group">
                                <label class="col-md-2 control-label">Factura:</label>
                                <div class="col-md-7">
                                    <?php $facturas = consultas::get_datos("select * from factura_cab where ven_estado='CONFIRMADO' AND ven_total!= 0 order by cod_factura asc"); ?>
                                    <select name="vfactu" 
                                            class="form-control" id="factu" 
                                            onchange="cliente(),presupuesto()"
                                            onkeyup="cliente(),presupuesto()"
                                            
                                            required="">
<!--                                        <option value="0">Seleccione una Compra</option>-->
                                        <?php
                                        if (!empty($facturas)) {
                                            foreach ($facturas as $factura) {
                                                ?>  
                                                <option value="<?php echo $factura['cod_factura']; ?>">
                                                    <?php echo "Cod:".$factura['cod_factura']. " - Factura N°: " . $factura['nro_factura']. " - Fecha: " . $factura['ven_fecha']; ?>
                                                </option>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <option value="">Debe insertar una Factura</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                </div>
                                 <br>
                        
                                <div class="form-group">
                                        <label class="col-md-2 control-label">Cliente:</label>
                                        <div class="col-md-9" id="detalles">
                                            <select class="form-control" required="" readonly="" >
                                                <option>Seleccione un cliente</option>
                                            </select>
                                        </div>
                                        </div>
                                     <br>
                                     
                                     <br>
                        
                                <div class="form-group">
                                        <label class="col-md-2 control-label">Servicio:</label>
                                        <div class="col-md-10" id="detalles_2">
                                            <select class="form-control" required="">
                                                <option>Seleccione un servicio</option>
                                            </select>
                                        </div>
                                        </div>
                                     <br>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Sucursal:</label>
                                        <div class="col-md-4">
                                            <input type="text" required="" placeholder="Ingrese Sucursal" readonly="" 
                                                   class="form-control" value="<?php echo $_SESSION['suc_descri']; ?>">
                                        </div>
                                        <!-- Campo Sucursal-->
                                        
                                    </div>
                            <br>
<!--                            Campos Depositos-->
                                
                                    <div class="form-group">
                                    <label class="col-md-2 control-label">Motivo:</label>
                                        <div class="col-md-4">
                                            <input type="text" required="" placeholder="Ingrese Motivo" name="vmotivo"
                                                   class="form-control" value="" required="">
                                        </div>
                                    
                                    </div>
                                <!--Fin Campos-->  
                                 
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


                <!--anular-->
                <div class="modal fade" id="delete" tabindex="-1" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title custom_align" id="Heading">Atenci&oacute;n!!!</h4>
                            </div>
                            <div class="modal-body">

                                <div class="alert alert-warning" id="borrar"></div>

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
            function rechazar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href'
                , 'reclamos_control.php?vrecla=' + dat[0] +
                        '&vmotivo=null' +
                        '&vfecha=1900-01-01' +
                        '&vestado=RECHAZADO' +
                        '&vsuc=null' +
                        '&vcod_usu=null' +
                        '&vfactu=' + dat[1] +
                        '&vcli=null' +
                        '&accion=2'+
                        '&pagina=reclamos_index.php');
                $('#borrar').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Rechazar el Reclamo del Cliente:<i><strong> ' + dat[2] + ' de la Factura: ' + dat[3] + ' </strong></i>?');
            }
            
            $("document").ready(function () {
                    cliente();
                });
         
             function cliente(){
                    if ((parseInt($('#factu').val()) > 0) || ($('#factu').val() !== "")) {
                        $.ajax({
                            type: "GET",
                            url: "/servitech_tesis/lista_cliente_factura_1.php?vfactu=" + 
                                    $('#factu').val (),
                            cache: false,
                            beforeSend: function () {
                                $('#detalles').
                            html('<img src="/servitech_tesis/img/cargando.GIF">\n\
                            <strong><i>Cargando...</i><strong>');
                            },
                                    success: function (msg){
                                        $('#detalles').html(msg);
                                    }
                        });
                        
                        
                    }
                    else if ((parseInt($('#factu').val() === "0"))){
                        $('#factu').val('');
                 }       
                }
                
                 function presupuesto(){
                    if ((parseInt($('#factu').val()) > 0) || ($('#factu').val() !== "")) {
                        $.ajax({
                            type: "GET",
                            url: "/servitech_tesis/lista_presu_factura.php?vfactu=" + 
                                    $('#factu').val (),
                            cache: false,
                            beforeSend: function () {
                                $('#detalles_2').
                            html('<img src="/servitech_tesis/img/cargando.GIF">\n\
                            <strong><i>Cargando...</i><strong>');
                            },
                                    success: function (msg){
                                        $('#detalles_2').html(msg);
                                    }
                        });
                        
                        
                    }
                    else if ((parseInt($('#factu').val() === "0"))){
                        $('#factu').val('');
                 }       
                }
        </script>
    </body>
</html>


