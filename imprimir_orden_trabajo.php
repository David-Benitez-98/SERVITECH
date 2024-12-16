<?php

// Include the main TCPDF library (search for installation path).
include_once 'clases/tcpdf/tcpdf.php';
include_once 'clases/conexion.php';

$sqlcompras = "select * from v_orden_trabajo where cod_orden_trabajo = " . 
        $_REQUEST ['vorden_trab'] . " order by 1";
$rscompras = consultas::get_datos($sqlcompras);


// create new PDF document
$pdf = new TCPDF('P', 'mm', 'A4');
$pdf->SetMargins(15, 15, 18);
$pdf->SetTitle('ORDEN DE TRABAJO');
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);

$pdf->AddPage();

$pdf->Ln(5);
$pdf->SetFont('Times', 'B', 18);

$pdf->Cell(85, 1,'SERVITECH S.A', 0, 0, 'C',null,null,1);

$pdf->Cell(100, 1, 'ORDEN DE TRABAJO', 0, 1, 'C');

$pdf->SetFont('Times', 'B', 12);

$pdf->Cell(85, 1, 'VENTAS Y SERVICIO TECNICO', 0, 0, 'C');

$pdf->Cell(100, 1, 'NRO.: ' . $rscompras[0]['nro_orden'], 0, 1, 'C');

$pdf->SetFont('Times', '', 12);

$pdf->Cell(85, 1, 'Dirección: '. $rscompras[0]['suc_direc'] , 0, 0, 'C');

$pdf->Cell(100, 1, '', 0, 1, 'C');

$pdf->Cell(85, 1, 'Telefono: '. $rscompras[0]['suc_telf'], 0, 0, 'C');

$pdf->Cell(95, 1, '', 0, 1, 'C');

$pdf->Cell(85, 1, 'Ruc:'.$rscompras[0]['emp_ruc'], 0, 1, 'C');

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
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(30, 1, '   FECHA: ', 0, 0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(/*1*/90, /*2*/1, /*3*/$rscompras[0]['vfecha_ini']." hasta ".$rscompras[0]['vfecha_fin'], /*4*/0, /*5*/1, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);
$pdf->Ln(3);
//nombre cliente
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(41, 1, '   CLIENTE:  ', 0, 0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(/*1*/60, /*2*/1, /*3*/$rscompras[0]['cliente'], /*4*/0, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);

//ruc cliente
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(30, 1, 'RUC o CI: ', 0, 0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(90, 1, $rscompras[0]['per_ci_ruc'], 0, 1, 'L');

$pdf->Ln(3);
//dirección cliente
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(40, 1, '   DIRECCION: ', 0, 0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(/*1*/60, /*2*/1, /*3*/$rscompras[0]['per_direc']." - TEL:".$rscompras[0]['per_telf'], /*4*/0, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);


//telefono cliente
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(30, 1, 'OBSERVACIÓN:   ', 0, 0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(/*1*/37, /*2*/1, /*3*/$rscompras[0]['observacion'], /*4*/0, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);

//cuadro de detalles
$pdf->RoundedRect(15, 92, 177, 140, 5.0, '1111', '', $style6, array(200, 200, 200));

$pdf->Ln(20);
$pdf->SetFont('Times', 'B', 9);
$pdf->Cell(10, 1, '#', 0, 0, 'C');
$pdf->Cell(30, 1, 'Tecnicos', 0, 0, 'L');
$pdf->Cell(35, 1, 'Servicio', 0, 0, 'R');
$pdf->Cell(35, 1, 'Equipo', 0, 0, 'R');
$pdf->Cell(45, 1, 'Repuesto', 0, 0, 'R');
$pdf->Cell(25, 1, 'Cant Rep.', 0, 0, 'C');
$pdf->Ln(5);

$consultas = "select * from v_deta_orden_trabajo where cod_orden_trabajo=".$_REQUEST ['vorden_trab'];
$detcompras = consultas::get_datos($consultas);
if (!empty($detcompras)) {

foreach ($detcompras as $report) {
    $pdf->SetFont('Times', '', 7);
    $pdf->Cell(10, 1, $report['cod_orden_trabajo'], 0, 0, 'C');
    $pdf->Cell(30, 1, /*3*/$report['persona'], 0, 0,'L',null,null,1,null,null,null);
    $pdf->Cell(40, 1, $report['descri_servicio'] , 0, 0, 'R');
    $pdf->Cell(40, 1,$report['dat_equipo'] , 0, 0, 'C');
    $pdf->Cell(40, 1, $report['art_descri'] , 0, 0, 'R');
    $pdf->Cell(10, 1, $report['art_cantidad'] , 0, 0, 'R'); 
    $pdf->Ln(5);
}
}else{
    $pdf->SetFont('times', 'B', '14');
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetTextColor(255, 0, 0);
    $pdf->SetDrawColor(0, 0, 0);
    $pdf->Cell(190, 20, 'NO SE ENCUENTRAN DETALLES', 0, 0, 'C', 0);
    }
$posicion = $pdf->GetY();
//$pdf->Line(190,230,15,$posicion);


//cuadro de subtotales
//$pdf->RoundedRect(15, 232, 177, 30, 4.0, '1111', '', 
//        $style6, array(200, 200, 200));


$pdf->SetFont('Times', 'B', 10);
$pdf->Text(18, 243, 'FIRMA DEL TECNICO:');
$pdf->SetFont('Times', '', 10);
$pdf->Text(65, 243, '.....................................................');
$pdf->SetFont('Times', 'B', 10);
$pdf->Text(18, 251, 'FIRMA DEL SUPERVISOR:');
$pdf->SetFont('Times', '', 10);
$pdf->Text(65, 251, '.....................................................                                 '.$rscompras[0]['usuario']);


$pdf->SetFont('Times', 'B', 10);
$pdf->Text(125, 256, 'AUTORIZADO POR SUPERVISOR');

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('orden_trabajo.pdf', 'I');

//============================================================+
// END OF FILE
//===