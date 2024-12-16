<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon"  href=" img/logo_negro.ico"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SERVITECH SYS</title>

        <?php
        require './ver_sesion.php';
        require './anular_sesion.php';
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
                        <h3 class="page-header text-center">LISTADO DE CAJAS
                            
                            <a data-toggle="modal" data-target="#registrar" 
                               class="btn btn-info btn-microsoft pull-right" 
                               rel="tooltip" data-title="Registrar Caja">
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
                            $cajas = consultas::get_datos("select * from v_caja 
                                         order by caj_cod asc");
                            if (!empty($cajas)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">DECRIPCION</th>    
                                                    <th class="text-center">ULTIMA FACTURA</th>
                                                    <th class="text-center">PUNTO DE EXPEDICION</th>
                                                    <th class="text-center">SUCURSAL</th>
                                                    <th class="text-center">ESTADO</th>
                                                   <th class="text-center">ACCIONES</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($cajas as $caja) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $caja['caj_cod']; ?></td>
                                                        <td class="text-center"><?php echo $caja['caj_descri']; ?></td>
                                                        <td class="text-center"><?php echo $caja['caj_ult_fac']; ?></td>
                                                        <td class="text-center"><?php echo $caja['caj_punto_expedicion']; ?></td>
                                                        <td class="text-center"><?php echo $caja['suc_descri']; ?></td>
                                                        <td class="text-center"><?php echo $caja['caj_estado']; ?></td>
                                                      <td class="text-center">

                                                            <!--                                                            <a  
                                                                                                                            href="persona_editar.php?vcodper=<?php echo $caja['id_persona']; ?>"
                                                                                                                            class="btn btn-xs btn-primary" rel='tooltip' data-title="Editar" >
                                                                                                                            <span class="glyphicon glyphicon-pencil"></span></a>-->
                                                            <a onclick="editar(<?php
                                                            echo "'" . $caja['caj_cod'] . "_" .
                                                            $caja['cod_suc'] . "_" . $caja['suc_descri'] . "_" .
                                                            $caja['caj_descri'] . "_" . $caja['caj_ult_fac'] . "_" .
                                                            $caja['caj_punto_expedicion'] . "_" .
                                                             $caja['caj_estado'] . "'";
                                                            ?>)" 
                                                               class="btn btn-xs btn-success" rel='tooltip' data-title="Editar" 
                                                               data-toggle="modal" data-target="#editar">
                                                                <span class="glyphicon glyphicon-pencil"></span></a>
                                                            <a onclick="borrar(<?php
                                                               echo "'" . $caja['caj_cod'] . "_" .
                                                            $caja['cod_suc'] . "_" .
                                                            $caja['caj_descri'] . "_" . $caja['caj_ult_fac'] . "_" .
                                                            $caja['caj_punto_expedicion'] . "_" .
                                                             $caja['caj_estado'] . "'";
                                                            ?>)" 
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
                    <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header alert-success">
                                <button type="button" class="close" 
                                        data-dismiss="modal" arial-label="Close">x</button>
                                <h4 class="modal-title"><strong>Registrar Caja</strong></h4>
                            </div>
                            <form action="caja_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body ">
                                    <input type="hidden" name="accion"  value="1">
                                    <input type="hidden" name="vcod" value="0"/> 
                                    <input type="hidden" name="vestado" value="CERRADA"/> 
                                   <input type="hidden" name="vsuc" value="<?php echo $_SESSION['cod_suc']; ?>">
                                    <input type="hidden" name="pagina" value="caja_index.php">
