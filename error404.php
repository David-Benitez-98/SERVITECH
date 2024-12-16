<!DOCTYPE html>
<html lang="en">

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
             <?php require 'menu/navbar.php'; ?>
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"> ATENCION...!!No tiene acceso a esta pagina!!
                            <a href="menu.php" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Atras">
                                <i class="glyphicon glyphicon-arrow-left"></i>
                            </a>                      
                        </h3>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <img class="img-responsive" height="auto">
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <?php require 'menu/js.ctp'; ?>

    </body>

</html>

