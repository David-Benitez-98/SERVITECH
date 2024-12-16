<?php
session_start();
require './clases/conexion.php';
$presupuestoscompras = consultas::get_datos("select * from v_presupuesto_compra "
        . " where cod_presu_comp = " . $_REQUEST['vpresu']);
?>
<select class="form-control" name="vprov"
        id="prov"
        required="">
            <?php
            if (!empty($presupuestoscompras)){
                foreach ($presupuestoscompras as $presupuestocompra){
                  ?>
    <option value="<?php echo $presupuestocompra['cod_prov'];?>">
    <?php echo $presupuestocompra['proveedor']?></option>
    <?php 
                }
            }else{
                ?>
    <option>
        Debe insertar al menos un proveedor </option>
           <?php };?>
            
</select>

