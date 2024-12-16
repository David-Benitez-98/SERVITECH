<?php require './clases/conexion.php'; 
        require './ver_sesion.php';
        require 'menu/css.ctp';
?>

<form accept-charset="utf8" class="form-horizontal">
    <input name="opcion" value="2" id="op" type="hidden"/>
    <div class="col-md-6 col-md-offset-0">
        <div class="list-group">
            <a href="#" class="list-group-item active">
                Informes de Ventas 
            </a>              
        </div>   
        <div class="form-group col-md-12">
            <label class="col-sm-2 control-label">Cliente:</label>
            <div class="col-sm-6">
                <?php $clientes = consultas::get_datos("select * from v_clientes order by id_cliente"); ?>                                                                 
                <select name="vpag" class="form-control select2" id="vcli">
                    <?php
                    if (!empty($clientes)) {
                        foreach ($clientes as $cliente) {
                            ?>
                            <option value="<?php echo $cliente['id_cliente']; ?>">
                                <?php echo $cliente['cliente']; ?></option>
                            <?php
                        }
                    } else {
                        ?>
                        <option value="0">Debe insertar un Cliente</option>
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
        window.open("/servitech_tesis/imprimir_ventas.php?vcli=" + $('#vcli').val() + 
                '&vop=' + $('#op').val(), '_blank');
    }
</script>






