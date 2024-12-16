<!DOCTYPE html>
<html>
    <head>
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
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <h3 class="page-header text-center">Registar Detalles - Notas de Remision
                            <a href="nota_remision_compra_index.php" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel='tooltip' title="Atras">
                                <i class="glyphicon glyphicon-arrow-left"></i>
                            </a> 
                        </h3>
                    </div>                       
                </div>
                <!--               Aqui empieza el cuerpo de la estructura-->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!--                        este panel headin le agregue yo -->
                        <div class=" panel panel-success">

                            <div class="panel-heading">
                                Datos Cabecera Notas Remision
                            </div> 
                            <div class="panel-body">

                                <?php if (isset($_REQUEST['vnota'])) { ?>
                                    <?php $remisioncompras = consultas::get_datos("select * from v_nota_remision_compra where cod_nota_remi_comp=" . $_REQUEST['vnota']); ?>
                                <?php } ?>

                                <!--                                    Aqui estaba el form -->
                                <?php if (!empty($remisioncompras)) {
                                    ?>                         
                                    <!-- /.panel-heading -->
                                    <div class="panel-body">
                                        <div>
                                            <table  width="100%" class="table table-striped table-bordered table-hover">
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
                                                        <th class="text-center">Estado</th>
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
                                                            <td class="text-center"><?php echo $remisioncompra['estado']; ?></td>

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
                        </div>
                        <!--                Aqui Termina la Estructura Cabecera-->

                        <!-- COMIENZO PARA EL DETALLE-->

                        <?php if (isset($remisioncompras[0]['cod_nota_remi_comp'])) { ?>
                            <?php $detaremisioncompras = consultas::get_datos("select * from v_deta_nota_remi_comp "
                                            . " where cod_nota_remi_comp = " . $_REQUEST['vnota']);
                            ?>  

<?php } ?>
                        <!-- /.col-lg-12 -->

                        <div class="col-lg-12">

                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    Detalles de Nota Remision
                                </div>
                                <?php if (!empty($detaremisioncompras)) { ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Articulos</th>
                                                    <th class="text-center">Imagen</th>
                                                    <th class="text-center">Cantidad</th>
                                                    <th class="text-center">Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($detaremisioncompras as $detaremisioncompra) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $detaremisioncompra['cod_art']; ?></td>
                                                        <td class="text-center"><?php echo $detaremisioncompra['datos_articulos']; ?></td>
                                                        <td class="text-center"> 
                                                            <img height="45px" src="img/<?php echo $detaremisioncompra['art_imagen']; ?>" /> </td>
                                                        <td class="text-center"><?php echo $detaremisioncompra['cantidad']; ?></td>
                                                        <td class="text-center"><?php echo $detaremisioncompra['estado']; ?></td>

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
                                                <strong>No se encontraron detalles para la nota de remision....!</strong>
                                            </div>
                                        </div>

<?php } ?>
                                </div>
                            </div>

                        </div>


                        <!-- COMIENZO PARA EL DETALLE DEL PRESUPUESTO-->
                        
                        
                        <?php if (isset($remisioncompras[0]['cod_comp'])) { ?>
                            <?php $detcompras = consultas::get_datos("select * from v_detcompras "
                                            . " where (det_estado='ACTIVO' or det_estado='CONFIRMADO/N') and cod_comp = " . $_REQUEST['vcodcomp']);
                            ?>  

<?php } ?>
                        <!-- /.col-lg-12 -->

                        <div class="col-lg-12">

                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    Detalles de la Compra
                                </div>
                            <?php if (!empty($detcompras)) { ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Articulos</th>
                                                    <th>Cantidad</th>
                                                    <th>Deposito</th>
                                                    <th>Precio</th>
                                                    <th>Iva 5%</th>
                                                    <th>Iva 10%</th>
                                                    <th>Subtotal</th>
                                                    <th>Estado</th>
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    <?php foreach ($detcompras as $detcompra) { ?>
                                                    <tr>
                                                        <td><?php echo $detcompra['cod_art']; ?></td>
                                                        <td><?php echo $detcompra['art_descri']; ?></td>
                                                        <td><?php echo $detcompra['det_cantidad']; ?></td>
                                                        <td><?php echo $detcompra['dep_descri']; ?></td>
                                                        <td><?php echo number_format($detcompra['det_prec_comp'], 0, ',', '.'); ?></td>
                                                        <td><?php echo number_format($detcompra['iva_5'], 0, ',', '.'); ?></td>
                                                        <td><?php echo number_format($detcompra['iva_10'], 0, ',', '.'); ?></td>
                                                        <td><?php echo number_format($detcompra['subtotal'], 0, ',', '.'); ?></td>
                                                        <td><?php echo $detcompra['det_estado']; ?></td>
                                                        <td class="text-center">

                                                            <?php if ($remisioncompras[0]['cod_comp'] == 'RECIBIDO CONFIRMADO') { ?>

                                                            <?php } else { ?>   

                                                                <a onclick="confirmar(<?php
                                                                echo "'" . $_REQUEST['vnota'] . "_" .
                                                                $detcompra['cod_art'] . "_" .
                                                                $detcompra['cod_dep'] . "_" .
                                                                $detcompra['det_cantidad'] . "_" .
                                                                $detcompra['art_descri'] . "_" .
                                                                $_REQUEST ['vcodcomp'] . "'"
                                                                ?>)"
                                                                   class="btn btn-xs btn-success" rel='tooltip' data-title="Confirmar"
                                                                   data-toggle="modal"
                                                                   data-target="#delete">
                                                                    <span class="glyphicon glyphicon-ok-sign"></span></a>

                                                                <!--                                                            <a href="#" class="btn btn-xs btn-primary" rel="tooltip" data-title="Imprimir"
                                                                                                                               <span class="glyphicon glyphicon-print"></span></a>-->
                                                            </td>
                                                        </tr>
                                            <?php } ?>
                                        <?php } ?>
                                            </tbody>
                                        </table>
<?php } else { ?>
                                        <div class="col-md-12">
                                            <div class="alert alert-dismissable alert-dismissable">
                                                <button type="button" class="close"
                                                        data-dismiss="alert" aria-hidden="true">&times;
                                                </button>
                                                <strong>No se encontraron detalles para el presupuesto....!</strong>
                                            </div>
                                        </div>

<?php } ?>
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
            <!--                El hr es para poner una linea divisora-->

        </div >

    </div>

    <!--archivos js-->  
