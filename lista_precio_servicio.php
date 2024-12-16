<?php
session_start();
require './clases/conexion.php';

$tiposervicios = consultas::get_datos("select * from v_tipo_servicios_descuentos "
        . " where cod_tipo_servi = " . $_REQUEST['vtipo_servi']);
?>
<br>
<label class="col-md-2 control-label">PRECIO SERV.</label>
<?php if (!empty($tiposervicios)){ ?>

<input type="number" name="v_precio_servi" id="precio_servi" 
       class="form-control" disabled=""
       placeholder="Precio del Servicio" 
       value="<?php echo $tiposervicios[0]['precio_tipo_servi'] ?>"
       >

    <?php }else { ?>

<?php } ?>

