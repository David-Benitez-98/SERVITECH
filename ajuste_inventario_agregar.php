<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon"  href=" img/logo_negro.ico"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SERVITECH</title>

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
                        <h3 class="page-header text-center">DATOS DEL AJUSTE PRODUCTOS
                            <a href="ajuste_inventario_index.php" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel='tooltip' title="Atras">
                                <i class="glyphicon glyphicon-arrow-left"></i>
                            </a> 

                        </h3>
                    </div>     
                    <!--Buscador-->

                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-success">
                           <div class="panel-heading">
                                CABECERA AJUSTE
                            </div>
                            
                            
                           <?php
                           $ajustes = consultas::get_datos("select * from  v_ajuste_productos"
                                        . " where cod_ajuste=" . $_REQUEST['vajuste'] .
                                        "order by cod_ajuste asc");
                           
                              ?>                         
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table width="100%"
                                           class="table table-bordered">
                                        <thead>
                                                   <tr>
                                         <th class="text-center">#</th>
                                                    <th class="text-center">SUCURSAL</th>                                        
                                                    <th class="text-center">FUNCIONARIO</th>                                        
                                                    <th class="text-center">FECHA</th>                                        
                                                    <th class="text-center">ESTADO</th>  
                                                </tr>
                                            </thead>
                                        
                                                <?php foreach ($ajustes as $ajuste) { ?> 
                                                <tr>
                                                           <td class="text-center"><?php echo $ajuste['cod_ajuste']; ?></td>
                                                        <td class="text-center"><?php echo $ajuste['suc_descri']; ?></td>
                                                        <td class="text-center"><?php echo $ajuste['usuario']; ?></td>
                                                        <td class="text-center"><?php echo $ajuste['vfecha']; ?></td>
                                                        <td class="text-center"><?php echo $ajuste['estado']; ?></td>
                                                          
                                                        </tr>
                                                    
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>                         
                                </div>
                            </div>
                        </div>
                        <!-- comienzo para el detalle-->
                        <?php
                        $ajustedetas = consultas::get_datos
                                        ("select * from  v_detalle_ajuste"
                                        . " where cod_ajuste=" . $_REQUEST['vajuste'] .
                                        "order by cod_ajuste asc");
                        ?>
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                Detalle del Ajuste
                            </div>
                            <?php if (!empty($ajustedetas)) { ?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                               <th class="text-center">#</th>
                                                <th class="text-center"> ARTICULO</th>
                                                <th class="text-center"> IMAGEN</th>
                                                <th class="text-center"> DEPOSITO</th>
                                                <th class="text-center"> SUCURSAL</th>
                                                <th class="text-center"> MOTIVO</th>
                                                <th class="text-center"> DESCRIPCION</th>
                                                <th class="text-center"> CANT.FISICA ACTUAL</th>
                                                <th class="text-center"> CANT.LOGICA ANTERIOR</th>
                                                
                                              
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($ajustedetas as $ajustedeta) { ?>
                                                <tr>
                                                     <td class="text-center"><?php echo $ajustedeta['cod_ajuste']; ?></td>
                                                    <td class="text-center"><?php echo $ajustedeta['art_descri']; ?></td>
                                                    <td class="text-center"> 
                                                    <img height="45px" src="img/<?php echo $ajustedeta['art_imagen'];?>" /> </td>
                                                    <td class="text-center"><?php echo $ajustedeta['dep_descri']; ?></td>
                                                    <td class="text-center"><?php echo $ajustedeta['suc_descri']; ?></td>
                                                    <td class="text-center"><?php echo $ajustedeta['motivo_ajuste']; ?></td>
                                                    <td class="text-center"><?php echo $ajustedeta['descri_motivo']; ?></td>
                                                    <td class="text-center"><?php echo $ajustedeta['canti_fisica_actual']; ?></td>
                                                    <td class="text-center"><?php echo $ajustedeta['canti_logica_anterior']; ?></td>
                                                    
                                                 
                                                </tr>
                                    <?php } ?>
                                        </tbody>
                                    </table>
<?php } else { ?>
                                    <div class="col-md-12">
                                        <div class="alert alert-info
                                             alert-dismissable">
                                            <button type="button" class="close"
                                                    data-dismiss="alert" aria-hideden="true">&times;
                                            </button>
                                            <strong>No se encontraron detalles para el ajustes....!</strong>
                                        </div>
                                    </div>
<?php } ?>
                            </div>
                        </div>
                    
                    <div class="col-lg-12">
                        <div class="panel-body">
                           
                            <form action="ajuste_inventario_control_deta.php" method="get"
                                  role="form" class="form-horizontal">
                                <input type="hidden" name="accion" value="1">
                                <input type="hidden" name="vajuste" value="<?php echo $_REQUEST['vajuste'] ?>">
                                <input type="hidden" name="vsuc" id="vsuc" value="<?php echo $_SESSION['cod_suc'] ?>">
                                 <input type="hidden" name="pagina" value="ajuste_inventario_agregar.php">
                                 
                          <?php      if($ajustes[0]['estado']=='ANULADO' || $ajuste['estado']=='CONFIRMADO') {?>
                            
                            <?php } else { ?>
                                 
                              <div class="form-group">
                                    <label class="col-md-1 control-label">DEPOSITO:
                                    </label>
                                    <div class="col-md-4">
                                        <?php $depositos = consultas::get_datos("select * from deposito "
                                                . " where cod_suc= ".$_SESSION['cod_suc']. " order by cod_dep asc ");
                                        ?>
                                        <select name="vdep"
                                                class="form-control" id="depo" required=""
                                                onchange="articulo()"
                                                onkeyup="articulo()">
<!--                                            <option value="">Seleccione un deposito</option>-->
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
                                                <option value="0">Debe insertar un Deposito</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                
                                      <label class="col-md-2 control-label">ARTICULOS:</label>
                                      <div class="col-md-4" id="detalles">
                                          <select class="form-control" required="">
                                              <option>Seleccione un articulo</option>
                                          </select>
                                      </div>
                                  
                                </div>   
                                 <BR>
                                 
                                     <div class="form-group">
                                
                                    <label class="col-md-1 control-label">DESCRIPCION:</label>
                                    <div class="col-md-4">
                                 <select name="vdescri" class="form-control"
                                            id="vcondicion" onchange="tiposelect();">
                                            <option value="ESTUVO EXTRAVIADO">ESTUVO EXTRAVIADO</option>
                                            <option value="NO EXISTE">NO EXISTE</option>
                                            <option value="REVISION DESPUES DE COMPRAS">REVISION DESPUES DE COMPRAS</option>
                                            <option value="REVISION DESPUES DE VENTAS">REVISION DESPUES DE VENTAS</option>
                                            <option value="ROBO O HURTO">ROBO O HURTO</option>
                                            <option value="REVISION DE RUTINA">REVISION DE RUTINA</option>
                                      </select>
                                        
                                    </div>
                                       <div class="form-group">
                                    <div class="row">
                                        <div class="radio col-md-5">
                                            <label class="col-md-4 control-label"><strong>MOTIVO:</strong></label>
                                            <span class="text-center"></span>
                                            <span class="text-center"></span>
                                            <label>
                                                <input  required=""type="radio" name="vmotivo" id="entrada" value="ENTRADA" checked=""> ENTRADA
                                            </label>
                                            <BR>
                                            <label>
                                                <input  required=""type="radio" name="vmotivo" id="salida" value="SALIDA"> SALIDA
                                            </label>                                       
                                        </div>
                                    </div>                                  
                                </div>   
                                         
                                  
                          </div>
                            <div class="form-group">
                                
                                <label class="col-md-1 control-label">Cant. Logica:</label>
                                <div class="col-md-4" id="detalle_cantidad">
                                    <input type="number" 
                                           placeholder="Cantidad en Stock"
                                           class="form-control"
                                           name="vcant_logica" readonly="">
                                </div>
                                
                                 <label class="col-md-2 control-label">Cant. Fisica:</label>
                                    <div class="col-md-4">
                                        <input type="number" required=""
                                               placeholder="Especifique Cantidad"
                                               class="form-control"
                                               min="1"  name="vcant" id="cant"
                                               value="0" 
                                               onchange="stock()"
                                         >
                                                
                                    </div>
                                 
                             </div>
                           
                                 
                                <br>
                                <?php if($ajuste['estado']=='ANULADO' || $ajuste['estado']=='CONFIRMADO'){ ?>
                                
                                 <?php } else { ?>
                                <div class="form-group">
                                    <div class="col-md-offset-5 col-md-10">
                                        <button class="btn btn-success"
                                                type="submit"><i class=" fa fa-floppy-o">
                                            </i>Grabar</button>
                                    </div>
                                </div>
                                <?php   } ?>
                                <?php   } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

             borrar
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
             
     function stock() {
                    //var aux = $("#salida").val();
                    //var aux_sal = $("#entrada").val();
                    //console.log(aux);
                    
                    var radio = $('input[name="vmotivo"]:checked').val();
                    
                    var cant = parseInt($('#cantstock_prueba').val());
                     //console.log($('#cant').val());
                    
                    if (radio === 'SALIDA'){ // === "DIFERENCIA"
                        //console.log('aqui')
                        if ((parseInt($('#cant').val()) >= cant)) {
                            alert ('LA CANTIDAD DE SALIDA DEBE SER MENOR AL STOCK');
                            $('#cant').val('0');
                            
                        }
                        
                    }else if (radio === 'ENTRADA'){
                        if ((parseInt($('#cant').val()) <= cant)) {
                            alert ('LA CANTIDAD ENTRADA DEBE SER MAYOR AL STOCK');
                            $('#cant').val('0');
                        }
                    }else{
                        if ((parseInt($('#cant').val()) === cant)) {
                            alert ('LA CANTIDA FISICA NO PUEDE SER IGUAL AL STOCK');
                            $('#cant').val('0'); 
                        }
                    }
            }

</script>
 <script>
     
     
            
 
//    function borrar(datos) {
//        var dat = datos.split("_");
//        $('#si').attr('href',
//        'pedido_detalle_control.php?vdetped=' + dat[1] +
//               '&varti=' + dat[2]+
//                '&vcant=' + dat[3]+
//                '&vestado=' + dat[4]+
//                '&accion=3' +
//                '&pagina=pedido_detalle_agregar.php');
//        $('#confirmacion').html
//        ('<span class="glyphicon glyphicon-warning-sign"></span>\n\
//        Desea borrar el detalle?');
//    }
    
                $("document").ready(function () {
                    articulo();
                });
                function articulo(){
                    if (parseInt($('#depo').val()) > 0) {
                        $.ajax({
                            type: "GET",
                            url: "/servitech_tesis/lista_articulos_deposito.php?vdep=" + 
                                    $('#depo').val (),
                            cache: false,
                            beforeSend: function () {
                                $('#detalles').
                            html('<img src="/servitech_tesis/img/cargando.GIF">\n\
                            <strong><i>Cargando...</i><strong>');
                            },
                                    success: function (msg){
                                        $('#detalles').html(msg);
                                        obtenerprecio();
                                    }
                        });
                    }
                }
                
                function obtenerprecio(){
                    var dat = $('#artic').val().split("_");
                    if (parseInt($('#artic').val()) > 0) {
                        $.ajax({
                            type: "GET",
                            url: "/servitech_tesis/lista_cantidad_articulos2.php?varti=" +  dat[0] + '&vdep=' +
                                    $('#depo').val (),
                            cache: false,
                            beforeSend: function () {
                                $('#detalle_cantidad').
                            html('<img src="/servitech_tesis/img/cargando.GIF">\n\
                            <strong><i>Cargando...</i><strong>');
                            },
                                    success: function (msg){
                                        $('#detalle_cantidad').html(msg);
                                        $('#cant').select();
                                        
                                    }
                        });
                    }
                        
                }
    
</script>


    
    
    </body>
</html>
