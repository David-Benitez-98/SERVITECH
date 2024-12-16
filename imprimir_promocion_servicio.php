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
$pdf->SetTitle('REPORTE DE PROMOCION');
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
$pdf->Cell(0, 0, "REPORTE DE PROMOCION EN SERVICIOS", 0, 1, 'C');
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
$ordentrabajos = consultas::get_datos("select * from v_promocion "
                . "where cod_promocion=" . $_REQUEST['codigo'] . " order by cod_promocion");

if (!empty($ordentrabajos)) {

    foreach ($ordentrabajos as $ordentrabajo) {
        $pdf->SetFont('', 'B', 10);
        //columnas

        $pdf->SetFillColor(180, 180, 180);
        $pdf->SetFillColor(180, 180, 180);
        $pdf->SetFillColor(180, 180, 180);
         $pdf->Ln();
               $pdf->Cell(30, 5, '#PROMO ', 0, 0, 'C', 1);
            $pdf->Cell(65, 5, 'DESCRIPCION',0 , 0, 'C', 1);
            $pdf->Cell(40, 5, 'USUARIO',0 , 0, 'C', 1);
            $pdf->Cell(55, 5, 'SUCURSAL',0 , 0, 'C', 1);
//            $pdf->Cell(60, 5, 'CLIENTE',0 , 0, 'C', 1);
            $pdf->Cell(40, 5, 'FECHA INICIO',0 , 0, 'C', 1);
            $pdf->Cell(40, 5, 'FECHA FIN',0 , 0, 'C', 1);
            $pdf->Cell(30, 5, 'ESTADO',0 , 0, 'C', 1);
      
           

  $pdf->Ln();
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetFont('', '', 10);
            $pdf->Cell(30, 5, $ordentrabajo['cod_promocion'], 0, 0, 'C', 1);
           $pdf->Cell(65, 5, $ordentrabajo['descri_promo'], 0, 0, 'C', 1);
            $pdf->Cell(40, 5, $ordentrabajo['usuario'], 0, 0, 'C', 1);
            $pdf->Cell(55, 5, $ordentrabajo['suc_descri'], 0, 0, 'C', 1);
//            $pdf->Cell(60, 5, $ordentrabajo['cliente'], 0, 0, 'C', 1);
            $pdf->Cell(40, 5, $ordentrabajo['vfecha_ini'], 0, 0, 'C', 1);
            $pdf->Cell(40, 5, $ordentrabajo['vfecha_fin'], 0, 0, 'C', 1);
             $pdf->Cell(30, 5, $ordentrabajo['estado'], 0, 0, 'C', 1);
//           
        $pdf->Ln();
        $pdf->Ln();

        $detalles = consultas::get_datos("select * from v_deta_promo "
                        . "where cod_promocion=" . $ordentrabajo['cod_promocion'] . " order by cod_promocion");
        if (!empty($detalles)) {

            $pdf->SetFont('', 'B', 10);
            $pdf->SetFillColor(188, 188, 188);
              
            $pdf->Cell(20, 5, '#', 1, 0, 'C', 1);
            $pdf->Cell(70, 5, 'TIPO SERVICIO', 1, 0, 'C', 1);
            $pdf->Cell(40, 5, 'PLAZO RECLAMO', 1, 0, 'C', 1);
            $pdf->Cell(40, 5, 'IMPUESTO', 1, 0, 'C', 1);
            $pdf->Cell(40, 5, 'PORCENTAJE DESC', 1, 0, 'C', 1);
            $pdf->Cell(30, 5, 'PRECIO', 1, 0, 'C', 1);
            $pdf->Cell(30, 5, 'DESCUENTO', 1, 0, 'C', 1);
            $pdf->Cell(30, 5, 'ESTADO', 1, 0, 'C', 1);
           
           
       
            $pdf->Ln(); //salto

            $pdf->SetFont('', '', 10);
            $pdf->SetFillColor(255, 255, 255);



            foreach ($detalles as $detalle) {

       $pdf->Cell(20, 5, $detalle['cod_promocion'], 1, 0, 'C', 1);
                $pdf->Cell(70, 5, $detalle['descri_servicio'], 1, 0, 'C', 1);
                $pdf->Cell(40, 5, $detalle['plazo_reclamo']." días ", 1, 0, 'C', 1);
                $pdf->Cell(40, 5, $detalle['imp_descri'], 1, 0, 'C', 1);
                $pdf->Cell(40, 5, $detalle['promo_valor_porc']." %", 1, 0, 'C', 1);
                $pdf->Cell(30, 5, number_format(($detalle['precio_tipo_servi']),0,',','.'), 1, 0, 'C', 1);
                $pdf->Cell(30, 5, number_format(($detalle['promo_servi']),0,',','.'), 1, 0, 'C', 1);
                $pdf->Cell(30, 5, $detalle['estado'], 1, 0, 'C', 1);
                
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
$pdf->Output('reporte_descuento_servi.pdf', 'I');
?>
