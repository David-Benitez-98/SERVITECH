<?php
session_start();
require './clases/conexion.php';

$articulos = consultas::get_datos("select * from v_articulos "
        . " where cod_art = " . $_REQUEST['varti']);
?>
<label class="col-md-2 control-label">PRECIO ART.</label>
<?php if (!empty($articulos)){ ?>

<input type="number" name="v_precio_art" id="precio_art" 
       class="form-control" disabled="" 
       placeholder="Precio del Articulo" 
       value="<?php echo $articulos[0]['precio']?>" >
    <?php }else { ?>

<?php } ?>