<?php
session_start();

require './clases/conexion.php';

$stocks = consultas::get_datos("select * from v_stock "
      . " where cod_suc=".$_SESSION['cod_suc']." and  cod_art = " . $_REQUEST['varti']);
?>
 
    <label class="col-md-1 control-label">DEPOSITO:</label>
                                 
<select class="form-control select2" name="vdepo"   required="">
    <?php
    if (!empty($stocks)) {
        foreach ($stocks as $stock) {
            ?>
            <option value="<?php echo $stock['cod_dep']; ?>">
            <?php echo $stock['dep_descri'] ?></option>
            <?php
        }
    } else {
        ?>
            <option value="">Debe insertar un deposito</option>
<?php }; ?>
</select>
                                       