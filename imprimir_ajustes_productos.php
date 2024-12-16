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
$pdf->SetTitle('REPORTE DE AJUSTES DE PRODUCTOS');
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
$pdf->Cell(0, 0, "REPORTE DE AJUSTES DE PRODUCTOS", 0, 1, 'C');
//SALTO DE LINEA
$pdf->Ln();

//COLOR DE TABLA
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.2);


//$pdf->Ln(); //salto
$pdf->SetFont('', '');
$pdf->SetFillColor(255, 255, 255);





//consulta a la base de datos
$ordentrabajos = consultas::get_datos("select * from v_ajuste_productos "
                . "where cod_ajuste=" . $_REQUEST['vajuste'] . " order by cod_ajuste");

if (!empty($ordentrabajos)) {

    foreach ($ordentrabajos as $ordentrabajo) {
        $pdf->SetFont('', 'B', 10);
        //columnas

        $pdf->SetFillColor(180, 180, 180);
        $pdf->SetFillColor(180, 180, 180);
        $pdf->SetFillColor(180, 180, 180);
         $pdf->Ln();
               $pdf->Cell(30, 5, '#AJUSTE ', 0, 0, 'C', 1);
//            $pdf->Cell(65, 5, 'DESCRIPCION',0 , 0, 'C', 1);
            $pdf->Cell(40, 5, 'USUARIO',0 , 0, 'C', 1);
            $pdf->Cell(55, 5, 'SUCURSAL',0 , 0, 'C', 1);
//           $pdf->Cell(60, 5, 'ORDEN',0 , 0, 'C', 1);
            $pdf->Cell(40, 5, 'FECHA',0 , 0, 'C', 1);
//            $pdf->Cell(40, 5, 'FECHA FIN',0 , 0, 'C', 1);
            $pdf->Cell(30, 5, 'ESTADO',0 , 0, 'C', 1);
      
           

  $pdf->Ln();
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetFont('', '', 10);
            $pdf->Cell(30, 5, $ordentrabajo['cod_ajuste'], 0, 0, 'C', 1);
//           $pdf->Cell(65, 5, $ordentrabajo['observacion'], 0, 0, 'C', 1);
            $pdf->Cell(40, 5, $ordentrabajo['usuario'], 0, 0, 'C', 1);
            $pdf->Cell(55, 5, $ordentrabajo['suc_descri'], 0, 0, 'C', 1);
//            $pdf->Cell(60, 5, $ordentrabajo['cod_orden_trabajo']." - ".$ordentrabajo['estado_orden'], 0, 0, 'C', 1);
            $pdf->Cell(40, 5, $ordentrabajo['vfecha'], 0, 0, 'C', 1);
//            $pdf->Cell(40, 5, $ordentrabajo['orden_trab_feha_fin'], 0, 0, 'C', 1);
             $pdf->Cell(30, 5, $ordentrabajo['estado'], 0, 0, 'C', 1);
           
//           
        $pdf->Ln();
        $pdf->Ln();

        $detalles = consultas::get_datos("select * from v_detalle_ajuste "
                        . "where cod_ajuste=" . $ordentrabajo['cod_ajuste'] . " order by cod_ajuste");
        if (!empty($detalles)) {

            $pdf->SetFont('', 'B', 10);
            $pdf->SetFillColor(188, 188, 188);
              
            $pdf->Cell(20, 5, '#', 1, 0, 'C', 1);
            $pdf->Cell(70, 5, 'ARTICULO', 1, 0, 'C', 1);
            $pdf->Cell(40, 5, 'DEPOSITO', 1, 0, 'C', 1);
            $pdf->Cell(40, 5, 'MOTIVO', 1, 0, 'C', 1);
            $pdf->Cell(45, 5, 'CANT. FIS. ACTUAL', 1, 0, 'C', 1);
            $pdf->Cell(45, 5, 'CANT. LOG. ANTERIOR', 1, 0, 'C', 1);
//            $pdf->Cell(40, 5, 'OBS', 1, 0, 'C', 1);
            $pdf->Cell(30, 5, 'ESTADO', 1, 0, 'C', 1);
//            $pdf->Cell(30, 5, 'SERVICIO 2', 1, 0, 'C', 1);
           
           
       
            $pdf->Ln(); //salto

            $pdf->SetFont('', '', 10);
            $pdf->SetFillColor(255, 255, 255);



            foreach ($detalles as $detalle) {

       $pdf->Cell(20, 5, $detalle['cod_art'], 1, 0, 'C', 1);
                $pdf->Cell(70, 5, $detalle['art_descri'], 1, 0, 'C', 1);
                $pdf->Cell(40, 5, $detalle['dep_descri'], 1, 0, 'C', 1);
                $pdf->Cell(40, 5, $detalle['motivo_ajuste'], 1, 0, 'C', 1);
                $pdf->Cell(45, 5, $detalle['canti_fisica_actual'], 1, 0, 'C', 1);
                $pdf->Cell(45, 5, $detalle['canti_logica_anterior'], 1, 0, 'C', 1);
                $pdf->Cell(30, 5, $detalle['det_estado'], 1, 0, 'C', 1);
//                $pdf->Cell(30, 5, $detalle['serv_descri'], 1, 0, 'C', 1);
                
                 $pdf->Ln();
            }
        } else {
            $pdf->SetFont('times', 'B', '14');
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetTextColor(255, 0, 0);
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->Cell(320, 6, 'NO SE ENCUENTRAN DATOS', 0, 0, 'C', 0);
        }
    }
} else {
    $pdf->SetFont('times', 'B', '14');
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetTextColor(255, 0, 0);
    $pdf->SetDrawColor(0, 0, 0);
    $pdf->Cell(320, 6, 'NO SE ENCUENTRAN DATOS', 0, 0, 'C', 0);
}

//SALIDA AL NAVEGADOR
$pdf->Output('reporte_insumos.pdf', 'I');
?>
