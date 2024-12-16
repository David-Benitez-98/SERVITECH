<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon"  href=" img/logo_negro.ico"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SERVITECH SYS - NOTAS</title>

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
                        <h3 class="page-header text-center"><strong>DETALLE DE NOTA DE REMISION</strong>
                            <a href="nota_remision_fact.php" 
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
                                Datos Cabecera
                            </div>
                            <?php
                            $remisions = consultas::get_datos("select * from v_notaremisionfactura where cod_nota_remi_vent=" .
                                            $_REQUEST ['vdetremifact'] . " order by cod_nota_remi_vent asc ");
                            if (!empty($remisions)) {
                            ?>                         
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table width="100%"
                                           class="table table-bordered">
                                        <thead>
                                            <tr class="primary-font">
                                                      <th class="text-center">#</th>
                                                    <th class="text-center">SUCURSAL</th>                                        
                                                    <th class="text-center">USUARIOS</th>                                        
                                                    <th class="text-center">N° FACTURA</th>
                                                    <th class="text-center">N° REMISION</th>
                                                    <th class="text-center">CLIENTE</th>
                                                    <th class="text-center">MOTIVO</th>
                                                    <th class="text-center">CONDUCTOR</th>
                                                    <th class="text-center">FECHA SALIDA</th>
                                                    <th class="text-center">FECHA LLEGADA</th>
                                                    <th class="text-center">ESTADO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($remisions as $remision) { ?> 
                                                <tr>
                                                  
                                             <td class="text-center"><?php echo $remision['cod_nota_remi_vent']; ?></td>
                                                        <td class="text-center"><?php echo $remision['suc_descri']; ?></td>
                                                        <td class="text-center"><?php echo $remision['usuario']; ?></td>
                                                        <td class="text-center"><?php echo $remision['cod_factura'] . "-" . $remision['nro_factura']; ?></td>
                                                        <td class="text-center"><?php echo $remision['nro_nota_remi']; ?></td>
                                                        <td class="text-center"><?php echo $remision['cliente']; ?></td>
                                                        <td class="text-center"><?php echo $remision['motivo_traslado']; ?></td>
                                                        <td class="text-center"><?php echo $remision['personal']; ?></td>
                                                        <td class="text-center"><?php echo $remision['fecha_ini_salida']; ?></td>
                                                        <td class="text-center"><?php echo $remision['fecha_fin_llegada']; ?></td>
                                                        <td class="text-center"><?php echo $remision['estado_not_remi']; ?></td>
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
                                            <strong>Numero de nota de Remision repetido, favor verificar....!</strong>
                                        </div>
                                    </div>
                                <?php } ?> 
                        </div>

                        <!-- comienzo para el detalle de COMPRA-->

                        <?php
                        $detanotas = consultas::get_datos
                                        ("select * from  v_detalle_remision_fact"
                                        . " where cod_nota_remi_vent=" . $_REQUEST['vdetremifact'] .
                                        "order by v_detalle_remision_fact asc");
                        ?>


                        <div class="panel panel-success">
                            <div class="panel-heading">
                                DETALLE DE LA NOTA DE REMISION 
                            </div>
                            <?php if (!empty($detanotas)) { ?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center"> ARTICULO</th>
                                                <th class="text-center"> CANTIDAD</th>
                                                <th class="text-center"> ESTADO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($detanotas as $detanota) { ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $detanota['cod_nota_remi_vent']; ?></td>
                                                    <td class="text-center"><?php echo $detanota['dato_articulo']; ?></td>
                                                    <td class="text-center"><?php echo number_format($detanota['not_remi_canti'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo $detanota['estado']; ?></td>
                                                        
                                                    <th class="text-center">
                                                        <a onclick="borrar(<?php
                                                        echo "'" . $detanota['cod_nota_remi_vent'] . "_" .
                                                                  $_REQUEST['vdetremifact'] . "_" .
                                                                  $_REQUEST['vfact'] . "_" .
                                                        $detanota['cod_art'] . "_" .
                                                        $detanota['not_remi_canti'] . "_" .
                                                        $detanota['estado'] . "'";
                                                        ?>)"
                                                           class="btn btn-xs btn-danger"
                                                           ret='tooltip' data-title="Borrar"
                                                           data-toggle='modal'
                                                           data-target='#delete'>
                                                            <span class="glyphicon glyphicon-trash">
                                                            </span></a>
                                                    </th>

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
                                            <strong>No se encontraron detalles de la nota....!</strong>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                 
                   
                       <?php if (isset($_REQUEST['vfact'])) { ?>
                        <?php $detafacturas = consultas::get_datos("select * from v_det_factura_iva  where cod_art IN(select cod_art from det_factura) AND det_estado !='CONFIRMADO/R' and cod_factura= " . $_REQUEST ['vfact'] ); ?>

                    <?php } ?> 


                    <div class="panel-body">

 <?php if (isset($remisions[0]['cod_nota_remi_vent'])) { ?>
                        <?php if ($remision['estado_not_remi'] == 'ACTIVO') { ?> 
                         <?php } ?> 
                            <?php if (!empty($detafacturas)) {
                                ?>   
                                <div class="panel-heading">
                                    <?php if ($remision['estado_not_remi'] == 'ACTIVO') { ?>
                                        DETALLE DE LA FACTURA 
                                    </div>
                                    <!-- /.panel-heading -->

                                    <div class="table-responsive">
                                        <!--                                    <div>-->
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center"> ARTICULO</th>
                                                    
                                                    <th class="text-center"> CANTIDAD</th>
                                                  
                                                    <th class="text-center"> ESTADO</th>

                                                    <th class="text-center"> ACCION</th>


                                                <?php } else { ?>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody class="buscar">
                                            <?php foreach ($detafacturas as $detafactura) { ?> 
                                                <tr>
                                                    <?php if ($remision['estado_not_remi'] == 'ACTIVO') { ?>
                                                        <td class="text-center"><?php echo $detafactura['cod_factura']; ?></td>
                                                        <td class="text-center"><?php echo $detafactura['dato_articulo']; ?></td>
                                                        
                                                        <td class="text-center"><?php echo number_format($detafactura['det_cantidad'], 0, ',', '.'); ?></td>
                                                        
                                                        <td class="text-center"><?php echo $detafactura['det_estado']; ?></td>
                                                        <td class="text-center">
                                                            <?php if ($remision['estado_not_remi'] == 'ACTIVO') { ?>  
<!--                                                                <a onclick="notacredi(<?php
                                                                echo "'" . $detafactura['cod_factura'] . "_" . $detafactura['dato_articulo'] . "_" . $detafactura['cod_dep'] . "_" . $detafactura['dep_descri'] . "_" .
                                                                $detafactura['cod_art'] . "_" . $detafactura['det_cantidad'] . "_" . $detafactura['det_precio_unit'] . "'";
                                                                ?>);" 
                                                                   class="btn btn-xs btn-primary" rel='tooltip' data-title="Confirmar" 
                                                                   data-toggle="modal" data-target="#editar">
                                                                    <span class="glyphicon glyphicon-ok-sign"></span></a>-->
                                                                    
                                                                        <a onclick="confirmar(<?php
                                                        echo "'" . $_REQUEST['vdetremifact'] . "_" .
                                                        $detafactura['cod_art'] . "_" .
                                                       
                                                        $detafactura['det_cantidad'] . "_" .
                                                      
                                                        $detafactura['det_estado'] . "_" .
                                                        $detafactura['dato_articulo'] . "_" .
                                                        $_REQUEST ['vfact'] . "'"
                                                        ?>)"
                                                           class="btn btn-microsoft btn-success" rel='tooltip' data-title="CONFIRMACION DIRECTA"
                                                           data-toggle="modal"
                                                           data-target="#delete">
                                                            <span class="glyphicon glyphicon-ok-sign"></span></a>
                                                       
                                                                    
                                                            <?php } else { ?>
                                                            <?php } ?>


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


                       

                        <div id="editar" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg ">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" 
                                                data-dismiss="modal" arial-label="Close">x</button>
                                        <h4 class="modal-title"><strong>REGISTRAR NOTA DE REMISION </strong></h4>
                                    </div>
                                    <form action="notaremision_fact_det_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                        <div class="panel-body">
                                            <input name="accion" value="1" type="hidden"/>
                                            <input type="hidden" name="pagina" value="notaremision_fact_detalle.php">
                                            <input type="hidden" name="vdetremifact" value="<?php echo $_REQUEST['vdetremifact'] ?>">
                                            <input type="hidden" name="vfact" value="<?php echo $_REQUEST['vfact'] ?>">
                                            <input type="hidden" name="vestado" value="ACTIVO">
                                           <input type="hidden"  id="articod" name="varti" value="0">
                                            


                                            <span class="col-md-1"></span>
                                            <div class="form-group">

                                                <div class="col-md-5">
                                                    <label class="col-md-2 control-label"><h3>ARTICULO</h3></label>
                                                    <input  type="text" required="" readonly=""
                                                            placeholder="Especifique articulo"
                                                            class="form-control" id="art">

                                                </div>


                                                <div class="col-md-3">
                                                    <label class="col-md-2 control-label"><h3>Cantidad</h3></label>
                                                    <input  type="number" required="" 
                                                            placeholder="Especifique Cantidad"
                                                            class="form-control" id="cant" 
                                                            min="1" name="vcant"
                                                            value ="0" >

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
            function notacredi(datos) {
                var dat = datos.split("_");
                $('#cod').val(dat[0]);
                $('#art').val(dat[1]);
                $('#depocod').val(dat[2]);
                $('#depo').val(dat[3]);
                $('#articod').val(dat[4]);
                $('#cant').val(dat[5]);
                $('#prec').val(dat[6]);
              
            }

     

            function borrar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href',
                        'notaremision_fact_det_control.php?vdetremifact=' + dat[1] +
                        '&vfact=' + dat[2] +
                        '&varti=' + dat[3] +
                        '&vcant=null'  +
                        '&vestado=null' +
                        '&accion=3' +
                        '&pagina=notaremision_fact_detalle.php');
                $('#confirmacion').html
                        ('<span class="glyphicon glyphicon-warning-sign"></span>\n\
               Desea borrar el detalle?');
            }
                  function confirmar(datos) {
            var dat = datos.split("_");
            $('#si').attr('href',
                    'notaremision_fact_det_control.php?vdetremifact=' + dat[0] +
                    '&varti=' + dat[1] +
                    '&vcant=' + dat[2] +
                    '&vestado=ACTIVO'+
                    '&vfact=' + dat[5] +
                    '&accion=1' +
                    '&pagina=notaremision_fact_detalle.php');
            $('#confirmacion').html
                    ('<span class="glyphicon glyphicon-warning-sign"></span>\n\
               Desea Confirmar este Item "<strong>' + dat[4] + '</strong>" del Detalle de la Factura?');

        }


        </script>



    </body>
</html>
