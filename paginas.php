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
        require 'menu/css.ctp';
        ?>

    </head>
    <body>
        <div id="wrapper">
            <?php require 'menu/navbar.php'; ?><!--BARRA DE HERRAMIENTAS-->
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header">Permisos de Usuarios
                            <a data-toggle="modal" data-target="#registrar" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel='tooltip' title="Añadir">
                                <i class="glyphicon glyphicon-plus"></i>
                            </a>    
                        </h3>
                    </div>     
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Grupo: <i><strong><?php echo $_REQUEST['vgrunombre']; ?>
                                    </strong></i>
                            </div>
                            <?php
                            $paginas = consultas::get_datos
                                            ("select * from v_permisos "
                                            . " where cod_gru=" . $_REQUEST['vgrup']); ?>

                                <?php if (!empty($paginas)) { ?>                     
                                <div class="panel-body">
                                 <?php foreach ($paginas as $pagina) { ?>                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="list-group-item-heading" 
                                                     style="width: 87%;">
                                                    <div class="col-lg-2">
                                                        <i><strong>
                                 <?php echo $pagina['pag_nombre']; ?>
                                                            </strong></i>    
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <small>
                                                            <i><strong>Consultar:</strong> 
                                                                <?php
                                                                if ($pagina['leer'] == 't') {
                                                                    echo ("SI");
                                                                } else {
                                                                    echo ("NO");
                                                                }
                                                                ?></i>
                                                        </small>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <small>
                                                            <i><strong>Insertar:</strong> 
                                                                <?php
                                                                if ($pagina['insertar'] == 't') {
                                                                    echo ("SI");
                                                                } else {
                                                                    echo ("NO");
                                                                }
                                                                ?></i>
                                                        </small>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <small>
                                                            <i><strong>Actualizar:</strong> <?php
                                                                if ($pagina['editar'] == 't') {
                                                                    echo ("SI");
                                                                } else {
                                                                    echo ("NO");
                                                                }
                                                                ?></i>
                                                        </small>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <small>
                                                            <i><strong>Borrar:</strong> <?php
                                                                if ($pagina['borrar'] == 't') {
                                                                    echo ("SI");
                                                                } else {
                                                                    echo ("NO");
                                                                }
                                                                ?></i>
                                                        </small>
                                                    </div>                                      
                                                </div>
                                                <div class="media-right media-middle" 
                                                     style="padding-left: 58px;">
                                                    <div class="pull-right action-buttons">
<!--                                                        editar-->
                                                        <a onclick="editpag(<?php
                                                        echo "'" .
                                                        $pagina['cod_gru'] . "_" .
                                                        $pagina['pag_cod'] . "_" .
                                                        $pagina['gru_nom'] . "_" .
                                                        $pagina['pag_nombre'] . "'";
                                                        ?>)" 
                                                           class="btn btn-xs btn-success"
                                                           role="button" data-title="Editar"
                                                           data-placement="top" rel="tooltip"
                                                           data-toggle='modal' data-target='#editar'>
                                                            <span class="glyphicon glyphicon glyphicon-pencil">   
                                                            </span>
                                                        </a>
<!--                                                            borrar-->
                                                        <a onclick="borrar(<?php
                                                        echo "'" . $pagina['cod_gru']. "_"
                                                                 . $pagina['pag_cod'] . "_" 
                                                                 . $pagina['gru_nom'] . "_"
                                                                 . $pagina['pag_nombre'] . "'";
                                                        ?>)"
                                                        class="btn btn-xs btn-danger" role="button"
                                                        data-title="Borrar" data-placement="top" rel="tooltip"
                                                        data-toggle="modal" data-target="#delete">
                                                            <span class="glyphicon glyphicon-trash"></span></a>
                                                    </div>
                                                </div>
                                            </div>                                    
                                        </div>
                                        <?php } ?> 
                                <?php } else { ?>
                                    <div class="alert alert-info">
                                        <span class="glyphicon glyphicon-info-sign"></span>
                                        No se han autorizado interfaces...
                                    </div>
                                <?php } ?>                  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--registrar-->
        <div id="registrar" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" 
                                data-dismiss="modal" arial-label="Close">x</button>
                        <h4 class="modal-title"><strong>Registrar Permisos</strong></h4>
                    </div>
                    <div class="panel-body">
                        <form action="paginas_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                            <div class="panel-body se">
                                <input type="hidden" name="accion"  value="1">
                                <input type="hidden" name="vgru" value="<?php echo $_REQUEST['vgrup'] ?>"/> 
                                <input type="hidden" name="vgrunombre" value="<?php echo $_REQUEST['vgrunombre'] ?>">
                                <input type="hidden" name="pagina" value="paginas.php">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Grupo</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="grupo" 
                                               value="<?php echo $_REQUEST['vgrunombre'] ?>" readonly=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Permisos</label>
                                    <div class="col-lg-6">
                                            <?php
                                            $permisos = consultas::get_datos("select * from paginas where "
                                                            . " pag_cod not in (select pag_cod from permisos "
                                                            . " where cod_gru=" . $_REQUEST['vgrup'] . ")");
                                            ?>                                 
                                        <select name="vpag" class="form-control">
                                            <?php
                                            if (!empty($permisos)) {
                                                foreach ($permisos as $permiso) {
                                                    ?>
                                                    <option value="<?php echo $permiso['pag_cod']; ?>"><?php echo $permiso['pag_nombre']; ?></option>
                                                    <?php
                                                            }
                                                            } else {
                                                                         ?>
                                                          <option value="0">Debe insertar un grupo</option>
                                                    <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Permisos</label>                               
                                    <div  class="row">
                                        <div class="col-lg-9">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="hidden" value="false" name="consul" id="PermisoConsul">
                                                    <input type="checkbox" value="true" name="consul" id="PermisoConsul">
                                                    Consultar
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="hidden" value="false" name="agre" id="PermisoAgre">
                                                    <input type="checkbox" value="true" name="agre" id="PermisoAgre">
                                                    Insertar
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="hidden" value="false" name="editar" id="PermisoConsul">
                                                    <input type="checkbox" value="true" name="editar" id="PermisoConsul">
                                                    Actualizar
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="hidden" value="false" name="borrar" id="PermisoAgre">
                                                    <input type="checkbox" value="true" name="borrar" id="PermisoAgre">
                                                    Borrar
                                                </label>
                                            </div>
                                        </div>                               
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer" style="border-top: 1px solid #e5e5e5;margin-left: -1.1em;margin-right: -1.1em;margin-top: 1.5em;;padding-top: 1em;padding-right: 1em;">
                                <button type="submit" class="btn btn-success">
                                    
                                    <i class="fa fa-floppy-o"></i> Registrar</button>
                                <button type="reset" data-dismiss="modal" class="btn btn-danger">
                                    <i class="fa fa-close"></i> Cerrar</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--fin-->
        <!--        editar permisos-->
        <div class="modal fade" id="editar"
             tabindex="-1" role="dialog"
             aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" id="detalles">
                    
                </div>
            </div>
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
    </div> 
    <!--fin-->
    <!--archivos js-->   
<?php require 'menu/js.ctp'; ?>


    <script>
        function editpag(datos) {
            var dat = datos.split("_");
            $.ajax({
                type: "GET",
                url: "/servitech_tesis/paginas_editar.php?vgrup="
                        + dat[0] + "&vpag=" + dat[1] 
                        + "&vgrunombre=" + dat[2]
                        + "&vpagina=" + dat[3],
                cache: false,
                beforeSend: function () {
                    $('#detalles').html('<img src="/servitech_tesis/img/ajax-loader.GIF">  <strong><i>Cargando...</i></strong>');
                },
                success: function (msg) {
                    $('#detalles').html(msg);
                }
            });
        }

        function borrar(datos) {
            var dat = datos.split("_");
            $('#si').attr('href', 'paginas_control.php?vgru=' + dat[0] +
                    '&vpag=' + dat[1] + '&vgrunombre=' + dat[2]
                    + '&consul=false&agre=false&editar=false&borrar=false'
                    + '&accion=3&pagina=paginas.php');
            $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Borrar el Permiso Para <i><strong>' + dat[3] + '</strong></i>?');
        }
    </script>

</body>
</html>
