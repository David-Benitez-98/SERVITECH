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
                        <h3 class="page-header">Registar Promocion de Servicios 
                            <a href="promocion_servicio_index.php" 
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
                                Datos Cabecera Promocion 
                             </div> 
                                <div class="panel-body">
                             
                            <?php  if (isset($_REQUEST['codigo'])) { ?>
                            <?php  $promociones =  consultas::get_datos("select * from v_promocion where cod_promocion=".$_REQUEST['codigo']);?>
                            <?php } ?>
                              
                                    <form action="promocion_servicio_control.php" method="post" 
                                      role="form" class="form-horizontal">
                                    <input type="hidden" name="accion" id="accion" value="1">
                                    <input type="hidden" name="vpromo" id="vpromo" value="0">
                                    <input type="hidden" name="vestado" id="vestado" value="PENDIENTE">
                                    <input type="hidden" name="vcod_usu" id="vcod_usu" value="<?php echo $_SESSION['cod_usu']; ?>">
                                    <input type="hidden" name="vsucursal" id="vsucursal" value="<?php echo $_SESSION['cod_suc']; ?>">
                                    <input type="hidden" name="pagina" value="promocion_servicio_index.php">
                                    <!-- Grupo de la primera fila-->
                                    <!--desde aqui-->
                                    <!-- Campo fecha-->
                                    <div class="form-group">
                                        <label class="col-md-1 control-label">Fecha Inicio:</label>
                                        <div class="col-md-4">
                                            <input type="date" id="vfecha_ini" required="" 
                                                   placeholder="Especifique fecha"
                                                   class="form-control"
                                                   name="vfecha_ini" 
                                                   onblur="validar_vigen(), validar1()"
                                                   value="<?= !empty($promociones[0]['fcha_ini']) ? $promociones[0]['fcha_ini'] : date("Y-m-d"); ?>"
                                                   <?= !empty($promociones[0]['fcha_ini']) ? 'readonly' : '' ?>>
                                                  
                                          </div>
                                        
                                        <label class="col-md-2 control-label">Fecha Fin:</label>
                                        <div class="col-md-3">
                                            <input type="date" id="vfecha_fin" required=""
                                                   placeholder="Especifique fecha"
                                                   class="form-control"
                                                   name="vfecha_fin" 
                                                   onblur="validar_vigen(), validar() "
                                                   value="<?= !empty($promociones[0]['fcha_fin']) ? $promociones[0]['fcha_fin'] : date("Y-m-d"); ?>"
                                                   <?= !empty($promociones[0]['fcha_fin']) ? 'readonly' : '' ?>>
                                                  
                                        </div>

                                    </div> 
                                    <div class="form-group">
                                        
                                        <!-- Campo Sucursal-->

                                        <label class="col-md-1 control-label">Sucursal:</label>
                                        <div class="col-md-4">
                                            <input type="text" required="" placeholder="Ingrese Sucursal" readonly="" 
                                                   class="form-control" value="<?= !empty($promociones[0]['suc_descri']) ? $promociones[0]['suc_descri'] : $_SESSION['suc_descri']; ?>">
                                            
                                        </div>
                                        
                                        <!--Campo Descripcion-->
                                        <label class="col-md-2 control-label">Descripcion:</label>
                                        <div class="col-md-3">
                                            <input type="text" id="vdescri"
                                                   placeholder="Ingrese Descripcion"
                                                   class="form-control" 
                                                   name="vdescri" 
                                                   onblur="sololetras();"
                                                   onkeyup="reemplazar();"
                                                   onchange="reemplazar();"
                                                   pattern="[A-Za-z and 0-9 and #SPACE and Ñ-ñ and ._-]{3,40}" title="Ingresa sólo letras. Tamaño mínimo: 3. Tamaño máximo: 40"
                                                   value="<?php echo !empty ($promociones[0]['descri_promo']) ? $promociones[0]['descri_promo'] : 'MES DE '; ?>"
                                                   <?= !empty($promociones[0]['descri_promo']) ? 'readonly' : '' ?>
                                                   autofocus="" required="">
                                        </div>
                                    </div>

                                </form>   
                            </div>
                        </div>
<!--                Aqui Termina la Estructura Cabecera-->

