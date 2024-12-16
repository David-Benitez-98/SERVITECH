<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SERVITECH</title>

        <?php
        require './ver_sesion.php';
        require 'menu/css.ctp';
        ?>
    </head>
    <body>
        <div id="wrapper">
            <?php require 'menu/navbar.php'; ?><!--BARRA DE HERRAMIENTAS-->
            <div id="page-wrapper">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <h3 class="page-header text-center">Registar Detalles del Presupuesto
                            <a href="presupuesto_servicio_index.php" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel='tooltip' title="Atras">
                                <i class="glyphicon glyphicon-arrow-left"></i>
                            </a> 
                        </h3>
                    </div>                       
                </div>
                <!--               Aqui empieza el cuerpo de la estructura-->
                <div class="row">
                    <div class="col-lg-12">
                        <!--                        este panel headin le agregue yo -->
                        <div class=" panel panel-success">
                            
                            <div class="panel-heading">
                                Datos Cabecera Presupuesto
                             </div> 
                            <!-- /.panel-heading -->
                            
                             <?php  if (isset($_REQUEST['vpresu_servi'])) { ?>
                         <?php    $presupuestoservicios = consultas::get_datos("select * from v_presupuesto_servi where cod_presu_servi=".$_REQUEST['vpresu_servi']); ?>
                             <?php } ?>
                             <?php if (!empty($presupuestoservicios)) { ?>       
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">#Diag</th>
                                                    <th class="text-center">Observacion</th>
                                                    <th class="text-center">Cliente</th>
                                                    <th class="text-center">Funcionario</th>
                                                    <th class="text-center">Sucursal</th>
                                                    <th class="text-center">Fecha</th>
                                                    <th class="text-center">Total</th>
                                                    <th class="text-center">Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($presupuestoservicios as $presupuestoservicio) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $presupuestoservicio['cod_presu_servi']; ?></td>
                                                        <td class="text-center"><?php echo $presupuestoservicio['cod_diagnostico']; ?></td>
                                                        <td class="text-center"><?php echo $presupuestoservicio['observacion']; ?></td>
                                                        <td class="text-center"><?php echo $presupuestoservicio['cliente']; ?></td>
                                                        <td class="text-center"><?php echo $presupuestoservicio['usuario']; ?></td>
                                                        <td class="text-center"><?php echo $presupuestoservicio['suc_descri']; ?></td>
                                                        <td class="text-center"><?php echo $presupuestoservicio['vfecha']; ?></td>
                                                        <td class="text-center"><?php echo $presupuestoservicio['total']; ?></td>
                                                        <td class="text-center"><?php echo $presupuestoservicio['estado']; ?></td>
                                                        
                                                        
                                                    </tr>
                                                    
                                                <?php } ?>
                                            </tbody>
                                        </table>                         
                                    </div>
                                <?php } else { ?>
                                    <div class="alert alert-info alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <strong>No se encontro registro....!</strong>
                                    </div>
                                <?php } ?>  
                                <!-- /.panel-body -->
                            </div>
                                
                        </div>
