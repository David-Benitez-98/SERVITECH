<?php require './clases/conexion.php'; 
        require './ver_sesion.php';
        require 'menu/css.ctp';
?>

<form accept-charset="utf8" class="form-horizontal">
    <input name="opcion" value="3" id="op" type="hidden"/>
    <div class="col-md-6 col-md-offset-0">
        <div class="list-group">
            <a href="#" class="list-group-item active">
                Informes de Ventas 
            </a>              
        </div>   
        <div class="form-group col-md-12">
            <label class="col-sm-5 control-label">Condicion:</label>
            <div class="col-sm-6">
                <?php $ventas = consultas::get_datos("select * from v_factura_cab  order by ven_condicion"); ?>                                                                 
                <select name="vpag" class="form-control select2" id="vcon">

                 <option value="CONTADO">CONTADO</option>
                 <option value="CREDITO">CREDITO</option>
                </select>
               
            </div>
            <div class="form-group col-md-1">
                <div class="col-sm-1  pull-right">
                    <a onclick="enviar()" rel="tooltip" data-title="Imprimir"
                       class="btn btn-primary" role="button">
                        <span class="fa fa-print"> </span></a>  
                </div>
            </div>
        </div> 

    </div> 
</form>
<?php require 'menu/js.ctp'; ?>

<script>
    function enviar() {
        window.open("/servitech_tesis/imprimir_ventas.php?vcon=" + $('#vcon').val() + 
                '&vop=' + $('#op').val(), '_blank');
    }
</script>



