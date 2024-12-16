<!DOCTYPE html>
<html>
    <head>
         <link rel="shortcut icon"  href=" img/logo_negro.ico"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SERVITECH SYS - COBROS</title>

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
                        <h3 class="page-header text-center"><strong>LISTADO DE COBROS</strong>
                                        <?php
                            $aperturas = consultas::get_datos("select *from v_apertura_cierre where cod_usu = " . $_SESSION['cod_usu'] . " and ape_estado = 'ACTIVO' ");
                            if (empty($aperturas)) {
                                $_SESSION['ape_nro'] = null;
                                ?>
                                <a href="apertura_cierre.php"
                                   class="btn btn-info btn-circle pull-right" 
                                   rel="tooltip" data-title="Debe realizar una apertura">
                                    <i class="fa fa-info"></i>
                                </a> 
                                <?php
                            } else {
                                $timbrado = consultas::get_datos("select * from timbrado where cod_tipo_comp = 1 AND  estado='ACTIVO'");
                                if (empty($timbrado)) {
                                    ?>
                                    <a href="timbrado_index.php"
                                       class="btn btn-info btn-circle pull-right" 
                                       rel="tooltip" data-title="Debe tener Timbrado!!!">
                                        <i class="fa fa-info"></i>
                                    </a> 
                                <?php } else { ?>
                                   <a href="cobros_agregar.php"
                              class="btn btn-info btn-microsoft pull-right" 
                               rel="tooltip" data-title="Registrar" >
                                <i class="fa fa-plus"></i>
                            </a>  

                                <?php } ?>
                            <?php } ?>
                                            
                        </h3>
                    </div>     
                    <!--Buscador-->
                    <div class="col-lg-12">
                        <div class="panel-heading">
                            <div class="input-group custom-search-form">
                                <input id="filtrar" type="text" class="form-control" placeholder="Buscar...">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button" rel="tooltip" title="Buscar">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>                      
                    </div>
                    <!--fin-->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                Datos
                            </div>                     
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <?php
                                if (!empty($aperturas)) {   $cobros = consultas::get_datos("select * from v_cobro_recibo_imprimir where ape_nro = " . $aperturas[0]['ape_nro']); 
                     
                                    if(!empty($cobros)){
                                    ?>    
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">#Ape</th>
                                                    <th class="text-center">Fecha Cobro</th> 
                                                    <th class="text-center">Efectivo</th> 
                                                    <th class="text-center">Tarjeta</th>
                                                    <th class="text-center">Cheque</th>
                                                     <th class="text-center">Importe Total</th> 
                                                    <th class="text-center">Usuario</th>
                                                    <th class="text-center">Estado</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($cobros as $cob) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?= $cob['cob_cod']; ?></td>
                                                        <td class="text-center"><?= $cob['ape_nro']; ?></td>
                                                        <td class="text-center"><?= date('d/m/Y',  strtotime($cob['cob_fecha'])); ?></td>
                                                     
                                                        <td class="text-center"><?= number_format($cob['efectivo'], 0, ',', '.'); ?></td>
                                                        <td class="text-center"><?= number_format($cob['tarjeta'], 0, ',', '.'); ?></td>
                                                        <td class="text-center"><?= number_format($cob['cheque'], 0, ',', '.'); ?></td>
                                                           <td class="text-center"><?= number_format($cob['monto_total'], 0, ',', '.'); ?></td>
                                                        <td class="text-center"><?= $cob['usuario']; ?></td>
                                                        <td class="text-center"><?= $cob['cob_estado']; ?></td>
                                                        <td class="text-center">
                                                            
                                                            
                                                              <?php if($cob['cob_estado']=='ANULADO'){ ?>
                                                                 <a  href="cobros_vista.php?vcod=<?php echo $cob['cob_cod'];?>"
                                                                class="btn btn-xs btn-success" rel='tooltip' data-title="Detalles" >
                                                                <span class="fa fa-th-list"></span></a>
                                                           <?php } else { ?>
                                                            
                                                                <a onclick="anular(<?php echo "'".$cob['cob_cod']."_". $cob['cliente']."_".
                                                                      
                                                                    $cob['cob_estado']."'"; ?>)"
                                                               class="btn btn-xs btn-danger" rel='tooltip' data-title="Anular"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-ban-circle"></span></a>
                                                            
                                                                <a  href="cobros_vista.php?vcod=<?php echo $cob['cob_cod'];?>"
                                                                class="btn btn-xs btn-success" rel='tooltip' data-title="Detalles" >
                                                                <span class="fa fa-th-list"></span></a>

                                                               
                                                       <?php if ($cob['ven_condicion'] == 'CREDITO') { ?> 
                                                                <a href="imprimir_recibo.php?vcod=<?php echo $cob['cob_cod']; ?>"
                                                                   target="_blank"
                                                                   class="btn btn-xs btn-warning"
                                                                   rel="tooltip" data-title="imprimir">
                                                                    <span class="glyphicon glyphicon-print"></span></a>
                                                  <?php } else { ?>
                                                            
                                                       <?php } ?>
                                                            
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                <?php } ?>
                                            </tbody>
                                        </table>                         
                                    </div>
                                             <?php } else { ?>
                                            <div class="alert alert-warning alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                                    &times;</button>
                                                <span class="glyphicon glyphicon-info-sign"></span><strong> No se encontraron registros....!</strong>
                                            </div>
                                            <?php } ?>  
                                <?php } else { ?>
                                    <div class="alert alert-info alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                            &times;</button>
                                        <span class="glyphicon glyphicon-info-sign"></span><strong> Debe realizar una apertura....!</strong>
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
                <!--fin-->
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


        <script>
//   $_REQUEST['vape'] . ",'" .
//            $_REQUEST['fecha'] . "'," .
//            $efectivo . ",'" .
//            $_REQUEST['estado'] . "'," .
//            $_REQUEST['vsuc'] . "," .
//            $_REQUEST['vusu'] . "," .
//            $_REQUEST['vcli'] . "," .
//            $_REQUEST['vformacobro'] . "," .
//            $_REQUEST['vrecibo'] . ",'" .
//            $_REQUEST['vrecinume'] . "')";
//            function anular(datos) {
//                var dat = datos.split("_");
//                $('#si').attr('href'
//                , 'cobros_control.php?codigo=' + dat[0] + 
//                        '&vape=null'+
//                        '&fecha=1900-01-01'+
//                        '&importe=null'+
//                        '&estado=ANULADO'+
//                        '&vsuc=null'+
//                        '&vusu=null'+
//                        '&vcli=null'+
//                        '&vformacobro=null'+
//                        '&vrecibo=null'+
//                        '&vrecinume=null'+
//                        '&accion=2'+
//                        '&pagina=cobros.php');
//                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
//            Desea Anular el Cobro <i><strong>' + dat[0] + '</strong></i>?');
//            }
            
//            function anular(datos) {
//                var dat = datos.split("_");
//                $('#si').attr('href'
//                , 'cobros_control.php?codigo=' + dat[0] + 
//                        '&vape=null'+
//                        '&fecha=1900-01-01'+
//                        '&importe=null'+
//                        '&estado=ANULADO'+
//                        '&vsuc=null'+
//                        '&vusu=null'+
//                        '&vcli=null'+
//                        '&vformacobro=null'+
//                        '&vrecibo=null'+
//                        '&vrecinume=null'+
//                        '&accion=3'+
//                        '&pagina=cobros.php');
//                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
//            Desea Anular el Cobro <i><strong>' + dat[1] + '</strong></i>?');
//            }
            
            function anular(datos) {
                var dat = datos.split("_");
                $('#si').attr('href'
                , 'cobros_control.php?codigo=' + dat[0] + 
                        '&vape=null'+
                        '&fecha=1900-01-01'+
                        '&importe=null'+
                        '&estado=ANULADO'+
                        '&vsuc=null'+
                        '&vusu=null'+
                        '&vcli=null'+
                        '&vformacobro=null'+
                        '&vrecibo=null'+
                        '&vrecinume=null'+
                        '&accion=3'+
                        '&pagina=cobros.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Anular el Cobro del Cliente <i><strong>' + dat[1] + '</strong></i>?');
            }
</script>
    </body>
</html>
