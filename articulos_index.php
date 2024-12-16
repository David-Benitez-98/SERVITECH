<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="img/papiro.ico"/><!-- Imagen de la pestaña del navegador --> 
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SERVITECH SYS</title>  <!--Titulo de pestaña-->

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
                        <h3 class="page-header">Listado de Articulos <!--Titulo de pagina web-->
                            <a href="imprimir_articulos.php" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Imprimir" target="_blank">
                                <i class="fa fa-print"></i>
                            </a> 
                            <!--Llama al modal con el boton de cruz-->
                            <a data-toggle="modal" data-target="#registrar" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Registrar">
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
                                Datos
                            </div>
                            <?php
                            $articulos = consultas::get_datos("select * from v_articulos 
                                         order by cod_art asc ");
                            if (!empty($articulos)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Descripción</th> 
                                                    <th class="text-center">Tipo</th>
                                                    <th class="text-center">Marca</th>
                                                    <th class="text-center">Capacidad</th>
                                                    <th class="text-center">Porc.IVA</th>
                                                    <th class="text-center">Precio</th>
                                                    <th class="text-center">Plazo</th>
                                                    <th class="text-center">Descri Garan</th>
                                                    <th class="text-center">Imagen</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($articulos as $articulo) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $articulo['cod_art']; ?></td>
                                                        <td class="text-center"><?php echo $articulo['art_descri']; ?></td>
                                                        <td class="text-center"><?php echo $articulo['tipo_arti_descrip']; ?></td>
                                                        <td class="text-center"><?php echo $articulo['mar_descri']; ?></td>
                                                        <td class="text-center"><?php echo $articulo['capacidad']; ?></td>
                                                        <td class="text-center"><?php echo $articulo['imp_porc']; ?></td>
                                                        <td class="text-center"><?php echo number_format($articulo['precio'], 0, ',', '.'); ?></td>
                                                        <td class="text-center"><?php echo $articulo['plazo_garantia']; ?></td>
                                                        <td class="text-center"><?php echo $articulo['garantia_descri']; ?></td>
                                                        <td class="text-center"> 
                                                         <img height="45px" src="img/<?php echo $articulo['art_imagen'];?>" /> </td>
                                                        <td class="text-center">
                                                            
                                                            <a onclick="editar(<?php echo "'" . $articulo['cod_art'] . "_" .
                                                                    $articulo['art_descri'] . "_" .$articulo['precio']. "_" .
                                                                    $articulo['cod_mar'] . "_" .$articulo['cod_imp']. "_" .
                                                                    $articulo['cod_tipo_arti'] . "_" .$articulo['capacidad']. "_" .$articulo['art_imagen'] ."'"; ?>)" 
                                                               class="btn btn-xs btn-info" rel='tooltip' data-title="Editar" 
                                                               data-toggle="modal" data-target="#editar">
                                                                <span class="glyphicon glyphicon-pencil"></span></a>
                                                                
                                                            <a onclick="borrar(<?php echo "'" . $articulo['cod_art'] . "_" . 
                                                                    $articulo['art_descri']."'"; ?>)" 
                                                               class="btn btn-xs btn-danger" rel='tooltip' data-title="Borrar"
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
                                        <strong>No se encontraron registros....</strong>
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
                            <div class="modal-header">
                                <button type="button" class="close" 
                                        data-dismiss="modal" arial-label="Close">x</button>
                               
                                <h4 class="modal-title"><strong>Registrar Articulo</strong></h4>
                            </div>
                            <form action="articulos_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body se">
                                    <input type="hidden" name="accion"  value="1">
                                    <input type="hidden" name="varti" value="0"/> 
                                    <input type="hidden" name="pagina" value="articulos_index.php">
