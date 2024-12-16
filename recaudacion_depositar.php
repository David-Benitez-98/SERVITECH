<?php

// Include the main TCPDF library (search for installation path).
include_once 'clases/tcpdf/tcpdf.php';
include_once 'clases/conexion.php';
$style6 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0));

$sql = "select * from v_recaudacion where cod_recaudacion = ".$_REQUEST['vcod'];
$resul = consultas::get_datos($sql);

// create new PDF document
$pdf = new TCPDF('P', 'mm', array(215.9,330.2));
$pdf->SetMargins(17, 15, 18);
$pdf->SetTitle("RECAUDACION A DEPOSITAR");
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
$pdf->AddPage();

$pdf->Ln(5);
$pdf->SetFont('Times', 'B', 15);
//$pdf->SetLineWidth(5);
$pdf->Cell(0, 0, "RECAUDACION DE LA APERTURA N°: ".$resul[0]['ape_nro']." (".$resul[0]['caj_descri'].")", 0, 1, 'C');

//RECUADRO IZQUIERDO
$pdf->RoundedRect(16, 30, 90, 22, 4.0, '2111', '', $style6, array(200, 200, 200));
//RECUADRO DERECHO
$pdf->RoundedRect(108, 30, 90, 22, 4.0, '2111', '', $style6, array(200, 200, 200));


$pdf->Ln(7);

//INFORMACION LINEA 1 IZQUIERDA
$pdf->SetFont('Times', 'B', 12);//TIPO DE LETRA PARA TITULO
$pdf->Cell(/*1*/35, /*2*/1, /*3*/'CAJERO:', /*4*/0, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);
$pdf->SetFont('Times', '', 12);//TIPO DE LETRA PARA DATO
$pdf->Cell(/*1*/50, /*2*/1, /*3*/$resul[0]['usuario'], /*4*/0, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);

//SEPARADOR, PARA QUE LA INFORMACION SALGA EN EL RECUADRO DE LA DERECHA
$pdf->Cell(/*1*/8, /*2*/1, /*3*/'', /*4*/0, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);

//INFORMACION LINEA 1 RECUADRO DERECHO
$pdf->SetFont('Times', 'B', 12);//TIPO DE LETRA PARA TITULO
$pdf->Cell(/*1*/50, /*2*/1, /*3*/'MONTO EN EFECTIVO:', /*4*/0, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);
$pdf->SetFont('Times', '', 12);//TIPO DE LETRA PARA DATO
$pdf->Cell(/*1*/35, /*2*/1, /*3*/  number_format($resul[0]['monto_efectivo'], 0, ',', '.'), /*4*/0, /*5*/1, /*6*/'R', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);

////INFORMACION LINEA 2 IZQUIERDA
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(/*1*/35, /*2*/1, /*3*/'FECHA APERTURA:', /*4*/0, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);
$pdf->SetFont('Times', '', 12);
$pdf->Cell(/*1*/50, /*2*/1, /*3*/$resul[0]['ape_fecha'], /*4*/0, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);

//SEPARADOR, PARA QUE LA INFORMACION SALGA EN EL RECUADRO DE LA DERECHA
$pdf->Cell(/*1*/8, /*2*/1, /*3*/'', /*4*/0, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);

//INFORMACION LINEA 2 RECUADRO DERECHO
$pdf->SetFont('Times', 'B', 12);//TIPO DE LETRA PARA TITULO
$pdf->Cell(/*1*/50, /*2*/1, /*3*/'MONTO EN CHEQUE:', /*4*/0, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);
$pdf->SetFont('Times', '', 12);//TIPO DE LETRA PARA DATO
$pdf->Cell(/*1*/35, /*2*/1, /*3*/number_format($resul[0]['monto_cheque'], 0, ',', '.'), /*4*/0, /*5*/1, /*6*/'R', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);


//INFORMACION LINEA 3 IZQUIERDA
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(/*1*/35, /*2*/1, /*3*/'FECHA CIERRE:', /*4*/0, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);
$pdf->SetFont('Times', '', 12);
$pdf->Cell(/*1*/50, /*2*/1, /*3*/$resul[0]['ape_fecha_cierre'], /*4*/0, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);

//SEPARADOR, PARA QUE LA INFORMACION SALGA EN EL RECUADRO DE LA DERECHA
$pdf->Cell(/*1*/8, /*2*/1, /*3*/'', /*4*/0, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);

//INFORMACION LINEA 3 RECUADRO DERECHO
$pdf->SetFont('Times', 'B', 12);//TIPO DE LETRA PARA TITULO
$pdf->Cell(/*1*/50, /*2*/1, /*3*/'RECAUDACION TOTAL:', /*4*/0, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);
$pdf->SetFont('Times', '', 12);//TIPO DE LETRA PARA DATO
$pdf->Cell(/*1*/35, /*2*/1, /*3*/number_format($resul[0]['total_recaudacion'], 0, ',', '.'), /*4*/0, /*5*/1, /*6*/'R', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);



//DETALLES DE CHEQUES
$sqlchs = "select * from v_cobro_cheques where ape_nro = ".$resul[0]['ape_nro']." order by cob_cod_cheque";
$rschs = consultas::get_datos($sqlchs);
if($rschs){
    $pdf->Ln(8);
    $pdf->SetFont('Times', 'B', 14);
    //$pdf->SetLineWidth(5);
    $pdf->Cell(0, 0, "DETALLE DE CHEQUES", 0, 1, 'C');
    
    $pdf->SetFont('Times', 'B', 10);//TIPO DE LETRA PARA TITULO
//    $pdf->Cell(/*1*/50, /*2*/1, /*3*/'TITULAR', /*4*/1, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);
    $pdf->Cell(/*1*/50, /*2*/1, /*3*/'NRO. CHEQUE', /*4*/1, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);
    $pdf->Cell(/*1*/50, /*2*/1, /*3*/'ENTIDAD', /*4*/1, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);
    $pdf->Cell(/*1*/40, /*2*/1, /*3*/'FECHA EMISION', /*4*/1, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);
    $pdf->Cell(/*1*/40, /*2*/1, /*3*/'IMPORTE', /*4*/1, /*5*/1, /*6*/'R', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);

    foreach ($rschs as $chs) {
        $pdf->SetFont('Times', '', 10);//TIPO DE LETRA PARA TITULO
//        $pdf->Cell(/*1*/50, /*2*/1, /*3*/$chs['titular'], /*4*/1, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);
        $pdf->Cell(/*1*/50, /*2*/1, /*3*/$chs['cob_cod_cheque'], /*4*/1, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);
        $pdf->Cell(/*1*/50, /*2*/1, /*3*/$chs['ent_descripcion'], /*4*/1, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);
        $pdf->Cell(/*1*/40, /*2*/1, /*3*/$chs['fecha_emision'], /*4*/1, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);
        $pdf->Cell(/*1*/40, /*2*/1, /*3*/number_format($chs['importe'], 0, ',', '.'), /*4*/1, /*5*/1, /*6*/'R', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);

    }
}


// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('RECAUDACION A DEPOSITAR.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

