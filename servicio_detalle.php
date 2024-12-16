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
        require 'menu/css.ctp';
        ?>
    </head>
    <body>
        <div id="wrapper">
            <?php require 'menu/navbar.php'; ?><!--BARRA DE HERRAMIENTAS-->
            <div id="page-wrapper">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <h3 class="page-header text-center alert-warning">DETALLES DEL SERVICIO TERMINADO
                            <a href="servicio_index.php" 
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
                                Datos Cabecera Orden de Compra 
                             </div> 
                            <!-- /.panel-heading -->
                            
                            <?php  if (isset($_REQUEST['vservi'])) { ?>
                         <?php    $ordentrabajos = consultas::get_datos("select * from v_servicio where cod_servicio=".$_REQUEST['vservi']); ?>
                             <?php } ?>
                             <?php if (!empty($ordentrabajos)) { ?>
                              
                                                       
                                
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table  width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#SERVI</th>                                        
                                                    <th class="text-center">#ORDEN</th>
                                                    <th class="text-center">#PRESU</th>
                                                    <th class="text-center">FECHA</th>
                                                    <th class="text-center">SUCURSAL</th>
                                                    <th class="text-center">CLIENTE</th>
                                                    <th class="text-center">ESTADO</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($ordentrabajos as $ordentrabajo) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $ordentrabajo['cod_servicio']; ?></td>
                                                        <td class="text-center"><?php echo $ordentrabajo['cod_orden_trabajo']; ?></td>
                                                        <td class="text-center"><?php echo $ordentrabajo['cod_presu_servi']; ?></td>
                                                        <td class="text-center"><?php echo $ordentrabajo['fecha']; ?></td>
                                                        <td class="text-center"><?php echo $ordentrabajo['suc_descri']; ?></td>
                                                        <td class="text-center"><?php echo $ordentrabajo['datos_ciente']; ?></td>
                                                        <td class="text-center"><?php echo $ordentrabajo['estado']; ?></td>
                                                        
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
<!-- COMIENZO PARA EL DETALLE ORDEN-->
                    
                      <?php  if (isset($ordentrabajos[0]['cod_orden_trabajo'])) { ?>
                                        <?php $detordentrabajos = consultas::get_datos("select * from v_deta_orden_trabajo "
                                                        . " where cod_orden_trabajo = " . $_REQUEST['vorden_trab']); ?>  
                                        
                                        <?php }?>
                        <!-- /.col-lg-12 -->
                                
                        <div class="col-lg-12">
                            
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                Detalles Orden de Trabajo
                            </div>
                            <?php if (!empty($detordentrabajos)) { ?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                <th class="text-center">Tecnico</th>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Repuestos</th>
                                                <th class="text-center">Imagen</th>
                                                <th class="text-center">Cant Rep</th>
                                                <th class="text-center">Deposito</th>
                                                <th class="text-center">Equipo</th>
                                                <th class="text-center">Tipo Serv</th>
                                                <th class="text-center">Estado</th>
<!--                                                <th class="text-center">Acción</th>-->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($detordentrabajos as $detordentrabajo) { ?> 
                                                    <tr>
                                                    <td class="text-center"><?php echo $detordentrabajo['persona']; ?></td>
                                                    <td class="text-center"><?php echo $detordentrabajo['cod_art']; ?></td>
                                                    <td class="text-center"><?php echo $detordentrabajo['art_descri']; ?></td>
                                                    <td class="text-center"> 
                                                        <img height="45px" src="img/<?php echo $detordentrabajo['art_imagen'];?>" /> </td>
                                                    <td class="text-center"><?php echo $detordentrabajo['art_cantidad']; ?></td>
                                                    <td class="text-center"><?php echo $detordentrabajo['dep_descri']; ?></td>
                                                    <td class="text-center"><?php echo $detordentrabajo['dat_equipo']; ?></td>
                                                    <td class="text-center"><?php echo $detordentrabajo['descri_servicio']; ?></td>
                                                    <td class="text-center"><?php echo $detordentrabajo['estado_deta']; ?></td>
                                                     <td>
<!--                                                          <?php   if ($detordentrabajos[0]['estado_deta']=='CONFIRMADO' ||  $ordentrabajos[0]['estado']=='CONFIRMADO' || $ordentrabajos[0]['estado']=='ANULADO' || $ordentrabajos[0]['estado']=='EN INSUMO' || $ordentrabajos[0]['estado']=='TERMINADO'){?>
                                                         
                                                         <?php }else {?>
                                                        <a onclick="borrar(<?php echo "'".$_REQUEST['vorden_trab'] . "_" .
                                                        $detordentrabajo['cod_equipo'] . "_" .
                                                        $detordentrabajo['cod_tipo_servi'] . "_" .
                                                        $detordentrabajo['persona'] . "_" .  
                                                        $detordentrabajo['descri_equipo'] . "_" .  
                                                        $_REQUEST ['vpresu_servi']. "'"
                                                        ?>)"
                                                           class="btn btn-xs btn-danger"
                                                           rel="tooltip" data-title="Borrar"
                                                           data-toggle="modal"
                                                           data-target="#delete">
                                                            <span class="glyphicon glyphicon-trash"></span></a>-->
                                                            
                                                         
                                                    </td>
                                                    </tr>
                                                     
                                               <?php } ?>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                <?php } else { ?>
                                    <div class="col-md-12">
                                        <div class="alert alert-info alert-dismissable">
                                            <button type="button" class="close"
                                                    data-dismiss="alert" aria-hidden="true">&times;
                                            </button>
                                            <strong>No se encontraron detalles para la orden....!</strong>
                                        </div>
                                    </div>
                                
                            <?php } ?>
                        </div>
                        </div>
                            
                        </div>
                    <!-- COMIENZO PARA EL DETALLE PRESUPUESTO-->
                    
                      <?php  if (isset($ordentrabajos[0]['cod_presu_servi'])) { ?>
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
                                                <th class="text-center">Repuestos</th>
                                                <th class="text-center">Imagen</th>
                                                <th class="text-center">Cant Rep</th>
                                                <th class="text-center">Prec Rep</th>
                                                <th class="text-center">Equipo</th>
                                                <th class="text-center">Tipo Serv</th>
                                                <th class="text-center">Prec Serv</th>
                                                <th class="text-center">Desc/Promo</th>
                                                <th class="text-center">Monto Serv</th>
                                                <th class="text-center">Subtotal</th>
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
                                                    <td class="text-center"><?php echo $detpresupuestoservicio['descri_equipo']; ?></td>
                                                    <td class="text-center"><?php echo $detpresupuestoservicio['descri_servicio']; ?></td>
                                                    <td class="text-center"><?php echo number_format($detpresupuestoservicio['precio_tipo_servi'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detpresupuestoservicio['desc_promo_servi'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detpresupuestoservicio['monto_servi'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detpresupuestoservicio['subtotal'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo $detpresupuestoservicio['estado']; ?></td>
                                                     <td class="text-center">
                                                        
                                                        
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
                                <h4 class="modal-title text-center"><strong>REGISTRAR DETALLE ORDEN DE TRABAJO</strong></h4>
                            </div>
                            <form action="orden_trabajo_serv_control_deta.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body">
                                    <input name="accion" value="1" type="hidden"/>
                                    <input type="hidden" name="pagina" value="orden_trabajo_serv_agregar.php">
                                    <input type="hidden" name="vorden_trab" value="<?php echo $_REQUEST['vorden_trab'] ?>">
                                    <input type="hidden" name="vpresu_servi" value="<?php echo $_REQUEST['vpresu_servi'] ?>">
                                    <input type="hidden" name="vestado" value="PENDIENTE">
                                    <input type="hidden"  id="equipo" name="vequipo_oculto"  value="">
                                    <input type="hidden"  id="tipos" name="vtipo_oculto" value="">
                                    <input type="hidden"  id="articulo" name="articulo_oculto" value="">
                                    <input type="hidden"  id="deposito" name="vdepo_oculto" value="">
                                    <input type="hidden"  id="precio" name="vprecio_art_oculto" value="">
                                    <input type="hidden"  id="descuento" name="vdesc_oculto" value="">
                                    <input type="hidden"  id="montos" name="vmonto_servi_oculto" value="">
                                    <input type="hidden"  id="cantidad" name="vcantidad_oculto" value="">
                                    <input type="hidden"  id="subtotal" name="vsubtotal_oculto" value="">

                                    
                                    <span class="col-md-1"></span>
                                    <span class="col-md-1"></span>
                                    <span class="col-md-1"></span>
                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                        <div class="col-md-4"> 
                                            <label class="col-md-1 control-label"><h3>FUNCIONARIO:</h3></label>
                                    <?php $funcionarios = consultas::get_datos("select * from v_funcionario_2 where cod_suc = ".$_SESSION['cod_suc']. " and cod_carg = 9 order by cod_fun asc"); ?>
                                    
                                       <select  class="form-control" id="fun" name="vfun">
<!--                                        <option value="0">Seleccione un Articulo</option>-->
                                        <?php
                                        if (!empty($funcionarios)) {
                                            foreach ($funcionarios as $funcionario) {
                                                ?>  
                                                <option value="<?php echo $funcionario['cod_fun']; ?>">
                                                    <?php echo $funcionario['persona']; ?>
                                                </option>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <option value="">Debe insertar un Funcionario</option>
                                        <?php } ?>
                                    </select>
                                    </div>
                                    </div>
                                     <span class="col-md-1"></span>
                                    <div class="form-group">
                                  

                                   <div class="col-md-5">
                                       
                                       <label class="col-md-1 control-label">EQUIPO:</label>
                                    <?php $equipos = consultas::get_datos("select * from v_equipos order by cod_equipo asc"); ?>
                                    
                                    <select  
                                        class="form-control" id="equi" disabled=""
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
                                    
                                    <div class="col-md-5">
                                        <label class="col-md-1 control-label">REPUESTO:</label>
                                    <?php $articulos = consultas::get_datos("select * from v_articulos_2 where cod_tipo_arti = 4 OR cod_tipo_arti = 3 OR cod_tipo_arti = 7 order by cod_art asc"); ?>
                                    
                                    <select  
                                        class="form-control" id="arti" disabled="">
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
                                        
                                        <div class="col-md-5">
                                            
                                            <label class="col-md-1 control-label">TIPO SERVICIO:</label>
                                    <?php $tipos_servicios = consultas::get_datos("select * from v_tipo_servicios2 order by cod_tipo_servi asc"); ?>
                                    
                                    <select 
                                        class="form-control" id="tipo"  disabled="">
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
                                        
                                        <div class="col-md-5">
                                            <label class="col-md-2 control-label">DEPOSITO</label>
                                            <?php $depositos = consultas::get_datos("select * from deposito where cod_suc = ".$_SESSION['cod_suc']. " order by cod_dep asc"); ?>
                                                <select class="form-control" 
                                                        id="dep" disabled=""
                                                        required="">
                                                            <?php
                                                            if (!empty($depositos)){
                                                                foreach ($depositos as $deposito){
                                                                  ?>
                                                   <option value="<?php echo $deposito['cod_dep']; ?>">
                                                    <?php echo $deposito['dep_descri']; ?>
                                                </option>
                                                    <?php 
                                                                }
                                                            }else{
                                                                ?>
                                                    <option value="0">El articulo no existe en un deposito</option>
                                                           <?php };?>

                                                </select>
                                            </div>
                                        
                                        
                                        
                                    </div>
                                    <span class="col-md-1"></span>
                                    
                                    <div class="form-group">
                                        
                                        <div class="col-md-4">
                                        <br>
                                        <label class="col-md-1 control-label">MONTO SERV.</label>
                                            <input type="number" required="" readonly="" 
                                                   placeholder="Precio Servicio" value="0"
                                                   class="form-control" id="monto">
                                             
                                        </div>
                                        <br>
                                       
                                        <span class="col-md-1"></span>
                                        <span class="col-md-1"></span>
                                        <div class="col-md-4">
                                           
                                            <label class="col-md-1 control-label">PRECIO ART.:</label>
                                                <input type="number" required=""
                                                       class="form-control" value="0"
                                                       readonly="" id="prec">
                                            </div>
                                        
                                    </div>
                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                        
                                        <div class="col-md-4">
                                         <br>
                                        <label class="col-md-1 control-label">DESC.PROMO</label>
                                            <input type="number" required="" readonly="" 
                                                   placeholder="Total" value="0"
                                                   class="form-control" id="desc" name="vdesc">
                                             
                                        </div>
                                        
                                        <span class="col-md-1"></span>
                                        <span class="col-md-1"></span>
                                        
                                        <div class="col-md-4">
                                           <BR>
                                            <label class="col-md-1 control-label">CANTIDAD:</label>
                                                <input type="number" required=""
                                                       class="form-control" value="0" min="1"
                                                       id="canti" readonly="">
                                            </div>
                                        
                                    </div>
                                    <span class="col-md-1"></span>
                                    <span class="col-md-1"></span>
                                    <span class="col-md-1"></span>
                                    <span class="col-md-1"></span>
                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                       
                                        <div class="col-md-3">
                                            <label class="col-md-1 control-label">SUBTOTAL:</label>
                                                <input type="number" required=""
                                                       class="form-control" value="0"
                                                       readonly="" id="subto" >
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
                $('#tipo').val(dat[1]);
                $('#tipos').val(dat[1]);
                $('#equi').val(dat[2]);
                $('#equipo').val(dat[2]);
                $('#arti').val(dat[3]);
                $('#articulo').val(dat[3]);
                $('#canti').val(dat[4]);
                $('#cantidad').val(dat[4]);
                $('#subto').val(dat[5]);
                $('#subtotal').val(dat[5]);
                $('#prec').val(dat[6]);
                $('#precio').val(dat[6]);
                $('#dep').val(dat[7]);
                $('#deposito').val(dat[7]);
                $('#monto').val(dat[8]);
                $('#montos').val(dat[8]);
                $('#desc').val(dat[9]);
                $('#descuento').val(dat[9]);
           
            }
             $("document").ready(function () {

                });
                
                
            function borrar(datos) {
                    var dat = datos.split("_");
                    $('#si').attr('href',
                    'orden_trabajo_serv_control_deta.php?vorden_trab=' + dat[0] +
                            '&vtipo_oculto=' + dat[2] +
                            '&vfun=null' +
                            '&vequipo_oculto=' + dat[1] +
                            '&articulo_oculto=null' +
                            '&vdepo_oculto=null' +
                            '&vestado=null' +
                            '&vcantidad_oculto=null' +
                            '&vpresu_servi=' + dat[5] +
                            '&accion=2' +
                            '&pagina=orden_trabajo_serv_agregar.php');
                    $('#confirmacion').html
                    ('<span class="glyphicon glyphicon-warning-sign"></span>\n\
                    Desea Borrar la Orden de Trabajo para el Funcionario <i><strong>' + dat[3] + ' Encargado del Equipo ' + dat[4] + '</strong></i> ?')
    
                }
        </script>
        
       

    </body>
</html>




