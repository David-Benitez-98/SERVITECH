<?php
session_start();

require './clases/conexion.php';

$stocks = consultas::get_datos("select * from v_stock where cod_dep = " . $_REQUEST['vdepo']."order by cod_art");
?>

<select class="form-control" name="varti" id="artic" 
        onchange="obtenerprecio();obtenerplazo();obtenerdescripcion();obtenercondicion()" 
        onkeyup="obtenerprecio();obtenerplazo();obtenerdescripcion();obtenercondicion()"
        onclick="obtenerprecio();obtenerplazo();obtenerdescripcion();obtenercondicion()"
        required="">
    <?php
    if (!empty($stocks)) {
        foreach ($stocks as $stock) {
            ?>
            <option value="<?php echo $stock['cod_art']; ?>">
            <?php echo $stock['dato_articulo'] ?></option>
            <?php
        }
    } else {
        ?>
            <option value="0">NO SE ENCONTRO ARTICULO</option>
<?php }; ?>
</select>
