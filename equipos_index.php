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
                        <h3 class="page-header text-center">Listado de Equipos
                            
                            <a href="imprimir_tipoimpuesto.php" 
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
                            $equipos = consultas::get_datos("select * from v_equipos
                                         order by cod_equipo asc ");
                            if (!empty($equipos)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">TIPO</th>
                                                    <th class="text-center">MARCA</th>  
                                                    <th class="text-center">COLOR</th>  
                                                    <th class="text-center">CAPACIDAD</th>   
                                                    <th class="text-center">ACCIONES</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($equipos as $equipo) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $equipo['cod_equipo']; ?></td>
                                                        <td class="text-center"><?php echo $equipo['descri_tipo']; ?></td>
                                                        <td class="text-center"><?php echo $equipo['mar_descri']; ?></td>
                                                        <td class="text-center"><?php echo $equipo['descri_color']; ?></td>
                                                        <td class="text-center"><?php echo $equipo['descri_equipo']; ?></td>
                                                        <td class="text-center">
                                                            
                                                            <a onclick="editar(<?php echo "'" . $equipo['cod_equipo'] . "_" .
                                                                    $equipo['descri_tipo'] . "_" .
                                                                    $equipo['cod_mar'] . "_" .
                                                                    $equipo['cod_tipo_equi'] . "_" .
                                                                    $equipo['cod_color_equi'] . "'"; ?>)" 
                                                               class="btn btn-xs btn-info" rel='tooltip' data-title="Editar Equipo" 
                                                               data-toggle="modal" data-target="#editar">
                                                                <span class="glyphicon glyphicon-pencil"></span></a>
                                                                
                                                             <a onclick="borrar(<?php echo "'" . $equipo['cod_equipo'] . "_" . 
                                                                    $equipo['descri_equipo'] . "_" .
                                                                    $equipo['cod_mar'] . "_" .
                                                                    $equipo['cod_tipo_equi'] . "_" .
                                                                    $equipo['cod_color_equi']. "_" .
                                                                    $equipo['datos_equipos'] . "'"; ?>)" 
                                                               class="btn btn-xs btn-warning" rel='tooltip' data-title="Borrar Equipo"
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
                            <div class="modal-header">
                                <button type="button" class="close" 
                                        data-dismiss="modal" arial-label="Close">x</button>
                                <h4 class="modal-title"><strong>Registrar Equipos</strong></h4>
                            </div>
                            <form action="equipos_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body se">
                                    <input type="hidden" name="accion"  value="1">
                                    <input type="hidden" name="vequi" value="0"/> 
                                    <input type="hidden" name="pagina" value="equipos_index.php">

                                   
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
                                               required="" 
                                               onkeyup="reemplazar()"
                                               onchange="reemplazar()"
                                               autofocus="">
<!--                                           pattern="[A-Za-z and #SPACE]{3,100}" title="Ingresa sólo letras. Tamaño mínimo: 3. Tamaño máximo: 100" -->
                                               
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
            </div>
            <!--fin-->
            <!--editar-->
            <div id="editar" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" 
                                    data-dismiss="modal" arial-label="Close">x</button>
                            <h4 class="modal-title"><strong>Editar Equipos</strong></h4>
                        </div>
                        <form action="equipos_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                            <div class="panel-body">
                                <input name="accion" value="2" type="hidden"/>
                                <input type="hidden" name="pagina" value="equipos_index.php">
                                <input id="cod" type="hidden" name="vequi"/>
                                
                                <!--Inicio Empresa-->
                                    <div class="form-group">
                                    <label class="col-lg-3 control-label">Tipo Equipo:</label>
                                    <div class="col-lg-4">
                                        <?php
                                        $tipos_equipos = consultas::get_datos("select * from tipo_equipo "
                                                        . " order by cod_tipo_equi");
                                        ?>                                 
                                        <select id="tipo_equi" name="vtipo" class="form-control select">
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
                                        <select id="mar" name="vmar" class="form-control select" >
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
                                        <select id="color" name="vcolor" class="form-control select">
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
                                        <input type="text" class="form-control" id="descri_equi" name="vdescri"  
                                               required="" 
                                               onkeyup="reemplazar2()"
                                               onchange="reemplazar2()"
                                               onblur="sololetras()"
                                               value="<?php echo $equipos[0]['descri_equipo']; ?>"
                                               autofocus="">
<!--                                           pattern="[A-Za-z and #SPACE]{3,100}" title="Ingresa sólo letras. Tamaño mínimo: 3. Tamaño máximo: 100" -->
                                               
                                    </div>
                                    </div>
                                <!--Fin Capacidad-->
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
                $('#descri').val(dat[1]);
                $('#mar').val(dat[2]);
                $('#tipo_equi').val(dat[3]);
                $('#color').val(dat[4]);
            }
            
            function borrar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href', 'equipos_control.php?vequi=' + dat[0] +
                        '&vdescri=' + dat[1] +
                        '&vmar=' + dat[2] +
                        '&vtipo=' + dat[3] +
                        '&vcolor=' + dat[4] +
                        '&accion=3&pagina=equipos_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-ban-circle"></span>\n\
            Desea Borrar El Equipo <i><strong>' + dat[5] + '</strong></i>?');
            }
            
            //para reemplazar comilla simple
            function reemplazar(){
//                   alert($('#apel').val());
                var valor=document.getElementById('nom').value.replace("'","");
                document.getElementById('nom').value=valor;
                }
                function reemplazar2(){
//                   alert($('#apel').val());
                var valor=document.getElementById('capacidad').value.replace("'","");
                document.getElementById('capacidad').value=valor;
                }
                
                function sololetras() {
//                      var numero = trim(numero);
                var numero = document.getElementById("capacidad").value;
                if (numero.length === 0 || numero=== " " || numero=== "  " || numero=== "   " || numero=== "    " || numero=== "     " || numero=== "      " || numero=== "          " ){
                    
                notificacion('Atencion','No se permiten campos vacios','error'); //y esta notificacion tiene mensaje rojo
               //  notificacion('Atencion','No se permiten campos vacios','mensaje'); //esta notificacion tiene mensaje amarillo
                document.getElementById("capacidad").value = '';
                } else {
                   
                }
            }
                
            //para que no permita numeros negativos ni letras ci
            function nronegativotel() {

                var numero = document.getElementById("tel").value;
                if (numero.match(/^-?[0-9]+(\.[0-9]{1,2})?$/))
                {
//                    alert("numero ok");
                }
                else
                {
                    alert("Ingrese su numero sin puntos, letras ni espacios");
                    document.getElementById("tel").value = "";
                }
            }
   //hasta aqui
   
        </script>


    </body>
</html>