<span class=" col-md-1"></span>
                                    <div class="form-group">
                                       
                                        <div class="col-md-4">
                                             <label class="col-md-4 control-label "><h3>Caja:</h3></label>
                                            <input type="text" required=""
                                                   placeholder="Ingrese nombre caja"  autocomplete="off"
                                                   class="form-control"
                                                   id="nombre" 
                                                   name="vdescrip" 
                                                   onchange="sololetras()"
                                                   onkeyup="sololetras()"
                                                   pattern="[A-Za-z and 0-9 and #SPACE and ._-]{4,30}"  >

                                        </div>
                                        
                                        <div class="col-md-6 " >
                                            <label  class="control-label col-md-2"><h3>Sucursal:</h3></label>
                                            <input type="text" required="" placeholder="Ingrese sucursal" readonly=""
                                                   class="form-control" value="<?php echo $_SESSION['suc_descri'] ?>">
                                        </div>
                                    </div>
                                    <br>

                                   
 <span class=" col-md-1"></span>
                                    <div class="form-group">
                                        
                                        <div class="col-md-4">
                                            <label class="col-md-3 control-label"><h4>Punto|Expedicion:</h4></label>
                                            <input type="text" required=""
                                                   placeholder="Ingrese punto expedicion"   autocomplete="off"
                                                   class="form-control"
                                                   id="cii"
                                                   name="vpunto"
                                                   onchange="solo_ci(),validarexpe()"
                                                   onkeyup="solo_ci(),validarexpe()"
                                                   maxlength="3">
                                        </div>
                                              
                                       
                                        <div class="col-md-6">
                                            <label class="col-md-3 control-label"><h4>Ultima|Factura:</h4></label>
                                            <input type="text" required=""
                                                   placeholder="La ultima factura es autogenerado"   autocomplete="off"
                                                   class="form-control"
                                                   id="ciii"
                                                   name="vult"
                                                   name="vult" value="0" readonly="">
                                        </div>
                                    
                                    </div>
                                    <br>




                                    <br>
                                    <br>
                                    <div class="modal-footer">
                                        <button type="reset" data-dismiss="modal" class="btn btn-default pull-left">
                                            <i class="fa fa-close"></i> Cerrar</button>
                                        <button type="submit" class="btn btn-primary pull-right">
                                            <i class="fa fa-floppy-o"></i> Registrar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--fin-->
            <!--editar-->
            <div id="editar" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header alert-success">
                            <button type="button" class="close" 
                                    data-dismiss="modal" arial-label="Close">x</button>
                            <h4 class="modal-title"><strong>EDITAR CAJA</strong></h4>
                        </div>
                        <form action="caja_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                            <div class="panel-body">
                                <input name="accion" value="2" type="hidden"/>
                                <input type="hidden" name="pagina" value="caja_index.php">
                                <input id="cod" type="hidden" name="vcod"/>
                                <input type="hidden" id="codsuc"name="vsuc" value="<?php echo $_SESSION['cod_suc']; ?>">
<span class=" col-md-1"></span>
                                    <div class="form-group">
                                       
                                        <div class="col-md-4">
                                             <label class="col-md-4 control-label "><h3>CAJA:</h3></label>
                                            <input type="text" required=""
                                                   placeholder="Ingrese nombre caja"  autocomplete="off"
                                                   class="form-control"
                                                   id="caj" 
                                                   name="vdescrip" 
                                                   onchange="editarsololetrasape()"
                                                   onkeyup="editarsololetrasape()"
                                                   pattern="[A-Za-z and 0-9 and #SPACE and ._-]{4,30}">

                                        </div>
                                        
                                        <div class="col-md-4 " >
                                            <label  class="control-label col-md-2"><h3>SUCURSAL</h3></label>
                                            <input type="text" required="" placeholder="Ingrese sucursal" readonly=""
                                                   class="form-control" id="suc" value="<?php echo $_SESSION['suc_descri'] ?>">
                                        </div>
                                    </div>
                                    <br>

                                   
 <span class=" col-md-1"></span>
                                    <div class="form-group">
                                        
                                        <div class="col-md-4">
                                            <label class="col-md-3 control-label"><h4>EXPEDICION</h4></label>
                                            <input type="text" required=""
                                                   placeholder="Ingrese punto expedicion"   autocomplete="off"
                                                   class="form-control"
                                                   id="exp"
                                                   name="vpunto"
                                                   onchange="editarexp(),editarultima()"
                                                   onkeyup="editarexp(),editarultima()"
                                                   maxlength="3">
                                        </div>
                                        
                                        
                                        <div class="col-md-4">
                                            
                                            <label class="col-md-3 control-label"><h4>ULTIMA/FACTURA</h4></label>
                                             <span class=" col-md-1"></span> <span class=" col-md-1"></span> <span class=" col-md-1"></span>
                                            <input type="text" required=""
                                                   placeholder="Ingrese ultima factura"   autocomplete="off"
                                                   class="form-control"
                                                   id="ult"
                                                   name="vult" readonly="">
                                        </div>
                                    
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
	   
            function editar(datos) {
                var dat = datos.split("_");
                $('#cod').val(dat[0]);
                $('#codsuc').val(dat[1]);
                $('#suc').val(dat[2]);
                $('#caj').val(dat[3]);
                $('#ult').val(dat[4]);
                $('#exp').val(dat[5]);
           

            }

