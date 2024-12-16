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
                        <h3 class="page-header text-center">Listado de Proveedores<!--Titulo de pagina web-->
                            <a href="personas_agregar_prov.php" 
                               class="btn btn-info btn-circle pull-left" 
                               rel="tooltip" data-title="Registrar Personas">
                                <i class="fa fa-plus-square"></i>
                            </a>
<!--                            <a href="imprimir_proveedores.php" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Imprimir" target="_blank">
                                <i class="fa fa-print"></i>
                            </a> -->
                            <!--Llama al modal con el boton de cruz-->
                            <a data-toggle="modal" data-target="#registrar" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Registrar Proveedor">
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
                            $proveedores = consultas::get_datos("select * from v_proveedor3 
                                         order by cod_prov asc ");
                            if (!empty($proveedores)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">TIPO PROV.</th> 
                                                    <th class="text-center">RUC/CI</th>                                        
                                                    <th class="text-center">RAZON</th>
                                                    <th class="text-center">TELF.</th>
                                                    <th class="text-center">DIREC.</th>
                                                    <th class="text-center">CIUDAD</th>
                                                    <th class="text-center">DEPART.</th>
                                                    <th class="text-center">ESTADO</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($proveedores as $proveedor) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $proveedor['cod_prov']; ?></td>
                                                        <td class="text-center"><?php echo $proveedor['tipo_persona']; ?></td>
                                                        <td class="text-center"><?php echo $proveedor['per_ci_ruc']; ?></td>
                                                        <td class="text-center"><?php echo $proveedor['persona']; ?></td>
                                                        <td class="text-center"><?php echo $proveedor['per_telf']; ?></td>
                                                        <td class="text-center"><?php echo $proveedor['per_direc']; ?></td>
                                                        <td class="text-center"><?php echo $proveedor['ciu_des']; ?></td>
                                                        <td class="text-center"><?php echo $proveedor['dep_descri']; ?></td>
                                                        <td class="text-center"><?php echo $proveedor['estado']; ?></td>
                                                        <td class="text-center">
                                                            
                                                            <a onclick="editar(<?php echo "'" . $proveedor['cod_prov'] . "_" .
                                                                    $proveedor['cod_per']."'"; ?>)"  
                                                               class="btn btn-xs btn-info" rel='tooltip' data-title="Editar" 
                                                               data-toggle="modal" data-target="#editar">
                                                                <span class="glyphicon glyphicon-pencil"></span></a>
                                                                
                                                                                                               
                                                            <a href="personas_editar_prov.php?vper=<?= $proveedor['cod_per'] ?>"
                                                                       class="btn btn-xs btn-success" rel='tooltip' data-title="Actualizar Datos Persona" >
                                                                        <span class="glyphicon glyphicon-pencil"></span></a>

                                                           
                                                         <?php if ($proveedor['estado'] == 'ACTIVO') { ?>       
                                                            <a onclick="desactivar(<?php
                                                            echo "'" . $proveedor['cod_prov'] . "_" .
                                                            $proveedor['cod_per'] . "_" .
                                                            $proveedor['estado'] . "_" .
                                                            $proveedor['persona'] . "'" ;
                                                            ?>)" 
                                                               class="btn btn-xs btn-warning" rel="tooltip" title="Inactivar Proveedor"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-ban-circle"></span></a>
                                                                
                                                                
                                                        </td>
                                                    </tr>
                                                    <?php } ?> 
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
                               
                                <h4 class="modal-title"><strong>Registrar Proveedor</strong></h4>
                            </div>
                            <form action="proveedor_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body se">
                                    <input type="hidden" name="accion"  value="1">
                                    <input type="hidden" name="vprov" value="0"/> 
                                    <input type="hidden" name="pagina" value="proveedor_index.php">
<!--                                    <div class="form-group">
                                    <label class="col-lg-3 control-label">Descripción:</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control" name="vdescri_art" id="descri" 
                                               required="" pattern="[A-Za-z and #SPACE]{3,40}" title="Ingresa sólo letras. Tamaño mínimo: 3. Tamaño máximo: 40" autofocus="">
                                    </div>
                                    </div>-->

                                    <!--Inicio Nombre Cliente<-->
                                    <div class="form-group">
                                    <label class="col-md-3 control-label">Proveedor:</label>
                                    <div class="col-md-4">
                                        <?php
                                        $personas = consultas::get_datos("select * from v_personas "
                                                        . " order by cod_per");
                                        ?>                                 
                                        <select name="vper" class="form-control select"  style="width: 180%">
                                            <?php
                                            if (!empty($personas)) {
                                                foreach ($personas as $persona) {
                                                    ?>
                                                    <option value="<?php echo $persona['cod_per']; ?>">
                                                        <?php echo $persona['datos_persona']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar un Proveedor</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                            
                                </div> 
                                 
                                 
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
                            <h4 class="modal-title"><strong>Editar Proveedor</strong></h4>
                        </div>
                        <form action="proveedor_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                            <div class="panel-body">
                                <input name="accion" value="2" type="hidden"/>
                                <input type="hidden" name="pagina" value="proveedor_index.php">
                                <input id="cod" type="hidden" name="vprov"/>
                                
<!--                                <div class="form-group">
                                     
                                <label class="col-lg-3 control-label">Descripción:</label>
                                <div class="col-lg-3">
                                    <input id="descrip" type="text" class="form-control"  name="vdescri_art" style="width: 180%"
                                           required="" pattern="[A-Za-z and 0-9 and #SPACE]{3,40}" title="Ingresa sólo letras. Tamaño mínimo: 3. Tamaño máximo: 40" autofocus="">
                                    
                                </div>
                                </div>-->
                                 <!--Inicio tipo de articulo-->
                                    <div class="form-group">
                                    <label class="col-md-3 control-label">Proveedor:</label>
                                    <div class="col-md-4">
                                        <?php
                                        $personas = consultas::get_datos("select * from v_personas "
                                                        . " order by datos_persona");
                                        ?>                                 
                                        <select id="nombre" name="vper" class="form-control"  style="width: 180%">
                                            <?php
                                            if (!empty($personas)) {
                                                foreach ($personas as $persona) {
                                                    ?>
                                                    <option value="<?php echo $persona['cod_per']; ?>">
                                                        <?php echo $persona['datos_persona']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar un Proveedor</option>
                                            <?php } ?>
                                        </select>
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
                $('#nombre').val(dat[1]);
                
            }

            function desactivar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href', 'proveedor_control.php?vprov=' + dat[0] +
                        '&vper=null' +
                        '&vestado=INACTIVO' +
                        '&accion=4&pagina=proveedor_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-ban-circle"></span>\n\
            Desea Inactivar el Proveedor <i><strong>' + dat[3] + '</strong></i>?');
            }
            
//            function desactivar(datos) {
//                    var dat = datos.split("_");
//                    $('#si').attr('href', 'proveedor_control.php?vprov=' + dat[0] +
//                              '&vper=' + dat[1] + 
//                            + '&vestado=' + dat[2] +
//                            + '&accion=3&pagina=proveedor_index.php');
//                    $('#confirmacion').html
//                            ('<span class="glyphicon glyphicon-warning-sign"></span>\n\
//            Desea Desactivar el Proveedor <i><strong>' + dat[3] + '</strong></i>?');
//                }
        </script>


    </body>
</html>


