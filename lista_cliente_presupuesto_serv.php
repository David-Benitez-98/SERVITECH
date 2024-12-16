<?php
session_start();
require './clases/conexion.php';
$presupuestoservicios = consultas::get_datos("select * from v_presupuesto_servi "
        . " where cod_presu_servi = " . $_REQUEST['vpresu_servi']);
?>
<select class="form-control" name="vcli"
        id="cli"
        required="">
            <?php
            if (!empty($presupuestoservicios)){
                foreach ($presupuestoservicios as $presupuestoservicio){
                  ?>
    <option value="<?php echo $presupuestoservicio['id_cliente'];?>">
    <?php echo $presupuestoservicio['cliente']?></option>
    <?php 
                }
            }else{
                ?>
    <option>
        Debe insertar al menos un cliente </option>
           <?php };?>
            
</select>

