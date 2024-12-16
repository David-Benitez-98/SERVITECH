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
                        <h3 class="page-header">Listado de Personas 
                            <a href="personas_agregar.php" 
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
                            $personas = consultas::get_datos("select * from v_personas 
                                         order by cod_per asc ");
                            if (!empty($personas)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Tipo-P</th>
                                                    <th class="text-center">Ci/Ruc</th>                                        
                                                    <th class="text-center">Persona</th>
                                                    <th class="text-center">Nacion</th>
                                                    <th class="text-center">Estado</th>
                                                    <th class="text-center">Ciudad</th>
                                                    <th class="text-center">Telef</th>
                                                    <th class="text-center">Direc</th>
                                                    <th class="text-center">Accion</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($personas as $persona) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $persona['cod_per']; ?></td>
                                                        <td class="text-center"><?php echo $persona['tipo_persona']; ?></td>
                                                        <td class="text-center"><?php echo $persona['per_ci_ruc']; ?></td>
                                                        <td class="text-center"><?php echo $persona['persona']; ?></td>
                                                        <td class="text-center"><?php echo $persona['nac_des']; ?></td>
                                                        <td class="text-center"><?php echo $persona['ec_des']; ?></td>
                                                        <td class="text-center"><?php echo $persona['ciu_des']; ?></td>
                                                        <td class="text-center"><?php echo $persona['per_telf']; ?></td>
                                                        <td class="text-center"><?php echo $persona['per_direc']; ?></td>
                                                        <td class="text-center">
                                                            <a href="personas_editar.php?vper=<?php echo $persona['cod_per']?><?= "&vtipoperso=" . $persona['tipo_persona'] ?>" 
                                                               class="btn btn-xs btn-info" rel='tooltip' data-title="Editar"
                                                               data-toggle="modal">
                                                                <span class="glyphicon glyphicon-pencil"></span></a>
                                                            <a onclick="borrar(<?php echo "'".$persona['cod_per']."_".
                                                                    $persona['persona']."'"; ?>)" 
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

            }

            function borrar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href'
                , 'personas_control.php?vper=' + dat[0] + 
                        '&vnombre=null'+
                        '&vapellido=null'+
                        '&vtipoperso=null'+
                        '&vci=null'+
                        '&vtel=null'+
                        '&vnac=null' +
                        '&vec=null' +
                        '&vciu=null' +
                        '&vdepar=null'+
                        '&vdirec=null'+
                        '&vtipodocu=null'+
                        '&vfecnac=1900-01-01'+
                        '&vsexo=null'+
                        '&accion=3'+
                        '&pagina=personas_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Borrar la Persona <i><strong>' + dat[1] + '</strong></i>?');
            }
        </script>


    </body>
</html>



