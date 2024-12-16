<?php
session_start();
require './clases/conexion.php';
$stocks = consultas::get_datos("select * from v_stock "
        . " where cod_dep = " . $_REQUEST['vdep']);
?>
<select class="form-control" name="varti"
        id="artic" onchange="obtenerprecio()"
        onkeyup="obtenerprecio()"
        required="">
            <?php
            if (!empty($stocks)){
                foreach ($stocks as $stock){
                  ?>
    <option value="<?php echo $stock['cod_art'];?>">
    <?php echo $stock['art_descri']?></option>
    <?php 
                }
            }else{
                ?>
    <option>
        Debe insertar al menos un articulo </option>
           <?php };?>
            
</select>


