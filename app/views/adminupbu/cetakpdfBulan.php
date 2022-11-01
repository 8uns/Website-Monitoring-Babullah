<?php
if ($_POST) {
    require('fpdf/fpdf.php');
    $title = 'REVENUE BULAN ' . strtoupper(Bunlib::transalateBulan($data['transaksibulanan'][0]['bulan']));
    $nametenan = $data['transaksibulanan'][0]['nama_tenan'];
    $tahun = $data['transaksibulanan'][0]['tahun'];
    $namapengguna = $data['transaksibulanan'][0]['namapengelola'];
    $totalRevenus = $data['transaksibulananTotal'][0]['total_bulan'];

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetTitle($title);

    $pdf->SetFont('Arial', 'B', 15);

    $w = $pdf->GetStringWidth($title) + 6;
    $pdf->SetX((210 - $w) / 2);
    $pdf->Cell(0, 10, $title . " " . $tahun, 'C');

    $pdf->Ln(15);

    // $pdf->SetTextColor(0, 0, 0, 1);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetX((210 - $w) / 10);
    $pdf->Cell(30, 5, 'TANGGAL', 1, 0, 'C');
    $pdf->Cell(40, 5, 'REVENUE', 1, 0, 'C');
    $pdf->Cell(30, 5, 'SURPLUS', 1, 0, 'C');
    $pdf->Cell(40, 5, 'TOTAL REVENUE', 1, 0, 'C');
    $pdf->Cell(40, 5, 'REMAKE', 1, 0, 'C');
    $pdf->Ln(5);

    foreach ($data['transaksibulanan'] as $vals) {
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetX((210 - $w) / 10);
        $pdf->Cell(30, 5, $vals['date'], 1, 0, 'C');
        $pdf->Cell(40, 5, 'Rp.' . $vals['total_bulan'], 1, 0, 'C');
        $pdf->Cell(30, 5, ' ', 1, 0, 'C');
        $pdf->Cell(40, 5, 'Rp.' . $vals['total_bulan'], 1, 0, 'C');
        $pdf->Cell(40, 5, ' ', 1, 0, 'C');
        $pdf->Ln(5);
    }

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetX((210 - $w) / 10);
    $pdf->Cell(30, 5, 'TOTAL', 1, 0, 'C');
    $pdf->Cell(40, 5, 'Rp.' . $totalRevenus, 1, 0, 'C');
    $pdf->Cell(30, 5, ' ', 1, 0, 'C');
    $pdf->Cell(40, 5, 'Rp.' . $totalRevenus, 1, 0, 'C');
    $pdf->Cell(40, 5, ' ', 1, 0, 'C');
    $pdf->Ln(5);

    $pdf->Ln(5);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetX((210 - $w) / 11);
    $pdf->Cell(0, 5, $nametenan, 0, 0);
    $pdf->Cell(-10, 5, 'TOTAL REVENUE: RP ' . $totalRevenus, 0, 0, 'R');
    $pdf->Ln(10);

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetX((210 - $w) / 11);
    $pdf->Cell(0, 5, '', 0, 0);
    $pdf->Cell(-23, 5, 'TOTAL SURPLUS: RP ', 0, 0, 'R');

    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetX((210 - $w) / 11);
    $pdf->Cell(0, 5, $namapengguna, 0, 0);
    $pdf->Cell(-10, 5, 'SUB TOTAL         : RP ' . $totalRevenus, 0, 0, 'R');







    $pdf->Output();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create PDF using PHP</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="main-block">
        <div class="header">
            Add New Users
        </div>
        <div class="body">
            <form action='' method="POST">
                <input type="text" name="usname" placeholder="Name" required>
                <input type="text" name="dob" placeholder="DOB" required>
                <input type="text" name="job" placeholder="Current Job" required>
                <input type="submit" value="Add User">
            </form>
        </div>
        <div class="footer">
            <p>Developed by <a href="https://vicodemedia.com" target="_blank">Vicode Media</a></p>
        </div>
    </div>
</body>

</html>