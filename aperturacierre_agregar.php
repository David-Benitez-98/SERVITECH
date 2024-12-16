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
                        <h3 class="page-header">Registar Apertura  
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
                            <form action="aperturacierre_control.php" method="post" 
                                  role="form" class="form-horizontal">
                                <input type="hidden" name="vcod" value="0">
                                <input type="hidden" name="vusu" value="<?php echo $_SESSION['cod_usu']; ?>">
                                <input type="hidden" name="accion" value="1">
                                <input type="hidden" name="pagina" value="aperturacierre_index.php">
                                
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Caja:</label>
                                    <div class="col-md-4">
                                        <?php $cajas = consultas::get_datos("select * from caja order by caj_cod asc"); ?>
                                        <select name="vcaja" class="form-control select2">
                                            <?php 
                                            if (!empty($cajas)) {
                                                foreach ($cajas as $caja) {
                                                    ?>
                                            <option value="<?php echo $caja['caj_cod']; ?>">
                                                    <?php echo $caja['caj_descri']; ?></option>
                                            <?php
                                                }
                                            }else {
                                                ?>
                                            <option value="0">Debe ingresar Caja</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"> 
                                    <label class="col-md-2 control-label">Monto Inicial</label>
                                    <div class="col-md-5">
                                        <input type="numeric" required="" id="mon"
                                               placeholder="Ingrese Monto Inicial"
                                               class="form-control" name="vmonto"
                                               onkeyup="nronegativo()"
                                               onchange="nronegativo()"
                                               autofocus="">
                                    </div>
                                </div>

                                <br>
                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-10">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-floppy-o"></i> Grabar</button>
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

        <script>
            function nronegativo() {

                var numero = document.getElementById("mon").value;
                if (numero.match(/^-?[0-9]+(\.[0-9]{1,2})?$/))
                {
//                    alert("numero ok");
                }
                else
                {
                    alert("No se permite numeros negativos y letras");
                    document.getElementById("mon").value = "";
                }
            }
            
        </script>
    </body>
</html>


