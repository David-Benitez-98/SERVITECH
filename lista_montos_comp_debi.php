<?php
session_start();

require './clases/conexion.php';

$costos = consultas::get_datos("select * from compras where cod_comp =" . $_REQUEST['vcompr']);
?>
<!--<select class="form-control"  required="" id="total" >
   
</select>-->
                <span class="col-md-3"></span>
<div class="col-md-8" >
    <label class="col-md-6 control-label"><h3>TOTAL</h3></label>
    <input type="number" required="" readonly=""
           class="form-control"  id="total" value="<?= $costos[0]['total'] ?>">
</div>