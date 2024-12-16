<?php require './clases/conexion.php'; 
        require './ver_sesion.php';
        require 'menu/css.ctp';
?>

<form accept-charset="utf8" class="form-horizontal">
    <input name="opcion" value="2" id="op" type="hidden"/>
    <div class="col-md-6 col-md-offset-0">
        <div class="list-group">
            <a href="#" class="list-group-item active">
                Inventario de Deposito
            </a>              
        </div>   
        <div class="form-group col-md-12">
            <label class="col-sm-4 control-label">Descripcion:</label>
            <div class="col-sm-6">
                <?php $stocks = consultas::get_datos("select distinct deposito from v_inventario_deposito order by deposito asc"); ?>                                                                 
                <select name="vpag" class="form-control select2" id="vdescri">
                    <?php
                    if (!empty($stocks)) {
                        foreach ($stocks as $stock) {
                            ?>
                            <option value="<?php echo $stock['deposito']; ?>">
                                <?php echo $stock['deposito']; ?></option>
                            <?php
                        }
                    } else {
                        ?>
                        <option value="0">Debe insertar una Descripcion</option>
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
        window.open("/servitech_tesis/imprimir_inventario_depo.php?vdescri=" + $('#vdescri').val() + 
                '&vop=' + $('#op').val(), '_blank');
    }
</script>

