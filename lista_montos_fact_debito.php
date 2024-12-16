<?php
session_start();

require './clases/conexion.php';

$costos = consultas::get_datos("select * from factura_cab where cod_factura =" . $_REQUEST['vfact']);
?>
<!--<select class="form-control"  required="" id="total" >
    <?php
    if (!empty($costos)) {
        foreach ($costos as $costo) {
            ?>
            <option value="<?php echo $costo['ven_total'];?>">
                <?php echo $costo['ven_total'];?></option>
            <?php
        }
    } else {
        ?>
            <option >CARGUE UNA COMPRA</option>
<?php }; ?>
</select>-->
<div class="col-md-8" >
    <label class="col-md-6 control-label"><h3>TOTAL</h3></label>
    <input type="number" required="" readonly=""
           class="form-control"  id="total" value="<?= $costos[0]['ven_total'] ?>">
</div>