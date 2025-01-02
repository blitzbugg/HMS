<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('../fpdf/fpdf.php');
include("../include/connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['invoice_id'])) {
    $invoice_id = intval($_POST['invoice_id']);

    // Fetch invoice data
    $query = "SELECT * FROM income WHERE id=?";
    $stmt = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmt, "i", $invoice_id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($res);

    if ($row) {
        // Create PDF
        class PDF extends FPDF {
            function Header() {
                $this->SetFont('Arial', 'B', 14);
                $this->Cell(0, 10, 'Invoice Details', 0, 1, 'C');
                $this->Ln(10);
            }

            function Footer() {
                $this->SetY(-15);
                $this->SetFont('Arial', 'I', 8);
                $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
            }
        }

        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        // Invoice details
        $pdf->Cell(50, 10, 'Invoice ID:', 1);
        $pdf->Cell(140, 10, $row['id'], 1, 1);

        $pdf->Cell(50, 10, 'Doctor:', 1);
        $pdf->Cell(140, 10, $row['doctor'], 1, 1);

        $pdf->Cell(50, 10, 'Patient:', 1);
        $pdf->Cell(140, 10, $row['patient'], 1, 1);

        $pdf->Cell(50, 10, 'Discharge Date:', 1);
        $pdf->Cell(140, 10, date('F d, Y', strtotime($row['date_discharge'])), 1, 1);

        $pdf->Cell(50, 10, 'Amount Paid:', 1);
        $pdf->Cell(140, 10, '₹' . number_format($row['amount_paid'], 2), 1, 1);

        $pdf->Cell(50, 10, 'Description:', 1);
        $pdf->MultiCell(140, 10, $row['description'], 1);

        // Output PDF
        $pdf->Output('D', 'Invoice_' . $row['id'] . '.pdf'); // Forces download
    } else {
        echo "Invoice not found.";
    }
} else {
    echo "Invalid request.";
}
