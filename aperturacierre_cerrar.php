<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>DISTRIBUIDORA S&D S.A</title>

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
                    <div class="col-lg-12">
                        <h3 class="page-header">Cerrar Caja 
                            <a href="aperturacierre_index.php" 
                      class="btn btn-success btn-circle pull-right" 
                      rel='tooltip' title="Atras">
                        <i class="glyphicon glyphicon-arrow-left"></i>
                            </a> 
                        </h3>
                    </div>                       
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">                                         
                        <div class="panel-body">
                            <?php $aperturascierres =  consultas::get_datos("select * from apertura_cierre where ape_nro=".$_REQUEST['vcod']) ?>
                            <form action="aperturacierre_control.php" method="post" 
                               role="form" class="form-horizontal">
                               <input type="hidden" name="accion" value="2">
                               <input type="hidden" name="vcod" value="<?php echo $aperturascierres[0]['ape_nro']; ?>">
                               <input type="hidden" name="vmonto" value="<?php echo $aperturascierres[0]['ape_monto_inicial']; ?>">
                               <input type="hidden" name="vcaja" value="<?php echo $aperturascierres[0]['caj_cod']; ?>">
                               <input type="hidden" name="vusu" value="<?php echo $aperturascierres[0]['cod_usu']; ?>">
                               
                               <input type="hidden" name="pagina" value="aperturacierre_index.php">
                               
<!--                              Inicio Campos a Editar-->

<!--                                    <div class="form-group">
                                    <label class="col-md-2 control-label">Monto:</label>
                                    <div class="col-md-5">
                                        <input type="number" required="" 
                                           
                                          class="form-control" name="vmonto" value="<?php echo $aperturascierres[0]['ape_monto_inicial']; ?>" 
                                          autofocus="" disabled="">
                                    </div>
                                </div>-->
                                    <div class="form-group">
                                    <label class="col-md-2 control-label">Estado:</label>
                                  <div class="row">
                                    <div class="radio col-md-8">
                                        <?php if($aperturascierres[0]['ape_estado']=='ABIERTA') {?>
                                        <label>
                                            <input type="radio" name="vestado" value="ABIERTA" checked=""> ABIERTA
                                        </label>
                                        <label>
                                            <input type="radio" name="vestado" value="CERRADO"> CERRADO
                                        </label>
                                        <?php }else{ ?>
                                        <label>
                                            <input type="radio" name="vestado" value="ABIERTA"> ABIERTA
                                        </label>
                                        <label>
                                            <input type="radio" name="vestado" value="CERRADO" checked=""> CERRADO
                                        </label>
                                        <?php }?>
                                    </div>
                                  </div>                                  
                                </div>
                        
                                <br>
                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-10">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-floppy-o"></i> Grabar</button>
                                    </div>
                                </div>
<!-- Final de  Campos a Editar-->
                            </form>     
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>

        </div> 
        <!--fin-->
        <!--archivos js-->   
        <?php require 'menu/js.ctp'; ?>

    </body>
</html>








