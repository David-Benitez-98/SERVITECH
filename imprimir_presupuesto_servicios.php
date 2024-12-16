<?php

include_once 'clases/tcpdf/tcpdf.php';
include_once 'clases/conexion.php';

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 0, 'Pag. ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }

}

// create new PDF document // CODIFICACION POR DEFECTO ES UTF-8
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Susana Vera');
$pdf->SetTitle('REPORTE DE PRESUPUESTO SERVICIOS');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
$pdf->setPrintHeader(false);
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins POR DEFECTO
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetMargins(8,10, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks SALTO AUTOMATICO Y MARGEN INFERIOR
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);


// ---------------------------------------------------------
// TIPO DE LETRA
$pdf->SetFont('times', 'B', 14);

// AGREGAR PAGINA
$pdf->AddPage('L', 'LEGAL');
//celda para titulo
$pdf->Cell(0, 0, "REPORTE DE PRESUPUESTO SERVICIOS", 0, 1, 'C');
//SALTO DE LINEA
$pdf->Ln();

//COLOR DE TABLA
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.2);


//$pdf->Ln(); //salto
$pdf->SetFont('', '');
$pdf->SetFillColor(255, 255, 255);



if ($_REQUEST['vop'] == '1') {

//consulta a la base de datos
    $compras = consultas::get_datos("select * from v_presupuesto_servi "
                    . "where fecha between '" . $_REQUEST['vdesde'] . 
            "' and '" . $_REQUEST['vhasta'] . "' order by cod_presu_servi");

    if (!empty($compras)) {

        foreach ($compras as $compra) {
            $pdf->SetFont('', 'B', 10);
            //columnas
            $pdf->SetFillColor(180, 180, 180);
            $pdf->Cell(20, 5, '# PRESU', 0, 0, 'C', 1);
            $pdf->Cell(40, 5, 'SUCURSAL', 0, 0, 'C', 1);
            $pdf->Cell(50, 5, 'CLIENTE',0 , 0, 'C', 1);
            $pdf->Cell(30, 5, 'RUC O CI', 0, 0, 'C', 1);
//            $pdf->Cell(30, 5, 'CONDICION',0 , 0, 'C', 1);
            $pdf->Cell(30, 5, 'TOTAL', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'FECHA', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'VIGENCIA', 0, 0, 'C', 1);
            $pdf->Cell(80, 5, 'ESTADO', 0, 0, 'C', 1);
            
            $pdf->Ln();

            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetFont('', '', 10);
            $pdf->Cell(20, 5, $compra['cod_presu_servi'], 0, 0, 'C', 1);
            $pdf->Cell(40, 5, $compra['suc_descri'], 0, 0, 'C', 1);
            $pdf->Cell(50, 5, $compra['cliente'], 0, 0, 'C', 1);
            $pdf->Cell(30, 5, $compra['per_ci_ruc'], 0, 0, 'C', 1);
//            $pdf->Cell(30, 5, $compra['com_condicion'], 0, 0, 'C', 1);
            $pdf->Cell(30, 5, number_format($compra['total'], 0, ',', '.'), 0, 0, 'C', 1);
            $pdf->Cell(30, 5, $compra['vfecha'], 0, 0, 'C', 1);
            $pdf->Cell(30, 5, $compra['vfecha_vigen'], 0, 0, 'C', 1);
            $pdf->Cell(30, 5, $compra['estado'], 0, 0, 'C', 1);
            $pdf->Ln(); //salto
//            
            $pdf->Ln();
            $pdf->SetFont('times', 'B', 9);
            $pdf->Cell(0, 3, 'DETALLE DE PRESU NRO.:    ' . $compra['cod_presu_servi'], 0, 0, 'C', 0);
            $pdf->Ln();
           
            $detalles = consultas::get_datos("select * from v_deta_presu_servi "
         . "where cod_presu_servi=".$compra['cod_presu_servi']." order by cod_presu_servi");
            if (!empty($detalles)) {
            
            $pdf->SetFont('', 'B', 10);
            $pdf->SetFillColor(188, 188, 188);
            $pdf->Cell(20, 5, 'COD', 1, 0, 'C', 1);
            $pdf->Cell(65, 5, 'REPUESTO', 1, 0, 'C', 1);
            $pdf->Cell(65, 5, 'SERVICIO', 1, 0, 'C', 1);
            $pdf->Cell(50, 5, 'PRECIO', 1, 0, 'C', 1);
            $pdf->Cell(40, 5, 'CANT', 1, 0, 'C', 1);
            $pdf->Cell(60, 5, 'SUBTOTAL', 1, 0, 'C', 1);
            $pdf->Ln(); //salto
            
            $pdf->SetFont('', '', 10);
            $pdf->SetFillColor(255, 255, 255);
            
            foreach ($detalles as $detalle) {
                
                $pdf->Cell(20, 5, $detalle['cod_art'], 1, 0, 'C', 1);
                $pdf->Cell(65, 5, $detalle['art_descri'], 1, 0, 'C', 1);
                $pdf->Cell(65, 5, $detalle['descri_servicio'], 1, 0, 'C', 1);
                $pdf->Cell(50, 5, number_format($detalle['precio'], 0, ',', '.'), 1, 0, 'C', 1);
                $pdf->Cell(40, 5, $detalle['cantidad_arti'], 1, 0, 'C', 1);
                $pdf->Cell(60, 5, number_format($detalle['subtotal'], 0, ',', '.'), 1, 0, 'C', 1);
                $pdf->Ln();
                
            }
             } else{
        $pdf->SetFont('times', 'B', '14');
        $pdf->SetFillColor(255, 255, 255);
//        $pdf->SetTextColor(255, 0, 0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->Cell(320, 6, 'NO SE ENCUENTRAN DETALLES', 0, 0, 'C', 0);
            }
            $pdf->Ln();          
            $pdf->Cell(350, 0, '----------------------------------------------------------------------------------------------------------------------------------------'
                    . '--------------------------------------------------------------------------------------------------------------', 0, 1, 'L');
            $pdf->Ln();
        }
        
    } else {
        $pdf->SetFont('times', 'B', '14');
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(255, 0, 0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->Cell(320, 6, 'NO SE ENCUENTRAN DATOS', 0, 0, 'C', 0);
    }
}
if ($_REQUEST['vop'] == '2') {

//consulta a la base de datos
    $compras = consultas::get_datos("select * from v_presupuesto_servi "
                    . "where id_cliente=" . $_REQUEST['vprov'] . " order by cod_presu_servi");
    
    if (!empty($compras)) {

        foreach ($compras as $compra) {
            $pdf->SetFont('', 'B', 10);
            //columnas
            $pdf->SetFillColor(180, 180, 180);
            $pdf->Cell(20, 5, '# PRESU', 0, 0, 'C', 1);
            $pdf->Cell(40, 5, 'SUCURSAL', 0, 0, 'C', 1);
            $pdf->Cell(50, 5, 'CLIENTE',0 , 0, 'C', 1);
            $pdf->Cell(30, 5, 'RUC O CI', 0, 0, 'C', 1);
//            $pdf->Cell(30, 5, 'CONDICION',0 , 0, 'C', 1);
            $pdf->Cell(30, 5, 'TOTAL', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'FECHA', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'VIGENCIA', 0, 0, 'C', 1);
            $pdf->Cell(80, 5, 'ESTADO', 0, 0, 'C', 1);
            
            $pdf->Ln();

            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetFont('', '', 10);
            $pdf->Cell(20, 5, $compra['cod_presu_servi'], 0, 0, 'C', 1);
            $pdf->Cell(40, 5, $compra['suc_descri'], 0, 0, 'C', 1);
            $pdf->Cell(50, 5, $compra['cliente'], 0, 0, 'C', 1);
            $pdf->Cell(30, 5, $compra['per_ci_ruc'], 0, 0, 'C', 1);
//            $pdf->Cell(30, 5, $compra['com_condicion'], 0, 0, 'C', 1);
            $pdf->Cell(30, 5, number_format($compra['total'], 0, ',', '.'), 0, 0, 'C', 1);
            $pdf->Cell(30, 5, $compra['vfecha'], 0, 0, 'C', 1);
            $pdf->Cell(30, 5, $compra['vfecha_vigen'], 0, 0, 'C', 1);
            $pdf->Cell(30, 5, $compra['estado'], 0, 0, 'C', 1);
            $pdf->Ln(); //salto
//            
            $pdf->Ln();
            $pdf->SetFont('times', 'B', 9);
            $pdf->Cell(0, 3, 'DETALLE DE PRESU NRO.:    ' . $compra['cod_presu_servi'], 0, 0, 'C', 0);
            $pdf->Ln();
           
            $detalles = consultas::get_datos("select * from v_deta_presu_servi "
         . "where cod_presu_servi=".$compra['cod_presu_servi']." order by cod_presu_servi");
            if (!empty($detalles)) {
            
            $pdf->SetFont('', 'B', 10);
            $pdf->SetFillColor(188, 188, 188);
            $pdf->Cell(20, 5, 'COD', 1, 0, 'C', 1);
            $pdf->Cell(65, 5, 'REPUESTO', 1, 0, 'C', 1);
            $pdf->Cell(65, 5, 'SERVICIO', 1, 0, 'C', 1);
            $pdf->Cell(50, 5, 'PRECIO', 1, 0, 'C', 1);
            $pdf->Cell(40, 5, 'CANT', 1, 0, 'C', 1);
            $pdf->Cell(60, 5, 'SUBTOTAL', 1, 0, 'C', 1);
            $pdf->Ln(); //salto
            
            $pdf->SetFont('', '', 10);
            $pdf->SetFillColor(255, 255, 255);
            
            foreach ($detalles as $detalle) {
                
                $pdf->Cell(20, 5, $detalle['cod_art'], 1, 0, 'C', 1);
                $pdf->Cell(65, 5, $detalle['art_descri'], 1, 0, 'C', 1);
                $pdf->Cell(65, 5, $detalle['descri_servicio'], 1, 0, 'C', 1);
                $pdf->Cell(50, 5, number_format($detalle['precio'], 0, ',', '.'), 1, 0, 'C', 1);
                $pdf->Cell(40, 5, $detalle['cantidad_arti'], 1, 0, 'C', 1);
                $pdf->Cell(60, 5, number_format($detalle['subtotal'], 0, ',', '.'), 1, 0, 'C', 1);
                $pdf->Ln();
                
            }
             } else{
        $pdf->SetFont('times', 'B', '14');
        $pdf->SetFillColor(255, 255, 255);
//        $pdf->SetTextColor(255, 0, 0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->Cell(320, 6, 'NO SE ENCUENTRAN DETALLES', 0, 0, 'C', 0);
            }
            $pdf->Ln();          
            $pdf->Cell(350, 0, '----------------------------------------------------------------------------------------------------------------------------------------'
                    . '--------------------------------------------------------------------------------------------------------------', 0, 1, 'L');
            $pdf->Ln();
        }
        
    } else {
        $pdf->SetFont('times', 'B', '14');
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(255, 0, 0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->Cell(320, 6, 'NO SE ENCUENTRAN DATOS', 0, 0, 'C', 0);
    } 
}
//if ($_REQUEST['vop'] == '3') {
//
////consulta a la base de datos
//    $compras = consultas::get_datos("select * from v_presupuesto_servi "
//                    . "where com_condicion='" . $_REQUEST['vcon'] . "' order by cod_presu_servi");
//
//    if (!empty($compras)) {
//
//        foreach ($compras as $compra) {
//            $pdf->SetFont('', 'B', 10);
//            //columnas
//            $pdf->SetFillColor(180, 180, 180);
//        $pdf->Cell(20, 5, '# PRESU', 0, 0, 'C', 1);
//            $pdf->Cell(40, 5, 'SUCURSAL', 0, 0, 'C', 1);
//            $pdf->Cell(50, 5, 'PROVEEDOR',0 , 0, 'C', 1);
//            $pdf->Cell(30, 5, 'RUC O CI', 0, 0, 'C', 1);
////            $pdf->Cell(30, 5, 'CONDICION',0 , 0, 'C', 1);
//            $pdf->Cell(30, 5, 'TOTAL', 0, 0, 'C', 1);
//            $pdf->Cell(30, 5, 'FECHA', 0, 0, 'C', 1);
//            $pdf->Cell(30, 5, 'VIGENCIA', 0, 0, 'C', 1);
//            $pdf->Cell(80, 5, 'ESTADO', 0, 0, 'C', 1);
//            
//            $pdf->Ln();
//
//            $pdf->SetFillColor(255, 255, 255);
//            $pdf->SetFont('', '', 10);
//             $pdf->Cell(20, 5, $compra['cod_presu_comp'], 0, 0, 'C', 1);
//            $pdf->Cell(40, 5, $compra['suc_descri'], 0, 0, 'C', 1);
//            $pdf->Cell(50, 5, $compra['proveedor'], 0, 0, 'C', 1);
//            $pdf->Cell(30, 5, $compra['per_ci_ruc'], 0, 0, 'C', 1);
////            $pdf->Cell(30, 5, $compra['com_condicion'], 0, 0, 'C', 1);
//            $pdf->Cell(30, 5, number_format($compra['total_presu_comp'], 0, ',', '.'), 0, 0, 'C', 1);
//            $pdf->Cell(30, 5, $compra['vfecha'], 0, 0, 'C', 1);
//            $pdf->Cell(30, 5, $compra['vfecha_vigen'], 0, 0, 'C', 1);
//            $pdf->Cell(30, 5, $compra['estado_presu'], 0, 0, 'C', 1);
//            $pdf->Ln(); //salto
////            
//            $pdf->Ln();
//            $pdf->SetFont('times', 'B', 9);
//            $pdf->Cell(0, 3, 'DETALLE DE COMPRA NRO.:    ' . $compra['cod_presu_comp'], 0, 0, 'C', 0);
//            $pdf->Ln();
//           
//            $detalles = consultas::get_datos("select * from v_deta_presu_compra "
//         . "where cod_presu_comp=".$compra['cod_presu_comp']." order by cod_presu_comp");
//            if (!empty($detalles)) {
//            
//            $pdf->SetFont('', 'B', 10);
//            $pdf->SetFillColor(188, 188, 188);
//            $pdf->Cell(20, 5, 'COD', 1, 0, 'C', 1);
//            $pdf->Cell(120, 5, 'ARTICULO', 1, 0, 'C', 1);
//            $pdf->Cell(50, 5, 'PRECIO COMP', 1, 0, 'C', 1);
//            $pdf->Cell(40, 5, 'CANT', 1, 0, 'C', 1);
//            $pdf->Cell(60, 5, 'SUBTOTAL', 1, 0, 'C', 1);
//            $pdf->Ln(); //salto
//            
//            $pdf->SetFont('', '', 10);
//            $pdf->SetFillColor(255, 255, 255);
//            
//            foreach ($detalles as $detalle) {
//                
//                $pdf->Cell(20, 5, $detalle['cod_art'], 1, 0, 'C', 1);
//                $pdf->Cell(120, 5, $detalle['art_descri'], 1, 0, 'C', 1);
//                $pdf->Cell(50, 5, number_format($detalle['presu_prec_comp'], 0, ',', '.'), 1, 0, 'C', 1);
//                $pdf->Cell(40, 5, $detalle['presu_canti'], 1, 0, 'C', 1);
//                $pdf->Cell(60, 5, number_format($detalle['subtotal_presu'], 0, ',', '.'), 1, 0, 'C', 1);
//                $pdf->Ln();
//                
//            }
//            } else{
//        $pdf->SetFont('times', 'B', '14');
//        $pdf->SetFillColor(255, 255, 255);
////        $pdf->SetTextColor(255, 0, 0);
//        $pdf->SetDrawColor(0, 0, 0);
//        $pdf->Cell(320, 6, 'NO SE ENCUENTRAN DETALLES', 0, 0, 'C', 0);
//            }
//            $pdf->Ln();          
//            $pdf->Cell(350, 0, '----------------------------------------------------------------------------------------------------------------------------------------'
//                    . '--------------------------------------------------------------------------------------------------------------', 0, 1, 'L');
//            $pdf->Ln();
//        }
//        
//    } else {
//        $pdf->SetFont('times', 'B', '14');
//        $pdf->SetFillColor(255, 255, 255);
//        $pdf->SetTextColor(255, 0, 0);
//        $pdf->SetDrawColor(0, 0, 0);
//        $pdf->Cell(320, 6, 'NO SE ENCUENTRAN DATOS', 0, 0, 'C', 0);
//    }
//}
if ($_REQUEST['vop'] == '4') {

//consulta a la base de datos
    $compras = consultas::get_datos("select * from v_presupuesto_servi "
                    . "where estado='" . $_REQUEST['vesta'] . "' order by cod_presu_servi");

    if (!empty($compras)) {

        foreach ($compras as $compra) {
            $pdf->SetFont('', 'B', 10);
            //columnas
            $pdf->SetFillColor(180, 180, 180);
          $pdf->Cell(20, 5, '# PRESU', 0, 0, 'C', 1);
            $pdf->Cell(40, 5, 'SUCURSAL', 0, 0, 'C', 1);
            $pdf->Cell(50, 5, 'CLIENTE',0 , 0, 'C', 1);
            $pdf->Cell(30, 5, 'RUC O CI', 0, 0, 'C', 1);
//            $pdf->Cell(30, 5, 'CONDICION',0 , 0, 'C', 1);
            $pdf->Cell(30, 5, 'TOTAL', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'FECHA', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'VIGENCIA', 0, 0, 'C', 1);
            $pdf->Cell(80, 5, 'ESTADO', 0, 0, 'C', 1);
            
            $pdf->Ln();

            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetFont('', '', 10);
            $pdf->Cell(20, 5, $compra['cod_presu_servi'], 0, 0, 'C', 1);
            $pdf->Cell(40, 5, $compra['suc_descri'], 0, 0, 'C', 1);
            $pdf->Cell(50, 5, $compra['cliente'], 0, 0, 'C', 1);
            $pdf->Cell(30, 5, $compra['per_ci_ruc'], 0, 0, 'C', 1);
//            $pdf->Cell(30, 5, $compra['com_condicion'], 0, 0, 'C', 1);
            $pdf->Cell(30, 5, number_format($compra['total'], 0, ',', '.'), 0, 0, 'C', 1);
            $pdf->Cell(30, 5, $compra['vfecha'], 0, 0, 'C', 1);
            $pdf->Cell(30, 5, $compra['vfecha_vigen'], 0, 0, 'C', 1);
            $pdf->Cell(30, 5, $compra['estado'], 0, 0, 'C', 1);
            $pdf->Ln(); //salto
//            
            $pdf->Ln();
            $pdf->SetFont('times', 'B', 9);
            $pdf->Cell(0, 3, 'DETALLE DE PRESU NRO.:    ' . $compra['cod_presu_servi'], 0, 0, 'C', 0);
            $pdf->Ln();
           
            $detalles = consultas::get_datos("select * from v_deta_presu_servi "
         . "where cod_presu_servi=".$compra['cod_presu_servi']." order by cod_presu_servi");
            if (!empty($detalles)) {
            
            $pdf->SetFont('', 'B', 10);
            $pdf->SetFillColor(188, 188, 188);
            $pdf->Cell(20, 5, 'COD', 1, 0, 'C', 1);
            $pdf->Cell(65, 5, 'REPUESTO', 1, 0, 'C', 1);
            $pdf->Cell(65, 5, 'SERVICIO', 1, 0, 'C', 1);
            $pdf->Cell(50, 5, 'PRECIO', 1, 0, 'C', 1);
            $pdf->Cell(40, 5, 'CANT', 1, 0, 'C', 1);
            $pdf->Cell(60, 5, 'SUBTOTAL', 1, 0, 'C', 1);
            $pdf->Ln(); //salto
            
            $pdf->SetFont('', '', 10);
            $pdf->SetFillColor(255, 255, 255);
            
            foreach ($detalles as $detalle) {
                
                $pdf->Cell(20, 5, $detalle['cod_art'], 1, 0, 'C', 1);
                $pdf->Cell(65, 5, $detalle['art_descri'], 1, 0, 'C', 1);
                $pdf->Cell(65, 5, $detalle['descri_servicio'], 1, 0, 'C', 1);
                $pdf->Cell(50, 5, number_format($detalle['precio'], 0, ',', '.'), 1, 0, 'C', 1);
                $pdf->Cell(40, 5, $detalle['cantidad_arti'], 1, 0, 'C', 1);
                $pdf->Cell(60, 5, number_format($detalle['subtotal'], 0, ',', '.'), 1, 0, 'C', 1);
                $pdf->Ln();
                
            }
            } else{
        $pdf->SetFont('times', 'B', '14');
        $pdf->SetFillColor(255, 255, 255);
//        $pdf->SetTextColor(255, 0, 0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->Cell(320, 6, 'NO SE ENCUENTRAN DETALLES', 0, 0, 'C', 0);
            }
            $pdf->Ln();          
            $pdf->Cell(350, 0, '----------------------------------------------------------------------------------------------------------------------------------------'
                    . '--------------------------------------------------------------------------------------------------------------', 0, 1, 'L');
            $pdf->Ln();
        }
        
    } else {
        $pdf->SetFont('times', 'B', '14');
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(255, 0, 0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->Cell(320, 6, 'NO SE ENCUENTRAN DATOS', 0, 0, 'C', 0);
    }
}
if ($_REQUEST['vop'] == '5') {

//consulta a la base de datos
    $compras = consultas::get_datos("select * from v_presupuesto_servi "
                    . "where cod_usu=" . $_REQUEST['vusu'] . " order by cod_presu_servi");

    if (!empty($compras)) {

        foreach ($compras as $compra) {
            $pdf->SetFont('', 'B', 10);
            //columnas
            $pdf->SetFillColor(180, 180, 180);
            $pdf->Cell(20, 5, '# PRESU', 0, 0, 'C', 1);
            $pdf->Cell(40, 5, 'SUCURSAL', 0, 0, 'C', 1);
            $pdf->Cell(50, 5, 'CLIENTE',0 , 0, 'C', 1);
            $pdf->Cell(30, 5, 'RUC O CI', 0, 0, 'C', 1);
//            $pdf->Cell(30, 5, 'CONDICION',0 , 0, 'C', 1);
            $pdf->Cell(30, 5, 'TOTAL', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'FECHA', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'VIGENCIA', 0, 0, 'C', 1);
            $pdf->Cell(80, 5, 'ESTADO', 0, 0, 'C', 1);
            
            $pdf->Ln();

            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetFont('', '', 10);
            $pdf->Cell(20, 5, $compra['cod_presu_servi'], 0, 0, 'C', 1);
            $pdf->Cell(40, 5, $compra['suc_descri'], 0, 0, 'C', 1);
            $pdf->Cell(50, 5, $compra['cliente'], 0, 0, 'C', 1);
            $pdf->Cell(30, 5, $compra['per_ci_ruc'], 0, 0, 'C', 1);
//            $pdf->Cell(30, 5, $compra['com_condicion'], 0, 0, 'C', 1);
            $pdf->Cell(30, 5, number_format($compra['total'], 0, ',', '.'), 0, 0, 'C', 1);
            $pdf->Cell(30, 5, $compra['vfecha'], 0, 0, 'C', 1);
            $pdf->Cell(30, 5, $compra['vfecha_vigen'], 0, 0, 'C', 1);
            $pdf->Cell(30, 5, $compra['estado'], 0, 0, 'C', 1);
            $pdf->Ln(); //salto
//            
            $pdf->Ln();
            $pdf->SetFont('times', 'B', 9);
            $pdf->Cell(0, 3, 'DETALLE DE PRESU NRO.:    ' . $compra['cod_presu_servi'], 0, 0, 'C', 0);
            $pdf->Ln();
           
           $detalles = consultas::get_datos("select * from v_deta_presu_servi "
         . "where cod_presu_servi=".$compra['cod_presu_servi']." order by cod_presu_servi");
            if (!empty($detalles)) {
            
            $pdf->SetFont('', 'B', 10);
            $pdf->SetFillColor(188, 188, 188);
            $pdf->Cell(20, 5, 'COD', 1, 0, 'C', 1);
            $pdf->Cell(65, 5, 'REPUESTO', 1, 0, 'C', 1);
            $pdf->Cell(65, 5, 'SERVICIO', 1, 0, 'C', 1);
            $pdf->Cell(50, 5, 'PRECIO', 1, 0, 'C', 1);
            $pdf->Cell(40, 5, 'CANT', 1, 0, 'C', 1);
            $pdf->Cell(60, 5, 'SUBTOTAL', 1, 0, 'C', 1);
            $pdf->Ln(); //salto
            
            $pdf->SetFont('', '', 10);
            $pdf->SetFillColor(255, 255, 255);
            
            foreach ($detalles as $detalle) {
                
                $pdf->Cell(20, 5, $detalle['cod_art'], 1, 0, 'C', 1);
                $pdf->Cell(65, 5, $detalle['art_descri'], 1, 0, 'C', 1);
                $pdf->Cell(65, 5, $detalle['descri_servicio'], 1, 0, 'C', 1);
                $pdf->Cell(50, 5, number_format($detalle['precio'], 0, ',', '.'), 1, 0, 'C', 1);
                $pdf->Cell(40, 5, $detalle['cantidad_arti'], 1, 0, 'C', 1);
                $pdf->Cell(60, 5, number_format($detalle['subtotal'], 0, ',', '.'), 1, 0, 'C', 1);
                $pdf->Ln();
                
            }
            } else{
        $pdf->SetFont('times', 'B', '14');
        $pdf->SetFillColor(255, 255, 255);
//        $pdf->SetTextColor(255, 0, 0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->Cell(320, 6, 'NO SE ENCUENTRAN DETALLES', 0, 0, 'C', 0);
            }
            $pdf->Ln();          
            $pdf->Cell(350, 0, '----------------------------------------------------------------------------------------------------------------------------------------'
                    . '--------------------------------------------------------------------------------------------------------------', 0, 1, 'L');
            $pdf->Ln();
        }
        
    } else {
        $pdf->SetFont('times', 'B', '14');
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(255, 0, 0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->Cell(320, 6, 'NO SE ENCUENTRAN DATOS', 0, 0, 'C', 0);
    }
}
//if ($_REQUEST['vop'] == '6') {
//
////consulta a la base de datos
//    $compras = consultas::get_datos("select * from v_presupuesto_servi "
//                    . "where estado='" . $_REQUEST['vorden'] . "' order by cod_presu_servi");
//
//    if (!empty($compras)) {
//
//        foreach ($compras as $compra) {
//            $pdf->SetFont('', 'B', 10);
//            //columnas
//            $pdf->SetFillColor(180, 180, 180);
//            $pdf->Cell(20, 5, '# PRESU', 0, 0, 'C', 1);
//            $pdf->Cell(40, 5, 'SUCURSAL', 0, 0, 'C', 1);
//            $pdf->Cell(50, 5, 'PROVEEDOR',0 , 0, 'C', 1);
//            $pdf->Cell(30, 5, 'RUC O CI', 0, 0, 'C', 1);
////            $pdf->Cell(30, 5, 'CONDICION',0 , 0, 'C', 1);
//            $pdf->Cell(30, 5, 'TOTAL', 0, 0, 'C', 1);
//            $pdf->Cell(30, 5, 'FECHA', 0, 0, 'C', 1);
//            $pdf->Cell(30, 5, 'VIGENCIA', 0, 0, 'C', 1);
//            $pdf->Cell(80, 5, 'ESTADO', 0, 0, 'C', 1);
//            
//            $pdf->Ln();
//
//            $pdf->SetFillColor(255, 255, 255);
//            $pdf->SetFont('', '', 10);
//            $pdf->Cell(20, 5, $compra['cod_presu_comp'], 0, 0, 'C', 1);
//            $pdf->Cell(40, 5, $compra['suc_descri'], 0, 0, 'C', 1);
//            $pdf->Cell(50, 5, $compra['proveedor'], 0, 0, 'C', 1);
//            $pdf->Cell(30, 5, $compra['per_ci_ruc'], 0, 0, 'C', 1);
////            $pdf->Cell(30, 5, $compra['com_condicion'], 0, 0, 'C', 1);
//            $pdf->Cell(30, 5, number_format($compra['total_presu_comp'], 0, ',', '.'), 0, 0, 'C', 1);
//            $pdf->Cell(30, 5, $compra['vfecha'], 0, 0, 'C', 1);
//            $pdf->Cell(30, 5, $compra['vfecha_vigen'], 0, 0, 'C', 1);
//            $pdf->Cell(30, 5, $compra['estado_presu'], 0, 0, 'C', 1);
//            
//            $pdf->Ln(); //salto
////            
//            $pdf->Ln();
//            $pdf->SetFont('times', 'B', 9);
//            $pdf->Cell(0, 3, 'DETALLE DE COMPRA NRO.:    ' . $compra['cod_presu_comp'], 0, 0, 'C', 0);
//            $pdf->Ln();
//           
//            $detalles = consultas::get_datos("select * from v_deta_presu_compra "
//         . "where cod_presu_comp=".$compra['cod_presu_comp']." order by cod_presu_comp");
//            if (!empty($detalles)) {
//            
//            $pdf->SetFont('', 'B', 10);
//            $pdf->SetFillColor(188, 188, 188);
//            $pdf->Cell(20, 5, 'COD', 1, 0, 'C', 1);
//            $pdf->Cell(120, 5, 'ARTICULO', 1, 0, 'C', 1);
//            $pdf->Cell(50, 5, 'PRECIO COMP', 1, 0, 'C', 1);
//            $pdf->Cell(40, 5, 'CANT', 1, 0, 'C', 1);
//            $pdf->Cell(60, 5, 'SUBTOTAL', 1, 0, 'C', 1);
//            $pdf->Ln(); //salto
//            
//            $pdf->SetFont('', '', 10);
//            $pdf->SetFillColor(255, 255, 255);
//            
//            foreach ($detalles as $detalle) {
//                
//                 $pdf->Cell(20, 5, $detalle['cod_art'], 1, 0, 'C', 1);
//                $pdf->Cell(120, 5, $detalle['art_descri'], 1, 0, 'C', 1);
//                $pdf->Cell(50, 5, number_format($detalle['presu_prec_comp'], 0, ',', '.'), 1, 0, 'C', 1);
//                $pdf->Cell(40, 5, $detalle['presu_canti'], 1, 0, 'C', 1);
//                $pdf->Cell(60, 5, number_format($detalle['subtotal_presu'], 0, ',', '.'), 1, 0, 'C', 1);
//                $pdf->Ln();
//                
//            }
//            } else{
//        $pdf->SetFont('times', 'B', '14');
//        $pdf->SetFillColor(255, 255, 255);
////        $pdf->SetTextColor(255, 0, 0);
//        $pdf->SetDrawColor(0, 0, 0);
//        $pdf->Cell(320, 6, 'NO SE ENCUENTRAN DETALLES', 0, 0, 'C', 0);
//            }
//            $pdf->Ln();          
//            $pdf->Cell(350, 0, '----------------------------------------------------------------------------------------------------------------------------------------'
//                    . '--------------------------------------------------------------------------------------------------------------', 0, 1, 'L');
//            $pdf->Ln();
//        }
//        
//    } else {
//        $pdf->SetFont('times', 'B', '14');
//        $pdf->SetFillColor(255, 255, 255);
//        $pdf->SetTextColor(255, 0, 0);
//        $pdf->SetDrawColor(0, 0, 0);
//        $pdf->Cell(320, 6, 'NO SE ENCUENTRAN DATOS', 0, 0, 'C', 0);
//    }
//}


//SALIDA AL NAVEGADOR
$pdf->Output('reporte_orden.pdf', 'I');
?>