<!-- COMIENZO PARA EL DETALLE AQUI VA UNA TABLA PARA AGREGAR EL DETALLE-->
 <!-- /.col-lg-12 -->
 
                <?php  if (isset($_REQUEST['codigo'])) { ?>
                <?php  $detapromociones =  consultas::get_datos("select * from v_deta_promo where cod_promocion=".$_REQUEST['codigo']);?>
                <?php } ?>
 
                <div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            Detalle Promocion de Servicios
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped item-table" cellspacing="0" width="100%">
<!--                                    Titulos de la Tabla-->
                                    <thead>
                                        <tr>
                                            <th style="width:40%;" >Tipo de Servicio 
                                                <a data-toggle="modal" data-target="#registrar" 
                                                   class="btn btn-info btn-circle" 
                                                   rel="tooltip" data-title="Registrar Tipo de Servicios">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </th>
                                            <th  style="width:10%;" class="text-center">Porc %</th>
                                            <th  style="width:10%;" class="text-center">Promo</th>
                                            <th style="width:10%;" class="text-center">Estado</th>                                           
                                            <th style="<?= isset($detapromociones) ? 'display : none' : '' ?> ">
                                                <a href="javascript:void(0);" class='btn btn-primary btn-sm btn-add-row' rel="tooltip" data-title="Agregar Grilla" >
                                                    <span class="fa fa-plus-circle"> Agregar</span></a>
                                                
                                            </th>
                                        </tr>
                                    </thead>
<!--                                    Contenido de la Tabla-->
                                    <tbody>
<!--                                        Aqui le falta la palabra al tr  clas="hidden-row"-->
                                        <tr class="hidden-row">
                                            <td>
                                                <input style="position: relative;top: 100%;left: 0px;;right: 100px;z-index: 100;display: block;vertical-align: top;background-color: transparent;width: 650px;" 
                                                       type="text" required="" class="form-control buscar" name="product_name[]" 
                                                       placeholder="Buscar por nombre, código">
                                                <input type="hidden" name="cod_tipo_servi[]" id="cod_tipo_servi">
                                                <input type="hidden" name="valor_porcentual[]" id="valor_porcentual"/>
                                                <input type="hidden" name="estado[]" id="estado"/>
                                                
                                            </td>
                                            
                                            <td class="text-center">
                                                <input class="form-control text-center det-cant" type="number" placeholder="Ingrese Valor del Porcentaje en numeros" required="" 
                                                       name="valor_porcentual_deta[]" id="valor_porcentual_detalle" style="text-align: left; width: 400px"
                                                       onkeypress="nronegativo()"
                                                       autofocus="" > 
                                            </td>
                                            <td class="text-center">
                                                <span class="promo"></span>
                                            </td>
<!--                                            <td class="text-center">
                                                <span class="row-subtotal"></span>
                                            </td>-->
                                             <td class="text-center">
                                                 <input class="form-control text-center det-cant" type="text" value="PENDIENTE"  readonly=""
                                                       name="estado_deta[]" id="estado_detalle" style="text-align: center ;left: 0px; width: 150px"
                                                       autofocus=""> 
                                            </td>
