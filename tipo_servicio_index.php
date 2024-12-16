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
         require './anular_sesion.php'; #este es para bloquear la url
        require 'menu/css.ctp';
        ?>
    </head>
    <body>
        <div id="wrapper">
            <?php require 'menu/navbar.php'; ?><!--BARRA DE HERRAMIENTAS-->
            <div id="page-wrapper">
                <div class="row">
                    <!--impresion del titulo de la pagina-->
                    <div class="col-lg-12">
                        <h3 class="page-header text-center">Listado de Tipos de Servicios
                            
                            <a href="imprimir_tipo_servicios.php" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Imprimir" target="_blank">
                                <i class="fa fa-print"></i>
                            </a> 
                            <a data-toggle="modal" data-target="#registrar" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Registrar Equipos">
                                <i class="fa fa-plus"></i>
                            </a>                      
                        </h3>
                    </div>     
                    <!--Buscador-->
                    <div class="col-lg-12">
                        <div class="panel-heading">
                            <div class="input-group custom-search-form">
                                <input id="filtrar" type="text" class="form-control" placeholder="Buscar...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" rel="tooltip" title="Buscar">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>                      
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                Datos Equipos
                            </div>
                            <?php
                            $tipos_servicios = consultas::get_datos("select * from v_tipo_servicios2
                                         order by cod_tipo_servi asc ");
                            if (!empty($tipos_servicios)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">TIPO SERVICIO</th>
                                                    <th class="text-center">TIPO IMPUESTO</th>  
                                                    <th class="text-center">PLAZO RECLAMO</th>  
                                                    <th class="text-center">PRECIO</th>   
                                                    <th class="text-center">ACCIONES</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($tipos_servicios as $tipo_servicio) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $tipo_servicio['cod_tipo_servi']; ?></td>
                                                        <td class="text-center"><?php echo $tipo_servicio['descri_servicio']; ?></td>
                                                        <td class="text-center"><?php echo $tipo_servicio['imp_porc']; ?></td>
                                                        <td class="text-center"><?php echo $tipo_servicio['plazo_dias']; ?></td>
                                                        <td class="text-center"><?php echo $tipo_servicio['precio_tipo_servi']; ?></td>
                                                        <td class="text-center">
                                                            
                                                            <a onclick="editar(<?php echo "'" . $tipo_servicio['cod_tipo_servi'] . "_" .
                                                                    $tipo_servicio['precio_tipo_servi'] . "_" .
                                                                    $tipo_servicio['descri_servicio'] . "_" .
                                                                    $tipo_servicio['cod_imp'] . "_" .
                                                                    $tipo_servicio['plazo_reclamo'] . "'"; ?>)" 
                                                               class="btn btn-xs btn-info" rel='tooltip' data-title="Editar Tipos Servicios" 
                                                               data-toggle="modal" data-target="#editar">
                                                                <span class="glyphicon glyphicon-pencil"></span></a>
                                                                
                                                             <a onclick="borrar(<?php echo "'" . $tipo_servicio['cod_tipo_servi'] . "_" . 
                                                                    $tipo_servicio['precio_tipo_servi'] . "_" .
                                                                    $tipo_servicio['descri_servicio'] . "_" .
                                                                    $tipo_servicio['cod_imp'] . "_" .
                                                                    $tipo_servicio['plazo_reclamo'] . "'"; ?>)" 
                                                               class="btn btn-xs btn-warning" rel='tooltip' data-title="Borrar Tipos Servicios"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-trash"></span></a>
                                                        </td>
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
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>

                <!--registrar-->
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
                                    <input type="hidden" name="pagina" value="tipo_servicio_index.php">

                                   
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
                                        $tipos_impuestos = consultas::get_datos("select * from v_tipo_impuesto where cod_imp = 4 "
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
            </div>
            <!--fin-->
            <!--editar-->
            <div id="editar" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header alert-success">
                            <button type="button" class="close" 
                                    data-dismiss="modal" arial-label="Close">x</button>
                            <h4 class="modal-title"><strong>Editar Tipos Servicios</strong></h4>
                        </div>
                        <form action="tipo_servicio_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                            <div class="panel-body">
                                <input name="accion" value="2" type="hidden"/>
                                <input type="hidden" name="pagina" value="tipo_servicio_index.php">
                                <input id="cod" type="hidden" name="vtipo"/>
                                
                                <!--                                    INICIO DESCRIPCION-->
                                    <div class="form-group">
                                    <label class="col-lg-3 control-label">Descripción:</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control" name="vdescri" id="descri_servi" 
                                               required="" 
                                               onkeyup="reemplazar()"
                                               onchange="reemplazar()"
                                               onblur="sololetras()"
                                               pattern="[A-Za-z and #SPACE and - and _]{3,40}" title="Ingresa sólo letras. Tamaño mínimo: 3. Tamaño máximo: 40" 
                                               value="<?php echo $tipos_servicios[0]['descri_servicio']; ?>"
                                               autofocus="">
                                    </div>
                                    </div>
                                <br>
                                <!--Inicio Precio-->
                                <div class="form-group"> 
                                    <label class="col-md-3 control-label">Precio:</label>
                                    <div class="col-md-5">
                                        <input type="number" id="precio_servi" required=""
                                               placeholder="Ingrese Precio"
                                               class="form-control" name="vprecio" onkeyup="nronegativo2()" readonly=""
                                               onchange="nronegativo2()" 
                                               value="<?php echo $tipos_servicios[0]['precio_tipo_servi']; ?>"
                                               autofocus="">
                                    </div>
                                </div>
                                 <br>
                                <!--Fin Precio-->
                                
                                 <!--Inicio Ciudad-->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Plazo Reclamo</label>
                                        <div class="col-md-5">
                                            <select name="vplazo" class="form-control"
                                                    id="plazo_servi" onchange="tiposelect();" value="<?php echo $tipos_servicios[0]['plazo_reclamo']; ?>">
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
                                        $tipos_impuestos = consultas::get_datos("select * from v_tipo_impuesto where cod_imp = 4 "
                                                        . " order by cod_imp");
                                        ?>                                 
                                        <select id="imp_servi" name="vimp" class="form-control select"  style="width: 180%">
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
                              <br>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" data-dismiss="modal" class="btn btn-default pull-left">
                                    <i class="fa fa-close"></i> Cerrar</button>
                                <button type="submit" class="btn btn-primary pull-right">
                                    <i class="fa fa-refresh"></i> Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--fin-->

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
            function editar(datos) {
                var dat = datos.split("_");
                $('#cod').val(dat[0]);
                $('#precio_servi').val(dat[1]);
                $('#descri_servi').val(dat[2]);
                $('#imp_servi').val(dat[3]);
                $('#plazo_servi').val(dat[4]);
            }
            
            function borrar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href', 'tipo_servicio_control.php?vtipo=' + dat[0] +
                        '&vprecio=' + dat[1] +
                        '&vdescri=' + dat[2] +
                        '&vimp=' + dat[3] +
                        '&vplazo=' + dat[4] +
                        '&accion=3&pagina=tipo_servicio_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-ban-circle"></span>\n\
            Desea Borrar El Tipo de Servicio <i><strong>' + dat[2] + '</strong></i>?');
            }
            
            //para reemplazar comilla simple
            function reemplazar(){
//                   alert($('#apel').val());
                var valor=document.getElementById('descri','descri_servi').value.replace("'","");
                document.getElementById('descri').value=valor;
                document.getElementById('descri_servi').value=valor;
                }
               
                
            //para que no permita numeros negativos ni letras ci
            
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
            function nronegativo2() {

                var numero = document.getElementById("precio_servi").value;
                if (numero.match(/^-?[0-9]+(\.[0-9]{1,2})?$/))
                {
//                    alert("numero ok");
                }
                else
                {
                    alert("Ingrese su numero sin puntos, letras ni espacios");
                    document.getElementById("precio_servi").value = "";
                }
            }
   //hasta aqui
   
    function sololetras() {
//                      var numero = trim(numero);
                var numero = document.getElementById("descri_servi","descri").value;
                if (numero.length === 0 || numero=== " " || numero=== "  " || numero=== "   " || numero=== "    " || numero=== "     " || numero=== "      " || numero=== "          " ){
                    
                notificacion('Atencion','No se permiten campos vacios','error'); //y esta notificacion tiene mensaje rojo
               //  notificacion('Atencion','No se permiten campos vacios','mensaje'); //esta notificacion tiene mensaje amarillo
                document.getElementById("descri_servi").value = '';
                document.getElementById("descri").value = '';
                } else {
                   
                }
            }
        </script>


    </body>
</html>

