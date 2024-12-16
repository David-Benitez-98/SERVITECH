<?php
session_start();
require './clases/conexion.php';
$compras = consultas::get_datos("select * from v_compras "
        . " where cod_comp = " . $_REQUEST['vcodcomp']);
?>
<select class="form-control" name="vprov"
        id="prov" required="" readonly="">
            <?php
            if (!empty($compras)){
                foreach ($compras as $compra){
                  ?>
    <option value="<?php echo $compra['cod_prov'];?>">
    <?php echo $compra['datos_proveedor']?></option>
    <?php 
                }
            }else{
                ?>
    <option>
        Debe insertar al menos un proveedor </option>
           <?php };?>
            
</select>


