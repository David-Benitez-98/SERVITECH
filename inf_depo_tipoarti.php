<?php require './clases/conexion.php'; 
        require './ver_sesion.php';
        require 'menu/css.ctp';
?>

<form accept-charset="utf8" class="form-horizontal">
    <input name="opcion" value="4" id="op" type="hidden"/>
    <div class="col-md-6 col-md-offset-0">
        <div class="list-group">
            <a href="#" class="list-group-item active">
                Inventario de Deposito
            </a>              
        </div>   
        <div class="form-group col-md-12">
            <label class="col-sm-4 control-label">Tipo Articulo:</label>
            <div class="col-sm-6">
                <?php $tiposarticulos = consultas::get_datos("select distinct tipo_arti_descrip from tipo_articulo order by tipo_arti_descrip asc"); ?>                                                                 
                <select name="vpag" class="form-control select2" id="vtipo">
                    <?php
                    if (!empty($tiposarticulos)) {
                        foreach ($tiposarticulos as $tipoarticulo) {
                            ?>
                            <option value="<?php echo $tipoarticulo['tipo_arti_descrip']; ?>">
                                <?php echo $tipoarticulo['tipo_arti_descrip']; ?></option>
                            <?php
                        }
                    } else {
                        ?>
                        <option value="0">Debe insertar un Tipo de Articulo</option>
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
        window.open("/servitech_tesis/imprimir_inventario_depo.php?vtipo=" + $('#vtipo').val() + 
                '&vop=' + $('#op').val(), '_blank');
    }
</script>
