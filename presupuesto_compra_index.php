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
                        <!--                        pregunta si ya llego la fecha fin-->
                        <?php    $presupuestoscompras = consultas::get_datos("select cod_presu_comp, cod_pedi_comp from presupuesto_compra where fecha_vigencia < current_date "
                                . "and estado_presu <> 'ANULADO' and estado_presu <> 'RECHAZADO' and estado_presu <> 'APROBADO' AND cod_suc=".$_SESSION['cod_suc']); ?>
<!--                        si ya vencio la promocion cambia el estado de la promo a inactiva -->
                        <?php  if (!empty($presupuestoscompras)){ ?>
                                
                        <?php foreach ($presupuestoscompras as $key => $value) {
                                 $sql= "update presupuesto_compra set estado_presu = 'VENCIDO' where cod_presu_comp =".$value['cod_presu_comp']; 
                                 $sql1= "update pedido_compra set estado_pedido = 'CONFIRMADO' where cod_pedi_comp =".$value['cod_pedi_comp']; 
                                 $sql2= "update deta_pedido_comp set estado = 'PENDIENTE' where cod_pedi_comp =".$value['cod_pedi_comp']; 
                                 $res = consultas::get_datos($sql);
                                 $res1 = consultas::get_datos($sql1);
                                 $res2 = consultas::get_datos($sql2);
                             } ?>
                        
                        <?php }?>
                        
                        <h3 class="page-header">Listado Presupuestos de Compras
                            
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
                            $presupuestoscompras = consultas::get_datos("select * from v_presupuesto_compra where cod_suc=".$_SESSION['cod_suc']. "
                             and suc_descri='".$_SESSION['suc_descri']. "' order by cod_presu_comp asc ");
                            if (!empty($presupuestoscompras)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Proveedor</th>
                                                    <th class="text-center">Funcionario</th>
                                                    <th class="text-center">Sucursal</th>
                                                    <th class="text-center">Vigencia</th>
                                                    <th class="text-center">N° Pedido</th>
                                                    <th class="text-center">Total</th>
                                                    <th class="text-center">Estado</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($presupuestoscompras as $presupuestocompra) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $presupuestocompra['cod_presu_comp']; ?></td>
                                                        <td class="text-center"><?php echo $presupuestocompra['proveedor']; ?></td>
                                                        <td class="text-center"><?php echo $presupuestocompra['usuario']; ?></td>
                                                        <td class="text-center"><?php echo $presupuestocompra['suc_descri']; ?></td>
                                                        <td class="text-center"><?php echo $presupuestocompra['vfecha_vigen']; ?></td>
                                                        <td class="text-center"><?php echo $presupuestocompra['cod_pedi_comp']; ?></td>
                                                        <td class="text-center"><?php echo $presupuestocompra['total_presu_comp']; ?></td>
                                                        <td class="text-center"><?php echo $presupuestocompra['estado_presu']; ?></td>
                                                        
                                                        <td class="text-center">
                                                            
                                                            <?php if($presupuestocompra['estado_presu']=='APROBADO' || $presupuestocompra['estado_presu']=='CONFIRMADO' || $presupuestocompra['estado_presu']=='RECHAZADO'){ ?>
                                                            
                                                            <a href="imprimir_presupuesto.php?vpresu=<?php echo $presupuestocompra['cod_presu_comp']; ?>"
                                                                   target="_blank"
                                                                   class="btn btn-xs btn-warning"
                                                                   rel="tooltip" data-title="imprimir">
                                                                    <span class="glyphicon glyphicon-print"></span></a>
                                                                
                                                                <a  
                                                                    href="presupuesto_compra_agregar.php?vpresu=<?php echo $presupuestocompra['cod_presu_comp']; ?><?= "&vpedi=".$presupuestocompra['cod_pedi_comp']?>"
                                                                class="btn btn-xs btn-info" rel='tooltip' data-title="Detalles" >
                                                                <span class="glyphicon glyphicon-tasks"></span></a>
                                                                
                                                           <?php }else if($presupuestocompra['estado_presu']=='ANULADO' || $presupuestocompra['estado_presu']=='VENCIDO'){?>
                                                            
                                                                <a href="imprimir_presupuesto.php?vpresu=<?php echo $presupuestocompra['cod_presu_comp']; ?>"
                                                                   target="_blank"
                                                                   class="btn btn-xs btn-warning"
                                                                   rel="tooltip" data-title="imprimir">
                                                                    <span class="glyphicon glyphicon-print"></span></a>
                                                                 <a  
                                                                    href="presupuesto_compra_agregar.php?vpresu=<?php echo $presupuestocompra['cod_presu_comp']; ?><?= "&vpedi=".$presupuestocompra['cod_pedi_comp']?>"
                                                                class="btn btn-xs btn-info" rel='tooltip' data-title="Detalles" >
                                                                <span class="glyphicon glyphicon-tasks"></span></a>
                                                                
                                                            <?php }else if($presupuestocompra['total_presu_comp']!='0')  {?>
                                                            <a  
                                                                href="presupuesto_compra_agregar.php?vpresu=<?php echo $presupuestocompra['cod_presu_comp']; ?><?= "&vpedi=".$presupuestocompra['cod_pedi_comp']?>"
                                                                class="btn btn-xs btn-info" rel='tooltip' data-title="Detalles" >
                                                                <span class="glyphicon glyphicon-tasks"></span></a>
                                                                
                                                                <a onclick="confirmar(<?php echo "'".$presupuestocompra['cod_presu_comp'] ."_". $presupuestocompra['descri_pedido'] ."_". $presupuestocompra['cod_pedi_comp']."_".
                                                                    $presupuestocompra['proveedor']."'"; ?>)"
                                                               class="btn btn-xs btn-success" rel='tooltip' data-title="Confirmar Registro Presupuesto"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-ok-sign"></span></a>
                                                              
                                                                <a onclick="rechazar(<?php echo "'".$presupuestocompra['cod_presu_comp'] ."_". $presupuestocompra['descri_pedido'] ."_". $presupuestocompra['cod_pedi_comp']."_".
                                                                        $presupuestocompra['proveedor']."'"; ?>)"
                                                               class="btn btn-xs btn-warning" rel='tooltip' data-title="Rechazar Presupuesto"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-remove"></span></a>
                                                                                                        
                                                                <a onclick="anular(<?php echo "'".$presupuestocompra['cod_presu_comp']."_". $presupuestocompra['descri_pedido']."_". $presupuestocompra['cod_pedi_comp']."_".
                                                                    $presupuestocompra['proveedor']."'"; ?>)"
                                                               class="btn btn-xs btn-danger" rel='tooltip' data-title="Anular Presupuesto"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-ban-circle"></span></a>
                                                                
                                                                 <?php }else {?>
                                                            
                                                              <a  
                                                                href="presupuesto_compra_agregar.php?vpresu=<?php echo $presupuestocompra['cod_presu_comp']; ?><?= "&vpedi=".$presupuestocompra['cod_pedi_comp']?>"
                                                                class="btn btn-xs btn-info" rel='tooltip' data-title="Detalles" >
                                                                <span class="glyphicon glyphicon-tasks"></span></a>
                                                                                                   
                                                                <a onclick="anular(<?php echo "'".$presupuestocompra['cod_presu_comp']."_". $presupuestocompra['descri_pedido']."_".
                                                                    $presupuestocompra['proveedor']."'"; ?>)"
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
                               
                                <h4 class="modal-title"><strong>Registrar Presupuesto</strong></h4>
                            </div>
                            <form action="presupuesto_compra_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body se">
                                    <input type="hidden" name="accion" id="accion" value="1">
                                    <input type="hidden" name="vpresu" id="vpresu" value="0">
                                    <input type="hidden" name="vtotal" value="0">
                                    <input type="hidden" name="vestado" id="vestado" value="PENDIENTE">
                                    <input type="hidden" name="vcod_usu" id="vcod_usu" value="<?php echo $_SESSION['cod_usu']; ?>">
                                   <input type="hidden" name="pagina" value="presupuesto_compra_agregar.php">
                                    
                                <!--Inicio campos Presupuesto-->
                                
                                <!-- Grupo de la primera fila-->
                                    <!--desde aqui-->
                                    <!-- Campo fecha-->
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Fecha</label>
                                        <div class="col-md-4">
                                            <input type="date" required="" id="vfecha_ini" readonly=""
                                                   placeholder="Especifique fecha"
                                                   class="form-control"
                                                   name="vfecha" 
                                                   onblur="validar_vigen(), validar1()"
                                                   value="<?php echo date("Y-m-d") ?>">
                                                   
                                                  
                                       </div>
                                        
                                        <label class="col-md-1 control-label">Vigencia</label>
                                        <div class="col-md-4">
                                            <input type="date" required="" id="vfecha_fin"
                                                   placeholder="Especifique fecha"
                                                   class="form-control"
                                                   name="vigencia" 
                                                   onblur="validar_vigen(), validar()"
                                                   value="<?php echo date("Y-m-d") ?>">
                                                   
                                                  
                                       </div>
                                    </div>
                                    <br>
                            <!-- Campo Proveedor-->
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Proveedor</label>
                                        <div class="col-md-4">
                                        <?php  if (isset($presupuestoscompras[0]['cod_prov'])) { ?>
                                        <?php $proveedores = consultas::get_datos("select * from v_proveedor3 "
                                                        . " order by cod_prov=".$presupuestoscompras[0]['cod_prov']." desc"); ?>  
                                            
                                        <?php } else { ?>
                                            <?php $proveedores = consultas::get_datos("select * from v_proveedor3 "
                                                        . " order by cod_prov desc"); ?>
                                        <?php }?>
                                            
                                            <select name="vprov" id="vproveedor" required="" class="form-control ">
                                                <?php
                                                if (!empty($proveedores)) {
                                                    foreach ($proveedores as $proveedor) {
                                                        ?>
                                                        <option value="<?php echo $proveedor['cod_prov']; ?>">
                                                            <?php echo $proveedor['persona']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="0">Debe ingresar un Proveedor</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                         <label class="col-md-1 control-label">Sucursal</label>
                                        <div class="col-md-4">
                                        <?php  if (isset($presupuestoscompras[0]['cod_suc'])) { ?>
                                        <?php $sucursales = consultas::get_datos("select * from v_sucursal "
                                                        . " order by cod_suc=".$presupuestoscompras[0]['cod_suc']." desc"); ?>  
                                            
                                        <?php } else { ?>
                                            <?php $sucursales = consultas::get_datos("select * from v_sucursal where cod_suc = ".$_SESSION['cod_suc']. ""
                                                        . " order by cod_suc desc"); ?>
                                        <?php }?>
                                            
                                            <select name="vsuc" id="vsucursal" class="form-control" readonly="">
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
                                   <br>
                            
                                     <!-- Campo Sucursal-->
                                        <div class="form-group">
                                       <!--                                        Campo Pedido Compra-->
                                        <label class="col-md-2 control-label">Pedido</label>
                                        <div class="col-md-8">
                                        <?php  if (isset($presupuestoscompras[0]['cod_pedi_comp'])) { ?>
                                        <?php $pedidoscompras = consultas::get_datos("select * from v_pedido_compra where estado_pedido='CONFIRMADO' "
                                                        . " order by cod_pedi_comp=".$presupuestoscompras[0]['cod_pedi_comp']." asc"); ?>  
                                            
                                        <?php } else { ?>
                                            <?php $pedidoscompras= consultas::get_datos("select * from v_pedido_compra where estado_pedido='CONFIRMADO'"
                                                        . " order by cod_pedi_comp asc"); ?>
                                        <?php }?>
                                            
                                            <select  required="" name="vpedi" id="vpedi" onchange="detallespedidos()" onkeyup="detallespedidos()" class="form-control">
                                                <?php
                                                if (!empty($pedidoscompras)) {
                                                    foreach ($pedidoscompras as $pedidocompra) {
                                                        ?>
                                                        <option value="<?php echo $pedidocompra['cod_pedi_comp']; ?>">
                                                            <?php echo $pedidocompra['datos_pedido']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="0">Debe ingresar un Pedido</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        
                                    </div>
                                     <br>
                                <!--Fin Campos-->  
                                
                                
                                <div class="modal-footer">
                                    <button type="reset" data-dismiss="modal" class="btn btn-default pull-left">
                                        <i class="fa fa-close"></i> Cerrar</button>
                                    <button type="submit" class="btn btn-primary pull-right">
                                        <i class="fa fa-floppy-o"></i> Registrar</button>
                                </div>
                                </div>
                                </div>
                            </form>
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
                , 'presupuesto_compra_control.php?vpresu=' + dat[0] + 
                        '&vcod_usu=null' +
                        '&vprov=null'  + 
                        '&vsuc=null' +
                        '&vfecha=1900-01-01'+
                        '&vigencia=1900-01-01'+
                        '&vestado=ANULADO'+
                        '&vpedi=' + dat[2] +
                        '&vtotal=null'+
                        '&accion=2'+
                        '&pagina=presupuesto_compra_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Anular el Presupuesto <i><strong>' + dat[1] + ' del Proveedor ' + dat[3] + '</strong></i>?');
            }
            
             function rechazar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href'
                , 'presupuesto_compra_control.php?vpresu=' + dat[0] +
                        '&vcod_usu=null' +
                        '&vprov=null'  + 
                        '&vsuc=null' +
                        '&vfecha=1900-01-01'+
                        '&vigencia=1900-01-01'+
                        '&vestado=RECHAZADO'+
                        '&vpedi=' + dat[2] +
                        '&vtotal=null'+
                        '&accion=5'+
                        '&pagina=presupuesto_compra_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Rechazar el Presupuesto <i><strong>' + dat[1] + ' del Proveedor ' + dat[3] + '</strong></i>?');
            }
            
            function confirmar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href'
                , 'presupuesto_compra_control.php?vpresu=' + dat[0] +
                        '&vcod_usu=null' +
                        '&vprov=null'  + 
                        '&vsuc=null' +
                        '&vfecha=1900-01-01'+
                        '&vigencia=1900-01-01'+
                        '&vestado=CONFIRMADO'+
                        '&vpedi=' + dat[2] +
                        '&vtotal=null'+
                        '&accion=4'+
                        '&pagina=presupuesto_compra_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Confirmar el Presupuesto: <i><strong>' + dat[1] + ' del Proveedor ' + dat[3] + '</strong></i>?');
            }
            
             function validar_vigen() { //valida la fechas de vigencia
                var hoy_si = new Date();
                var hoy = new Date($('#vfecha_ini').val());
                var fechaFormulario = new Date($('#vfecha_fin').val());
                if (fechaFormulario <= hoy) {
                    alert('El numero de timbrado Hasta debe ser mayor a Desde!!!');
//                    $('#vfecha_ini').val(hoy_si);
                    $('#vfecha_fin').val(hoy_si);
                }
                else {
//                    $("#ocultar").css("display", "block");
                }
            }
            
            function validar() {
                var hoy = new Date();
                var fechaFormulario = new Date($('#vfecha_fin').val());
                if (fechaFormulario < hoy) {
                    alert('La Fecha Fin debe ser Mayor a la actual!!!');
                   // $('#vfecha_ini').val(hoy);
                    $('#vfecha_fin').val(hoy);
                }
                else {
//                    $("#ocultar").css("display", "block");
                }
            }  
            
//            function validar1() {
//                var hoy = new Date();
//                var fechaFormulario = new Date($('#vfecha_ini').val());
//                if (fechaFormulario < hoy) {
//                    alert('La Fecha Inicio debe ser mayor o igual a la fecha de hoy!!!');
//                    $('#vfecha_ini').val(hoy);
//                   // $('#vfecha_fin').val(hoy);
//                }
//                else {
////                    $("#ocultar").css("display", "block");
//                }
//            }
        </script>
    </body>
</html>