<!--                                    INICIO DESCRIPCION-->
                                    <div class="form-group">
                                    <label class="col-lg-3 control-label">Descripción:</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control" name="vdescri" id="descri" 
                                               required="" 
                                               onblur="sololetras()"
                                               onkeyup="reemplazar()"
                                               onchange="reemplazar()"
                                               pattern="[A-Za-z and #SPACE and Ñ-ñ and ._-]{3,40}" title="Ingresa sólo letras. Tamaño mínimo: 3. Tamaño máximo: 40" 
                                               autofocus="">
                                    </div>
                                    </div>
                                    <!--Inicio Tipo de Articulo-->
                                    <div class="form-group">
                                    <label class="col-md-3 control-label">Tipo de Articulo:</label>
                                    <div class="col-md-3">
                                        <?php
                                        $tipo_articulos = consultas::get_datos("select * from tipo_articulo "
                                                        . " order by cod_tipo_arti");
                                        ?>                                 
                                        <select name="vtipo_arti" class="form-control select"  style="width: 180%">
                                            <?php
                                            if (!empty($tipo_articulos)) {
                                                foreach ($tipo_articulos as $tipo_articulo) {
                                                    ?>
                                                    <option value="<?php echo $tipo_articulo['cod_tipo_arti']; ?>">
                                                        <?php echo $tipo_articulo['tipo_arti_descrip']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar un tipo de articulo</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                 <!--Fin Tipo de articulo-->
                                  <!--Inicio Marca-->
                                    <div class="form-group">
                                    <label class="col-md-3 control-label">Marca:</label>
                                    <div class="col-md-3">
                                        <?php
                                        $marcas = consultas::get_datos("select * from marca "
                                                        . " order by cod_mar");
                                        ?>                                 
                                        <select name="vmar" class="form-control select" style="width: 180%">
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
                                                <option value="0">Debe insertar una marca</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                 <!--Fin Marca-->
                                <!--Inicio Precio-->
                                <div class="form-group"> 
                                    <label class="col-md-3 control-label">Precio:</label>
                                    <div class="col-md-3">
                                        <input type="number" id="precio"
                                               placeholder="Ingrese Precio"
                                               class="form-control" name="vprecio" onkeyup="nronegativo()" readonly=""
                                               onchange="nronegativo()" autofocus="">
                                    </div>
                                </div>
                                <!--Fin Precio-->
                                <!--  INICIO CAPACIDAD-->
                                    <div class="form-group">
                                    <label class="col-lg-3 control-label">Capacidad:</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control" name="vcapacidad"  id="capa"
                                               required="" 
                                               onblur="sololetras2()"
                                               onkeyup="reemplazar2()"
                                               onchange="reemplazar2()"
                                               pattern="[A-Za-z and #SPACE and Ñ-ñ and ._-]{3,100}" title="Ingresa sólo letras. Tamaño mínimo: 3. Tamaño máximo: 100" 
                                               autofocus="">

                                               
                                    </div>
                                    </div>
                                <!--Fin Capacidad-->
                                
                                <!--Inicio Tipo de Articulo-->
                                    <div class="form-group">
                                    <label class="col-md-3 control-label">Impuesto IVA:</label>
                                    <div class="col-md-3">
                                        <?php
                                        $tipos_impuestos = consultas::get_datos("select * from v_tipo_impuesto where cod_imp <> 4 "
                                                        . " order by cod_imp");
                                        ?>                                 
                                        <select name="vimpues" class="form-control select"  style="width: 180%">
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
                                <!--Inicio Imagen-->
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Imagen:</label>
                                    <div class="col-md-8">
                                        <input type="file" required=""
                                               placeholder="Elija la imagen del articulo"
                                               class="form-control" name="vimagen" autofocus="">
                                    </div>
                                </div>
                                <!--Fin Imagen-->  
                                 
                                 
                                </div>
                                
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
            <!--fin registrar-->
            <!--inicio editar-->
            <div id="editar" class="modal fade" role="dialog">
                 <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" 
                                    data-dismiss="modal" arial-label="Close">x</button>
                            <h4 class="modal-title"><strong>Editar Articulo</strong></h4>
                        </div>
                        <form action="articulos_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                            <div class="panel-body">
                                <input name="accion" value="2" type="hidden"/>
                                <input type="hidden" name="pagina" value="articulos_index.php">
                                <input id="cod" type="hidden" name="varti"/>
                                
<!--                                inicio descripcion-->
                                <div class="form-group">
                                     
                                <label class="col-lg-3 control-label">Descripción:</label>
                                <div class="col-lg-4">
                                    <input id="descripcion" type="text" class="form-control"  name="vdescri" style="width: 180%"
                                           required="" pattern="[A-Za-z and 0-9 and #SPACE and Ñ-ñ and ._-]{3,40}" title="Ingresa sólo letras. Tamaño mínimo: 3. Tamaño máximo: 40" 
                                           onblur="sololetras3()"
                                           onkeyup="reemplazar3()"
                                           onchange="reemplazar3()"
                                           value="<?php echo $articulos[0]['art_descri']; ?>"
                                           autofocus="">
                                    
                                </div>
                                </div>
<!--                                fin descri-->
                                 <!--Inicio tipo de articulo-->
                                    <div class="form-group">
                                    <label class="col-md-3 control-label">Tipo de Articulo:</label>
                                    <div class="col-md-3">
                                        <?php
                                        $tipo_articulos = consultas::get_datos("select * from tipo_articulo "
                                                        . " order by cod_tipo_arti");
                                        ?>                                 
                                        <select id="tipos" name="vtipo_arti" class="form-control"  style="width: 180%">
                                            <?php
                                            if (!empty($tipo_articulos)) {
                                                foreach ($tipo_articulos as $tipo_articulo) {
                                                    ?>
                                                    <option value="<?php echo $tipo_articulo['cod_tipo_arti']; ?>">
                                                        <?php echo $tipo_articulo['tipo_arti_descrip']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar un Tipo de Articulo</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                 <!--Fin Tipo de Articulo--> 
                                 <!--Inicio Marca-->
                                    <div class="form-group">
                                    <label class="col-md-3 control-label">Marca:</label>
                                    <div class="col-md-3">
                                        <?php
                                        $marcas = consultas::get_datos("select * from marca "
                                                        . " order by cod_mar");
                                        ?>                                 
                                        <select name="vmar" class="form-control" id="marca" style="width: 180%">
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
                                 <!-- inicio descripcion-->
                                <div class="form-group">
                                     
                                <label class="col-lg-3 control-label">Capacidad:</label>
                                <div class="col-lg-4">
                                    <input id="capacidad" type="text" class="form-control"  name="vcapacidad" style="width: 180%"
                                           required="" pattern="[A-Za-z and 0-9 and #SPACE and Ñ-ñ and ._-]{3,40}" title="Ingresa sólo letras. Tamaño mínimo: 3. Tamaño máximo: 40"
                                           onblur="sololetras4()"
                                           onkeyup="reemplazar4()"
                                           onchange="reemplazar4()"
                                           value="<?php echo $articulos[0]['capacidad']; ?>"
                                           autofocus="">
                                           
                                    
                                </div>
                                </div>
<!--                                fin descri-->
                               
                                 <!--Fin Marca-->
                                 <!--Inicio Precio-->
                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Precio</label>
                                    <div class="col-md-3">
                                        <input  id='precios' type="number" required="" placeholder="Ingrese Precio"  readonly=""
                                               class="form-control" name="vprecio" style="width: 180%"
                                       value="<?php echo $articulos[0]['precio']; ?>">
                                    </div>
                                </div>
                                 <!--Fin Precio-->
                                 
                                 <!--Inicio IVA-->
                               
                                    <div class="form-group">
                                    <label class="col-md-3 control-label">Impuesto IVA:</label>
                                    <div class="col-md-3">
                                        <?php
                                        $tipos_impuestos = consultas::get_datos("select * from v_tipo_impuesto v_tipo_impuesto where cod_imp <> 4 "
                                                        . " order by cod_imp");
                                        ?>                                 
                                        <select name="vimpues" id="ivas" class="form-control select"  style="width: 180%">
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
                                 
                                <!--Fin IVA-->
                                 <!--campo imagen del articulo-->
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Imagen</label>
                                     <div class="col-md-5">
                                      
                                        <input id="imagenes" type="file" style="width: 165%" 
                                               placeholder="Elija la Imagen del Imagen"
                                               class="form-control" name="vimagen"  autofocus=""  
                                               value="<?php echo $articulos[0]['art_imagen']; ?>">
                                        
<!--                                        <span autofocus=""></span>-->
                                        
                                        <div class="col-md-5">
                                             <img height="45px"  src="img/<?php echo $articulos[0]['art_imagen'];?>" /> 
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                                 <!--Fin Imagen-->
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
                $('#descripcion').val(dat[1]);
                $('#precios').val(dat[2]);
                $('#marca').val(dat[3]);
                $('#ivas').val(dat[4]);
                $('#tipos').val(dat[5]);
                $('#capacidad').val(dat[6]);
                $('#imagenes').val(dat[7]);
                
            }

            function borrar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href', 'articulos_control.php?varti=' + dat[0] +
                        '&vdescri=null' +
                        '&vprecio=null' +
                        '&vmar=null' +
                        '&vimpues=null' +
                        '&vtipo_arti=null' + 
                        '&vimagen=null' + 
                        '&accion=3&pagina=articulos_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Borrar el Articulo <i><strong>' + dat[1] + '</strong></i>?');
            }
            
            function sololetras() {
//                      var numero = trim(numero);
                var numero = document.getElementById("descri").value;
                if (numero.length === 0 || numero=== " " || numero=== "  " || numero=== "   " || numero=== "    " || numero=== "     " || numero=== "      " || numero=== "          " ){
                    
                notificacion('Atencion','No se permiten campos vacios','error'); //y esta notificacion tiene mensaje rojo
               //  notificacion('Atencion','No se permiten campos vacios','mensaje'); //esta notificacion tiene mensaje amarillo
               
                document.getElementById("descri").value = '';
                } else {
                   
                }
            }
            function sololetras2() {
//                      var numero = trim(numero);
                var numero = document.getElementById("capa").value;
                if (numero.length === 0 || numero=== " " || numero=== "  " || numero=== "   " || numero=== "    " || numero=== "     " || numero=== "      " || numero=== "          " ){
                    
                notificacion('Atencion','No se permiten campos vacios','error'); //y esta notificacion tiene mensaje rojo
               //  notificacion('Atencion','No se permiten campos vacios','mensaje'); //esta notificacion tiene mensaje amarillo
               
                document.getElementById("capa").value = '';
                } else {
                   
                }
            }
            function sololetras3() {
//                      var numero = trim(numero);
                var numero = document.getElementById("descripcion").value;
                if (numero.length === 0 || numero=== " " || numero=== "  " || numero=== "   " || numero=== "    " || numero=== "     " || numero=== "      " || numero=== "          " ){
                    
                notificacion('Atencion','No se permiten campos vacios','error'); //y esta notificacion tiene mensaje rojo
               //  notificacion('Atencion','No se permiten campos vacios','mensaje'); //esta notificacion tiene mensaje amarillo
               
                document.getElementById("descripcion").value = '';
                } else {
                   
                }
            }
            function sololetras4() {
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
                var valor=document.getElementById('descri').value.replace("'","");
                document.getElementById('descri').value=valor;
                }
                function reemplazar2(){
//                   alert($('#apel').val());
                var valor=document.getElementById('capa').value.replace("'","");
                document.getElementById('capa').value=valor;
                }
                function reemplazar3(){
//                   alert($('#apel').val());
                var valor=document.getElementById('descripcion').value.replace("'","");
                document.getElementById('descripcion').value=valor;
                }
                function reemplazar4(){
//                   alert($('#apel').val());
                var valor=document.getElementById('capacidad').value.replace("'","");
                document.getElementById('capacidad').value=valor;
                }
               
//                function reemplazar1(){
////                   alert($('#apel').val());
//                var valor=document.getElementById('capacidad').value.replace("'","");
//                document.getElementById('capacidad').value=valor;
//                }
//                
            //para que no permita numeros negativos ni letras ci
            function nronegativo() {

                var numero = document.getElementById("ci").value;
                if (numero.match(/^-?[0-9]+(\.[0-9]{1,2})?$/))
                {
//                    alert("numero ok");
                }
                else
                {
                    alert("No se permite numeros negativos, letras, puntos o espacios vacios");
                    document.getElementById("ci").value = "";
                }
            }
   //hasta aqui
        </script>


    </body>
</html>
