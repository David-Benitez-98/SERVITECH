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
$pdf->SetTitle('REPORTE DE COBROS');
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
$pdf->Cell(0, 0, "REPORTE DE COBROS", 0, 1, 'C');
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
    $cobros = consultas::get_datos("select * from v_cobros_1 "
                    . "where cob_fecha between '" . $_REQUEST['vdesde'] . 
            "' and '" . $_REQUEST['vhasta'] . "' order by cob_cod");

    if (!empty($cobros)) {

        foreach ($cobros as $cob) {
            $pdf->SetFont('', 'B', 10);
            //columnas
            $pdf->SetFillColor(180, 180, 180);
            $pdf->Cell(20, 5, '# COBRO', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'FECHA', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'EFECTIVO', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'TARJETA',0 , 0, 'C', 1);
            $pdf->Cell(30, 5, 'CHEQUE', 0, 0, 'C', 1);
            $pdf->Cell(40, 5, 'TOTAL COBRO', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'N° APERTURA',0 , 0, 'C', 1);
            $pdf->Cell(40, 5, 'USUARIO', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'ESTADO', 0, 0, 'C', 1);
            
            $pdf->Ln();

            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetFont('', '', 10);
            $pdf->Cell(20, 5, $cob['cob_cod'], 0, 0, 'C', 1);
            $pdf->Cell(30, 5, $cob['vfecha'], 0, 0, 'C', 1);
            $pdf->Cell(30, 5, number_format($cob['efectivo'], 0, ',', '.'), 0, 0, 'C', 1);
            $pdf->Cell(30, 5, number_format($cob['tarjeta'], 0, ',', '.'), 0, 0, 'C', 1);
            $pdf->Cell(30, 5, number_format($cob['cheque'], 0, ',', '.'), 0, 0, 'C', 1);
            $pdf->Cell(40, 5, number_format($cob['monto_total'], 0, ',', '.'), 0, 0, 'C', 1);
            $pdf->Cell(30, 5, $cob['ape_nro'], 0, 0, 'C', 1);
            $pdf->Cell(40, 5, $cob['usuario'], 0, 0, 'C', 1);
            $pdf->Cell(30, 5, $cob['cob_estado'], 0, 0, 'C', 1);
            $pdf->Ln(); //salto
//            
            $pdf->Ln();
            $pdf->SetFont('times', 'B', 9);
            $pdf->Cell(0, 3, 'DETALLE DE COBRO NRO.:    ' . $cob['cob_cod'], 0, 0, 'C', 0);
            $pdf->Ln();
           
            $detalles = consultas::get_datos("select * from v_deta_cobros "
         . "where cob_cod=".$cob['cob_cod']." order by cob_cod");
            if (!empty($detalles)) {
            
            $pdf->SetFont('', 'B', 10);
            $pdf->SetFillColor(188, 188, 188);
            $pdf->Cell(20, 5, '# CUENTA', 1, 0, 'C', 1);
            $pdf->Cell(25, 5, '# VENTA', 1, 0, 'C', 1);
            $pdf->Cell(35, 5, 'N° CUOTA', 1, 0, 'C', 1);
            $pdf->Cell(130, 5, 'DESCRIPCION', 1, 0, 'C', 1);
            $pdf->Cell(50, 5, 'CLIENTE', 1, 0, 'C', 1);
            $pdf->Cell(50, 5, 'ESTADO', 1, 0, 'C', 1);
            $pdf->Ln(); //salto
            
            $pdf->SetFont('', '', 10);
            $pdf->SetFillColor(255, 255, 255);
            
            foreach ($detalles as $detalle) {
                
                $pdf->Cell(20, 5, $detalle['cta_id'], 1, 0, 'C', 1);
                $pdf->Cell(25, 5, $detalle['cod_factura'], 1, 0, 'C', 1);
                $pdf->Cell(35, 5, $detalle['cta_cuo_nro'], 1, 0, 'C', 1);
                $pdf->Cell(130, 5, $detalle['descripcion'], 1, 0, 'C', 1);
                $pdf->Cell(50, 5, $detalle['cliente'], 1, 0, 'C', 1);
                $pdf->Cell(50, 5, $detalle['cta_estado'], 1, 0, 'C', 1);
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
    $cobros = consultas::get_datos("select * from v_cobros_1 "
                    . "where cod_usu=" . $_REQUEST['vusu'] . " order by cob_cod");
    
    if (!empty($cobros)) {

        foreach ($cobros as $cob) {
            $pdf->SetFont('', 'B', 10);
            //columnas
            $pdf->SetFillColor(180, 180, 180);
            $pdf->Cell(20, 5, '# COBRO', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'FECHA', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'EFECTIVO', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'TARJETA',0 , 0, 'C', 1);
            $pdf->Cell(30, 5, 'CHEQUE', 0, 0, 'C', 1);
            $pdf->Cell(40, 5, 'TOTAL COBRO', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'N° APERTURA',0 , 0, 'C', 1);
            $pdf->Cell(40, 5, 'USUARIO', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'ESTADO', 0, 0, 'C', 1);
            
            $pdf->Ln();

            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetFont('', '', 10);
            $pdf->Cell(20, 5, $cob['cob_cod'], 0, 0, 'C', 1);
            $pdf->Cell(30, 5, $cob['vfecha'], 0, 0, 'C', 1);
            $pdf->Cell(30, 5, number_format($cob['efectivo'], 0, ',', '.'), 0, 0, 'C', 1);
            $pdf->Cell(30, 5, number_format($cob['tarjeta'], 0, ',', '.'), 0, 0, 'C', 1);
            $pdf->Cell(30, 5, number_format($cob['cheque'], 0, ',', '.'), 0, 0, 'C', 1);
            $pdf->Cell(40, 5, number_format($cob['monto_total'], 0, ',', '.'), 0, 0, 'C', 1);
            $pdf->Cell(30, 5, $cob['ape_nro'], 0, 0, 'C', 1);
            $pdf->Cell(40, 5, $cob['usuario'], 0, 0, 'C', 1);
            $pdf->Cell(30, 5, $cob['cob_estado'], 0, 0, 'C', 1);
            $pdf->Ln(); //salto
//            
            $pdf->Ln();
            $pdf->SetFont('times', 'B', 9);
            $pdf->Cell(0, 3, 'DETALLE DE COBRO NRO.:    ' . $cob['cob_cod'], 0, 0, 'C', 0);
            $pdf->Ln();
           
           $detalles = consultas::get_datos("select * from v_deta_cobros "
         . "where cob_cod=".$cob['cob_cod']." order by cob_cod");
            if (!empty($detalles)) {
            
            $pdf->SetFont('', 'B', 10);
            $pdf->SetFillColor(188, 188, 188);
            $pdf->Cell(20, 5, '# CUENTA', 1, 0, 'C', 1);
            $pdf->Cell(25, 5, '# VENTA', 1, 0, 'C', 1);
            $pdf->Cell(35, 5, 'N° CUOTA', 1, 0, 'C', 1);
            $pdf->Cell(130, 5, 'DESCRIPCION', 1, 0, 'C', 1);
            $pdf->Cell(50, 5, 'CLIENTE', 1, 0, 'C', 1);
            $pdf->Cell(50, 5, 'ESTADO', 1, 0, 'C', 1);
            $pdf->Ln(); //salto
            
            $pdf->SetFont('', '', 10);
            $pdf->SetFillColor(255, 255, 255);
            
            foreach ($detalles as $detalle) {
                
                $pdf->Cell(20, 5, $detalle['cta_id'], 1, 0, 'C', 1);
                $pdf->Cell(25, 5, $detalle['cod_factura'], 1, 0, 'C', 1);
                $pdf->Cell(35, 5, $detalle['cta_cuo_nro'], 1, 0, 'C', 1);
                $pdf->Cell(130, 5, $detalle['descripcion'], 1, 0, 'C', 1);
                $pdf->Cell(50, 5, $detalle['cliente'], 1, 0, 'C', 1);
                $pdf->Cell(50, 5, $detalle['cta_estado'], 1, 0, 'C', 1);
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
if ($_REQUEST['vop'] == '3') {

//consulta a la base de datos
    $cobros = consultas::get_datos("select * from v_cobros_1 "
                    . "where cob_estado='" . $_REQUEST['vesta'] . "' order by cob_cod");

    if (!empty($cobros)) {

        foreach ($cobros as $cob) {
            $pdf->SetFont('', 'B', 10);
            //columnas
            $pdf->SetFillColor(180, 180, 180);
            $pdf->Cell(20, 5, '# COBRO', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'FECHA', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'EFECTIVO', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'TARJETA',0 , 0, 'C', 1);
            $pdf->Cell(30, 5, 'CHEQUE', 0, 0, 'C', 1);
            $pdf->Cell(40, 5, 'TOTAL COBRO', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'N° APERTURA',0 , 0, 'C', 1);
            $pdf->Cell(40, 5, 'USUARIO', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'ESTADO', 0, 0, 'C', 1);
            
            $pdf->Ln();

            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetFont('', '', 10);
            $pdf->Cell(20, 5, $cob['cob_cod'], 0, 0, 'C', 1);
            $pdf->Cell(30, 5, $cob['vfecha'], 0, 0, 'C', 1);
            $pdf->Cell(30, 5, number_format($cob['efectivo'], 0, ',', '.'), 0, 0, 'C', 1);
            $pdf->Cell(30, 5, number_format($cob['tarjeta'], 0, ',', '.'), 0, 0, 'C', 1);
            $pdf->Cell(30, 5, number_format($cob['cheque'], 0, ',', '.'), 0, 0, 'C', 1);
            $pdf->Cell(40, 5, number_format($cob['monto_total'], 0, ',', '.'), 0, 0, 'C', 1);
            $pdf->Cell(30, 5, $cob['ape_nro'], 0, 0, 'C', 1);
            $pdf->Cell(40, 5, $cob['usuario'], 0, 0, 'C', 1);
            $pdf->Cell(30, 5, $cob['cob_estado'], 0, 0, 'C', 1);
            $pdf->Ln(); //salto
//            
            $pdf->Ln();
            $pdf->SetFont('times', 'B', 9);
            $pdf->Cell(0, 3, 'DETALLE DE COBRO NRO.:    ' . $cob['cob_cod'], 0, 0, 'C', 0);
            $pdf->Ln();
           
            $detalles = consultas::get_datos("select * from v_deta_cobros "
         . "where cob_cod=".$cob['cob_cod']." order by cob_cod");
            if (!empty($detalles)) {
            
            $pdf->SetFont('', 'B', 10);
            $pdf->SetFillColor(188, 188, 188);
            $pdf->Cell(20, 5, '# CUENTA', 1, 0, 'C', 1);
            $pdf->Cell(25, 5, '# VENTA', 1, 0, 'C', 1);
            $pdf->Cell(35, 5, 'N° CUOTA', 1, 0, 'C', 1);
            $pdf->Cell(130, 5, 'DESCRIPCION', 1, 0, 'C', 1);
            $pdf->Cell(50, 5, 'CLIENTE', 1, 0, 'C', 1);
            $pdf->Cell(50, 5, 'ESTADO', 1, 0, 'C', 1);
            $pdf->Ln(); //salto
            
            $pdf->SetFont('', '', 10);
            $pdf->SetFillColor(255, 255, 255);
            
            foreach ($detalles as $detalle) {
                
                $pdf->Cell(20, 5, $detalle['cta_id'], 1, 0, 'C', 1);
                $pdf->Cell(25, 5, $detalle['cod_factura'], 1, 0, 'C', 1);
                $pdf->Cell(35, 5, $detalle['cta_cuo_nro'], 1, 0, 'C', 1);
                $pdf->Cell(130, 5, $detalle['descripcion'], 1, 0, 'C', 1);
                $pdf->Cell(50, 5, $detalle['cliente'], 1, 0, 'C', 1);
                $pdf->Cell(50, 5, $detalle['cta_estado'], 1, 0, 'C', 1);
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
if ($_REQUEST['vop'] == '4') {

//consulta a la base de datos
    $cobros = consultas::get_datos("select * from v_cobros "
                    . "where descri='" . $_REQUEST['vcheque'] . "' and cheque > 0 order by descri");

    if (!empty($cobros)) {

        foreach ($cobros as $cob) {
            $pdf->SetFont('', 'B', 10);
            //columnas
            $pdf->SetFillColor(180, 180, 180);
            $pdf->Cell(20, 5, '# COBRO', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'FECHA', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'EFECTIVO', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'TARJETA',0 , 0, 'C', 1);
            $pdf->Cell(30, 5, 'CHEQUE', 0, 0, 'C', 1);
            $pdf->Cell(40, 5, 'TOTAL COBRO', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'N° APERTURA',0 , 0, 'C', 1);
            $pdf->Cell(40, 5, 'USUARIO', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'ESTADO', 0, 0, 'C', 1);
            
            $pdf->Ln();

            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetFont('', '', 10);
            $pdf->Cell(20, 5, $cob['cob_cod'], 0, 0, 'C', 1);
            $pdf->Cell(30, 5, $cob['vfecha'], 0, 0, 'C', 1);
            $pdf->Cell(30, 5, number_format($cob['efectivo'], 0, ',', '.'), 0, 0, 'C', 1);
            $pdf->Cell(30, 5, number_format($cob['tarjeta'], 0, ',', '.'), 0, 0, 'C', 1);
            $pdf->Cell(30, 5, number_format($cob['cheque'], 0, ',', '.'), 0, 0, 'C', 1);
            $pdf->Cell(40, 5, number_format($cob['monto_total'], 0, ',', '.'), 0, 0, 'C', 1);
            $pdf->Cell(30, 5, $cob['ape_nro'], 0, 0, 'C', 1);
            $pdf->Cell(40, 5, $cob['usuario'], 0, 0, 'C', 1);
            $pdf->Cell(30, 5, $cob['cob_estado'], 0, 0, 'C', 1);
            $pdf->Ln(); //salto
//            
            $pdf->Ln();
            $pdf->SetFont('times', 'B', 9);
            $pdf->Cell(0, 3, 'DETALLE DEl COBRO NRO.:    ' . $cob['cob_cod'], 0, 0, 'C', 0);
            $pdf->Ln();
           
            $detalles = consultas::get_datos("select * from v_deta_cobros "
         . "where cob_cod=".$cob['cob_cod']." order by cob_cod");
            if (!empty($detalles)) {
            
            $pdf->SetFont('', 'B', 10);
            $pdf->SetFillColor(188, 188, 188);
            $pdf->Cell(20, 5, '# CUENTA', 1, 0, 'C', 1);
            $pdf->Cell(25, 5, '# VENTA', 1, 0, 'C', 1);
            $pdf->Cell(35, 5, 'N° CUOTA', 1, 0, 'C', 1);
            $pdf->Cell(130, 5, 'DESCRIPCION', 1, 0, 'C', 1);
            $pdf->Cell(50, 5, 'CLIENTE', 1, 0, 'C', 1);
            $pdf->Cell(50, 5, 'ESTADO', 1, 0, 'C', 1);
            $pdf->Ln(); //salto
            
            $pdf->SetFont('', '', 10);
            $pdf->SetFillColor(255, 255, 255);
            
            foreach ($detalles as $detalle) {
                
                $pdf->Cell(20, 5, $detalle['cta_id'], 1, 0, 'C', 1);
                $pdf->Cell(25, 5, $detalle['cod_factura'], 1, 0, 'C', 1);
                $pdf->Cell(35, 5, $detalle['cta_cuo_nro'], 1, 0, 'C', 1);
                $pdf->Cell(130, 5, $detalle['descripcion'], 1, 0, 'C', 1);
                $pdf->Cell(50, 5, $detalle['cliente'], 1, 0, 'C', 1);
                $pdf->Cell(50, 5, $detalle['cta_estado'], 1, 0, 'C', 1);
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
    $cobros = consultas::get_datos("select * from v_cobros "
                    . "where tarjeta_tipo='" . $_REQUEST['vtarje'] . "' and tarjeta > 0 order by tarjeta_tipo");

    if (!empty($cobros)) {

        foreach ($cobros as $cob) {
            $pdf->SetFont('', 'B', 10);
            //columnas
            $pdf->SetFillColor(180, 180, 180);
            $pdf->Cell(20, 5, '# COBRO', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'FECHA', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'EFECTIVO', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'TARJETA',0 , 0, 'C', 1);
            $pdf->Cell(30, 5, 'CHEQUE', 0, 0, 'C', 1);
            $pdf->Cell(40, 5, 'TOTAL COBRO', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'N° APERTURA',0 , 0, 'C', 1);
            $pdf->Cell(40, 5, 'USUARIO', 0, 0, 'C', 1);
            $pdf->Cell(30, 5, 'ESTADO', 0, 0, 'C', 1);
            
            $pdf->Ln();

            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetFont('', '', 10);
            $pdf->Cell(20, 5, $cob['cob_cod'], 0, 0, 'C', 1);
            $pdf->Cell(30, 5, $cob['vfecha'], 0, 0, 'C', 1);
            $pdf->Cell(30, 5, number_format($cob['efectivo'], 0, ',', '.'), 0, 0, 'C', 1);
            $pdf->Cell(30, 5, number_format($cob['tarjeta'], 0, ',', '.'), 0, 0, 'C', 1);
            $pdf->Cell(30, 5, number_format($cob['cheque'], 0, ',', '.'), 0, 0, 'C', 1);
            $pdf->Cell(40, 5, number_format($cob['monto_total'], 0, ',', '.'), 0, 0, 'C', 1);
            $pdf->Cell(30, 5, $cob['ape_nro'], 0, 0, 'C', 1);
            $pdf->Cell(40, 5, $cob['usuario'], 0, 0, 'C', 1);
            $pdf->Cell(30, 5, $cob['cob_estado'], 0, 0, 'C', 1);
            $pdf->Ln(); //salto
//            
            $pdf->Ln();
            $pdf->SetFont('times', 'B', 9);
            $pdf->Cell(0, 3, 'DETALLE DE COBRO NRO.:    ' . $cob['cob_cod'], 0, 0, 'C', 0);
            $pdf->Ln();
           
             $detalles = consultas::get_datos("select * from v_deta_cobros "
         . "where cob_cod=".$cob['cob_cod']." order by cob_cod");
            if (!empty($detalles)) {
            
            $pdf->SetFont('', 'B', 10);
            $pdf->SetFillColor(188, 188, 188);
            $pdf->Cell(20, 5, '# CUENTA', 1, 0, 'C', 1);
            $pdf->Cell(25, 5, '# VENTA', 1, 0, 'C', 1);
            $pdf->Cell(35, 5, 'N° CUOTA', 1, 0, 'C', 1);
            $pdf->Cell(130, 5, 'DESCRIPCION', 1, 0, 'C', 1);
            $pdf->Cell(50, 5, 'CLIENTE', 1, 0, 'C', 1);
            $pdf->Cell(50, 5, 'ESTADO', 1, 0, 'C', 1);
            $pdf->Ln(); //salto
            
            $pdf->SetFont('', '', 10);
            $pdf->SetFillColor(255, 255, 255);
            
            foreach ($detalles as $detalle) {
                
                $pdf->Cell(20, 5, $detalle['cta_id'], 1, 0, 'C', 1);
                $pdf->Cell(25, 5, $detalle['cod_factura'], 1, 0, 'C', 1);
                $pdf->Cell(35, 5, $detalle['cta_cuo_nro'], 1, 0, 'C', 1);
                $pdf->Cell(130, 5, $detalle['descripcion'], 1, 0, 'C', 1);
                $pdf->Cell(50, 5, $detalle['cliente'], 1, 0, 'C', 1);
                $pdf->Cell(50, 5, $detalle['cta_estado'], 1, 0, 'C', 1);
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



//SALIDA AL NAVEGADOR
$pdf->Output('reporte_cobros.pdf', 'I');
?>
