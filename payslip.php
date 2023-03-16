<?php
require('fpdf/fpdf.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $hourly_rate = $_POST['hourly_rate'];
  $hours_worked = array_sum($_POST['hours_worked']);
  $hours_absent = array_sum($_POST['hours_absent']);
  $sss = $_POST['sss'];
  $philhealth = $_POST['philhealth'];
  $pagibig = $_POST['pagibig'];
  $cash_advance = $_POST['cash_advance'];

  $gross_pay = $hourly_rate * $hours_worked;
  $total_deductions = $sss + $philhealth + $pagibig + $cash_advance;
  $net_pay = $gross_pay - $total_deductions;

  //new comment

  // Check if file exists
  if (file_exists('payslip.pdf')) {
    // File exists, continue with download
    header('Content-Disposition: attachment; filename="payslip.pdf"');
    readfile('payslip.pdf');
    exit;
  } else {
    // File does not exist, create PDF document
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(40,10,'Payroll Results for ' . $name);
    $pdf->Ln();
    $pdf->Cell(40,10,'Gross Pay: ' . $gross_pay);
    $pdf->Ln();
    $pdf->Cell(40,10,'Total Deductions: ' . $total_deductions);
    $pdf->Ln();
    $pdf->Cell(40,10,'Net Pay: ' . $net_pay);
    $pdf->Output('payslip.pdf', 'F');
    header('Content-Disposition: attachment; filename="payslip.pdf"');
    readfile('payslip.pdf');
    exit;
  }
}
?>
