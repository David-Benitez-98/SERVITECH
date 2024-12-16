
<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon"  href=" img/logo_negro.ico"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SERVITECH SYS - COMPRA</title>

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
                        <h3 class="page-header">LISTADO DE COMPRA 

                            <a data-toggle="modal" data-target="#registrar" 
                               class="btn btn-info btn-microsoft pull-right" 
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
                            $compras = consultas::get_datos("select * from v_compras where cod_suc=".$_SESSION['cod_suc']. "
                             and suc_descri='".$_SESSION['suc_descri']. "' and cod_pedi_comp IS NULL and id_orden_compra IS NULL order by cod_comp asc ");
                            if (!empty($compras)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Proveedores</th>                                        
                                                    <th class="text-center">#Factura</th>                                        
                                                    <th class="text-center">Fecha</th>
                                                    <th class="text-center">Sucursal</th>
                                                    <th class="text-center">Funcionario</th>
                                                    <th class="text-center">Condicion</th>
                                                    <th class="text-center">N° Orden</th>
                                                    <th class="text-center">N° Pedido</th>
                                                    <th class="text-center">Monto</th>
                                                    <th class="text-center">Estado</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($compras as $compra) { ?> 
                                                    <tr>
                                                         <td class="text-center"><?php echo $compra['cod_comp']; ?></td>
                                                        <td class="text-center"><?php echo $compra['persona']; ?></td>
                                                        <td class="text-center"><?php echo $compra['nro_factura']; ?></td>
                                                        <td class="text-center"><?php echo $compra['vfecha']; ?></td>
                                                        <td class="text-center"><?php echo $compra['suc_descri']; ?></td>
                                                        <td class="text-center"><?php echo $compra['usuario']; ?></td>
                                                        <td class="text-center"><?php echo $compra['com_condicion']; ?></td>
                                                        <td class="text-center"><?php echo $compra['id_orden_compra']; ?></td>
                                                        <td class="text-center"><?php echo $compra['cod_pedi_comp']; ?></td>
                                                        <td class="text-center"><?php echo number_format($compra['total'], 0, ',', '.'); ?></td>
                                                        <td class="text-center"><?php echo $compra['com_estado']; ?></td>
                                                        <td class="text-center">
                                                            <a  
                                                                href="compra_directa_agregar.php?vdetcompra=<?php echo $compra['cod_comp'];?>&vorden=<?php echo $compra['id_orden_compra'];  ?>&vped=<?php echo $compra['cod_pedi_comp']; ?>"
                                                                class="btn btn-xs btn-success" rel='tooltip' data-title="Detalles" >
                                                                <span class="fa fa-th-list"></span></a>
                                                         
                                                            <a href="imprimir_factura_compra_1.php?vdetcompra=<?php echo $compra['cod_comp']; ?>"
                                                            target="_blank"
                                                            class="btn btn-xs btn-warning"
                                                            rel="tooltip" data-title="imprimir">
                                                                <span class="glyphicon glyphicon-print"></span></a>
                                                                    
                                                                
                                                                
                                                              <?php if ($compra['com_estado'] == 'ACTIVO'&&($compra['total'] > 0)) { ?>   
                                                                
                                                                 <a onclick="confirmar(<?php
                                                        echo "'" .$compra['cod_comp'] . "_" .
                                                                $compra['com_estado'] ."'"
                                                        ?>)"
                                                           class="btn btn-xs btn-primary" rel='tooltip' data-title="Confirmar"
                                                           data-toggle="modal"
                                                           data-target="#delete">
                                                            <span class="glyphicon glyphicon-ok-sign"></span></a>
                                                          
                                                            
                                                             <a onclick="anular(<?php
                                                        echo "'" .$compra['cod_comp'] . "_" .
                                                                $compra['com_estado'] ."'"
                                                        ?>)"
                                                     class="btn btn-xs btn-danger" rel='tooltip' data-title="Anular"
                                                                   data-toggle="modal"
                                                                   data-target="#deletee">
                                                                    <span class="glyphicon glyphicon-ban-circle"></span></a>
                                                            
                                                               <?php } else { ?>
                                                                     <?php } ?>
                                                            
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
                    <div class=" modal-dialog modal-lg ">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header alert-success">
                                <button type="button" class="close" 
                                        data-dismiss="modal" arial-label="Close">x</button>
                                <h4 class="modal-title"><strong>REGISTRAR COMPRA</strong></h4>
                            </div>
                            <?php $fecha = consultas::get_datos("select * from v_fecha2"); ?>
                            <form action="compra_directa_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body ">
                                    <input type="hidden" name="accion"  value="1">
                                    <input type="hidden" name="vcompra" value="0"/> 
                                    <input type="hidden" name="vusuario" 
                                           value="<?php echo $_SESSION['cod_usu']; ?>">
                                    <input type="hidden" name="vsucursal" 
                                           value="<?php echo $_SESSION['cod_suc']; ?>">
                                    <input type="hidden" name="vfechasis" 
                                           value="<?php echo $fecha[0]['fecha'] ?>">
                                    <input type="hidden" name="vestad" value="ACTIVO">
                                    <input type="hidden" name="vtotal" value="0">
                                    <input type="hidden" name="pagina" value="compra_directa_agregar.php">
                                    

                                    <span class="col-md-1"></span>
                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                        <div class="col-md-3 " >
                                            <label  class="control-label col-md-2"><h3> Fecha|Compra:</h3></label>
                                            <input type="date" required="" placeholder="Ingrese fecha" onchange="validarvigencia()" id="desde"
                                                   class="form-control" name="vfechafact" value="<?php echo $fecha[0]['fecha'] ?>">
                                        </div>
                                          <div class="col-md-3 " >
                                            <label  class="control-label col-md-1"><h3>Vigencia:</h3></label>
                                            <input type="date" required="" placeholder="Ingrese fecha" id="hasta"  onchange="validarvigencia()"
                                                   class="form-control" name="vfin" value="<?php echo $fecha[0]['fecha'] ?>">
                                        </div>
                                        
                                         <div class="col-md-3 " >
                                            <label  class="control-label col-md-2"><h3>Sucursal:</h3></label>
                                            <input type="text" required="" placeholder="Ingrese fecha" readonly=""
                                                   class="form-control" value="<?php echo $_SESSION['suc_descri'] ?>">
                                        </div>


                                    </div>
                                    <span class="col-md-1"></span>
                                    <span class="col-md-1"></span>
                                    <div class="form-group">

          
                                    <div class="col-md-3">
                                        <label control-label class="col-md-3 "><h3>Comprobante:</h3></label>
                                        <select required="" name="vtipo" class="form-control select"  >
                                        <?php
                                        $tipocomprobantess = consultas::get_datos("select * from tipo_comprobante where cod_tipo_comp = 1"
                                                        . " order by comprobante_des");
                                        ?>                                 
                                        
                                            <?php
                                            if (!empty($tipocomprobantess)) {
                                                foreach ($tipocomprobantess as $tipocomprobantes) {
                                                    ?>
                                                    <option  value="<?php echo $tipocomprobantes['cod_tipo_comp']; ?>">
                                                    <?php echo $tipocomprobantes['comprobante_des']; ?> </option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="">Debe insertar un tipo de comprobante</option>
<?php } ?>
                                        </select>
                                    </div>
                                   
                                        
                                                <div class="col-md-3">
                                            <label  class="control-label col-md-2"><h3>Timbrado:</h3></label>
                                       
                                            <input type="text" required=""
                                               placeholder="Especifique Cantidad"
                                               class="form-control"
                                               name="vtim" id="timbrad"
                                               onchange="solo_timbrado()" onkeyup="solo_timbrado()"
                                               pattern="[0-9]{8,8}"title="SOLO SE PERMITEN 8 DIGITOS" autofocus="">
                                                
                                    </div>
                                        
                                       <div class="col-md-3">
                                            <label  class="control-label col-md-2"><h3>Factura:</h3></label>
                                       
                                            <input type="text" required=""
                                               placeholder="Especifique Cantidad"
                                               class="form-control" id="factu"
                                               onchange="solo_factura()"onkeyup="solo_factura()"
                                               name="vfact" minlength="13" maxlength="15" value="000-000-0000000"
                                                pattern="[0-9 and -]{13,15}"title="NUMERO DE FACTURA DEBE SER MINIMO 13 DIGITOS SIN - GUION Y TOTAL 15 DIG CON GUION!!!" autofocus="">
                                                
                                    </div>
                                
                                        
                                    </div>
                                    <span class="col-md-1"></span>
                                    <span class="col-md-1"></span>
                                 
                                    
                                
                                       <div class="form-group">
                                    
                                    <div class="col-md-6">
                                            <label  class="control-label col-md-3"><h3>Proveedor:</h3></label>
                                            <?php $proveedores = consultas::get_datos("select * from v_proveedor3 where estado='ACTIVO' order by cod_prov asc"); ?>
                                            <select class="form-control"  required="" name="vprov" id="detalles" >
                                                 <?php
                                                if (!empty($proveedores)) {
                                                    foreach ($proveedores as $proveedor) {
                                                        ?>
                                                        <option value="<?php echo $proveedor['cod_prov']; ?>">
                                                            <?php echo $proveedor['datos_proveedor']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="0">Debe seleccionar un Proveedor</option>
                                                <?php } ?>
                                            </select>
                                            <a   href="proveedor_index.php"  class=" col-md-2 btn btn-xs btn- pull-right" rel='tooltip' data-title="Registrar Proveedor" >
                                            <span class="fa fa-plus col-md-3"></span></a>
                                        </div>
                               
                                        
                                        
                                        
                                        
                                         <div class="col-md-3">
                                            <label  class="control-label col-md-3"><h3>Condicion</h3></label>
                                     <select name="vcondicion" class="form-control"
                                             id="vcondicion" onchange="compra();">
                                            <option value="CONTADO">CONTADO</option>
                                            <option value="CREDITO">CREDITO</option>
                                        </select>
                                        </div>

                                     

                                    </div>
                                      <span class="col-md-1"></span>
                                      <span class="col-md-1"></span>
                                    <div class="form-group">
                                         <div class="col-md-4">
                                            <label  class="control-label col-md-3"><h3>Cuota</h3></label>
                                           <input type="hidden" class="form-control"
                                               name="vcuota" value="1">
                                        <input type="number" class="form-control"
                                               name="vcuota" disabled="" min="1"
                                               id="vcancuo">
                                        </div>
                                        
                                     
                                      
                                         <div class="col-md-4">
                                            <label class="control-label col-md-3" ><H3>Intervalo:</h3></label>
                                          
                                            <select  class="form-control" required="" id="vintervalo" name="vinter">
                                                 <option  value=""  >Seleccione intervalo si es credito</option>
                                                 <option value="5"  >5</option>
                                                <option value="15" >15 </option>
                                                <option value="30" >30</option>
                                                <option value="40" >40</option>
                                                <option value="60" >60</option>
                                            </select>
                                        </div>
                                        </div>
                                        
                              


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
                <!--fin-->
                <!--editar-->
                <!--fin editar-->
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
                
                   <div class="modal fade" id="deletee" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title custom_align" id="Heading">Atenci&oacute;n!!!</h4>
                                </div>
                                <div class="modal-body">

                                    <div class="alert alert-warning" id="confirmacionn"></div>

                                </div>
                                <div class="modal-footer">
                                    <a id="sii" role="button" class="btn btn-primary" ><span class="glyphicon glyphicon-ok-sign"></span> Si</a>
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                                </div>
                            </div>
                        </div>
                    </div> 
                <!--fin-->
            </div> 
            <!--archivos js-->  
            <?php require 'menu/js.ctp'; ?>



            <script language="JavaScript">
             
                          function solo_factura() {
                var numero = document.getElementById("factu").value;
                if (numero.match(/^-?[0-9--]+(\.[0-9--](1,2))?$/))
                {

                } else {
                    notificacion('Atencion', 'No se permiten letras o espacios ', 'window.alert(message);');
//                    notificacion("Solo numeros");
                    document.getElementById("factu").value = "";

                }
            }
                          function solo_timbrado() {
                var numero = document.getElementById("timbrad").value;
                if (numero.match(/^-?[0-9]+(\.[0-9](1,2))?$/))
                {

                } else {
                    notificacion('Atencion', 'No se permiten letras o espacios ', 'window.alert(message);');
//                    notificacion("Solo numeros");
                    document.getElementById("timbrad").value = "";

                }
            }
                
                      function validarvigencia() {
            
                var hoy = new Date($('#desde').val());
                var fechaFormulario = new Date($('#hasta').val());
                if (fechaFormulario < hoy) {
                    
                     notificacion('Atencion', 'Fecha inferior a la fecha de compra!!!', 'window.alert(message);');
                    $('#fecha').val(hoy);
                    $('#hasta').val(hoy);
                }
                else {

                }
            }
            
                
                
                  function compra() {

                if (document.getElementById('vcondicion').
                        value === "CONTADO") {
                    document.getElementById('vcancuo').
                            setAttribute('disabled','true');
                    document.getElementById('vcancuo').
                            value = '1';
                    
                    
                    document.getElementById('vintervalo').
                            setAttribute('disabled','true');
                    document.getElementById('vintervalo').value = '';
               
                    
                        } else {
                            document.getElementById('vcancuo').
                                    removeAttribute('disabled');
                            document.getElementById('vcancuo').value = '2';
                            document.getElementById('vcancuo').min = '2';
                            
                            
                            document.getElementById('vintervalo').
                                    removeAttribute('disabled');
                                    document.getElementById('vintervalo').value = '5';
                            
                            
                            
                        }
                    }
                    window.onload = compra();
                    
         
                  function confirmar(datos) {
            var dat = datos.split("_");
            $('#si').attr('href',
                    'compra_directa_control.php?vcompra=' + dat[0] +
                     '&vfechafact=1900-01-01' +
                     '&vestad=CONFIRMADO'+
                     '&vsucursal=null'  +
                     '&vprov=null' +
                     '&vusuario=null'  +
                     '&vcondicion=null' +
                     '&vorden=null' +
                     '&vped=null'+
                     '&vfact=null' +
                     '&vcuota=null' +
                     '&vinter=null' +
                     '&vtim=null' +
                     '&vfin=1900-01-01' +
                     '&vtipo=null' +
                     '&vtotal=null' +
                    '&accion=4' +
                    '&pagina=compra_directa_index.php');
              $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
                Desea Confirmar la Compra?');
        }
        

        
                     function anular(datos) {
            var dat = datos.split("_");
            $('#sii').attr('href',
                 'compra_directa_control.php?vcompra=' + dat[0] +
                     '&vfechafact=1900-01-01' +
                     '&vestad=ANULADO'+
                     '&vsucursal=null'  +
                     '&vprov=null' +
                     '&vusuario=null'  +
                     '&vcondicion=null' +
                     '&vorden=null' +
                     '&vped=null'+
                     '&vfact=null' +
                     '&vcuota=null' +
                     '&vinter=null' +
                     '&vtim=null' +
                     '&vfin=1900-01-01' +
                     '&vtipo=null' +
                     '&vtotal=null' +
                    '&accion=2' +
                    '&pagina=compra_directa_index.php');
              $('#confirmacionn').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
                Desea Anular la orden?');
        }
               //  '&vsucursal=' + dat[1] +
                   //  '&vusuario=' + dat[2] +
                   //  '&vprov=' + dat[3] +
                     //vorden=' + dat[4] +
                    // '&vfact=' + dat[4] +
                     //'&vfecha=' + dat[6] +
                    // '&vcondicion=' + dat[5] +
                    // '&vcuota=' + dat[6] +
                    //'&vped=' + dat[9] +
                     //'&vtotal=' + dat[7] +
        
      
                
            </script>


    </body>
</html>
