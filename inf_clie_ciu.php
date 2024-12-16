<?php require './clases/conexion.php'; 
        require './ver_sesion.php';
        require 'menu/css.ctp';
?>

<form accept-charset="utf8" class="form-horizontal">
    <input name="opcion" value="1" id="op" type="hidden"/>
    <div class="col-md-6 col-md-offset-0">
        <div class="list-group">
            <a href="#" class="list-group-item active">
                Informes de Clientes
            </a>              
        </div>   
        <div class="form-group col-md-12">
            <label class="col-sm-2 control-label">Ciudad:</label>
            <div class="col-sm-6">
                <?php $ciudades = consultas::get_datos("select * from ciudad order by cod_ciu"); ?>                                                                 
                <select name="vpag" class="form-control select2" id="vciu">
                    <?php
                    if (!empty($ciudades)) {
                        foreach ($ciudades as $ciudad) {
                            ?>
                            <option value="<?php echo $ciudad['cod_ciu']; ?>">
                                <?php echo $ciudad['ciu_des']; ?></option>
                            <?php
                        }
                    } else {
                        ?>
                        <option value="0">Debe insertar una ciudad</option>
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
        window.open("/servitech_tesis/imprimir_clientes.php?vciu=" + $('#vciu').val() + 
                '&vop=' + $('#op').val(), '_blank');
    }
</script>




