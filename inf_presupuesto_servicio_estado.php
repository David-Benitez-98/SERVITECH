<?php require './clases/conexion.php'; 
        require './ver_sesion.php';
        require 'menu/css.ctp';
?>

<form accept-charset="utf8" class="form-horizontal">
    <input name="opcion" value="4" id="op" type="hidden"/>
    <div class="col-md-6 col-md-offset-0">
        <div class="list-group">
            <a href="#" class="list-group-item active">
                Informes de Presupuesto Servicios
            </a>              
        </div>   
        <div class="form-group col-md-12">
            <label class="col-sm-5 control-label">Estado:</label>
            <div class="col-sm-6">
                <?php $compras = consultas::get_datos("select * from v_presupuesto_servi  order by estado"); ?>                                                                 
                <select name="vpag" class="form-control select2" id="vesta">

                 <option value="RECHAZADO">RECHAZADO</option>
                 <option value="CONFIRMADO">CONFIRMADO</option>
                 <option value="ANULADO">ANULADO</option>
                 <option value="PENDIENTE">PENDIENTE</option>
                 <option value="FACTURADO">FACTURADO</option>
                 <option value="VENCIDO">VENCIDO</option>
                 <option value="TERMINADO">TERMINADO</option>
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
        window.open("/servitech_tesis/imprimir_presupuesto_servicios.php?vesta=" + $('#vesta').val() + 
                '&vop=' + $('#op').val(), '_blank');
    }
</script>

