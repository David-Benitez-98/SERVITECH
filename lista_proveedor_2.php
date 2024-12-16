<?php
session_start();

require './clases/conexion.php';

$proveedors= consultas::get_datos("select * from v_compras where cod_comp = " . $_REQUEST['vcompr']."order by cod_comp ");
?>

<select class="form-control"  required="" id="detalles" name="vprov">
    <?php
    if (!empty($proveedors)) {
        foreach ($proveedors as $proveedor) {
            ?>
            <option value="<?php echo $proveedor['cod_prov'];?>">
                <?php echo $proveedor['persona'];?></option>
            <?php
        }
    } else {
        ?>
        <option>Debe insertar al menos un proveedor</option>
<?php }; ?>
</select>
