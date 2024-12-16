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
                        <h3 class="page-header">Editar Usuarios  
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
                            <?php $usuarios =  consultas::get_datos("select * from usuario where cod_usu=".$_REQUEST['vcodusu']) ?>
                            <form action="usuario_control.php" method="post" 
                               role="form" class="form-horizontal">
                               <input type="hidden" name="accion" value="2">
                               <input type="hidden" name="vcodusu" value="<?php echo $usuarios[0]['cod_usu']; ?>">
                               <input type="hidden" name="vsuc" value="<?php echo $usuarios[0]['cod_suc']; ?>">
                               <input type="hidden" name="pagina" value="usuario_index.php">
                               
                                   <div class="form-group">
                                    <label class="col-md-2 control-label">Funcionario</label>
                                    <div class="col-md-3">
                                        <?php
                                        $funcionarios = consultas::get_datos("select * from v_funcionario "
                                                        . " order by cod_fun=".$usuarios[0]['cod_fun']." desc");?>                                 
                                        <select name="vcodfun" class="form-control select2">
                                            <?php
                                            if (!empty($funcionarios)) {
                                                foreach ($funcionarios as $funcionario) {
                                                    ?>
                                                    <option value="<?php echo $funcionario['cod_fun']; ?>">
                                                        <?php echo $funcionario['persona']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe seleccionar una Persona</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-md-2 control-label">Grupo</label>
                                    <div class="col-md-3">
                                        <?php
                                        $grupos = consultas::get_datos("select * from grupos order by cod_gru=".$usuarios[0]['cod_gru']." desc");
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
                                          class="form-control" name="vnickusu" value="<?php echo $usuarios[0]['usu_nick']; ?>" autofocus=""  
                                          onchange="reemplazar()" onkeyup="reemplazar()">
                                    </div>
                                </div>
<!--                                <div class="form-group">
                                    <label class="col-md-2 control-label">Clave</label>
                                    <div class="col-md-5">
                                   <input type="password" required="" placeholder="Ingrese Clave"  
                                          class="form-control" name="vclaveusu" value="<?php echo $usuarios[0]['usu_clav']; ?>">
                                    </div>
                                </div>-->
                                <div class="form-group">
                                   <label class="col-md-2 control-label">Clave</label>
                                   <div class="col-md-5">
                                       <input type="password" required="" id="clave"
                                              placeholder="Ingrese Contraseña"
                                              class="form-control" name="vclaveusu" value="<?php echo $usuarios[0]['clav']; ?>" 
                                              onchange="reemplazar1()"
                                               onkeyup="reemplazar1()">
                                   </div>
                               </div>

                               <div class="form-group">
                                    <label class="col-md-2 control-label">Sucursal</label>
                                    <div class="col-md-3">
                                        <?php
                                        $sucursales = consultas::get_datos("select * from sucursal order by cod_suc=".$usuarios[0]['cod_suc']." desc");
                                        ?>                                 
                                        <select name="vsuc" disabled="" class="form-control select2" >
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
                                            <option value="0">Debe insertar una Sucursal</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Estado</label>
                                  <div class="row">
                                    <div class="radio col-md-8">
                                        <?php if($usuarios[0]['usu_estado']=='ACTIVO') {?>
                                        <label>
                                            <input type="radio" name="vestado" value="ACTIVO" checked=""> Activo
                                        </label>
                                        <label>
                                            <input type="radio" name="vestado" value="INACTIVO"> Inactivo
                                        </label>
                                        <?php }else{ ?>
                                        <label>
                                            <input type="radio" name="vestado" value="ACTIVO"> Activo
                                        </label>
                                        <label>
                                            <input type="radio" name="vestado" value="INACTIVO" checked=""> Inactivo
                                        </label>
                                        <?php }?>
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

