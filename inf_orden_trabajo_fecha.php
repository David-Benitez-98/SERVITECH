<?php require './clases/conexion.php'; 
        require './ver_sesion.php';
        require 'menu/css.ctp';
?>

<form accept-charset="utf8" class="form-horizontal">
    <input name="opcion" value="1" id="op" type="hidden"/>
    <div class="col-md-8 col-md-offset-0">
        <div class="list-group">
            <a href="#" class="list-group-item active">
                Informes de Orden Trabajo
            </a>              
        </div>   
        <div class="form-group col-md-12">
            <label class="col-md-1 control-label">Desde: </label>
            <div class="col-md-5">
                <input type="date" required="" placeholder="Especifique fecha" id="desde"  onchange="validar_desde()"
                  class="form-control" value="<?php echo date("Y-m-d") ?>" 
                   name="vdesde">
            </div>
            <label class="col-md-1 control-label">Hasta: </label>
            <div class="col-md-4">
                 <input type="date" required="" placeholder="Especifique fecha"  id="hasta"  onchange="validar_hasta(),validar_otro()" 
                 class="form-control" value="<?php echo date("Y-m-d") ?>" 
                  name="vhasta">
            </div>
            <div class="form-group col-md-1">
                <div class="col-md-1  pull-right">
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
        window.open("/servitech_tesis/imprimir_orden_trabajos.php?vdesde=" 
                + $('#desde').val() 
                + '&vhasta='+$('#hasta').val()+
                '&vop=' + $('#op').val(), '_blank');
    }
</script>
<script>
            function validar_desde() {
                var hoy = new Date($('#desde').val());
//                var hoy_1 = new Date();
                var fechaFormulario = new Date($('#hasta').val());
                if (fechaFormulario < hoy) {
                    alert('Fecha superior al hasta!!!');
                    $('#fecha').val(hoy);
                    $('#desde').val(hoy);
                }
                else {
//                    $("#ocultar").css("display", "block");
                }
            }
            
            function validar_hasta() {
                var hoy = new Date($('#hasta').val());
                var fechaFormulario = new Date($('#desde').val());
                if (fechaFormulario > hoy) {
                    alert('Fecha superior al actual!!!');
                    $('#fecha').val(hoy);
                    $('#hasta').val(hoy);
                }
                else  {
//                    $("#ocultar").css("display", "block");
                }
            }
            
            function validar_otro() {
                var hoy = new Date();
                var fechaFormulario = new Date($('#hasta').val());
                if (fechaFormulario > hoy) {
                    alert('Fecha superior al actual!!!');
                    $('#fecha').val(hoy);
                    $('#hasta').val(hoy);
                }
                else  {
//                    $("#ocultar").css("display", "block");
                }
            } 
  
    
        </script>




