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
                        <h3 class="page-header text-center">Listado de Sucursales
                            
                            <a href="imprimir_sucursal.php" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Imprimir" target="_blank">
                                <i class="fa fa-print"></i>
                            </a> 
                            <a data-toggle="modal" data-target="#registrar" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Registrar Sucursales">
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
                                Datos Sucursales
                            </div>
                            <?php
                            $sucursales = consultas::get_datos("select * from v_sucursal
                                         order by cod_suc asc ");
                            if (!empty($sucursales)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"># Emp</th>
                                                    <th class="text-center"># Suc</th>
                                                    <th class="text-center">Suc. Razon</th>  
                                                    <th class="text-center">Ruc</th>  
                                                    <th class="text-center">Departamento</th>  
                                                    <th class="text-center">Ciudad</th> 
                                                    <th class="text-center">Dirección</th> 
                                                    <th class="text-center">Telf.</th> 
                                                    <th class="text-center">Estado</th> 
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($sucursales as $sucursal) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $sucursal['cod_emp']; ?></td>
                                                        <td class="text-center"><?php echo $sucursal['cod_suc']; ?></td>
                                                        <td class="text-center"><?php echo $sucursal['suc_descri']; ?></td>
                                                        <td class="text-center"><?php echo $sucursal['emp_ruc']; ?></td>
                                                        <td class="text-center"><?php echo $sucursal['dep_descri']; ?></td>
                                                        <td class="text-center"><?php echo $sucursal['ciu_des']; ?></td>
                                                        <td class="text-center"><?php echo $sucursal['suc_direc']; ?></td>
                                                        <td class="text-center"><?php echo $sucursal['suc_telf']; ?></td>
                                                        <td class="text-center"><?php echo $sucursal['suc_estado']; ?></td>
                                                        <td class="text-center">
                                                            <a onclick="editar(<?php echo "'" . $sucursal['cod_suc'] . "_" .
                                                                    $sucursal['cod_emp'] . "_" .
                                                                    $sucursal['suc_descri'] . "_" .
                                                                    $sucursal['cod_ciu'] . "_" .
                                                                    $sucursal['cod_depar'] . "_" .
                                                                    $sucursal['suc_telf'] . "_" .
                                                                    $sucursal['suc_direc'] . "_" .
                                                                    $sucursal['suc_estado'] . "'"; ?>)" 
                                                               class="btn btn-xs btn-info" rel='tooltip' data-title="Editar Sucursal" 
                                                               data-toggle="modal" data-target="#editar">
                                                                <span class="glyphicon glyphicon-pencil"></span></a>
                                                                  
                                                                <?php if ($sucursal['suc_estado'] == 'ACTIVO') { ?>       
                                                            <a onclick="desactivar(<?php echo "'" . $sucursal['cod_suc'] . "_" .
                                                                    $sucursal['cod_emp'] . "_" . 
                                                                    $sucursal['suc_descri'] . "_" . 
                                                                    $sucursal['cod_ciu'] . "_" . 
                                                                    $sucursal['cod_depar'] . "_" . 
                                                                    $sucursal['suc_telf'] . "_" . 
                                                                    $sucursal['suc_direc'] . "_" . 
                                                                    $sucursal['suc_estado']. "'"; ?>)" 
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
                                <h4 class="modal-title"><strong>Registrar Sucursal</strong></h4>
                            </div>
                            <form action="sucursal_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body se">
                                    <input type="hidden" name="accion"  value="1">
                                    <input type="hidden" name="vsuc" value="0"/> 
                                    <input type="hidden" name="pagina" value="sucursal_index.php">

                                   
                                <!--Inicio Empresa-->
                                    <div class="form-group">
                                    <label class="col-lg-3 control-label">Empresa:</label>
                                    <div class="col-lg-2">
                                        <?php
                                        $empresas = consultas::get_datos("select * from empresa "
                                                        . " order by cod_emp");
                                        ?>                                 
                                        <select name="vemp" class="form-control select"  style="width: 180%">
                                            <?php
                                            if (!empty($empresas)) {
                                                foreach ($empresas as $empresa) {
                                                    ?>
                                                    <option value="<?php echo $empresa['cod_emp']; ?>">
                                                        <?php echo $empresa['emp_nom']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar una Persona</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                 <!--Fin empresa-->
                                 
                                 <!-- INICIO Sucursal DESCRI-->
                                    <div class="form-group">
                                    <label class="col-lg-3 control-label">Suc. Nombre:</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="vdescri" id="nom" 
                                               required="" 
                                               placeholder="Ingrese Razon Social de la Sucursal"
                                               
                                               onkeyup="reemplazar()"
                                               onchange="reemplazar()"
                                               autofocus="">
                                    </div>
                                    </div>
                                 <br>
<!--                                Fin Sucursal DESCRI-->
                                    <!-- INICIO telefono-->
                                    <div class="form-group">
                                    <label class="col-md-3 control-label">Suc. Telf:</label>
                                    <div class="col-md-4">
                                        <input type="tel" id="tel"
                                               placeholder="Ingrese Telefono de la Sucursal" 
                                               class="form-control" name="vtelf"
                                               onkeyup="nronegativotel()"
                                               onchange="nronegativotel()"
                                               autofocus="">
                                    </div>
                                </div>
                                    <br>
<!--                                Fin Sucursal telefono-->
                                    <!-- INICIO direccion-->
                                    <div class="form-group">
                                    <label class="col-lg-3 control-label">Suc. Direccion:</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="vdirec" id="nom" 
                                               required="" 
                                               placeholder="Ingrese Direccion de la Sucursal"
                                               autofocus="">
                                    </div>
                                    </div>
                                    <br>
<!--                                Fin Sucursal direccion-->
                                 <!--Inicio Ciudad-->
                                    <div class="form-group">
                                    <label class="col-lg-3 control-label">Ciudad:</label>
                                    <?php $ciudades = consultas::get_datos("select * from ciudad order by cod_ciu"); ?>
                                    <div class="col-lg-4">
                                        <select name="vciu" class="form-control select" >
                                            <?php
                                            if (!empty($ciudades)) {
                                                foreach ($ciudades as $ciudad) {
                                                    ?>
                                                    <option value="<?php echo $ciudad['cod_ciu']; ?>">
                                                        <?php echo $ciudad['ciu_des']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar una ciudad</option>
                                            <?php } ?>    
                                        </select>
                                    </div>
                                </div>
                                 <br>
                                 <!--Fin Ciudad-->
                                 
<!--                                 Inicio Departamento-->
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">Departamento:</label>
                                    <div class="col-lg-4">
                                        <?php
                                        $departamentos = consultas::get_datos("select * from departamento "
                                                        . " order by cod_depar");
                                        ?>                                 
                                        <select name="vdepar" class="form-control select">
                                            <?php
                                            if (!empty($departamentos)) {
                                                foreach ($departamentos as $departamento) {
                                                    ?>
                                                    <option value="<?php echo $departamento['cod_depar']; ?>">
                                                        <?php echo $departamento['dep_descri']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar un departamento</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <br>
<!--                                 Fin Departamento-->
                                
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
                            <h4 class="modal-title"><strong>Editar Sucursal</strong></h4>
                        </div>
                        <form action="sucursal_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                            <div class="panel-body">
                                <input name="accion" value="2" type="hidden"/>
                                <input type="hidden" name="pagina" value="sucursal_index.php">
                                <input id="cod" type="hidden" name="vsuc"/>
                                <input id="estado" type="hidden" name="vestado" value="ACTIVO"/>
                                
                                 <!--Inicio Empresa-->
                                    <div class="form-group">
                                    <label class="col-lg-3 control-label">Empresa:</label>
                                    <div class="col-lg-2">
                                        <?php
                                        $empresas = consultas::get_datos("select * from empresa "
                                                        . " order by cod_emp");
                                        ?>                                 
                                        <select id="empresa" name="vemp" class="form-control select"  style="width: 180%">
                                            <?php
                                            if (!empty($empresas)) {
                                                foreach ($empresas as $empresa) {
                                                    ?>
                                                    <option value="<?php echo $empresa['cod_emp']; ?>">
                                                        <?php echo $empresa['emp_nom']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar una Persona</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                 <!--Fin empresa-->

                                <!-- INICIO Sucursal DESCRI-->
                                    <div class="form-group">
                                    <label class="col-lg-3 control-label">Suc. Nombre:</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="vdescri" id="razon" 
                                               required="" 
                                               placeholder="Ingrese Razon Social de la Sucursal"
                                               onkeyup="reemplazar()"
                                               onchange="reemplazar()"
                                               value="<?php echo $sucursales[0]['suc_descri']; ?>"
                                               autofocus="">
                                    </div>
                                    </div>
                                 <br>
<!--                                Fin Sucursal DESCRI-->
                                    <!-- INICIO telefono-->
                                    <div class="form-group">
                                    <label class="col-md-3 control-label">Suc. Telf:</label>
                                    <div class="col-md-4">
                                        <input type="tel" id="telefono"
                                               placeholder="Ingrese Telefono de la Sucursal" 
                                               class="form-control" name="vtelf"
                                               onkeyup="nronegativotel()"
                                               onchange="nronegativotel()"
                                                value="<?php echo $sucursales[0]['suc_telf']; ?>"
                                               autofocus="">
                                    </div>
                                </div>
                                    <br>
<!--                                Fin Sucursal telefono-->
                                    <!-- INICIO direccion-->
                                    <div class="form-group">
                                    <label class="col-lg-3 control-label">Suc. Direccion:</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="vdirec" id="direccion" 
                                               required="" 
                                               placeholder="Ingrese Direccion de la Sucursal"
                                               value="<?php echo $sucursales[0]['suc_direc']; ?>"
                                               autofocus="">
                                    </div>
                                    </div>
                                    <br>
<!--                                Fin Sucursal direccion-->
                                 <!--Inicio Ciudad-->
                                    <div class="form-group">
                                    <label class="col-lg-3 control-label">Ciudad:</label>
                                    <?php $ciudades = consultas::get_datos("select * from ciudad order by cod_ciu"); ?>
                                    <div class="col-lg-4">
                                        <select id="ciudad" name="vciu" class="form-control select" >
                                            <?php
                                            if (!empty($ciudades)) {
                                                foreach ($ciudades as $ciudad) {
                                                    ?>
                                                    <option value="<?php echo $ciudad['cod_ciu']; ?>">
                                                        <?php echo $ciudad['ciu_des']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar una ciudad</option>
                                            <?php } ?>    
                                        </select>
                                    </div>
                                </div>
                                 <br>
                                 <!--Fin Ciudad-->
                                 
<!--                                 Inicio Departamento-->
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">Departamento:</label>
                                    <div class="col-lg-4">
                                        <?php
                                        $departamentos = consultas::get_datos("select * from departamento "
                                                        . " order by cod_depar");
                                        ?>                                 
                                        <select id="departamento" name="vdepar" class="form-control select">
                                            <?php
                                            if (!empty($departamentos)) {
                                                foreach ($departamentos as $departamento) {
                                                    ?>
                                                    <option value="<?php echo $departamento['cod_depar']; ?>">
                                                        <?php echo $departamento['dep_descri']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar un departamento</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <br>
<!--                                 Fin Departamento-->
                                
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
                $('#empresa').val(dat[1]);
                $('#razon').val(dat[2]);
                $('#ciudad').val(dat[3]);
                $('#departamento').val(dat[4]);
                $('#telefono').val(dat[5]);
                $('#direccion').val(dat[6]);
            }
            
            function desactivar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href', 'sucursal_control.php?vsuc=' + dat[0] +
                        '&vemp=null' +
                        '&vdescri=null' +
                        '&vciu=null' +
                        '&vdepar=null' +
                        '&vtelf=null' +
                        '&vdirec=null' +
                        '&vestado=INACTIVO' +
                        '&accion=4&pagina=sucursal_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-ban-circle"></span>\n\
            Desea Inactivar la Sucursal <i><strong>' + dat[2] + '</strong></i>?');
            }
            
            //para reemplazar comilla simple
            function reemplazar(){
//                   alert($('#apel').val());
                var valor=document.getElementById('nom').value.replace("'","");
                document.getElementById('nom').value=valor;
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

