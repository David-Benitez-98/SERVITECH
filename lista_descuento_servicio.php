<?php
session_start();
require './clases/conexion.php';

$tiposervicios = consultas::get_datos("select * from v_tipo_servicios_descuentos "
        . " where cod_tipo_servi = " . $_REQUEST['vtipo_servi']);
?>
<br>
<label class="col-md-2 control-label">DESC/PROM.</label>
<?php if (!empty($tiposervicios)){ ?>

<input type="number" name="vdesc" id="desc" 
       class="form-control" disabled=""
       placeholder="Descuento del Servicio" 
       value="<?php echo $tiposervicios[0]['descuento_promo']?>"
       >

    <?php }else { ?>

<?php } ?>
