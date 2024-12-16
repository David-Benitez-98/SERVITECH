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
                        <h3 class="page-header">Registar Detalles del Diagnostico
                            <a href="diagnostico_servicio_index.php" 
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
                            <?php
                            $diagnosticos = consultas::get_datos("select * from v_diagnostico where cod_diagnostico=" . $_REQUEST['vdiag'] . " order by cod_diagnostico asc ");
                            if (!empty($diagnosticos)) {
                                ?>   
                                <div class="panel-body">
                                    <div>
                                        <table width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center"># Recep</th>
                                                    <th class="text-center">Cliente</th>
                                                    <th class="text-center">Funcionario</th>
                                                    <th class="text-center">Sucursal</th>
                                                    <th class="text-center">Fecha</th>
                                                    <th class="text-center">Observacion</th>
                                                    <th class="text-center">Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($diagnosticos as $diagnostico) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $diagnostico['cod_diagnostico']; ?></td>
                                                        <td class="text-center"><?php echo $diagnostico['cod_recep']; ?></td>
                                                        <td class="text-center"><?php echo $diagnostico['cliente']; ?></td>
                                                        <td class="text-center"><?php echo $diagnostico['usuario']; ?></td>
                                                        <td class="text-center"><?php echo $diagnostico['suc_descri']; ?></td>
                                                        <td class="text-center"><?php echo $diagnostico['vfecha']; ?></td>
                                                        <td class="text-center"><?php echo $diagnostico['observacion']; ?></td>
                                                        <td class="text-center"><?php echo $diagnostico['estado']; ?></td>
                                                        
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
<!--                Aqui Termina la Estructura Cabecera-->

                    <!-- COMIENZO PARA EL DETALLE ORDEN-->
                          
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
                                                    <td>
                                                        <?php   if($detdiagnostico['estado']=='CONFIRMADO' || $diagnosticos[0]['estado']=='CONFIRMADO' || $diagnosticos[0]['estado']=='PRESUPUESTADO' || $diagnosticos[0]['estado']=='ANULADO'){?>
                                                        
                                                       <?php }else {?>
                                                            
                                                        <a onclick="borrar(<?php echo "'".$_REQUEST['vdiag'] . "_" .
                                                        $detdiagnostico['cod_equipo'] . "_" .     
                                                        $detdiagnostico['descri_equipo'] . "_" .
                                                        $_REQUEST ['vrecep']. "'"
                                                        ?>);"
                                                           class="btn btn-xs btn-danger"
                                                           rel="tooltip" data-title="Borrar"
                                                           data-toggle="modal"
                                                           data-target="#delete">
                                                            <span class="glyphicon glyphicon-trash"></span></a>
                                                           
                                                         
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
                    
                    
                          <!-- COMIENZO PARA EL DETALLE DEL PEDIDO-->
                      
                         <?php  if (isset($diagnosticos[0]['cod_recep'])) { ?>
                                        <?php $detarecepciones = consultas::get_datos(" select * from v_deta_recep "
                                                        . " where estado='PENDIENTE' and cod_recep = " . $_REQUEST['vrecep']. " order by cod_equipo asc "); ?>  
                                        
                                        <?php }?>
                        <!-- /.col-lg-12 -->
                        
                        <div class="col-lg-12">
                           
                        
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                Detalles de la Recepcion
                            </div>
                            <?php if (!empty($detarecepciones)) { ?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Equipo</th>
                                                <th class="text-center">Marca</th>
                                                <th class="text-center">Color</th>
                                                <th class="text-center">Capacidad</th>
                                                <th class="text-center">Observacion</th>
                                                <th class="text-center">Estado</th>
                                                <th class="text-center">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($detarecepciones as $detarecepcion) { ?> 
                                                    <tr>
                                                    <td class="text-center"><?php echo $detarecepcion['cod_equipo']; ?></td>
                                                    <td class="text-center"><?php echo $detarecepcion['descri_tipo']; ?></td>
                                                    <td class="text-center"><?php echo $detarecepcion['mar_descri']; ?></td>
                                                    <td class="text-center"><?php echo $detarecepcion['descri_color']; ?></td>
                                                    <td class="text-center"><?php echo $detarecepcion['descri_equipo']; ?></td>
                                                    <td class="text-center"><?php echo $detarecepcion['observacion']; ?></td>
                                                    <td class="text-center"><?php echo $detarecepcion['estado']; ?></td>
                                                    <td class="text-center">
                                                        
                                                     <a onclick="recep_confirma(<?php
                                                        echo "'" . $detarecepcion['cod_recep'] . "_" .
                                                        $detarecepcion['cod_equipo'] . "'";
                                                        ?>);" 
                                                           class="btn btn-xs btn-primary" rel='tooltip' data-title="Confirmar" 
                                                           data-toggle="modal" data-target="#pedi_confi">
                                                            <span class="glyphicon glyphicon-ok-sign"></span></a>
                                                        
                                                    </td>
                                                            
                                                         
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                <?php } else { ?>
                                    <div class="col-md-12">
                                        <div class="alert alert-dismissable alert-dismissable">
                                            <button type="button" class="close"
                                                    data-dismiss="alert" aria-hidden="true">&times;
                                            </button>
                                            <strong>No se encontraron detalles de recepcion....!</strong>
                                        </div>
                                    </div>
                                
                            <?php } ?>
<!--                        </div>-->
                        </div>
                            </div>
                    </div>
                        </div>

<!-- COMIENZO PARA EL DETALLE AQUI VA UNA TABLA PARA AGREGAR EL DETALLE-->
 <!-- /.col-lg-12 -->


<!--confirmar - registrar pedido modal-->

                <div id="pedi_confi" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header alert-success">
                                <button type="button" class="close" 
                                        data-dismiss="modal" arial-label="Close">x</button>
                                <h4 class="modal-title text-center"><strong>REGISTRAR DETALLE DE DIAGNOSTICO</strong></h4>
                            </div>
                            <form action="diagnostico_servicio_control_deta.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body">
                                    <input name="accion" value="1" type="hidden"/>
                                    <input type="hidden" name="pagina" value="diagnostico_servicio_agregar.php">
                                    <input type="hidden" name="vdiag" value="<?php echo $_REQUEST['vdiag'] ?>">
                                    <input type="hidden" name="vrecep" value="<?php echo $_REQUEST['vrecep'] ?>">
                                    <input type="hidden" name="vestado" value="PENDIENTE">
                                    <input type="hidden" name="vequi" id="equi2" value="">
<!--                                    <input type="hidden"  id="articuloinvisible" name="articuloinvisible" value="">-->

                                    <span class="col-md-1"></span>
                                    <div class="form-group">

                                   <div class="col-md-9"> 
                                    <label class="col-md-1 control-label"><h3>EQUIPO:</h3></label>
                                    <?php $equipos = consultas::get_datos("select * from v_equipos order by cod_equipo asc"); ?>
                                    
                                    <select  
                                            class="form-control" id="equi" 
                                            disabled="">
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
                                        
                                    </div>
                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            
                                    <label class="col-md-1 control-label"><h3>TIPO SERVICIO:</h3></label> 
                                            
                                    <?php $tipos_servicios = consultas::get_datos("select * from v_tipo_servicios2 order by cod_tipo_servi asc"); ?>
                                    
                                    <select name="vtipo_servi" 
                                            class="form-control" id="tipo_servi" >
<!--                                        <option value="0">Seleccione un Articulo</option>-->
                                        <?php
                                        if (!empty($tipos_servicios)) {
                                            foreach ($tipos_servicios as $tipo_servicio) {
                                                ?>  
                                                <option value="<?php echo $tipo_servicio['cod_tipo_servi']; ?>">
                                                    <?php echo $tipo_servicio['descri_servicio']; ?>
                                                </option>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <option value="">Debe insertar un Tipo de Servicio</option>
                                        <?php } ?>
                                            
                                    </select>
                                     
                                    
                                </div>
                                        <BR>
                                        <BR>
                                        <BR>
                                        <BR>
                                        <a data-toggle="modal" data-target="#registrar" 
                                           class="btn btn-info btn-circle" 
                                           rel="tooltip" data-title="Registrar Tipo Servicios">
                                            <i class="fa fa-plus"></i>
                                        </a>
                               
                                    </div>
                                    <BR>
                                   


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


<!-- COMIENZO PARA EL DETALLE AQUI VA UNA TABLA PARA AGREGAR MAS DETALLES-->
 <!-- /.col-lg-12 -->
                                
                  <!--Carga para el detalle-->
                <div class="col-md-12">
                    <div class="panel-body">
                        <form action="diagnostico_servicio_control_deta.php" method="get"
                              role="form" class="form-horizontal">
                                    <input type="hidden" name="accion" value="1">
                                    <input type="hidden" name="vdiag" value="<?php echo $_REQUEST['vdiag'] ?>">
                                    <input type="hidden" name="vrecep" value="<?php echo $_REQUEST['vrecep'] ?>">
                                    <input type="hidden" name="vestado" value="PENDIENTE">
<!--                                    <input type="hidden" name="vequi" id="equi_otro" value="">-->
                            <input type="hidden" name="pagina" value="diagnostico_servicio_agregar.php">
                            
                <?php      if($diagnosticos[0]['estado']=='ANULADO' || $diagnosticos[0]['estado']=='CONFIRMADO' || $diagnosticos[0]['estado']=='PRESUPUESTADO' ||$diagnosticos[0]['cod_suc'] != $_SESSION['cod_suc']) {?>
                            
                            <?php } else { ?>
                            <div class="form-group">
                                    <label class="col-md-2 control-label">EQUIPO:</label>
                                   <div class="col-md-6"> 
                                         <?php  if (isset($diagnosticos[0]['cod_recep'])) { ?>
                                       <?php $equipos = consultas::get_datos("select * from v_deta_recep "
                                            . " where cod_recep = " . $_REQUEST['vrecep']. " order by cod_equipo asc "); ?> 
                                        
                                        <?php }?>
                                    <select class="form-control" name="vequi">
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
                                
                                    </div>
                            <BR>
                            
<!--                            CAMPO SERVICIO-->
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">TIPO SERVICIO:</label>
                                        <div class="col-md-4"> 
                                    <?php $tipos_servicios = consultas::get_datos("select * from v_tipo_servicios2 order by cod_tipo_servi asc"); ?>
                                    
                                    <select name="vtipo_servi" 
                                            class="form-control" id="tipo_servi" >
<!--                                        <option value="0">Seleccione un Articulo</option>-->
                                        <?php
                                        if (!empty($tipos_servicios)) {
                                            foreach ($tipos_servicios as $tipo_servicio) {
                                                ?>  
                                                <option value="<?php echo $tipo_servicio['cod_tipo_servi']; ?>">
                                                    <?php echo $tipo_servicio['descri_servicio']; ?>
                                                </option>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <option value="">Debe insertar un Tipo de Servicio</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                        
                                        <a data-toggle="modal" data-target="#registrar" 
                                           class="btn btn-info btn-circle" 
                                           rel="tooltip" data-title="Registrar Tipo Servicios">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                            <br>
                            
                      
                                <div class="form-group">
                                <div class="col-md-offset-4 col-md-10">
                                    <button class="btn btn-success"
                                            type="submit">
                                        <i class="fa fa-floppy-o">

                                        </i> Grabar</button>
                                </div>
                            </div>
                      <?php   } ?>
                            
                            
                            
                        </form>
                    </div>

                </div>
                

    </div>
                    
 </div>

                
            </div >
            
             <!--registrar tipo de servicios-->
                <div id="registrar" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header alert-success">
                                <button type="button" class="close" 
                                        data-dismiss="modal" arial-label="Close">x</button>
                                <h4 class="modal-title"><strong>Registrar Tipos de Servicios</strong></h4>
                            </div>
                            <form action="tipo_servicio_control_1.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body se">
                                    <input type="hidden" name="accion"  value="1">
                                    <input type="hidden" name="vtipo" value="0"/> 
                                    <input type="hidden" name="vdiag" value="<?php echo $_REQUEST['vdiag'] ?>">
                                    <input type="hidden" name="vrecep" value="<?php echo $_REQUEST['vrecep'] ?>">
                                    <input type="hidden" name="pagina" value="diagnostico_servicio_agregar.php">

                                   
                                <!--                                    INICIO DESCRIPCION-->
                                    <div class="form-group">
                                    <label class="col-lg-3 control-label">Descripción:</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control" name="vdescri" id="descri" 
                                               required="" 
                                               onkeyup="reemplazar()"
                                               onchange="reemplazar()"
                                               onblur="sololetras()"
                                               pattern="[A-Za-z and #SPACE and ._- and Ñ-ñ]{3,40}" title="Ingresa sólo letras. Tamaño mínimo: 3. Tamaño máximo: 40" 
                                               autofocus="">
                                    </div>
                                    </div>
                                <br>
                                <!--Inicio Precio-->
                                <div class="form-group"> 
                                    <label class="col-md-3 control-label">Precio:</label>
                                    <div class="col-md-5">
                                        <input type="number" id="precio" required=""
                                               placeholder="Ingrese Precio"
                                               class="form-control" name="vprecio" onkeyup="nronegativo()"
                                               onchange="nronegativo()" autofocus="">
                                    </div>
                                </div>
                                 <br>
                                <!--Fin Precio-->
                                
                                 <!--Inicio Ciudad-->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Plazo Reclamo</label>
                                        <div class="col-md-5">
                                            <select name="vplazo" class="form-control"
                                                    id="vcondicion" onchange="tiposelect();">
                                                <option value="30">1 mes</option>
                                                <option value="60">2 meses</option>
                                                <option value="91">3 meses</option>
                                                <option value="120">4 meses</option>
                                                <option value="150">5 meses</option>
                                                <option value="180">6 meses</option>
                                                <option value="210">7 meses</option>
                                                <option value="240">8 meses</option>
                                                <option value="270">9 meses</option>
                                                <option value="300">10 meses</option>
                                                <option value="330">11 meses</option>
                                                <option value="365">12 meses</option>
                                            </select>
                                        </div>
                                    </div>
                                 <br>
                                 <!--Fin Ciudad-->
                                 
                                <!--Inicio Tipo de Articulo-->
                                    <div class="form-group">
                                    <label class="col-md-3 control-label">Impuesto IVA:</label>
                                    <div class="col-md-3">
                                        <?php
                                        $tipos_impuestos = consultas::get_datos("select * from v_tipo_impuesto "
                                                        . " order by cod_imp");
                                        ?>                                 
                                        <select name="vimp" class="form-control select"  style="width: 180%">
                                            <?php
                                            if (!empty($tipos_impuestos)) {
                                                foreach ($tipos_impuestos as $tipo_impuesto) {
                                                    ?>
                                                    <option value="<?php echo $tipo_impuesto['cod_imp']; ?>">
                                                        <?php echo $tipo_impuesto['imp_descri']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar un Impuesto</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                 <!--Fin Tipo de articulo-->
                                
                                </div>
                                <br>
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
                
<!--                Fin registrar tipos servicios-->
            
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
            
            function recep_confirma(datos) {
                var dat = datos.split("_");
                $('#cod').val(dat[0]);
                $('#equi').val(dat[1]);
                $('#equi2').val(dat[1]);
                console.log(dat[2]);


            }
             $("document").ready(function () {
                    recep_confirma();
//                    $('#equi2').val($("#equi_otro").val());
                });
                
               
//           function deposito(){
//                    if ((parseInt($('#artic').val()) > 0) || ($('#artic').val() !== "")) {
//                        $.ajax({
//                            type: "GET",
//                            url: "/servitech/lista_deposito_compra.php?varti=" + 
//                                    $('#artic').val (),
//                            cache: false,
//                            beforeSend: function () {
//                                $('#detalles').
//                            html('<img src="/servitech/img/cargando.GIF">\n\
//                            <strong><i>Cargando...</i><strong>');
//                            },
//                                    success: function (msg){
//                                        $('#detalles').html(msg);
////                                        obtenerprecio();
//                                    }
//                        });
//                        
//                        $('#articuloinvisible').val($('#artic').val());
//                        
//                    }
//                    }
                    
            
            function borrar(datos) {
                    var dat = datos.split("_");
                    $('#si').attr('href',
                    'diagnostico_servicio_control_deta.php?vdiag=' + dat[0] +
                            '&vtipo_servi=null' +
                            '&vequi=' + dat[1] +
                            '&vestado=null' +
                            '&vrecep=' + dat[3] +
                            '&accion=2' +
                            '&pagina=diagnostico_servicio_agregar.php');
                    $('#confirmacion').html
                    ('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Borrar el Diagnostico del Equipo <i><strong>' + dat[2] + '</strong></i> ?')
                
                }
                
                function nronegativo() {

                var numero = document.getElementById("precio").value;
                if (numero.match(/^-?[0-9]+(\.[0-9]{1,2})?$/))
                {
//                    alert("numero ok");
                }
                else
                {
                    alert("Ingrese su numero sin puntos, letras ni espacios");
                    document.getElementById("precio").value = "";
                }
            }
            
            
        
        </script>
        
       

    </body>
</html>




