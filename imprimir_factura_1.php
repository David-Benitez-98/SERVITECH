<?php

// Include the main TCPDF library (search for installation path).
include_once 'clases/tcpdf/tcpdf.php';
include_once 'clases/conexion.php';

$sqlventas = "select *,(select numero_letras(ven_total)) "
        . "as total_letra "
      . " from v_factura_imprimir_reporte where cod_factura = " . 
        $_REQUEST ['vdetcod'] . "";
$rsventas = consultas::get_datos($sqlventas);



// create new PDF document
$pdf = new TCPDF('P', 'mm', 'A4');
$pdf->SetMargins(15, 15, 18);
$pdf->SetTitle('FACTURACION');
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);

$pdf->AddPage();

$pdf->Ln(5);
$pdf->SetFont('Times', 'B', 15);

$pdf->Cell(85, 1, $rsventas[0]['suc_descri'] , 0, 0, 'C',null,1);
//$pdf->Cell(85, 1, 'NEW ERA', 0, 0, 'C',null,null,1);

$pdf->Cell(100, 1, 'FACTURA ' . $rsventas[0]['ven_condicion'], 0, 1, 'C');

$pdf->SetFont('Times', 'B', 12);

$pdf->Cell(85, 1, 'VENTAS Y SERVICIO TECNICO', 0, 0, 'C');

$pdf->Cell(100, 1, 'NRO.: ' . $rsventas[0]['nro_factura'], 0, 1, 'C');
$pdf->SetFont('Times', 'B', 12);

$pdf->Cell(85, 1, $rsventas[0]['suc_direc'], 0, 0, 'C');

$pdf->Cell(100, 1, 'RUC.: 1.025.897 - 1', 0, 1, 'C');

$pdf->SetFont('Times', '', 12);

//$pdf->Cell(85, 1, ' ', 0, 1, 'C');
//$pdf->Cell(85, 1, 'Dirección: OTAZU C/ANA DIAZ', 0, 1, 'C');

$pdf->Cell(100, 1, 'TIMBRADO .: ' . $rsventas[0]['nro_timbrado'], 0, 1, 'C');
$pdf->Cell(100, 1, 'TELEFONO .: '.$rsventas[0]['suc_telf'], 0, 0, 'C');

//$pdf->Cell(85, 1, 'Teléfono: 0983 181 352', 0, 0, 'C');
//$pdf->Cell(80, 1, 'VIGENCIA INICIO.: ' . $rsventas[0]['prov_vigencia_inic'], 0, 0, 'C');

$pdf->Cell(70, 1, 'VIG.INICIO.: ' . $rsventas[0]['fecha_inicio'].' FIN.: ' . $rsventas[0]['fecha_fin'], 0, 1, 'C');
//$pdf->Cell(80, 1, 'VIGENCIA INICIO.: ' . $rsventas[0]['fecha_inicio'], 0, 0, 'C');
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
$pdf->Cell(/*1*/90, /*2*/1, /*3*/$rsventas[0]['ven_fecha'], /*4*/0, /*5*/1, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);
$pdf->Ln(3);
//nombre cliente
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(30, 1, '   CLIENTE: ', 0, 0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(/*1*/90, /*2*/1, /*3*/ $rsventas[0]['cliente'], /*4*/0, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);

//ruc cliente
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(20, 1, 'RUC o CI: ', 0, 0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(90, 1, $rsventas[0]['per_ci_ruc'], 0, 1, 'L');

$pdf->Ln(3);
//dirección cliente
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(30, 1, '   DIRECCION: ', 0, 0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(/*1*/90, /*2*/1, /*3*/ $rsventas[0]['per_direc'], /*4*/0, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);


//telefono cliente
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(25, 1, 'TELEFONO:   ', 0, 0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(/*1*/37, /*2*/1, /*3*/$rsventas[0]['per_telf'], /*4*/0, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);

//cuadro de detalles
$pdf->RoundedRect(15, 92, 177, 140, 5.0, '1111', '', $style6, array(200, 200, 200));

$pdf->Ln(20);
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(15, 1, '#', 0, 0, 'C');
$pdf->Cell(30, 1, 'Item', 0, 0, 'L');
$pdf->Cell(30, 1, 'Servicio', 0, 0, 'L');
$pdf->Cell(15, 1, 'Cant.', 0, 0, 'C');
$pdf->Cell(25, 1, 'Precio Item', 0, 0, 'R');
$pdf->Cell(25, 1, 'Monto Serv', 0, 0, 'R');
$pdf->Cell(25, 1, 'Subtotal', 0, 0, 'R');
$pdf->Ln(5);

$consultas = "select * from v_det_factura_iva where cod_factura=".$_REQUEST ['vdetcod'];
$detventas = consultas::get_datos($consultas);
if (!empty($detventas)) {
foreach ($detventas as $report) {
    $pdf->SetFont('Times', '', 10);
    $pdf->Cell(15, 1, $report['cod_factura'], 0, 0, 'C');
    $pdf->Cell(30, 1, /*3*/$report['art_descri'], 0, 0,'L',null,null,1,null,null,null);
    $pdf->Cell(30, 1, /*3*/$report['descri_servicio'], 0, 0,'L',null,null,1,null,null,null);
    $pdf->Cell(15, 1,$report['det_cantidad'] , 0, 0, 'C');
    $pdf->Cell(25, 1, number_format(($report['det_precio_unit']),0,',','.') , 0, 0, 'R'); 
    $pdf->Cell(25, 1, number_format(($report['monto_servicio']),0,',','.') , 0, 0, 'R'); 
    $pdf->Cell(25, 1, number_format(($report['det_subtotal']),0,',','.'), 0, 1, 'R');
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
        number_format(($rsventas[0]['ven_total']),0,',','.'));
$pdf->SetFont('Times', 'B', 10);

$pdf->Text(55, 243, '5%');
$pdf->SetFont('Times', '', 10);
$pdf->Text(65, 243,
        number_format(($rsventas[0]['total_iva5']),0,',','.'));
$pdf->SetFont('Times', 'B', 10);
$pdf->Text(90, 243, '10%');
$pdf->SetFont('Times', '', 10);
$pdf->Text(100, 243,
        number_format(($rsventas[0]['total_iva10']),0,',','.'));
$pdf->SetFont('Times', 'B', 10);
$pdf->Text(120, 243, 'IVA TOTAL');
$pdf->SetFont('Times', '', 10);
$pdf->Text(145, 243, 
        number_format(($rsventas[0]['total_ivas']),0,',','.'));

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

