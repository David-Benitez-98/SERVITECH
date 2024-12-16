<?php

// Include the main TCPDF library (search for installation path).
include_once 'clases/tcpdf/tcpdf.php';
include_once 'clases/conexion.php';

$sqlventas = "select *,(select numero_letras(comp_total)) "
        . "as total_letra "
      . " from v_comprasFACTURA where id_compra = " . 
        $_REQUEST ['vdetcompra'] . "";
$rsventas = consultas::get_datos($sqlventas);


// create new PDF document
$pdf = new TCPDF('P', 'mm', 'A4');
$pdf->SetMargins(15, 15, 18);
$pdf->SetTitle('FACTURACION');
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);

$pdf->AddPage();

$pdf->Ln(5);
$pdf->SetFont('Times', 'B', 18);

$pdf->Cell(85, 1, $rsventas[0]['prov_proveedor'], 0, 0, 'C',null,1);
//$pdf->Cell(85, 1, 'NEW ERA', 0, 0, 'C',null,null,1);

$pdf->Cell(100, 1, 'FACTURA ' . $rsventas[0]['compra_cond'], 0, 1, 'C');

$pdf->SetFont('Times', 'B', 12);

$pdf->Cell(85, 1, 'VENTAS AL POR MAYOR Y MENOR', 0, 0, 'C');

$pdf->Cell(100, 1, 'NRO.: ' . $rsventas[0]['compra_fact'], 0, 1, 'C');

$pdf->SetFont('Times', '', 12);

$pdf->Cell(85, 1, $rsventas[0]['ciu_descrip'], 0, 1, 'C');
//$pdf->Cell(85, 1, 'Dirección: OTAZU C/ANA DIAZ', 0, 1, 'C');

$pdf->Cell(100, 1, 'TIMBRADO .: ' . $rsventas[0]['timbr_nro'], 0, 1, 'C');
$pdf->Cell(100, 1, 'TELEFONO .: ' . $rsventas[0]['prov_telef'], 0, 0, 'C');

//$pdf->Cell(85, 1, 'Teléfono: 0983 181 352', 0, 0, 'C');
//$pdf->Cell(80, 1, 'VIGENCIA INICIO.: ' . $rsventas[0]['prov_vigencia_inic'], 0, 0, 'C');

$pdf->Cell(80, 1, 'VIGENCIA FIN.: ' . $rsventas[0]['timb_fecha_fin'], 0, 1, 'C');
//$pdf->Cell(80, 1, 'VIGENCIA INICIO.: ' . $rsventas[0]['prov_vigencia_inic'], 0, 0, 'C');
//$pdf->Cell(100, 1, 'Vigencia: ' . '2017-12-31', 0, 1, 'C');

$style6 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0));
//$pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 255)));

//cuadros de arriba
$pdf->RoundedRect(15, 12, 90, 50, 6.0, '1111', '', $style6, array(200, 200, 200));
$pdf->RoundedRect(105, 12, 87, 50, 6.0, '1111', '', $style6, array(200, 200, 200));

//cuadro de cabecera
$pdf->RoundedRect(15, 62, 177, 30, 5.0, '1111', '', $style6, array(200, 200, 200));

//datos de cabecera
$pdf->Ln(22);
//Fecha
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(30, 1, '   FECHA: ', 0, 0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(/*1*/90, /*2*/1, /*3*/$rsventas[0]['fecha_compra_fact'], /*4*/0, /*5*/1, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);
$pdf->Ln(3);
//nombre cliente
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(30, 1, '   CLIENTE: ', 0, 0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(/*1*/90, /*2*/1, /*3*/'KAMBLACK STORE', /*4*/0, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);

//ruc cliente
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(20, 1, 'RUC o CI: ', 0, 0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(90, 1,'4634512-4', 0, 1, 'L');

$pdf->Ln(3);
//dirección cliente
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(30, 1, '   DIRECCION: ', 0, 0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(/*1*/90, /*2*/1, /*3*/'ESPAÑA CARMELITAS', /*4*/0, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);


//telefono cliente
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(25, 1, 'TELEFONO:   ', 0, 0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(/*1*/37, /*2*/1, /*3*/'098858585', /*4*/0, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);

//cuadro de detalles
$pdf->RoundedRect(15, 92, 177, 140, 5.0, '1111', '', $style6, array(200, 200, 200));

$pdf->Ln(20);
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(15, 1, '#', 0, 0, 'C');
$pdf->Cell(51, 1, 'Descripcion', 0, 0, 'L');
$pdf->Cell(25, 1, 'Cant.', 0, 0, 'C');
$pdf->Cell(40, 1, 'Precio Unit', 0, 0, 'R');
$pdf->Cell(30, 1, 'Subtotal', 0, 0, 'R');
$pdf->Ln(5);

$consultas = "select * from v_compdetalle where id_compra=".$_REQUEST ['vdetcompra'];
$detventas = consultas::get_datos($consultas);
if (!empty($detventas)) {
foreach ($detventas as $report) {
    $pdf->SetFont('Times', '', 10);
    $pdf->Cell(15, 1, $report['id_articulo'], 0, 0, 'C');
    $pdf->Cell(51, 1, /*3*/$report['articulo'], 0, 0,'L',null,null,1,null,null,null);
    $pdf->Cell(25, 1,$report['det_comp_cant'] , 0, 0, 'C');
    $pdf->Cell(40, 1, $report['det_comp_precio'] , 0, 0, 'R'); 
    $pdf->Cell(30, 1, number_format(($report['det_comp_subt']),0,',','.'), 0, 1, 'R');
}} else {
        $pdf->SetFont('times', 'B', '14');
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(255, 0, 0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->Cell(320, 6, '', 0, 0, 'C', 0);
    }
$posicion = $pdf->GetY();
$pdf->Line(190,230,15,$posicion);


//cuadro de subtotales
$pdf->RoundedRect(15, 232, 177, 30, 4.0, '1111', '', 
        $style6, array(200, 200, 200));


$pdf->SetFont('Times', 'B', 10);
$pdf->Text(18, 243, 'TOTAL GENERAL');
$pdf->SetFont('Times', '', 10);
$pdf->Text(165, 243, 'Gs. '.
        number_format(($rsventas[0]['comp_total']),0,',','.'));
$pdf->SetFont('Times', 'B', 10);
$pdf->Text(18, 251, 'TOTAL EN LETRAS');
$pdf->SetFont('Times', '', 10);
$pdf->Text(55, 251, 'Son Gs. '.
        ucfirst(strtolower ($rsventas[0]['total_letra'])));
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('factura.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

