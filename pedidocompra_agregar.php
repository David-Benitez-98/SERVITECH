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
                        <h3 class="page-header">Registar Pedido Compras 
                            <a href="pedido_compra_index.php
                               " 
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
                                Datos Cabecera Pedido 
                             </div> 
                                <div class="panel-body">
                             
                            <?php  if (isset($_REQUEST['codigo'])) { ?>
                            <?php  $pedidoscompras =  consultas::get_datos("select * from v_pedido_compra where cod_pedi_comp=".$_REQUEST['codigo']);?>
                            <?php } ?>
                              
                                <form action="pedido_compra_control.php" method="post" 
                                      role="form" class="form-horizontal">
                                    <input type="hidden" name="accion" id="accion" value="1">
                                    <input type="hidden" name="vpedi" id="vpedi" value="0">
                                    <input type="hidden" name="vtotal" value="0">
                                    <input type="hidden" name="vestado" id="vestado" value="PENDIENTE">
                                    <input type="hidden" name="vcod_usu" id="vcod_usu" value="<?php echo $_SESSION['cod_usu']; ?>">
                                    <input type="hidden" name="pagina" value="pedido_compra_index.php">
                                    <!-- Grupo de la primera fila-->
                                    <!--desde aqui-->
                                    <!-- Campo fecha-->
                                    <div class="form-group">
                                        <label class="col-md-1 control-label">Fecha</label>
                                        <div class="col-md-3">
                                            <input type="date" required="" id="vfecha"
                                                   placeholder="Especifique fecha"
                                                   class="form-control"
                                                   name="vfecha" 
                                                   value="<?= !empty($pedidoscompras[0]['fecha_pedido']) ? $pedidoscompras[0]['fecha_pedido'] : date("Y-m-d"); ?>"
                                                   <?= !empty($pedidoscompras[0]['fecha_pedido']) ? 'readonly' : '' ?>>
                                                  
                                          </div>

                                        <!-- Campo Sucursal-->

                                        <label class="col-md-1 control-label">Sucursal</label>
                                        <div class="col-md-3">
                                        <?php  if (isset($pedidoscompras[0]['cod_suc'])) { ?>
                                        <?php $sucursales = consultas::get_datos("select * from v_sucursal "
                                                         . " order by cod_suc=".$pedidoscompras[0]['cod_suc']." desc"); ?>  
                                            
                                        <?php } else { ?>
                                            <?php $sucursales = consultas::get_datos("select * from v_sucursal where cod_suc=".$_SESSION['cod_suc']. ""
                                                        . " order by cod_suc desc"); ?>
                                        <?php }?>
                                            
                                            <select name="vsucursal" id="vsucursal" <?= !empty ($pedidoscompras[0]['cod_suc']) ? 'readonly' : '' ?>
                                                    class="form-control">
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
                                        <!--Campo Descripcion-->
                                        <label class="col-md-1 control-label">Descripcion</label>
                                        <div class="col-md-3">
                                            <input type="text" required="" id="vdescri"
                                                   placeholder="Ingrese Descripcion"
                                                   class="form-control"
                                                   name="vdescri" 
                                                    onblur="sololetras()"
                                                   onkeyup="reemplazar2(),reemplazar3()"
                                                   onchange="reemplazar2(),reemplazar3()"
                                                   pattern="[A-Za-z and 0-9 and #SPACE and Ñ-ñ and ._-]{3,40}" title="Ingresa sólo letras. Tamaño mínimo: 3. Tamaño máximo: 40"
                                                   value="<?php echo !empty ($pedidoscompras[0]['descri_pedido']) ? $pedidoscompras[0]['descri_pedido'] : 'ART '; ?>"
                                                   <?= !empty($pedidoscompras[0]['descri_pedido']) ? 'readonly' : '' ?>
                                                   autofocus="">
                                        </div>
                                    </div> 

                                </form>   
                            </div>
                        </div>
<!--                Aqui Termina la Estructura Cabecera-->

