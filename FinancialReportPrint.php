<?php
session_start();
require('fpdf17/fpdf.php');
include("includes/db.php");
date_default_timezone_set('Asia/Manila');

class PDF extends FPDF
{
    function WordWrap(&$text, $maxwidth)
    {
        $text = trim($text);
        if ($text === '')
            return 0;
        $space = $this->GetStringWidth(' ');
        $lines = explode("\n", $text);
        $text = '';
        $count = 0;

        foreach ($lines as $line) {
            $words = preg_split('/ +/', $line);
            $width = 0;

            foreach ($words as $word) {
                $wordwidth = $this->GetStringWidth($word);
                if ($wordwidth > $maxwidth) {
                    // Word is too long, we cut it
                    for ($i = 0; $i < strlen($word); $i++) {
                        $wordwidth = $this->GetStringWidth(substr($word, $i, 1));
                        if ($width + $wordwidth <= $maxwidth) {
                            $width += $wordwidth;
                            $text .= substr($word, $i, 1);
                        } else {
                            $width = $wordwidth;
                            $text = rtrim($text) . "\n" . substr($word, $i, 1);
                            $count++;
                        }
                    }
                } elseif ($width + $wordwidth <= $maxwidth) {
                    $width += $wordwidth + $space;
                    $text .= $word . ' ';
                } else {
                    $width = $wordwidth + $space;
                    $text = rtrim($text) . "\n" . $word . ' ';
                    $count++;
                }
            }
            $text = rtrim($text) . "\n";
            $count++;
        }
        $text = rtrim($text);
        return $count;
    }
}





//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

$pdf = new FPDF('P', 'mm', 'A4');

$pdf->AddPage();

$pdf->SetFont('Arial', '', 12);

//Cell(width , height , text , border , end line , [align] )
$pdf->Cell(0, 5, 'LIC # ME 0000000', 0, 1, "L"); //end of line

//set font to arial, bold, 14pt
$pdf->SetFont('Arial', 'B', 14);

$pdf->Cell(189, 10, '', 0, 1); //end of line
$pdf->Image('data:image/png;base64,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',60,0,90,0,'PNG');
$pdf->Cell(189, 10, '', 0, 1); //end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(0, 5, '22 Propack Asia Corporation', 0, 1);

//set font to arial, regular, 12pt
$pdf->SetFont('Arial', '', 12);

$pdf->Cell(130, 5, '64 Queensland St. Vista Real Classica Bgy. Matandang Balara,', 0, 0);

$pdf->Cell(25, 5, 'Date: ' . date("Y-m-d"), 0, 0);
$pdf->Cell(59, 5, '', 0, 1); //end of line

$pdf->Cell(130, 5, 'Makati City', 0, 1); //end of line

$pdf->Cell(130, 5, 'Phone: 0922-8791301 / 0918-9479964', 0, 0);
$pdf->Cell(34, 5, '', 0, 1); //end of line
$pdf->Cell(130, 5, 'Fax (02) 709-0342', 0, 0);
$pdf->Cell(34, 5, '', 0, 1); //end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189, 10, '', 0, 1); //end of line

$pdf->SetFont('Arial', 'B', 15);

$pdf->MultiCell(192, 7, "Financial Report", 1, 1);

$pdf->SetFont('Arial', '', 12);

$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(32, 5, 'PO No.', 1, 0);
$pdf->Cell(32, 5, 'Client Name', 1, 0);
$pdf->Cell(60, 5, 'Product Name', 1, 0);
$pdf->Cell(22, 5, 'Measure', 1, 0);
$pdf->Cell(14, 5, 'Qty', 1, 0);
$pdf->Cell(32, 5, 'Date', 1, 1); //end of line

$pdf->SetFont('Arial', '', 12);

//Numbers are right-aligned so we give 'R' after new line parameter

include("includes/db.php");
$ref = "orders";
$data = $database->getReference($ref)->getValue();
$totalprice = 0;
$array = array();
foreach ($data as $key => $data1) {
    $n = 0;
    array_push($array, $data1['clientName']);
    foreach ($data1['products'] as $key2 => $data2) {
        $totalprice += $data1['price'];

        $pdf->Cell(32, 5, $data1['poNumber'], 1, 0);
        $pdf->Cell(32, 5, $data1['clientName'], 1, 0);
        $pdf->Cell(60, 5, $data2['name' . $n], 1, 0);
        $pdf->Cell(22, 5, $data2['measure' . $n], 1, 0);
        $pdf->Cell(14, 5, $data2['qty' . $n], 1, 0);
        $pdf->Cell(32, 5, $data1['date'], 1, 1); //end of line
        $n++;
    }
}

$pdf->Cell(124, 5, '', 0, 0);
$pdf->Cell(36, 5, 'Clients', 1, 0);
$pdf->Cell(32, 5, "Times ordered", 1, 1);

$unique =  array_unique($array);
foreach ($unique as $value) {
    $n = 0;
    $count = 0;
    $pdf->Cell(124, 5, '', 0, 0);
    $pdf->Cell(36, 5, $value, 1, 0);
        foreach ($data as $key => $data1) {
          foreach ($data1['products'] as $key2 => $data2) {
            if ($value == $data1['clientName']) {
              $count++;
            }
            $n++;
          }
        }
        $pdf->Cell(32, 5, $count, 1, 1);
  }

$pdf->Cell(124, 5, '', 0, 0);
$pdf->Cell(36, 5, 'Total Sales', 1, 0);
$pdf->Cell(32, 5, 'P ' . $totalprice, 1, 0);

$pdf->Output();
