<?php

// var_dump($data['itemtrans'][0]['transaction_id']);
// var_dump($data['trans']);

require('fpdf/fpdf.php');
$title = 'Transaksi ' . $data['itemtrans'][0]['transaction_id'];
$times =  $data['trans']['date'] . ' - ' . $data['trans']['time'];


$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetTitle($title);

$pdf->SetFont('Arial', 'B', 15);
$w = $pdf->GetStringWidth($title) + 3;
// $pdf->SetX((210 - $w) / 2);
$pdf->Cell(0, 10, $title, 'C');

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 12);
$w = $pdf->GetStringWidth($title) + 3;
// $pdf->SetX((210 - $w) / 1);
$pdf->Cell(0, 10, $times, 'C');

$pdf->Ln(15);



// $pdf->SetTextColor(0, 0, 0, 1);

$pdf->SetFont('Arial', 'B', 10);
// $pdf->SetX((210 - $w) / 10);
$pdf->Cell(70, 6, 'Nama Produk', 1, 0, 'C');
$pdf->Cell(40, 6, 'Quantity', 1, 0, 'C');
$pdf->Cell(70, 6, 'Harga Produk', 1, 0, 'C');

$pdf->Ln(6);
$total = 0;
foreach ($data['itemtrans'] as $vals) {
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(70, 5, $vals['name'], 1, 0, 'C');
    $pdf->Cell(40, 5,  $vals['quantity'], 1, 0, 'C');
    $pdf->Cell(70, 5, 'Rp.' . $vals['price'], 1, 0, 'C');

    $pdf->Ln(5);
    $total += ($vals['quantity'] * $vals['price']);
}

$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell(110, 6, 'Total', 1, 0, 'C');
$pdf->Cell(70, 6, 'Rp. ' . $total, 1, 0, 'C');
$pdf->Ln(6);

//     // $pdf->SetFont('Arial', 'B', 10);
//     // $pdf->SetX((210 - $w) / 10);
//     // $pdf->Cell(30, 5, 'TOTAL', 1, 0, 'C');
//     // $pdf->Cell(40, 5, 'Rp.' . $totalRevenus, 1, 0, 'C');
//     // $pdf->Cell(30, 5, ' ', 1, 0, 'C');
//     // $pdf->Cell(40, 5, 'Rp.' . $totalRevenus, 1, 0, 'C');
//     // $pdf->Cell(40, 5, ' ', 1, 0, 'C');
//     // $pdf->Ln(5);

//     // $pdf->Ln(5);
//     // $pdf->SetFont('Arial', 'B', 12);
//     // $pdf->SetX((210 - $w) / 11);
//     // $pdf->Cell(0, 5, $nametenan, 0, 0);
//     // $pdf->Cell(-10, 5, 'TOTAL REVENUE: RP ' . $totalRevenus, 0, 0, 'R');
//     // $pdf->Ln(10);

//     // $pdf->SetFont('Arial', 'B', 12);
//     // $pdf->SetX((210 - $w) / 11);
//     // $pdf->Cell(0, 5, '', 0, 0);
//     // $pdf->Cell(-23, 5, 'TOTAL SURPLUS: RP ', 0, 0, 'R');

//     // $pdf->Ln(10);
//     // $pdf->SetFont('Arial', 'B', 12);
//     // $pdf->SetX((210 - $w) / 11);
//     // $pdf->Cell(0, 5, $namapengguna, 0, 0);
//     // $pdf->Cell(-10, 5, 'SUB TOTAL         : RP ' . $totalRevenus, 0, 0, 'R');







$pdf->Output();