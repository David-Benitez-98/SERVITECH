<?php
//iniciar una nueva sesion o reanudar la existente 
session_start();
if ($_SESSION){
    //destruye toda la informacion registrada de una sesion
    session_destroy();
}
?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SERVITECH SYS</title>

    <!-- Bootstrap Core CSS -->
    <link href="./vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="./vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="./dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="./vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
<!--    <style>
    body{
    background: #005983
    }
    </style>-->
    <style>
    body{
    background: #005983
    }
    </style>
    

</head>

<body>
  
    <div class="container">
         
        <div class="row">
            
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    
                    <div class="panel-heading ">
                        <img width="325" height="250" src="/servitech_tesis/img/logo2.png" />
                        <br>
                        <div class="panel-heading ">
                        <h3  class="panel-title" style="text-align: center" ><i><strong>Acceso al Sistema</strong></i> </h3>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php
                        //Mensaje de error 
                        if (!empty($_SESSION['error'])){
                         ?>
                        <div class="alert alert-danger" role="alert">
                            
                            <span class="glyphicon glyphicon-remove"></span>
                            
                            <?php echo $_SESSION ['error'];?>
                        </div>  
                        <?php } ?> <!--hasta aqui abarca el mensaje de error-->

                        <form role="form" action="acceso.php" method="post">
                            <fieldset>
                                <div class="form-group has-feedback">
                                    <input class="form-control" placeholder="Ingrese el Usuario" name="per_nom_razon" type="text" required="" autofocus="">
                                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <input class="form-control" placeholder="Password" name="pass" type="password" required="">
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                </div>
<!--                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>-->
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" class="btn btn-lg btn-info btn-block">Acceder</button>
                            </fieldset>
                           <!-- <p>algo</p>-->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="./vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="./vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="./dist/js/sb-admin-2.js"></script>

</body>

</html>



