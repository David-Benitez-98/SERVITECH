<?php require './clases/conexion.php'; 
        require './ver_sesion.php';
        require 'menu/css.ctp';
?>

<form accept-charset="utf8" class="form-horizontal">
    <input name="opcion" value="2" id="op" type="hidden"/>
    <div class="col-md-6 col-md-offset-0">
        <div class="list-group">
            <a href="#" class="list-group-item active">
                Informes de Clientes
            </a>              
        </div>   
        <div class="form-group col-md-12">
            <label class="col-sm-5 control-label">Departamentos:</label>
            <div class="col-sm-6">
                <?php $departamentos = consultas::get_datos("select * from departamento order by cod_depar"); ?>                                                                 
                <select name="vpag" class="form-control select2" id="vdepar">
                    <?php
                    if (!empty($departamentos)) {
                        foreach ($departamentos as $departamento) {
                            ?>
                            <option value="<?php echo $departamento['cod_depar']; ?>">
                                <?php echo $departamento['dep_descri']; ?></option>
                            <?php
                        }
                    } else {
                        ?>
                        <option value="0">Debe insertar un Departamento</option>
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
        window.open("/servitech_tesis/imprimir_clientes.php?vdepar=" + $('#vdepar').val() + 
                '&vop=' + $('#op').val(), '_blank');
    }
</script>

