<?php require './clases/conexion.php'; 
        require './ver_sesion.php';
        require 'menu/css.ctp';
?>

<form accept-charset="utf8" class="form-horizontal">
    <input name="opcion" value="5" id="op" type="hidden"/>
    <div class="col-md-6 col-md-offset-0">
        <div class="list-group">
            <a href="#" class="list-group-item active">
                Informes de Compras
            </a>              
        </div>   
        <div class="form-group col-md-12">
            <label class="col-sm-5 control-label">Tipo Tarjeta:</label>
            <div class="col-sm-6">
                <?php $cobrostarjetas = consultas::get_datos("select distinct tarjeta_tipo from v_cobro_tarjetas order by tarjeta_tipo asc"); ?>                                                                 
                <select name="vpag" class="form-control select2" id="vtarje">
                    <?php
                    if (!empty($cobrostarjetas)) {
                        foreach ($cobrostarjetas as $cobrotarjeta) {
                            ?>
                            <option value="<?php echo $cobrotarjeta['tarjeta_tipo']; ?>">
                                <?php echo $cobrotarjeta['tarjeta_tipo']; ?></option>
                            <?php
                        }
                    } else {
                        ?>
                        <option value="0">Debe insertar un Tipo de Tarjeta</option>
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
        window.open("/servitech_tesis/imprimir_cobros.php?vtarje=" + $('#vtarje').val() + 
                '&vop=' + $('#op').val(), '_blank');
    }
</script>



