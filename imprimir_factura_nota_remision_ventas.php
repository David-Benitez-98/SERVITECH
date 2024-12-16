<?php

// Include the main TCPDF library (search for installation path).
include_once 'clases/tcpdf/tcpdf.php';
include_once 'clases/conexion.php';

$sqlcompras = "select * from v_notaremisionfactura where cod_nota_remi_vent = " . 
        $_REQUEST ['vcod'] . " order by cod_nota_remi_vent";
$rscompras = consultas::get_datos($sqlcompras);


// create new PDF document
$pdf = new TCPDF('P', 'mm', 'A4');
$pdf->SetMargins(15, 15, 18);
$pdf->SetTitle('NOTA REMISION VENTAS');
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);

$pdf->AddPage();

$pdf->Ln(5);
$pdf->SetFont('Times', 'B', 18);

$pdf->Cell(85, 1,$rscompras[0]['suc_descri'], 0, 0, 'C',null,null,1);

$pdf->Cell(100, 1, 'NOTA REMISION', 0, 1, 'C');

$pdf->SetFont('Times', 'B', 12);

$pdf->Cell(85, 1, 'VENTAS Y SERVICIO TECNICO', 0, 0, 'C');

$pdf->Cell(100, 1, 'NRO.: ' . $rscompras[0]['nro_nota_remi'], 0, 1, 'C');

$pdf->SetFont('Times', '', 12);

$pdf->Cell(85, 1, 'Dirección: '.$rscompras[0]['suc_direc'], 0, 0, 'C');

$pdf->Cell(100, 1, 'Timbrado: ' . $rscompras[0]['nro_timbrado'], 0, 1, 'C');

$pdf->Cell(85, 1, 'Teléfono: '.$rscompras[0]['suc_telf'], 0, 0, 'C');

$pdf->Cell(95, 1, 'Vigencia: ' . $rscompras[0]['fecha_inicio'].' hasta '. $rscompras[0]['fecha_fin'], 0, 1, 'C');

$pdf->Cell(270, 1, 'Ruc: 1.025.897-1', 0, 1, 'C');

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
$pdf->Cell(32, 1, '   FECHA SALIDA: ', 0, 0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(/*1*/140, /*2*/1, /*3*/$rscompras[0]['fecha_ini_salida']."  -  N° FACTURA : ".$rscompras[0]['nro_factura']. "  -  MONTO: ".number_format(($rscompras[0]['ven_total']),0,',','.'), /*4*/0, /*5*/1, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);
$pdf->Ln(3);


//nombre cliente
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(30, 1, '   CLI. RAZON: ', 0, 0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(/*1*/90, /*2*/1, /*3*/$rscompras[0]['cliente'], /*4*/0, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);

//ruc cliente
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(20, 1, 'RUC o CI: ', 0, 0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(90, 1, $rscompras[0]['per_ci_ruc'], 0, 1, 'L');

$pdf->Ln(3);
//dirección cliente
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(30, 1, '   DIRECCION: ', 0, 0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(/*1*/90, /*2*/1, /*3*/$rscompras[0]['per_direc'].' - TEL: '.$rscompras[0]['per_telf'], /*4*/0, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);


//telefono cliente
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(35, 1, 'MOT. TRASLADO: ', 0, 0, 'L');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(/*1*/40, /*2*/1, /*3*/$rscompras[0]['motivo_traslado'], /*4*/0, /*5*/0, /*6*/'L', /*7*/null, /*8*/null, /*9*/1, /*10*/null, /*11*/null, /*12*/null);



//cuadro de detalles
$pdf->RoundedRect(15, 92, 177, 140, 5.0, '1111', '', $style6, array(200, 200, 200));

$pdf->Ln(20);
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(10, 1, '#', 0, 0, 'C');
$pdf->Cell(35, 1, 'Descripcion', 0, 0, 'L');
$pdf->Cell(35, 1, 'Marca', 0, 0, 'R');
$pdf->Cell(35, 1, 'Tipo Articulo', 0, 0, 'R');
$pdf->Cell(30, 1, 'Cantidad', 0, 0, 'C');
$pdf->Ln(5);

$consultas = "select * from v_detalle_remision_fact where cod_nota_remi_vent=".$_REQUEST ['vcod'];
$detcompras = consultas::get_datos($consultas);
if (!empty($detcompras)) {

foreach ($detcompras as $report) {
    $pdf->SetFont('Times', '', 10);
    $pdf->Cell(10, 1, $report['cod_nota_remi_vent'], 0, 0, 'C');
    $pdf->Cell(35, 1, /*3*/$report['art_descri'], 0, 0,'L',null,null,1,null,null,null);
    $pdf->Cell(40, 1, $report['mar_descri'] , 0, 0, 'C');
    $pdf->Cell(35, 1, $report['tipo_arti_descrip'] , 0, 0, 'C');
    $pdf->Cell(30, 1,$report['not_remi_canti'] , 0, 0, 'C');
    
   
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
$pdf->Text(18, 243, 'CONDUCTOR:');
$pdf->SetFont('Times', '', 10);
$pdf->Text(45, 243, $rscompras[0]['personal']."    CI-RUC :  ".$rscompras[0]['ci_ruc_personal']);
$pdf->SetFont('Times', 'B', 10);
$pdf->Text(18, 251, 'FIRMA DEL CLIENTE:...............................................');
$pdf->SetFont('Times', 'B', 10);
$pdf->Text(100, 251, 'FIRMA DEL CONDUCTOR:...............................................');
//$pdf->SetFont('Times', '', 10);
//$pdf->Text(55, 251, 'Son Gs. '.
//        ucfirst(strtolower ($rscompras[0]['total_letra'])));
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('nota_remision_venta.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