<!--                Aqui Termina la Estructura Cabecera-->

                    <!-- COMIENZO PARA EL DETALLE PRESUPUESTO-->
                    
                      <?php  if (isset($presupuestoservicios[0]['cod_presu_servi'])) { ?>
                                        <?php $detpresupuestoservicios = consultas::get_datos("select * from v_deta_presu_servi "
                                                        . " where cod_presu_servi = " . $_REQUEST['vpresu_servi']); ?>  
                                        
                                        <?php }?>
                        <!-- /.col-lg-12 -->
                                
                        <div class="col-lg-12">
                            
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                Detalles Presupuesto de Servicio
                            </div>
                            <?php if (!empty($detpresupuestoservicios)) { ?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Repuesto</th>
                                                <th class="text-center">Imagen</th>
                                                <th class="text-center">Cant Rep</th>
                                                <th class="text-center">Prec Rep</th>
                                                <th class="text-center">Equipo</th>
                                                <th class="text-center">Tipo Serv</th>
                                                <th class="text-center">Prec Serv</th>
                                                <th class="text-center">Desc/Prom</th>
                                                <th class="text-center">Monto Serv</th>
                                                <th class="text-center">Sub</th>
                                                <th class="text-center">Estado</th>
<!--                                                <th class="text-center">Acción</th>-->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($detpresupuestoservicios as $detpresupuestoservicio) { ?> 
                                                    <tr>
                                                    <td class="text-center"><?php echo $detpresupuestoservicio['cod_art']; ?></td>
                                                    <td class="text-center"><?php echo $detpresupuestoservicio['art_descri']; ?></td>
                                                    <td class="text-center"> 
                                                        <img height="45px" src="img/<?php echo $detpresupuestoservicio['art_imagen'];?>" /> </td>
                                                    <td class="text-center"><?php echo $detpresupuestoservicio['cantidad_arti']; ?></td>
                                                    <td class="text-center"><?php echo number_format($detpresupuestoservicio['precio'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo $detpresupuestoservicio['dat_equipo']; ?></td>
                                                    <td class="text-center"><?php echo $detpresupuestoservicio['descri_servicio']; ?></td>
                                                    <td class="text-center"><?php echo number_format($detpresupuestoservicio['precio_tipo_servi'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detpresupuestoservicio['total_desc_y_promo'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detpresupuestoservicio['monto_servi'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detpresupuestoservicio['subtotal'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo $detpresupuestoservicio['estado']; ?></td>
                                                     <td>
                                                        <?php   if ($detpresupuestoservicio['estado']=='CONFIRMADO' || $presupuestoservicios[0]['estado']=='CONFIRMADO' 
                                                                || $presupuestoservicios[0]['estado']=='RECHAZADO' || $presupuestoservicios[0]['estado']=='ANULADO'
                                                                || $presupuestoservicios[0]['estado']=='TERMINADO' ){?>
                                                         
                                                         <?php }else {?>
                                                        <a onclick="borrar(<?php echo "'".$_REQUEST['vpresu_servi'] . "_" .
                                                        $detpresupuestoservicio['cod_equipo'] . "_" .
                                                        $detpresupuestoservicio['cod_tipo_servi'] . "_" .
                                                        $detpresupuestoservicio['art_descri'] . "_" .  
                                                        $detpresupuestoservicio['dat_equipo'] . "_" .  
                                                        $_REQUEST ['vdiag']. "'"
                                                        ?>)"
                                                           class="btn btn-xs btn-danger"
                                                           rel="tooltip" data-title="Borrar"
                                                           data-toggle="modal"
                                                           data-target="#delete">
                                                            <span class="glyphicon glyphicon-trash"></span></a>
                                                            
                                                         <?php } ?>
                                                    </td>
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
                                            <strong>No se encontraron detalles para el presupuesto....!</strong>
                                        </div>
                                    </div>
                                
                            <?php } ?>
                        </div>
                        </div>
                            
                        </div>
                    
                    
                    
                      <!-- COMIENZO PARA EL DETALLE DEL DIAGNOSTICO-->
                    <?php  if (isset($_REQUEST['vdiag'])) { ?>
                    <?php $detdiagnosticos = consultas::get_datos
                    ("select * from v_deta_diagnostico where cod_diagnostico=" . $_REQUEST['vdiag'] . " order by cod_equipo asc");?>
                    <?php } ?>
                <div class="col-lg-12">
                    
                        <!-- <div class="col-md-12">-->
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                Detalles del Diagnostico
                            </div>
                            <?php if (!empty($detdiagnosticos)) { ?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Equipo</th>
                                                <th>Tipo Servicio</th>
                                                <th>Impuesto</th>
                                                <th>Estado</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($detdiagnosticos as $detdiagnostico) { ?>
                                                <tr>
                                                    <td><?php echo $detdiagnostico['cod_diagnostico']; ?></td>
                                                    <td><?php echo $detdiagnostico['datos_equipos']; ?></td>
                                                    <td><?php echo $detdiagnostico['tipo_servicio_descri']; ?></td>
                                                    <td><?php echo $detdiagnostico['imp_descri']; ?></td>
                                                    <td><?php echo $detdiagnostico['estado']; ?></td>
                                                    <td class="text-center">
                                                        
                                                      <?php   if ($detdiagnostico['estado']=='CONFIRMADO' || $presupuestoservicios[0]['estado']=='CONFIRMADO' 
                                                                || $presupuestoservicios[0]['estado']=='RECHAZADO' || $presupuestoservicios[0]['estado']=='ANULADO'
                                                                || $presupuestoservicios[0]['estado']=='TERMINADO' ){
                                                          
                                                      } else { ?>
                                                     <a onclick="diag_confirma(<?php
                                                        echo "'" . $detdiagnostico['cod_diagnostico'] . "_" .$detdiagnostico['cod_equipo'] . "_" .
                                                        $detdiagnostico['cod_tipo_servi'] . "'";
                                                        ?>),obtenerprecioservi();" 
                                                           class="btn btn-xs btn-primary" rel='tooltip' data-title="Confirmar" 
                                                           data-toggle="modal" data-target="#pedi_confi">
                                                            <span class="glyphicon glyphicon-ok-sign"></span></a>
                                                        
                                                    </td>
                                                </tr>
                                                 
                                             
                                               <?php } ?>
                                                
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } else { ?>
                                    <div class="col-md-12">
                                        <div class="alert alert-dismissable alert-dismissable">
                                            <button type="button" class="close"
                                                    data-dismiss="alert" aria-hidden="true">&times;
                                            </button>
                                            <strong>No se encontraron detalles....!</strong>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
    
                </div>
                    
                    
                         
                      
                         
                        </div>

<!-- COMIENZO PARA EL DETALLE AQUI VA UNA TABLA PARA AGREGAR EL DETALLE-->
 <!-- /.col-lg-12 -->


<!--confirmar - registrar pedido-->

                <div id="pedi_confi" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg ">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" 
                                        data-dismiss="modal" arial-label="Close">x</button>
                                <h4 class="modal-title text-center"><strong>REGISTRAR DETALLE DE PRESUPUESTO</strong></h4>
                            </div>
                            <form action="presupuesto_servicio_control_deta.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body">
                                    <input name="accion" value="1" type="hidden"/>
                                    <input type="hidden" name="pagina" value="presupuesto_servicio_agregar.php">
                                    <input type="hidden" name="vpresu_servi" value="<?php echo $_REQUEST['vpresu_servi'] ?>">
                                    <input type="hidden" name="vdiag" value="<?php echo $_REQUEST['vdiag'] ?>">
                                    <input type="hidden" name="vestado" value="CONFIRMADO">
                                    <input type="hidden" name="vequi" id="equipos" value="">
                                    <input type="hidden" name="vtipo_servi" id="tipos" value="">
                                    <input type="hidden"  id="articuloinvisible" name="articuloinvisible" value="">
                                    <input type="hidden"  id="deposito_oculto" name="vdepo_oculto" value="">
                                    <input type="hidden"  id="precio_art_oculto" name="vprecio_art_oculto" value="">
                                    <input type="hidden"  id="desc_oculto" name="vdesc_oculto" value="">
                                    <input type="hidden"  id="precio_servi_oculto" name="vprecio_servi_oculto" value="">

                                    <span class="col-md-1"></span>
                                    <div class="form-group">

                                   <div class="col-md-6"> 
                                       <label class="col-md-1 control-label">EQUIPO:</label>
                                    <?php $equipos = consultas::get_datos("select * from v_equipos order by cod_equipo asc"); ?>
                                    
                                    <select  
                                        class="form-control" id="equipo" disabled=""
                                            >
<!--                                        <option value="0">Seleccione un Articulo</option>-->
                                        <?php
                                        if (!empty($equipos)) {
                                            foreach ($equipos as $equipo) {
                                                ?>  
                                                <option value="<?php echo $equipo['cod_equipo']; ?>">
                                                    <?php echo $equipo['datos_equipos']; ?>
                                                </option>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <option value="">Debe insertar un Equipo</option>
                                        <?php } ?>
                                    </select>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <label class="col-md-1 control-label">ARTICULO:</label>
                                    <?php $articulos = consultas::get_datos("select * from v_articulos_2 where cod_tipo_arti = 4 OR cod_tipo_arti = 3 OR cod_tipo_arti = 7 order by cod_art asc"); ?>
                                    
                                    <select  
                                        class="form-control" name="varti" id="artic" onchange="deposito(), obtenerprecioarti(), calsubtotal(), caltotal()"
                                        onkeypress="deposito(), obtenerprecioarti()" onkeyup="calsubtotal(), caltotal()">
<!--                                        <option value="0">Seleccione un Articulo</option>-->
                                        <?php
                                        if (!empty($articulos)) {
                                            foreach ($articulos as $articulo) {
                                                ?>  
                                                <option value="<?php echo $articulo['cod_art']; ?>">
                                                    <?php echo $articulo['dato_articulo']; ?>
                                                </option>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <option value="">Debe insertar un Articulo</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                        
                                        
                                    </div>
                                    <span class="col-md-1"></span>
                                    
                                    <div class="form-group">
                                        
                                        <div class="col-md-6">
                                            
                                            <label class="col-md-1 control-label">TIPO SERVICIO:</label>
                                    <?php $tipos_servicios = consultas::get_datos("select * from v_tipo_servicios2 order by cod_tipo_servi asc"); ?>
                                    
                                    <select 
                                        class="form-control" id="tipo" disabled=""  onchange="obtenerprecioservi()"
                                            onkeypress="obtenerprecioservi()">
<!--                                        <option value="0">Seleccione un Articulo</option>-->
                                        <?php
                                        if (!empty($tipos_servicios)) {
                                            foreach ($tipos_servicios as $tipo_servicio) {
                                                ?>  
                                                <option value="<?php echo $tipo_servicio['cod_tipo_servi']; ?>">
                                                    <?php echo $tipo_servicio['tipo_servicio_descri']; ?>
                                                </option>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <option value="">Debe insertar un Tipo de Servicio</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                        
                                        <br>
                                        
                                        <div class="col-md-4" id="detalles">
                                            <label class="col-md-1 control-label">DEPOSITO</label>
                                                <select class="form-control" required="">
                                                    <option>Seleccione un deposito</option>
                                                </select>
                                            </div>
                                        
                                        
                                        
                                    </div>
                                    <span class="col-md-1"></span>
                                    
                                    <div class="form-group">
                                        
                                        <div class="col-md-4" id="deta_precio_servi">
                                        <br>
                                        <label class="col-md-1 control-label">PRECIO SERV.</label>
                                            <input type="number" required="" readonly="" 
                                                   placeholder="Precio Servicio" value="0"
                                                   class="form-control" name="vprecio_servi" id="precio_servi">
                                             
                                        </div>
                                        <br>
                                       
                                        <span class="col-md-1"></span>
                                        <span class="col-md-1"></span>
                                        <div class="col-md-4 " id="deta_precio_arti">
                                           
                                            <label class="col-md-1 control-label">PRECIO ART.:</label>
                                                <input type="number" required=""
                                                       class="form-control" value="0"
                                                       readonly="" id="precio_art" name="v_precio_art">
                                            </div>
                                        
                                    </div>
                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                        
                                        <div class="col-md-4" id="deta_desc_servi">
                                         <br>
                                       
                                        <label class="col-md-1 control-label">DESC O PROMO</label>
                                            <input type="number" required="" readonly="" 
                                                   placeholder="Total" value="0"
                                                   class="form-control" 
                                                   onchange="caldescuento()"
                                                   onkeyup="caldescuento()"
                                                   onmouseup="caldescuento()">
                                             
                                        </div>
                                        
                                        <span class="col-md-1"></span>
                                        <span class="col-md-1"></span>
                                        
                                        <div class="col-md-4">
                                           <BR>
                                            <label class="col-md-1 control-label">CANTIDAD:</label>
                                                <input type="number" required=""
                                                       class="form-control" value="0" min="1"
                                                       id="canti_art" name="vcant" 
                                                       onchange="calsubtotal(), caltotal()"
                                                       onkeyup="calsubtotal(), caltotal()">
                                            </div>
                                        
                                    </div>
                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                        
                                        <div class="col-md-3" id="deta_desc_servi">
                                         <br>
                                       
                                        <label class="col-md-1 control-label">SUBTOTAL SERV</label>
                                            <input type="number" required="" readonly="" 
                                                   placeholder="Total" value="0"
                                                   class="form-control" name="vdiferencia" id="resul_dife">
                                             
                                        </div>
                                        
                                       
                                        <div class="col-md-3">
                                            <br>
                                          
                                            <label class="col-md-1 control-label">SUBTOTAL ART:</label>
                                                <input type="number" required=""
                                                       class="form-control" value="0"
                                                       readonly="" id="subtotal_arti" name="vsubtotal_arti" >
                                            </div>
                                        
                                        <div class="col-md-4">
                                            
                                            <span class="col-md-1"></span> <span class="col-md-1"></span> <label class="col-md-1 control-label"><h3>TOTAL:</h3></label>
                                                <input type="number" required=""
                                                       class="form-control" value="0"
                                                       readonly="" id="total_presu_servi" name="vtotal_presu_servi" >
                                            </div>
                                        
                                    </div>
                                    
<!--                                     <span class="col-md-1"></span>
                                    <div class="form-group">
                                        
                                        <span class="col-md-1"></span>
                                        <span class="col-md-1"></span>
                                        <span class="col-md-1"></span>
                                        <div class="col-md-4">
                                            
                                            <span class="col-md-1"></span> <span class="col-md-1"></span> <label class="col-md-1 control-label"><h3>TOTAL:</h3></label>
                                                <input type="number" required=""
                                                       class="form-control" value="0"
                                                       readonly="" id="total_presu_servi" name="vtotal_presu_servi" >
                                            </div>
                                        
                                    </div>-->
                                    
                                   


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

<!--                fin registrar-->            
                

    </div>
                    
 </div>

                
            </div >
            
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
                                            
                                    

        <!--archivos js-->  
        <?php require 'menu/js.ctp'; ?>
        
        <script>
            
            function diag_confirma(datos) {
                var dat = datos.split("_");
                $('#cod').val(dat[0]);
                $('#equipo').val(dat[1]);
                $('#tipo').val(dat[2]);
                $('#equipos').val(dat[1]);
                $('#tipos').val(dat[2]);
                
                console.log(dat[2]);


            }
             $("document").ready(function () {
                    //diag_confirma();
                    deposito();
                   obtenerprecioarti();
                   obtenerprecioservi();
                   obtenerdescuentoservi();
//                   calsubtotal();
                });
                
            function deposito(){
                    if ((parseInt($('#artic').val()) > 0) || ($('#artic').val() !== "")) {
                        $.ajax({
                            type: "GET",
                            url: "/servitech_tesis/lista_deposito_compra2.php?varti=" + 
                                    $('#artic').val (),
                            cache: false,
                            beforeSend: function () {
                                $('#detalles').
                            html('<img src="/servitech_tesis/img/cargando.GIF">\n\
                            <strong><i>Cargando...</i><strong>');
                            },
                                    success: function (msg){
                                        $('#detalles').html(msg);
//                                        obtenerprecio();
                                        obtenerprecioarti();
                                    $('#deposito_oculto').val($('#dep').val());
                                    }
                        });
                        
                        $('#articuloinvisible').val($('#artic').val());
                        
                        
                    }
      
                }
                
                 function obtenerprecioarti(){
                    if ((parseInt($('#artic').val()) > 0) || ($('#artic').val() !== "")) {
                        $.ajax({
                            type: "GET",
                            url: "/servitech_tesis/lista_precio_articulos.php?varti=" + 
                                    $('#artic').val (),
                            cache: false,
                            beforeSend: function () {
                                $('#deta_precio_arti').
                            html('<img src="/servitech_tesis/img/cargando.GIF">\n\
                            <strong><i>Cargando...</i><strong>');
                            },
                                    success: function (msg){
                                        $('#deta_precio_arti').html(msg);
                                        $('#precio_art_oculto').val($('#precio_art').val());
//                                        calsubtotal();
                                    }
                        });
                    }
                }
                
                function obtenerprecioservi(){
                    if ((parseInt($('#tipo').val()) > 0) || ($('#tipo').val() !== "")) {
                        $.ajax({
                            type: "GET",
                            url: "/servitech_tesis/lista_precio_servicio.php?vtipo_servi=" + 
                                    $('#tipo').val (),
                            cache: false,
                            beforeSend: function () {
                                $('#deta_precio_servi').
                            html('<img src="/servitech_tesis/img/cargando.GIF">\n\
                            <strong><i>Cargando...</i><strong>');
                            },
                                    success: function (msg){
                                        $('#deta_precio_servi').html(msg);
                                        $('#precio_servi_oculto').val($('#precio_servi').val());
//                                        obtenerprecio();
                                      obtenerdescuentoservi();
                                    }
                        });
                        
                    }
                }
                
                function obtenerdescuentoservi(){
                    if ((parseInt($('#tipo').val()) > 0) || ($('#tipo').val() !== "")) {
                        $.ajax({
                            type: "GET",
                            url: "/servitech_tesis/lista_descuento_servicio.php?vtipo_servi=" + 
                                    $('#tipo').val (),
                            cache: false,
                            beforeSend: function () {
                                $('#deta_desc_servi').
                            html('<img src="/servitech_tesis/img/cargando.GIF">\n\
                            <strong><i>Cargando...</i><strong>');
                            },
                                    success: function (msg){
                                        $('#deta_desc_servi').html(msg);
                                        $('#desc_oculto').val($('#desc').val());
                                        caldescuento();
                                    }
                        });
                    }    
                }
                

            function caldescuento(){
          
              var total_descuento = 0;
              var descuento = parseInt($('#desc').val());
              var precio_servi = parseInt($('#precio_servi').val());
              
              total_descuento = precio_servi  - descuento;
              
             $("#resul_dife").val(total_descuento);
           //  --------------------------------------//
             
            }
            function calsubtotal(){
          
              var subtotal = 0;
              var cantidad = parseInt($('#canti_art').val());
              var precio_articulo = parseInt($('#precio_art').val());
              
              subtotal = precio_articulo * cantidad;
             
             $("#subtotal_arti").val(subtotal);
           //  --------------------------------------//
            }
            
            function caltotal(){
                
             //calculos para subtotal servicio
              var total_descuento = 0;
              var descuento = parseInt($('#desc').val());
              var precio_servi = parseInt($('#precio_servi').val());
              total_descuento = precio_servi  - descuento;
              
              //calculos para subtotal articulo
              var subtotal = 0;
              var cantidad = parseInt($('#canti_art').val());
              var precio_articulo = parseInt($('#precio_art').val());
              subtotal = precio_articulo * cantidad;
             
             //calculos para subtotal presupuesto
               var total = 0;
               total = total_descuento + subtotal;
              $("#total_presu_servi").val(total);
            }
            
            function borrar(datos) {
                    var dat = datos.split("_");
                    $('#si').attr('href',
                    'presupuesto_servicio_control_deta.php?vpresu_servi=' + dat[0] +
                            '&vtipo_servi=' + dat[2] +
                            '&vequi=' + dat[1] +
                            '&articuloinvisible=null' +
                            '&vdepo_oculto=null' +
                            '&vcant=null' +
                            '&vtotal_presu_servi=null' +
                            '&vprecio_art_oculto=null' +
                            '&vestado=null' +
                            '&vdiferencia=null' +
                            '&vdesc_oculto=null' +
                            '&vdiag=' + dat[5] +
                            '&accion=2' +
                            '&pagina=presupuesto_servicio_agregar.php');
                    $('#confirmacion').html
                    ('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Borrar el Presupuesto del Equipo <i><strong>' + dat[4] + ' con el Repuesto o Art. ' + dat[3] + '</strong></i> ?')
                
                }
                
                
               
            
            
        
        </script>
        
       

    </body>
</html>




