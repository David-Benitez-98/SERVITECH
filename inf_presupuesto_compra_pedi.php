<?php require './clases/conexion.php'; 
        require './ver_sesion.php';
        require 'menu/css.ctp';
?>

<form accept-charset="utf8" class="form-horizontal">
    <input name="opcion" value="6" id="op" type="hidden"/>
    <div class="col-md-6 col-md-offset-0">
        <div class="list-group">
            <a href="#" class="list-group-item active">
                Informes de Presupuesto Compras 
            </a>              
        </div>   
        <div class="form-group col-md-12">
            <label class="col-sm-5 control-label">Pedido:</label>
            <div class="col-sm-6">
                <?php $ordencompras = consultas::get_datos(" select distinct estado_pedido from v_pedido_compra where estado_pedido = 'PRESUPUESTADO'"); ?>                                                                 
                <select name="vpag" class="form-control select2" id="vorden">
                    <?php
                    if (!empty($ordencompras)) {
                        foreach ($ordencompras as $ordencompra) {
                            ?>
                            <option value="<?php echo $ordencompra['estado_pedido']; ?>">
                                <?php echo $ordencompra['estado_pedido']; ?></option>
                            <?php
                        }
                    } else {
                        ?>
                        <option value="0">Debe insertar una Orden</option>
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
        window.open("/servitech_tesis/imprimir_presupuesto_compras.php?vorden=" + $('#vorden').val() + 
                '&vop=' + $('#op').val(), '_blank');
    }
</script>



