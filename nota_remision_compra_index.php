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
                        
                        <h2 class="page-header text-center">Listado de Notas de Remision
                            
                            <a data-toggle="modal" data-target="#registrar" 
                               class="btn btn-primary btn-microsoft pull-right" 
                               rel="tooltip" data-title="Registrar Nota">
                                <i class="fa fa-plus"></i>
                            </a>
                        </h2>
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
                
                <!--                       Tabla para el listado de salidas-->
                <div class="row">
                    <div class="col-lg-12">

                        <div class="panel panel-success panel-body">
                            <div class="panel-heading">
                                Datos de Notas de Remision
                            </div>
                            <?php
                            $remisioncompras = consultas::get_datos("select * from v_nota_remision_compra where cod_suc=".$_SESSION['cod_suc']. "
                             and suc_descri='".$_SESSION['suc_descri']. "' order by cod_nota_remi_comp asc ");
                            if (!empty($remisioncompras)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">N°Comp</th>
                                                    <th class="text-center">Proveedor</th>
                                                    <th class="text-center">Fecha Ini</th>
                                                    <th class="text-center">Motivo</th>
                                                    <th class="text-center">Conductor</th>
                                                    <th class="text-center">Sucursal</th>
                                                    <th class="text-center">N° Timbrado</th>
                                                    <th class="text-center">N° Remision</th>
                                                    <th class="text-center">Comprobante</th>
                                                    <th class="text-center">Estado</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($remisioncompras as $remisioncompra) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $remisioncompra['cod_nota_remi_comp']; ?></td>
                                                        <td class="text-center"><?php echo $remisioncompra['cod_comp']; ?></td>
                                                        <td class="text-center"><?php echo $remisioncompra['persona']; ?></td>
                                                        <td class="text-center"><?php echo $remisioncompra['vfecha_ini']; ?></td>
                                                        <td class="text-center"><?php echo $remisioncompra['motivo_remi']; ?></td>
                                                        <td class="text-center"><?php echo $remisioncompra['razon_nom_condu']; ?></td>
                                                        <td class="text-center"><?php echo $remisioncompra['suc_descri']; ?></td>
                                                        <td class="text-center"><?php echo $remisioncompra['nro_timbrado']; ?></td>
                                                        <td class="text-center"><?php echo $remisioncompra['nro_remision']; ?></td>
                                                        <td class="text-center"><?php echo $remisioncompra['comprobante_des']; ?></td>
                                                        <td class="text-center"><?php echo $remisioncompra['estado']; ?></td>
                                                        
                                                        <td class="text-center">
                                                            
                                                            <?php if($remisioncompra['estado']=='RECIBIDO'){ ?>
                                                            
                                                            <a href="imprimir_factura_nota_remision.php?vnota=<?php echo $remisioncompra['cod_nota_remi_comp']; ?>"
                                                               target="_blank"
                                                               class="btn btn-xs btn-success"
                                                               rel="tooltip" data-title="imprimir">
                                                                <span class="glyphicon glyphicon-print"></span></a>
                                                                
                                                                <a  
                                                                    href="nota_remision_compra_agregar.php?vnota=<?php echo $remisioncompra['cod_nota_remi_comp'];?><?= "&vcodcomp=".$remisioncompra['cod_comp']?>"
                                                                class="btn btn-xs btn-info" rel='tooltip' data-title="Detalles" >
                                                                <span class="glyphicon glyphicon-tasks"></span></a>
                                                                
                                                                <a onclick="anular(<?php echo "'".$remisioncompra['cod_nota_remi_comp']."_".$remisioncompra['persona']."_".$remisioncompra['fecdate_fin']."'"; ?>)"
                                                               class="btn btn-xs btn-danger" rel='tooltip' data-title="Anular Nota de Remision"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-ban-circle"></span></a>
                                                                
                                                                <a onclick="confirmar(<?php
                                                                echo "'" . $remisioncompra['cod_nota_remi_comp'] . "_" .
                                                                $remisioncompra['persona'] . "_" .
                                                                $remisioncompra['fecdate_fin'] . "'";
                                                                ?>)"
                                                                   class="btn btn-xs btn-warning" rel='tooltip' data-title="Confirmar"
                                                                   data-toggle="modal"
                                                                   data-target="#delete">
                                                                    <span class="glyphicon glyphicon-ok-sign"></span></a>
                                                                
                                                           <?php }else if($remisioncompra['estado']=='ANULADO'){?>
                                                            
                                                                 <a href="imprimir_factura_nota_remision.php?vnota=<?php echo $remisioncompra['cod_nota_remi_comp']; ?>"
                                                               target="_blank"
                                                               class="btn btn-xs btn-success"
                                                               rel="tooltip" data-title="imprimir">
                                                                <span class="glyphicon glyphicon-print"></span></a>
                                                                <a  
                                                                    href="nota_remision_compra_agregar.php?vnota=<?php echo $remisioncompra['cod_nota_remi_comp'];?><?= "&vcodcomp=".$remisioncompra['cod_comp']?>"
                                                                class="btn btn-xs btn-info" rel='tooltip' data-title="Detalles" >
                                                                <span class="glyphicon glyphicon-tasks"></span></a>
                                                                
                                                                
                                                            <?php }else {?>
                                                            
                                                            <a  href="nota_remision_compra_agregar.php?vnota=<?php echo $remisioncompra['cod_nota_remi_comp'];?><?= "&vcodcomp=".$remisioncompra['cod_comp']?>"
                                                                class="btn btn-xs btn-info" rel='tooltip' data-title="Detalles" >
                                                                <span class="glyphicon glyphicon-tasks"></span></a>
                                                                
                                                                  <a href="imprimir_factura_nota_remision.php?vnota=<?php echo $remisioncompra['cod_nota_remi_comp']; ?>"
                                                               target="_blank"
                                                               class="btn btn-xs btn-success"
                                                               rel="tooltip" data-title="imprimir">
                                                                <span class="glyphicon glyphicon-print"></span></a>
                                                                
                                                                <a onclick="anular(<?php echo "'".$remisioncompra['cod_nota_remi_comp']."_".$remisioncompra['persona']."_".$remisioncompra['fecdate_fin']."'"; ?>)"
                                                               class="btn btn-xs btn-danger" rel='tooltip' data-title="Anular Nota de Remision"
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
                        

                        <!-- /.panel -->
                    </div>
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
                               
                                <h4 class="modal-title"><strong>Registrar Notas de Remision</strong></h4>
                            </div>
                             <?php $fecha = consultas::get_datos("select * from v_fecha2"); ?>
                            <form action="nota_remision_compra_control.php
                                  " method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body se">
                                    <input type="hidden" name="accion" id="accion" value="1">
                                    <input type="hidden" name="vnota" id="vnota" value="0">
                                    <input type="hidden" name="vestado" value="ACTIVO">
                                    <input type="hidden" name="vcod_usu" id="vcod_usu" value="<?php echo $_SESSION['cod_usu']; ?>">
                                    <input type="hidden" name="vsuc" value="<?php echo $_SESSION['cod_suc']; ?>">
                                    <input type="hidden" name="vfechasis" id="fecc" value="<?php echo $fecha[0]['fecha'] ?>">
                                    <input type="hidden" name="pagina" value="nota_remision_compra_agregar.php">
                                    
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
                                                   name="vfecha_inicial"
                                                   value="<?php echo date("Y-m-d") ?>"
                                               onchange="validar_desde()"
                                               onmouseup="validar()"
                                               onkeyup="validar()"
                                               onchange="validar()"
                                               onclick="validar()"
                                               onkeypress="validar()"
                                       </div>
                                    </div>
                                    
                                    <label class="col-md-2 control-label">Vigencia:</label>
                                        <div class="col-md-4">
                                            
                                            <input type="date" required="" id="fec"
                                                   placeholder="Especifique fecha"
                                                   class="form-control"
                                                   name="vfecha_final" 
                                                   onchange="validar_desde()"
                                                   value="<?php echo date("Y-m-d") ?>" 
                                       </div>
                                    </div>
                                
                                 </div>
                                <div class="form-group">
                                <label class="col-md-2 control-label">Compras:</label>
                                <div class="col-md-7">
                                    
                                   <?php   $compras = consultas::get_datos("select * from v_compras where cod_comp NOT IN(select cod_comp from nota_remision_compra where estado != 'ANULADO') and"
                                                                . " cod_suc=" . $_SESSION['cod_suc']
                                                                . " and com_estado ='CONFIRMADO' "
                                                                . "order by cod_comp"); ?>
                                    <select name="vcodcomp" 
                                            class="form-control" id="compra" 
                                            onchange="proveedor()"
                                            onkeyup="proveedor()"
                                            
                                            required="">
<!--                                        <option value="0">Seleccione una Compra</option>-->
                                        <?php
                                        if (!empty($compras)) {
                                            foreach ($compras as $compra) {
                                                ?>  
                                                <option value="<?php echo $compra['cod_comp']; ?>">
                                                    <?php echo $compra['datos_compra']; ?>
                                                </option>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <option value="">Debe insertar una Compra</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                </div>
                        
                                <div class="form-group">
                                        <label class="col-md-2 control-label">Proveedor:</label>
                                        <div class="col-md-7" id="detalles">
                                            <select class="form-control" required="" readonly="" >
                                                <option>Seleccione un proveedor</option>
                                            </select>
                                        </div>
                                        </div>
                                    <div class="form-group">
                                     <label class="col-md-2 control-label">Nro Remision:</label>
                                        <div class="col-md-4">
                                            <input type="text" required="" id="num" maxlength="15"  minlength="13" placeholder="Ingrese Nro Remision sin guion"  name="vnro_remi"
                                               onkeyup="nronegativo()"
                                               onchange="nronegativo()"
                                               pattern="[0-9 and -]{13,15}"title="La nota de remision debe tener obligatoriamente 13 digitos sin guion y 15 digitos con guion"
                                               class="form-control" value="">
                                            
                                        </div>
                                     
                                        <label class="col-md-2 control-label">Tipo Comprobante</label>
                                        <div class="col-md-4">
                                            <?php $tiposcomprobantes = consultas::get_datos("select * from tipo_comprobante where cod_tipo_comp = 4 order by cod_tipo_comp asc"); ?>
                                            <select name="vtipo_comp" class="form-control">
                                                <?php
                                                if (!empty($tiposcomprobantes)) {
                                                    foreach ($tiposcomprobantes as $tipocomprobante) {
                                                        ?>
                                                        <option value="<?php echo $tipocomprobante['cod_tipo_comp']; ?>">
                                                            <?php echo $tipocomprobante['comprobante_des']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="0">Debe ingresar un comprobante</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    
                                  </div>
                            
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Sucursal:</label>
                                        <div class="col-md-4">
                                            <input type="text" required="" placeholder="Ingrese Sucursal" readonly="" 
                                                   class="form-control" value="<?php echo $_SESSION['suc_descri']; ?>">
                                        </div>
                                        <!-- Campo Sucursal-->
                                        
                                        <label class="col-md-2 control-label">Timbrado:</label>
                                    <div class="col-md-4">
                                        <input type="text" required="" 
                                               placeholder="Ingrese el numero de Timbrado"
                                               class="form-control" id="timbra"
                                                onkeyup="nronegativo2()"
                                               onchange="nronegativo2()"
                                               pattern="[0-9]{8,8}"title="Timbrado debe tener 8 digitos"
                                               minlength="8" maxlength="8" 
                                               name="vtim">

                                    </div>
                                        
                                    </div>
                           
<!--                            Campos Depositos-->
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Conductor:</label>
                                        <div class="col-md-4">
                                            <input type="text" required="" placeholder="Ingrese Nombre/s y Apellido/s del Chofer"  name="vconductor"
                                                   class="form-control" value="" required="">
                                            
                                        </div>
                                    
                                    <label class="col-md-2 control-label">Cedula I.:</label>
                                        <div class="col-md-4">
                                            <input type="text" required="" placeholder="Ingrese Ci"
                                                   class="form-control" value="" id="ci"
                                                   minlength="7" maxlength="8"
                                                    onkeyup="nronegativo3()"
                                                   onchange="nronegativo3()"
                                                   pattern="[0-9]{7,8}"title="El CI debe tener 7 u 8 digitos"
                                                   >
                                            
                                        </div>
                                    
                                    </div>

                                    <div class="form-group">
                                    <label class="col-md-2 control-label">Telef:</label>
                                        <div class="col-md-4">
                                            <input type="text" placeholder="Ingrese N° de Telef o Celular" name="vtelef"
                                                   onkeyup="nronegativo4()" id="tel"
                                                   onchange="nronegativo4()"
                                                   class="form-control" value="">
                                            
                                        </div>
                                    
                                    <label class="col-md-2 control-label">RUA:</label>
                                        <div class="col-md-4">
                                            <input type="text" required="" placeholder="Ingrese Registro Unico Automotor" name="vrua"
                                                   class="form-control" value="">
                                            
                                        </div>
                                    
                                    </div>

                                    <div class="form-group">
                                    
                                    <label class="col-md-2 control-label">KMs:</label>
                                        <div class="col-md-4">
                                            <input type="number" placeholder="Ingrese km aproximado de recorrido" name="vkm"
                                                   class="form-control" value="">
                                            
                                        </div>
                                    
                                    
                                    
                                    <label class="col-md-2 control-label">Vehiculo:</label>
                                        <div class="col-md-4">
                                            <input type="text" required=""  maxlength="13" placeholder="Ingrese Nro Remision sin guion"  name="vtransporte"
                                                   class="form-control" value="">
                                            
                                        </div>
                                    
                                    </div>
                                    
                                
                                    <div class="form-group">
                                    <label class="col-md-2 control-label">Motivo Nota:</label>
                                        <div class="col-md-4">
                                            <input type="text" required="" placeholder="Ingrese Motivo" readonly="" name="vmotivo"
                                                   class="form-control" value="COMPRA" required="">
                                            
                                        </div>
                                    
                                    <label class="col-md-2 control-label">Motivo Atraso:</label>
                                        <div class="col-md-4">
                                            <input type="text" placeholder="Ingrese Motivo si hubo atraso"  name="vatraso"
                                                   class="form-control" value="">
                                            
                                        </div>
                                    
                                    </div>
                                <!--Fin Campos-->  
                                 
                                </div>
                                
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


                <!--anular-->
                <div class="modal fade" id="delete" tabindex="-1" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title custom_align" id="Heading">Atenci&oacute;n!!!</h4>
                            </div>
                            <div class="modal-body">

                                <div class="alert alert-warning" id="borrar"></div>

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
                , 'nota_remision_compra_control.php?vnota=' + dat[0] +
                        '&vcodcomp=null' +
                        '&vestado=ANULADO' +
                        '&vfecha_inicial=1900-01-01' +
                        '&vfecha_final=1900-01-01' +
                        '&vmotivo=null' +
                        '&vatraso=null' +
                        '&vtransporte=null' +
                        '&vrua=null' +
                        '&vconductor=null' +
                        '&vci=null' +
                        '&vtelef=null' +
                        '&vkm=null' +
                        '&vprov=null' +
                        '&vsuc=null' +
                        '&vcod_usu=null' +
                        '&vnro_remi=null' +
                        '&vtim=null' +
                        '&vtipo_comp=null' +
                        '&accion=2'+
                        '&pagina=nota_remision_compra_index.php');
                $('#borrar').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Anular la Nota de Remision del Proveedor <i><strong> ' + dat[1] + ' de la Fecha ' + dat[2] + ' </strong></i>?');
            }
            
            function confirmar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href'
                 , 'nota_remision_compra_control.php?vnota=' + dat[0] +
                        '&vcodcomp=null' +
                        '&vestado=CONFIRMADO RECIBIDO' +
                        '&vfecha_inicial=1900-01-01' +
                        '&vfecha_final=1900-01-01' +
                        '&vmotivo=null' +
                        '&vatraso=null' +
                        '&vtransporte=null' +
                        '&vrua=null' +
                        '&vconductor=null' +
                        '&vci=null' +
                        '&vtelef=null' +
                        '&vkm=null' +
                        '&vprov=null' +
                        '&vsuc=null' +
                        '&vcod_usu=null' +
                        '&vnro_remi=null' +
                        '&vtim=null' +
                        '&vtipo_comp=null' +
                        '&accion=4'+
                        '&pagina=nota_remision_compra_index.php');
                $('#borrar').html('<span class="glyphicon glyphicon-ok-sign"></span>\n\
            Desea Confirmar la Nota de Remision del Proveedor <i><strong> ' + dat[1] + ' de la Fecha ' + dat[2] + ' </strong></i>?');
            }
            
            $("document").ready(function () {
                    proveedor();
                });
         
             function proveedor(){
                    if ((parseInt($('#compra').val()) > 0) || ($('#compra').val() !== "")) {
                        $.ajax({
                            type: "GET",
                            url: "/servitech_tesis/lista_proveedor_compra.php?vcodcomp=" + 
                                    $('#compra').val (),
                            cache: false,
                            beforeSend: function () {
                                $('#detalles').
                            html('<img src="/servitech_tesis/img/cargando.GIF">\n\
                            <strong><i>Cargando...</i><strong>');
                            },
                                    success: function (msg){
                                        $('#detalles').html(msg);
                                        obtenertimbrado();
                                    }
                        });
                        
                        
                    }
                    else if ((parseInt($('#compra').val() == "0"))){
                        $('#compra').val('');
                 }       
                }
                
                function obtenertimbrado(){
                    //var dat = $('#prov').val().split("_");
                    if (parseInt($('#prov').val()) > 0) {
                        $.ajax({
                            type: "GET",
                            url: "/servitech/lista_timbrados_remicompra.php?vprov=" +
                                    $('#prov').val (),
                            cache: false,
                            beforeSend: function () {
                                $('#detalle_timbrado').
                            html('<img src="/servitech/img/cargando.GIF">\n\
                            <strong><i>Cargando...</i><strong>');
                            },
                                    success: function (msg){
                                        $('#detalle_timbrado').html(msg);
                                    }
                        });
                    }
                        
                }
                
                function nronegativo() {

                var numero = document.getElementById("num").value;
                if (numero.match(/^-?[0-9--]+(\.[0-9--]{1,2})?$/))
                {
//                    alert("numero ok");
                }
                else
                {
                    notificacion('Atencion','Ingrese su numero sin puntos, letras ni espacios', 'mensaje');
                    document.getElementById("num").value = "";
                }
            }
            
            function nronegativo2() {

                var numero = document.getElementById("timbra").value;
                if (numero.match(/^-?[0-9--]+(\.[0-9--]{1,2})?$/))
                {
//                    alert("numero ok");
                }
                else
                {
                    notificacion('Atencion','Ingrese su numero sin puntos, letras ni espacios', 'mensaje');
                    document.getElementById("timbra").value = "";
                }
            }
            
             function nronegativo3() {

                var numero = document.getElementById("ci").value;
                if (numero.match(/^-?[0-9--]+(\.[0-9--]{1,2})?$/))
                {
//                    alert("numero ok");
                }
                else
                {
                    notificacion('Atencion','Ingrese su numero sin puntos, letras ni espacios', 'mensaje');
                    document.getElementById("ci").value = "";
                }
            }
            
            function nronegativo4() {

                var numero = document.getElementById("tel").value;
                if (numero.match(/^-?[0-9--]+(\.[0-9--]{1,2})?$/))
                {
//                    alert("numero ok");
                }
                else
                {
                    notificacion('Atencion','Ingrese su numero sin puntos, letras ni espacios', 'mensaje');
                    document.getElementById("tel").value = "";
                }
            }
            
             function validar_desde() {
                var hoy = new Date($('#vfecha').val());
                var fechaFormulario = new Date($('#fec').val());
                 var fec = $('#fecc').val();
                if (fechaFormulario < hoy) {
                    alert('El timbrado ya vencio!!!');
                    $('#vfecha').val(fec);
                    $('#fec').val(fec);
                }
                else {
                }
            }
            
            function validar_inicio() {
                var hoy = new Date();
                var fechaFormulario = new Date($('#vfecha').val());
                var fec = $('#fecc').val();
                if (fechaFormulario > hoy) {
                    alert('Fecha superior al actual!!!');
                    $('#vfecha').val(fec);
                    $('#vfecha').val(fec);
                }
                else {
//                    $("#ocultar").css("display", "block");
                }
            }
            
            
        </script>
    </body>
</html>


