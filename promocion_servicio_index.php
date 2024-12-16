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
<!--                        pregunta si ya llego la fecha fin-->
                        <?php    $promociones = consultas::get_datos("select cod_promocion from promocion where fcha_fin < current_date and estado <> 'ANULADO' AND cod_suc=".$_SESSION['cod_suc']); ?>
<!--                        si ya vencio la promocion cambia el estado de la promo a inactiva -->
                        <?php  if (!empty($promociones)){ ?>
                                
                        <?php foreach ($promociones as $key => $value) {
                                 $sql= "update promocion set estado = 'INACTIVO' where cod_promocion =".$value['cod_promocion']; 
                                 $res = consultas::get_datos($sql);
                             } ?>
                        
                        <?php }?>
                        
<!--                        pregunta si la fecha inicio ya empezo-->
                        
                         <?php    $promociones = consultas::get_datos("select cod_promocion from promocion where fcha_ini = current_date and estado <> 'ANULADO' AND cod_suc=".$_SESSION['cod_suc']); ?>
                        
                        <?php  if (!empty($promociones)){ ?>
                                
                        <?php foreach ($promociones as $key => $value) {
                                 $sql= "update promocion set estado = 'ACTIVO' where cod_promocion =".$value['cod_promocion'] ; 
                                 $res = consultas::get_datos($sql);
                             } ?>
                        
                        <?php }?>
                            
                            
                        
                        <h3 class="page-header">Listado - Promocion de Servicios
                            
                            <a href="promocion_servicio_agregar.php"
                               class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Registrar Promoción">
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
                                Datos de las Solicitudes
                            </div>
                            <?php
                            $promociones = consultas::get_datos("select * from v_promocion where cod_suc=".$_SESSION['cod_suc']. "
                             and suc_descri='".$_SESSION['suc_descri']. "' order by cod_promocion asc ");
                            if (!empty($promociones)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Descripcion</th>
                                                    <th class="text-center">Fecha Inicio</th>
                                                    <th class="text-center">Fecha Fin</th>
                                                    <th class="text-center">Usuario</th>
                                                    <th class="text-center">Sucursal</th>
                                                    <th class="text-center">Estado</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($promociones as $promocion) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $promocion['cod_promocion']; ?></td>
                                                        <td class="text-center"><?php echo $promocion['descri_promo']; ?></td>
                                                        <td class="text-center"><?php echo $promocion['vfecha_ini']; ?></td>
                                                        <td class="text-center"><?php echo $promocion['vfecha_fin']; ?></td>
                                                        <td class="text-center"><?php echo $promocion['usuario']; ?></td>
                                                        <td class="text-center"><?php echo $promocion['suc_descri']; ?></td>
                                                        <td class="text-center"><?php echo $promocion['estado']; ?></td>
                                                        
                                                        <td class="text-center">
                                                            
                                                            <?php if($promocion['estado']=='ACTIVO'){ ?>
                                                            
                                                            <a href="imprimir_promocion_servicio.php?codigo=<?php echo $promocion['cod_promocion']; ?>"
                                                                   target="_blank"
                                                                   class="btn btn-xs btn-primary"
                                                                   rel="tooltip" data-title="imprimir">
                                                                    <span class="glyphicon glyphicon-print"></span></a>
                                                                
                                                                <a  
                                                                    href="promocion_servicio_agregar.php?codigo=<?php echo $promocion['cod_promocion']; ?>"
                                                                class="btn btn-xs btn-info" rel='tooltip' data-title="Detalles" >
                                                                <span class="glyphicon glyphicon-tasks"></span></a>
                                                                
                                                                 <a onclick="anular(<?php echo "'".$promocion['cod_promocion']."_".
                                                                    $promocion['datos_promocion']."'"; ?>)"
                                                               class="btn btn-xs btn-danger" rel='tooltip' data-title="Anular Promocion"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-ban-circle"></span></a>
                                                                
                                                           <?php }else if($promocion['estado']=='ANULADO' || $promocion['estado']=='INACTIVO'){?>
                                                            
                                                               <a href="imprimir_promocion_servicio.php?codigo=<?php echo $promocion['cod_promocion']; ?>"
                                                                   target="_blank"
                                                                   class="btn btn-xs btn-primary"
                                                                   rel="tooltip" data-title="imprimir">
                                                                    <span class="glyphicon glyphicon-print"></span></a>
                                                                
                                                                <a  
                                                                    href="promocion_servicio_agregar.php?codigo=<?php echo $promocion['cod_promocion']; ?>"
                                                                class="btn btn-xs btn-info" rel='tooltip' data-title="Detalles" >
                                                                <span class="glyphicon glyphicon-tasks"></span></a>
                                                            <?php }else {?>
                                                           <a  
                                                               href="promocion_servicio_agregar.php?codigo=<?php echo $promocion['cod_promocion']; ?>"
                                                                class="btn btn-xs btn-info" rel='tooltip' data-title="Detalles" >
                                                                <span class="glyphicon glyphicon-tasks"></span></a>
                                                                
<!--                                                                <a onclick="confirmar(<?php echo "'".$promocion['cod_promocion']."_". $promocion['datos_promocion']."'"; ?>)"
                                                               class="btn btn-xs btn-success" rel='tooltip' data-title="Confirmar Registro Promocion"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-ok-sign"></span></a>-->
                                                                                                        
                                                                <a onclick="anular(<?php echo "'".$promocion['cod_promocion']."_".
                                                                    $promocion['datos_promocion']."'"; ?>)"
                                                               class="btn btn-xs btn-danger" rel='tooltip' data-title="Anular Promocion"
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
                , 'promocion_servicio_control.php?codigo=' + dat[0] +
                        '&vfecha_ini=1900-01-01'+
                        '&vfecha_fin=1900-01-01'+
                        '&vusu=null' +
                        '&vsuc=null' +
                        '&vdescri=null' +
                        '&vestado=ANULADO'+
                        '&accion=2'+
                        '&pagina=promocion_servicio_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Anular la Promocion <i><strong>' + dat[1] + '</strong></i>?');
            }
            
            function confirmar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href'
                , 'promocion_servicio_control.php?codigo=' + dat[0] + 
                        '&vfecha_ini=1900-01-01'+
                        '&vfecha_fin=1900-01-01'+
                        '&vusu=null' +
                        '&vsuc=null' +
                        '&vdescri=null' +
                        '&vestado=ACTIVO'+
                        '&accion=4'+
                        '&pagina=promocion_servicio_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Confirmar El Registro de la Promocion <i><strong>' + dat[1] + '</strong></i>?');
            }
        </script>
    </body>
</html>


