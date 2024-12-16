<?php
session_start();
require './clases/conexion.php';
$facturas = consultas::get_datos("select * from v_factura_cab_reclamo "
        . " where cod_factura = " . $_REQUEST['vfactu']);
?>
<select class="form-control" name="vpresu"
        id="cli"
        required="">
            <?php
            if (!empty($facturas)){
                foreach ($facturas as $factura){
                  ?>
    <option value="<?php echo $factura['cod_presu_servi'];?>">
    <?php echo $factura['datos_presupuesto']." Plazo: ".$factura['plazo_reclamo']." días - ".$factura['descri_servicio']?></option>
    <?php 
                }
            }else{
                ?>
    <option>
        Debe insertar al menos un cliente </option>
           <?php };?>
            
</select>

