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
                      
                        
                        <h3 class="page-header">Listado Presupuesto de Servicios
                            
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
                                Datos
                            </div>
                            <?php
                            $presupuestoservicios = consultas::get_datos("select * from v_presupuesto_servi where cod_suc=".$_SESSION['cod_suc']. "
                             and suc_descri='".$_SESSION['suc_descri']. "' order by cod_presu_servi asc ");
                            if (!empty($presupuestoservicios)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">#Diag</th>
                                                    <th class="text-center">Observacion</th>
                                                    <th class="text-center">Cliente</th>
                                                    <th class="text-center">Funcionario</th>
                                                    <th class="text-center">Sucursal</th>
                                                    <th class="text-center">Fecha</th>
                                                    <th class="text-center">Total</th>
                                                    <th class="text-center">Estado</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($presupuestoservicios as $presupuestoservicio) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $presupuestoservicio['cod_presu_servi']; ?></td>
                                                        <td class="text-center"><?php echo $presupuestoservicio['cod_diagnostico']; ?></td>
                                                        <td class="text-center"><?php echo $presupuestoservicio['observacion']; ?></td>
                                                        <td class="text-center"><?php echo $presupuestoservicio['cliente']; ?></td>
                                                        <td class="text-center"><?php echo $presupuestoservicio['usuario']; ?></td>
                                                        <td class="text-center"><?php echo $presupuestoservicio['suc_descri']; ?></td>
                                                        <td class="text-center"><?php echo $presupuestoservicio['vfecha']; ?></td>
                                                        <td class="text-center"><?php echo number_format($presupuestoservicio['total'], 0, ',', '.'); ?></td>
                                                        <td class="text-center"><?php echo $presupuestoservicio['estado']; ?></td>
                                                        
                                                        <td class="text-center">
                                                            
                                                            <?php if($presupuestoservicio['estado']=='EN TRABAJO' || $presupuestoservicio['estado']=='CONFIRMADO' || $presupuestoservicio['estado']=='TERMINADO'|| $presupuestoservicio['estado']=='FACTURADO'){ ?>
                                                            
                                                            <a href="imprimir_presupuesto_servicio.php?vpresu_servi=<?php echo $presupuestoservicio['cod_presu_servi']; ?>"
                                                                   target="_blank"
                                                                   class="btn btn-xs btn-primary"
                                                                   rel="tooltip" data-title="imprimir">
                                                                    <span class="glyphicon glyphicon-print"></span></a>
                                                                
                                                                <a  
                                                                    href="presupuesto_servicio_agregar.php?vpresu_servi=<?php echo $presupuestoservicio['cod_presu_servi']; ?><?= "&vdiag=".$presupuestoservicio['cod_diagnostico']?>"
                                                                class="btn btn-xs btn-info" rel='tooltip' data-title="Detalles" >
                                                                <span class="glyphicon glyphicon-tasks"></span></a>
                                                                
                                                           <?php }else if($presupuestoservicio['estado']=='ANULADO' || $presupuestoservicio['estado']=='RECHAZADO')   {?>
                                                               <a href="imprimir_presupuesto_servicio.php?vpresu_servi=<?php echo $presupuestoservicio['cod_presu_servi']; ?>"
                                                                   target="_blank"
                                                                   class="btn btn-xs btn-primary"
                                                                   rel="tooltip" data-title="imprimir">
                                                                    <span class="glyphicon glyphicon-print"></span></a>
                                                                <a  
                                                                    href="presupuesto_servicio_agregar.php?vpresu_servi=<?php echo $presupuestoservicio['cod_presu_servi']; ?><?= "&vdiag=".$presupuestoservicio['cod_diagnostico']?>"
                                                                class="btn btn-xs btn-info" rel='tooltip' data-title="Detalles" >
                                                                <span class="glyphicon glyphicon-tasks"></span></a>
                                                                
                                                            <?php }else if($presupuestoservicio['total']!='0')   {?>
                                                                 <a  
                                                                    href="presupuesto_servicio_agregar.php?vpresu_servi=<?php echo $presupuestoservicio['cod_presu_servi']; ?><?= "&vdiag=".$presupuestoservicio['cod_diagnostico']?>"
                                                                class="btn btn-xs btn-info" rel='tooltip' data-title="Detalles" >
                                                                <span class="glyphicon glyphicon-tasks"></span></a>
                                                                <a onclick="confirmar(<?php echo "'".$presupuestoservicio['cod_presu_servi'] ."_". $presupuestoservicio['datos_presupuesto'] ."_". $presupuestoservicio['cod_diagnostico'] ."_".
                                                                    $presupuestoservicio['cliente']."'"; ?>)"
                                                               class="btn btn-xs btn-success" rel='tooltip' data-title="Confirmar Registro Presupuesto"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-ok-sign"></span></a>
                                                              
                                                                <a onclick="rechazar(<?php echo "'".$presupuestoservicio['cod_presu_servi'] ."_". $presupuestoservicio['datos_presupuesto'] ."_". $presupuestoservicio['cod_diagnostico'] ."_".
                                                                    $presupuestoservicio['cliente']."'"; ?>)"
                                                               class="btn btn-xs btn-warning" rel='tooltip' data-title="Rechazar Presupuesto"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-remove"></span></a>
                                                                                                        
                                                                <a onclick="anular(<?php echo "'".$presupuestoservicio['cod_presu_servi']."_". $presupuestoservicio['datos_presupuesto']."_".$presupuestoservicio['cod_diagnostico']."_".
                                                                    $presupuestoservicio['cliente']."'"; ?>)"
                                                               class="btn btn-xs btn-danger" rel='tooltip' data-title="Anular Presupuesto"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-ban-circle"></span></a>
                                                             <?php }else {?>
                                                            <a  
                                                                    href="presupuesto_servicio_agregar.php?vpresu_servi=<?php echo $presupuestoservicio['cod_presu_servi']; ?><?= "&vdiag=".$presupuestoservicio['cod_diagnostico']?>"
                                                                class="btn btn-xs btn-info" rel='tooltip' data-title="Detalles" >
                                                                <span class="glyphicon glyphicon-tasks"></span></a>
                                                                                                   
                                                                <a onclick="anular(<?php echo "'".$presupuestoservicio['cod_presu_servi']."_". $presupuestoservicio['datos_presupuesto']."_".$presupuestoservicio['cod_diagnostico']."_".
                                                                    $presupuestoservicio['cliente']."'"; ?>)"
                                                               class="btn btn-xs btn-danger" rel='tooltip' data-title="Anular Presupuesto"
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
                               
                                <h4 class="modal-title text-center"><strong>Registrar Presupuesto Servicio</strong></h4>
                            </div>
                            <?php $fecha_vigen = consultas::get_datos("select * from v_fecha_vigencia_5") ?>
                            <form action="presupuesto_servicio_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body se">
                                    <input type="hidden" name="accion" id="accion" value="1">
                                    <input type="hidden" name="vpresu_servi" id="vpresu_servi" value="0">
                                    <input type="hidden" name="vestado" id="vestado" value="PENDIENTE">
                                    <input type="hidden" name="vtotal" id="vtotal" value="0">
                                    <input type="hidden" name="vcod_usu" id="vcod_usu" value="<?php echo $_SESSION['cod_usu']; ?>">
                                    <input type="hidden" name="vsuc" id="vsuc" value="<?php echo $_SESSION['cod_suc']; ?>">
                                    <input type="hidden" name="pagina" value="presupuesto_servicio_agregar.php">
                                    
                                <!--Inicio campos Presupuesto-->
                                
                                <!-- Grupo de la primera fila-->
                                    <!--desde aqui-->
                                    <!-- Campo fecha-->
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Fecha</label>
                                        <div class="col-md-4">
                                            <input type="date" required="" id="vfecha"
                                                   placeholder="Especifique fecha"
                                                   class="form-control"
                                                   name="vfecha" 
                                                   readonly=""
                                                   onmouseup="validar()"
                                                   onkeyup="validar()"
                                                   onchange="validar()"
                                                   onclick="validar()"
                                                   onkeypress="validar()"
                                                   value="<?php echo date("Y-m-d") ?>"
                                       </div>
                                    </div>
                                    
                                    <label class="col-md-2 control-label">Vigencia:</label>
                                        <div class="col-md-4">
                                            <input type="date" required="" id="vfecha_vigen"
                                                   placeholder="Especifique fecha"
                                                   class="form-control"
                                                   name="vfecha_vigen" 
                                                   readonly=""
                                                   onmouseup="validar()"
                                                   onkeyup="validar()"
                                                   onchange="validar()"
                                                   onclick="validar()"
                                                   onkeypress="validar()"
                                                   value="<?php echo $fecha_vigen[0]['v_fecha_vigen']; ?>"
                                       </div>
                                    </div>

                                        
                                        
                                    </div>
                            <!-- Campo Proveedor-->
                            
                            <br>
                            
                                <div class="form-group">
