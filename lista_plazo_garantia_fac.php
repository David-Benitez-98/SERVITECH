<?php
session_start();

require './clases/conexion.php';

$stocks2 = consultas::get_datos("select * from v_stock where cod_art = " . $_REQUEST['varti']." and cod_dep = " . $_REQUEST['vdepo']);
?>
    <?php if (!empty($stocks2)) { ?>
<span class="col-md-3"></span>
    <label class="col-md-1 control-label">Plazo|Garantia:</label>
    <input type="number" required="" placeholder="Plazo Garantia"
           class="form-control" name="vplazo" id="plazo_lista"
           value="<?php echo $stocks2[0]['plazo_garantia'] ?>"
           readonly="" >

    
    <?php }else {?>
     <option value="">El articulo no posee plazo</option>
    <?php } ?> 