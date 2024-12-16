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
                        <h3 class="page-header">Listado - Tipos de Impuestos de los Articulos y Servicios
                            <a href="imprimir_tipoimpuesto.php" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Imprimir" target="_blank">
                                <i class="fa fa-print"></i>
                            </a> 
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
                            $tiposimpuestos = consultas::get_datos("select * from tipo_impuesto
                                         order by cod_imp asc ");
                            if (!empty($tiposimpuestos)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Descripción</th>  
                                                    <th class="text-center">Porcentaje %</th> 
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($tiposimpuestos as $tipoimpuesto) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $tipoimpuesto['cod_imp']; ?></td>
                                                        <td class="text-center"><?php echo $tipoimpuesto['imp_descri']; ?></td>
                                                        <td class="text-center"><?php echo $tipoimpuesto['imp_porc']; ?></td>
                                                        <td class="text-center">
                                                            <a onclick="editar(<?php echo "'" . $tipoimpuesto['cod_imp'] . "_" .
                                                                    $tipoimpuesto['imp_descri'] . "_" .
                                                                    $tipoimpuesto['imp_porc'] . "'"; ?>)" 
                                                               class="btn btn-xs btn-info" rel='tooltip' data-title="Editar" 
                                                               data-toggle="modal" data-target="#editar">
                                                                <span class="glyphicon glyphicon-pencil"></span></a>
                                                            <a onclick="borrar(<?php echo "'" . $tipoimpuesto['cod_imp'] . "_" . 
                                                                    $tipoimpuesto['imp_descri'] . "_" . 
                                                                    $tipoimpuesto['imp_porc'] . "'"; ?>)" 
                                                               class="btn btn-xs btn-warning" rel='tooltip' data-title="Borrar"
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
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" 
                                        data-dismiss="modal" arial-label="Close">x</button>
                                <h4 class="modal-title"><strong>Registrar Tipo de Impuesto</strong></h4>
                            </div>
                            <form action="tipoimpuesto_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body se">
                                    <input type="hidden" name="accion"  value="1">
                                    <input type="hidden" name="vimp_cod" value="0"/> 
                                    <input type="hidden" name="pagina" value="tipoimpuesto_index.php">

                                    <div class="form-group">
                                    <label class="col-lg-2 control-label">Descripcion:</label>
                                    <div class="col-lg-10">
                                        <input type="text" required="" id="nom"
                                          placeholder="Ingrese Descripcion"  
                                          class="form-control" name="vimp_nom"
                                          onkeyup="reemplazar()"
                                          onchange="reemplazar()"
                                          pattern="[A-Za-z and 0-9 and #SPACE]{3,40}" title="Ingresa sólo letras. Tamaño mínimo: 3. Tamaño máximo: 40" 
                                          autofocus="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Porcentaje%:</label>
                                    <div class="col-lg-10">
                                        <input type="number"  
                                               placeholder="Ingrese Porcentaje en numeros enteros" 
                                               class="form-control" name="vimp_porc" 
                                               required="" 
                                               onkeyup="nronegativo()"
                                               onchange="nronegativo()"
                                               autofocus="" >
                                    </div>
                                </div>
                                <br>
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
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" 
                                    data-dismiss="modal" arial-label="Close">x</button>
                            <h4 class="modal-title"><strong>Editar Tipo de Impuesto</strong></h4>
                        </div>
                        <form action="tipoimpuesto_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                            <div class="panel-body">
                                <input name="accion" value="2" type="hidden"/>
                                <input type="hidden" name="pagina" value="tipoimpuesto_index.php">
                                <input id="cod" type="hidden" name="vimp_cod"/>
                                
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Descripcion:</label>
                                    <div class="col-lg-10">
                                        <input id="descri" type="text" required="" id="nom"
                                       class="form-control" name="vimp_nom" onkeyup="reemplazar()"
                                               onchange="reemplazar()" autofocus="">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Porcentaje%:</label>
                                    <div class="col-lg-10">
                                        <input id="porcen" type="number" required="" 
                                               placeholder="Ingrese Porcentaje en numeros enteros" 
                                               class="form-control" name="vimp_porc"  autofocus="" >
                                    </div>
                                </div>
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
                $('#porcen').val(dat[2]);

            }

            function borrar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href', 'tipoimpuesto_control.php?vimp_cod=' + dat[0] + '&vimp_nom=' + dat[1]
                        + '&vimp_porc=' + dat[2]
                        + '&accion=3&pagina=tipoimpuesto_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Borrar el Tipo Impuesto <i><strong>' + dat[1] + '</strong></i>\n\
            <i><strong>' + dat[2] + ' % </strong></i>?');
            }
            
            //para reemplazar comilla simple
            function reemplazar(){
//                   alert($('#apel').val());
                var valor=document.getElementById('nom').value.replace("'","");
                document.getElementById('nom').value=valor;
                }
                
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

