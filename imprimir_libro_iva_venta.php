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
$pdf->SetTitle('REPORTE DE LIBRO IVA VENTAS');
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
$pdf->Cell(0, 0, "REPORTE DE LIBRO IVA VENTAS", 0, 1, 'C');
//SALTO DE LINEA
$pdf->Ln();

//COLOR DE TABLA
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.2);

$pdf->SetFont('', 'B', 10);
//columnas
$pdf->SetFillColor(180, 180, 180);
$pdf->Cell(30, 5, 'CODIGO', 1, 0, 'C', 1);
$pdf->Cell(30, 5, 'VENTA N°', 1, 0, 'C', 1);
$pdf->Cell(30, 5, 'N° FACTURA', 1, 0, 'C', 1);
$pdf->Cell(30, 5, 'CLIENTE', 1, 0, 'C', 1);
$pdf->Cell(30, 5, 'FECHA', 1, 0, 'C', 1);
$pdf->Cell(30, 5, 'IVA 5%', 1, 0, 'C', 1);
$pdf->Cell(30, 5, 'IVA 10%', 1, 0, 'C', 1);
$pdf->Cell(30, 5, 'EXENTA', 1, 0, 'C', 1);
$pdf->Cell(30, 5, 'GRA 5%', 1, 0, 'C', 1);
$pdf->Cell(30, 5, 'GRA 10%', 1, 0, 'C', 1);
$pdf->Cell(0, 5, 'ESTADO', 1, 0, 'C', 1);
//$pdf->Cell(40, 5, 'CIUDAD', 1, 0, 'C', 1);

$pdf->Ln(); //salto
$pdf->SetFont('', '');
$pdf->SetFillColor(255, 255, 255);




