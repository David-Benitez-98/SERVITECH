<?php 
require './clases/conexion.php';
//require './ver_sesion.php';
//require './anular_sesion.php';
?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"
            aria-hidden="true">x</button>
    <h4 class="modal-title custom_align" id="Heading">
        <strong><i>Editar permisos</i></strong>
    </h4>
</div>
<div class="modal-body">
    <form action="paginas_control.php"
          method="post" accept-charset="utf-8"
          class="form-horizontal" role="form">
        <div class="panel se"> 
            <input type="hidden" name="accion" value="2">
            <input type="hidden" name="vgru"
                   value=" <?php echo $_REQUEST['vgrup'] ?>"/>
            <input type="hidden" name="vpag"
                   value="<?php echo $_REQUEST['vpag'] ?>">
            <input type="hidden" name="vgrunombre"
                   value="<?php echo $_REQUEST['vgrunombre'] ?>">
            <input type="hidden" name="pagina" value="paginas.php">

            <div class="form-group">
                <label class="col-lg-2 control-label">Grupo</label>
                <div class="col-lg-6">
                    <input type="text" class="form-control"
                           name="grupo" placeholder="Interfaz"
                           value="<?php echo $_REQUEST['vgrunombre']; ?>"
                           disabled />
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-2 control-label">Pagina</label>
                <div class="col-lg-6">
                    <input type="text" class="form-control"
                           name="pagina" placeholder="Interfaz"
                           value="<?php echo $_REQUEST['vpagina']; ?>"
                           disabled />
                </div>
            </div>

            <div class="form-group">
            <?php
            $paginas = consultas::get_datos("select * from "
                            . " v_permisos where pag_cod=" . $_REQUEST['vpag'] .
                            " and cod_gru=" . $_REQUEST['vgrup'])
            ?>      
                <label class="col-md-2 control-label">Permisos</label>
                <div class="row">
                    <div class="col-md-9">
                        <div class="checkbox">
                            <label>
                                <?php if ($paginas[0]['leer'] == 'f') { ?>
                                    <input type="hidden" value="false"
                                           name="consul"
                                           id="PermisoConsul">
                                    <input type="checkbox" value="true"
                                           name="consul" id="PermisoConsul">  
                                    <?php } else { ?>
                                    <input type="hidden" value="false"
                                           name="consul" id="PermisoConsul">
                                    <input type="checkbox"
                                           value="true" name="consul"
                                           id="PermisoConsul"
                                           checked="">
                                <?php } ?>
                                Consultar
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <?php if ($paginas[0]['insertar'] == 'f') { ?>
                                    <input type="hidden" value="false"
                                           name="agre"
                                           id="PermisoAgre">
                                    <input type="checkbox" value="true"
                                           name="agre" id="PermisoAgre">
                                    <?php } else { ?>
                                    <input type="hidden" value="false"
                                           name="agre"
                                           id="PermisoAgre">
                                    <input type="checkbox" value="true"
                                           name="agre"
                                           id="PermisoAgre"
                                           checked="">
                                <?php } ?>
                                Insertar
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <?php if ($paginas[0]['editar'] == 'f') { ?>
                                    <input type="hidden" value="false" name="editar"
                                           id="PermisoConsul">
                                    <input type="checkbox" value="true"
                                           name="editar" id="PermisoConsul">
                                    <?php } else { ?>
                                    <input type="hidden" value="false" name="editar"
                                           id="PermisoConsul">
                                    <input type="checkbox" value="true"
                                           name="editar" id="PermisoConsul"
                                           checked="">
                                <?php } ?>
                                    Actualizar
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <?php if ($paginas[0]['borrar'] == 'f') { ?>
                                        <input type="hidden" value="false" name="borrar"
                                               id="PermisoAgre">
                                        <input type="checkbox" value="true" name="borrar"
                                               id="PermisoAgre">
                                        <?php } else { ?>
                                        <input type="hidden" value="false" name="borrar"
                                               id="PermisoAgre">
                                        <input type="checkbox" value="true" name="borrar"
                                               id="PermisoAgre"
                                               checked="">
                                 <?php } ?>
                                Borrar
                            </label>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="text-right"
                 style="border-top: 1px solid 
                 #e5e5e5;margin-left: -1.1em;margin-right: -1.1em;
                 margin-top: 1.5em;;padding-top: 1em;padding-right: 1em;">
                <button class="btn btn-success" type="submit">
                    <span class="fa fa-refresh"></span>Actualizar</button>
                <button type="button" class="btn btn-danger" 
                        data-dismiss="modal">
                    <span class="fa fa-sign-out"></span> Salir</button>
            </div>
        </div>
    </form>
</div>

<?php require 'menu/js.ctp'; ?>
<!--<script>

  function Deshabilitar(){

       document.GetElementByTagId("<%=FinishButton.ClientID%>").disabled = true;

       return true;

  }

</script>-->