<!-- COMIENZO PARA EL DETALLE AQUI VA UNA TABLA PARA AGREGAR EL DETALLE-->
 <!-- /.col-lg-12 -->
 
                <?php  if (isset($_REQUEST['codigo'])) { ?>
                <?php  $detapedidoscompras =  consultas::get_datos("select * from v_deta_pedido_comp where cod_pedi_comp=".$_REQUEST['codigo']);?>
                <?php } ?>
 
                <div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            Detalle de Pedido Compras
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped item-table" cellspacing="0" width="100%">
<!--                                    Titulos de la Tabla-->
                                    <thead>
                                        <tr>
                                            <th style="width:40%;">Articulo</th>
                                            <th  style="width:10%;" class="text-center">Imagen</th>
                                            <th  style="width:10%;" class="text-center">Cantidad</th>
                                            <th style="width:10%;" class="text-center">Estado</th>                                           
                                            <th style="<?= isset($detapedidoscompras) ? 'display : none' : '' ?> ">
                                                <a href="javascript:void(0);" class='btn btn-primary btn-sm btn-add-row'>
                                                    <span class="fa fa-plus-circle"> Agregar</span></a>
                                                </a>
                                            </th>
                                        </tr>
                                    </thead>
<!--                                    Contenido de la Tabla-->
                                    <tbody>
<!--                                        Aqui le falta la palabra al tr  clas="hidden-row"-->
                                        <tr class="hidden-row">
                                            <td>
                                                <input style="position: relative;top: 100%;left: 0px;z-index: 100;display: block;vertical-align: top;background-color: transparent;width: 1000px;" 
                                                       type="text" required="" class="form-control buscar" name="product_name[]" 
                                                       placeholder="Buscar por nombre, código">
                                                <input type="hidden" name="cod_art[]" id="cod_art">
                                                <input type="hidden" name="pedi_canti[]" id="pedi_canti"/>
                                                <input type="hidden" name="det_estado[]" id="det_estado"/>
                                                
                                            </td>
                                            <td class="text-center">
                                                <span class="imagen"></span>
                                            </td>
                                            
                                            
                                            
                                            <td class="text-center">
                                                <input class="form-control text-center det-cant" type="number" min="1" value="1"
                                                       name="cantidad_deta[]" id="cantidad_detalle" style="text-align: center"
                                                       autofocus="" > 
                                            </td>
<!--                                            <td class="text-center">
                                                <span class="row-subtotal"></span>
                                            </td>-->
                                             <td class="text-center">
                                                 <input class="form-control text-center det-cant" type="text" value="PENDIENTE"  readonly=""
                                                       name="estado_deta[]" id="estado_detalle" style="text-align: center; width: 120px;"
                                                       autofocus=""> 
                                            </td>
<!--                                            <td class="text-center">
                                                <span class="row-subtotal"></span>
                                            </td>-->
              
                                            
                                            <td class="text-center " >
                                                <a href="javascript:void(0);" title="Borrar" class="btn btn-danger btn-sm" onclick="eliminar(this)">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                            </td>
                                        </tr>
<!--                                        //sector nuevo para poder consultar si posee un detalle
                                        //si posee detalle cargado mostrara con los datos cuando el usuario presione el 
                                        //boton de detalles, si presiona nuevo no mostrara esta opcion y seguira el curso
                                        //normal de carga de ventas-->
                                    <?php   
