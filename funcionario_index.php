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
                        <h3 class="page-header text-center">Listado de Funcionarios
                            <a href="personas_agregar_fun.php" 
                               class="btn btn-info btn-circle pull-left" 
                               rel="tooltip" data-title="Registrar Personas">
                                <i class="fa fa-plus-square"></i>
                            </a>
<!--                            <a href="imprimir_tipoimpuesto.php" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Imprimir" target="_blank">
                                <i class="fa fa-print"></i>
                            </a> -->
                            <a data-toggle="modal" data-target="#registrar" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Registrar Funcionario">
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
                            $funcionarios = consultas::get_datos("select * from v_funcionario
                                         order by cod_fun asc ");
                            if (!empty($funcionarios)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Funcionario</th>  
                                                    <th class="text-center">Ci</th>  
                                                    <th class="text-center">Cargo</th>  
                                                    <th class="text-center">Ciudad</th> 
                                                    <th class="text-center">Dirección</th> 
                                                    <th class="text-center">Sucursal</th> 
                                                    <th class="text-center">Telf.</th> 
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($funcionarios as $funcionario) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $funcionario['cod_fun']; ?></td>
                                                        <td class="text-center"><?php echo $funcionario['persona']; ?></td>
                                                        <td class="text-center"><?php echo $funcionario['per_ci_ruc']; ?></td>
                                                        <td class="text-center"><?php echo $funcionario['carg_des']; ?></td>
                                                        <td class="text-center"><?php echo $funcionario['ciu_des']; ?></td>
                                                        <td class="text-center"><?php echo $funcionario['per_direc']; ?></td>
                                                        <td class="text-center"><?php echo $funcionario['suc_descri']; ?></td>
                                                        <td class="text-center"><?php echo $funcionario['per_telf']; ?></td>
                                                        <td class="text-center">
                                                            <a onclick="editar(<?php echo "'" . $funcionario['cod_fun'] . "_" .
                                                                    $funcionario['cod_per'] . "_" .
                                                                    $funcionario['cod_carg'] . "_" .
                                                                    $funcionario['cod_suc'] . "'"; ?>)" 
                                                               class="btn btn-xs btn-info" rel='tooltip' data-title="Editar Funcionario" 
                                                               data-toggle="modal" data-target="#editar">
                                                                <span class="glyphicon glyphicon-pencil"></span></a>
                                                                
                                                            <a href="personas_editar_fun.php?vper=<?= $funcionario['cod_per'] ?>"
                                                                       class="btn btn-xs btn-success" rel='tooltip' data-title="Actualizar Datos Persona" >
                                                                        <span class="glyphicon glyphicon-pencil"></span></a>
                                                                        
                                                            <a onclick="borrar(<?php echo "'" . $funcionario['cod_fun'] . "_" . 
                                                                    $funcionario['cod_per'] . "_" . 
                                                                    $funcionario['cod_carg'] . "_" . 
                                                                    $funcionario['cod_suc'] . "_" . 
                                                                    $funcionario['persona']. "'"; ?>)" 
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
                    <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" 
                                        data-dismiss="modal" arial-label="Close">x</button>
                                <h4 class="modal-title"><strong>Registrar Funcionario</strong></h4>
                            </div>
                            <form action="funcionario_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body se">
                                    <input type="hidden" name="accion"  value="1">
                                    <input type="hidden" name="vfun" value="0"/> 
                                    <input type="hidden" name="pagina" value="funcionario_index.php">

                                   
                                <!--Inicio Personas-->
                                    <div class="form-group">
                                    <label class="col-md-3 control-label">Datos Personas:</label>
                                    <div class="col-md-4">
                                        <?php
                                        $personas = consultas::get_datos("select * from v_personas order by cod_per");
                                        ?>                                 
                                        <select class="form-control" name="vper" style="width: 180%">
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
                                                <option value="0">Debe insertar una Persona</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                 <!--Fin Personas-->
                                 <!--Inicio Cargos-->
                                    <div class="form-group">
                                    <label class="col-md-3 control-label">Cargos:</label>
                                    <div class="col-md-4">
                                        <?php
                                        $cargos = consultas::get_datos("select * from cargo "
                                                        . " order by cod_carg");
                                        ?>                                 
                                        <select name="vcarg" class="form-control select"  style="width: 180%">
                                            <?php
                                            if (!empty($cargos)) {
                                                foreach ($cargos as $cargo) {
                                                    ?>
                                                    <option value="<?php echo $cargo['cod_carg']; ?>">
                                                        <?php echo $cargo['carg_des']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar un Cargo</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                 <!--Fin Cargos-->
                                 
<!--                                 Inicio Sucursal-->
                                 <div class="form-group">
                                        <label class="col-md-3 control-label">Sucursal</label>
                                        <div class="col-md-4">
                                            <?php $sucursales = consultas::get_datos("select * from v_sucursal where cod_suc=".$_SESSION['cod_suc']. " order by cod_suc"); ?>
                                            <select name="vsuc" class="form-control">
                                                <?php
                                                if (!empty($sucursales)) {
                                                    foreach ($sucursales as $sucursal) {
                                                        ?>
                                                        <option value="<?php echo $sucursal['cod_suc']; ?>">
                                                            <?php echo $sucursal['suc_descri']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="0">Debe ingresar una Sucursal</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
<!--                                 Fin sucursal-->
                                
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
                            <h4 class="modal-title"><strong>Editar Funcionario</strong></h4>
                        </div>
                        <form action="funcionario_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                            <div class="panel-body">
                                <input name="accion" value="2" type="hidden"/>
                                <input type="hidden" name="pagina" value="funcionario_index.php">
                                <input id="cod" type="hidden" name="vfun"/>
                                
                                 <!--Inicio personas-->
                                    <div class="form-group">
                                    <label class="col-md-3 control-label">Datos Personas:</label>
                                    <div class="col-md-4">
                                        <?php
                                        $personas = consultas::get_datos("select * from v_personas "
                                                        . " order by datos_persona");
                                        ?>                                 
                                        <select id="persona" name="vper" class="form-control"  style="width: 180%">
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
                                                <option value="0">Debe insertar una Persona</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
<!--                                 fin personas-->

                                <!--Inicio cargos-->
                                    <div class="form-group">
                                    <label class="col-md-3 control-label">Cargos:</label>
                                    <div class="col-md-4">
                                        <?php
                                        $cargos = consultas::get_datos("select * from cargo "
                                                        . " order by cod_carg");
                                        ?>                                 
                                        <select id="cargo" name="vcarg" class="form-control"  style="width: 180%">
                                            <?php
                                            if (!empty($cargos)) {
                                                foreach ($cargos as $cargo) {
                                                    ?>
                                                    <option value="<?php echo $cargo['cod_carg']; ?>">
                                                        <?php echo $cargo['carg_des']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar un Cargo</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
<!--                                 fin cargos-->
                                <!-- Inicio Sucursal-->
                                 <div class="form-group">
                                        <label class="col-md-3 control-label">Sucursal</label>
                                        <div class="col-md-4">
                                            <?php $sucursales = consultas::get_datos("select * from v_sucursal order by cod_suc"); ?>
                                            <select id="suc" name="vsuc" class="form-control">
                                                <?php
                                                if (!empty($sucursales)) {
                                                    foreach ($sucursales as $sucursal) {
                                                        ?>
                                                        <option value="<?php echo $sucursal['cod_suc']; ?>">
                                                            <?php echo $sucursal['suc_descri']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="0">Debe ingresar una Sucursal</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
<!--                                 Fin sucursal-->
  
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
                $('#persona').val(dat[1]);
                $('#cargo').val(dat[2]);
                $('#suc').val(dat[3]);
            }

            function borrar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href', 'funcionario_control.php?vfun=' + dat[0] + '&vper=' + dat[1]
                        + '&vcarg=' + dat[2] + '&vsuc=' + dat[3]
                        + '&accion=3&pagina=funcionario_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Borrar el Funcionario <i><strong>' + dat[4] + '</strong></i>?');
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

