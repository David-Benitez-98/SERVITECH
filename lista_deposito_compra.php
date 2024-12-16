<?php
session_start();
require './clases/conexion.php';
$stocks = consultas::get_datos("select * from v_stock "
        . " where cod_art = " . $_REQUEST['varti']. " and cod_suc = ".$_SESSION['cod_suc']);
?>
<label class="col-md-2 control-label"><h3>DEPOSITO</h3></label>
<select class="form-control" name="vdepo" 
        id="dep" disabled=""
        required="">
            <?php
            if (!empty($stocks)){
                foreach ($stocks as $stock){
                  ?>
    <option value="<?php echo $stock['cod_dep'];?>">
    <?php echo $stock['dep_descri']?></option>
    <?php 
                }
            }else{
                ?>
    <option value="0">0</option>
           <?php };?>
            
</select>
