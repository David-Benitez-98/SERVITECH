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
                        
                        <h3 class="page-header">Listado Ordenes de Trabajo
                            
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
                                Datos de Ordenes
                            </div>
                            <?php
                            $ordentrabajos = consultas::get_datos("select * from v_orden_trabajo where cod_suc=".$_SESSION['cod_suc']. "
                             and suc_descri='".$_SESSION['suc_descri']. "' order by cod_orden_trabajo asc ");
                            if (!empty($ordentrabajos)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">#Presu</th>
                                                    <th class="text-center">Observacion</th>
                                                    <th class="text-center">Cliente</th>
                                                    <th class="text-center">Funcionario</th>
                                                    <th class="text-center">Sucursal</th>
                                                    <th class="text-center">Fecha Ini</th>
                                                    <th class="text-center">Fecha Fin</th>
                                                    <th class="text-center">Estado</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($ordentrabajos as $ordentrabajo) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $ordentrabajo['cod_orden_trabajo']; ?></td>
                                                        <td class="text-center"><?php echo $ordentrabajo['cod_presu_servi']; ?></td>
                                                        <td class="text-center"><?php echo $ordentrabajo['observacion']; ?></td>
                                                        <td class="text-center"><?php echo $ordentrabajo['cliente']; ?></td>
                                                        <td class="text-center"><?php echo $ordentrabajo['usuario']; ?></td>
                                                        <td class="text-center"><?php echo $ordentrabajo['suc_descri']; ?></td>
                                                        <td class="text-center"><?php echo $ordentrabajo['vfecha_ini']; ?></td>
                                                        <td class="text-center"><?php echo $ordentrabajo['vfecha_fin']; ?></td>
                                                        <td class="text-center"><?php echo $ordentrabajo['estado']; ?></td>
                                                        
                                                        <td class="text-center">
                                                            
                                                            <?php if($ordentrabajo['estado']=='TERMINADO' || $ordentrabajo['estado']=='CONFIRMADO' || $ordentrabajo['estado']=='EN INSUMO'){ ?>
                                                            
                                                            <a href="imprimir_orden_trabajo.php?vorden_trab=<?php echo $ordentrabajo['cod_orden_trabajo']; ?>"
                                                                   target="_blank"
                                                                   class="btn btn-xs btn-warning"
                                                                   rel="tooltip" data-title="imprimir">
                                                                    <span class="glyphicon glyphicon-print"></span></a>
                                                                
                                                                <a  
                                                                    href="orden_trabajo_serv_agregar.php?vorden_trab=<?php echo $ordentrabajo['cod_orden_trabajo']; ?><?= "&vpresu_servi=".$ordentrabajo['cod_presu_servi']?>"
                                                                class="btn btn-xs btn-info" rel='tooltip' data-title="Detalles" >
                                                                <span class="glyphicon glyphicon-tasks"></span></a>
                                                                
                                                           <?php }else if($ordentrabajo['estado']=='ANULADO'){?>
                                                                <a href="imprimir_orden_trabajo.php?vorden_trab=<?php echo $ordentrabajo['cod_orden_trabajo']; ?>"
                                                                   target="_blank"
                                                                   class="btn btn-xs btn-warning"
                                                                   rel="tooltip" data-title="imprimir">
                                                                    <span class="glyphicon glyphicon-print"></span></a>
                                                                
                                                                <a  
                                                                    href="orden_trabajo_serv_agregar.php?vorden_trab=<?php echo $ordentrabajo['cod_orden_trabajo']; ?><?= "&vpresu_servi=".$ordentrabajo['cod_presu_servi']?>"
                                                                class="btn btn-xs btn-info" rel='tooltip' data-title="Detalles" >
                                                                <span class="glyphicon glyphicon-tasks"></span></a>
                                                                
                                                                <?php }else {?>
                                                                <a  
                                                                    href="orden_trabajo_serv_agregar.php?vorden_trab=<?php echo $ordentrabajo['cod_orden_trabajo']; ?><?= "&vpresu_servi=".$ordentrabajo['cod_presu_servi']?>"
                                                                class="btn btn-xs btn-info" rel='tooltip' data-title="Detalles" >
                                                                <span class="glyphicon glyphicon-tasks"></span></a>
                                                                
                                                                                                        
                                                                <a onclick="anular(<?php echo "'".$ordentrabajo['cod_orden_trabajo']."_". $ordentrabajo['vfecha_ini']."_".$ordentrabajo['cod_presu_servi']."_".
                                                                    $ordentrabajo['cliente']."'"; ?>)"
                                                               class="btn btn-xs btn-danger" rel='tooltip' data-title="Anular Presupuesto"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-ban-circle"></span></a>
                                                            
                                                                <a onclick="confirmar(<?php echo "'".$ordentrabajo['cod_orden_trabajo']."_". $ordentrabajo['vfecha_fin']."_".
                                                                    $ordentrabajo['cliente']."_". $ordentrabajo['cod_presu_servi']."'"; ?>)"
                                                               class="btn btn-xs btn-success" rel='tooltip' data-title="Confirmar Trabajo Terminado"
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
                               
                                <h4 class="modal-title text-center"><strong>Registrar Orden Trabajo</strong></h4>
                            </div>
                            <form action="orden_trabajo_serv_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body se">
                                    <input type="hidden" name="accion" id="accion" value="1">
                                    <input type="hidden" name="vorden_trab" id="orden_trab" value="0">
                                    <input type="hidden" name="vestado" id="vestado" value="PENDIENTE">
                                    <input type="hidden" name="vcod_usu" id="vcod_usu" value="<?php echo $_SESSION['cod_usu']; ?>">
                                    <input type="hidden" name="vsuc" id="vsuc" value="<?php echo $_SESSION['cod_suc']; ?>">
                                    <input type="hidden" name="pagina" value="orden_trabajo_serv_agregar.php">
                                    
                                <!--Inicio campos Presupuesto-->
                                
                                <!-- Grupo de la primera fila-->
                                    <!--desde aqui-->
                                    <!-- Campo fecha-->
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Fecha Ini:</label>
                                        <div class="col-md-4">
                                            <input type="date" required="" id="vfecha_ini" 
                                                   placeholder="Especifique fecha"
                                                   class="form-control"
                                                   name="vfecha_ini" 
                                                   readonly=""
                                                   onblur="validar_vigen()"
                                                   value="<?php echo date("Y-m-d") ?>"
                                       </div>
                                    </div>
<!--                                    <span class="col-md-1"></span>-->
                                        <!-- Campo Sucursal-->
                                        
                                        <label class="col-md-2 control-label">Fecha Fin:</label>
                                        <div class="col-md-4">
                                            <input type="date" required="" id="vfecha_fin"
                                                   placeholder="Especifique fecha"
                                                   class="form-control"
                                                   name="vfecha_fin" 
                                                   onblur="validar_vigen(); validar(); "
                                                   value="<?php echo date("Y-m-d") ?>"
                                       </div>
                                    </div>

                                        
                                        
                                    </div>
                            <!-- Campo Proveedor-->
                            
                            <br>
                            
                                <div class="form-group">
<!--                                        Campo Recepcion-->
                                <label class="col-md-2 control-label">Presupuesto:</label>
                                <div class="col-md-7">
                                    <?php $presupuestoservicios = consultas::get_datos("select * from v_presupuesto_servi where estado='CONFIRMADO' order by cod_presu_servi asc"); ?>
                                    <select name="vpresu_servi" 
                                            class="form-control" id="presu_servi" 
                                            onchange="cliente()"
                                            onkeyup="cliente()">
<!--                                        <option value="">Seleccione una Recepcion</option>-->
                                        <?php
                                        if (!empty($presupuestoservicios)) {
                                            foreach ($presupuestoservicios as $presupuestoservicio) {
                                                ?>  
                                                <option value="<?php echo $presupuestoservicio['cod_presu_servi']; ?>">
                                                    <?php echo $presupuestoservicio['datos_presupuesto']; ?>
                                                </option>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <option value="">Debe insertar un Presupuesto</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                
                            </div>
                            
                           <br>
                            
                            <div class="form-group">
                                
                                <label class="col-md-2 control-label">Cliente:</label>
                                <div class="col-md-4" id="deta_cliente">
                                    <select class="form-control" required="">
                                        <option>Seleccione un Cliente</option>
                                    </select>
                                </div>
                                
                                <label class="col-md-2 control-label">Sucursal:</label>
                                        <div class="col-md-4">
                                            <input type="text" required="" placeholder="Ingrese Sucursal" readonly="" 
                                                   class="form-control" value="<?php echo $_SESSION['suc_descri']; ?>">
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
                , 'orden_trabajo_serv_control.php?vorden_trab=' + dat[0] +
                        '&vpresu_servi='+ dat[2] +
                        '&vcli=null'+
                        '&vcod_usu=null'   +
                        '&vsuc=null' +
                        '&vestado=ANULADO'+
                        '&vfecha_ini=1900-01-01'+
                        '&vfecha_fin=1900-01-01'+
                        '&accion=2'+
                        '&pagina=orden_trabajo_serv_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Anular la Orden de Trabajo  para el Cliente: <i><strong>' + dat[3] + ' en la fecha: ' + dat[1] + '</strong></i>?');
            }
            
                 function confirmar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href'
                , 'orden_trabajo_serv_control.php?vorden_trab=' + dat[0] +
                        '&vpresu_servi='+ dat[3] +
                        '&vcli=null'+
                        '&vcod_usu=null'   +
                        '&vsuc=null' +
                        '&vestado=CONFIRMADO'+
                        '&vfecha_ini=1900-01-01'+
                        '&vfecha_fin=1900-01-01'+
                        '&accion=4'+
                        '&pagina=orden_trabajo_serv_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Confirmar la Orden de Trabajo  para el Cliente: <i><strong>' + dat[2] + '- culminado en la fecha: ' + dat[1] + '</strong></i>?');
            }
            
            $("document").ready(function () {
                    cliente();
                });
            
            function cliente(){
                    if ((parseInt($('#presu_servi').val()) > 0) || ($('#presu_servi').val() !== "")) {
                        $.ajax({
                            type: "GET",
                            url: "/servitech_tesis/lista_cliente_presupuesto_serv.php?vpresu_servi=" + 
                                    $('#presu_servi').val (),
                            cache: false,
                            beforeSend: function () {
                                $('#deta_cliente').
                            html('<img src="/servitech_tesis/img/cargando.GIF">\n\
                            <strong><i>Cargando...</i><strong>');
                            },
                                    success: function (msg){
                                        $('#deta_cliente').html(msg);
//                                        obtenerprecio();
                                    }
                        });
                    }
                }
                
                function validar_vigen() { //valida la fechas de vigencia
                var hoy = new Date($('#vfecha_ini').val());
                var fechaFormulario = new Date($('#vfecha_fin').val());
                if (fechaFormulario < hoy) {
                    alert('El numero de timbrado Hasta debe ser mayor a Desde!!!');
                    
                    $('#vfecha_fin').val(fechaFormulario);
                }
                else {
//                    $("#ocultar").css("display", "block");
                }
            }
            
            function validar() {
                var hoy = new Date();
                var fechaFormulario = new Date($('#vfecha_fin').val());
                if (fechaFormulario < hoy) {
                    alert (fechaFormulario);
                    alert('La Fecha Fin debe ser Mayor a la actual!!!');
                    $('#vfecha_fin').val(hoy);
                    $('#vfecha_fin').val(hoy);
                }
                else {
//                    $("#ocultar").css("display", "block");
                }
            } 
        </script>
    </body>
</html>




