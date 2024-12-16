<?php
session_start();

require './clases/conexion.php';

$stocks = consultas::get_datos("select * from v_stock where cod_art = " . $_REQUEST['varti']." and cod_dep = " . $_REQUEST['vdepo']);
?>
    <?php if (!empty($stocks)) { ?>
<br>
<span class="col-md-5"></span>
<label class="col-md-2 control-label">Condicion|Garantia:</label>
<input type="text" required="" placeholder="Descripcion Garantia"
           class="form-control" name="vcondi_garan" id="condicion_g"
           value="<?php echo $stocks[0]['garantia_condicion'] ?>"
           readonly="" >

    
    <?php }else {?>
     <option value="">El articulo no posee condicion garantia</option>
    <?php } ?> 