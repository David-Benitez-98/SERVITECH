<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SERVITECH SYS</title>

        <?php
        require './ver_sesion.php';
        require 'menu/css.ctp';
        ?>

    </head>
    <body>
        <div id="wrapper">
            <?php require 'menu/navbar.php'; ?><!--BARRA DE HERRAMIENTAS-->
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header">Editar Personas  
                            <a href="funcionario_index.php" 
                      class="btn btn-primary btn-circle pull-right" 
                      rel='tooltip' title="Atras">
                        <i class="glyphicon glyphicon-arrow-left"></i>
                            </a> 
                        </h3>
                    </div>                       
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">                                         
                        <div class="panel-body">
                            <?php $personas =  consultas::get_datos("select * from persona where cod_per=".$_REQUEST['vper']) ?>
                            <form action="personas_control.php" method="post" 
                               role="form" class="form-horizontal">
                               <input type="hidden" name="accion" value="2">
                               <input type="hidden" name="vper" value="<?php echo $personas[0]['cod_per']; ?>">
                               <input type="hidden" name="pagina" value="funcionario_index.php">
                               
                              <div class="form-group">
                                    <label class="col-md-2 control-label">Tipo Pers:</label>
                                  <div class="row">
                                    <div class="radio col-md-8">
                                        
                                        
                                        
                                        <label>
                                            <input type="radio" name="vtipoperso" onchange="seleccion(); tipopersonaselec1();" onclick="seleccion();tipopersonaselec1();" onkeyup="seleccion();tipopersonaselec1();" <?= $personas[0]['tipo_persona']=='JURIDICA' ? 'checked' : '' ?> value="JURIDICA"  id="check" > Juridica
                                        </label>
                                        
                                        <label>
                                            <input type="radio" name="vtipoperso" onchange="seleccion();tipopersonaselec2();" onclick="seleccion();tipopersonaselec2();" onkeyup="seleccion();tipopersonaselec2();" <?= $personas[0]['tipo_persona']=='FISICA' ? 'checked' : '' ?> value="FISICA" id="check_1" > Fisica
                                        </label>
                                        
                                        
                                    </div>
                                  </div>                                  
                                </div>
                               <div class="form-group">
                                    <label class="col-md-2 control-label">Tipo de Documento</label>
                                    <div class="col-md-3">
                                        <?php
                                        $tiposdocumentos = consultas::get_datos("select * from tipo_documento "
                                                        . " order by cod_tipo_docu=".$personas[0]['cod_tipo_docu']." desc");
                                        ?>                                 
                                        <select name="vtipodocu" id="tipodocu" class="form-control select">
                                            <?php
                                            if (!empty($tiposdocumentos)) {
                                                foreach ($tiposdocumentos as $tipodocumento) {
                                                    ?>
                                                    <option value="<?php echo $tipodocumento['cod_tipo_docu']; ?>">
                                                        <?php echo $tipodocumento['doc_descri']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar una Nacionalidad</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                               
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Nro de Ci/Ruc:</label>
                                    <div class="col-md-5">
                                   <input type="text" required="" id="ci"
                                          placeholder="Ingrese nro de ci"  
                                          class="form-control" name="vci" 
                                          onkeyup="nronegativo();maximo();"
                                          onchange="nronegativo()"
                                          value="<?php echo $personas[0]['per_ci_ruc']; ?>" autofocus="">
                                    </div>
                                </div>
                               

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Nombre o Razon:</label>
                                    <div class="col-md-5">
                                   <input type="text" required="" placeholder="Ingrese nombre"  
                                          class="form-control" name="vnombre" id="nom"
                                          onkeyup="reemplazar();"
                                          onchange="reemplazar();"
                                          onblur="sololetras1();"
                                          value="<?php echo $personas[0]['per_nom_razon']; ?>"
                                          pattern="[A-Za-z and 0-9 and #SPACE and Ñ-ñ and ._-]{3,40}" title="Ingresa sólo letras. Tamaño mínimo: 3. Tamaño máximo: 40"
                                          autofocus="">
                                    </div>
                                </div>
<!--                               Inicia If Apellido-->
                               <?php if ($personas[0]['tipo_persona'] == 'JURIDICA') { ?> 
                               
                               <div class="form-group" style="display: none" id="ocultarapellido">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Apellido:</label>
                                        <div class="col-md-5">
                                            <input type="text"  id="apel" autocomplete="off"
                                               onkeyup="reemplazar1();"
                                               onchange="reemplazar1();"
                                               onblur="sololetras2();"
                                               placeholder="Ingrese apellido"  
                                               class="form-control" name="vapellido" value="<?php echo $personas[0]['per_ape']; ?>"
                                               pattern="[A-Za-z and 0-9 and #SPACE and Ñ-ñ and ._-]{3,40}" title="Ingresa sólo letras. Tamaño mínimo: 3. Tamaño máximo: 40"
                                              >
                                        </div>
                                    </div>
                                </div>
                               <?php } else if ($personas[0]['tipo_persona'] == 'FISICA'){ ?>
                                <div class="form-group" style="display: block" id="ocultarapellido">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Apellido:</label>
                                        <div class="col-md-5">
                                            <input type="text"  id="apel2" autocomplete="off" required=""
                                               onkeyup="reemplazar1();"
                                               onchange="reemplazar1();"
                                               onblur="sololetras3();"
                                               placeholder="Ingrese apellido"  
                                               class="form-control" name="vapellido" value="<?php echo $personas[0]['per_ape']; ?>"
                                               pattern="[A-Za-z and 0-9 and #SPACE and Ñ-ñ and ._-]{3,40}" title="Ingresa sólo letras. Tamaño mínimo: 3. Tamaño máximo: 40"
                                              >
                                        </div>
                                    </div>
                                </div>
                               <?php } ?> 
<!--                               Fin If Apellido-->
                            
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Dirección:</label>
                                    <div class="col-md-8">
                                        <input type="text" required="" id="dire"
                                               onkeyup="reemplazar2();"
                                               onchange="reemplazar2();"
                                               onblur="sololetras4();"
                                               placeholder="Ingrese dirección" 
                                               class="form-control" name="vdirec" value="<?php echo $personas[0]['per_direc']; ?>"
                                               autofocus="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Telefono</label>
                                    <div class="col-md-5">
                                        <input type="text" id="tel"
                                               placeholder="Ingrese telefono" 
                                               onkeyup="nronegativotel()"
                                               onchange="nronegativotel()"
                                               class="form-control" name="vtel" value="<?php echo $personas[0]['per_telf']; ?>"
                                               autofocus="">
                                    </div>
                                </div>
                               <div class="form-group">
                                    <label class="col-md-2 control-label">Nacimiento o Funda.</label>
                                    <div class="col-md-5">
                                        <input type="date"  id="fec" required=""
                                          placeholder="Ingrese fecha Nacimiento de la Persona o Fundación de la Empresa"  
                                          class="form-control"
                                          name="vfecnac" 
                                          onblur="validar();año();"
                                          value="<?php echo $personas[0]['fcha_nac_origen']; ?>">
                                    </div>
                                </div>
<!--                               Inicia If Genero-->
                               <?php if ($personas[0]['tipo_persona'] == 'JURIDICA') { ?>
                               
                              <div class="form-group" style="display: none" id="ocultargenero">
                                    <label class="col-md-2 control-label">Genero:</label>
                                  <div class="row">
                                    <div class="radio col-md-8">
                                        
                                        <label>
                                            <input type="radio" name="vsexo"  <?= $personas[0]['sexo']=='MASCULINO' ? 'checked' : '' ?> value="MASCULINO"  id="mascu" > Masculino
                                        </label>
                                        <label>
                                            <input type="radio" name="vsexo"  <?= $personas[0]['sexo']=='FEMENINO' ? 'checked' : '' ?> value="FEMENINO" id="feme"> Femenino
                                        </label>
                                       
                                    </div>
                                  </div>                                  
                                </div>
                               
                               <?php } else { ?>
                               <div class="form-group" style="display: block" id="ocultargenero">
                                    <label class="col-md-2 control-label">Genero:</label>
                                  <div class="row">
                                    <div class="radio col-md-8">
                                        
                                        <label>
                                            <input type="radio" name="vsexo" <?= $personas[0]['sexo']=='MASCULINO' ? 'checked' : '' ?> value="MASCULINO"  id="mascu" > Masculino
                                        </label>
                                        <label>
                                            <input type="radio" name="vsexo" <?= $personas[0]['sexo']=='FEMENINO' ? 'checked' : '' ?> value="FEMENINO" id="feme"> Femenino
                                        </label>
                                       
                                    </div>
                                  </div>                                  
                                </div>
                               
                               <?php } ?> 
<!--                               Fin If Genero-->
                               
                               <div class="form-group">
                                    <label class="col-md-2 control-label">Nacionalidad</label>
                                    <div class="col-md-3">
                                        <?php
                                        $nacionalidades = consultas::get_datos("select * from nacionalidad "
                                                        . " order by cod_nac=".$personas[0]['cod_nac']." desc");
                                        ?>                                 
                                        <select name="vnac" class="form-control select2">
                                            <?php
                                            if (!empty($nacionalidades)) {
                                                foreach ($nacionalidades as $nacionalidad) {
                                                    ?>
                                                    <option value="<?php echo $nacionalidad['cod_nac']; ?>">
                                                        <?php echo $nacionalidad['nac_des']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar una Nacionalidad</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
<!--                               Inicia If estado civil-->
                            <?php if ($personas[0]['tipo_persona'] == 'JURIDICA') { ?>
                            <div class="form-group" style="display: none" id="ocultarestadocivil">
                               <div class="form-group">
                                    <label class="col-md-2 control-label">Estado Civil:</label>
                                    <?php $estadosciviles = consultas::get_datos("select * from estado_civil"); ?>
                                    <div class="col-md-3">
                                        <select name="vec" class="form-control select2" >
                                            <?php
                                            if (!empty($estadosciviles)) {
                                                foreach ($estadosciviles as $estadocivil) {
                                                    ?>
                                                    <option value="<?php echo $estadocivil['cod_ec']; ?>">
                                                        <?php echo $estadocivil['ec_des']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar un Estado Civil</option>
                                            <?php } ?>    
                                        </select>
                                    </div>
                                </div>
                            </div>
                               
                               <?php } else { ?>
                               
                               <div class="form-group" style="display: block" id="ocultarestadocivil">
                               <div class="form-group">
                                    <label class="col-md-2 control-label">Estado Civil:</label>
                                    <?php $estadosciviles = consultas::get_datos("select * from estado_civil"); ?>
                                    <div class="col-md-3">
                                        <select name="vec" class="form-control select2" >
                                            <?php
                                            if (!empty($estadosciviles)) {
                                                foreach ($estadosciviles as $estadocivil) {
                                                    ?>
                                                    <option value="<?php echo $estadocivil['cod_ec']; ?>">
                                                        <?php echo $estadocivil['ec_des']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar un Estado Civil</option>
                                            <?php } ?>    
                                        </select>
                                    </div>
                                </div>
                            </div>
                               
                               <?php } ?>
<!--                               Fin If estado civil-->
                               
                               
                                 <div class="form-group">
                                    <label class="col-md-2 control-label">Ciudad</label>
                                    <?php $ciudades = consultas::get_datos("select * from ciudad order by cod_ciu=".$personas[0]['cod_ciu']."desc"); ?>
                                    <div class="col-md-3">
                                        <select name="vciu" class="form-control select2" >
                                            <?php
                                            if (!empty($ciudades)) {
                                                foreach ($ciudades as $ciudad) {
                                                    ?>
                                                    <option value="<?php echo $ciudad['cod_ciu']; ?>">
                                                        <?php echo $ciudad['ciu_des']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar una ciudad</option>
                                            <?php } ?>    
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Departamento</label>
                                    <div class="col-md-3">
                                        <?php
                                        $departamentos = consultas::get_datos("select * from departamento "
                                                        . " order by cod_depar=".$personas[0]['cod_depar']." desc");
                                        ?>                                 
                                        <select name="vdepar" class="form-control select2">
                                            <?php
                                            if (!empty($departamentos)) {
                                                foreach ($departamentos as $departamento) {
                                                    ?>
                                                    <option value="<?php echo $departamento['cod_depar']; ?>">
                                                        <?php echo $departamento['dep_descri']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar un departamento</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <br>
                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-10">
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o"></i> Grabar</button>
                                    </div>
                                </div>
                            </form>     
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>

        </div> 
        <!--fin-->
        <!--archivos js-->   
        <?php require 'menu/js.ctp'; ?>
        
     <script>
         
//para consultar lo que se selecciono en el radio buton y traer sus datos para editarlos
         $( document ).ready(function() {
              seleccion();
//              seleccion2();
//              tipopersonaselec();
         });
         
         function seleccion(){ //juridica
//                    console.log('dddd'); 
//none significa que no se va a ver
              $("#ocultarapellido").prop("display", "none");
              $("#ocultarestadocivil").prop("display", "none");
              $("#ocultargenero").prop("display", "none");
      
              $("#ocultarapellido").prop("display", "block");
              $("#ocultarestadocivil").prop("display", "block");
              $("#ocultargenero").prop("display", "block");
         }
         
//         function seleccion2(){ //fisica
////                    console.log('dddd');
////block significa que si se va a ver
////              $("#ocultarapellido").prop("display", "none");
////              $("#ocultarestadocivil").prop("display", "none");
////              $("#ocultargenero").prop("display", "none");
////      
//              $("#ocultarapellido").prop("display", "block");
//              $("#ocultarestadocivil").prop("display", "block");
//              $("#ocultargenero").prop("display", "block");
//         }
         
          
        
      
  //hasta aquiii   
  
     </script>
     <script>
             
//para el radio button del tipo de persona apellido
             $("#check").click(function() {
                $("#ocultarapellido").css("display", "none");
            });
            
            $("#check_1").click(function() {
                $("#ocultarapellido").css("display", "block");
            });
 //hasta aqui
         
   //para el radio button del tipo de persona estado civil 
        $("#check").click(function() {
                $("#ocultarestadocivil").css("display", "none");
            });
            
            $("#check_1").click(function() {
                $("#ocultarestadocivil").css("display", "block");
            });

 //hasta aqui
//para el radio button del tipo de persona SEXO
        $("#check").click(function() {
                $("#ocultargenero").css("display", "none");
            });
            
            $("#check_1").click(function() {
                $("#ocultargenero").css("display", "block");
            });

 //hasta aqui
 
     </script>
     
     <script>
         function sololetras1() {
//                      var numero = trim(numero);
                var numero = document.getElementById("nom").value;
                if (numero.length === 0 || numero=== " "){
                notificacion('Atencion','No se permiten campos vacios','error'); //y esta notificacion tiene mensaje rojo
               //  notificacion('Atencion','No se permiten campos vacios','mensaje'); //esta notificacion tiene mensaje amarillo
                document.getElementById("nom").value = '';
                } else {
                   
                }
            }
            function sololetras2() {
//                      var numero = trim(numero);
                var numero2 = document.getElementById("apel").value;
                if (numero2.length === 0 || numero2=== " "){
                notificacion('Atencion','No se permiten campos vacios','error'); //y esta notificacion tiene mensaje rojo
               //  notificacion('Atencion','No se permiten campos vacios','mensaje'); //esta notificacion tiene mensaje amarillo
                document.getElementById("apel").value = '';
                } else {
                   
                }
            }
            function sololetras3() {
//                      var numero = trim(numero);
                var numero3 = document.getElementById("apel2").value;
                if (numero3.length === 0 || numero3=== " "){
                notificacion('Atencion','No se permiten campos vacios','error'); //y esta notificacion tiene mensaje rojo
               //  notificacion('Atencion','No se permiten campos vacios','mensaje'); //esta notificacion tiene mensaje amarillo
                document.getElementById("apel2").value = '';
                } else {
                   
                }
            }
            function sololetras4() {
//                      var numero = trim(numero);
                var numero4 = document.getElementById("dire").value;
                if (numero4.length === 0 || numero4=== " "){
                notificacion('Atencion','No se permiten campos vacios','error'); //y esta notificacion tiene mensaje rojo
               //  notificacion('Atencion','No se permiten campos vacios','mensaje'); //esta notificacion tiene mensaje amarillo
                document.getElementById("dire").value = '';
                } else {
                   
                }
            }
         
//         function tipopersonaselec(){
//            var radioButTrat = document.getElementsByName("#check");
//
//            for (var i=0; i<radioButTrat.length; i++) {
//
//            if (radioButTrat[i].checked === "JURIDICA") 
//                document.getElementById("#tipodocu").value="2";
//            }else{
//                document.getElementById("#tipodocu").value="1";
//            }
//        } 

function tipopersonaselec1(){ //este anduvo kuri vai vai
            
            //si el radio button es juridico
            var auxi1 = $("#check").val();
            
            //si lo que se selecciono EN EL RADIO BUTTON FUE JURIDICA
            if(auxi1 === "JURIDICA"){
//               document.getElementById('tipodocu').setAttribute('disabled','true');
               document.getElementById("tipodocu").value="2"; //RUC
               
            }else {
//               document.getElementById('tipodocu').removeAttribute('disabled');
              // document.getElementById("tipodocu").value="1";//CI
            }
            
        }
        
        function tipopersonaselec2(){ //este anduvo kuri vai vai
            
            //si el radio button es juridico
            var auxi2 = $("#check_1").val();
            
            //si lo que se selecciono EN EL RADIO BUTTON FUE JURIDICA
            if(auxi2 === "FISICA"){
//               document.getElementById('tipodocu').setAttribute('disabled','true');
               document.getElementById("tipodocu").value="1";//CI
              
               
            }else {
//               document.getElementById('tipodocu').removeAttribute('disabled');
             //  document.getElementById("tipodocu").value="1";//CI
            }
            
        }
 
//para que me limite la cantidad maxima de caracteres en caso de ci o ruc 
        function maximo(){
            //si el campo tipo de documento se selecciona es valor cod_ci=1 
            var aux = $("#tipodocu").val();
            //si lo que se selecciono en la lista desplegable del tipo de doc fue cod_ci=1 
            if(aux === "1"){
               document.getElementById("ci").maxLength = "7"; //la cedula solo permitira hasta 7 caracteres
               document.getElementById("ci").minLength = "7"; //la cedula solo permitira hasta 7 caracteres
            }else{
               document.getElementById("ci").maxLength = "9"; //la el ruc solo permitira hasta 9 caracteres
               document.getElementById("ci").minLength = "8"; //la el ruc solo permitira hasta 9 caracteres
            }
            
        }
 //hasta aqui
 //para validar fecha de nacimiento o fundacion de una empresa
 function validar() {
                var hoy = new Date();
                var fechaFormulario = new Date($('#fec').val());
                if (fechaFormulario > hoy) {
                    alert('Fecha superior al actual!!!');
                    $('#fecha').val(hoy);
                    $('#fec').val(hoy);
                }
                else {

                }
            }
 function año(){
            var auxi2 = $("#check_1").val();
           // var auxi2 = $("#check_1").attr('checked', true).val(); //radio button fisica
            //alert (auxi2);
            var hoy = new Date(); //fecha de hoy
            var ano_actual = (new Date).getFullYear(); //año actual
            var ano_nacimiento = (new Date($('#fec').val())).getFullYear(); //año de nacimiento
            var ano_nac_real = ano_nacimiento + 1; //este es para joderle al sistema porque me traia año de nacimiento menos 1
            var edad = ano_actual - ano_nac_real; // calculo edad
            
        if (edad < 18 && auxi2 === "FISICA") {
              notificacion('Atencion','La Persona Fisica debe ser Mayor de Edad!!!','mensaje');
              $('#fec').val(hoy);
        }
        else{
            
        }

}
 //hasta aqui
 //para que no permita numeros negativos ni letras ci
            function nronegativo() {

                var numero = document.getElementById("ci").value;
                if (numero.match(/^-?[0-9]+(\.[0-9]{1,2})?$/))
                {
//                    alert("numero ok");
                }
                else
                {
                    alert("No se permite numeros negativos, letras, puntos o espacios vacios");
                    document.getElementById("ci").value = "";
                }
            }
            function nronegativotel() {

                var numero = document.getElementById("tel").value;
                if (numero.match(/^-?[0-9]+(\.[0-9]{1,2})?$/))
                {
//                    alert("numero ok");
                }
                else
                {
                    notificacion('Atencion','Ingrese su numero sin puntos, letras ni espacios', 'mensaje');
                    document.getElementById("tel").value = "";
                }
            }
   //hasta aqui
   //para que reemplaze comillas simples
            function reemplazar1(){
//                   alert($('#apel').val());
                var valor=document.getElementById('apel','apel2').value.replace("'","");
                document.getElementById('apel').value=valor;
                 document.getElementById('apel2').value=valor;
                }
                function reemplazar(){
//                   alert($('#apel').val());
                var valor=document.getElementById('nom').value.replace("'","");
                document.getElementById('nom').value=valor;
                }
                function reemplazar2(){
//                   alert($('#apel').val());
                var valor=document.getElementById('dire').value.replace("'","");
                document.getElementById('dire').value=valor;
                }
   //hasta aqui
        
        </script>
    </body>
</html>






