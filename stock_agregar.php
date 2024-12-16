<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SYSMAD - COMPRA</title>

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
                        <h3 class="page-header">REGISTRAR STOCK
                            <a href="stock_index.php" 
                      class="btn btn-primary btn-circle pull-right" 
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
                            <form action="stock_control.php" method="post"
                                  role="form" class="form-horizontal">
                                <input type="hidden" name="accion" value="1">
                                <input type="hidden" name="vdep" value="0">
                                <input type="hidden" name="pagina" value="stock_index.php">
                                <input type="hidden" name="vsuc" id="vsuc" value="<?php echo $_SESSION['cod_suc'] ?>">
                                
<!--                        inicio de campos agregar-->
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Deposito:</label>
                                    <div class="col-md-4">
                                        <?php $depositos = consultas::get_datos("select * from deposito "
                                                . " where cod_suc= ".$_SESSION['cod_suc']. " order by cod_dep asc ");
                                        ?>
                                        <select name="vdep" class="form-control select2">
                                            <?php 
                                            if (!empty($depositos)) {
                                                foreach ($depositos as $deposito) {
                                                    ?>
                                            <option value="<?php echo $deposito['cod_dep']; ?>">
                                                    <?php echo $deposito['dep_descri']; ?></option>
                                            <?php
                                                }
                                            }else {
                                                ?>
                                            <option value="0">Debe seleccionar una Deposito</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                    <div class="form-group">
                                    <label class="col-md-2 control-label">Articulo:</label>
                                    <div class="col-md-4">
                                        <?php
                                        $articulos = consultas::get_datos("select * from articulos"); ?>
                                        <select name="vart" class="form-control select2">
                                            <?php 
                                            if (!empty($articulos)) {
                                                foreach ($articulos as $articulo) {
                                                    ?>
                                            <option value="<?php echo $articulo['cod_art']; ?>">
                                                    <?php echo $articulo['art_descri']; ?></option>
                                            <?php
                                                }
                                            }else {
                                                ?>
                                            <option value="0">Debe seleccionar un Articulo</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                <label class="col-md-2 control-label">Cantidad:</label>
                                <div class="col-md-4">
                                    <input type="number" required=""
                                           class="form-control"
                                           name="vcant" 
                                           value="0" autofocus="" readonly=""
                                           >
                                </div>
                            </div>
                            <br>
                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-10">
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o"></i> Grabar</button>
                                    </div>
                                </div>
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








