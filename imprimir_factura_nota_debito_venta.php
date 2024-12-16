<?php

// Include the main TCPDF library (search for installation path).
include_once 'clases/tcpdf/tcpdf.php';
include_once 'clases/conexion.php';

$sqlventas = "select *,(select numero_letras(total_nota)) "
        . "as total_letra "
      . " from v_nota_debito_fac where cod_not_debi_vent = " . 
        $_REQUEST ['vcod'] . "";
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

    $pdf->Cell(100, 1, 'NOTA DEBITO ', 0, 1, 'C');

$pdf->SetFont('Times', 'B', 12);

$pdf->Cell(85, 1, 'VENTAS Y SERVICIO TECNICO', 0, 0, 'C');

$pdf->Cell(100, 1, 'NRO.: ' . $rsventas[0]['numero_debito'], 0, 1, 'C');
$pdf->SetFont('Times', 'B', 12);

$pdf->Cell(85, 1, $rsventas[0]['suc_direc'], 0, 0, 'C');

$pdf->Cell(100, 1, 'RUC.: 1.025.897-1', 0, 1, 'C');

$pdf->SetFont('Times', '', 12);


$pdf->Cell(85, 1, 'TELEFONO .: ' . $rsventas[0]['suc_telf'], 0, 0, 'C');
$pdf->Cell(95, 1, 'TIMBRADO .: ' . $rsventas[0]['nro_timbrado'], 0, 1, 'C');

$pdf->Cell(100, 1, '', 0, 0, 'C');

$pdf->Cell(70, 1, 'VIG. INICIO.: ' . $rsventas[0]['vfecha_ini'].' - FIN.: ' . $rsventas[0]['vfecha_fin'], 0, 0, 'C');


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
$pdf->Cell(25, 1, 'INTERES: ', 0, 0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(/*1*/37, /*2*/1, /*3*/$rsventas[0]['porc_interes']." % ", /*4*/0, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);
$pdf->Ln(6);

$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(117, 1, '', 0, 0, 'L');
$pdf->Cell(30, 1, '   AUMENTO: ', 0, 0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(/*1*/40, /*2*/1, /*3*/number_format(($rsventas[0]['nota_aumento_monto']),0,',','.')." Gs", /*4*/0, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);
//cuadro de detalles
$pdf->RoundedRect(15, 95, 177, 30, 4.0, '1111', '', $style6, array(200, 200, 200));

$pdf->Ln(20);
$pdf->SetFont('Times', '', 10);
$pdf->Cell(175, 1, 'DETALLES: EMITIDO POR FACTURA N° '.$rsventas[0]['nro_factura']."  - CONDICION: ".$rsventas[0]['ven_condicion']. "  -  MONTO: ".number_format(($rsventas[0]['ven_total']),0,',','.'), 0, 0, 'C');

$pdf->Ln(5);

$posicion = $pdf->GetY();
//$pdf->Line(190,230,15,$posicion);

//cuadro de subtotales
$pdf->RoundedRect(15, 129, 177, 30, 4.0, '1111', '', 
        $style6, array(200, 200, 200));

$pdf->SetFont('Times', 'B', 10);
$pdf->Text(21, 132, 'TOTAL GENERAL');
$pdf->SetFont('Times', '', 10);
$pdf->Text(165, 132, 'Gs. '.
        number_format(($rsventas[0]['total_nota']),0,',','.'));
$pdf->SetFont('Times', 'B', 10);
//
$pdf->Text(55, 132, '5%');
$pdf->SetFont('Times', '', 10);
$pdf->Text(65, 132,
        number_format(($rsventas[0]['total_iva5']),0,',','.'));
$pdf->SetFont('Times', 'B', 10);
$pdf->Text(90, 132, '10%');
$pdf->SetFont('Times', '', 10);
$pdf->Text(100, 132,
        number_format(($rsventas[0]['total_iva10']),0,',','.'));
$pdf->SetFont('Times', 'B', 10);
$pdf->Text(120, 132, 'IVA TOTAL');
$pdf->SetFont('Times', '', 10);
$pdf->Text(145, 132, 
        number_format(($rsventas[0]['total_ivas']),0,',','.'));

$pdf->SetFont('Times', 'B', 10);
$pdf->Text(21, 145, 'TOTAL EN LETRAS');
$pdf->SetFont('Times', '', 10);
$pdf->Text(65, 145, 'Son Gs. '.
        ucfirst(strtolower ($rsventas[0]['total_letra'])));

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('NotaCredito.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

