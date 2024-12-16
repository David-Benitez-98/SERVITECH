<?php
include_once  'clases/conexion.php'; //llamar a la conexion
?>
<ul class="nav" id="side-menu">
    <li>
        <a href="/servitech_tesis/menu.php"><i class="fa fa-dashboard fa-fw"></i> Inicio</a>
    </li>
    <?php
    //Obtener el nombre de los modulos
    $modulos = consultas::get_datos("select distinct(mod_cod),
        (mod_nom) from v_permisos 
        where cod_gru =" . $_SESSION['cod_gru'] . " order by mod_cod");
    ?>  
    <?php foreach ($modulos as $modulo) { ?>
        <li>
            <a href="<?php echo $modulo['mod_nom']; ?>#"><i class="fa fa-edit"></i><?php echo $modulo['mod_nom']; ?>
                <span class="fa arrow"></span></a>
           
            <ul class="nav nav-second-level">               
                <?php
                //Obtener las paginas de acuerdo al modulo
                $paginas = consultas::get_datos("select DISTINCT pag_direc,pag_nombre,leer,insertar,editar,borrar from v_permisos  
                        where mod_cod=" . $modulo['mod_cod'] . " and cod_gru =" . $_SESSION['cod_gru'] . " order by pag_nombre");
                ?>
                <?php foreach ($paginas as $pagina) { ?>
                    
                    <li>
                        <a href="/servitech_tesis/<?php echo $pagina['pag_direc']; ?>">
                            <?php echo $pagina['pag_nombre']; ?>
                        </a>                        
                    </li><?php $_SESSION[$pagina['pag_nombre']] = $pagina; ?>
                <?php } ?>  
            </ul>
            <!-- /.nav-second-level -->
        </li>
    <?php } ?>
</ul>
