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
                        <h3 class="page-header text-center">Listado de Paginas 
                            
<!--                            <a href="imprimir_tipoimpuesto.php" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Imprimir" target="_blank">
                                <i class="fa fa-print"></i>
                            </a> -->
                            <a data-toggle="modal" data-target="#registrar" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Registrar Paginas">
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
                            $paginas_registros = consultas::get_datos("select * from v_paginas
                                         order by pag_cod asc ");
                            if (!empty($paginas_registros)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"># Pag</th>
                                                    <th class="text-center">Pag. Nombre</th>  
                                                    <th class="text-center">Direccion URL</th>
                                                    <th class="text-center"># Mod</th>
                                                    <th class="text-center">Modulo</th>  
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($paginas_registros as $pagina_registro) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $pagina_registro['pag_cod']; ?></td>
                                                        <td class="text-center"><?php echo $pagina_registro['pag_nombre']; ?></td>
                                                        <td class="text-center"><?php echo $pagina_registro['pag_direc']; ?></td>
                                                        <td class="text-center"><?php echo $pagina_registro['mod_cod']; ?></td>
                                                        <td class="text-center"><?php echo $pagina_registro['mod_nom']; ?></td>
                                                        <td class="text-center">
                                                            <a href="paginas_registro_editar.php?vpag=<?php echo $pagina_registro['pag_cod'];?>" 
                                                               class="btn btn-xs btn-info" rel='tooltip' data-title="Editar Pagina"
                                                               data-toggle="modal">
                                                                <span class="glyphicon glyphicon-pencil"></span></a>
                                                                 
                                                            <a onclick="borrar(<?php echo "'" . $pagina_registro['pag_cod'] . "_" . 
                                                                    $pagina_registro['pag_direc'] . "_" .
                                                                    $pagina_registro['pag_nombre'] . "_" . 
                                                                    $pagina_registro['mod_cod'] . "'"; ?>)" 
                                                               class="btn btn-xs btn-warning" rel='tooltip' data-title="Borrar Pagina"
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
                                <h4 class="modal-title"><strong>Registrar Pagina</strong></h4>
                            </div>
                            <form action="paginas_registro_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body se">
                                    <input type="hidden" name="accion"  value="1">
                                    <input type="hidden" name="vpag" value="0"/> 
                                    <input type="hidden" name="pagina" value="paginas_registro_index.php">
                                    
                                    
                                <!-- INICIO NOMBRE-->
                                    <div class="form-group">
                                    <label class="col-lg-3 control-label">Pag. Nombre:</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="vnom" id="nom" 
                                               required="" 
                                               placeholder="Ingrese Nombre de la Pagina"
                                               onkeyup="reemplazar()"
                                               onchange="reemplazar()"
                                               pattern="[A-Za-z and #SPACE]{3,40}" title="Ingresa sólo letras. Tamaño mínimo: 3. Tamaño máximo: 40" 
                                               autofocus="">
                                    </div>
                                    </div>
                                <br>
<!--                                Fin nombre-->
                            <!-- INICIO DIRECCION-->
                                    <div class="form-group">
                                    <label class="col-lg-3 control-label">Pag. Direccion:</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control" name="vdirec" 
                                               placeholder="Ingrese URL Ej: menu_editar_index.php"
                                               required="" 
                                               autofocus="">
                                    </div>
                                    </div>
                            <br>
<!--                                Fin direc-->
                                 <!--Inicio Modulos-->
                                    <div class="form-group">
                                    <label class="col-md-3 control-label">Modulos:</label>
                                    <div class="col-md-3">
                                        <?php
                                        $modulos = consultas::get_datos("select * from modulos "
                                                        . " order by mod_cod");
                                        ?>                                 
                                        <select name="vmod" class="form-control select"  style="width: 180%">
                                            <?php
                                            if (!empty($modulos)) {
                                                foreach ($modulos as $modulo) {
                                                    ?>
                                                    <option value="<?php echo $modulo['mod_cod']; ?>">
                                                        <?php echo $modulo['mod_nom']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar un Modulo</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                 <br>
                                 <!--Fin modulos-->
                                
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
            <!--editar No me ando bien asi que este no use-->
            
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
//            function editar(datos) {
//                var dat = datos.split("_");
//                $('#cod').val(dat[0]);
//                $('#direccion').val(dat[1]);
//                $('#nombres').val(dat[2]);
//                $('#modu').val(dat[3]);
//            }

//            function borrar(datos) {
//                var dat = datos.split("_");
//                $('#si').attr('href', 'paginas_registro_control.php?vpag=' + dat[0] +
//                        '&vdirec=null' +
//                        '&vnom=null' + 
//                        '&vmod=null' +
//                        + '&accion=3&pagina=paginas_registro_index.php');
//                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
//            Desea Borrar la Pagina <i><strong>' + dat[3] + '</strong></i>?');
//            }
            
            function borrar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href'
                , 'paginas_registro_control.php?vpag=' + dat[0] + 
                        '&vdirec=null'+
                        '&vnom=null'+
                        '&vmod=null'+
                        '&accion=3'+
                        '&pagina=paginas_registro_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Borrar la Pagina <i><strong>' + dat[1] + '</strong></i>?');
            }
            
            //para reemplazar comilla simple
            function reemplazar(){
//                   alert($('#apel').val());
                var valor=document.getElementById('nom').value.replace("'","");
                document.getElementById('nom').value=valor;
                }
                
            //para que no permita numeros negativos ni letras ci
//            function nronegativo() {
//
//                var numero = document.getElementById("ci").value;
//                if (numero.match(/^-?[0-9]+(\.[0-9]{1,2})?$/))
//                {
////                    alert("numero ok");
//                }
//                else
//                {
//                    alert("No se permite numeros negativos, letras, puntos o espacios vacios");
//                    document.getElementById("ci").value = "";
//                }
//            }
//   //hasta aqui
        </script>


    </body>
</html>

