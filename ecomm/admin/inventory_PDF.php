<?php
require_once('fpdf185/fpdf.php');
require_once('../functions/myfunctions.php');
date_default_timezone_set('Asia/Manila');

// Define a new class extending FPDF
class InventoryReportPDF extends FPDF {
    // Define the header of the PDF
    function Header() {
        // Add the logo
        $this->Image('img/297979668_103856492433245_4893127009659140128_n-removebg-preview.png', 15, 10, 22, 22);

        // Add the title
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 10, 'Inventory Report', 0, 1, 'C');

        // Add the subtitle
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 15, 'Generated on: ' . date('F j, Y'), 0, 1, 'C');

        // Add business name and address
        $this->SetFont('Arial', '', 9);
        $this->Cell(0, 5, 'Business name: ApoBangpo Merch Ph', 0, 1, 'L');
        $this->Cell(0, 5, 'Address: 8020 A Mabini St. Purok 5 San Martin III, San Jose del Monte, Philippines', 0, 1, 'L');
        $this->Cell(0, 5, 'Phone: 09##-###-####', 0, 1, 'L');

        // Add a line break
        $this->Ln(5);
    }

    // Define the footer of the PDF
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    // Define a function to generate the inventory report
    function generateInventoryReport($result) {
        // Set the table headers
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(10, 10, 'ID', 1, 0, 'C');
        $this->Cell(30, 10, 'Category', 1, 0, 'C');
        $this->Cell(80, 10, 'Product', 1, 0, 'C');
        $this->Cell(20, 10, 'Price', 1, 0, 'C');
        $this->Cell(10, 10, 'Stock', 1, 0, 'C');
        $this->Cell(10, 10, 'Sold', 1, 0, 'C');
        $this->Cell(20, 10, 'Remaining', 1, 1, 'C');

        // Set the table rows
        $this->SetFont('Arial', '', 8);
        foreach($result as $row) {
            $this->Cell(10, 10, $row['id'], 1, 0, 'C');
            $this->Cell(30, 10, $row['category'], 1, 0, 'C');
            $this->Cell(80, 10, $row['name'], 1, 0, 'C');
            $this->Cell(20, 10, $row['price'], 1, 0, 'C');
            $this->Cell(10, 10, $row['stock'], 1, 0, 'C');
            $this->Cell(10, 10, $row['sold'], 1, 0, 'C');
            $remaining_stock = $row['stock'] - $row['sold'];
            $this->Cell(20, 10, $remaining_stock, 1, 1, 'C');
            }
            }
            }
            
            // Create a new PDF instance
            $pdf = new InventoryReportPDF();
            
            // Set the document properties
            $pdf->SetTitle('Inventory Report');
            $pdf->SetAuthor('Your Business Name');
            $pdf->SetCreator('Inventory Report Generator');

            $result= getInventoryReport();
            
            // Generate the inventory report
            $pdf->AddPage();
            $pdf->generateInventoryReport($result);
            
            // Output the PDF
            $pdf->Output();
            
?>
