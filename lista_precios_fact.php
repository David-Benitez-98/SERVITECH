<?php
session_start();

require './clases/conexion.php';

$stocks = consultas::get_datos("select * from v_stock where cod_art = " . $_REQUEST['varti']." and cod_dep = " . $_REQUEST['vdepo']);
?>
    <?php if (!empty($stocks)) { ?>
    <input type="number" required="" placeholder="Precio del Articulo"
           class="form-control" name="vprecio" id="precio2"
               onkeyup="calsubtotal()"
               onmouseup="calsubtotal()"
               onchange="calsubtotal()"
           value="<?php echo $stocks[0]['precio'] ?>"
           readonly="" >
    <input type="hidden" name="cantidad" value="<?php echo $stocks[0]['cantidad'] ?>"
           id="cantstock">
    
    <?php }else {?>
     <option value="">Debe insertar un articulo</option>
    <?php } ?>         