<!--                                            <td class="text-center">
                                                <span class="row-subtotal"></span>
                                            </td>-->
              
                                            
                                            <td class="text-center " >
                                                <a href="javascript:void(0);" title="Borrar Grilla" class="btn btn-danger btn-sm" onclick="eliminar(this)">
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
                                    if(isset($detapromociones) && count($detapromociones)>0 ){
                                                foreach ($detapromociones as $value){ 
//                                                    $total += $value->det_precio_unit;
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <input style="position: relative;top: 100%;left: 0px;z-index: 100;display: block;vertical-align: top;background-color: transparent;width: 700px;" type="text" required="" class="form-control buscar" name="product_name[]" 
                                                                   placeholder="Buscar por nombre, código" value="<?= isset($value['datos_tipo_servicio']) ? $value['datos_tipo_servicio'] : ''  ?>" readonly="">
                                                            <input type="hidden" name="cod_tipo_servi[]" id="cod_tipo_servi" value="<?= isset($value['cod_tipo_servi']) ? $value['cod_tipo_servi'] : ''  ?>">
                                                        </td>
                                                        
                                                        <td class="text-center">
                                                            <input class="form-control text-center det-cant" type="text"  
                                                                   value="<?= isset($value['promo_valor_porc']) ? $value['promo_valor_porc'] : ''  ?>"
                                                                   name="det_valor_porcentual[]" id="detalle_valor_porcentual" style="text-align: center ; width: 200px" readonly="">
                                                        </td>
                                                        <td class="text-center">
                                                            <input class="form-control text-center det-cant" type="text"  
                                                                   value="<?= isset($value['promo_servi']) ? $value['promo_servi'] : ''  ?>"
                                                                   style="text-align: center ; width: 200px" readonly="">
                                                        </td>
                                                        <td class="text-center">
                                                            <input class="form-control text-center det-cant" type="text" 
                                                                   value="<?= isset($value['estado']) ? $value['estado'] : 'PENDIENTE'  ?>"
                                                                   name="det_estado[]" id="detalle_estado" style="text-align: center ;width: 250px" readonly="">
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
                            <form action="tipo_servicio_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body se">
                                    <input type="hidden" name="accion"  value="1">
                                    <input type="hidden" name="vtipo" value="0"/> 
                                    <input type="hidden" name="pagina" value="promocion_servicio_agregar.php">

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
                                               class="form-control" name="vprecio" onkeyup="nronegativo2()"
                                               onchange="nronegativo2()" autofocus="">
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
<!--                El hr es para poner una linea divisora-->
                <hr>
             <?php    if(!isset($detapromociones)){?>
                     <div class="form-group">
                        <div class="col-md-offset-5 col-md-10">
                         <button type="button" id="grabar" onclick="grabar()" type="submit" class="btn-outline btn-primary btn-lg fa fa-floppy-o"> Grabar Promocion</button>

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
                            url: '/servitech_tesis/lista_tipos_servicio.php',
                            prepare: function (query, settings) {
                                settings.url = settings.url + '?q=' + query
                                return settings;
                            }
                        },
                        datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
                        queryTokenizer: Bloodhound.tokenizers.whitespace,
                    }).ttAdapter(),
                    limit:100,
                    name: 'cod_tipo_servi',
                    async: true,
                    displayKey: 'datos_tipo_servicio',
                    templates: {
                        empty: [
                            '<div class="list-group search-results-dropdown">' +
                                '<div class="list-group-item">No se encontraron resultados.</div>' +
                            '</div>'
                        ],
                        header: [],
                        suggestion: function (data) {
                            return '<p style="white-space:normal;margin-bottom:1px;">' + data.cod_tipo_servi + "-" + data.datos_tipo_servicio + '</p>'
                        }
                    }
                }).bind("typeahead:selected", function (event, data) {
                        var exists = false;
                        $(event.currentTarget).parents('tr').find("[name='cod_tipo_servi[]']").val(data.cod_tipo_servi);
                        
                        $(".item-table [name='cod_tipo_servi[]']").each(function(index, el){
                            if( $(el).val() == data.cod_tipo_servi ){//pregunta dentro de un foreach si el producto se encuentra en la lista
                                exists = true;
                                return false;
                            }
                        });
                        
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
                        var codigo_tipo = $(tr).find("[name='cod_tipo_servi[]']").val();
                        var estado_deta = $(tr).find("[name='estado_deta[]']").val();
                        var valor_porcentual = $(tr).find("[name='valor_porcentual_deta[]']").val();
                        
                        console.log(valor_porcentual);
                        console.log(estado_deta);
                        //yo solo necesito codigo y cantidad y estado
                        if (codigo_tipo !== "" && valor_porcentual !== "" && valor_porcentual !== "-" && valor_porcentual > "0"  && estado_deta !== "") {
                            TableData[row] = {
                                "cod_tipo_servi": codigo_tipo,
                                "valor_porcentual_detalle": valor_porcentual, 
                                "estado_detalle":estado_deta,
                           }
                        }
                    });
                    
                    console.log(TableData);
                    
                    if (TableData.length !== 0) {
                       
                        $.ajax({
                            url: '/servitech_tesis/promocion_servicio_control.php',
                            type: "POST",
//                            dataType: 'json',
                            data: {
                                detalles: TableData,
                                vpromo: $("#vpromo").val(),
                                vfecha_ini: $("#vfecha_ini").val(),
                                vfecha_fin: $("#vfecha_fin").val(),
                                vcod_usu: $("#vcod_usu").val(),
                                vsucursal: $("#vsucursal").val(),
                                vdescri:$("#vdescri").val(),
                                vestado: $("#vestado").val(),
                                accion: $("#accion").val(),
                                pagina: $("#pagina").val()
                                  },
                                  
                                success: function(respuesta){ //respuesta
                                console.log(respuesta.mensaje);
                             //console.log(respuesta.success==true);
//                             if(respuesta.success === true){
                                 
                                 notificacion("Atencion","Guardado exitosamente", "success");
                                 setTimeout(function () {
                                          window.location.href = "./promocion_servicio_index.php";
                                      }, 3000);
                                 
//                                } else{
//                                    notificacion("Atencion","El Tipo de Servicio o la Descripcion ya esta activo o pendiente en otra promocion", "error");
//                                 setTimeout(function () {
//                                          window.location.href = "./promocion_servicio_index.php";
//                                      }, 3000);
//                            }
                                
                            },
                            error: function (data) { //data
                                notificacion("Atencion", "Error en el proceso de grabado de la promocion", "error");
                                //alert(data.mensaje);
                            }
                            
                       });
                    } else {
                        notificacion("Atencion", "Debe completar los campos del detalle, no ingrese valores negativos", "error");
                     
                    }
                }
                
            
        </script>
        <script>

            function nronegativo2() {

                var numero = document.getElementById("precio").value;
                if (numero.match(/^-?[0-9]+(\.[0-9]{1,2})?$/))
                {
//                    alert("numero ok");
                }
                else
                {
                    notificacion('Atencion','Ingrese su numero sin puntos, letras ni espacios', 'mensaje');
                    document.getElementById("precio").value = "";
                }
            }
            
            function reemplazar(){
//                   alert($('#apel').val());
                var valor=document.getElementById('vdescri').value.replace("'","");
                document.getElementById('vdescri').value=valor;
                }
            function sololetras() {
//                      var numero = trim(numero);
                var numero = document.getElementById("vdescri").value;
                if (numero.length === 0 || numero=== " " || numero=== "  " || numero=== "   " || numero=== "    " || numero=== "     " || numero=== "      " || numero=== "          " ){
                    
                notificacion('Atencion','No se permiten campos vacios','error'); //y esta notificacion tiene mensaje rojo
               //  notificacion('Atencion','No se permiten campos vacios','mensaje'); //esta notificacion tiene mensaje amarillo
                document.getElementById("vdescri").value = '';
                   
                }
            }
            
            function validar_vigen() { //valida la fechas de vigencia
                var hoy_si = new Date();
                var hoy = new Date($('#vfecha_ini').val());
                var fechaFormulario = new Date($('#vfecha_fin').val());
                if (fechaFormulario <= hoy) {
                    alert('El numero de timbrado Hasta debe ser mayor a Desde!!!');
                    $('#vfecha_ini').val(hoy_si);
                    $('#vfecha_fin').val(hoy_si);
                }
                else {
//                    $("#ocultar").css("display", "block");
                }
            }
            
            function validar() {
                var hoy = new Date();
                var fechaFormulario = new Date($('#vfecha_fin').val());
                if (fechaFormulario <= hoy) {
                    alert('La Fecha Fin debe ser Mayor a la actual!!!');
                    $('#vfecha_fin').val(hoy);
                }
                else {
//                    $("#ocultar").css("display", "block");
                }
            }
            
            function validar1() {
                var hoy = new Date();
                var fechaFormulario = new Date($('#vfecha_ini').val());
                if (fechaFormulario < hoy) {
                    alert('La Fecha Inicio debe ser mayor o igual a la fecha de hoy!!!');
                    $('#vfecha_ini').val(hoy);
                   // $('#vfecha_fin').val(hoy);
                }
                else {
//                    $("#ocultar").css("display", "block");
                }
            }
         
        </script>

    </body>
</html>