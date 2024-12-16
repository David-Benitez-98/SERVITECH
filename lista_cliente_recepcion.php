<?php
session_start();
require './clases/conexion.php';
$recepciones = consultas::get_datos("select * from v_recepcion "
        . " where cod_recep = " . $_REQUEST['vrecep']);
?>
<select class="form-control" name="vcli"
        id="cli"
        required="">
            <?php
            if (!empty($recepciones)){
                foreach ($recepciones as $recepcion){
                  ?>
    <option value="<?php echo $recepcion['id_cliente'];?>">
    <?php echo $recepcion['cliente']?></option>
    <?php 
                }
            }else{
                ?>
    <option>
        Debe insertar al menos un cliente </option>
           <?php };?>
            
</select>

