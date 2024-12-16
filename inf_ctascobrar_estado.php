<?php require './clases/conexion.php'; 
        require './ver_sesion.php';
        require 'menu/css.ctp';
?>

<form accept-charset="utf8" class="form-horizontal">
    <input name="opcion" value="2" id="op" type="hidden"/>
    <div class="col-md-6 col-md-offset-0">
        <div class="list-group">
            <a href="#" class="list-group-item active">
                Informes de Cuentas a Cobrar
            </a>              
        </div>   
        <div class="form-group col-md-12">
            <label class="col-sm-5 control-label">Estado:</label>
            <div class="col-sm-6">
                <?php $ctas_pagar = consultas::get_datos("select * from v_ctas_cobrar_2  order by cta_estado"); ?>                                                                 
                <select name="vpag" class="form-control select2" id="vesta">

                 <option value="PENDIENTE">PENDIENTE</option>
                 <option value="CANCELADO">CANCELADO</option>
                 <option value="COBRADO">COBRADO</option>
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
        window.open("/servitech_tesis/imprimir_ctascobrar.php?vesta=" + $('#vesta').val() + 
                '&vop=' + $('#op').val(), '_blank');
    }
</script>

