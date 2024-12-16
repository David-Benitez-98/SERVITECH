<?php

// Include the main TCPDF library (search for installation path).
include_once 'clases/tcpdf/tcpdf.php';
include_once 'clases/conexion.php';

$sqlventas = "select *,(select numero_letras(monto_total)) "
        . "as total_letra "
      . " from v_cobro_recibo_imprimir where cob_cod = " . 
        $_REQUEST ['vcod'] . "";
$rsventas = consultas::get_datos($sqlventas);


// create new PDF document
$pdf = new TCPDF('P', 'mm', 'A4');
$pdf->SetMargins(15, 15, 18);
$pdf->SetTitle('RECIBO DE DINERO');
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);

$pdf->AddPage();

$pdf->Ln(5);
$pdf->SetFont('Times', 'B', 15);

$pdf->Cell(85, 1, $rsventas[0]['suc_descri'] , 0, 0, 'C',null,1);
//$pdf->Cell(85, 1, 'NEW ERA', 0, 0, 'C',null,null,1);

    $pdf->Cell(100, 1, 'RECIBO DE DINERO', 0, 1, 'C');

$pdf->SetFont('Times', 'B', 12);

$pdf->Cell(85, 1, 'VENTAS Y SERVICIO TECNICO', 0, 0, 'C');

$pdf->Cell(100, 1, 'NRO.: ' . $rsventas[0]['recibo_numero'], 0, 1, 'C');
$pdf->SetFont('Times', 'B', 12);

$pdf->Cell(85, 1, '', 0, 0, 'C');

$pdf->Cell(100, 1, 'RUC.: 1.025.897-1', 0, 1, 'C');

$pdf->SetFont('Times', '', 12);


$pdf->Cell(85, 1, 'TELEFONO .: ' . $rsventas[0]['suc_telf'], 0, 0, 'C');
$pdf->Cell(95, 1, '', 0, 1, 'C');

$pdf->Cell(85, 1, 'DIRECCION .: ' . $rsventas[0]['suc_direc'], 0, 0, 'C');

$pdf->Cell(70, 1, '', 0, 0, 'C');


$style6 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0));
//$pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 255)));

//cuadros de arriba
$pdf->RoundedRect(15, 12, 90, 50, 6.0, '1111', '', $style6, array(200, 200, 200));
$pdf->RoundedRect(105, 12, 87, 50, 6.0, '1111', '', $style6, array(200, 200, 200));

//cuadro de cabecera
//$pdf->RoundedRect(15, 62, 177, 30, 5.0, '1111', '', $style6, array(200, 200, 200));

//datos de cabecera
$pdf->Ln(22);
//Fecha
//cuadro de detalles
$pdf->RoundedRect(15, 70, 177, 50, 4.0, '1111', '', $style6, array(200, 200, 200));

$pdf->Ln(15);

$pdf->SetFont('Times', '', 10);
$pdf->Cell(165, 1, 'Recibi de     '.$rsventas[0]['cliente']."_______________________________________________________________", 0, 0, 'C');
$pdf->Ln(12);

$pdf->SetFont('Times', '', 10);
$pdf->Cell(160, 1, 'La cantidad de guaranies   '.ucfirst(strtolower ($rsventas[0]['total_letra']."______________________")), 0, 0, 'C');
$pdf->Ln(12);

$pdf->SetFont('Times', '', 10);
$pdf->Cell(165, 1, 'En concepto de pago por la  '.$rsventas[0]['descripcion']."____________________________", 0, 0, 'C');
$pdf->Ln(12);
$posicion = $pdf->GetY();
//$pdf->Line(190,230,15,$posicion);

//cuadro de subtotales
$pdf->RoundedRect(15, 129, 177, 30, 4.0, '1111', '', 
        $style6, array(200, 200, 200));

$pdf->SetFont('Times', 'B', 10);
$pdf->Text(21, 132, 'FIRMA: ...............................................................');
$pdf->SetFont('Times', '', 10);
$pdf->Text(130, 132, ''.$rsventas[0]['fecdate']);
$pdf->SetFont('Times', 'B', 10);


$pdf->SetFont('Times', 'B', 10);
$pdf->Text(21, 145, 'ACLARACION DE FIRMA:');
$pdf->SetFont('Times', '', 10);
$pdf->Text(65, 145, '  '.$rsventas[0]['usuario']);

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('NotaCredito.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

