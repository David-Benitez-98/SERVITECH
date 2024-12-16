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
                        <h3 class="page-header">Registar Usuarios  
                            <a href="usuario_index.php" 
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
                            <form action="usuario_control.php" method="post"
                                  role="form" class="form-horizontal">
                                <input type="hidden" name="accion" value="1">
                                <input type="hidden" name="vcodusu" value="0">
                                <input type="hidden" name="pagina" value="usuario_index.php">
                                
                                 <div class="form-group">
                                    <label class="col-md-2 control-label">Funcionario</label>
                                    <div class="col-md-4">
                                        <?php
                                        $funcionarios = consultas::get_datos("select * from v_funcionario"); ?>
                                        <select name="vcodfun" class="form-control select2">
                                            <?php 
                                            if (!empty($funcionarios)) {
                                                foreach ($funcionarios as $funcionario) {
                                                    ?>
                                            <option value="<?php echo $funcionario['cod_fun']; ?>">
                                                    <?php echo $funcionario['persona']; ?></option>
                                            <?php
                                                }
                                            }else {
                                                ?>
                                            <option value="0">Debe seleccionar una Persona</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-md-2 control-label">Grupo</label>
                                    <div class="col-md-3">
                                    <?php $grupos = consultas::get_datos("select * from grupos"
                                            . " order by cod_gru");
                                    ?>
                                        <select name="vcodgru" class="form-control select2">
                                            <?php 
                                            if (!empty($grupos)) {
                                            foreach ($grupos as $grupo) {
                                                ?>
                                            <option value="<?php echo $grupo['cod_gru']; ?>">
                                                <?php echo $grupo['gru_nom']; ?></option>
                                            <?php
                                            }
                                            }else {
                                                ?>
                                            <option value="0">Debe insertar un Grupo</option>
                                            <?php } ?>
                                        </select>
                                </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Nick del Usuario</label>
                                    <div class="col-md-5">
                                        <input type="text" required="" id="nick"
                                               placeholder="Ingrese Nick"
                                               class="form-control" name="vnickusu" autofocus="" onchange="reemplazar()"
                                               onkeyup="reemplazar()">
                                    </div>
                                </div>
<!--                                <div class="form-group"> 
                                    <label class="col-md-2 control-label">Clave</label>
                                    <div class="col-md-5">
                                        <input type="password" required=""
                                               placeholder="Ingrese Clave"
                                               class="form-control" name="vclaveusu" autofocus="">
                                    </div>
                                </div>-->
                                <div class="form-group"> 
                                    <label class="col-md-2 control-label">Clave</label>
                                    <div class="col-md-5">
                                        <input type="password" required="" id="clave"
                                               placeholder="Ingrese Clave"
                                               class="form-control" name="vclaveusu" autofocus=""
                                               onchange="reemplazar1()"
                                               onkeyup="reemplazar1()">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Sucursal</label>
                                    <div class="col-md-3">
                                    <?php $sucursales = consultas::get_datos("select * from sucursal"
                                            . " order by cod_suc");
                                    ?>
                                        <select name="vsuc" class="form-control select2">
                                            <?php 
                                            if (!empty($sucursales)) {
                                            foreach ($sucursales as $sucursal) {
                                                ?>
                                            <option value="<?php echo $sucursal['cod_suc']; ?>">
                                                <?php echo $sucursal['suc_descri']; ?></option>
                                            <?php
                                            }
                                            }else {
                                                ?>
                                            <option value="0">Debe insertar un Grupo</option>
                                            <?php } ?>
                                        </select>
                                </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-md-2 control-label">Estado</label>
                                  <div class="row">
                                    <div class="radio col-md-8">
                                        <label>
                                            <input type="radio" name="vestado" value="ACTIVO" checked=""> Activo
                                        </label>
                                        <label>
                                            <input type="radio" name="vestado" value="INACTIVO"> Inactivo
                                        </label>                                       
                                    </div>
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
    
    <script>
        function reemplazar() {
                var res = document.getElementById("nick").value.replace("'", "");
                document.getElementById("nick").value = res;
           }
        </script>
        
        <script>
        function reemplazar1() {
                var res = document.getElementById("clave").value.replace("'", "");
                document.getElementById("clave").value = res;
           }
        </script>
</html>



