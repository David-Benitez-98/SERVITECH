<?php
session_start();
require './clases/conexion.php';

$stocks = consultas::get_datos("select * from v_stock "
        . " where cod_art = " . $_REQUEST['varti'].
        " and cod_dep = ".$_REQUEST['vdep']);
?>

<?php if (!empty($stocks)){ ?>

<input type="number" name="vcant_logica" id="cantstock" 
       class="form-control" disabled=""
       placeholder="Cantidad del Articulo" 
       value="<?php echo $stocks[0]['cantidad'] ?>"
       >

<input type="hidden" name="vcant_logica" id="cantstock_prueba"
       value="<?php echo $stocks[0]['cantidad'] ?>"
       >
    <?php }else { ?>
<?php } ?>




