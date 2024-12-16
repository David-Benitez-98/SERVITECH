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
                        <h3 class="page-header">Registar Orden Compras 
                            <a href="orden_compra_index.php" 
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
                                Datos Cabecera Orden de Compra 
                             </div> 
                                <div class="panel-body">
                             
                            <?php  if (isset($_REQUEST['vorden'])) { ?>
                            <?php  $ordenescompras =  consultas::get_datos("select * from v_orden_compra3 where id_orden_compra=".$_REQUEST['vorden']);?>
                            <?php } ?>
                              
                                    <form action="orden_compra_control" method="post" 
                                      role="form" class="form-horizontal">
                                    <input type="hidden" name="accion" id="accion" value="1">
                                    <input type="hidden" name="vorden" id="vorden" value="<?php echo $_REQUEST['vorden']; ?>"
                                    <input type="hidden" name="vestado" id="vestado" value="PENDIENTE">
                                    <input type="hidden" name="vcod_usu" id="vcod_usu" value="<?php echo $_SESSION['cod_usu']; ?>">
                                    <input type="hidden" name="pagina" value="orden_compra_index.php">
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
                                                   value="<?= !empty($ordenescompras[0]['fecha_orden']) ? $ordenescompras[0]['fecha_orden'] : ''; ?>"
                                                   <?= !empty($ordenescompras[0]['fecha_orden']) ? 'readonly' : ''; ?>>
                                                  
                                    </div>

                                        <!-- Campo Sucursal-->

                                        <label class="col-md-1 control-label">Sucursal</label>
                                        <div class="col-md-3">
                                        <?php  if (isset($ordenescompras[0]['cod_suc'])) { ?>
                                        <?php $sucursales = consultas::get_datos("select * from v_sucursal "
                                                        . " order by cod_suc=".$ordenescompras[0]['cod_suc']." desc"); ?>  
                                            
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
                                        <?php  if (isset($ordenescompras[0]['cod_prov'])) { ?>
                                        <?php $proveedores = consultas::get_datos("select * from v_proveedor3 "
                                                        . " order by cod_prov=".$ordenescompras[0]['cod_prov']." desc"); ?>  
                                            
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
                                        <?php  if (isset($ordenescompras[0]['cod_pedi_comp'])) { ?>
                                        <?php $pedidoscompras = consultas::get_datos("select * from v_pedido_compra "
                                                        . " order by cod_pedi_comp=".$ordenescompras[0]['cod_pedi_comp']." desc"); ?>  
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
                                        <label class="col-md-1 control-label">Presupuesto</label>
                                        <div class="col-md-3">
                                        <?php  if (isset($ordenescompras[0]['cod_presu_comp'])) { ?>
                                        <?php $presupuestoscompras = consultas::get_datos("select * from v_presupuesto_compra "
                                                        . " order by cod_presu_comp=".$ordenescompras[0]['cod_presu_comp']." desc"); ?>  
                                        <?php } else { ?>
                                            
                                        <?php }?>
                                            
                                            <select name="vpresu" id="vpresu" 
                                            onchange="detallespedidos()" onkeyup="detallespedidos()"
                                            class="form-control" disabled="">
                                                <?php
                                                if (!empty($presupuestoscompras)) {
                                                    foreach ($presupuestoscompras as $presupuestocompra) {
                                                        ?>
                                                        <option value="<?php echo $presupuestocompra['cod_presu_comp']; ?>">
                                                            <?php echo $presupuestocompra['descripcion_pedido']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="0">Orden de Compra sin Presupuesto</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        
                                        <label class="col-md-1 control-label">Total Orden:</label>
                                        <div class="col-md-3">
                                            <input type="number" 
                                                   placeholder="Especifique Total"
                                                   class="form-control"
                                                   name="vtotal"
                                                   readonly=""
                                                   value="<?= !empty($ordenescompras[0]['total_orden']) ? $ordenescompras[0]['total_orden'] : 0; ?>">
                                                  
                                    </div>
                                        
                                    </div>

                                </form>   
                            </div>
                        </div>
<!--                Aqui Termina la Estructura Cabecera-->

                    <!-- COMIENZO PARA EL DETALLE ORDEN-->
                          
                    <?php  if (isset($_REQUEST['vorden'])) { ?>
                    <?php $detordenescompras = consultas::get_datos
                    ("select * from v_det_orden_compra where id_orden_compra=" . $_REQUEST['vorden'] . " order by cod_art asc");?>
                    <?php } ?>
                <div class="col-lg-12">
                    
                        <!-- <div class="col-md-12">-->
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                Detalle de Orden Compra
                            </div>
                            <?php if (!empty($detordenescompras)) { ?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Articulos</th>
                                                <th class="text-center">Precio Compra</th>
                                                <th class="text-center">Cantidad</th>
                                                <th class="text-center">Subtotal</th>
                                                <th class="text-center">Estado</th>
<!--                                                <th class="text-center">Acción</th>-->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($detordenescompras as $detordencompra) { ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $detordencompra['cod_art']; ?></td>
                                                    <td class="text-center"><?php echo $detordencompra['dato_articulo']; ?></td>
                                                    <td class="text-center"><?php echo number_format($detordencompra['prec_unit_ordencomp'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo $detordencompra['cantidad']; ?></td>
                                                    <td class="text-center"><?php echo number_format($detordencompra['subtototal'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo $detordencompra['esta_detalle']; ?></td>
                                                    <td class="text-center">
                                                         <?php   if($ordenescompras[0]['estado_orden_compra']=='CONFIRMADO' || $ordenescompras[0]['estado_orden_compra']=='ANULADO' 
                                                                 || $ordenescompras[0]['estado_orden_compra']=='REALIZADO' || $ordenescompras[0]['estado_orden_compra']=='FACTURADO'){?>
                                                        
                                                         <?php }else{?> 
                                                        <?php   if(!empty($presupuestocompra['cod_presu_comp'])){?>
                                                        <a onclick="borrar_presu(<?php echo "'".$_REQUEST['vorden'] . "_" .
                                                        $detordencompra['cod_art'] . "_" .
                                                        $detordencompra['prec_unit_ordencomp'] . "_" .
                                                        $detordencompra['cantidad'] . "_" .
                                                        $detordencompra['subtototal'] . "_" .       
                                                        $detordencompra['dato_articulo'] . "_" .
                                                        $_REQUEST ['vpresu']. "'"
                                                        ?>)"
                                                           class="btn btn-xs btn-danger"
                                                           rel="tooltip" data-title="Borrar"
                                                           data-toggle="modal"
                                                           data-target="#delete">
                                                            <span class="glyphicon glyphicon-trash"></span></a>
                                                            
                                                             <?php }else if(!empty($pedidocompra['cod_pedi_comp'])){?>  
                                                                 <a onclick="borrar_pedi(<?php echo "'".$_REQUEST['vorden'] . "_" .
                                                        $detordencompra['cod_art'] . "_" .
                                                        $detordencompra['prec_unit_ordencomp'] . "_" .
                                                        $detordencompra['cantidad'] . "_" .
                                                        $detordencompra['subtototal'] . "_" .       
                                                        $detordencompra['dato_articulo'] . "_" .
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
                                </div>
                            <?php } ?>
                        </div>
    
                </div>
                    
                    
                        <!-- COMIENZO PARA EL DETALLE DEL PRESUPUESTO-->
                      
                         <?php  if (isset($ordenescompras[0]['cod_presu_comp'])) { ?>
                                        <?php $detpresupuestoscompras = consultas::get_datos("select * from v_deta_presu_compra "
                                                        . " where estado_deta_presu='PENDIENTE' and cod_presu_comp = " . $_REQUEST['vpresu']); ?>  
                                        
                                        <?php }?>
                        <!-- /.col-lg-12 -->
                                
                        <div class="col-lg-12">
                            
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                Detalles del Presupuesto para Insertar el Detalle de la Orden
                            </div>
                            <?php if (!empty($detpresupuestoscompras)) { ?>
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
                                                <?php foreach ($detpresupuestoscompras as $detpresupuestocompra) { ?> 
                                                    <tr>
                                                    <td class="text-center"><?php echo $detpresupuestocompra['cod_art']; ?></td>
                                                    <td class="text-center"><?php echo $detpresupuestocompra['dato_articulo']; ?></td>
                                                    <td class="text-center"> 
                                                        <img height="45px" src="img/<?php echo $detpresupuestocompra['art_imagen'];?>" /> </td>
                                                    <td class="text-center"><?php echo number_format($detpresupuestocompra['presu_prec_comp'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo $detpresupuestocompra['presu_canti']; ?></td>
                                                    <td class="text-center"><?php echo number_format($detpresupuestocompra['subtotal_presu'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo $detpresupuestocompra['estado_deta_presu']; ?></td>
                                                    <td class="text-center">
                                                            
                                                         <?php if($detpresupuestocompra['estado_deta_presu']=='CONFIRMADO'){ ?>
                                                                
                                                           <?php }else{?>   
                                                            
                                                        <a onclick="confirmar(<?php echo "'".$_REQUEST['vorden'] . "_" .
                                                        $detpresupuestocompra['cod_art'] . "_" .
                                                        $detpresupuestocompra['presu_prec_comp'] . "_" .
                                                        $detpresupuestocompra['presu_canti'] . "_" .
                                                        $detpresupuestocompra['subtotal_presu'] . "_" .       
                                                        $_REQUEST ['vpresu']."'"       
                                                        ?>)"
                                                               class="btn btn-xs btn-success" rel='tooltip' data-title="Confirmar"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-ok-sign"></span></a>
                                                                
<!--                                                            <a href="#" class="btn btn-xs btn-primary" rel="tooltip" data-title="Imprimir"
                                                               <span class="glyphicon glyphicon-print"></span></a>-->
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
                                            <strong>No se encontraron detalles para el presupuesto....!</strong>
                                        </div>
                                    </div>
                                
                            <?php } ?>
                        </div>
                        </div>
                            
                        </div>

<!-- COMIENZO PARA EL DETALLE AQUI VA UNA TABLA PARA AGREGAR EL DETALLE-->
 <!-- /.col-lg-12 -->
                                
                <div class="col-lg-12">
                    
                    <div class="panel panel-success">
                        
                        <!-- /.panel-heading -->
                        <div class="panel-heading">
                            Detalle de Orden de Compra - Obtenido del Pedido
                        </div>
                        
                            <?php  if (isset($ordenescompras[0]['cod_pedi_comp'])) { ?>
                             <?php $detapedidoscompras = consultas::get_datos("select * from v_deta_pedido_comp "
                            . " where estado='PENDIENTE' and cod_pedi_comp  = " . $_REQUEST['vpedi']);?> 
                             <?php } ?>
                        
<!--                         de aka saque la consulta-->
                        <?php if (!empty($detapedidoscompras)) { ?>
                        <div class="panel-body">
                            <div class="table-responsive" id="detapedido">
                                                                
<!--                                Aqui tiene que estar la tabla segun el pedido que se seleccione-->
                        <table class="table table-striped item-table" cellspacing="0" width="100%">
<!--                                    Titulos de la Tabla-->
                                    <thead>
                                        <tr>
                                            <th style="width:25%;">Articulo</th>
                                            <th  style="width:10%;" class="text-center">Imagen</th>
                                            <th  style="width:10%;" class="text-center">Cantidad</th>
                                            <th style="width:10%;" class="text-center">Precio Unit</th>
                                            <th style="width:10%;" class="text-center">Subtotal</th>
                                            <th style="width:10%;" class="text-center">Estado</th>
                                            
                                        </tr>
                                    </thead>
<!--                                    Contenido de la Tabla-->
                                    <tbody>
<!--                                        Aqui le falta la palabra al tr  clas="hidden-row"-->
                                        <tr class="hidden-row">
                                            <td>
                                                <input style="position: relative;top: 100%;left: 0px;z-index: 100;display: block;vertical-align: top;background-color: transparent;width: 400px;" 
                                                       type="text" class="form-control" name="product_name[]" 
                                                       placeholder="Descripcion de Articulos" readonly="" required="">
                                                <input type="hidden" name="cod_art[]" id="cod_art">
                                                <input type="hidden" name="pedi_canti[]" id="pedi_canti"/>
                                                
                                            </td>
<!--                                            <td class="text-center">
                                                <span class="product-price"></span>
                                            </td>-->
                                            
                                            <td class="text-center">
                                                <input class="form-control text-center det-cant" type="number" min="1" value="1"
                                                       name="cantidad_deta[]" id="cantidad_detalle" style="text-align: center" readonly=""
                                                       autofocus="" > 
                                            </td>
                                            
                                            <td class="text-center">
                                                <input class="form-control text-center det-cant" type="number" min="1" 
                                                       name="presu_prec[]" id="presu_prec" style="text-align: center"  
                                                      required="" autofocus="" > 
                                            </td>
                                            
                                            <td class="text-center">
                                            <input class="form-control" type="number" name="subtotal_pre" id="subtotal_pre" placeholder="Subtotal"  style="text-align: center" 
                                             autofocus=""/>
                                     
                                            </td>
                                            
                                            <td class="text-center">
                                                <input class="form-control text-center det-cant" type="text"  value="PENDIENTE"
                                                       name="estado_prueba" id="estado_prueba" style="text-align: center" readonly=""
                                                       autofocus="" > 
                                            </td>
                              
                                            <td class="text-center " >
                                                <a href="javascript:void(0);" title="Borrar" class="btn btn-danger btn-sm" onclick="eliminar(this)">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                            </td>
                                        </tr>
                                         <?php   
                                    $total = 0;
                                    if(isset($detapedidoscompras) && count($detapedidoscompras)>0 ){
                                                foreach ($detapedidoscompras as $value){ 
//                                                    $total += $value->det_precio_unit;
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <input style="position: relative;top: 100%;left: 0px;z-index: 100;display: block;vertical-align: top;background-color: transparent;width: 441px;" type="text" required="" class="form-control buscar" name="product_name[]" 
                                                                   placeholder="Buscar por nombre, código" value="<?= isset($value['dato_articulo']) ? $value['dato_articulo'] : ''  ?>" readonly="">
                                                            <input type="hidden" name="cod_art[]" id="cod_art" value="<?= isset($value['cod_art']) ? $value['cod_art'] : ''  ?>">
                                                            
                                                            
                                                        </td>
                                                        
                                                        <td class="text-center"> 
                                                        <img height="45px" style="text-align: center" src="img/<?php echo $value['art_imagen'];?>" /> </td>
                                                        
                                                        <td class="text-center">
                                                            <input class="form-control text-center det-cant" type="number" min="1" required=""
                                                                   name="cantidad[]" id="cantidad" style="text-align: center"
                                                                   value="<?= isset($value['pedi_canti']) ? $value['pedi_canti'] : '1'?>" onkeyup="actSubtotales(this);"
                                                                   autofocus="">
                                                        </td>
                                                        
                                                        <td class="text-center">
                                                            <input class="form-control text-center" type="number" min="1" required=""
                                                                           name="prec_unit_ordencomp[]" id="prec_unit_ordencomp" style="text-align: center"
                                                                            value="<?= isset($value['prec_unit_ordencomp']) ? $value['prec_unit_ordencomp'] : ''  ?>"  onkeyup="actSubtotales(this);" 
                                                                            autofocus="">  
                                                        </td>
                                                        
                                                        <td class="text-center">
                                                            <input class="form-control row-subtotal" type="number" name="subtototal[]" id="subtototal" placeholder="Subtotal" value="0" readonly="" 
                                                        <?= isset($value['subtototal']) ? number_format($value['prec_unit_ordencomp'] * $value['pedi_canti'], 0, ',', '.') : ''  ?> autofocus=""/>
                                                            
                                                            
                                                        </td>
                                                        
                                                        <td class="text-center">
                                                            <input class="form-control text-center " type="text" 
                                                                   name="esta_detalle[]" id="esta_detalle" style="text-align: center" readonly=""
                                                        value="<?= isset($value['esta_detalle']) ? $value['esta_detalle'] : 'PENDIENTE'  ?>" 
                                                        autofocus="">  
                                                        </td>

                                                        
                                                        <td class="text-center" style="display:none">
                                                            <a href="javascript:void(0);" title="Borrar" class="btn btn-danger btn-xs" onclick="eliminar(this)" disabled>
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                        <?php } ?>
                                     <?php  }  ?>
<!--                                        aka iba el if detalle-->
                                    </tbody>
<!--                                  Hasta Aqui  Contenido de la Tabla-->
                                </table>
                                  
                                <div class="form-row mb-4">
                                    <div class="col">
                                        <label for="exampleForm2">Total</label>
                                        <input type="number" id="total_orden" name="total_orden" class="form-control"  value="<?= isset($total) ? number_format($total, 0, ',', '.') : 0 ?>"  readonly="">  
                                    </div>
                                </div>
                                
                                <?php } else { ?>
                                    <div class="col-md-12">
                                        <div class="alert alert-dismissable alert-dismissable">
                                            <button type="button" class="close"
                                                    data-dismiss="alert" aria-hidden="true">&times;
                                            </button>
                                            <strong>No se encontraron detalles para el pedido....!</strong>
                                        </div>
                                    </div>
                            <!-- /.table-responsive -->
                            <?php } ?>
                            </div>
                            
                        </div>
                    
                        <!-- /.panel-body -->
                        </div>
 
                       
                         <!-- /.col-lg-12 -->
 
        </div>

    </div>
                    
 </div>
<!--                El hr es para poner una linea divisora-->
                <hr>
                     <div class="form-group">
                     <div class="col-md-offset-5 col-md-10">
                         <button type="button" id="grabar" onclick="grabar()" type="submit" class="btn-outline btn-primary btn-lg fa fa-floppy-o"> Grabar Detalle</button>

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
            function borrar_presu(datos) {
                    var dat = datos.split("_");
                    $('#si').attr('href',
                    'orden_compra_control_deta_presu.php?vorden=' + dat[0] +
                            '&varti=' + dat[1] +
                            '&vprecio='+ dat[2] +
                            '&vcant=' + dat[3] +
                            '&vsubtotal=' + dat[4] +
                            '&vpresu=' + dat[6] +
                            '&accion=2' +
                            '&pagina=orden_compra_agregar.php');
                    $('#confirmacion').html
                    ('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Borrar el Articulo <i><strong>' + dat[5] + '</strong></i> ?')
                
                }
                
            function borrar_pedi(datos) {
                    var dat = datos.split("_");
                    $('#si').attr('href',
                    'orden_compra_control_deta_pedi.php?vorden=' + dat[0] +
                            '&varti=' + dat[1] +
                            '&vprecio=' + dat[2] +
                            '&vcant=' + dat[3] +
                            '&vsubtotal=' + dat[4] +
                            '&vpedi=' + dat[6] +
                            '&accion=2' +
                            '&pagina=orden_compra_agregar.php');
                    $('#confirmacion').html
                    ('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Borrar el Articulo <i><strong>' + dat[5] + '</strong></i> ?')
                
                }
            
            function confirmar(datos) {
                    var dat = datos.split("_");
                    $('#si').attr('href',
                    'orden_compra_control_deta_presu.php?vorden=' + dat[0] +
                            '&varti=' + dat[1] +
                            '&vprecio='+ dat[2] +
                            '&vcant=' + dat[3] +
                            '&vsubtotal=' + dat[4] +
                            '&vpresu=' + dat[5] +
                            '&accion=1' +
                            '&pagina=orden_compra_agregar.php');
                    $('#confirmacion').html
                    ('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Confirmar este Articulo del Detalle de Presupuesto?');
                
                }
        
        </script>
        
        <script type="text/javascript">
          $(document).ready(function () {
                $(this).on("click", ".btn-add-row", function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var $this = $(this),
                            tableRef = $this.parents(".item-table"),
                            row = tableRef.find(".hidden-row").clone();

                    if ($this.hasClass('disabled')) {
                        return false;
                    }
                    $this.addClass('disabled');
                    if (row.length > 0) {
                        row.removeClass("hidden-row");
                        if (row.find(".buscar").length > 0) {
                            row.find(".buscar").attr("required", "required")
                                    .removeClass("buscar").addClass("buscar");
                            var url = '',
                                    defaultValue = row.find(".buscar").data("val");
                            typeaheadInit(row.find(".buscar"), url, defaultValue);
                        }
                        tableRef.find("tbody").append(row);
                    }
                    $this.removeClass('disabled');
                });
 
          });

                    
          function typeaheadInit(el, url, defaultValue){
                $(el).typeahead(null, {
                    source: new Bloodhound({
                        remote: {
                            url: '/servitech_tesis/lista_articulos_1.php',
                            prepare: function (query, settings) {
                                settings.url = settings.url + '?q=' + query
                                return settings;
                            }
                        },
                        datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
                        queryTokenizer: Bloodhound.tokenizers.whitespace,
                    }).ttAdapter(),
                    limit:100,
                    name: 'cod_art',
                    async: true,
                    displayKey: 'dato_articulo',
                    templates: {
                        empty: [
                            '<div class="list-group search-results-dropdown">' +
                                '<div class="list-group-item">No se encontraron resultados.</div>' +
                            '</div>'
                        ],
                        header: [],
                        suggestion: function (data) {
                            return '<p style="white-space:normal;margin-bottom:1px;">' + data.cod_art + "-" + data.dato_articulo + '</p>'
                        }
                    }
                }).bind("typeahead:selected", function (event, data) {
                        var exists = false;
                        $(event.currentTarget).parents('tr').find("[name='cod_art[]']").val(data.cod_art);
                        
                        $(".item-table [name='cod_art[]']").each(function(index, el){
                            if( $(el).val() == data.cod_art ){//pregunta dentro de un foreach si el producto se encuentra en la lista
                                exists = true;
                                return false;
                            }
                        });
                      /*  if( exists ){//consulto si el producto existe en el listado
                            mensajes("error","El producto ya fue agregado a su lista");
                            $(this).parent().parent().parent().remove();
                            $(".btn-add-row").trigger('click');
                            return false;
                        }*/
                        //si no existe el producto guardo el cod_art en name=cod_art
                        //$(event.currentTarget).parents('tr').find("[name='cod_art[]']").val(data.cod_art);
                        //obtengo la cantidad del stock del articulo seleccionado
                        //$(event.currentTarget).parents('tr').find("[name='cantStock[]']").val(data.cantidad);
                        
                        
                        //precio unitario
                        $(event.currentTarget).parents('tr').find("[name='prec_unit_ordencomp[]']").val(data.prec_unit_ordencomp);
                        //creo una variable cant para almacenar la cantidad de productos solicitados para luego multiplicar por el precio
                        $(event.currentTarget).parents('tr').find("[name='cantidad[]']").val(data.cantidad);
                      
                        //mostrar el subtotal
                        $(event.currentTarget).parents('tr').find(".row-subtotal").html(LformatNumber.new(data.cantidad * data.prec_unit_ordencomp));
                       // mostrar el precio unitario en el campo
                        $(event.currentTarget).parents('tr').find(".product-price").html(formatNumber.new(data.prec_unit_ordencomp));
                        $(event.currentTarget).parents('tr').find(".product-price").html(formatNumber.new(data.cantidad));
                        
                        $("#total_orden").val(formatNumber.new(data.cantidad * data.prec_unit_ordencomp));
                        //llama a la funcion actSubtotales para realizar calculos respectivos cada ves
                       //que se agregue un producto
                        actSubtotales();
                   }).typeahead('val', defaultValue).removeAttr('');
                }
                //funcion para borrar lista de detalles de la grilla
                function eliminar(t) {
                //elimina los elementos de una fila de la tabla
                    $(t).parents('tr').remove();
                    actSubtotales();
                }
                
                //funcion para guardar las ventas
                function grabar(){                  
                    var TableData = new Array();
                    $('.item-table tbody tr:not(.hidden-row)').each(function (row, tr) {
                        var codigo_arti = $(tr).find("[name='cod_art[]']").val();
                        var precio_deta = $(tr).find("[name='prec_unit_ordencomp[]']").val();
                        var cantidad = $(tr).find("[name='cantidad[]']").val();
                        var subtotal_deta = $(tr).find("[name='subtototal[]']").val();
                        var estado_deta = $(tr).find("[name='esta_detalle[]']").val();
                       
                        //yo solo necesito codigo y cantidad y estado
                        if (codigo_arti !== "" && precio_deta !== "" && precio_deta !== "-" && precio_deta !== "+" && precio_deta > "0" 
                            && cantidad !== "" && cantidad !== "-" && cantidad !== "+" && cantidad > "0" && subtotal_deta !== ""&& estado_deta !== "") {
                            TableData[row] = {
                                "cod_art": codigo_arti,
                                "prec_unit_ordencomp": precio_deta,
                                "cantidad": cantidad, 
                                "subtototal": subtotal_deta, 
                                "esta_detalle":estado_deta,
                           }
                        }
                    });
                    
                    //hasta aqui
//                  var totales = $("#total_presu_comp").val().replace(/\./g, '');
                    if (TableData.length !== 0) {
                        /*$.ajax({
                            url: "/servitech/orden_compra_control_deta_pedi.php",
                            data: {"detalles": TableData,
                                    "vorden": $("#vorden").val(),
                                    "total_orden": $("#total_orden").val(),
                                    "accion": $("#accion").val(), 
                                    "pagina": $("#pagina").val(),
                                    "vpedi": $("#vpedi").val()
                                  },
                           
                            type: "POST",  
                            dataType: 'JSON',
                            beforeSend: function (xhr) {
                                $("#grabar").attr("disabled", "disabled");
                            },
                            success: function(data){
                                if(data.success) {
                                  notificacion("Atencion", data.mensaje, "success");
                                      setTimeout(function () {
                                          window.location.href = "./orden_compra_index.php";
                                      }, 3000);
                                   
                                } else {
                                    notificacion("Atencion", "Ocurrio un error verifique los datos..", "success");
                                }
                                $("#grabar").removeAttr("disabled");
                            },
                            error: function (data) {
                                notificacion("Atencion", "Error en el proceso de grabado del presupuesto", "error");
                                //alert(data.mensaje);
                            }
                        });*/
        
                        $.ajax({
                            url: '/servitech_tesis/orden_compra_control_deta_pedi.php',
                            type: "POST",
//                            dataType: 'json',
                            data: { detalles: TableData,
                                    vorden: $("#vorden").val(),
                                    total_orden: $("#total_orden").val(),
                                    accion: $("#accion").val(), 
                                    pagina: $("#pagina").val(),
                                    vpedi: $("#vpedi").val()
                                  },
                           
                            success: function(respuesta){
                                 console.log(respuesta.mensaje);
                                 
                               // alert("Guardado Exitosamente");
                                
                                 notificacion("Atencion","Guardado exitosamente", "success");
                                 setTimeout(function () {
                                        //  window.location.href = "./orden_compra_agregar.php";
                                          window.location.href = "./orden_compra_agregar.php?vorden="+<?=$_REQUEST['vorden']?>+'&vpedi='+<?=$_REQUEST['vpedi']?>+'&vpresu='
                                          
                                      }, 3000);
                                 
                            },
                            error: function (data) {
                                notificacion("Atencion", "Error en el proceso de grabado del presupuesto", "error");
                                //alert(data.mensaje);
                            }
                       });
 
                    } else {
                        notificacion("Atencion", "Debe completar los campos del detalle.", "error");
                    }
                }
                
                
                
                 function actSubtotales(obj) {
                     
                    var total = 0;
                    var subtotal = 0;
                    var row = {};
                   
                    var cantidad = parseInt($(obj).parents("tr").find("[name='cantidad[]']").val());
                    var precio = parseInt($(obj).parents("tr").find("[name='prec_unit_ordencomp[]']").val());
                    subtotal = precio * cantidad;
                     
                    console.log(subtotal);
                    $(obj).parents("tr").find(".row-subtotal").val(subtotal);
  
                     $(".item-table tbody tr:not(.hidden-row)").each(function(idx, obj) {
                        row = {
                            'subtototal'   : parseInt($(obj).find(".row-subtotal").val()),
                        };
                       total += row.subtototal; 
                       
   
                       
                       $("#total_orden").val(total);
                       
                       
                    }); 
                    
                    console.log(total.toLocaleString());
                     
                   
                }
                
                function actTotal(t) {       
                    actSubtotales();
                }
                
                
                
        </script>

    </body>
</html>


