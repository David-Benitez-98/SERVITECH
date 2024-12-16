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
                        
                        <h2 class="page-header text-center">Listado de Ajuste de Productos
                            
                            <!--Llama al modal con el boton de cruz-->
   
                            <a data-toggle="modal" data-target="#registrar" 
                               class="btn btn-primary btn-microsoft pull-right" 
                               rel="tooltip" data-title="Registrar Ajuste Cabecera">
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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                Datos de Ajustes de Productos
                            </div>
                            <?php
                            $ajustes = consultas::get_datos("select * from v_ajuste_productos order by cod_ajuste asc ");
                            if (!empty($ajustes)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Fecha</th>
                                                    <th class="text-center">Funcionario</th>
                                                    <th class="text-center">Sucursal</th>
                                                    <th class="text-center">Estado</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($ajustes as $ajuste) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $ajuste['cod_ajuste']; ?></td>
                                                        <td class="text-center"><?php echo $ajuste['vfecha']; ?></td>
                                                        <td class="text-center"><?php echo $ajuste['usuario']; ?></td>
                                                        <td class="text-center"><?php echo $ajuste['suc_descri']; ?></td>
                                                        <td class="text-center"><?php echo $ajuste['estado']; ?></td>
                                                        
                                                        <td class="text-center">
                                                            
                                                            <?php if($ajuste['estado']=='ANULADO' || $ajuste['estado']=='CONFIRMADO'){ ?>
                                                            
                                                               
                                                            <a href="imprimir_ajustes_productos.php?vajuste=<?php echo $ajuste['cod_ajuste']; ?>"
                                                                   target="_blank"
                                                                   class="btn btn-xs btn-primary"
                                                                   rel="tooltip" data-title="imprimir">
                                                                    <span class="glyphicon glyphicon-print"></span></a>
                                                                <a  
                                                                    href="ajuste_inventario_agregar.php?vajuste=<?php echo $ajuste['cod_ajuste'];?>"
                                                                class="btn btn-xs btn-info" rel='tooltip' data-title="Detalles" >
                                                                <span class="glyphicon glyphicon-tasks"></span></a>
                                                                
                                                            <?php }else {?>
                                                            <a href="imprimir_ajustes_productos.php?vajuste=<?php echo $ajuste['cod_ajuste']; ?>"
                                                                   target="_blank"
                                                                   class="btn btn-xs btn-primary"
                                                                   rel="tooltip" data-title="imprimir">
                                                                    <span class="glyphicon glyphicon-print"></span></a>
                                                            
                                                           <a  
                                                               href="ajuste_inventario_agregar.php?vajuste=<?php echo $ajuste['cod_ajuste'];?>"
                                                                class="btn btn-xs btn-info" rel='tooltip' data-title="Detalles" >
                                                                <span class="glyphicon glyphicon-tasks"></span></a>
                                                                
                                                                <a onclick="confirmar(<?php echo "'".$ajuste['cod_ajuste']."_".$ajuste['vfecha']."_".$ajuste['suc_descri']."'"; ?>)"
                                                               class="btn btn-xs btn-success" rel='tooltip' data-title="Confirmar Registro de Ajustes"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-ok-sign"></span></a>
                                                                
                                                                <a onclick="anular(<?php echo "'".$ajuste['cod_ajuste']."_".$ajuste['vfecha']."_".$ajuste['suc_descri']."'"; ?>)"
                                                               class="btn btn-xs btn-danger" rel='tooltip' data-title="Anular Ajustes"
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
                               
                                <h4 class="modal-title"><strong>Registrar Ajuste de Productos</strong></h4>
                            </div>
                            <form action="ajuste_inventario_control.php
                                  " method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body se">
                                    <input type="hidden" name="accion" id="accion" value="1">
                                    <input type="hidden" name="vajuste" id="vajuste" value="0">
                                    <input type="hidden" name="vestado" value="ACTIVO">
                                    <input type="hidden" name="vcod_usu" id="vcod_usu" value="<?php echo $_SESSION['cod_usu']; ?>">
                                     <input type="hidden" name="vsuc_ori" value="<?php echo $_SESSION['cod_suc']; ?>">
                                   <input type="hidden" name="pagina" value="ajuste_inventario_agregar.php">
                                    
                                <!--Inicio campos Presupuesto-->
                                
                                <!-- Grupo de la primera fila-->
                                    <!--desde aqui-->
                                    <!-- Campo fecha-->
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Fecha Ajuste:</label>
                                        <div class="col-md-3">
                                            
                                            <input type="date" required="" id="fec"
                                                   placeholder="Especifique fecha"
                                                   class="form-control"
                                                   name="vfecha_inicial"
                                                   readonly=""
                                                   onmouseup="validar()"
                                                   onkeyup="validar()"
                                                   onchange="validar()"
                                                   onclick="validar()"
                                                   onkeypress="validar()"
                                                   value="<?php echo date("Y-m-d") ?>"
                                                   
                                       </div>
                                    </div>
                                    
                                    <label class="col-md-2 control-label">Sucursal:</label>
                                        <div class="col-md-3">
                                            <input type="text" required="" placeholder="Ingrese Sucursal" readonly="" 
                                                   class="form-control" value="<?php echo $_SESSION['suc_descri']; ?>">
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


                <!--borrar-->
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
                <!--fin-->
            </div> 
        </div>
            <!--archivos js-->  
            <?php require 'menu/js.ctp'; ?>

        <script>
           
            function anular(datos) {
                var dat = datos.split("_");
                $('#si').attr('href'
                , 'ajuste_inventario_control.php?vajuste=' + dat[0] +
                        '&vcod_usu=null' +
                        '&vsuc_ori=null' +
                        '&vfecha_inicial=1900-01-01' +
                        '&vestado=ANULADO' +
                        '&accion=2'+
                        '&pagina=ajuste_inventario_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Anular el Ajuste de Productos de la Fecha: <i><strong> ' + dat[1] + ' de la Sucursal: ' + dat[2] + ' </strong></i>?');
            }
            
            function confirmar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href'
                , 'ajuste_inventario_control.php?vajuste=' + dat[0] +
                        '&vcod_usu=null' +
                        '&vsuc_ori=null' +
                        '&vfecha_inicial=1900-01-01' +
                        '&vestado=CONFIRMADO' +
                        '&accion=4'+
                        '&pagina=ajuste_inventario_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Confirmar el Ajuste de Productos de la Fecha: <i><strong> ' + dat[1] + ' de la Sucursal: ' + dat[2] + ' </strong></i>?');
            }
            
            function validar() {
                var hoy = new Date();
                var fechaFormulario = new Date($('#fec').val());
                if (fechaFormulario > hoy) {
                    alert('Fecha superior al actual!!!');
                    $('#fecha').val(hoy);
                    $('#fec').val(hoy);
                }
                else {
//                    $("#ocultar").css("display", "block");
                }
            }
        </script>
    </body>
</html>



