<?php require './clases/conexion.php'; 
        require './ver_sesion.php';
        require 'menu/css.ctp';
?>

<form accept-charset="utf8" class="form-horizontal">
    <input name="opcion" value="5" id="op" type="hidden"/>
    <div class="col-md-6 col-md-offset-0">
        <div class="list-group">
            <a href="#" class="list-group-item active">
                Informes de Insumos Utilizados 
            </a>              
        </div>   
        <div class="form-group col-md-12">
            <label class="col-sm-2 control-label">Usuario:</label>
            <div class="col-sm-6">
                <?php $usuarios = consultas::get_datos("select * from v_usuarios order by cod_usu"); ?>                                                                 
                <select name="vpag" class="form-control select2" id="vusu">
                    <?php
                    if (!empty($usuarios)) {
                        foreach ($usuarios as $usuario) {
                            ?>
                            <option value="<?php echo $usuario['cod_usu']; ?>">
                                <?php echo $usuario['usuario']; ?></option>
                            <?php
                        }
                    } else {
                        ?>
                        <option value="0">Debe insertar un Usuario</option>
                    <?php } ?> 
                </select>
            </div>
            <div class="form-group col-md-1">
                <div class="col-sm-1  pull-right">
                    <a onclick="enviar()" rel="tooltip" data-title="Imprimir"
                       class="btn btn-primary" role="button">
                        <span class="fa fa-print"> </span></a>  
                </div>
            </div>
        </div> 

    </div> 
</form>
<?php require 'menu/js.ctp'; ?>

<script>
    function enviar() {
        window.open("/servitech_tesis/imprimir_insumos_servicios.php?vusu=" + $('#vusu').val() + 
                '&vop=' + $('#op').val(), '_blank');
    }
</script>

