<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SERVITECH S.A</title>

        <?php
        require './ver_sesion.php';
        require './anular_sesion.php'; #este es para bloquear la url
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
                        <h3 class="page-header">Listado de Cargos
                            <a href="imprimir_cargos.php" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Imprimir" target="_blank">
                                <i class="fa fa-print"></i>
                            </a> 
                            <a data-toggle="modal" data-target="#registrar" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Registrar">
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
                            $cargos = consultas::get_datos("select * from cargo
                                         order by cod_carg asc ");
                            if (!empty($cargos)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Descripción</th>                                        
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($cargos as $cargo) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $cargo['cod_carg']; ?></td>
                                                        <td class="text-center"><?php echo $cargo['carg_des']; ?></td>
                                                        <td class="text-center">
                                                            <a onclick="editar(<?php echo "'" . $cargo['cod_carg'] . "_" .
                                                                    $cargo['carg_des'] . "'"; ?>)" 
                                                               class="btn btn-xs btn-info" rel='tooltip' data-title="Editar" 
                                                               data-toggle="modal" data-target="#editar">
                                                                <span class="glyphicon glyphicon-pencil"></span></a>
                                                            <a onclick="borrar(<?php echo "'" . $cargo['cod_carg'] . "_" . 
                                                                    $cargo['carg_des'] . "'"; ?>)" 
                                                               class="btn btn-xs btn-danger" rel='tooltip' data-title="Borrar"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-trash"></span></a>
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
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" 
                                        data-dismiss="modal" arial-label="Close">x</button>
                                <h4 class="modal-title"><strong>Registrar Cargo</strong></h4>
                            </div>
                            <form action="cargos_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body se">
                                    <input type="hidden" name="accion"  value="1">
                                    <input type="hidden" name="vcarg_cod" value="0"/> 
                                    <input type="hidden" name="pagina" value="cargos_index.php">

                                    <label class="col-lg-2 control-label">Descripción:</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" name="vcarg_nom" id="descri"
                                               required="" 
                                               onkeyup="reemplazar();"
                                               onchange="reemplazar();"
                                               onblur="sololetras();"
                                               pattern="[A-Za-z and 0-9 and #SPACE and Ñ-ñ]{3,40}" title="Ingresa sólo letras. Tamaño mínimo: 3. Tamaño máximo: 40" 
                                               autofocus="">
                                    </div>
                                    <br>
                                    
<!--                                    <div class="form-group">
                                    <label class="col-md-3 control-label ">PORCENTAJE:</label>
                                    <div class="row_form">
                                        <div class="radio col-md-8">
                                            <label>
                                                <input required=""type="radio" name="vimp_porc" id="cinco" value="5" onclick="palabras_impuesto1();" onchange="palabras_impuesto1();"> 5%
                                            </label>
                                            <label>
                                                <input  required="" type="radio" name="vimp_porc" id="diez" value="10" onclick="palabras_impuesto2();" onchange="palabras_impuesto2();"> 10%
                                            </label>                                       
                                        </div>
                                    </div>                                  
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">IMPUESTO:</label>
                                        <div class="col-md-5">
                                            <input  type="text" class="form-control" name="vimp_descrip" id="impuesto_descri"
                                                   required="" pattern="[A-Za-z #SPACE]{4,30}">
                                        </div>
                                   
                                    </div>
                                </div>-->
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
            </div>
            <!--fin-->
            <!--editar-->
            <div id="editar" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" 
                                    data-dismiss="modal" arial-label="Close">x</button>
                            <h4 class="modal-title"><strong>Editar Cargos</strong></h4>
                        </div>
                        <form action="cargos_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                            <div class="panel-body">
                                <input name="accion" value="2" type="hidden"/>
                                <input type="hidden" name="pagina" value="cargos_index.php">
                                <input id="cod" type="hidden" name="vcarg_cod"/>
                                <label class="col-lg-2 control-label">Descripción:</label>
                                <div class="col-lg-10">
                                    <input id="descri_carg" type="text" class="form-control" name="vcarg_nom" onblur="sololetras();"
                                           required="" pattern="[A-Za-z and 0-9 and #SPACE]{3,40}" title="Ingresa sólo letras. Tamaño mínimo: 3. Tamaño máximo: 40"
                                           autofocus="">
                                </div>
                                <br>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="reset" data-dismiss="modal" class="btn btn-default pull-left">
                                    <i class="fa fa-close"></i> Cerrar</button>
                                <button type="submit" class="btn btn-primary pull-right">
                                    <i class="fa fa-refresh"></i> Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--fin-->

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

             function sololetras() {
//                      var numero = trim(numero);
                var numero = document.getElementById("descri","descri_carg").value;
                if (numero.length === 0 || numero=== " "){
                notificacion('Atencion','No se permiten campos vacios','error'); //y esta notificacion tiene mensaje rojo
               //  notificacion('Atencion','No se permiten campos vacios','mensaje'); //esta notificacion tiene mensaje amarillo
                document.getElementById("descri").value = "";
                document.getElementById("descri_carg").value = "";
                } else {
                   
                }
            }
            function editar(datos) {
                var dat = datos.split("_");
                $('#cod').val(dat[0]);
                $('#descri_carg').val(dat[1]);

            }

            function borrar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href', 'cargos_control.php?vcarg_cod=' + dat[0] + '&vcarg_nom=' + dat[1]
                        + '&accion=3&pagina=cargos_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Borrar el Cargo <i><strong>' + dat[1] + '</strong></i>?');
            }
            function reemplazar(){
//                   alert($('#apel').val());
                var valor=document.getElementById('descri_carg').value.replace("'","");
                document.getElementById('descri_carg').value=valor;
                }
                
//            $( document ).ready(function() {
// 
//         });
//		 
//		function palabras_impuesto1(){ //PROBA SI ANDA EN EL REGISTRAR JAJA
//            
//            
//            var auxi1 = $("#cinco").val(); //RADIO BUTON CHECK 5%
//            
//            if(auxi1 === "5"){ //RADIO BUTON CHECK 5%
//               document.getElementById("impuesto_descri").value="CINCO PORCIENTO"; //ESCRIBE EN CAMPO CINCO PORCIENTO
//               
//            }else { 
//
//            }
//
//        }
//        
//        function palabras_impuesto2(){ //PROBA SI ANDA EN EL REGISTRAR JAJA
//            
//            
//            var auxi2 = $("#diez").val(); //RADIO BUTON CHECK 10%
//            
//            if(auxi2 === "10"){ //RADIO BUTON CHECK 10%
//                document.getElementById("impuesto_descri").value="DIEZ PORCIENTO"; //ESCRIBE EN CAMPO DIEZ PORCIENTO
//               
//            }else { 
//
//              
//            }
//            
//        }
        </script>


    </body>
</html>

