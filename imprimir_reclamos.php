<?php

// Include the main TCPDF library (search for installation path).
include_once 'clases/tcpdf/tcpdf.php';
include_once 'clases/conexion.php';

$sqlventas = "select *,(select numero_letras(ven_total)) "
        . "as total_letra "
      . " from v_reclamos where cod_reclamo = " . 
        $_REQUEST ['vrecla'] . "";
$rsventas = consultas::get_datos($sqlventas);


// create new PDF document
$pdf = new TCPDF('P', 'mm', 'A4');
$pdf->SetMargins(15, 15, 18);
$pdf->SetTitle('NOTA DEBITO');
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);

$pdf->AddPage();

$pdf->Ln(5);
$pdf->SetFont('Times', 'B', 15);

$pdf->Cell(85, 1, $rsventas[0]['suc_descri'] , 0, 0, 'C',null,1);
//$pdf->Cell(85, 1, 'NEW ERA', 0, 0, 'C',null,null,1);

    $pdf->Cell(100, 1, 'RECLAMOS DE CLIENTES ', 0, 1, 'C');

$pdf->SetFont('Times', 'B', 12);

$pdf->Cell(85, 1, 'VENTAS Y SERVICIO TECNICO', 0, 0, 'C');

$pdf->Cell(100, 1, 'NRO.: ' . $rsventas[0]['nro_reclamo'], 0, 1, 'C');
$pdf->SetFont('Times', 'B', 12);

$pdf->Cell(85, 1, $rsventas[0]['suc_direc'], 0, 0, 'C');

$pdf->Cell(100, 1, 'RUC.: 1.025.897-1', 0, 1, 'C');

$pdf->SetFont('Times', '', 12);


$pdf->Cell(85, 1, 'TELEFONO .: ' . $rsventas[0]['suc_telf'], 0, 0, 'C');
$pdf->Cell(95, 1, '', 0, 1, 'C');

$pdf->Cell(100, 1, '', 0, 0, 'C');

$pdf->Cell(70, 1, '', 0, 0, 'C');


$style6 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0));
//$pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 255)));

//cuadros de arriba
//$pdf->RoundedRect(15, 12, 90, 50, 6.0, '1111', '', $style6, array(200, 200, 200));
//$pdf->RoundedRect(105, 12, 87, 50, 6.0, '1111', '', $style6, array(200, 200, 200));

//cuadro de cabecera
//$pdf->RoundedRect(15, 62, 177, 30, 5.0, '1111', '', $style6, array(200, 200, 200));

//datos de cabecera
$pdf->Ln(22);
//Fecha
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(30, 1, '   FECHA: ', 0, 0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(/*1*/140, /*2*/1, /*3*/$rsventas[0]['fecdate'], /*4*/0, /*5*/1, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);
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
$pdf->Cell(/*1*/90, /*2*/1, /*3*/ $rsventas[0]['per_direc'].' -  TEL: '.$rsventas[0]['per_telf'], /*4*/0, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);

//telefono cliente
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(25, 1, 'MOTIVO: ', 0, 0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(/*1*/37, /*2*/1, /*3*/$rsventas[0]['motivo'], /*4*/0, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);
$pdf->Ln(8);

$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(55, 1, '', 0, 0, 'L');
$pdf->Cell(30, 1, '   SERVICIO: ', 0, 0, 'L');
$pdf->SetFont('Times', '', 12);
$pdf->Cell(/*1*/40, /*2*/1, /*3*/$rsventas[0]['observacion'], /*4*/0, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);
//cuadro de detalles
$pdf->RoundedRect(15, 95, 177, 30, 4.0, '1111', '', $style6, array(200, 200, 200));

$pdf->Ln(25);
$pdf->SetFont('Times', '', 10);
$pdf->Cell(175, 1, 'DETALLES: EMITIDO POR FACTURA N° '.$rsventas[0]['nro_factura']."  - CONDICION: ".$rsventas[0]['ven_condicion']. "  -  FECHA: ".$rsventas[0]['ven_fecha'], 0, 0, 'C');

$pdf->Ln(5);

$posicion = $pdf->GetY();
//$pdf->Line(190,230,15,$posicion);

//cuadro de subtotales
$pdf->RoundedRect(15, 129, 177, 30, 4.0, '1111', '', 
        $style6, array(200, 200, 200));

$pdf->SetFont('Times', 'B', 10);
$pdf->Text(21, 132, 'TOTAL GENERAL FACTURA');
$pdf->SetFont('Times', '', 10);
$pdf->Text(165, 132, 'Gs. '.
        number_format(($rsventas[0]['ven_total']),0,',','.'));
$pdf->SetFont('Times', 'B', 10);

$pdf->SetFont('Times', 'B', 10);
$pdf->Text(21, 145, 'TOTAL EN LETRAS');
$pdf->SetFont('Times', '', 10);
$pdf->Text(65, 145, 'Son Gs. '.
        ucfirst(strtolower ($rsventas[0]['total_letra'])));

$pdf->SetFont('Times', 'B', 10);
$pdf->Text(18, 243, 'FIRMA DEL CLIENTE:');
$pdf->SetFont('Times', '', 10);
$pdf->Text(65, 243, '.....................................................');
$pdf->SetFont('Times', 'B', 10);
$pdf->Text(18, 251, 'FIRMA DEL RECEPCIONISTA:');

$pdf->SetFont('Times', '', 10);
$pdf->Text(65, 251, '.....................................................                                 '.$rsventas[0]['usuario']);


$pdf->SetFont('Times', 'B', 10);
$pdf->Text(125, 256, 'AUTORIZADO POR RECEPCION');

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('reclamos.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

