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
                        
                        <!--  pregunta si la fecha fin  ya vencio-->
                          <?php    $descuentoss = consultas::get_datos("select cod_desc_servi from descuento_servicio where fecha_fin < current_date AND estado <> 'ANULADO' AND cod_suc=".$_SESSION['cod_suc']); ?>

                        <?php  if (!empty($descuentoss)){ ?>
                                 <!-- si ya vencio la promocion cambia el estado de la promo a inactiva -->
                        <?php foreach ($descuentoss as $key => $value) {
                                 $sql= "update descuento_servicio set estado = 'INACTIVO' where cod_desc_servi =".$value['cod_desc_servi']; 
                                 $res = consultas::get_datos($sql);
                             } ?>
                        
                        <?php }?>
                        
<!--                        pregunta si la fecha inicio ya empezo-->
                        
                         <?php    $descuentosss = consultas::get_datos("select cod_desc_servi from descuento_servicio where fecha_ini = current_date and estado <> 'ANULADO' AND cod_suc=".$_SESSION['cod_suc']); ?>
                        
                        <?php  if (!empty($descuentosss)){ ?>
                                
                        <?php foreach ($descuentosss as $key => $value) {
                                 $sql= "update descuento_servicio set estado = 'ACTIVO' where cod_desc_servi =".$value['cod_desc_servi']; 
                                 $res = consultas::get_datos($sql);
                             } ?>
                        
                        <?php }?>
                        
                        <h3 class="page-header">Listado - Descuento de Servicios
                            
                            <a href="descuento_servicio_agregar.php"
                               class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Registrar Descuento">
                                <i class="glyphicon glyphicon-plus-sign"></i>
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
                                Datos de los Descuentos
                            </div>
                            <?php
                            $descuentos = consultas::get_datos("select * from v_descuento_servi where cod_suc=".$_SESSION['cod_suc']. "
                             and suc_descri='".$_SESSION['suc_descri']. "' order by cod_desc_servi asc ");
                            if (!empty($descuentos)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Fecha Inicio</th>
                                                    <th class="text-center">Fecha Fin</th>
                                                    <th class="text-center">Usuario</th>
                                                    <th class="text-center">Sucursal</th>
                                                    <th class="text-center">Estado</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($descuentos as $descuento) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $descuento['cod_desc_servi']; ?></td>
                                                        <td class="text-center"><?php echo $descuento['vfecha_ini']; ?></td>
                                                        <td class="text-center"><?php echo $descuento['vfecha_fin']; ?></td>
                                                        <td class="text-center"><?php echo $descuento['usuario']; ?></td>
                                                        <td class="text-center"><?php echo $descuento['suc_descri']; ?></td>
                                                        <td class="text-center"><?php echo $descuento['estado']; ?></td>
                                                        
                                                        <td class="text-center">
                                                            
                                                            <?php if($descuento['estado']=='ACTIVO'){ ?>
                                                            
                                                            <a href="imprimir_descuento_servicio.php?codigo=<?php echo $descuento['cod_desc_servi']; ?>"
                                                                   target="_blank"
                                                                   class="btn btn-xs btn-primary"
                                                                   rel="tooltip" data-title="imprimir">
                                                                    <span class="glyphicon glyphicon-print"></span></a>
                                                                
                                                                <a  
                                                                    href="descuento_servicio_agregar.php?codigo=<?php echo $descuento['cod_desc_servi']; ?>"
                                                                class="btn btn-xs btn-info" rel='tooltip' data-title="Detalles" >
                                                                <span class="glyphicon glyphicon-tasks"></span></a>
                                                                
                                                                <a onclick="anular(<?php echo "'".$descuento['cod_desc_servi']."_".
                                                                    $descuento['datos_descuentos']."'"; ?>)"
                                                               class="btn btn-xs btn-danger" rel='tooltip' data-title="Anular Descuento"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-ban-circle"></span></a>
                                                                
                                                           <?php }else if($descuento['estado']=='ANULADO' || $descuento['estado']=='INACTIVO'){?>
                                                                <a href="imprimir_descuento_servicio.php?codigo=<?php echo $descuento['cod_desc_servi']; ?>"
                                                                   target="_blank"
                                                                   class="btn btn-xs btn-primary"
                                                                   rel="tooltip" data-title="imprimir">
                                                                    <span class="glyphicon glyphicon-print"></span></a>
                                                                
                                                                <a  
                                                                    href="descuento_servicio_agregar.php?codigo=<?php echo $descuento['cod_desc_servi']; ?>"
                                                                class="btn btn-xs btn-info" rel='tooltip' data-title="Detalles" >
                                                                <span class="glyphicon glyphicon-tasks"></span></a>
                                                            <?php }else {?>
                                                           <a  
                                                               href="descuento_servicio_agregar.php?codigo=<?php echo $descuento['cod_desc_servi']; ?>"
                                                                class="btn btn-xs btn-info" rel='tooltip' data-title="Detalles" >
                                                                <span class="glyphicon glyphicon-tasks"></span></a>
                                                                
<!--                                                                <a onclick="confirmar(<?php echo "'".$descuento['cod_desc_servi']."_". $descuento['datos_descuentos']."'"; ?>)"
                                                               class="btn btn-xs btn-success" rel='tooltip' data-title="Confirmar Registro Promocion"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-ok-sign"></span></a>-->
                                                                                                        
                                                                <a onclick="anular(<?php echo "'".$descuento['cod_desc_servi']."_".
                                                                    $descuento['datos_descuentos']."'"; ?>)"
                                                               class="btn btn-xs btn-danger" rel='tooltip' data-title="Anular Descuento"
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
        </div>
            <!--archivos js-->  
            <?php require 'menu/js.ctp'; ?>

        <script>
            
            function anular(datos) {
                var dat = datos.split("_");
                $('#si').attr('href'
                , 'descuento_servicio_control.php?codigo=' + dat[0] +
                        '&vfecha_ini=1900-01-01'+
                        '&vfecha_fin=1900-01-01'+
                        '&vestado=ANULADO'+
                        '&vusu=null' +
                        '&vsuc=null' +
                        '&accion=2'+
                        '&pagina=descuento_servicio_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Anular el Descuento <i><strong>' + dat[1] + '</strong></i>?');
            }
            
            function confirmar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href'
                , 'descuento_servicio_control.php?codigo=' + dat[0] + 
                        '&vfecha_ini=1900-01-01'+
                        '&vfecha_fin=1900-01-01'+
                        '&vestado=ACTIVO'+
                        '&vusu=null' +
                        '&vsuc=null' +
                        '&accion=4'+
                        '&pagina=descuento_servicio_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Confirmar El Registro del Descuento <i><strong>' + dat[1] + '</strong></i>?');
            }
        </script>
    </body>
</html>


