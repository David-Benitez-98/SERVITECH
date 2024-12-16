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
        //require './anular_sesion.php'; #este es para bloquear la url
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
                        
                        <h3 class="page-header">Listado Insumos Utilizados
                            
                            <!--Llama al modal con el boton de cruz-->
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
                                Datos de Insumos
                            </div>
                            <?php
                            $insumosutilizados = consultas::get_datos("select * from v_insumos_utilizados where cod_suc=".$_SESSION['cod_suc']. "
                             and suc_descri='".$_SESSION['suc_descri']. "' order by cod_insumo_uti asc ");
                            if (!empty($insumosutilizados)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">#Orden</th>
                                                    <th class="text-center">Observacion</th>
                                                    <th class="text-center">Tecnico</th>
                                                    <th class="text-center">Sucursal</th>
                                                    <th class="text-center">Fecha</th>
                                                    <th class="text-center">Estado</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($insumosutilizados as $insumoutilizado) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $insumoutilizado['cod_insumo_uti']; ?></td>
                                                        <td class="text-center"><?php echo $insumoutilizado['cod_orden_trabajo']; ?></td>
                                                        <td class="text-center"><?php echo $insumoutilizado['observacion']; ?></td>
                                                        <td class="text-center"><?php echo $insumoutilizado['usuario']; ?></td>
                                                        <td class="text-center"><?php echo $insumoutilizado['suc_descri']; ?></td>
                                                        <td class="text-center"><?php echo $insumoutilizado['vfecha']; ?></td>
                                                        <td class="text-center"><?php echo $insumoutilizado['estado']; ?></td>
                                                        
                                                        <td class="text-center">
                                                            
                                                            <?php if($insumoutilizado['estado']=='TERMINADO' || $insumoutilizado['estado']=='CONFIRMADO'){ ?>
                                                            
                                                            <a href="imprimir_insumos_utilizados.php?vinsu_uti=<?php echo $insumoutilizado['cod_insumo_uti']; ?>"
                                                                   target="_blank"
                                                                   class="btn btn-xs btn-warning"
                                                                   rel="tooltip" data-title="imprimir">
                                                                    <span class="glyphicon glyphicon-print"></span></a>
                                                                
                                                                <a  
                                                                    href="insumo_servicio_agregar.php?vinsu_uti=<?php echo $insumoutilizado['cod_insumo_uti']; ?><?= "&vorden_trab=".$insumoutilizado['cod_orden_trabajo']?>"
                                                                class="btn btn-xs btn-info" rel='tooltip' data-title="Detalles" >
                                                                <span class="glyphicon glyphicon-tasks"></span></a>
                                                                
                                                           <?php }else if($insumoutilizado['estado']=='ANULADO'){?>
                                                                 <a href="imprimir_insumos_utilizados.php?vinsu_uti=<?php echo $insumoutilizado['cod_insumo_uti']; ?>"
                                                                   target="_blank"
                                                                   class="btn btn-xs btn-warning"
                                                                   rel="tooltip" data-title="imprimir">
                                                                    <span class="glyphicon glyphicon-print"></span></a>
                                                                
                                                                <a  
                                                                    href="insumo_servicio_agregar.php?vinsu_uti=<?php echo $insumoutilizado['cod_insumo_uti']; ?><?= "&vorden_trab=".$insumoutilizado['cod_orden_trabajo']?>"
                                                                class="btn btn-xs btn-info" rel='tooltip' data-title="Detalles" >
                                                                <span class="glyphicon glyphicon-tasks"></span></a>
                                                                
                                                                <?php }else {?>
                                                                <a  
                                                                    href="insumo_servicio_agregar.php?vinsu_uti=<?php echo $insumoutilizado['cod_insumo_uti']; ?><?= "&vorden_trab=".$insumoutilizado['cod_orden_trabajo']?>"
                                                                class="btn btn-xs btn-info" rel='tooltip' data-title="Detalles" >
                                                                <span class="glyphicon glyphicon-tasks"></span></a>
                                                                
                                                                                                        
                                                                <a onclick="anular(<?php echo "'".$insumoutilizado['cod_insumo_uti']."_". $insumoutilizado['cod_orden_trabajo']."_".
                                                                        $insumoutilizado['datos_insumos']."'"; ?>)"
                                                               class="btn btn-xs btn-danger" rel='tooltip' data-title="Anular Registro de Insumos"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-ban-circle"></span></a>
                                                            
                                                                <a onclick="confirmar(<?php echo "'".$insumoutilizado['cod_insumo_uti']."_". $insumoutilizado['cod_orden_trabajo']."_".
                                                                    $insumoutilizado['datos_insumos']."'"; ?>)"
                                                               class="btn btn-xs btn-success" rel='tooltip' data-title="Confirmar Registro Insumos"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-ok-sign"></span></a>

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
                               
                                <h4 class="modal-title text-center"><strong>Registrar Insumos Cabecera</strong></h4>
                            </div>
                            <form action="insumo_servicio_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body se">
                                    <input type="hidden" name="accion" id="accion" value="1">
                                    <input type="hidden" name="vinsu_uti" id="insumo_uti" value="0">
                                    <input type="hidden" name="vcod_usu" id="vcod_usu" value="<?php echo $_SESSION['cod_usu']; ?>">
                                    <input type="hidden" name="vsuc" id="vsuc" value="<?php echo $_SESSION['cod_suc']; ?>">
                                    <input type="hidden" name="pagina" value="insumo_servicio_agregar.php">
                                    
                                <!--Inicio campos Presupuesto-->
                                
                                <!-- Grupo de la primera fila-->
                                    <!--desde aqui-->
                                    <!-- Campo fecha-->
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Fecha:</label>
                                        <div class="col-md-4">
                                            <input type="date" required="" id="vfecha" 
                                                   placeholder="Especifique fecha"
                                                   class="form-control"
                                                   name="vfecha" 
                                                   readonly=""
                                                   value="<?php echo date("Y-m-d") ?>"
                                       </div>
                                    </div>
                                    </div>
                            
                           <br>
                            
                            <div class="form-group">
                                
                                <label class="col-md-2 control-label">Sucursal:</label>
                                        <div class="col-md-4">
                                            <input type="text" required="" placeholder="Ingrese Sucursal" readonly="" 
                                                   class="form-control" value="<?php echo $_SESSION['suc_descri']; ?>">
                                        </div>
                                
                            </div>
                           <br>
                            
                                <div class="form-group">
<!--                                        Campo Recepcion-->
                                <label class="col-md-2 control-label">Orden Trabajo:</label>
                                <div class="col-md-9">
                                    <?php $ordentrabajos = consultas::get_datos("select * from v_orden_trabajo where estado='CONFIRMADO' order by cod_orden_trabajo asc"); ?>
                                    <select name="vorden_trab" 
                                            class="form-control" id="orden_trab">
<!--                                        <option value="">Seleccione una Recepcion</option>-->
                                        <?php
                                        if (!empty($ordentrabajos)) {
                                            foreach ($ordentrabajos as $ordentrabajo) {
                                                ?>  
                                                <option value="<?php echo $ordentrabajo['cod_orden_trabajo']; ?>">
                                                    <?php echo $ordentrabajo['datos_orden']; ?>
                                                </option>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <option value="">Debe insertar una Orden</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                
                            </div>
                             <br>
                                
                                        
                                        
                                    </div>
                                
                                    
                                <!--Fin Campos-->  
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
                , 'insumo_servicio_control.php?vinsu_uti=' + dat[0] +
                        '&vorden_trab='+ dat[1] +
                        '&vcod_usu=null'   +
                        '&vsuc=null' +
                        '&vestado=ANULADO'+
                        '&vfecha=1900-01-01'+
                        '&accion=2'+
                        '&pagina=insumo_servicio_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Anular el Registro del Insumo: <i><strong>' + dat[2] + '</strong></i>?');
            }
            
                 function confirmar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href'
                , 'insumo_servicio_control.php?vinsu_uti=' + dat[0] +
                        '&vorden_trab='+ dat[1] +
                        '&vcli=null'+
                        '&vcod_usu=null'   +
                        '&vsuc=null' +
                        '&vestado=CONFIRMADO'+
                        '&vfecha=1900-01-01'+
                        '&accion=4'+
                        '&pagina=insumo_servicio_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Confirmar el Registro del Insumo: <i><strong>' + dat[2] + '</strong></i>?');
            }
            
            $("document").ready(function () {
                    cliente();
                });
            
