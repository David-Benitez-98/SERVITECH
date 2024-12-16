<!DOCTYPE html>

<html lang="es">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>SERVITECH S.A</title>
        <?php
        require './ver_sesion.php';
        
        ?>
        <!-- Bootstrap Core CSS -->
        <link href="./vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="./vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="./dist/css/sb-admin-2.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="./vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <style>
            body{
                
                background:  #000\9
            }
        </style>
    </head>
    
    <body>
        
    <div id="wrapper">
            <?php require 'menu/navbar.php'; ?> <!--BARRA DE HERRAMIENTAS -->
            
<!--            INICIO    DESCUENTO-->
              <!--  pregunta si la fecha fin  ya vencio-->
                          <?php    $descuentoss = consultas::get_datos("select cod_desc_servi from descuento_servicio where fecha_fin < current_date AND estado <> 'ANULADO' AND cod_suc=".$_SESSION['cod_suc']); ?>

                        <?php  if (!empty($descuentoss)){ ?>
                                 <!-- si ya vencio la promocion cambia el estado de la promo a inactiva -->
                        <?php foreach ($descuentoss as $key => $value) {
                                 $sql= "update descuento_servicio set estado = 'INACTIVO' where cod_desc_servi =".$value['cod_desc_servi']; 
                                 $res = consultas::get_datos($sql);
                             } ?>
                        
                        <?php }?>
                        
<!--                        pregunta si la fecha inicio ya empezo-->
                        
                         <?php    $descuentosss = consultas::get_datos("select cod_desc_servi from descuento_servicio where fecha_ini = current_date and estado <> 'ANULADO' AND cod_suc=".$_SESSION['cod_suc']); ?>
                        
                        <?php  if (!empty($descuentosss)){ ?>
                                
                        <?php foreach ($descuentosss as $key => $value) {
                                 $sql= "update descuento_servicio set estado = 'ACTIVO' where cod_desc_servi =".$value['cod_desc_servi']; 
                                 $res = consultas::get_datos($sql);
                             } ?>
                        
                        <?php }?>
<!--                  FIN DESCEUNTO      -->
<!--             INICIO   PROMOCIONES-->
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
<!--                FIN PROMOCIONES-->


                     <?php    $timbrados = consultas::get_datos("select cod_timbrado from timbrado where fecha_fin < current_date and estado <> 'ANULADO' AND cod_suc=".$_SESSION['cod_suc']); ?>
<!--                        si ya vencio la promocion cambia el estado de la promo a inactiva -->
                        <?php  if (!empty($timbrados)){ ?>
                                
                        <?php foreach ($timbrados as $key => $value) {
                                 $sql= "update timbrado set estado = 'INACTIVO' where cod_timbrado =".$value['cod_timbrado']; 
                                 $res = consultas::get_datos($sql);
                             } ?>
                        
                        <?php }?>
                        
<!--                        pregunta si la fecha inicio ya empezo-->
                        
                         <?php    $timbrados = consultas::get_datos("select cod_timbrado from timbrado where "
                                 . "fecha_inicio = current_date and estado <> 'ANULADO' AND cod_suc=".$_SESSION['cod_suc']); ?>
                        
                        <?php  if (!empty($timbrados)){ ?>
                                
                        <?php foreach ($timbrados as $key => $value) {
                                 $sql= "update timbrado set estado = 'ACTIVO' where cod_timbrado =".$value['cod_timbrado'] ; 
                                 $res = consultas::get_datos($sql);
                             } ?>
                        
                        <?php }?>
                        
             <?php $fecha = consultas::get_datos("select * from v_fecha") ?>
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1><i><?php echo $fecha[0]['fecdate'];  ?></i></h1>
                    </div>
                    <h3 class="page-header"><i> Area de Compras!</i></h3>
                </div>

                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"></div>
                                        <div>Listado de Compras!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="/servitech_tesis/compra_index.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Vista de los Detalles</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-truck fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"></div>
                                        <div>Proveedores!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="/servitech_tesis/proveedor_index.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Registar Nuevo Proveedor</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-balance-scale fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"></div>
                                        <div>Compras!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="/servitech_tesis/compra_directa_index.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Registrar Compras Directas</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-dollar fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"></div>
                                        <div>Ctas a Pagar!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="/servitech_tesis/ctaspagar_index.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Listado de Cuentas a Pagar!</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!--        VENTAS-->

<!--            <div id="page-wrapper">-->
                <div class="row">
<!--                    <div class="col-lg-12">-->
                        <h3 class="page-header"><i> Area de Ventas!</i></h3>
                    </div>

                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list-ul fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"></div>
                                        <div>Listado de Ventas!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="/servitech_tesis/facturacion.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Vista de las Facturaciones</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa  fa-group fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"></div>
                                        <div>Clientes!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="/servitech_tesis/cliente_index.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Registar Nuevo Cliente</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-warning">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-shopping-cart fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"></div>
                                        <div>Notas!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="/servitech_tesis/nota_credito_factura.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Registrar Notas de Credito</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa  fa-github-alt fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"></div>
                                        <div>Ctas a Cobrar!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="/servitech_tesis/ctascobrar_index.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Listado de Cuentas a Cobrar!</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
          <!--            </div>-->
            </div>
            
            <div id="page-wrapper">
            </div>
       </div>
        
        <!-- jQuery -->
        <script src="./vendor/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="./vendor/metisMenu/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="./dist/js/sb-admin-2.js"></script>


     </body>
</html>