if ($_REQUEST['vop'] == '1') {
//consulta a la base de datos
    $ctas_pagar = consultas::get_datos("select * from v_libros_iva_venta "
                    . "where fecha between '" . $_REQUEST['vdesde'] . 
            "' and '" . $_REQUEST['vhasta'] . "' order by cod_libro_iva_vent");
    if (!empty($ctas_pagar)) {
        foreach ($ctas_pagar as $cta_pagar) {
            $pdf->Cell(30, 5, $cta_pagar['cod_libro_iva_vent'], 1, 0, 'C', 1);
            $pdf->Cell(30, 5, $cta_pagar['cod_factura'], 1, 0, 'C', 1);
            $pdf->Cell(30, 5, $cta_pagar['num_factura'], 1, 0, 'C', 1);
            $pdf->Cell(30, 5, $cta_pagar['cliente'], 1, 0, 'C', 1);
            $pdf->Cell(30, 5, $cta_pagar['fecha'], 1, 0, 'L', 1);
            $pdf->Cell(30, 5,number_format(($cta_pagar['iva_5']),0,',','.'), 1, 0, 'L', 1);
            $pdf->Cell(30, 5, number_format(($cta_pagar['iva_10']),0,',','.'), 1, 0, 'L', 1);
            $pdf->Cell(30, 5, number_format(($cta_pagar['exenta']),0,',','.'), 1, 0, 'L', 1);
            $pdf->Cell(30, 5, number_format(($cta_pagar['grabada_5']),0,',','.'), 1, 0, 'L', 1);
            $pdf->Cell(30, 5, number_format(($cta_pagar['gravada_10']),0,',','.'), 1, 0, 'L', 1);
            $pdf->Cell(0, 5, $cta_pagar['estado'], 1, 0, 'C', 1);
//            $pdf->Cell(40, 5, $cta_pagar['ciu_des'], 1, 0, 'L', 1);
            $pdf->Ln(); //salto
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
    $ctas_pagar = consultas::get_datos("select * from v_libros_iva_venta "
                    . "where estado='" . $_REQUEST['vesta'] . "' order by cod_libro_iva_vent");
    if (!empty($ctas_pagar)) {
        foreach ($ctas_pagar as $cta_pagar) {
            $pdf->Cell(30, 5, $cta_pagar['cod_libro_iva_vent'], 1, 0, 'C', 1);
            $pdf->Cell(30, 5, $cta_pagar['cod_factura'], 1, 0, 'C', 1);
            $pdf->Cell(30, 5, $cta_pagar['num_factura'], 1, 0, 'C', 1);
            $pdf->Cell(30, 5, $cta_pagar['cliente'], 1, 0, 'C', 1);
            $pdf->Cell(30, 5, $cta_pagar['fecha'], 1, 0, 'L', 1);
            $pdf->Cell(30, 5,number_format(($cta_pagar['iva_5']),0,',','.'), 1, 0, 'L', 1);
            $pdf->Cell(30, 5, number_format(($cta_pagar['iva_10']),0,',','.'), 1, 0, 'L', 1);
            $pdf->Cell(30, 5, number_format(($cta_pagar['exenta']),0,',','.'), 1, 0, 'L', 1);
            $pdf->Cell(30, 5, number_format(($cta_pagar['grabada_5']),0,',','.'), 1, 0, 'L', 1);
            $pdf->Cell(30, 5, number_format(($cta_pagar['gravada_10']),0,',','.'), 1, 0, 'L', 1);
            $pdf->Cell(0, 5, $cta_pagar['estado'], 1, 0, 'C', 1);
//            $pdf->Cell(40, 5, $cta_pagar['ciu_des'], 1, 0, 'L', 1);
            $pdf->Ln(); //salto
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
    $ctas_pagar = consultas::get_datos("select * from v_libros_iva_venta "
                    . "where id_cliente='" . $_REQUEST['vprov'] . "' order by cod_libro_iva_vent");
    if (!empty($ctas_pagar)) {
        foreach ($ctas_pagar as $cta_pagar) {
            $pdf->Cell(30, 5, $cta_pagar['cod_libro_iva_vent'], 1, 0, 'C', 1);
            $pdf->Cell(30, 5, $cta_pagar['cod_factura'], 1, 0, 'C', 1);
            $pdf->Cell(30, 5, $cta_pagar['num_factura'], 1, 0, 'C', 1);
            $pdf->Cell(30, 5, $cta_pagar['cliente'], 1, 0, 'C', 1);
            $pdf->Cell(30, 5, $cta_pagar['fecha'], 1, 0, 'L', 1);
            $pdf->Cell(30, 5,number_format(($cta_pagar['iva_5']),0,',','.'), 1, 0, 'L', 1);
            $pdf->Cell(30, 5, number_format(($cta_pagar['iva_10']),0,',','.'), 1, 0, 'L', 1);
            $pdf->Cell(30, 5, number_format(($cta_pagar['exenta']),0,',','.'), 1, 0, 'L', 1);
            $pdf->Cell(30, 5, number_format(($cta_pagar['grabada_5']),0,',','.'), 1, 0, 'L', 1);
            $pdf->Cell(30, 5, number_format(($cta_pagar['gravada_10']),0,',','.'), 1, 0, 'L', 1);
            $pdf->Cell(0, 5, $cta_pagar['estado'], 1, 0, 'C', 1);
//            $pdf->Cell(40, 5, $cta_pagar['ciu_des'], 1, 0, 'L', 1);
            $pdf->Ln(); //salto
        }
    } else {
        $pdf->SetFont('times', 'B', '14');
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(255, 0, 0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->Cell(320, 6, 'NO SE ENCUENTRAN DATOS', 0, 0, 'C', 0);
    }
    
}

 $ctas_pagar2 = consultas::get_datos("select * from v_libros_iva_vent_totales ");

//cuadro de subtotales
//$pdf->RoundedRect(15, 129, 177, 30, 4.0, '1111', '', 
//        $style6, array(200, 200, 200));

$pdf->SetFont('Times', 'B', 10);
$pdf->Text(21, 160, 'TOTAL IVAS:');
$pdf->SetFont('Times', '', 10);
$pdf->Text(50, 160, 'Gs. '.number_format(($ctas_pagar2[0]['totales_ivas']),0,',','.'));
$pdf->SetFont('Times', '', 10);
$pdf->Text(100, 160, 'Total iva 5% Gs.: '.number_format(($ctas_pagar2[0]['total_iva_5']),0,',','.'));
$pdf->SetFont('Times', '', 10);
$pdf->Text(150, 160, 'Total iva 10% Gs.: '.number_format(($ctas_pagar2[0]['total_iva_10']),0,',','.'));
$pdf->SetFont('Times', '', 10);
$pdf->Text(220, 160, 'Total exenta: Gs.'.number_format(($ctas_pagar2[0]['total_exenta']),0,',','.'));
$pdf->SetFont('Times', 'B', 10);


$pdf->SetFont('Times', 'B', 10);
$pdf->Text(21, 180, 'TOTAL GRABADAS:');
$pdf->SetFont('Times', '', 10);
$pdf->Text(60, 180, 'Gs. '.number_format(($ctas_pagar2[0]['totales_grabadas']),0,',','.'));
$pdf->SetFont('Times', '', 10);
$pdf->Text(100, 180, 'Total Grabada 5% Gs.: '.number_format(($ctas_pagar2[0]['total_grabada_5']),0,',','.'));
$pdf->SetFont('Times', '', 10);
$pdf->Text(150, 180, 'Total Grabada 10% Gs.: '.number_format(($ctas_pagar2[0]['total_grabada_10']),0,',','.'));
$pdf->SetFont('Times', '', 10);
//$pdf->Text(220, 150, 'Total exenta: Gs.'.number_format(($ctas_pagar2[0]['total_exenta']),0,',','.'));
//$pdf->SetFont('Times', 'B', 10);



//SALIDA AL NAVEGADOR
$pdf->Output('reporte_ctaspagar.pdf', 'I');
?>

