<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon"  href=" img/logo_negro.ico"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SERVITECH SYS - RECAUDACIONES</title>

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
                        <h3 class="page-header text-center"><strong>LISTADO DE RECAUDACION A DEPOSITAR</strong>
                                                 
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
                            $recaudaciones = consultas::get_datos("select * from v_recaudacion "
                                         . " where cod_suc=".$_SESSION['cod_suc']. " order by cod_recaudacion asc ");
                            if (!empty($recaudaciones)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#Rec</th> 
                                                    <th class="text-center">APERTURA</th>
                                                    <th class="text-center">CAJERO</th>
                                                     <th class="text-center">SUCURSAL</th>
                                                    <th class="text-center">CAJA</th>
                                                    <th class="text-center">EFECTIVO</th>
                                                    <th class="text-center">CHEQUE</th>
                                                    <th class="text-center">TOTAL RECAUDADO</th>
                                                    <th class="text-center">FECHA</th>
                                                    <th class="text-center">ESTADO</th>
                                                    <th class="text-center">ACCION</th>
                                                   
<!--                                                    <th class="text-center">Acciones</th>-->
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($recaudaciones as $recaudacione) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $recaudacione['cod_recaudacion']; ?></td>
                                                        <td class="text-center"><?php echo $recaudacione['ape_nro']; ?></td>
                                                        <td class="text-center"><?php echo $recaudacione['usuario']; ?></td>
                                                         <td class="text-center"><?php echo $recaudacione['suc_descri']; ?></td>
                                                        <td class="text-center"><?php echo "Nro:  ".$recaudacione['caj_cod']." - CAJA: ".$recaudacione['caj_descri']; ?></td>
                                                        
                                                        <td class="text-center"><?php echo number_format($recaudacione['monto_efectivo'], 0, ',', '.'); ?></td>
                                                        <td class="text-center"><?php echo number_format($recaudacione['monto_tarjeta'], 0, ',', '.'); ?></td>
                                                        <td class="text-center"><?php echo number_format($recaudacione['total_recaudacion'], 0, ',', '.'); ?></td>
                                                        <td class="text-center"><?php echo $recaudacione['fecha']; ?></td>
                                                        <td class="text-center"><?php echo $recaudacione['estado_recaudacion']; ?></td>
                                                         <td class="text-center">
                                                              <?php if($recaudacione['estado_recaudacion']=='CANCELADO'){ ?>
                                                                
                                                           <?php }else{?>   
                                                            <?php if($recaudacione['estado_recaudacion']=='DEPOSITADO'){ ?>
                                                                
                                                           <?php }else{?> 
                                                            
<!--                                                        <a onclick="pagar(<?php echo "'".$recaudacione['cod_recaudacion']."_".
                                                                    $recaudacione['total_recaudacion']."'"; ?>)" 
                                                               class="btn btn-xs btn-success" rel='tooltip' data-title="Confirmar Deposito"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-ok-sign"></span></a>-->
<!--                                                              
-->                                                             <a href="recaudacion_depositar.php?vcod=<?php echo $recaudacione['cod_recaudacion']; ?>"
                                                                   target="_blank"
                                                                   class="btn btn-xs btn-warning"
                                                                   rel="tooltip" data-title="imprimir">
                                                                    <span class="glyphicon glyphicon-print"></span></a>
                                                             
                                                              
                                                           
                                                       </td>
                                                    </tr>
                                             
                                                <?php } ?>
                                                <?php } ?>
                                                <?php } ?>
                                            </tbody>
                                        </table>                         
                                    </div><!--
                                <?php } else { ?>
                                    <div class="alert alert-info alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <strong>No se encontraron registros....!</strong>
                                    </div>
                                <?php } ?>  
                                <!-- /.panel-body -->
                            </div>
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
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
        <!--archivos js-->  
        <?php require 'menu/js.ctp'; ?>


   
    </body>
</html>