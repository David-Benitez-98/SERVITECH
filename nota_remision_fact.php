<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon"  href=" img/logo_negro.ico"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SERVITECH SYS - NOTA DE REMISION</title>

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
                    <!--impresion del titulo de la pagina-->
                    <div class="col-lg-12">
                        <h3 class="page-header text-center"> <strong>LISTADO DE NOTAS DE REMISION</strong>

                            <a data-toggle="modal" data-target="#registrar" 
                               class="btn btn-info btn-microsoft pull-right" 
                               rel="tooltip" data-title="Registrar" >
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
                            $remisions = consultas::get_datos("select * from v_notaremisionfactura"
                                            . " where cod_suc =" . $_SESSION['cod_suc'] . " order by cod_nota_remi_vent asc ");
                            if (!empty($remisions)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">NRO. FACTURA</th>
                                                    <th class="text-center">NRO. REMISION</th>
                                                    <th class="text-center">SUCURSAL</th>                                        
                                                    <th class="text-center">USUARIOS</th> 
                                                    <th class="text-center">CLIENTE</th>
                                                    <th class="text-center">DIRECCION</th>
                                                    <th class="text-center">MOTIVO</th>
                                                    <th class="text-center">CONDUCTOR</th>
                                                    <th class="text-center">VEHICULO</th>
                                                    <th class="text-center">FECHA SALIDA</th>
                                                    <th class="text-center">FECHA LLEGADA</th>
                                                    <th class="text-center">ESTADO</th>
                                                    <th class="text-center">ACCIONES</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($remisions as $remision) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $remision['cod_nota_remi_vent']; ?></td>
                                                        <td class="text-center"><?php echo $remision['cod_factura'] . "-" . $remision['nro_factura']; ?></td>
                                                        <td class="text-center"><?php echo $remision['nro_nota_remi']; ?></td>
                                                        <td class="text-center"><?php echo $remision['suc_descri']; ?></td>
                                                        <td class="text-center"><?php echo $remision['usuario']; ?></td>
                                                        <td class="text-center"><?php echo $remision['cliente']; ?></td>
                                                        <td class="text-center"><?php echo $remision['ciu_des'] . " - " . $remision['per_direc']; ?></td>
                                                        <td class="text-center"><?php echo $remision['motivo_traslado']; ?></td>
                                                        <td class="text-center"><?php echo $remision['personal']; ?></td>
                                                        <td class="text-center"><?php echo $remision['descri'] . "-" . $remision['descri_marca']; ?></td>
                                                        <td class="text-center"><?php echo $remision['fecha_ini_salida']; ?></td>
                                                        <td class="text-center"><?php echo $remision['fecha_fin_llegada']; ?></td>
                                                        <td class="text-center"><?php echo $remision['estado_not_remi']; ?></td>
                                                        <td class="text-center">
                                                                 <?php if ($remision['estado_not_remi'] == 'ANULADO' || $remision['estado_not_remi'] == 'CONFIRMADO') { ?> 
                                                            <a  
                                                                href="notaremision_fact_detalle_1.php?vdetremifact=<?php echo $remision['cod_nota_remi_vent']; ?>&vfact=<?php echo $remision['cod_factura']; ?>"
                                                                class="btn btn-xs btn-primary" rel='tooltip' data-title="Detalles" >
                                                                <span class="fa fa-th-list"></span></a>
                                                                <?php } else { ?>
                                                            <a  
                                                                href="notaremision_fact_detalle.php?vdetremifact=<?php echo $remision['cod_nota_remi_vent']; ?>&vfact=<?php echo $remision['cod_factura']; ?>"
                                                                class="btn btn-xs btn-primary" rel='tooltip' data-title="Detalles" >
                                                                <span class="fa fa-th-list"></span></a>
                                                             <?php } ?>
                                                            <a href="imprimir_factura_nota_remision_ventas.php?vcod=<?php echo $remision['cod_nota_remi_vent']; ?>"
                                                               target="_blank"
                                                               class="btn btn-xs btn-success"
                                                               rel="tooltip" data-title="imprimir">
                                                                <span class="glyphicon glyphicon-print"></span></a>
                                                            <?php if ($remision['estado_not_remi'] == 'ACTIVO') { ?>  
                                                                <a onclick="anular(<?php
                                                                echo "'" . $remision['cod_nota_remi_vent'] . "_" .
                                                                $remision['estado_not_remi'] . "'";
                                                                ?>)"
                                                                   class="btn btn-xs btn-danger" rel='tooltip' data-title="Anular"
                                                                   data-toggle="modal"
                                                                   data-target="#delete">
                                                                    <span class="glyphicon glyphicon-ban-circle"></span></a>
                                                                <a onclick="confirmar(<?php
                                                                echo "'" . $remision['cod_nota_remi_vent'] . "_" .
                                                                $remision['estado_not_remi'] . "'";
                                                                ?>)"
                                                                   class="btn btn-xs btn-warning" rel='tooltip' data-title="Confirmar"
                                                                   data-toggle="modal"
                                                                   data-target="#delete">
                                                                    <span class="glyphicon glyphicon-ok-sign"></span></a>
                                                            <?php } else { ?>
                                                            <?php } ?>




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
                            <div class="modal-header alert-success">
                                <button type="button" class="close" 
                                        data-dismiss="modal" arial-label="Close">x</button>
                                <h4 class="modal-title"><strong>REGISTRAR NOTA REMISION</strong></h4>
                            </div>
                            <?php $fecha = consultas::get_datos("select * from v_fecha2"); ?>
                            <?php $timbradoo = consultas::get_datos("select * from v_timbrado where cod_tipo_comp = 4 and estado = 'ACTIVO' "); ?>
                            <?php $siguientefactu = consultas::get_datos("select * from v_notaremision_siguientefactura"); ?>
                            <form action="nota_remision_fact_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body se">
                                    <input type="hidden" name="accion"  value="1">
                                    <input type="hidden" name="vremi" value="0"/> 
                                    <input type="hidden" name="vusu" 
                                           value="<?php echo $_SESSION['cod_usu']; ?>">
                                    <input type="hidden" name="vsuc" 
                                           value="<?php echo $_SESSION['cod_suc']; ?>">
                                    <input type="hidden" name="vestado" value="ACTIVO">
                                    <input type="hidden" name="vfecha" value="<?php echo $fecha[0]['fecha'] ?>">
                                    <input type="hidden" name="vtimb" value="<?php echo $timbradoo[0]['cod_timbrado'] ?>">
                                    <input type="hidden" name="pagina" value="notaremision_fact_detalle.php">

                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                        <div class="col-md-4 " >
                                            <label  class="control-label col-md-2"><h3>FECHA|SALIDA:</h3></label>
                                            <input type="date" required="" placeholder="Ingrese fecha" id="fechasalida" onchange="validarsalida(), validarllegada()" onkeyup="validarsalida(), validarllegada()"
                                                   class="form-control" name="vsali" value="<?php echo $fecha[0]['fecha'] ?>">
                                        </div>
                                        <div class="col-md-4 " >
                                            <label  class="control-label col-md-1"><h3>FECHA|LLEGADA:</h3></label>
                                            <input type="date" required="" placeholder="Ingrese fecha" id="fechallegada" onkeyup="validarllegada()" onchange="validarllegada()"
                                                   class="form-control" name="vllega" value="<?php echo $fecha[0]['fecha'] ?>">
                                        </div>



                                    </div>
                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                       
                                        <div class="col-md-4 " >
                                            <label  class="control-label col-md-1"><h3>VIGENCIA:</h3></label>
                                            <input type="date" required="" placeholder="Ingrese fecha" 
                                                   class="form-control" readonly=""value="<?php echo $timbradoo[0]['fecha_fin'] ?>">
                                        </div>

                                        <div class="col-md-4 " >
                                            <label  class="control-label col-md-2"><h3>SUCURSAL:</h3></label>
                                            <input type="text" required="" placeholder="Ingrese fecha" readonly=""
                                                   class="form-control" value="<?php echo $_SESSION['suc_descri'] ?>">
                                        </div>


                                    </div>
                                   
                                    <span class="col-md-1"></span>

                                    <div class="form-group">
                                        <div class="col-md-4" >
                                            <label  class="control-label col-md-2"><h3>FACTURA:</h3></label>
                                            <select  required="" class="form-control"   name="vfact" id="facturaa" 
                                                     onchange="cliente()"
                                                     onkeyup="cliente()"> 
                                                <!--                                                <option  value="0">Seleccione una compra</option>-->

                                                <?php
                                                $facturas = consultas::get_datos("select * from v_factura_cab where cod_factura NOT IN(select cod_factura from nota_remision_venta where estado_not_remi != 'ANULADO') and"
                                                                . " cod_suc=" . $_SESSION['cod_suc']
                                                                . " and ven_estado ='CONFIRMADO' "
                                                                . "order by cod_factura");
                                                ?> 
                                                <?php
                                                if (!empty($facturas)) {
                                                    foreach ($facturas as $factura) {
                                                        ?>
                                                        <option  value="<?php echo $factura['cod_factura']; ?>">
                                                            <?php echo $factura['cod_factura'] . " - " . $factura['nro_factura'] ;?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="0">No hay facturas confirmadas</option>
                                                <?php } ?>
                                            </select>
                                        </div>


                                        <div class="col-md-4">
                                            <label  class="control-label col-md-3"><h3>CLIENTE:</h3></label>
                                            <select class="form-control"  required="" name="vclie" id="detalles" >
                                                <option  value="0">Seleccione un cliente</option>
                                                <?php $clientes = consultas::get_datos("select * from v_clientes "); ?> 
                                                <?php foreach ($clientes as $cliente) { ?>
                                                    <option value="<?php echo $cliente['id_cliente']; ?>"><?php echo $cliente['cliente']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                       
                                    </div>

                                    <br>
                                   
                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                        <div class="col-md-4 " >
                                            <label  class="control-label col-md-2"><h3>TIMBRADO:</h3></label>
                                            <input type="text" required="" placeholder="Ingrese fecha" readonly="" 
                                                   class="form-control" value="<?php echo $timbradoo[0]['nro_timbrado'] ?>">
                                        </div>

                                        
                                  <div class="col-md-4 " >
                                            <label  class="control-label col-md-2"><h3>NOTACREDITO:</h3></label>
                                            <input type="text" required="" placeholder="Ingrese fecha" readonly=""
                                                   class="form-control" name="vnroremi" value="<?php echo $siguientefactu[0]['siguientefacturaremision'] ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <span class="col-md-1"></span>
                                        
                                        <div class="col-md-4"style="display: block" id="oculdescuento">
                                            <label class="col-md-2 control-label"><h3>MOTIVO|NOTA:</h3></label>
                                            <input type="text"  id="descrip" onkeyup="sololetras()" onchange="sololetras()"
                                                   placeholder="Ingrese Descripcion"
                                                   class="form-control" value="VENTA"
                                                   name="vmotivo" pattern="[A-Za-z #SPACE]{4,30}" >

                                        </div>
                                        <div class="col-md-4">
                                            <label class="col-md-2 control-label"><h3>KMS|APROX.</h3></label>
                                            <input type="number" id="chap"
                                                   placeholder="Ingrese Distancia de recorrido"
                                                   class="form-control" 
                                                   name="vkm">

                                        </div>
                                        
<!--                                        <div class="row">
                                            <div seclass="radio col-md-12">
                                                <label class="col-md-2 control-label" >MOTIVO:</label>

                                                <input  required="" type="radio"  name="vmotiv"  value="VENTA" checked=""id="check"  > VENTA

                                                <BR>
                                                <input  required="" type="radio"  name="vmotiv" value="0" id="check_1"> OTROS

                                            </div>
                                        </div>                                  

                                        <span class="col-md-1"></span>-->


                                    </div>
                                    
                                    <div class="form-group">
                                        <span class="col-md-1"></span>

                          
                                    <div class="col-md-3">
                                        <label class="col-md-2 control-label"><h3>CONDUCTOR</h3></label>
                                        <?php
                                        $personas = consultas::get_datos(" select * from v_funcionario WHERE cod_carg = 11"
                                                        . " order by cod_fun");
                                        ?>                                 
                                        <select  required=""name="vpers" onchange="elegir()" id="personal" class="form-control">
<!--                                            <option value="">Seleccione un funcionario</option>-->
                                            <?php
                                            if (!empty($personas)) {
                                                foreach ($personas as $persona) {
                                                    ?>
                                                    <option value="<?= $persona['cod_fun']; ?>">
                                                        <?= $persona['persona']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>

                                            <?php } ?>
                                        </select>
                                    </div>
                                    
                                  
                           
                                      

                                        <div class="col-md-3">
                                            <label class="col-md-2 control-label"><h3>RUA</h3></label>
                                            <input type="text" required="" id="chap"
                                                   placeholder="Ingrese Registro Unico del Automotor"
                                                   class="form-control" onchange="solo_chapa()" onkeyup="solo_chapa()"
                                                   name="vchap">

                                        </div>  
                                        <div class="col-md-4">
                                            <label control-label class="col-md-3 "><h3>VEHICULO</h3></label>
                                            <select required="" name="vmarc" class="form-control select"  >
<!--                                                <option value="">Seleccione una marca de vehiculo</option>-->
                                                <?php
                                                $marcas = consultas::get_datos("select * from v_vehiculos ");
                                                ?>                                 

                                                <?php
                                                if (!empty($marcas)) {
                                                    foreach ($marcas as $marca) {
                                                        ?>
                                                        <option  value="<?php echo $marca['cod_marc_vehi']; ?>">
                                                            <?php echo $marca['descri_marca'] . " - " . $marca['descri']; ?> </option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="">Debe insertar una un Vehiculo</option>
                                                <?php } ?>
                                            </select>
                                        </div> 
<!--                                        <a   href="marca_vehiculo_index.php" class="btn btn-xs btn- pull-right" rel='tooltip' data-title="REGISTRAR VEHICULO" >
                                            <span class="fa fa-plus col-md-3"></span></a>-->
                                    </div>  

                                    

                                    <br>
                                    <br>



                                    <div class="modal-footer">
                                        <button type="reset" data-dismiss="modal" class="btn btn-default pull-left">
                                            <i class="fa fa-close"></i> Cerrar</button>
                                        <button type="submit" class="btn btn-primary pull-right">
                                            <i class="fa fa-floppy-o"></i> Registrar</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

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
        </div>


        <!--archivos js-->  
        <?php require 'menu/js.ctp'; ?>




        <script>
            $("document").ready(function () {
                cliente();
                calsubtotall;
                costo();

            });

            function anular(datos) {
                var dat = datos.split("_");
                $('#si').attr('href',
                        'nota_remision_fact_control.php?vremi=' + dat[0] +
                        '&vusu=null' +
                        '&vsuc=null' +
                        '&vfact=null' +
                        '&vclie=null' +
                        '&vfecha=1900-01-01' +
                        '&vmotiv=null' +
                        '&vnroremi=null' +
                       '&vsali=1900-01-01' +
                        '&vllega=1900-01-01' +
                        '&vestado=ANULADO' +
                        '&vpers=null' +
                        '&vmarc=null' +
                        '&vtimb=null' +
                        '&vchap=null' +
                        '&accion=2' +
                        '&pagina=nota_remision_fact.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
           Desea anular la nota de remision');
            }
            function confirmar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href',
                        'nota_remision_fact_control.php?vremi=' + dat[0] +
                        '&vusu=null' +
                        '&vsuc=null' +
                        '&vfact=null' +
                        '&vclie=null' +
                        '&vfecha=1900-01-01' +
                        '&vmotiv=null' +
                        '&vnroremi=null' +
                       '&vsali=1900-01-01' +
                        '&vllega=1900-01-01' +
                        '&vestado=CONFIRMADO' +
                        '&vpers=null' +
                        '&vmarc=null' +
                        '&vtimb=null' +
                        '&vchap=null' +
                        '&accion=4' +
                        '&pagina=nota_remision_fact.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
           Desea Confirmar la nota de remision');
            }
            function validarvigencia() {

                var hoyy = new Date($('#fechasis').val());
                var hoy = new Date($('#desde').val());
                var fechaFormulario = new Date($('#vigencia').val());
                if (fechaFormulario < hoy) {

                    notificacion('Atencion', 'Fecha inferior a la fecha !!!', 'window.alert(message);');
    //                    $('#desde').val(hoyy);
                    $('#vigencia').val(hoy);
                } else {

                }
            }
            function validarsalida() {

                var hoy = new Date($('#desde').val());
                var fechaFormulario = new Date($('#fechasalida').val());
                if (fechaFormulario < hoy) {

                    notificacion('Atencion', 'Fecha inferior a la fecha !!!', 'window.alert(message);');
    //                    $('#desde').val(hoy);
                    $('#fechasalida').val(hoy);
                } else {

                }
            }
            function validarllegada() {

                var hoy = new Date($('#fechasalida').val());
                var fechaFormulario = new Date($('#fechallegada').val());
                if (fechaFormulario < hoy) {

                    notificacion('Atencion', 'Fecha inferior a la fecha !!!', 'window.alert(message);');
    //                    $('#desde').val(hoy);
                    $('#fechallegada').val(hoy);
                } else {

                }
            }
            function solo_timbrado() {
                var numero = document.getElementById("timbrad").value;
                if (numero.match(/^-?[0-9]+(\.[0-9](1,2))?$/))
                {

                } else {
                    notificacion('Atencion', 'No se permiten letras o espacios ', 'window.alert(message);');
    //                    notificacion("Solo numeros");
                    document.getElementById("timbrad").value = "";

                }
            }
            function solo_cii() {
                var numero = document.getElementById("cii").value;
                if (numero.match(/^-?[0-9]+(\.[0-9](1,2))?$/))
                {

                } else {
                    notificacion('Atencion', 'No se permiten letras o espacios ', 'window.alert(message);');
    //                    notificacion("Solo numeros");
                    document.getElementById("cii").value = "";

                }
            }
            function solo_telefo() {
                var numero = document.getElementById("tel").value;
                if (numero.match(/^-?[0-9]+(\.[0-9](1,2))?$/))
                {

                } else {
                    notificacion('Atencion', 'No se permiten letras o espacios ', 'window.alert(message);');
    //                    notificacion("Solo numeros");
                    document.getElementById("tel").value = "";

                }
            }
            function solo_chapa() {
    //                      var numero = trim(numero);
                var numero = document.getElementById("chap").value;
                if (numero.length === 0 || numero === " ") {
                    notificacion('Atencion', 'No se permiten campos vacios', 'window.alert(message);');

                    document.getElementById("chap").value = "Sin Chapa";


                } else {

                }
            }
            function solo_conduc() {
    //                      var numero = trim(numero);
                var numero = document.getElementById("conduc").value;
                if (numero.length === 0 || numero === " ") {
                    notificacion('Atencion', 'No se permiten campos vacios', 'window.alert(message);');

                    document.getElementById("conduc").value = "Sin Nombre";


                } else {

                }
            }
            function solo_remision() {
                var numero = document.getElementById("remisi").value;
                if (numero.match(/^-?[0-9--]+(\.[0-9--](1,2))?$/))
                {

                } else {
                    notificacion('Atencion', 'No se permiten letras o espacios ', 'window.alert(message);');
    //                    notificacion("Solo numeros");
                    document.getElementById("remisi").value = "";

                }
            }
            function sololetras() {
    //                      var numero = trim(numero);
                var numero = document.getElementById("descrip").value;
                if (numero.length === 0 || numero === " ") {
                    notificacion('Atencion', 'No se permiten campos vacios', 'window.alert(message);');
                    document.getElementById("descrip").value = "";


                } else {

                }
            }
            function cliente() {

                if ((parseInt($('#facturaa').val()) > 0) || ($('#facturaa').val() === "") || ($('#facturaa').val() !== "")) {
                    $.ajax({
                        type: "GET",
                        url: "/servitech_tesis/lista_cliente_debito_fact.php?vfact=" + $('#facturaa').val(),
                        cache: false,
                        beforeSend: function () {
                            $('#detalles').html('<img src="/servitech_tesis/img/cargando.GIF">  \n\
                          <strong><i>Cargando...</i></strong>');
                        },
                        success: function (msg) {
                            $('#detalles').html(msg);

                        }
                    });
                } else {
                    $("#facturaa").val('');

                }
            }

            $("#check").click(function () {
                $("#oculdescuento").css("display", "none");
                $("#descrip").val('');

            });


            $("#check_1").click(function () {
                $("#oculdescuento").css("display", "block");
            });



        </script>



    </body>
</html>