<?php require 'menu/js.ctp'; ?>



    
    
    <script>     
        function confirmar(datos) {
                    var dat = datos.split("_");
                    $('#si').attr('href',
                    'nota_remision_compra_control_deta.php?vnota=' + dat[0] +
                            '&varti=' + dat[1] +
                            '&vcant=' + dat[3] +
                            '&vdep=' + dat[2] +
                            '&vcodcomp=' + dat[5] +
                            '&accion=1' +
                            '&pagina=nota_remision_compra_agregar.php');
                    $('#confirmacion').html
                    ('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Confirmar este Articulo del Detalle de la Compra?');
                
                }
        function borrar(datos) {
            var dat = datos.split("_");
            $('#si').attr('href',
                    'detcompras_conorden_control.php?vcod=' + dat[1] +
                    '&varti=' + dat[0] +
                    '&vdep_ori=' + dat[2] +
                    '&vprecio=null' +
                    '&vcant=' + dat[3] +
                    '&vsubtotal=null' +
                    '&vestado=null' +
                    '&vorden=' + dat[5] +
                    '&accion=2' +
                    '&pagina=detcompras_conorden_agregar.php');
            $('#confirmacion').html
                    ('<span class="glyphicon glyphicon-warning-sign"></span>\n\
    Desea Borrar el Articulo <i><strong>' + dat[4] + '</strong></i> ?');

        }


    </script>
</body>
</html>


