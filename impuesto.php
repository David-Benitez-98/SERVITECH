    <!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon"  href=" img/logo_negro.ico"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>KAMBLACK - IMPUESTO</title>

        <?php
        require './ver_sesion.php';
         // require './anular_sesion.php';
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
                        <h3 class="page-header">LISTADO DE IMPUESTO
<!--                            <a href="imprimir_sucursal.php" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Imprimir" target="_blank">
                                <i class="fa fa-print"></i>
                            </a> -->
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
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Datos
                            </div>
                            <?php
                            $impuestos = consultas::get_datos("select * from tipoimpuesto 
                                         order by id_impuesto asc ");
                            if (!empty($impuestos)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Descripción</th>                                        
                                                    <th class="text-center">Porcentaje</th>                                        
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($impuestos as $impuesto) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $impuesto['id_impuesto']; ?></td>
                                                        <td class="text-center"><?php echo $impuesto['imp_descrip']; ?></td>
                                                        <td class="text-center"><?php echo $impuesto['imp_porc']."%"; ?></td>
                                                        <td class="text-center">
                                                            <a onclick="editar(<?php echo "'" . $impuesto['id_impuesto'] . "_" .
                                                                    $impuesto['imp_descrip'] ."_". $impuesto['imp_porc'] ."'"; ?>)" 
                                                               class="btn btn-xs btn-primary" rel='tooltip' data-title="Editar" 
                                                               data-toggle="modal" data-target="#editar">
                                                                <span class="glyphicon glyphicon-pencil"></span></a>
                                                            <a onclick="borrar(<?php echo "'" . $impuesto['id_impuesto'] . "_" . 
                                                                    $impuesto['imp_descrip'] ."_". $impuesto['imp_porc'] . "'"; ?>)" 
                                                               class="btn btn-xs btn-primary" rel='tooltip' data-title="Borrar"
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
                    <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" 
                                        data-dismiss="modal" arial-label="Close">x</button>
                                <h4 class="modal-title"><strong>REGISTRAR IMPUESTO</strong></h4>
                            </div>
                            <form action="impuesto_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body se">
                                    <input type="hidden" name="accion"  value="1">
                                    <input type="hidden" name="vcod_imp" value="0"/> 
                                    <input type="hidden" name="pagina" value="impuesto_index.php">
                                     <div class="form-group">
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
                            <h4 class="modal-title"><strong>EDITAR IMPUESTO</strong></h4>
                        </div>
                        <form action="impuesto_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                            <div class="panel-body">
                                <input name="accion" value="2" type="hidden"/>
                                <input type="hidden" name="pagina" value="impuesto_index.php">
                                <input id="cod" type="hidden" name="vcod_imp"/>
                                <div class="form-group">
                                    <label class="col-md-3 control-label ">PORCENTAJE:</label>
                                    <div class="row_form">
                                        <div class="radio col-md-8">
                                            <label>
                                                <input id="porc" type="radio" name="vimp_porc" value="5"> 5%
                                            </label>
                                            <label>
                                                <input  id="porce"  type="radio" name="vimp_porc" value="10"> 10%
                                            </label>                                       
                                        </div>
                                    </div>                                  
                                </div>
                                 
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">IMPUESTO:</label>
                                        <div class="col-md-5">
                                            <input id="descrip" type="text" class="form-control" name="vimp_descrip" 
                                                   required="" pattern="[A-Za-z #SPACE]{4,30}">
                                        </div>
                                   
                                    </div>
                                   
                           
                              
                                
                                
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
		
		 $( document ).ready(function() {
 
           // palabras_impuesto1();
           // palabras_impuesto2();
         });
		 
		function palabras_impuesto1(){ //PROBA SI ANDA EN EL REGISTRAR JAJA
            
            
            var auxi1 = $("#cinco").val(); //RADIO BUTON CHECK 5%
            
            if(auxi1 === "5"){ //RADIO BUTON CHECK 5%
               document.getElementById("impuesto_descri").value="CINCO PORCIENTO"; //ESCRIBE EN CAMPO CINCO PORCIENTO
               
            }else { 

            }

        }
        
        function palabras_impuesto2(){ //PROBA SI ANDA EN EL REGISTRAR JAJA
            
            
            var auxi2 = $("#diez").val(); //RADIO BUTON CHECK 10%
            
            if(auxi2 === "10"){ //RADIO BUTON CHECK 10%
                document.getElementById("impuesto_descri").value="DIEZ PORCIENTO"; //ESCRIBE EN CAMPO DIEZ PORCIENTO
               
            }else { 

              
            }
            
        }
            
            function editar(datos) {
                var dat = datos.split("_");
                $('#cod').val(dat[0]);
                $('#porc').val(dat[2]);
                $('#descrip').val(dat[1]);
                
                if (dat[2]=='5'){
                    $('#porc').prop('checked',true)
                }else {
                     $('#porce').prop('checked',true)
                }
                    
//                $('#porc)'.val(dat[2]).trigger('change');
//                console.log(dat[2]);
               

            }
      
            function borrar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href', 'impuesto_control.php?vcod_imp=' + dat[0] + '&vimp_porc=' + dat[2]
                        +'&vimp_descrip=' + dat[1]+ '&accion=3&pagina=impuesto_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Borrar el impuesto <i><strong>' + dat[1] + '</strong></i>?');
            }
        </script>


    </body>
</html>
