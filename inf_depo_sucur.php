<?php require './clases/conexion.php'; 
        require './ver_sesion.php';
        require 'menu/css.ctp';
?>

<form accept-charset="utf8" class="form-horizontal">
    <input name="opcion" value="1" id="op" type="hidden"/>
    <div class="col-md-6 col-md-offset-0">
        <div class="list-group">
            <a href="#" class="list-group-item active">
                Inventario de deposito
            </a>              
        </div>   
        <div class="form-group col-md-12">
            <label class="col-sm-4 control-label">Sucursal:</label>
            <div class="col-sm-6">
                <?php $sucursales = consultas::get_datos("select * from sucursal order by cod_suc asc"); ?>                                                                 
                <select name="vpag" class="form-control select2" id="vsucur">
                    <?php
                    if (!empty($sucursales)) {
                        foreach ($sucursales as $sucursal) {
                            ?>
                            <option value="<?php echo $sucursal['cod_suc']; ?>">
                                <?php echo $sucursal['suc_descri']; ?></option>
                            <?php
                        }
                    } else {
                        ?>
                        <option value="0">Debe insertar una Sucursal</option>
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
        window.open("/servitech_tesis/imprimir_inventario_depo.php?vsucur=" + $('#vsucur').val() + 
                '&vop=' + $('#op').val(), '_blank');
    }
</script>