//                   function validarexpe() {
//            
//             var subtotal = 0;
//                var hoy = parseInt($('#cii').val());
//                var fechaFormulario = parseInt($('#ciii').val());
//                
//                if (fechaFormulario < hoy) {
//                    
//                     notificacion('Atencion', 'NUMERO DE EXPEDICION ES MAYOR A ULTIMA FACURA!!!', 'window.alert(message);');
//                    $('#cii').val('');
//                    $('#ciii').val('');
////                    $('#hasta').val(hoy);
// 
//                }
//                else {
//
//                }
//            }

//                 function editarultima() {
//            
//             var subtotal = 0;
//                var hoy = parseInt($('#exp').val());
//                var fechaFormulario = parseInt($('#ult').val());
//                
//                if (fechaFormulario < hoy) {
//                    
//                     notificacion('Atencion', 'ULTIMA FACURA ES MENOR A EXPEDICION!!!', 'window.alert(message);');
//                    $('#exp').val('');
//                    $('#ult').val('');
////                    $('#hasta').val(hoy);
// 
//                }
//                else {
//
//                }
//            }
             function sololetras() {
//                      var numero = trim(numero);
                var numero = document.getElementById("nombre").value;
                if (numero.length === 0 || numero === " ") {
                    notificacion('Atencion', 'No se permiten campos vacios', 'window.alert(message);');
                    document.getElementById("nombre").value = "";
                    
                    
                } else {

                }
            }
               function editarsololetrasape() {
//                      var numero = trim(numero);
                var numero = document.getElementById("caj").value;
                if (numero.length === 0 || numero === " ") {
                    notificacion('Atencion', 'No se permiten campos vacios', 'window.alert(message);');
               
                    document.getElementById("caj").value = "";
                    
                } else {

                }
            }
    
    
            function solo_cii() {
                var numero = document.getElementById("ciii").value;
                if (numero.match(/^-?[0-9]+(\.[0-9](1,2))?$/))
                {

                } else {
                    notificacion('Atencion', 'No se permiten letras o espacios', 'window.alert(message);');
//                    notificacion("Solo numeros");
                    document.getElementById("ciii").value = "";
        
                }
            }
                  function solo_ci() {
                var numero = document.getElementById("cii").value;
                if (numero.match(/^-?[0-9]+(\.[0-9](1,2))?$/))
                {

                } else {
                    notificacion('Atencion', 'No se permiten letras o espacios', 'window.alert(message);');
//                    notificacion("Solo numeros");
                    document.getElementById("cii").value = "";
        
                }
            }
            function editarexp() {
                var numero = document.getElementById("exp").value;
                if (numero.match(/^-?[0-9]+(\.[0-9](1,2))?$/))
                {

                } else {
                    notificacion('Atencion', 'No se permiten letras o espacios', 'window.alert(message);');
//                    notificacion("Solo numeros");
                    document.getElementById("exp").value = "";
        
                }
            }
            function editarult() {
                var numero = document.getElementById("ult").value;
                if (numero.match(/^-?[0-9]+(\.[0-9](1,2))?$/))
                {

                } else {
                    notificacion('Atencion', 'No se permiten letras o espacios', 'window.alert(message);');
//                    notificacion("Solo numeros");
                    document.getElementById("ult").value = "";
        
                }
            }
              
            function borrar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href', 'caja_control.php?vcod=' + dat[0]
                        + '&vsuc=' + dat[1]
                        + '&vdescrip=' + dat[2]
                        + '&vult=' + dat[3]
                        + '&vpunto=' + dat[4]
                        + '&vestado= ' + dat[5]
                       + '&accion=3&pagina=caja_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Borrar la caja <i><strong>' + dat[2] + '</strong></i>?');
            }
        </script>


    </body>
</html>
