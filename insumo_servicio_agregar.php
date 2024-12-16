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
                        <h3 class="page-header text-center">Registar Detalles  de Insumos
                            <a href="insumo_servicio_index.php" 
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
                                Datos Cabecera Insumos Utilizados
                             </div> 
                            <!-- /.panel-heading -->
                            
                            <?php  if (isset($_REQUEST['vinsu_uti'])) { ?>
                         <?php    $insumosutilizados = consultas::get_datos("select * from v_insumos_utilizados where cod_insumo_uti=".$_REQUEST['vinsu_uti']); ?>
                             <?php } ?>
                             <?php if (!empty($insumosutilizados)) { ?>
                              
                                                       
                                
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table  width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#Insu</th>
                                                    <th class="text-center">#Orden</th>
                                                    <th class="text-center">Observacion</th>
                                                    <th class="text-center">Tecnico</th>
                                                    <th class="text-center">Sucursal</th>
                                                    <th class="text-center">Fecha</th>
                                                    <th class="text-center">Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($insumosutilizados as $insumoutilizado) { ?> 
                                                    <tr>
                                                       <td class="text-center"><?php echo $insumoutilizado['cod_insumo_uti']; ?></td>
                                                        <td class="text-center"><?php echo $insumoutilizado['cod_orden_trabajo']; ?></td>
                                                        <td class="text-center"><?php echo $insumoutilizado['observacion']; ?></td>
                                                        <td class="text-center"><?php echo $insumoutilizado['usuario']; ?></td>
                                                        <td class="text-center"><?php echo $insumoutilizado['suc_descri']; ?></td>
                                                        <td class="text-center"><?php echo $insumoutilizado['vfecha']; ?></td>
                                                        <td class="text-center"><?php echo $insumoutilizado['estado']; ?></td>
                                                        
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
                    
                      <?php  if (isset($insumosutilizados[0]['cod_insumo_uti'])) { ?>
                                        <?php $detinsumosutilizados = consultas::get_datos("select * from v_deta_insumos_uti "
                                                        . " where cod_insumo_uti = " . $_REQUEST['vinsu_uti']); ?>  
                                        
                                        <?php }?>
                        <!-- /.col-lg-12 -->
                                
                        <div class="col-lg-12">
                            
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                Detalles Insumos Utilizados
                            </div>
                            <?php if (!empty($detinsumosutilizados)) { ?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Repuestos</th>
                                                <th class="text-center">Imagen</th>
                                                <th class="text-center">Cant Rep</th>
                                                <th class="text-center">Deposito</th>
                                                <th class="text-center">Estado</th>
<!--                                                <th class="text-center">Acción</th>-->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($detinsumosutilizados as $detinsumoutilizado) { ?> 
                                                    <tr>
                                                    <td class="text-center"><?php echo $detinsumoutilizado['cod_art']; ?></td>
                                                    <td class="text-center"><?php echo $detinsumoutilizado['datos_articulos']; ?></td>
                                                    <td class="text-center"> 
                                                        <img height="45px" src="img/<?php echo $detinsumoutilizado['art_imagen'];?>" /> </td>
                                                    <td class="text-center"><?php echo $detinsumoutilizado['cantidad_insu']; ?></td>
                                                    <td class="text-center"><?php echo $detinsumoutilizado['dep_descri']; ?></td>
                                                    <td class="text-center"><?php echo $detinsumoutilizado['estado']; ?></td>
                                                     <td>
                                                          <?php   if ($detinsumosutilizados[0]['estado']=='CONFIRMADO' 
                                                                  || $insumosutilizados[0]['estado']=='CONFIRMADO' 
                                                                  || $insumosutilizados[0]['estado']=='ANULADO' 
                                                                  || $insumosutilizados[0]['estado']=='TERMINADO'){?>
                                                         
                                                         <?php }else if ($detinsumosutilizados[0]['estado']=='PENDIENTE'){?>
                                                        <a onclick="borrar(<?php echo "'".$_REQUEST['vinsu_uti'] . "_" .
                                                        $detinsumoutilizado['cod_art'] . "_" .
                                                        $detinsumoutilizado['cantidad_insu'] . "_" . 
                                                        $detinsumoutilizado['dato_articulo'] . "_" . 
                                                        $detinsumoutilizado['cod_dep'] . "_" . 
                                                        $_REQUEST ['vorden_trab']. "'"
                                                        ?>)"
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
                                        <div class="alert alert-info alert-dismissable">
                                            <button type="button" class="close"
                                                    data-dismiss="alert" aria-hidden="true">&times;
                                            </button>
                                            <strong>No se encontraron detalles para el insumo....!</strong>
                                        </div>
                                    </div>
                                
                            <?php } ?>
                        </div>
                        </div>
                            
                        </div>
                    <!-- COMIENZO PARA EL DETALLE PRESUPUESTO-->
                    
                      <?php  if (isset($insumosutilizados[0]['cod_orden_trabajo'])) { ?>
                                        <?php $detordentrabajos = consultas::get_datos("select * from v_deta_orden_trabajo "
                                                        . " where cod_orden_trabajo = " . $_REQUEST['vorden_trab']); ?>  
                                        
                                        <?php }?>
                        <!-- /.col-lg-12 -->
                                
                        <div class="col-lg-12">
                            
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                Detalles de Orden de Trabajo
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
                                                     <td class="text-center">
                                                        
                                                      <?php   if ($detordentrabajo['estado_deta']=='CONFIRMADO' || $insumosutilizados[0]['estado']=='ANULADO' || $insumosutilizados[0]['estado']=='CONFIRMADO'){
                                                          
                                                      } else { ?>
                                                      <a onclick="confirmar(<?php
                                                        echo "'" . $_REQUEST['vinsu_uti'] . "_" .
                                                        $detordentrabajo['cod_art'] . "_" .
                                                        $detordentrabajo['cod_dep'] . "_" .
                                                        $detordentrabajo['art_cantidad'] . "_" .
                                                        $_REQUEST ['vorden_trab']. "'";
                                                        ?>)" 
                                                           class="btn btn-xs btn-primary" rel='tooltip' data-title="Confirmar" 
                                                           data-toggle="modal" data-target="#delete">
                                                            <span class="glyphicon glyphicon-ok-sign"></span></a>
                                                        
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
                    
                        </div>

<!-- COMIENZO PARA EL DETALLE AQUI VA UNA TABLA PARA AGREGAR EL DETALLE-->
 <!-- /.col-lg-12 -->


<!--confirmar - registrar pedido-->

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
                                                     
//           function orden_confirmar(datos) {
//                var dat = datos.split("_");
//                $('#cod').val(dat[0]);
//                $('#tip').val(dat[1]);
//                $('#funcio').val(dat[2]);
//                $('#equip').val(dat[3]);
//                $('#artic').val(dat[4]);
//                $('#articulos').val(dat[4]);
//                $('#depp').val(dat[5]);
//                $('#depositos').val(dat[5]);
//                $('#cantid').val(dat[6]);
//                $('#cantidades').val(dat[6]);
//           
//            }
             $("document").ready(function () {

                });
                
                
            function borrar(datos) {
                    var dat = datos.split("_");
                    $('#si').attr('href',
                    'insumo_servicio_control_deta.php?vinsu_uti=' + dat[0] +
                            '&varticulo='  + dat[1] +
                            '&vdepo=' + dat[4] +
                            '&vcantidad=' + dat[2] +
                            '&vestado=null' +
                            '&vorden_trab=' + dat[5] +
                            '&accion=2' +
                            '&pagina=insumo_servicio_agregar.php');
                    $('#confirmacion').html
                    ('<span class="glyphicon glyphicon-warning-sign"></span>\n\
                    Desea Borrar El detalle de Insumo con Repuesto <i><strong>' + dat[3] + '</strong></i> ?')
    
                }
                
                function confirmar(datos) {
                    var dat = datos.split("_");
                    $('#si').attr('href',
                    'insumo_servicio_control_deta.php?vinsu_uti=' + dat[0] +
                            '&varticulo='  + dat[1] +
                            '&vdepo=' + dat[2] +
                            '&vcantidad=' + dat[3] +
                            '&vestado=null' +
                            '&vorden_trab=' + dat[4] +
                            '&accion=1' +
                            '&pagina=insumo_servicio_agregar.php');
                    $('#confirmacion').html
                    ('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Confirmar este Repuesto perteneciente al Detalle de la Orden de Trabajo?');
                
                }
            
        </script>
        
       

    </body>
</html>




