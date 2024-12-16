<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon"  href=" img/logo_negro.ico"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SERVITECH SYS - DETALLE FACTURA</title>

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
                   
                    <h3 class="text-center"><strong>DETALLES DE FACTURA</strong>
                            <a href="facturacion.php" 
                               class="btn btn-primary btn-microsoft pull-right" 
                               rel='tooltip' title="Atras">
                                <i class="glyphicon glyphicon-arrow-left"></i>
                            </a>
                            
                        </h3>
                   
                      
                    <h3 class="page-header"><strong>Datos de Factura Cabecera</strong>
                           
                             <a data-toggle="modal" data-target="#registrar" 
                               class="btn btn-info btn-microsoft pull-right" 
                               rel="tooltip" data-title="Registrar">
                                <i class="fa fa-plus"></i>
                               </a> 

                        </h3>
                     
                    <!--Buscador-->

                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                               <h4> <strong> DATOS CABECERA</strong> </h4>
                            </div>
                            <?php
                            $facturas = consultas::get_datos("select * from v_factura_cab where cod_factura=" .
                                            $_REQUEST ['vdetcod'] . " order by cod_factura asc ");
                            ?>                         
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table width="100%"
                                           class="table table-bordered">
                                        <thead>
                                            <tr class="primary-font">
                                                <th class="text-center">#</th>                             
                                                    <th class="text-center">NRO. FACTURA</th>
                                                    <th class="text-center">CLIENTE</th>
    <!--                                                    <th class="text-center">NRO.APERTURA</th>-->
                                                    <th class="text-center">SUCURSAL</th>                                        
                                                    <th class="text-center">USUARIOS</th> 
                                                    <th class="text-center">TIMBRADO</th>
                                                    <th class="text-center">FECHA</th>
                                                    <th class="text-center">CONDICION</th>
                                                    <th class="text-center">CUOTA</th>
                                                    <th class="text-center">SERVICIO|VIGEN</th>
                                                    <th class="text-center">TOTAL</th>
                                                    <th class="text-center">ESTADO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($facturas as $factura) { ?> 
                                                <tr>
                                                    <td class="text-center"><?php echo $factura['cod_factura']; ?></td>
                                                        <td class="text-center"><?php echo $factura['nro_factura']; ?></td>
                                                        <td class="text-center"><?php echo $factura['cliente']; ?></td>
                                                        <td class="text-center"><?php echo $factura['suc_descri']; ?></td>
                                                        <td class="text-center"><?php echo $factura['usuario']; ?></td>
        <!--                                                          <td class="text-center"><?php echo $factura['ape_nro'] . "-" . $factura['vfecha_cierre']; ?></td>-->
                                                        <td class="text-center"><?php echo $factura['nro_timbrado']; ?></td>
                                                        <td class="text-center"><?php echo $factura['fecha']; ?></td>
                                                        <td class="text-center"><?php echo $factura['ven_condicion']; ?></td>
                                                        <td class="text-center"><?php echo $factura['cant_cuo']; ?></td>
                                                        <td class="text-center"><?php echo $factura['cod_presu_servi'] . "  -  " . $factura['vfecha_vigen'] ?></td>
                                                        <td class="text-center"><?php echo number_format($factura['ven_total'], 0, ',', '.'); ?></td>

                                                        <td class="text-center"><?php echo $factura['ven_estado']; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>                         
                                </div>
                            </div>
                        </div>

                        <!-- comienzo para el detalle de COMPRA-->

                        <?php
                        $detanotas = consultas::get_datos
                                        ("select * from  v_det_factura_iva"
                                        . " where cod_factura=" . $_REQUEST['vdetcod'] .
                                        "order by cod_factura asc");
                        ?>


                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h4> <strong> DETALLE DE FACTURA</strong> </h4>
                            </div>
                            <?php if (!empty($detanotas)) { ?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#Fac-#Det</th>
                                                <th class="text-center"> ITEM</th>
                                                <th class="text-center"> IMG</th>
                                                <th class="text-center"> CANT</th>
                                                <th class="text-center"> PREC</th>
                                                <th class="text-center"> SERVICIO</th>
                                                <th class="text-center"> MONTO|SERV</th>
                                                <th class="text-center"> SUBTOTAL</th>
                                                <th class="text-center"> IVA 5</th>
                                                <th class="text-center"> GRAB 5</th>
                                                <th class="text-center"> IVA 10</th>
                                                <th class="text-center"> GRAB 10</th>
                                                <th class="text-center"> PLAZO|GARAN</th>
                                                <th class="text-center"> RECLAMO</th>
                                                <th class="text-center"> ESTADO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($detanotas as $detanota) { ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $detanota['cod_factura'] . "  -  " . $detanota['cod_deta_factu']; ?></td>
                                                    <td class="text-center"><?php echo $detanota['dato_articulo']; ?></td>
                                                    <td class="text-center"> 
                                                         <img height="40px" src="img/<?php echo $detanota['art_imagen'];?>" /> </td>
                                                    <td class="text-center"><?php echo number_format($detanota['det_cantidad'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detanota['det_precio_unit'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo $detanota['descri_servicio']; ?></td>
                                                    <td class="text-center"><?php echo number_format($detanota['monto_servicio'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detanota['subtotal'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detanota['iva_5'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detanota['gravada_5'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detanota['iva_10'] + $detanota['iva_10_servi']  , 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detanota['gravada_10'] + $detanota['gravada_10_servi'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo $detanota['plazo_garantia'] . "  " . $detanota['garantia_descri']; ?></td>
                                                    <td class="text-center"><?php echo $detanota['plazo_reclamo']." dias"; ?></td>
                                                    <td class="text-center"><?php echo $detanota['det_estado']; ?></td>
<!--                                                    <th class="text-center">
                                                        <a onclick="borrar(<?php
                                                        echo "'" . $_REQUEST['vdetcod'] . "_" .
                                                        $detanota['cod_art'] . "_" .
                                                        $detanota['cod_dep'] . "_" .
                                                        $detanota['cod_tipo_servi'] . "_" .
                                                        $detanota['cod_deta_factu'] . "_" .
                                                        $detanota['cod_equipo'] . "_" .
                                                        $_REQUEST['vpresu'] . "'";
                                                        ?>)"
                                                           class="btn btn-xs btn-danger"
                                                           ret='tooltip' data-title="Borrar"
                                                           data-toggle='modal'
                                                           data-target='#delete'>
                                                            <span class="glyphicon glyphicon-trash">
                                                            </span></a>
                                                    </th>-->

                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } else { ?>
                                    <div class="col-md-12">
                                        <div class="alert alert-info alert-dismissable">
                                            <button type="button" class="close"
                                                    data-dismiss="alert" aria-hidden="true">&times;
                                            </button>
                                            <strong>No se encontraron detalles de la factura....!</strong>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    
                    
                    
                        <?php if (isset($_REQUEST['vdetcod'])) { ?>
                            <?php $detanotas = consultas::get_datos("select * from v_det_factura_iva_total where  cod_factura= " . $_REQUEST ['vdetcod']); ?>

                        <?php } ?> 

                        <div class="panel-body">

                            <?php if (!empty($detanotas)) {
                                ?>   
                                <div class="panel-heading text-center">
                                    <h4> <strong> DETALLES DEL IVA</strong></h4>
                                </div>


                                <div class="table-responsive">
                                    <div>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">TOTAL IVA 5</th>
                                                    <th class="text-center">TOTAL  IVA 10</th>
                                                    <th class="text-center">TOTAL EXENTA</th>
                                                    <th class="text-center">TOTAL IVA</th>

                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($detanotas as $detanota) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo number_format($detanota['total_iva5'], 0, ',', '.'); ?></td>
                                                        <td class="text-center"><?php echo number_format($detanota['total_iva10'], 0, ',', '.'); ?></td>
                                                        <td class="text-center"><?php echo number_format($detanota['total_exenta'], 0, ',', '.'); ?></td>
                                                        <td class="text-center"><?php echo number_format($detanota['total_ivas'], 0, ',', '.'); ?></td>


                                                    </tr>

                                                <?php } ?>
                                            </tbody>
                                        </table>  

                                    <?php } else { ?>

                                    <?php } ?>

                                </div>
                            </div>
                    <?php if (isset($facturas[0]['cod_presu_servi'])) { ?>
                        <?php if (isset($_REQUEST['vpresu'])) { ?>
                            <?php $detapresus = consultas::get_datos("select * from v_deta_presu_servi where estado= 'TERMINADO' and cod_presu_servi= " . $_REQUEST ['vpresu']); ?>

                        <?php } ?> 
                    <?php } ?> 


                    <div class="panel-body">


                        <?php if ($factura['ven_estado'] == 'ACTIVO') { ?> 
                            <?php if (!empty($detapresus)) {
                                ?>   
                                <div class="panel-heading alert-info">

                                    DETALLE DEL SERVICIO 
                                </div>
                                <!-- /.panel-heading -->

                                <div class="table-responsive">
                                    <!--                                    <div>-->
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Repuesto</th>
                                                <th class="text-center">Imagen</th>
                                                <th class="text-center">Cant Rep</th>
                                                <th class="text-center">Prec Rep</th>
                                                <th class="text-center">Equipo</th>
                                                <th class="text-center">Tipo Serv</th>
                                                <th class="text-center">Prec Serv</th>
                                                <th class="text-center">Desc/Prom</th>
                                                <th class="text-center">Monto Serv</th>
                                                <th class="text-center">Sub</th>
                                                <th class="text-center">Plazo Reclamo</th>
                                                <th class="text-center">Estado</th>
<!--                                                <th class="text-center">Acción</th>-->
                                                </tr>
                                        </thead>
                                        <tbody class="buscar">
                                            <?php foreach ($detapresus as $detapresu) { ?> 
                                                <tr>

                                                    <td class="text-center"><?php echo $detapresu['cod_art']; ?></td>
                                                    <td class="text-center"><?php echo $detapresu['art_descri']; ?></td>
                                                    <td class="text-center"> 
                                                        <img height="45px" src="img/<?php echo $detapresu['art_imagen'];?>" /> </td>
                                                    <td class="text-center"><?php echo $detapresu['cantidad_arti']; ?></td>
                                                    <td class="text-center"><?php echo number_format($detapresu['precio'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo $detapresu['dat_equipo']; ?></td>
                                                    <td class="text-center"><?php echo $detapresu['descri_servicio']; ?></td>
                                                    <td class="text-center"><?php echo number_format($detapresu['precio_tipo_servi'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detapresu['total_desc_y_promo'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detapresu['monto_servi'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detapresu['subtotal'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo $detapresu['plazo_reclamo']." dias"; ?></td>
                                                    <td class="text-center"><?php echo $detapresu['estado']; ?></td>

                                                    <td class="text-center">
                                                        <?php if ($factura['ven_estado'] == 'ACTIVO') { ?>  
                                                                       
                                                            <a onclick="confirmar(<?php
                                                            echo "'" . $_REQUEST['vdetcod'] . "_" .
                                                            $detapresu['cod_tipo_servi'] . "_" .
                                                            $detapresu['cod_art'] . "_" .
                                                            $detapresu['cod_dep'] . "_" .
                                                            $detapresu['cod_equipo'] . "_" .
                                                            $detapresu['precio'] . "_" .
                                                            $detapresu['cantidad_arti'] . "_" .
                                                            $detapresu['subtotal'] . "_" .
                                                            $detapresu['monto_servi'] . "_" .
                                                            $_REQUEST ['vpresu'] . "'"
                                                            ?>)"
                                                               class="btn btn-xs btn-success" rel='tooltip' data-title="CONFIRMAR"
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

                                <?php } else { ?>

                                <?php } ?>

                            </div>
                        <?php } else { ?>
                        <?php } ?>
                    </div>


                                <!--compra-->
                        
                            <?php if (isset($facturas[0]['cod_factura'])) { ?>
                                <?php if ($factura['ven_estado'] == 'ACTIVO') { ?> 
                               
                                 <div id="registrar" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg ">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header alert-success">
                            <button type="button" class="close" 
                                    data-dismiss="modal" arial-label="Close">x</button>
                            <h4 class="modal-title"><strong>REGISTRAR ARTICULO</strong></h4>
                        </div>
                                    <form action="fact_det_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                        <div class="panel-body">
                                            <input name="accion" value="1" type="hidden"/>
                                            <input type="hidden" name="pagina" value="fact_detalle.php">
                                            <input type="hidden" name="vdetcod" value="<?php echo $_REQUEST['vdetcod'] ?>">
                                            <input type="hidden" name="vpresu" value="<?php echo $_REQUEST['vpresu'] ?>">
                                            <input type="hidden" name="vestado" value="ACTIVO">
                                            <input type="hidden" name="vid" value="0">
                                             <input type="hidden" name="vserv" value="0">
                                         

<!--                                            <span class="col-md-1"></span>-->
                                      <div class="form-group">
                                    <label class="col-md-1 control-label">Deposito:
                                    </label>
                                    <div class="col-md-3">
                                        <?php $depositos = consultas::get_datos("select * from deposito where cod_dep = 1");
                                        ?>
                                        <select name="vdepo"
                                                class="form-control" id="depo" required=""
                                                onchange="articulo()"
                                                onkeyup="articulo()">
<!--                                            <option value="0">Seleccione un deposito</option>-->
                                            <?php
                                            if (!empty($depositos)) {
                                                foreach ($depositos as $deposito) {
                                                    ?>
                                                    <option
                                                        value="<?php echo $deposito['cod_dep']; ?>">
                                                            <?php echo $deposito['dep_descri']; ?>
                                                    </option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
<!--                                                <option value="">Debe insertar un Deposito</option>-->
                                            <?php } ?>
                                        </select>
                                    </div>
                                          
                               
                                    <label class="col-md-1 control-label">Articulo:</label>
                                    <div class="col-md-7" id="detayes">
                                        <select class="form-control" required="">
                                            <option value="0">Seleccione un Articulo  </option>
                                        </select>
                                    </div>
                                </div>
<!--                                   <a   href="articulo_index.php"  class=" col-md-2 btn btn-xs btn- pull-right" rel='tooltip' data-title="REGISTRAR ARTICULO" >
                                                    <span class="fa fa-plus col-md-3"></span></a>-->
                                           
<bR>
<bR>
<!--                                            <span class="col-md-1"></span>-->
                                      <div class="form-group">
                                    <label class="col-md-1 control-label">Precio Unit:</label>
                                    <div class="col-md-3" id="precioo">
                                        <input type="text" required=""
                                               placeholder="Precio del Articulo"
                                               class="form-control"
                                               name="vprecio" readonly=""
                                                onkeyup="calsubtotal()"
                                               onmouseup="calsubtotal()"
                                               onchange="calsubtotal()"
                                               >
                                    </div>
                             
                                    <label class="col-md-1 control-label">Cantidad:</label>
                                    <div class="col-md-3">
                                        <input type="number" required=""
                                               placeholder="Especifique Cantidad"
                                               class="form-control"
                                               required min="1"  name="vcant"
                                               id="cantiar" value="0"
                                               onkeyup=" stockar(),calsubtotal()"
                                               onclick="stockar()"
                                               onkeypress="stockar()"
                                               onmouseup="calsubtotal()"
                                               onchange="calsubtotal()" >

                                    </div>
                                    
                                    <label class="col-md-1 control-label">Subtotal:</label>
                                    <div class="col-md-3">
                                        <input type="number" required=""
                                               class="form-control"
                                               name="vsubt" readonly=""
                                               id="subto" value="0"
                                               >

                                    </div>
                                </div>
<br>
<hr>
                                <span class="col-md-1"></span>
                                    <div class="form-group">
                                        <div class="col-md-5 " id="plazo"> 
                                            <span class="col-md-3"></span>
                                            <label class="col-md-1 control-label"><h3>Plazo|Garantia:</h3></label>
                                            <input   type="number"  readonly=""
                                                     placeholder="Especifique precio" 
                                                     class="form-control"  
                                                    name="vplazo_garan">
                                        </div>
                                        
                                        
                                        <div class="col-md-5" id="descri_garan">
                                            <span class="col-md-3"></span>
                                            <label class="col-md-2 control-label"><h3>Descripcion|Garantia:</h3></label>
                                            <input   type="text" 
                                                    placeholder="Especifique descripcion de garantia"
                                                    class="form-control" name="vdescri_garan"
                                                    autofocus="">

                                        </div>
                                        
                                    </div>
                                    
                                    <span class="col-md-1"></span>
                                    <div class="form-group" >
                                        <div class="col-md-12" id="condicion"> 
                                            <span class="col-md-5"></span>
                                            <label class="col-md-1 control-label text-center"><h3>Condicion|Garantia:</h3></label>
                                            <input   type="text" 
                                                     placeholder="Especifique condiciones de garantia"
                                                     class="form-control" name="vcondi_garan">
                                        </div>
                                        
                                    </div>
                                                 <div class="modal-footer">
                                    
                                    <button type="reset" data-dismiss="modal" class="btn btn-default pull-left">
                                        <i class="fa fa-close"></i> CERRAR</button>
                                     <button type="submit" class="btn btn-primary pull-right">
                                        <i class="fa fa-refresh"></i> REGISTRAR</button>
                                       
                            </div>
                            </div>
                                 
                        </form>
                    </div>
                </div>
            </div>
                                    

                                <?php } else { ?>

                                <?php } ?>
                                     <?php } ?> 

                    
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

                                    <div class="alert alert-success" id="confirmacion"></div>

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
                             //calsubtotal();
                                articulo();
                                
                                
                            });
                     function articulo(){
                    if (parseInt($('#depo').val()) > 0) {
                        $.ajax({
                            type: "GET",
                            url: "/servitech_tesis/lista_articulos_fact.php?vdepo=" + 
                                    $('#depo').val (),
                            cache: false,
                            beforeSend: function () {
                                $('#detayes').
                            html('<img src="/servitech_tesis/img/cargando.GIF">\n\
                            <strong><i>Cargando...</i><strong>');
                            },
                                    success: function (msg){
                                        $('#detayes').html(msg);
                                             obtenerprecio();
                                             obtenerplazo();
                                             obtenerdescripcion();
                                             obtenercondicion();
                                    }
                        });
                    }
                }
                
                  function obtenerprecio(){
//                    var dat = $('#artic').val().split("_");
                    if (parseInt($('#artic').val()) > 0) {
                        $.ajax({
                            type: "GET",
                            url: "/servitech_tesis/lista_precios_fact.php?varti=" + $('#artic').val ()+ '&vdepo=' +
                                    $('#depo').val (),
                            cache: false,
                            beforeSend: function () {
                                $('#precioo').
                            html('<img src="/servitech_tesis/img/cargando.GIF">\n\
                            <strong><i>Cargando...</i><strong>');
                            },
                                    success: function (msg){
                                        $('#precioo').html(msg);
                                        $('#cantiar').val('0');
                                    //    calsubtotal();
                                    }
                        });
                    }
                        
                }
                function obtenerplazo(){
//                    var dat = $('#artic').val().split("_");
                    if (parseInt($('#artic').val()) > 0) {
                        $.ajax({
                            type: "GET",
                            url: "/servitech_tesis/lista_plazo_garantia_fac.php?varti=" + $('#artic').val ()+ '&vdepo=' +
                                    $('#depo').val (),
                            cache: false,
                            beforeSend: function () {
                                $('#plazo').
                            html('<img src="/servitech_tesis/img/cargando.GIF">\n\
                            <strong><i>Cargando...</i><strong>');
                            },
                                    success: function (msg){
                                        $('#plazo').html(msg);
                                    //    calsubtotal();
                                    }
                        });
                    }
                        
                }
                function obtenerdescripcion(){
//                    var dat = $('#artic').val().split("_");
                    if (parseInt($('#artic').val()) > 0) {
                        $.ajax({
                            type: "GET",
                            url: "/servitech_tesis/lista_descri_garantia_fac.php?varti=" + $('#artic').val ()+ '&vdepo=' +
                                    $('#depo').val (),
                            cache: false,
                            beforeSend: function () {
                                $('#descri_garan').
                            html('<img src="/servitech_tesis/img/cargando.GIF">\n\
                            <strong><i>Cargando...</i><strong>');
                            },
                                    success: function (msg){
                                        $('#descri_garan').html(msg);
                                    //    calsubtotal();
                                    }
                        });
                    }
                        
                }
                
                function obtenercondicion(){
//                    var dat = $('#artic').val().split("_");
                    if (parseInt($('#artic').val()) > 0) {
                        $.ajax({
                            type: "GET",
                            url: "/servitech_tesis/lista_condicion_garantia.php?varti=" + $('#artic').val ()+ '&vdepo=' +
                                    $('#depo').val (),
                            cache: false,
                            beforeSend: function () {
                                $('#condicion').
                            html('<img src="/servitech_tesis/img/cargando.GIF">\n\
                            <strong><i>Cargando...</i><strong>');
                            },
                                    success: function (msg){
                                        $('#condicion').html(msg);
                                    //    calsubtotal();
                                    }
                        });
                    }
                        
                }
                
            function calsubtotal() {
//                var dat = $('#artic').val().split("_");
                $('#subto').val(parseInt($('#precio2').val()) * parseInt($('#cantiar').val()));
              
            }
            
                 function stockar() {
                    var cant = parseInt ($('#cantstock').val());
                    var canti = parseInt ($('#cantiar').val());
                    if (canti > 0){
                        if (parseInt ($('#cantiar').val()) > cant) {
                             notificacion('Atencion','SOLO HAY ' + cant +
                                                ' UNIDADES DE ESTE ARTICULO', 'window.alert(message);');
                            $('#cantiar').val('0');
//                            calsubtotal();
                        }
                    }else{
                        $('#cantiar').val(''); {
                            notificacion('Atencion','NO PUEDE ESTAR VACIO  ','window.alert(message);');
//                                       
                        }
//                        calsubtotal();
                    }
                }
    
                                function notacredi(datos) {
                                var dat = datos.split("_");
                                $('#cod').val(dat[0]);
                                $('#ser').val(dat[1]);
                                $('#servic').val(dat[2]);
                                $('#cant').val(dat[3]);
                                $('#prec').val(dat[4]);
                                $('#total').val(dat[5]);
                                $('#estado').val(dat[6]);
                                $('#cantidad').val(dat[7]);
                             
//                                calsubtotal();
                            }
                //
//                            function calsubtotal() {
//                                $('#total').val(parseInt($('#cant').val()) * parseInt($('#prec').val()));
//                                
//                            }

//                window.onload = calsubtotal();
                            function stock() {
                                var cant = parseInt($('#cant').val());
                                var canti = parseInt($('#cantidad').val());
                                if (cant > 0) {
                                    if (parseInt($('#cantidad').val()) < cant) {
                                        notificacion('Atencion','SOLO HAY ' + canti +
                                                'UNIDADES DE ESTE SERVICIO', 'window.alert(message);');
                                        $('#cant').val(canti);
                
                                    }
                                } else {
                                    $('#cant').val('1');
                                    calsubtotal;
                                    {
                                        notificacion('Atencion','NO PUEDE ESTAR VACIO O TENER VALOR 0 ','window.alert(message);');
//                                        alert('NO PUEDE ESTAR VACIO O TENER VALOR 0 ');
                                    }
                
                                }
                            }
                
                
                            

                function borrar(datos) {
                    var dat = datos.split("_");
                    $('#si').attr('href',
                            'fact_det_control.php?vdetcod=' + dat[0] +
                            '&vserv=' + dat[3] +
                            '&varti=' + dat[1] +
                            '&vdepo=' + dat[2] +
                            '&vequi=' + dat[5] +
                            '&vprecio=null' +
                            '&vcant=null' +
                            '&vsubt=null' +
                            '&vestado=null' +
                            '&vid=' + dat[4] +
                            '&vmonto_ser=null'+
                            '&vpresu=' + dat[6] +
                            '&accion=3' +
                            '&pagina=fact_detalle.php');
                    $('#confirmacion').html
                            ('<span class="glyphicon glyphicon-warning-sign"></span>\n\
                   Desea Borrar el Detalle de Factura?');
                }
                
                function confirmar(datos) {
                    var dat = datos.split("_");
                    $('#si').attr('href',
                            'fact_det_control.php?vdetcod=' + dat[0] +
                            '&vserv=' + dat[1] +
                            '&varti=' + dat[2] +
                            '&vdepo=' + dat[3] +
                            '&vequi=' + dat[4] +
                            '&vprecio=' + dat[5] +
                            '&vcant=' + dat[6] +
                            '&vsubt=' + dat[7] +
                            '&vestado=ACTIVO' +
                            '&vid=null' +
                            '&vmonto_ser=' + dat[8] +
                            '&vpresu=' + dat[9] +
                            '&accion=1' +
                            '&pagina=fact_detalle.php');
                    $('#confirmacion').html
                            ('<span class="glyphicon glyphicon-warning-sign"></span>\n\
                    Desea Confirmar el Presupuesto del Servicio Terminado con un Subtotal de: <i><strong>' + dat[7] + '</strong></i>?');

                }


            </script>



    </body>
</html>
