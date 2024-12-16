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
                        <h3 class="page-header">Listado de Usuario 
                            <a href="usuario_agregar.php" 
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
                            $usuarios = consultas::get_datos("select * from v_usuarios 
                                         order by cod_usu asc ");
                            if (!empty($usuarios)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>                                        
                                                    <th class="text-center">Funcionario</th>
                                                    <th class="text-center">Grupo</th>
                                                    <th class="text-center">Nick</th>
                                                    <th class="text-center">Sucursal</th>
                                                    <th class="text-center">Estado</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($usuarios as $usuario) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $usuario['cod_usu']; ?></td>
                                                        <td class="text-center"><?php echo $usuario['usuario']; ?></td>
                                                        <td class="text-center"><?php echo $usuario['gru_nom']; ?></td>
                                                        <td class="text-center"><?php echo $usuario['usu_nick']; ?></td>
                                                        <td class="text-center"><?php echo $usuario['suc_descri']; ?></td>
                                                        <td class="text-center"><?php echo $usuario['usu_estado']; ?></td>
                                                        <td class="text-center">
                                                            <a href="/servitech_tesis/paginas.php?vgrup=<?php echo $usuario['cod_gru'] .
                                                                '&vgrunombre=' . $usuario['gru_nom'];?>" 
                                                               class="btn btn-xs btn-success" rel='tooltip' title="Permisos">
                                                                <span class="glyphicon glyphicon-plus"></span></a>

                                                            <a href="usuario_editar.php?vcodusu=<?php echo $usuario['cod_usu']; ?>" 
                                                               class="btn btn-xs btn-primary" rel='tooltip' data-title="Editar"
                                                               data-toggle="modal">
                                                                <span class="glyphicon glyphicon-pencil"></span></a>
                                                           <a onclick="desactivar(<?php
                                                            echo "'" . $usuario['cod_usu'] . "_" .
                                                            $usuario['cod_fun'] . "_" .
                                                            $usuario['cod_gru'] . "_" .
                                                            $usuario['usu_nick'] . "_" .  
                                                            $usuario['usu_estado'] .  "_" .
                                                            $usuario['cod_suc'] .  "_" .
                                                            $usuario['usuario'] . "'";
                                                            ?>)" 
                                                               class="btn btn-xs btn-danger" rel="tooltip" title="Desactivar Usuario"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-ban-circle"></span></a>
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

                 function desactivar(datos) {
                    var dat = datos.split("_");
                    $('#si').attr('href', 'usuario_control.php?vcodusu=' + dat[0] + 
                            + '&vcodfun=' + dat[1] + 
                            '&vcodgru=' + dat[2] +
                            '&vnickusu=' + dat[3] + 
                            'vclaveusu=null' +
                            '&vestado=' + dat[4] +
                            'vsuc=null' + dat[5] +
                            'vperfil=null' +
                            + '&accion=3&pagina=usuario_index.php');
                    $('#confirmacion').html
                            ('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Desactivar el Usuario <i><strong>' + dat[6] + '</strong></i>?');
                }
            </script>


    </body>
</html>




