<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon"  href=" img/logo_negro.ico"/>    
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SERVITECH - DETALLE COMPRA</title>

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
                        <h3 class="page-header text-center">DETALLES DE COMPRAS

                            <a href="compra_directa_index.php" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Atras" >
                                <i class="glyphicon glyphicon-arrow-left"></i>
                            </a>  

                        </h3>
                    </div>     

                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                DATOS CABECERA
                            </div>
                            <?php
                            $compras = consultas::get_datos("select * from  v_compras"
                                            . " where cod_comp=" . $_REQUEST['vdetcompra'] .
                                            "order by cod_comp asc");
                            if (!empty($compras)) {
                                ?> 

                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table width="100%"
                                               class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">FECHA. COMPRA</th>  
                                                    <th class="text-center">NRO.FACTURA</th>  
                                                    <th class="text-center">PROVEEDOR</th>
                                                    <th class="text-center">USUARIO</th>
                                                    <th class="text-center">CONDICION</th>         
                                                    <th class="text-center">TOTAL</th>  
                                                    <th class="text-center">CANT.CUOTA</th>
                                                    <th class="text-center">ESTADO</th> 
                                                    

                                                </tr>
                                            </thead>

                                            <?php foreach ($compras as $compra) { ?> 
                                                <tr>
                                                    <td class="text-center"><?php echo $compra['cod_comp']; ?></td>
                                                    <td class="text-center"><?php echo $compra['vfecha']; ?></td>
                                                    <td class="text-center"><?php echo $compra['nro_factura']; ?></td>
                                                    <td class="text-center"><?php echo $compra['persona']; ?></td>
                                                    <td class="text-center"><?php echo $compra['usuario']; ?></td>
                                                    <td class="text-center"><?php echo $compra['com_condicion']; ?></td>
                                                    <td class="text-center"><?php echo number_format($compra['total'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo $compra['cant_cuo']; ?></td>
                                                    <td class="text-center"><?php echo $compra['com_estado']; ?></td>
                                                    

                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            <?php } else { ?>
                                <div class="col-md-12">
                                    <div class="alert alert-info alert-dismissable">
                                        <button type="button" class="close"
                                                data-dismiss="alert" aria-hidden="true">&times;
                                        </button>
                                        <strong>Numero de factura repetido del mismo proveedor, favor verificar....!</strong>
                                    </div>
                                </div>
                            <?php } ?> 

                        </div>

                      
                    </div>
                    <!-- COMIENZO PARA EL DETALLE COMPRA-->
                          
                    <?php  if (isset($_REQUEST['vdetcompra'])) { ?>
                    <?php $detcompras = consultas::get_datos
                    ("select * from v_detcompras where cod_comp=" . $_REQUEST['vdetcompra'] . " order by cod_art asc");?>
                    
                
                    
                        <div class="col-md-12">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                Detalles de Compra
                            </div>
                            <?php if (!empty($detcompras)) { ?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Articulos</th>
                                                <th>Cantidad</th>
                                                <th>Precio Compra</th>
                                                <th>Subtotal</th>
                                                <th>Iva 5%</th>
                                                <th>Iva 10%</th>
                                                
                                                <th>Plazo - Garantia</th>
                                                <th>Estado</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($detcompras as $detcompra) { ?>
                                                <tr>
                                                    <td><?php echo $detcompra['cod_art']; ?></td>
                                                    <td><?php echo $detcompra['dato_articulo']; ?></td>
                                                    <td><?php echo $detcompra['det_cantidad']; ?></td>
                                                    <td><?php echo number_format($detcompra['det_prec_comp'], 0, ',', '.'); ?></td>
                                                    <td><?php echo number_format($detcompra['subtotal'], 0, ',', '.'); ?></td>
                                                    <td><?php echo number_format($detcompra['iva_5'], 0, ',', '.'); ?></td>
                                                    <td><?php echo number_format($detcompra['iva_10'], 0, ',', '.'); ?></td>
                                                    
                                                    <td><?php echo $detcompra['plazo_garantia']." - ".$detcompra['garantia_descri']; ?></td>
                                                    <td><?php echo $detcompra['det_estado']; ?></td>
                                                    
                                                        <?php if ($detcompra['det_estado']=='CONFIRMADO' || $compra['com_estado'] == 'ACTIVO') { ?> 
                                                        <td class="text-center"> 
                                                            <a onclick="borrar(<?php
                                                            echo "'" . $detcompra['cod_comp'] . "_" .
                                                            $_REQUEST['vdetcompra'] . "_" .
                                                            $_REQUEST['vped'] . "_" .
                                                            $_REQUEST['vorden'] . "_" .
                                                            $detcompra['cod_art'] . "_" .
                                                            $detcompra['det_cantidad'] . "_" .
                                                            $detcompra['det_prec_comp'] . "_" .
                                                            $detcompra['cod_dep'] . "_" .
                                                            $detcompra['det_estado'] . "'";
                                                            ?>)"
                                                                                    class="btn btn-xs btn-danger"
                                                                                    ret='tooltip' data-title="Borrar"
                                                                                    data-toggle='modal'
                                                                                    data-target='#delete'>
                                                                <span class="glyphicon glyphicon-trash">
                                                                </span></a>
                                                        </td>
                                                    <?php } else { ?>
                                                    <?php } ?>
                                                
                                                </tr>
                                                
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } else { ?>
                                    <div class="col-md-12">
                                        <div class="alert alert-dismissable alert-dismissable">
                                            <button type="button" class="close"
                                                    data-dismiss="alert" aria-hidden="true">&times;
                                            </button>
                                            <strong>No se encontraron detalles de compras....!</strong>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
    
                
                     <?php } else { ?>
                                    
                            <?php } ?>

                                  <!-- COMIENZO PARA EL IMPUESTO-->
                          
                    <?php  if (isset($_REQUEST['vdetcompra'])) { ?>
                    <?php $detcompras = consultas::get_datos
                    ("select * from v_detcompras_calculo_iva where cod_comp=" . $_REQUEST['vdetcompra']);?>
                    
                
                    
                        <div class="col-md-12">
                        <div class="panel panel-heading">
                          
                            <?php if (!empty($detcompras)) { ?>
                            <div class="panel-heading text-center">
                                 <h4><strong> DETALLE DEL IVA</strong></h4>
                            </div>
                                <div class="table-responsive">
                                    <table class="table table-striped alert-success">
                                        <thead>
                                            <tr>
                                                
                                                <th class="text-center">Total IVA 5%</th>
                                                <th class="text-center">Total IVA 10%</th>
                                                <th class="text-center">Total EXENTA</th>
                                                <th class="text-center">Total IVAS </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($detcompras as $detcompra) { ?>
                                                <tr>
                                                    <td class="text-center"><?php echo number_format($detcompra['total_iva5'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detcompra['total_iva10'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detcompra['total_exenta'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detcompra['total_ivas'], 0, ',', '.'); ?></td>
                                                    
                                                </tr>
                                                
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } else { ?>

                            <?php } ?>
                        </div>
    
                </div>
                <?php } else { ?>
<!--                                    
               <?php } ?>

                        <!--IVA-->
                        <!--compra-->
                        <div class="col-lg-12">
                            <?php if (isset($compras[0]['cod_comp'])) { ?>
                                <?php if ($compra['com_estado'] == 'ACTIVO') { ?> 
                               
                                <div class="panel-body">


                                    <form action="compra_directa_detalle_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                        <div class="panel-body">
                                            <input name="accion" value="1" type="hidden"/>
                                            <input type="hidden" name="pagina" value="compra_directa_agregar.php">
                                            <input type="hidden" name="vdetcompra" value="<?php echo $_REQUEST['vdetcompra'] ?>">
                                            <input type="hidden" name="vestado" value="CONFIRMADO">
                                            <input type="hidden"  id="subtotal" name="vsubt" value="0">

                                            <div class="text-center" ><h4><strong>REGISTRAR DETALLE DE COMPRAS</strong></h4></div>
                                            <hr>
                                            <span class="col-md-4"></span>
                                            <div class="form-group">
                                                        <div class="col-md-3">
                                                            <span class="col-md-3"></span>
                                                            <label class="col-md-1 control-label">GARANTIA:</label>
                                                            <select name="vgarantia" class="form-control"
                                                                    id="vgarantia" onchange="tiposelect1(),tiposelect2(),tiposelect3(),tiposelect4() ">
                                                                <option value="CON">CON GARANTIA</option>
                                                                <option value="SIN">SIN GARANTIA</option>
                                                            </select>
                                                        </div>
                                                <a   href="articulos_index.php"  class=" btn btn-info btn-microsoft pull-right" rel='tooltip' data-title="REGISTRAR ARTICULO" >
                                                    <span class="fa fa-plus col-md-3"></span></a>
                                            </div>

                                            
                                            <div class="form-group">

                                                <div class="col-md-4">
                                                    <label class="col-md-1 control-label">ARTICULO</label>
                                                    <select class="form-control select2" id="art" name="varti"
                                                            onchange="depositopedi()">

                                                        <?php
                                                        $articulos = consultas::get_datos("select * from v_articulos_2 where cod_tipo_arti <> 7 and cod_tipo_arti <> 8 "
                                                                        . " order by cod_art");
                                                        ?>                                 

                                                        <?php
                                                        if (!empty($articulos)) {
                                                            foreach ($articulos as $articulo) {
                                                                ?>
                                                                <option  value="<?php echo $articulo['cod_art']; ?>">
                                                                    <?php echo $articulo['dato_articulo']; ?></option>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>

                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                
                                                
                                                <div class="col-md-3" id="detalless">
                                                    <label class="col-md-1 control-label">DEPOSITO:</label>

                                                    <select class="form-control" required>
                                                        <option value="">Seleccione un deposito</option>
                                                    </select>
                                                </div>
                                               
                                                <div class="col-md-2">
                                                    <label class="col-md-2 control-label">CANTIDAD:</label>
                                                    <input  id="canti" type="number" required="" 
                                                            placeholder="Especifique Cantidad"
                                                            class="form-control" min="1" 
                                                            required  name="vcant"
                                                            onkeyup="nronegativo(), calsubtotal()"
                                                            onchange="nronegativo(), calsubtotal()"
                                                            onmouseup="calsubtotal()"
                                                            pattern="[0-9]{1,100}"title="La cantidad debe ser minimamente 1"
                                                            minlength="1" maxlength="100" 
                                                            value="1" >

                                                </div>
                                                <div class="col-md-3"> 
                                                    <label class="col-md-2 control-label">PRECIO:</label>
                                                    <input   type="number" required="" id="prec"
                                                             placeholder="Especifique precio"
                                                             class="form-control"
                                                             required min="100"  name="vprecio"
                                                             onkeyup="nronegativo2(), calsubtotal()"
                                                             onchange="nronegativo2(), calsubtotal()"
                                                                onmouseup="calsubtotal()"
                                                             value="0">
                                                </div>
                                                
                                            </div>
                                            <div class="form-group">
                                                
                                                
                                            </div>
                                            
                                                
                                     <span class="col-md-2"></span>
                                    <div class="form-group" style="display: block" id="plazo_garantia">
                                        <div class="col-md-3 "> 
                                            <label class="col-md-1 control-label">PLAZO|GARANTIA:</label>
                                            <input   type="number" required="" id="plazo"
                                                     placeholder="Especifique precio" 
                                                     class="form-control" 
                                                     onkeyup="nronegativo2()"
                                                    onchange="nronegativo2()" 
                                                     required min="30" max="365" name="vplazo_garan"
                                                     value="30">
                                        </div>
                                        
                                        
                                        <div class="col-md-5">
                                            <label class="col-md-2 control-label">DESCRIPCION|GARANTIA:</label>
                                            <input  id="canti" type="text" required=""
                                                    placeholder="Especifique descripcion de garantia"
                                                    class="form-control" name="vdescri_garan"
                                                    value="Unicamente Reparacion o Cambio del Producto"
                                                    autofocus="">

                                        </div>
                                        
                                    </div>
                                    
                                    <span class="col-md-2"></span>
                                    <div class="form-group" style="display: block" id="condicion_garan">
                                        <div class="col-md-8"> 
                                            
                                            <label class="col-md-1 control-label text-center">CONDICION|GARANTIA:</label>
                                            <input   type="text" required="" id="condicion"
                                                     placeholder="Especifique condiciones de garantia"
                                                     class="form-control" name="vcondi_garan"
                                                     value="Respetar manual del vendedor -Factura sin Modificacion -Tiempo Limite -Prohibida la Reparacion no autorizada -No incluye devolucion de dinero">
                                        </div>
                                        
                                    </div>
                                            <span class="col-md-4"></span>
                                                    <div class="form-group">
                                                        <div class="col-md-4"> 
                                                            <span class="col-md-3"></span>
                                                            <label class="col-md-1 control-label"><h3>SUBTOTAL:</h3></label>

                                                            <input  id="subtotal_pedi" name="vsubt" type="number" required="" readonly=""
                                                                    placeholder="Especifique Subtotal"
                                                                    class="form-control" min="1" value="0">
                                                        </div>

                                                    </div>
                                   

                                            
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-offset-5 col-md-10">
                                                    <button class="btn btn-success"
                                                            type="submi"><i class=" fa fa-floppy-o">
                                                        </i>Grabar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                <?php } else { ?>

                                <?php } ?>
                                     <?php } ?> 

                            </div>
                        </div>
                        </div>
                        </div>
                    </div>
                    <!--compra-->
                </div>

            </div>
        </div>
        <!--confirmar-->

        <!--fin de confirmar-->



        <!--            sino fin-->
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

    <!--archivos js-->  
    <?php require 'menu/js.ctp'; ?>




    <script>
        function editar(datos) {
            var dat = datos.split("_");
            $('#cod').val(dat[0]);
            $('#art').val(dat[1]);
            $('#canti').val(dat[2]);
            console.log(dat[2]);
        }


        function editarORDEN(datos) {
            var dat = datos.split("_");
            $('#codi').val(dat[0]);
            $('#arti').val(dat[1]);
            $('#cantid').val(dat[2]);
            $('#preci').val(dat[3]);
            console.log(dat[2]);
        }


        $("document").ready(function () {
            deposito();
            depositopedi();
            // console.log($('#arti').val());
        });

        function deposito() {
            if (parseInt($('#arti').val()) > 0) {
                $.ajax({
                    type: "GET",
                    url: "/servitech_tesis/lista_deposito.php?varti=" + $('#arti').val(),
                    cache: false,
                    beforeSend: function () {
                        $('#detalles').html('<img src="/servitech_tesis/img/cargando.GIF">  \n\
                          <strong><i>Cargando...</i></strong>');
                    },
                    success: function (msg) {
                        $('#detalles').html(msg);

                    }
                });
                $('#articuloocultoo').val($('#arti').val());

            }

        }



        function depositopedi() {
            if (parseInt($('#art').val()) > 0) {
                console.log($('#art').val());
                $.ajax({
                    type: "GET",
                    url: "/servitech_tesis/lista_deposito_1.php?varti=" + $('#art').val(),
                    cache: false,
                    beforeSend: function () {
                        $('#detalless').html('<img src="/servitech_tesis/img/cargando.GIF">  \n\
                          <strong><i>Cargando...</i></strong>');
                    },
                    success: function (msg) {
                        $('#detalless').html(msg);

                    }
                });
                $('#articulooculto').val($('#art').val());
            }

        }

        function borrar(datos) {
            var dat = datos.split("_");
            $('#si').attr('href',
                    'compra_detalle_control_1.php?vdetcompra=' + dat[1] +
                    '&vped=' + dat[2] +
                    '&vorden=' + dat[3] +
                    '&vdetcompra=' + dat[0] +
                    '&varti=' + dat[4] +
                    '&vcant=' + dat[5] +
                    '&vprecio=' + dat[6] +
                    '&vdepo=' + dat[7] +
                    '&vestado=' + dat[6] +
                    '&accion=3' +
                    '&pagina=compra_detalle_1.php');
            $('#confirmacion').html
                    ('<span class="glyphicon glyphicon-warning-sign"></span>\n\
               Desea borrar el detalle?');
        }



 //PARA GARANTIA PEDIDO
            function tiposelect1(){
               if (document.getElementById('vgarantia').
                        value === "CON") {
                    $("#plazo_garantia").css("display", "block");
                }
            }
            window.onload = tiposelect1();
            
             function tiposelect2(){
               if (document.getElementById('vgarantia').
                        value === "CON") {
                    $("#condicion_garan").css("display", "block");
                }
            }
            window.onload = tiposelect2();
              
            function tiposelect3(){
                if (document.getElementById('vgarantia').
                       value === "SIN") {
                     $("#plazo_garantia").css("display", "none");
                }
           }
            window.onload = tiposelect3();
            
           function tiposelect4(){
                if (document.getElementById('vgarantia').
                       value === "SIN") {
                     $("#condicion_garan").css("display", "none");
                }
           }
            window.onload = tiposelect4();
       
          function calsubtotal() {
                $('#subtotal_pedi').val(parseInt($('#prec').val()) * parseInt($('#canti').val()));
            }
            
            
            function nronegativo() {

                var numero = document.getElementById("canti").value;
                if (numero.match(/^-?[0-9]+(\.[0-9]{1,2})?$/))
                {
//                    alert("numero ok");
                }
                else
                {
                    notificacion('Atencion','Ingrese su numero sin puntos, letras ni espacios', 'mensaje');
                    document.getElementById("canti").value = "";
                }
            }
            
             function nronegativo2() {

                var numero = document.getElementById("prec").value;
                if (numero.match(/^-?[0-9]+(\.[0-9]{1,2})?$/))
                {
//                    alert("numero ok");
                }
                else
                {
                    notificacion('Atencion','Ingrese su numero sin puntos, letras ni espacios', 'mensaje');
                    document.getElementById("prec").value = "";
                }
            }



    </script>

</body>
</html>

