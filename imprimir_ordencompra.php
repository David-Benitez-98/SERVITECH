<?php

// Include the main TCPDF library (search for installation path).
include_once 'clases/tcpdf/tcpdf.php';
include_once 'clases/conexion.php';

$sqlcompras = "select *,(select numero_letras(total_orden)) "
        . "as total_letra "
      . " from v_orden_compra3 where id_orden_compra = " . 
        $_REQUEST ['vorden'] . " order by 1";
$rscompras = consultas::get_datos($sqlcompras);


// create new PDF document
$pdf = new TCPDF('P', 'mm', 'A4');
$pdf->SetMargins(15, 15, 18);
$pdf->SetTitle('ORDEN DE COMPRA');
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);

$pdf->AddPage();

$pdf->Ln(5);
$pdf->SetFont('Times', 'B', 18);

$pdf->Cell(85, 1,'SERVITECH S.A', 0, 0, 'C',null,null,1);

$pdf->Cell(100, 1, 'ORDEN DE COMPRAS', 0, 1, 'C');

$pdf->SetFont('Times', 'B', 12);

$pdf->Cell(85, 1, 'VENTAS Y SERVICIO TECNICO', 0, 0, 'C');

$pdf->Cell(100, 1, 'NRO.: ' . $rscompras[0]['nro_orden'], 0, 1, 'C');

$pdf->SetFont('Times', '', 12);

$pdf->Cell(85, 1, 'Dirección.: AVDA. PERU' , 0, 0, 'C');

$pdf->Cell(100, 1, '', 0, 1, 'C');

$pdf->Cell(85, 1, 'Telefono: (021)600-800 ', 0, 0, 'C');

$pdf->Cell(95, 1, '', 0, 1, 'C');

$pdf->Cell(270, 1, 'Ruc: 1025897-1', 0, 1, 'C');

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
$pdf->Cell(/*1*/90, /*2*/1, /*3*/$rscompras[0]['vfecha'], /*4*/0, /*5*/1, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);
$pdf->Ln(3);
//nombre cliente
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(41, 1, '   PROVEEDOR-RAZON:  ', 0, 0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(/*1*/90, /*2*/1, /*3*/$rscompras[0]['proveedor'], /*4*/0, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);

//ruc cliente
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(20, 1, 'RUC o CI: ', 0, 0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(90, 1, $rscompras[0]['per_ci_ruc'], 0, 1, 'L');

$pdf->Ln(3);
//dirección cliente
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(40, 1, '   DIRECCION: ', 0, 0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(/*1*/90, /*2*/1, /*3*/$rscompras[0]['per_direc'], /*4*/0, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);


//telefono cliente
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(25, 1, 'TELEFONO:   ', 0, 0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(/*1*/37, /*2*/1, /*3*/$rscompras[0]['per_telf'], /*4*/0, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);

//cuadro de detalles
$pdf->RoundedRect(15, 92, 177, 140, 5.0, '1111', '', $style6, array(200, 200, 200));

$pdf->Ln(20);
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(10, 1, '#', 0, 0, 'C');
$pdf->Cell(41, 1, 'Descripcion', 0, 0, 'L');
$pdf->Cell(40, 1, 'Marca', 0, 0, 'R');
//$pdf->Cell(20, 1, 'Tipo', 0, 0, 'R');
$pdf->Cell(20, 1, 'Cant.', 0, 0, 'C');
$pdf->Cell(20, 1, 'Precio Comp', 0, 0, 'R');
$pdf->Cell(30, 1, 'Subtotal', 0, 0, 'R');
$pdf->Ln(5);

$consultas = "select * from v_det_orden_compra where id_orden_compra=".$_REQUEST ['vorden'];
$detcompras = consultas::get_datos($consultas);
if (!empty($detcompras)) {

foreach ($detcompras as $report) {
    $pdf->SetFont('Times', '', 10);
    $pdf->Cell(10, 1, $report['cod_art'], 0, 0, 'C');
    $pdf->Cell(41, 1, /*3*/$report['art_descri'], 0, 0,'L',null,null,1,null,null,null);
    $pdf->Cell(40, 1, $report['mar_descri'] , 0, 0, 'R');
//    $pdf->Cell(20, 1, $report['tipo_arti_descrip'] , 0, 0, 'R');
    $pdf->Cell(20, 1,$report['cantidad'] , 0, 0, 'C');
    $pdf->Cell(20, 1, $report['prec_unit_ordencomp'] , 0, 0, 'R');  
    $pdf->Cell(30, 1, number_format(($report['subtototal']),0,',','.'), 0, 1, 'R');
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
$pdf->RoundedRect(15, 232, 177, 30, 4.0, '1111', '', 
        $style6, array(200, 200, 200));


$pdf->SetFont('Times', 'B', 10);
$pdf->Text(18, 243, 'TOTAL GENERAL');
$pdf->SetFont('Times', '', 10);
$pdf->Text(165, 243, 'Gs. '.
        number_format(($rscompras[0]['total_orden']),0,',','.'));
$pdf->SetFont('Times', 'B', 10);
$pdf->Text(18, 251, 'TOTAL EN LETRAS');
$pdf->SetFont('Times', '', 10);
$pdf->Text(55, 251, 'Son Gs. '.
        ucfirst(strtolower ($rscompras[0]['total_letra'])));


$pdf->SetFont('Times', 'B', 10);
$pdf->Text(120, 256, 'AUTORIZADO POR JEFE DE COMPRAS');


$pdf->SetFont('Times', '', 8);
$pdf->Text(25, 265, 'Manifestamos que los datos consignados acontinuación son verdaderos y que tomamos responsabilidad de dicha información');
$pdf->Text(18, 270, 'LAS FACTURAS DEBERAN SER EMITIDAS POR LUGAR DE ENTREGA Y ACOMPAÑADO CON UNA COPIA DE LA ORDEN DE COMPRA');
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('orden_compra.pdf', 'I');

//============================================================+
// END OF FILE
//===