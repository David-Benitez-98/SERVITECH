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
        require 'menu/css.ctp';
        ?>

    </head>
    <body>
        <div id="wrapper">
            <?php require 'menu/navbar.php'; ?><!--BARRA DE HERRAMIENTAS-->
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header">Editar Paginas 
                            <a href="paginas_registro_index.php" 
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
                            <?php $paginas_registros =  consultas::get_datos("select * from paginas where pag_cod=".$_REQUEST['vpag']) ?>
                            <form action="paginas_registro_control.php" method="post" 
                               role="form" class="form-horizontal">
                               <input type="hidden" name="accion" value="2">
                               <input type="hidden" name="vpag" value="<?php echo $paginas_registros[0]['pag_cod']; ?>">
                               <input type="hidden" name="pagina" value="paginas_registro_index.php">
                               
<!--                              Inicio Campos a Editar-->
                               
                                <!--Inicio nombres-->
                                <div class="form-group">
                                <label class="col-lg-3 control-label">Pag. Nombre:</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="vnom" 
                                               required="" 
                                               onkeyup="reemplazar()"
                                               onchange="reemplazar()"
                                               pattern="[A-Za-z and 0-9 and #SPACE]{3,40}" title="Ingresa sólo letras. Tamaño mínimo: 3. Tamaño máximo: 40"
                                               value="<?php echo $paginas_registros[0]['pag_nombre']; ?>"
                                               autofocus="">
                                    </div>
                                </div>
                                 <br>
                                 <!--Inicio direccion url-->
                                <div class="form-group">
                                <label class="col-lg-3 control-label">Pag. Direc:</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control" name="vdirec"
                                               required="" placeholder="Ingrese la Direccion URL de la pagina"
                                               value="<?php echo $paginas_registros[0]['pag_direc']; ?>"
                                               autofocus="">
                                    </div>
                                </div>
                                 <br>
                                 <!--Inicio Modulos-->
                                    <div class="form-group">
                                    <label class="col-md-3 control-label">Modulos:</label>
                                    <div class="col-md-3">
                                        <?php
                                        $modulos = consultas::get_datos("select * from modulos "
                                                        . " order by mod_cod");
                                        ?>                                 
                                        <select  name="vmod" class="form-control select"  style="width: 180%">
                                            <?php
                                            if (!empty($modulos)) {
                                                foreach ($modulos as $modulo) {
                                                    ?>
                                                    <option value="<?php echo $modulo['mod_cod']; ?>">
                                                        <?php echo $modulo['mod_nom']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar un Modulo</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                 <!--Fin modulos-->
                                 <br>
     
                               
                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-10">
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o"></i> Grabar</button>
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
        <script>
//            function validar() {
//                var hoy = new Date();
//                var fechaFormulario = new Date($('#fec').val());
//                if (fechaFormulario > hoy) {
//                    alert('Fecha superior al actual!!!');
//                    $('#fecha').val(hoy);
//                    $('#fec').val(hoy);
//                }
//                else {
//
//                }
//            }
        </script>

    </body>
</html>








