<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SERVITECH SYS COMPRAS</title>

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
                        <h3 class="page-header">Registar Compras 
                            <a href="compra_index.php" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel='tooltip' title="Atras">
                                <i class="glyphicon glyphicon-arrow-left"></i>
                            </a> 
                        </h3>
                    </div>                       
                </div>
                <!--               Aqui empieza el cuerpo de la estructura-->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!--                        este panel headin le agregue yo -->
                        <div class=" panel panel-success">
                            
                            <div class="panel-heading">
                                Datos Cabecera de Compra 
                             </div> 
                                <div class="panel-body">
                             
                            <?php  if (isset($_REQUEST['vcodcomp'])) { ?>
                            <?php  $compras =  consultas::get_datos("select * from v_compras where cod_comp=".$_REQUEST['vcodcomp']);?>
                            <?php } ?>
                              
                                    <form action="compra_control" method="post" 
                                      role="form" class="form-horizontal">
                                    <input type="hidden" name="accion" id="accion" value="1">
                                    <input type="hidden" name="vcodcomp" id="vcodcomp" value="<?php echo $_REQUEST['vcodcomp']; ?>"
                                    <input type="hidden" name="vestado" id="vestado" value="PENDIENTE">
                                    <input type="hidden" name="vcod_usu" id="vcod_usu" value="<?php echo $_SESSION['cod_usu']; ?>">
                                    <input type="hidden" name="pagina" value="compra_index.php">
                                    <!-- Grupo de la primera fila-->
                                    
                                    <!-- Campo fecha-->
                                    <div class="form-group">
                                        <label class="col-md-1 control-label">Fecha</label>
                                        <div class="col-md-3">
                                            <input type="datetime" id="vfecha"
                                                   placeholder="Especifique fecha"
                                                   class="form-control"
                                                   name="vfecha" 
                                                   onmouseup="validar()"
                                                   onkeyup="validar()"
                                                   onchange="validar()"
                                                   onclick="validar()"
                                                   onkeypress="validar()"
                                                   value="<?= !empty($compras[0]['fecha']) ? $compras[0]['fecha'] : ''; ?>"
                                                   <?= !empty($compras[0]['fecha']) ? 'readonly' : ''; ?>>
                                                  
                                    </div>

                                        <!-- Campo Sucursal-->

                                        <label class="col-md-1 control-label">Sucursal</label>
                                        <div class="col-md-3">
                                        <?php  if (isset($compras[0]['cod_suc'])) { ?>
                                        <?php $sucursales = consultas::get_datos("select * from v_sucursal "
                                                        . " order by cod_suc=".$compras[0]['cod_suc']." desc"); ?>  
                                            
                                        <?php } else { ?>
                                            <?php $sucursales = consultas::get_datos("select * from v_sucursal "
                                                        . " order by cod_suc desc"); ?>
                                        <?php }?>
                                            
                                            <select name="vsucursal" id="vsucursal" class="form-control" disabled="">
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
                                        
                                        <label class="col-md-1 control-label">Proveedor</label>
                                        <div class="col-md-3">
                                        <?php  if (isset($compras[0]['cod_prov'])) { ?>
                                        <?php $proveedores = consultas::get_datos("select * from v_proveedor3 "
                                                        . " order by cod_prov=".$compras[0]['cod_prov']." desc"); ?>  
                                            
                                        <?php } else { ?>
                                            <?php $proveedores = consultas::get_datos("select * from v_proveedor3 "
                                                        . " order by cod_prov desc"); ?>
                                        <?php }?>
                                            
                                            <select name="vproveedor" id="vproveedor" class="form-control" disabled="">
                                                <?php
                                                if (!empty($proveedores)) {
                                                    foreach ($proveedores as $proveedor) {
                                                        ?>
                                                        <option value="<?php echo $proveedor['cod_prov']; ?>">
                                                            <?php echo $proveedor['persona']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="0">Debe ingresar un Proveedor</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        
                                    </div>
                                    
                                    
                            <!-- Campo Proveedor-->
                                    <div class="form-group">
                                        
<!--                                        Campo Pedido Compra-->
                                        <label class="col-md-1 control-label">Pedido</label>
                                        <div class="col-md-3">
                                        <?php  if (isset($compras[0]['cod_pedi_comp'])) { ?>
                                        <?php $pedidoscompras = consultas::get_datos("select * from v_pedido_compra "
                                                        . " order by cod_pedi_comp=".$compras[0]['cod_pedi_comp']." desc"); ?>  
                                        <?php } else { ?>
                                            
                                        <?php }?>
                                            
                                            <select name="vpedi" id="vpedi" 
                                            onchange="detallespedidos()" onkeyup="detallespedidos()"
                                            class="form-control" disabled="">
                                                <?php
                                                if (!empty($pedidoscompras)) {
                                                    foreach ($pedidoscompras as $pedidocompra) {
                                                        ?>
                                                        <option value="<?php echo $pedidocompra['cod_pedi_comp']; ?>">
                                                            <?php echo $pedidocompra['pedido']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="0">Orden de Compra sin Pedido</option>
                                                <?php } ?>
                                            </select>
                                        </div>
<!--                                        Campo Presupuesto-->
                                        <label class="col-md-1 control-label">Orden</label>
                                        <div class="col-md-3">
                                        <?php  if (isset($compras[0]['id_orden_compra'])) { ?>
                                        <?php $ordenescompras = consultas::get_datos("select * from v_orden_compra3 "
                                                        . " order by id_orden_compra=".$compras[0]['id_orden_compra']." desc"); ?>  
                                        <?php } else { ?>
                                            
                                        <?php }?>
                                            
                                            <select name="vorden" id="vorden" 
                                           
                                            class="form-control" disabled="">
                                                <?php
                                                if (!empty($ordenescompras)) {
                                                    foreach ($ordenescompras as $ordencompra) {
                                                        ?>
                                                        <option value="<?php echo $ordencompra['id_orden_compra']; ?>">
                                                            <?php echo $ordencompra['datos_orden']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="0">Compra sin Orden</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        
                                        <label class="col-md-1 control-label">Total Compra:</label>
                                        <div class="col-md-3">
                                            <input type="number" 
                                                   placeholder="Especifique Total"
                                                   class="form-control"
                                                   name="total"
                                                   readonly=""
                                                   value="<?= !empty($compras[0]['total']) ? $compras[0]['total'] : 0; ?>">
                                                  
                                    </div>
                                        
                                    </div>

                                </form>   
                            </div>
                        </div>
<!--                Aqui Termina la Estructura Cabecera-->

                    <!-- COMIENZO PARA EL DETALLE COMPRA-->
                          
                    <?php  if (isset($_REQUEST['vcodcomp'])) { ?>
                    <?php $detcompras = consultas::get_datos
                    ("select * from v_detcompras where cod_comp=" . $_REQUEST['vcodcomp'] . " order by cod_art asc");?>
                    
                <div class="col-lg-12">
                    
                        <!-- <div class="col-md-12">-->
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                Detalles de Compra
                            </div>
                            <?php if (!empty($detcompras)) { ?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Articulos</th>
                                                <th>Cantidad</th>
                                                <th>Precio Compra</th>
                                                <th>Iva 5%</th>
                                                <th>Iva 10%</th>
                                                <th>Subtotal</th>
                                                <th>Plazo - Garantia</th>
                                                <th>Estado</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($detcompras as $detcompra) { ?>
                                                <tr>
                                                    <td><?php echo $detcompra['cod_art']; ?></td>
                                                    <td><?php echo $detcompra['dato_articulo']; ?></td>
                                                    <td><?php echo $detcompra['det_cantidad']; ?></td>
                                                    <td><?php echo number_format($detcompra['det_prec_comp'], 0, ',', '.'); ?></td>
                                                    <td><?php echo number_format($detcompra['iva_5'], 0, ',', '.'); ?></td>
                                                    <td><?php echo number_format($detcompra['iva_10'], 0, ',', '.'); ?></td>
                                                    <td><?php echo number_format($detcompra['subtotal'], 0, ',', '.'); ?></td>
                                                    <td><?php echo $detcompra['plazo_garantia']." - ".$detcompra['garantia_descri']; ?></td>
                                                    <td><?php echo $detcompra['det_estado']; ?></td>
                                                    <td>
                                                        <?php   if($detcompra['det_estado']=='CONFIRMADO' || $compras[0]['com_estado']=='CONFIRMADO' || $compras[0]['com_estado']=='ANULADO'){?>
                                                        <?php }else
                                                           if(!empty($ordencompra['id_orden_compra'])){?>
                                                        <a onclick="borrar_orden(<?php echo "'".$_REQUEST['vcodcomp'] . "_" .
                                                        $detcompra['cod_art'] . "_" .
                                                        $detcompra['det_prec_comp'] . "_" .
                                                        $detcompra['det_cantidad'] . "_" .
                                                        $detcompra['subtotal'] . "_" .       
                                                        $detcompra['dato_articulo'] . "_" .
                                                        $detcompra['garantia_descri'] . "_" .
                                                        $detcompra['plazo_garantia'] . "_" .
                                                        $detcompra['garantia_condicion'] . "_" .
                                                        $detcompra['cod_dep'] . "_" .
                                                        $_REQUEST ['vorden']. "'"
                                                        ?>)"
                                                           class="btn btn-xs btn-danger"
                                                           rel="tooltip" data-title="Borrar"
                                                           data-toggle="modal"
                                                           data-target="#delete">
                                                            <span class="glyphicon glyphicon-trash"></span></a>
                                                            
                                                             <?php }else if(!empty($pedidocompra['cod_pedi_comp'])){?>  
                                                                 <a onclick="borrar_pedi(<?php echo "'".$_REQUEST['vcodcomp'] . "_" .
                                                        $detcompra['cod_art'] . "_" .
                                                        $detcompra['det_prec_comp'] . "_" .
                                                        $detcompra['det_cantidad'] . "_" .
                                                        $detcompra['subtotal'] . "_" .       
                                                        $detcompra['dato_articulo'] . "_" .
                                                        $_REQUEST ['vpedi']. "'"
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
                                        <div class="alert alert-dismissable alert-dismissable">
                                            <button type="button" class="close"
                                                    data-dismiss="alert" aria-hidden="true">&times;
                                            </button>
                                            <strong>No se encontraron detalles de compras....!</strong>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
    
                </div>
                     <?php } else { ?>
                                    
                            <?php } ?>
                    
                  <!-- COMIENZO PARA EL IMPUESTO-->
                          
                    <?php  if (isset($_REQUEST['vcodcomp'])) { ?>
                    <?php $detcompras = consultas::get_datos
                    ("select * from v_detcompras_calculo_iva where cod_comp=" . $_REQUEST['vcodcomp']);?>
                    
                
                    
                        <!-- <div class="col-md-12">-->
                        <div class="panel panel-success">
                          
                            <?php if (!empty($detcompras)) { ?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                
                                                <th class="text-center">Total IVA 5%</th>
                                                <th class="text-center">Total IVA 10%</th>
                                                <th class="text-center">Total EXENTA</th>
                                                <th class="text-center">Total IVAS </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($detcompras as $detcompra) { ?>
                                                <tr>
                                                    <td class="text-center"><?php echo number_format($detcompra['total_iva5'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detcompra['total_iva10'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detcompra['total_exenta'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detcompra['total_ivas'], 0, ',', '.'); ?></td>
                                                    
                                                </tr>
                                                
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } else { ?>

                            <?php } ?>
                        </div>
    
                </div>
                <?php } else { ?>
<!--                                    
               <?php } ?>
               
                    
                    
                        <!-- COMIENZO PARA EL DETALLE LA ORDEN-->
                      
                         <?php  if (isset($compras[0]['id_orden_compra'])) { ?>
                                        <?php $detordenescompras = consultas::get_datos("select * from v_det_orden_compra "
                                                        . " where esta_detalle='PENDIENTE' and id_orden_compra = " . $_REQUEST['vorden']); ?>  
                                        
                                        <?php }?>
                        <!-- /.col-lg-12 -->
                               
                       
                        <div class="log-lg-12">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                Detalles de la Orden para insertar en la Compra
                            </div>
                            <?php if (!empty($detordenescompras)) { ?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Articulos</th>
                                                <th class="text-center">Imagen</th>
                                                <th class="text-center">Precio Compra</th>
                                                <th class="text-center">Cantidad</th>
                                                <th class="text-center">Subtotal</th>
                                                <th class="text-center">Estado</th>
                                                <th class="text-center">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($detordenescompras as $detordencompra) { ?> 
                                                    <tr>
                                                    <td class="text-center"><?php echo $detordencompra['cod_art']; ?></td>
                                                    <td class="text-center"><?php echo $detordencompra['art_descri']; ?></td>
                                                    <td class="text-center"> 
                                                        <img height="45px" src="img/<?php echo $detordencompra['art_imagen'];?>" /> </td>
                                                    <td class="text-center"><?php echo number_format($detordencompra['prec_unit_ordencomp'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo $detordencompra['cantidad']; ?></td>
                                                    <td class="text-center"><?php echo number_format($detordencompra['subtototal'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo $detordencompra['esta_detalle']; ?></td>
                                                    <td class="text-center">
                                                    <?php   if($compras[0]['com_estado']=='CONFIRMADO' || $compras[0]['com_estado']=='ANULADO'){?>
                                                        <?php }else { ?>
                                                         <a onclick="orden_confirma(<?php
                                                        echo "'" . $detordencompra['id_orden_compra'] . "_" .
                                                        $detordencompra['cod_art'] . "_" .
                                                        $detordencompra['prec_unit_ordencomp'] . "_" .
                                                        $detordencompra['cantidad'] . "_" .
                                                        $detordencompra['subtototal'] . "'";
                                                        ?>); deposito_orden()" 
                                                           class="btn btn-xs btn-primary" rel='tooltip' data-title="Confirmar" 
                                                           data-toggle="modal" data-target="#orden_confirma">
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
                                            <strong>No se encontraron detalles para la orden....!</strong>
                                        </div>
                                    </div>
                                
                            <?php } ?>
                        </div>
                        </div>
                            <!-- COMIENZO PARA EL DETALLE DEL PEDIDO-->
                      
                         <?php  if (isset($compras[0]['cod_pedi_comp'])) { ?>
                                        <?php $detapedidoscompras = consultas::get_datos("select * from v_deta_pedido_comp "
                                                        . " where estado='PENDIENTE' and cod_pedi_comp = " . $_REQUEST['vpedi']); ?>  
                                        
                                        <?php }?>
                        <!-- /.col-lg-12 -->
                        
                        <div class="col-lg-12">
                           
                        
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                Detalles del Pedido para insertar en la Compra
                            </div>
                            <?php if (!empty($detapedidoscompras)) { ?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Articulos</th>
                                                <th class="text-center">Imagen</th>
                                                <th class="text-center">Cantidad</th>
                                                <th class="text-center">Estado</th>
                                                <th class="text-center">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($detapedidoscompras as $detapedidocompra) { ?> 
                                                    <tr>
                                                    <td class="text-center"><?php echo $detapedidocompra['cod_art']; ?></td>
                                                    <td class="text-center"><?php echo $detapedidocompra['art_descri']; ?></td>
                                                    <td class="text-center"> 
                                                        <img height="45px" src="img/<?php echo $detapedidocompra['art_imagen'];?>" /> </td>
                                                    <td class="text-center"><?php echo $detapedidocompra['pedi_canti']; ?></td>
                                                    <td class="text-center"><?php echo $detapedidocompra['estado']; ?></td>
                                                    <td class="text-center">
                                                     <?php   if($compras[0]['com_estado']=='CONFIRMADO' || $compras[0]['com_estado']=='ANULADO'){?>
                                                        <?php }else { ?>   
                                                     <a onclick="pedido_confirma(<?php
                                                        echo "'" . $detapedidocompra['cod_pedi_comp'] . "_" .
                                                        $detapedidocompra['cod_art'] . "_" . $detapedidocompra['pedi_canti'] . "'";
                                                        ?>); deposito()" 
                                                           class="btn btn-xs btn-primary" rel='tooltip' data-title="Confirmar" 
                                                           data-toggle="modal" data-target="#pedi_confi">
                                                            <span class="glyphicon glyphicon-ok-sign"></span></a>
                                                        
                                                    </td>
                                                            
                                                         
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
                                            <strong>No se encontraron detalles para la orden....!</strong>
                                        </div>
                                    </div>
                                
                            <?php } ?>
<!--                        </div>-->
                        </div>
                            </div>
                    </div>
                        </div>
     
                </div>
                   

<!--                El hr es para poner una linea divisora-->

<!--confirmar - registrar pedido-->

                <div id="pedi_confi" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg ">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header alert-success">
                                <button type="button" class="close" 
                                        data-dismiss="modal" arial-label="Close">x</button>
                                <h4 class="modal-title"><strong>REGISTRAR DETALLE POR PEDIDO</strong></h4>
                            </div>
                            <form action="compra_control_deta_pedi.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body">
                                    <input name="accion" value="1" type="hidden"/>
                                    <input type="hidden" name="pagina" value="compra_agregar.php">
                                    <input type="hidden" name="vcodcomp" value="<?php echo $_REQUEST['vcodcomp'] ?>">
                                    <input type="hidden" name="vpedi" value="<?php echo $_REQUEST['vpedi'] ?>">
                                    <input type="hidden" name="vorden" value="<?php echo $_REQUEST['vorden'] ?>">
                                    <input type="hidden" name="vestado" value="ACTIVO">
                                    <input type="hidden"  id="subtotal" name="vsubt" value="0">
                                    <input type="hidden"  id="articuloinvisible" name="articuloinvisible" value="">
                                    <input type="hidden"  id="depositoinvisible" name="depositoinvisible" value="">
                                    
                                    <span class="col-md-3"></span>
                                    <div class="form-group">
                                        <div class="col-md-5">
                                            <span class="col-md-3"></span>
                                    <label class="col-md-1 control-label"><h3>GARANTIA:</h3></label>
                                            <select name="vgarantia" class="form-control"
                                                    id="vgarantia" onchange="tiposelect1(),tiposelect2(),tiposelect3(),tiposelect4() ">
                                                <option value="CON">CON GARANTIA</option>
                                                <option value="SIN">SIN GARANTIA</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                   <div class="col-md-5"> 
                                    <label class="col-md-1 control-label"><h3>ARTICULOS:</h3></label>
                                    <?php $articulos = consultas::get_datos("select * from v_articulos order by cod_art asc"); ?>
                                    
                                    <select name="varti" 
                                            class="form-control" id="artic" 
                                            onchange="deposito()"
                                            onkeypress="deposito()" disabled="">
<!--                                        <option value="0">Seleccione un Articulo</option>-->
                                        <?php
                                        if (!empty($articulos)) {
                                            foreach ($articulos as $articulo) {
                                                ?>  
                                                <option value="<?php echo $articulo['cod_art']; ?>">
                                                    <?php echo $articulo['art_descri']; ?>
                                                </option>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <option value="">Debe insertar un Articulo</option>
                                        <?php } ?>
                                    </select>
                                </div> 
                                            <div class="col-md-5" id="detalles">
                                                <label class="col-md-2 control-label"><h3>DEPOSITO:</h3></label>
                                                <select class="form-control" required="">
                                                    <option>Seleccione un deposito</option>
                                                </select>
                                            </div>
                                    </div>
                                    
                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                        <div class="col-md-5"> 
                                            <label class="col-md-1 control-label"><h3>PRECIO:</h3></label>
                                            <input   type="number" required=""
                                                     placeholder="Especifique precio"
                                                     class="form-control"
                                                     required min="100"  name="vprecio" id="prec"
                                                     onkeyup="nronegativo2(), calsubtotal()"
                                                    onchange="nronegativo2(), calsubtotal()"
                                                    onmouseup="calsubtotal()"
                                                     value="0">
                                        </div>
                                        
                                        <div class="col-md-5">
                                            <label class="col-md-2 control-label"><h3>CANTIDAD:</h3></label>
                                            <input  id="canti" type="text" required=""
                                                    placeholder="Especifique Cantidad"
                                                    class="form-control" min="1" 
                                                    required  name="vcant"
                                                    onkeyup="nronegativo(), calsubtotal()"
                                                    onchange="nronegativo(), calsubtotal()"
                                                    onmouseup="calsubtotal()"
                                                    pattern="[0-9]{1,100}"title="La cantidad debe ser minimamente 1"
                                                    minlength="1" maxlength="100" 
                                                    value="1" >
                                        </div>
                                        
                                    </div>
                                    
                                    <span class="col-md-1"></span>
                                    <div class="form-group" style="display: block" id="plazo_garantia">
                                        <div class="col-md-5 "> 
                                            <label class="col-md-1 control-label"><h3>PLAZO GARANTIA:</h3></label>
                                            <input   type="number" required="" id="plazo"
                                                     placeholder="Especifique precio" 
                                                     class="form-control" 
                                                     onkeyup="nronegativo2()"
                                                    onchange="nronegativo2()" 
                                                     required min="30" max="365" name="vplazo_garan"
                                                     value="30">
                                        </div>
                                        
                                        
                                        <div class="col-md-5">
                                            <label class="col-md-2 control-label"><h3>DESCRIPCION GARANTIA:</h3></label>
                                            <input  id="canti" type="text" required=""
                                                    placeholder="Especifique descripcion de garantia"
                                                    class="form-control" name="vdescri_garan"
                                                    value="Unicamente Reparacion o Cambio del Producto"
                                                    autofocus="">

                                        </div>
                                        
                                    </div>
                                    
                                    <span class="col-md-1"></span>
                                    <div class="form-group" style="display: block" id="condicion_garan">
                                        <div class="col-md-12"> 
                                            <span class="col-md-5"></span>
                                            <label class="col-md-1 control-label text-center"><h3>CONDICION GARANTIA:</h3></label>
                                            <input   type="text" required="" id="condicion"
                                                     placeholder="Especifique condiciones de garantia"
                                                     class="form-control" name="vcondi_garan"
                                                     value="Respetar manual del vendedor -Factura sin Modificacion -Tiempo Limite -Prohibida la Reparacion no autorizada -No incluye devolucion de dinero">
                                        </div>
                                        
                                    </div>
                                    <span class="col-md-4"></span>
                                    <div class="form-group">
                                        <div class="col-md-5"> 
                                            <span class="col-md-3"></span>
                                            <label class="col-md-2 control-label"><h3>SUBTOTAL:</h3></label>
                                            
                                            <input  id="subtotal_pedi" name="vsubt" type="number" required="" readonly=""
                                                    placeholder="Especifique Subtotal"
                                                    class="form-control" min="1" value="0">
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

<!--confirmar - registrar orden-->

                <div id="orden_confirma" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg ">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header alert-success">
                                <button type="button" class="close" 
                                        data-dismiss="modal" arial-label="Close">x</button>
                                <h4 class="modal-title"><strong>REGISTRAR DETALLE POR ORDEN</strong></h4>
                            </div>
                            <form action="compra_control_deta.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body">
                                    <input name="accion" value="1" type="hidden"/>
                                    <input type="hidden" name="pagina" value="compra_agregar.php">
                                    <input type="hidden" name="vcodcomp" value="<?php echo $_REQUEST['vcodcomp'] ?>">
                                    <input type="hidden" name="vpedi" value="<?php echo $_REQUEST['vpedi'] ?>">
                                    <input type="hidden" name="vorden" value="<?php echo $_REQUEST['vorden'] ?>">
                                    <input type="hidden" name="vestado" value="CONFIRMADO">
                                    <input type="hidden"  id="articulo_oculto" name="articulo_oculto" value="">
                                    <input type="hidden"  id="deposito_oculto" name="deposito_oculto" value="">
                                    
                                    <span class="col-md-3"></span>
                                    <div class="form-group">
                                        <div class="col-md-5">
                                            <span class="col-md-3"></span>
                                    <label class="col-md-1 control-label"><h3>GARANTIA:</h3></label>
                                            <select name="vgarantia" class="form-control"
                                                    id="vgarantia2" onchange="tiposelect_orden1(),tiposelect_orden2(),tiposelect_orden3(),tiposelect_orden4() ">
                                                <option value="CON">CON GARANTIA</option>
                                                <option value="SIN">SIN GARANTIA</option>
                                            </select>
                                        </div>
                                    </div>
                                    <span class="col-md-1"></span>
                                    <div class="form-group">

                                   <div class="col-md-5"> 
                                    <label class="col-md-1 control-label"><h3>ARTICULOS:</h3></label>
                                    <?php $articulos = consultas::get_datos("select * from v_articulos order by cod_art asc"); ?>
                                    
                                    <select name="varti" 
                                            class="form-control" id="articulo_orden" 
                                            onchange="deposito_orden()"
                                            onkeypress="deposito_orden()" disabled="">
<!--                                        <option value="0">Seleccione un Articulo</option>-->
                                        <?php
                                        if (!empty($articulos)) {
                                            foreach ($articulos as $articulo) {
                                                ?>  
                                                <option value="<?php echo $articulo['cod_art']; ?>">
                                                    <?php echo $articulo['art_descri']; ?>
                                                </option>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <option value="">Debe insertar un Articulo</option>
                                        <?php } ?>
                                    </select>
                                </div> 
                                            <div class="col-md-5" id="detalles_depo">
                                                <label class="col-md-2 control-label"><h3>DEPOSITO</h3></label>
                                                <select class="form-control" required >
                                                    <option>Seleccione un deposito</option>
                                                </select>
                                            </div>
                                        
                                        <br>

                                    </div>
                                    <BR>
                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                        <div class="col-md-3"> 
                                            <label class="col-md-1 control-label"><h3>PRECIO:</h3></label>
                                            <input   type="number" required=""
                                                     placeholder="Especifique precio"
                                                     class="form-control"
                                                     required min="50"  name="vprecio" id="precio_orden"
                                                    onkeyup="nronegativo3(), calsubtotal2()"
                                                    onchange="nronegativo3(), calsubtotal2()"
                                                    onmouseup="calsubtotal2()"
                                                     value="0">
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <label class="col-md-2 control-label"><h3>CANTIDAD:</h3></label>
                                            <input  id="cantidad_orden" type="number" required="" readonly=""
                                                    placeholder="Especifique Cantidad"
                                                    class="form-control" 
                                                    required  name="vcant"
                                                    value="0">
                                        </div>
                                        
                                       <div class="col-md-4">
                                            <label class="col-md-2 control-label"><h3>SUBTOTAL:</h3></label>
                                            <input  id="subtotal_orden" name="vsubt" type="number" required="" readonly=""
                                                    placeholder="Especifique Subtotal"
                                                    class="form-control" min="1" value="0" >
                                        </div>
                                        
                                    </div>
                                    <span class="col-md-1"></span>
                                    <div class="form-group" style="display: block" id="plazo_garantia2">
                                        <div class="col-md-5 "> 
                                            <label class="col-md-1 control-label"><h3>PLAZO GARANTIA:</h3></label>
                                            <input   type="number" required="" id="plazo_g"
                                                     placeholder="Especifique precio" 
                                                     class="form-control" 
                                                     onkeyup="nronegativo2()"
                                                    onchange="nronegativo2()" 
                                                     required min="30" max="365" name="vplazo_garan"
                                                     value="30">
                                        </div>
                                        
                                        
                                        <div class="col-md-5">
                                            <label class="col-md-2 control-label"><h3>DESCRIPCION GARANTIA:</h3></label>
                                            <input  id="descri_g" type="text" required=""
                                                    placeholder="Especifique descripcion de garantia"
                                                    class="form-control" name="vdescri_garan"
                                                    value="Unicamente Reparacion o Cambio del Producto"
                                                    autofocus="">

                                        </div>
                                        
                                    </div>
                                    
                                    <span class="col-md-1"></span>
                                    <div class="form-group" style="display: block" id="condicion_garan2">
                                        <div class="col-md-12"> 
                                            <span class="col-md-5"></span>
                                            <label class="col-md-1 control-label text-center"><h3>CONDICION GARANTIA:</h3></label>
                                            <input   type="text" required="" id="condicion_g"
                                                     placeholder="Especifique condiciones de garantia"
                                                     class="form-control" name="vcondi_garan"
                                                     value="Respetar manual del vendedor -Factura sin Modificacion -Tiempo Limite -Prohibida la Reparacion no autorizada -No incluye devolucion de dinero">
                                        </div>
                                        
                                    </div>

                                    <br>
                                    <br>

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
            
            
            function pedido_confirma(datos) {
                var dat = datos.split("_");
                $('#cod').val(dat[0]);
                $('#artic').val(dat[1]);
                $('#canti').val(dat[2]);
                console.log(dat[2]);


            }
            
             $("document").ready(function () {
                    deposito();
                    deposito_orden();
                });
           function deposito(){
                    if ((parseInt($('#artic').val()) > 0) || ($('#artic').val() !== "")) {
                        $.ajax({
                            type: "GET",
                            url: "/servitech_tesis/lista_deposito_compra.php?varti=" + 
                                    $('#artic').val (),
                            cache: false,
                            beforeSend: function () {
                                $('#detalles').
                            html('<img src="/servitech_tesis/img/cargando.GIF">\n\
                            <strong><i>Cargando...</i><strong>');
                            },
                                    success: function (msg){
                                        $('#detalles').html(msg);
                                        $('#depositoinvisible').val($('#dep').val());
                                    }
                        });
                        
                        $('#articuloinvisible').val($('#artic').val());
                        
                    }
//                    else if ((parseInt($('#artic').val() == "0"))){
//                        $('#artic').val('');
//                 }       
                }
                
          function orden_confirma(datos) {
                var dat = datos.split("_");
                $('#vcod_orden').val(dat[0]);
                $('#articulo_orden').val(dat[1]);
                $('#precio_orden').val(dat[2]);
                $('#cantidad_orden').val(dat[3]);
                $('#subtotal_orden').val(dat[4]);
                console.log(dat[2]);
            }
            
            function deposito_orden(){
                    if ((parseInt($('#articulo_orden').val()) > 0) || ($('#articulo_orden').val() !== "")) {
                        $.ajax({
                            type: "GET",
                            url: "/servitech_tesis/lista_deposito_compra_orden.php?varti=" + 
                                    $('#articulo_orden').val (),
                            cache: false,
                            beforeSend: function () {
                                $('#detalles_depo').
                            html('<img src="/servitech_tesis/img/cargando.GIF">\n\
                            <strong><i>Cargando...</i><strong>');
                            },
                                    success: function (msg){
                                        $('#detalles_depo').html(msg);
                                        $('#deposito_oculto').val($('#dep').val());
//                                        obtenerprecio();
                                    }
                        });
                        
                        $('#articulo_oculto').val($('#articulo_orden').val());
                        
                    }
//                    else if ((parseInt($('#articulo_orden').val() == "0"))){
//                        $('#articulo_orden').val('');
                 }       
                
                
            function borrar_orden(datos) {
                    var dat = datos.split("_");
                    $('#si').attr('href',
                    'compra_control_deta.php?vcodcomp=' + dat[0] +
                            '&varti=' + dat[1] +
                            '&vdepo=' + dat[10] +
                            '&vprecio=' + dat[2] +
                            '&vcant=' + dat[3] +
                            '&vsubt=' + dat[4] +
                            '&vdescri_garan=' + dat[6] +
                            '&vplazo_garan=' + dat[7] +
                            '&vcondi_garan=' + dat[8] +
                            '&vestado=null' +
                            '&vorden=' + dat[9] +
                            '&accion=2' +
                            '&pagina=compra_agregar.php');
                    $('#confirmacion').html
                    ('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Borrar el Articulo <i><strong>' + dat[5] + '</strong></i> ?')
                
                }
                
            function borrar_pedi(datos) {
                    var dat = datos.split("_");
                    $('#si').attr('href',
                    'compra_control_deta_pedi.php?vcodcomp=' + dat[0] +
                            '&varti=' + dat[1] +
                            '&vdepo=null' +
                            '&vprecio=' + dat[2] +
                            '&vcant=' + dat[3] +
                            '&vsubt=' + dat[4] +
                            '&vdescri_garan=null' +
                            '&vplazo_garan=null' +
                            '&vcondi_garan=null' +
                            '&vestado=null' +
                            '&vpedi=' + dat[6] +
                            '&accion=2' +
                            '&pagina=compra_agregar.php');
                    $('#confirmacion').html
                    ('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Borrar el Articulo <i><strong>' + dat[5] + '</strong></i> ?')
                
                }
            
            function confirmar(datos) {
                    var dat = datos.split("_");
                    $('#si').attr('href',
                    'compra_control_deta_orden.php?vcodcomp=' + dat[0] +
                            '&varti=' + dat[1] +
                            '&vprecio='+ dat[2] +
                            '&vcant=' + dat[3] +
                            '&vsubtotal=' + dat[4] +
                            '&vorden=' + dat[5] +
                            '&accion=1' +
                            '&pagina=compra_agregar.php');
                    $('#confirmacion').html
                    ('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Confirmar este Articulo del Detalle de Orden?');
                
                }
                
                function nronegativo() {

                var numero = document.getElementById("canti").value;
                if (numero.match(/^-?[0-9]+(\.[0-9]{1,2})?$/))
                {
//                    alert("numero ok");
                }
                else
                {
                    notificacion('Atencion','Ingrese su numero sin puntos, letras ni espacios', 'mensaje');
                    document.getElementById("canti").value = "";
                }
            }
            
            function nronegativo1() {

                var numero = document.getElementById("plazo").value;
                if (numero.match(/^-?[0-9]+(\.[0-9]{1,2})?$/))
                {
//                    alert("numero ok");
                }
                else
                {
                    notificacion('Atencion','Ingrese su numero sin puntos, letras ni espacios', 'mensaje');
                    document.getElementById("plazo").value = "";
                }
            }
            
            
            function nronegativo2() {

                var numero = document.getElementById("prec").value;
                if (numero.match(/^-?[0-9]+(\.[0-9]{1,2})?$/))
                {
//                    alert("numero ok");
                }
                else
                {
                    notificacion('Atencion','Ingrese su numero sin puntos, letras ni espacios', 'mensaje');
                    document.getElementById("prec").value = "";
                }
            }
            function nronegativo3() {

                var numero = document.getElementById("precio_orden").value;
                if (numero.match(/^-?[0-9]+(\.[0-9]{1,2})?$/))
                {
//                    alert("numero ok");
                }
                else
                {
                    notificacion('Atencion','Ingrese su numero sin puntos, letras ni espacios', 'mensaje');
                    document.getElementById("precio_orden").value = "";
                }
            }
            //PARA GARANTIA PEDIDO
            function tiposelect1(){
               if (document.getElementById('vgarantia').
                        value === "CON") {
                    $("#plazo_garantia").css("display", "block");
                }
            }
            window.onload = tiposelect1();
            
             function tiposelect2(){
               if (document.getElementById('vgarantia').
                        value === "CON") {
                    $("#condicion_garan").css("display", "block");
                }
            }
            window.onload = tiposelect2();
              
            function tiposelect3(){
                if (document.getElementById('vgarantia').
                       value === "SIN") {
                     $("#plazo_garantia").css("display", "none");
                }
           }
            window.onload = tiposelect3();
            
           function tiposelect4(){
                if (document.getElementById('vgarantia').
                       value === "SIN") {
                     $("#condicion_garan").css("display", "none");
                }
           }
            window.onload = tiposelect4();
       
          function calsubtotal() {
                $('#subtotal_pedi').val(parseInt($('#prec').val()) * parseInt($('#canti').val()));
            }
            //FIN PEDIDO
         //PARA GARANTIA ORDEN
         function tiposelect_orden1(){
               if (document.getElementById('vgarantia2').
                        value === "CON") {
                    $("#plazo_garantia2").css("display", "block");
                }
            }
            window.onload = tiposelect_orden1();
            
             function tiposelect_orden2(){
               if (document.getElementById('vgarantia2').
                        value === "CON") {
                    $("#condicion_garan2").css("display", "block");
                }
            }
            window.onload = tiposelect_orden2();
              
            function tiposelect_orden3(){
                if (document.getElementById('vgarantia2').
                       value === "SIN") {
                     $("#plazo_garantia2").css("display", "none");
                }
           }
            window.onload = tiposelect_orden3();
            
           function tiposelect_orden4(){
                if (document.getElementById('vgarantia2').
                       value === "SIN") {
                     $("#condicion_garan2").css("display", "none");
                }
           }
            window.onload = tiposelect_orden4();
       
          function calsubtotal2() {
                $('#subtotal_orden').val(parseInt($('#precio_orden').val()) * parseInt($('#cantidad_orden').val()));
            }
            //FIN ORDEN
        
        </script>
        
 
    </body>
</html>


