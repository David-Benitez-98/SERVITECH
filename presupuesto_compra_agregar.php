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
                        <h3 class="page-header">Registar Presupuesto Compras 
                            <a href="presupuesto_compra_index.php" 
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
                                Datos Cabecera Presupuesto 
                             </div> 
                                <div class="panel-body">
                             
                            <?php  if (isset($_REQUEST['vpresu'])) { ?>
                            <?php  $presupuestoscompras =  consultas::get_datos("select * from v_presupuesto_compra where cod_presu_comp=".$_REQUEST['vpresu']);?>
                            <?php } ?>
                              
                                    <form action="presupuesto_compra_control2_deta.php" method="post" 
                                      role="form" class="form-horizontal">
                                    <input type="hidden" name="accion" id="accion" value="1">
                                    <input type="hidden" name="vpresu" id="vpresu" value="<?php echo $_REQUEST['vpresu']; ?>"
                                    <input type="hidden" name="vestado" id="vestado" value="PENDIENTE">
                                    <input type="hidden" name="vcod_usu" id="vcod_usu" value="<?php echo $_SESSION['cod_usu']; ?>">
                                    <input type="hidden" name="pagina" value="presupuesto_compra_index.php">
                                    <!-- Grupo de la primera fila-->
                                    
                                    <!-- Campo fecha-->
                                    <div class="form-group">
                                        <label class="col-md-1 control-label">Fecha</label>
                                        <div class="col-md-3">
                                            <input type="date" required="" id="vfecha"
                                                   placeholder="Especifique fecha"
                                                   class="form-control"
                                                   name="vfecha" 
                                                   onmouseup="validar()"
                                                   onkeyup="validar()"
                                                   onchange="validar()"
                                                   onclick="validar()"
                                                   onkeypress="validar()"
                                                   value="<?= !empty($presupuestoscompras[0]['fecha_presu']) ? $presupuestoscompras[0]['fecha_presu'] : date("Y-m-d"); ?>"
                                                   <?= !empty($presupuestoscompras[0]['fecha_presu']) ? 'readonly' : '' ?>
                                       </div>
                                    </div>

                                        <!-- Campo Sucursal-->

                                        <label class="col-md-3 control-label">Sucursal</label>
                                        <div class="col-md-3">
                                        <?php  if (isset($presupuestoscompras[0]['cod_suc'])) { ?>
                                        <?php $sucursales = consultas::get_datos("select * from v_sucursal "
                                                        . " order by cod_suc=".$presupuestoscompras[0]['cod_suc']." desc"); ?>  
                                            
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
                                        
                                    </div>
                            <!-- Campo Proveedor-->
                                    <div class="form-group">
                                        <label class="col-md-1 control-label">Proveedor</label>
                                        <div class="col-md-3">
                                        <?php  if (isset($presupuestoscompras[0]['cod_prov'])) { ?>
                                        <?php $proveedores = consultas::get_datos("select * from v_proveedor3 "
                                                        . " order by cod_prov=".$presupuestoscompras[0]['cod_prov']." desc"); ?>  
                                            
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
<!--                                        Campo Pedido Compra-->
                                        <label class="col-md-3 control-label">Pedido</label>
                                        <div class="col-md-3" >
                                        
                                        <?php $pedidoscompras = consultas::get_datos("select * from v_pedido_compra "
                                                        . " order by cod_pedi_comp=".$presupuestoscompras[0]['cod_pedi_comp']." desc"); ?>  
                                            
                                            
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
                                                    <option value="0">Debe ingresar un Pedido</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        
                                    </div>

                                </form>   
                            </div>
                        </div>
<!--                Aqui Termina la Estructura Cabecera-->

                      <!-- COMIENZO PARA EL DETALLE DEL PRESUPUESTO-->
                      
                         <?php  if (isset($presupuestoscompras[0]['cod_presu_comp'])) { ?>
                                        <?php $detpresupuestoscompras = consultas::get_datos("select * from v_deta_presu_compra "
                                                        . " where cod_presu_comp = " . $_REQUEST['vpresu']); ?>  
                                        
                                        <?php }?>
                        <!-- /.col-lg-12 -->
                                
                        <div class="col-lg-12">
                            
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                Detalles del Presupuesto de Compra
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
<!--                                                <th class="text-center">Acción</th>-->
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

<!-- COMIENZO PARA EL DETALLE AQUI VA UNA TABLA PARA AGREGAR EL DETALLE-->
 <!-- /.col-lg-12 -->
                                
                <div class="col-lg-12">
                    
                    <div class="panel panel-success">
                        
                        <!-- /.panel-heading -->
                        <div class="panel-heading">
                            Detalles del Pedido
                        </div>
                        
                            <?php $detapedidoscompras = consultas::get_datos("select * from v_deta_pedido_comp "
                                            . " where estado='PENDIENTE' and cod_pedi_comp  = " . $_REQUEST['vpedi']);
                            ?> 
                        
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
                                                       type="text" required="" class="form-control" name="product_name[]" 
                                                       placeholder="Descripcion de Articulos" readonly="">
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
                                                       autofocus=""> 
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
                                     <?php  if ($presupuestoscompras[0]['estado_presu']=='ANULADO' || $presupuestoscompras[0]['estado_presu']=='VENCIDO' || $presupuestoscompras[0]['estado_presu']=='RECHAZADO'){?>
                                        
                                   <?php }else {?>
                                       
                                         <?php   
                                    $total = 0;
                                    
                                    if(isset($detapedidoscompras) && count($detapedidoscompras)>0 ){
                                                foreach ($detapedidoscompras as $value){ 
//                                                    $total += $value->det_precio_unit;
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <input style="position: relative;top: 100%;left: 0px;z-index: 100;display: block;vertical-align: top;background-color: transparent;width: 500px;" type="text" required="" class="form-control buscar" name="product_name[]" 
                                                                   placeholder="Buscar por nombre, código" value="<?= isset($value['dato_articulo']) ? $value['dato_articulo'] : ''  ?>" readonly="">
                                                            <input type="hidden" name="cod_art[]" id="cod_art" value="<?= isset($value['cod_art']) ? $value['cod_art'] : ''  ?>">
                                                            
                                                            
                                                        </td>
                                                        
                                                        <td class="text-center"> 
                                                        <img height="45px" style="text-align: center" src="img/<?= isset ($value['art_imagen']) ? $value['art_imagen'] : 'No Existe Articulo' ?>" /> </td>
                                                        
                                                        <td class="text-center">
                                                            <input class="form-control text-center det-cant" type="number" min="1" required=""
                                                                   name="det_cantidad[]" id="detalle_cantidad" style="text-align: center"
                                                                   value="<?= isset($value['pedi_canti']) ? $value['pedi_canti'] : '1'  ?>" onkeyup="actSubtotales(this);"
                                                                   autofocus=""
                                                                   >
                                                        </td>
                                                        
                                                        <td class="text-center">
                                                                    <input class="form-control text-center" type="number" min="1" 
                                                                           name="presu_prec_comp[]" id="presu_prec_compra" style="text-align: center"
                                                                            value="<?= isset($value['presu_prec_comp']) ? $value['presu_prec_comp'] : ''  ?>"  onkeyup="actSubtotales(this);" 
                                                                            autofocus="">  
                                                        </td>
                                                        
                                                        <td class="text-center">
                                                            <input class="form-control row-subtotal" type="number" name="subtotal_presu[]" id="subtotal_presu" placeholder="Subtotal" value="0" readonly=""
                                                        <?= isset($value['subtotal_presu']) ? number_format($value['presu_prec_comp'] * $value['pedi_canti'], 0, ',', '.') : ''  ?> autofocus=""/>
                                                            
                                                            
                                                        </td>
                                                        
                                                        <td class="text-center">
                                                            <input class="form-control text-center " type="text" 
                                                                   name="estado_deta_presu[]" id="estado_deta_presu" style="text-align: center" readonly=""
                                                        value="<?= isset($value['estado_deta_presu']) ? $value['estado_deta_presu'] : 'PENDIENTE'  ?>" 
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
                                     <?php  }  ?>
<!--                                        aka iba el if detalle-->
                                    </tbody>
<!--                                  Hasta Aqui  Contenido de la Tabla-->
                                </table>
                                  

                                
                                <div class="form-row mb-4">
                                    <div class="col">
                                        <label for="exampleForm2">Total</label>
                                        <input type="number" id="total_presu_comp" name="total_presu_comp" class="form-control"  value="<?= isset($total) ? number_format($total, 0, ',', '.') : 0 ?>"  readonly="">  
                                    </div>
                                </div>
                                
                                <?php } else { ?>
                                    <div class="col-md-12">
                                        <div class="alert alert-info alert-dismissable">
                                            <button type="button" class="close"
                                                    data-dismiss="alert" aria-hidden="true">&times;
                                            </button>
                                            <strong>No se encontraron detalles del pedido de compras....!</strong>
                                        </div>
                                    </div>
                                </div>
                            <!-- /.table-responsive -->
                            <?php } ?>
                            </div>
                            
                        </div>
                    
                   
           
                        <!-- /.panel-body -->
                        </div>
 
    </div>


           
                <!-- /.col-lg-12 -->
 
                    </div>
                    
                </div>
<!--                El hr es para poner una linea divisora-->
                <hr>
                <?php  if ($presupuestoscompras[0]['estado_presu']=='ANULADO' || $presupuestoscompras[0]['estado_presu']=='VENCIDO' || $presupuestoscompras[0]['estado_presu']=='RECHAZADO' ){?>
                
                <?php }else {?>
                     <div class="form-group">
                     <div class="col-md-offset-5 col-md-10">
                         <button type="button" id="grabar" onclick="grabar()" type="submit" class="btn-outline btn-primary btn-lg fa fa-floppy-o"> Grabar Presupuesto</button>

                      </div>
                       </div>
                 <?php } ?>
                 
                
            </div >
                                    
        </div>
                                            
                                    

        <!--archivos js-->  
        <?php require 'menu/js.ctp'; ?>
        
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
                        
                        //creo una variable cant para almacenar la cantidad de productos solicitados para luego multiplicar por el precio
                        $(event.currentTarget).parents('tr').find("[name='det_cantidad[]']").val(data.det_cantidad);
                        //precio unitario
                        $(event.currentTarget).parents('tr').find("[name='presu_prec_comp[]']").val(data.presu_prec_comp);
                        
                        //mostrar el subtotal
                        $(event.currentTarget).parents('tr').find(".row-subtotal").html(LformatNumber.new(data.presu_prec_comp * data.det_cantidad));
                       // mostrar el precio unitario en el campo
                        $(event.currentTarget).parents('tr').find(".product-price").html(formatNumber.new(data.presu_prec_comp));
                        $(event.currentTarget).parents('tr').find(".product-price").html(formatNumber.new(data.data.det_cantidad));
                        
                        $("#total_presu_comp").val(formatNumber.new(data.presu_prec_comp * data.det_cantidad));
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
                        var precio_deta = $(tr).find("[name='presu_prec_comp[]']").val();
                        var cantidad = $(tr).find("[name='det_cantidad[]']").val();
                        var subtotal_deta = $(tr).find("[name='subtotal_presu[]']").val();
                        var estado_deta = $(tr).find("[name='estado_deta_presu[]']").val();
                       
                        //yo solo necesito codigo y cantidad y estado
                        if (codigo_arti !== ""&& precio_deta !== "" && precio_deta !== "-" && precio_deta !== "+" && precio_deta > "0"
                            && cantidad !== "" && cantidad !== "-" && cantidad !== "+" && cantidad > "0" && subtotal_deta !== ""&& estado_deta !== "") {
                            TableData[row] = {
                                "cod_art": codigo_arti,
                                "presu_prec_comp": precio_deta,
                                "detalle_cantidad": cantidad, 
                                "subtotal_presu": subtotal_deta, 
                                "estado_deta_presu":estado_deta,
                           }
                        }
                    });
                    
                    //hasta aqui
//                  var totales = $("#total_presu_comp").val().replace(/\./g, '');
                    if (TableData.length !== 0) {
                      
                        $.ajax({
                            url: '/servitech_tesis/presupuesto_compra_control2_deta.php',
                            type: "POST",
//                            dataType: 'json',
                            data: {
                                    detalles: TableData,
                                    vpresu: $("#vpresu").val(),
                                    total_presu_comp: $("#total_presu_comp").val(),
                                    accion: $("#accion").val(), 
                                    pagina: $("#pagina").val(),
                                    vpedi: $("#vpedi").val()
                                  },
                           
                            success: function(respuesta){
                                 console.log(respuesta.mensaje);
                               
                                 notificacion("Atencion","Guardado exitosamente", "success");
                                 setTimeout(function () {
                                        //  window.location.href = "./orden_compra_agregar.php";
                                          window.location.href = "./presupuesto_compra_agregar.php?vpresu="+<?=$_REQUEST['vpresu']?>+'&vpedi='+<?=$_REQUEST['vpedi']?>
                                        
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
                    
                    var precio = parseInt($(obj).parents("tr").find("[name='presu_prec_comp[]']").val());
                    var cantidad = parseInt($(obj).parents("tr").find("[name='det_cantidad[]']").val());
                    subtotal = cantidad * precio;
                     
                    console.log(subtotal);
                    $(obj).parents("tr").find(".row-subtotal").val(subtotal);
  
                     $(".item-table tbody tr:not(.hidden-row)").each(function(idx, obj) {
                        row = {
                            'subtotal'   : parseInt($(obj).find(".row-subtotal").val()),
                        };
                       total += row.subtotal; 
                       
   
                       
                       $("#total_presu_comp").val(total);
                       
                       
                    }); 
                    
                    console.log(total.toLocaleString());
                     
                   
                }
                
                function actTotal(t) {       
                    actSubtotales();
                }
                
//               
                
        </script>

    </body>
</html>