//            function cliente(){
//                    if ((parseInt($('#presu_servi').val()) > 0) || ($('#presu_servi').val() !== "")) {
//                        $.ajax({
//                            type: "GET",
//                            url: "/servitech_tesis/lista_cliente_presupuesto_serv.php?vpresu_servi=" + 
//                                    $('#presu_servi').val (),
//                            cache: false,
//                            beforeSend: function () {
//                                $('#deta_cliente').
//                            html('<img src="/servitech_tesis/img/cargando.GIF">\n\
//                            <strong><i>Cargando...</i><strong>');
//                            },
//                                    success: function (msg){
//                                        $('#deta_cliente').html(msg);
////                                        obtenerprecio();
//                                    }
//                        });
//                    }
//                }
                
//                function validar_vigen() { //valida la fechas de vigencia
//                var hoy = new Date($('#vfecha_ini').val());
//                var fechaFormulario = new Date($('#vfecha_fin').val());
//                if (fechaFormulario < hoy) {
//                    alert('El numero de timbrado Hasta debe ser mayor a Desde!!!');
//                    
//                    $('#vfecha_fin').val(fechaFormulario);
//                }
//                else {
////                    $("#ocultar").css("display", "block");
//                }
//            }
            
//            function validar() {
//                var hoy = new Date();
//                var fechaFormulario = new Date($('#vfecha_fin').val());
//                if (fechaFormulario < hoy) {
//                    alert (fechaFormulario);
//                    alert('La Fecha Fin debe ser Mayor a la actual!!!');
//                    $('#vfecha_fin').val(hoy);
//                    $('#vfecha_fin').val(hoy);
//                }
//                else {
////                    $("#ocultar").css("display", "block");
//                }
//            } 
        </script>
    </body>
</html>