<!--                                        Campo Recepcion-->
                                <label class="col-md-2 control-label">Diagnostico:</label>
                                <div class="col-md-7">
                                    <?php $diagnosticos = consultas::get_datos("select * from v_diagnostico where estado='CONFIRMADO' order by cod_diagnostico asc"); ?>
                                    <select name="vdiag" 
                                            class="form-control" id="diag" 
                                            onchange="cliente()"
                                            onkeyup="cliente()">
<!--                                        <option value="">Seleccione una Recepcion</option>-->
                                        <?php
                                        if (!empty($diagnosticos)) {
                                            foreach ($diagnosticos as $diagnostico) {
                                                ?>  
                                                <option value="<?php echo $diagnostico['cod_diagnostico']; ?>">
                                                    <?php echo $diagnostico['datos_diagnostico']; ?>
                                                </option>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <option value="">Debe insertar un Diagnostico</option>
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
                                
                                <!-- Campo Sucursal-->

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
                , 'presupuesto_servicio_control.php?vpresu_servi=' + dat[0] +
                        '&vestado=ANULADO'+
                        '&vtotal=null' +
                        '&vfecha=1900-01-01'+
                        '&vfecha_vigen=1900-01-01'+
                        '&vcod_usu=null'   +
                        '&vsuc=null' +
                        '&vdiag='  + dat[2] +
                        '&vcli=null'+
                        '&accion=2'+
                        '&pagina=presupuesto_servicio_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Anular el Presupuesto realizado al/el: <i><strong>' + dat[1] + ' del/la Cliente ' + dat[3] + '</strong></i>?');
            }
            
            function confirmar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href'
                , 'presupuesto_servicio_control.php?vpresu_servi=' + dat[0] +
                        '&vestado=CONFIRMADO'+
                        '&vtotal=null' +
                        '&vfecha=1900-01-01'+
                        '&vfecha_vigen=1900-01-01'+
                        '&vcod_usu=null'   +
                        '&vsuc=null' +
                        '&vdiag='  + dat[2] +
                        '&vcli=null'+
                        '&accion=4'+
                        '&pagina=presupuesto_servicio_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Confirmar el Presupuesto realizado al/el: <i><strong>' + dat[1] + ' del/la Cliente ' + dat[3] + '</strong></i>?');
            }
            
            function rechazar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href'
                , 'presupuesto_servicio_control.php?vpresu_servi=' + dat[0] +
                        '&vestado=RECHAZADO'+
                        '&vtotal=null' +
                        '&vfecha=1900-01-01'+
                        '&vfecha_vigen=1900-01-01'+
                        '&vcod_usu=null'   +
                        '&vsuc=null' +
                        '&vdiag='  + dat[2] +
                        '&vcli=null'+
                        '&accion=5'+
                        '&pagina=presupuesto_servicio_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Rechazar el Presupuesto realizado al/el: <i><strong>' + dat[1] + ' del/la Cliente ' + dat[3] + '</strong></i>?');
            }
            
            $("document").ready(function () {
                    cliente();
                });
            
            function cliente(){
                    if ((parseInt($('#diag').val()) > 0) || ($('#diag').val() !== "")) {
                        $.ajax({
                            type: "GET",
                            url: "/servitech_tesis/lista_cliente_diagnostico.php?vdiag=" + 
                                    $('#diag').val (),
                            cache: false,
                            beforeSend: function () {
                                $('#deta_cliente').
                            html('<img src="/servitech/img/cargando.GIF">\n\
                            <strong><i>Cargando...</i><strong>');
                            },
                                    success: function (msg){
                                        $('#deta_cliente').html(msg);
//                                        obtenerprecio();
                                    }
                        });
                    }
                }
        </script>
    </body>
</html>