//                                    $total = 0;
                                    if(isset($detapedidoscompras) && count($detapedidoscompras)>0 ){
                                                foreach ($detapedidoscompras as $value){ 
//                                                    $total += $value->det_precio_unit;
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <input style="position: relative;top: 100%;left: 0px;z-index: 100;display: block;vertical-align: top;background-color: transparent;width: 1000px;" type="text" required="" class="form-control buscar" name="product_name[]" 
                                                                   placeholder="Buscar por nombre, código" value="<?= isset($value['datos_articulos']) ? $value['datos_articulos'] : ''  ?>" readonly="">
                                                            <input type="hidden" name="cod_art[]" id="cod_art" value="<?= isset($value['cod_art']) ? $value['cod_art'] : ''  ?>">
                                                        </td>
                                                        
                                                        
                                                        <td class="text-center"> 
                                                            <img height="45px" name="imagen_deta" id="imagen_deta" style="text-align: center" src="img/<?= isset ($value['art_imagen']) ? $value['art_imagen'] : '' ?>" /> </td>
                                                        
                                                        <td class="text-center">
                                                            <input class="form-control text-center det-cant" type="number" min="1" 
                                                                   value="<?= isset($value['pedi_canti']) ? $value['pedi_canti'] : '1'  ?>"
                                                                   name="det_cantidad[]" id="detalle_cantidad" style="text-align: center" readonly="">
                                                        </td>
                                                        <td class="text-center">
                                                            <input class="form-control text-center det-cant" type="text" 
                                                                   value="<?= isset($value['estado']) ? $value['estado'] : ''  ?>"
                                                                   name="det_estado[]" id="detalle_estado" style="text-align: center" readonly="">
                                                        </td>
                                                        
                                                        <td class="text-center" style="display:none">
                                                            <a href="javascript:void(0);" title="Borrar" class="btn btn-danger btn-xs" onclick="eliminar(this)" disabled>
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                        <?php } ?>
                                     <?php  }  ?>
                                        
                                    </tbody>
<!--                                  Hasta Aqui  Contenido de la Tabla-->
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
 
                    </div>
                    
                </div>
