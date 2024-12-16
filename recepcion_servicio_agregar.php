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
                        <h3 class="page-header">Registar Recepcion de Solicitud 
                            <a href="recepcion_servicio_index.php" 
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
                                Datos Cabecera Recepcion 
                             </div> 
                                <div class="panel-body">
                             
                            <?php  if (isset($_REQUEST['codigo'])) { ?>
                            <?php  $recepciones =  consultas::get_datos("select * from v_recepcion where cod_recep=".$_REQUEST['codigo']);?>
                            <?php } ?>
                              
                                    <form action="recepcion_servicio_control.php" method="post" 
                                      role="form" class="form-horizontal">
                                    <input type="hidden" name="accion" id="accion" value="1">
                                    <input type="hidden" name="vrecep" id="vrecep" value="0">
                                    <input type="hidden" name="vestado" id="vestado" value="PENDIENTE">
                                    <input type="hidden" name="vcod_usu" id="vcod_usu" value="<?php echo $_SESSION['cod_usu']; ?>">
                                    <input type="hidden" name="vsucursal" id="vsucursal" value="<?php echo $_SESSION['cod_suc']; ?>">
                                    <input type="hidden" name="pagina" value="recepcion_servicio_index.php">
                                    <!-- Grupo de la primera fila-->
                                    <!--desde aqui-->
                                    <!-- Campo fecha-->
                                    <div class="form-group">
                                        <label class="col-md-1 control-label">Fecha:</label>
                                        <div class="col-md-5">
                                            <input type="datetime" required="" id="vfecha" disabled=""
                                                   placeholder="Especifique fecha"
                                                   class="form-control"
                                                   name="vfecha" 
                                                   value="<?= !empty($recepciones[0]['fecha']) ? $recepciones[0]['fecha'] : date("Y-m-d"); ?>"
                                                   <?= !empty($recepciones[0]['fecha']) ? 'readonly' : '' ?>>
                                                  
                                          </div>

                                        <!-- Campo Sucursal-->

                                        <label class="col-md-2 control-label">Sucursal:</label>
                                        <div class="col-md-3">
                                            <input type="text" required="" placeholder="Ingrese Sucursal" readonly="" 
                                                   class="form-control" value="<?= !empty($recepciones[0]['suc_descri']) ? $recepciones[0]['suc_descri'] : $_SESSION['suc_descri']; ?>">
                                            
                                        </div>
                                       
                                    </div> 
                                    <div class="form-group">
                                        
                                        <!-- Campo cliente-->
                                        <label class="col-md-1 control-label">Cliente:</label>
                                        <div class="col-md-5">
                                        <?php  if (isset($recepciones[0]['cod_suc'])) { ?>
                                        <?php $clientes = consultas::get_datos("select * from v_clientes "
                                                        . " order by id_cliente=".$recepciones[0]['id_cliente']." desc"); ?>  
                                            
                                        <?php } else { ?>
                                            <?php $clientes = consultas::get_datos("select * from v_clientes "
                                                        . " order by id_cliente desc"); ?>
                                        <?php }?>
                                            
                                            <select name="vcliente" id="vcliente" <?= !empty ($recepciones[0]['id_cliente']) ? 'disabled' : '' ?>
                                                    class="form-control">
                                                <?php
                                                if (!empty($clientes)) {
                                                    foreach ($clientes as $cliente) {
                                                        ?>
                                                        <option value="<?php echo $cliente['id_cliente']; ?>">
                                                            <?php echo $cliente['datos_ciente']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="0">Debe ingresar un Cliente</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        
                                        <!--Campo Descripcion-->
                                        <label class="col-md-2 control-label">Descripcion:</label>
                                        <div class="col-md-3">
                                            <input type="text" id="vdescri" 
                                                   placeholder="Ingrese Descripcion"
                                                   class="form-control" 
                                                   name="vdescri" 
                                                   onblur="sololetras();"
                                                   onkeyup="reemplazar2();"
                                                   onchange="reemplazar2();"
                                                   pattern="[A-Za-z and 0-9 and #SPACE and Ñ-ñ and ._-]{3,40}" title="Ingresa sólo letras. Tamaño mínimo: 3. Tamaño máximo: 40"
                                                   value="<?php echo !empty ($recepciones[0]['recep_descri']) ? $recepciones[0]['recep_descri'] : 'SOL. SERVICIO'; ?>"
                                                   <?= !empty($recepciones[0]['recep_descri']) ? 'readonly' : '' ?>
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
                <?php  $detarecepciones =  consultas::get_datos("select * from v_deta_recep where cod_recep=".$_REQUEST['codigo']);?>
                <?php } ?>
 
                <div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            Detalle Recepcion - Solicitud de Servicios
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped item-table" cellspacing="0" width="100%">
<!--                                    Titulos de la Tabla-->
                                    <thead>
                                        <tr>
                                            <th style="width:40%;" >Equipo 
                                                <a data-toggle="modal" data-target="#registrar" 
                                                   class="btn btn-info btn-circle" 
                                                   rel="tooltip" data-title="Registrar Equipos">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </th>
                                            <th  style="width:40%;" class="text-center">Observacion</th>
                                            <th style="width:10%;" class="text-center">Estado</th>                                           
                                            <th style="<?= isset($detarecepciones) ? 'display : none' : '' ?> ">
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
                                                <input style="position: relative;top: 100%;left: 0px;z-index: 100;display: block;vertical-align: top;background-color: transparent;width: 600px;" 
                                                       type="text" required="" class="form-control buscar" name="product_name[]" 
                                                       placeholder="Buscar por nombre, código">
                                                <input type="hidden" name="cod_equipo[]" id="cod_equipo">
                                                <input type="hidden" name="observacion[]" id="observacion"/>
                                                <input type="hidden" name="estado[]" id="estado"/>
                                                
                                            </td>
                                            
                                            <td class="text-center">
                                                <input class="form-control text-center det-cant" type="text" placeholder="Ingrese Observacion" required="" 
                                                       name="observacion_deta[]" id="observacion_detalle" style="text-align: left; width: 400px" 
                                                       autofocus="" > 
                                            </td>
<!--                                            <td class="text-center">
                                                <span class="row-subtotal"></span>
                                            </td>-->
                                             <td class="text-center">
                                                 <input class="form-control text-center det-cant" type="text" value="PENDIENTE"  readonly=""
                                                       name="estado_deta[]" id="estado_detalle" style="text-align: center ;left: 0px; width: 200px"
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
                                    if(isset($detarecepciones) && count($detarecepciones)>0 ){
                                                foreach ($detarecepciones as $value){ 
//                                                    $total += $value->det_precio_unit;
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <input style="position: relative;top: 100%;left: 0px;z-index: 100;display: block;vertical-align: top;background-color: transparent;width: 700px;" type="text" required="" class="form-control buscar" name="product_name[]" 
                                                                   placeholder="Buscar por nombre, código" value="<?= isset($value['datos_equipos']) ? $value['datos_equipos'] : ''  ?>" readonly="">
                                                            <input type="hidden" name="cod_equipo[]" id="cod_equipo" value="<?= isset($value['cod_equipo']) ? $value['cod_equipo'] : ''  ?>">
                                                        </td>
                                                        
                                                        <td class="text-center">
                                                            <input class="form-control text-center det-cant" type="text"  
                                                                   value="<?= isset($value['observacion']) ? $value['observacion'] : ''  ?>"
                                                                   name="det_observacion[]" id="detalle_observacion" style="text-align: center ; width: 400px" readonly="">
                                                        </td>
                                                        <td class="text-center">
                                                            <input class="form-control text-center det-cant" type="text" 
                                                                   value="<?= isset($value['estado']) ? $value['estado'] : 'PENDIENTE'  ?>"
                                                                   name="det_estado[]" id="detalle_estado" style="text-align: center ;width: 300px" readonly="">
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
                
                <!--registrar equipo-->
                <div id="registrar" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header alert-success">
                                <button type="button" class="close" 
                                        data-dismiss="modal" arial-label="Close">x</button>
                                <h4 class="modal-title"><strong>Registrar Equipos</strong></h4>
                            </div>
                            <form action="equipos_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body se">
                                    <input type="hidden" name="accion"  value="1">
                                    <input type="hidden" name="vequi" value="0"/> 
                                    <input type="hidden" name="pagina" value="recepcion_servicio_agregar.php">

                                   
                                <!--Inicio Empresa-->
                                    <div class="form-group">
                                    <label class="col-lg-3 control-label">Tipo Equipo:</label>
                                    <div class="col-lg-4">
                                        <?php
                                        $tipos_equipos = consultas::get_datos("select * from tipo_equipo "
                                                        . " order by cod_tipo_equi");
                                        ?>                                 
                                        <select name="vtipo" class="form-control select">
                                            <?php
                                            if (!empty($tipos_equipos)) {
                                                foreach ($tipos_equipos as $tipo_equipo) {
                                                    ?>
                                                    <option value="<?php echo $tipo_equipo['cod_tipo_equi']; ?>">
                                                        <?php echo $tipo_equipo['descri_tipo']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar un Tipo Equipo</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                 <!--Fin empresa-->
                                 <!--Inicio Ciudad-->
                                    <div class="form-group">
                                    <label class="col-lg-3 control-label">Marca:</label>
                                    <div class="col-lg-4">
                                        <?php $marcas = consultas::get_datos("select * from marca order by cod_mar"); ?>
                                        <select name="vmar" class="form-control select" >
                                            <?php
                                            if (!empty($marcas)) {
                                                foreach ($marcas as $marca) {
                                                    ?>
                                                    <option value="<?php echo $marca['cod_mar']; ?>">
                                                        <?php echo $marca['mar_descri']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar una Marca</option>
                                            <?php } ?>    
                                        </select>
                                    </div>
                                </div>
                                 <br>
                                 <!--Fin Ciudad-->
                                 
<!--                                 Inicio Departamento-->
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">Color:</label>
                                    <div class="col-lg-4">
                                        <?php
                                        $colores = consultas::get_datos("select * from color_equipo "
                                                        . " order by cod_color_equi");
                                        ?>                                 
                                        <select name="vcolor" class="form-control select">
                                            <?php
                                            if (!empty($colores)) {
                                                foreach ($colores as $color) {
                                                    ?>
                                                    <option value="<?php echo $color['cod_color_equi']; ?>">
                                                        <?php echo $color['descri_color']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar un Color</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <br>
<!--                                 Fin Departamento-->
                                
                                <!--  INICIO CAPACIDAD-->
                                    <div class="form-group">
                                    <label class="col-lg-3 control-label">Capacidad:</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control" name="vdescri"  
                                               required="" id="capacidad"
                                               onkeyup="reemplazar()"
                                               onchange="reemplazar()"
                                               onblur="sololetras2()"
                                                pattern="[A-Za-z and #SPACE and ._- and Ñ-ñ]{3,100}" title="Ingresa sólo letras. Tamaño mínimo: 3. Tamaño máximo: 100"
                                               autofocus="">
                                           
                                               
                                    </div>
                                    </div>
                                <!--Fin Capacidad-->
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
                
<!--                Fin registrar equipos-->
<!--                El hr es para poner una linea divisora-->
                <hr>
             <?php    if(!isset($detarecepciones)){?>
                     <div class="form-group">
                        <div class="col-md-offset-5 col-md-10">
                         <button type="button" id="grabar" onclick="grabar()" type="submit" class="btn-outline btn-primary btn-lg fa fa-floppy-o"> Grabar Recepcion</button>

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
                            url: '/servitech_tesis/lista_equipos.php',
                            prepare: function (query, settings) {
                                settings.url = settings.url + '?q=' + query
                                return settings;
                            }
                        },
                        datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
                        queryTokenizer: Bloodhound.tokenizers.whitespace,
                    }).ttAdapter(),
                    limit:100,
                    name: 'cod_equipo',
                    async: true,
                    displayKey: 'datos_equipos',
                    templates: {
                        empty: [
                            '<div class="list-group search-results-dropdown">' +
                                '<div class="list-group-item">No se encontraron resultados.</div>' +
                            '</div>'
                        ],
                        header: [],
                        suggestion: function (data) {
                            return '<p style="white-space:normal;margin-bottom:1px;">' + data.cod_equipo + "-" + data.datos_equipos + '</p>'
                        }
                    }
                }).bind("typeahead:selected", function (event, data) {
                        var exists = false;
                        $(event.currentTarget).parents('tr').find("[name='cod_equipo[]']").val(data.cod_equipo);
                        
                        $(".item-table [name='cod_equipo[]']").each(function(index, el){
                            if( $(el).val() == data.cod_equipo ){//pregunta dentro de un foreach si el producto se encuentra en la lista
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
                        var codigo_equipo = $(tr).find("[name='cod_equipo[]']").val();
                        var observacion = $(tr).find("[name='observacion_deta[]']").val();
                        var estado_deta = $(tr).find("[name='estado_deta[]']").val();
                     
                        console.log(observacion);
                        console.log(estado_deta);
                        //yo solo necesito codigo y cantidad y estado
                        if (codigo_equipo !== ""&& observacion !== "" && observacion !== " " && observacion !== "  " && observacion !== "   " && observacion !== "    " && observacion !== "     " && observacion !== "     " && observacion !== "      " && observacion !== "'"  && estado_deta !== "") {
                            TableData[row] = {
                                "cod_equipo": codigo_equipo,
                                "observacion_detalle": observacion, 
                                "estado_detalle":estado_deta,
                           }
                        }
                    });
                    
                    console.log(TableData);
                    
                    if (TableData.length !== 0) {
                       
                        $.ajax({
                            url: '/servitech_tesis/recepcion_servicio_control.php',
                            type: "POST",
//                            dataType: 'json',
                            data: {
                                detalles: TableData,
                                vrecep: $("#vrecep").val(),
                                vcod_usu: $("#vcod_usu").val(),
                                vsucursal: $("#vsucursal").val(),
                                vfecha: $("#vfecha").val(),
                                vestado: $("#vestado").val(),
                                vdescri:$("#vdescri").val(),
                                vcliente:$("#vcliente").val(),
                                accion: $("#accion").val(),
                                pagina: $("#pagina").val()
                                  },
                           
                            success: function(respuesta){
                                 console.log(respuesta.mensaje);
                               
                                 notificacion("Atencion","Guardado exitosamente", "success");
                                 setTimeout(function () {
                                        //  window.location.href = "./orden_compra_agregar.php";
                                          window.location.href = "./recepcion_servicio_index.php";
                                      }, 3000);
                                 
                            },
                            error: function (data) {
                                notificacion("Atencion", "Error en el proceso de grabado de la recepcion", "error");
                                //alert(data.mensaje);
                            }
                       });
                    } else {
                        notificacion("Atencion", "Debe completar los campos del detalle.", "error");
                        document.getElementById("observacion_detalle").value = '';
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
            
            function sololetras2() {
//                      var numero = trim(numero);
                var numero = document.getElementById("capacidad").value;
                if (numero.length === 0 || numero=== " " || numero=== "  " || numero=== "   " || numero=== "    " || numero=== "     " || numero=== "      " || numero=== "          " ){
                    
                notificacion('Atencion','No se permiten campos vacios','error'); //y esta notificacion tiene mensaje rojo
               //  notificacion('Atencion','No se permiten campos vacios','mensaje'); //esta notificacion tiene mensaje amarillo
                document.getElementById("capacidad").value = '';
                } else {
                   
                }
            }
            
            function reemplazar(){
//                   alert($('#apel').val());
                var valor=document.getElementById('capacidad').value.replace("'","");
                document.getElementById('capacidad').value=valor;
                }
            function reemplazar2(){
//                   alert($('#apel').val());
                var valor=document.getElementById('vdescri').value.replace("'","");
                document.getElementById('vdescri').value=valor;
                }
            
        </script>

    </body>
</html>