<!--                El hr es para poner una linea divisora-->
                <hr>
             <?php    if(!isset($detapedidoscompras)){?>
                     <div class="form-group">
                        <div class="col-md-offset-5 col-md-10">
                         <button type="button" id="grabar" onclick="grabar()" type="submit" class="btn-outline btn-primary btn-lg fa fa-floppy-o"> Grabar Pedido</button>

                        </div>
                       </div>
               <?php  }  ?>
                
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
                            url: '/servitech_tesis/lista_articulos.php',
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
                    displayKey: 'datos_articulos',
                    templates: {
                        empty: [
                            '<div class="list-group search-results-dropdown">' +
                                '<div class="list-group-item">No se encontraron resultados.</div>' +
                            '</div>'
                        ],
                        header: [],
                        suggestion: function (data) {
                            return '<p style="white-space:normal;margin-bottom:1px;width:900px;">' + data.cod_art + "-" + data.datos_articulos + '</p>'
                        }
                    }
                }).bind("typeahead:selected", function (event, data) {
                        var exists = false;
                     //   $(event.currentTarget).parents('tr').find("[name='cod_art[]']").val(data.cod_art);
                        
                        $(".item-table [name='cod_art[]']").each(function(index, el){
                            if( $(el).val() === data.cod_art ){//pregunta dentro de un foreach si el producto se encuentra en la lista
                                exists = true;
                                return false;
                            }
                        });
                        if(exists){//consulto si el producto existe en el listado
                            notificacion("Atencion","El producto ya fue agregado a su lista","error");
                            $(this).parent().parent().parent().remove();
                            $(".btn-add-row").trigger('click');
                            return false;
                        }  
                        //   si no existe el producto guardo el cod_art en name=cod_art
                        $(event.currentTarget).parents('tr').find("[name='cod_art[]']").val(data.cod_art);




                        //$(event.currentTarget).parents('tr').find("[name='cod_art[]']").val(data.cod_art);
                        //obtengo la cantidad del stock del articulo seleccionado
                        //$(event.currentTarget).parents('tr').find("[name='cantStock[]']").val(data.cantidad);
                        //precio unitario
                        
                        //creo una variable cant para almacenar la cantidad de productos solicitados para luego multiplicar por el precio
                        //var cant = $(event.currentTarget).parents('tr').find("[name='cantidad[]']").val();
                      
                        //mostrar el subtotal
                        //$(event.currentTarget).parents('tr').find(".row-subtotal").html(formatNumber.new(cant * data.art_precio));
                        //mostrar el precio unitario en el campo
                        //$(event.currentTarget).parents('tr').find(".product-price").html(formatNumber.new(data.art_precio));
                        
                        //$("#ven_total").val(formatNumber.new(cant * data.art_precio));
                        //llama a la funcion actSubtotales para realizar calculos respectivos cada ves
                       //que se agregue un producto
                        //actSubtotales();
                   }).typeahead('val', defaultValue).removeAttr('');
                }
                //funcion para borrar lista de detalles de la grilla
                function eliminar(t) {
                //elimina los elementos de una fila de la tabla
                    $(t).parents('tr').remove();
                    //actSubtotales();
                }
                
                //funcion para guardar las ventas
                function grabar(){                  
                    var TableData = new Array();
                    $('.item-table tbody tr:not(.hidden-row)').each(function (row, tr) {
                        var codigo_arti = $(tr).find("[name='cod_art[]']").val();
                        var cantidad = $(tr).find("[name='cantidad_deta[]']").val();
                        var estado_deta = $(tr).find("[name='estado_deta[]']").val();
                     
                        console.log(cantidad);
                        console.log(estado_deta);
                        //yo solo necesito codigo y cantidad y estado
                        if (codigo_arti !== ""&& cantidad !== "" && cantidad !== "-" && cantidad > "0" && cantidad > "+" && estado_deta !== "") {
                            TableData[row] = {
                                "cod_art": codigo_arti,
                                "cantidad_detalle": cantidad, 
                                "estado_detalle":estado_deta,
                           }
                        }
                    });
                    
                    console.log(TableData);
                    //hasta aqui
                    //var totales = $("#ven_total").val().replace(/\./g, '');
                    if (TableData.length !== 0) {
                      
                        $.ajax({
                            url: '/servitech_tesis/pedido_compra_control.php',
                            type: "POST",
//                            dataType: 'json',
                            data: {
                                detalles: TableData,
                                vpedi: $("#vpedi").val(),
                                vcod_usu: $("#vcod_usu").val(),
                                vsucursal: $("#vsucursal").val(),
                                vfecha: $("#vfecha").val(),
                                vestado: $("#vestado").val(),
                                vdescri:$("#vdescri").val(),
                                accion: $("#accion").val(),
                                pagina: $("#pagina").val()
                                  },
                           
                            success: function(respuesta){
                                 console.log(respuesta.mensaje);
                               
                                 notificacion("Atencion","Guardado exitosamente", "success");
                                 setTimeout(function () {
                                          window.location.href = "./pedido_compra_index.php";
                                      }, 3000);
                                 
                            },
                            error: function (data) {
                                notificacion("Atencion", "Error en el proceso de grabado del pedido", "error");
                              
                            }
                       });
                    } else {
                        notificacion("Atencion", "Debe completar los campos del detalle, no ingrese valores negativos o simbolos + -", "error");
                    }
                }
        </script>
        <script>
            function sololetras() {
//                      var numero = trim(numero);
                var numero = document.getElementById("vdescri").value;
                if (numero.length === 0 || numero=== " " || numero=== "  " || numero=== "   " || numero=== "    " || numero=== "     " || numero=== "      " || numero=== "          " ){
                    
                notificacion('Atencion','No se permiten campos vacios','error'); //y esta notificacion tiene mensaje rojo
               //  notificacion('Atencion','No se permiten campos vacios','mensaje'); //esta notificacion tiene mensaje amarillo
               
                document.getElementById("vdescri").value = '';
                } else {
                   
                }
            }
            
             function reemplazar2(){
//                   alert($('#apel').val());
                var valor=document.getElementById('vdescri').value.replace("'","");
                document.getElementById('vdescri').value=valor;
                }
                
                function reemplazar3(){
//                   alert($('#apel').val());
                var valor=document.getElementById('vdescri').value.replace("”","");
                document.getElementById('vdescri').value=valor;
                }
                
            
        </script>

    </body>
</html>