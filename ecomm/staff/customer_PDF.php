<?php
    require_once('fpdf185/fpdf.php');
    require_once('../functions/myfunctions.php');
    date_default_timezone_set('Asia/Manila');
    
// Define a new class extending FPDF
class SalesReportPDF extends FPDF {
    // Define the header of the PDF
    function Header() {
        // Add the logo
        $this->Image('img/297979668_103856492433245_4893127009659140128_n-removebg-preview.png', 15, 10, 22, 22);

        // Add the title
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 10, 'Customers list of details', 0, 1, 'C');
    
        // Add the subtitle
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 15, 'Generated on: ' . date('F j, Y'), 0, 1, 'C');

        // Add business name and address
        $this->SetFont('Arial', '', 9);
        $this->Cell(0, 5, 'Business name: ApoBangpo Merch Ph', 0, 1, 'L');
        $this->Cell(0, 5, 'Address: 8020 A Mabini St. Purok 5 San Martin III,', 0, 1, 'L');
        $this->Cell(0, 5, 'San Jose del Monte, Philippines', 0, 1, 'L');

          // Add a line break
        $this->Ln(5);
    }

    // Define the footer of the PDF
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    // Define a function to generate the sales report
    function generateSalesReport() {
        // Set font and table headers
        $this->SetFont('Arial','B',9);
        $this->Cell(30,10,'Tracking Order', 1, 0, 'C');
        $this->Cell(30,10,'Full Name', 1, 0, 'C');
        $this->Cell(10,10,'Age', 1, 0, 'C');
        $this->Cell(150,10,'Complete Address', 1, 0, 'C');
        $this->Cell(25,10,'Phone#', 1, 0, 'C');
        $this->Cell(40,10,'Email', 1, 0, 'C');
        $this->Cell(15,10,'M.o.P', 1, 0, 'C');
        $this->Cell(15,10,'Status', 1, 0, 'C');
        $this->Cell(20,10,'Order Date', 1, 0, 'C');
        $this->Ln();
        
        // Get the sales report data
        $reportSales= getCustomerinfo();
        $total_price = 0;
        $total_qty = 0;
        $total_amount = 0;
        
        // Add data rows
        $this->SetFont('Arial','',8);
        foreach ($reportSales as $item) {
            $this->Cell(30,10,$item['tracking_no'], 1);
            $this->Cell(30,10,$item['full_name'], 1, 0, 'L');
            $this->Cell(10,10,$item['age'], 1, 0, 'C');
            $this->Cell(150,10,$item['complete_address'], 1, 0, 'L');
            $this->Cell(25,10,$item['phone'], 1, 0, 'C');
            $this->Cell(40,10,$item['email'], 1, 0, 'C');
            $this->Cell(15,10,$item['payment_mode'], 1, 0, 'C');
            // $this->Cell(15,10,$item['status'], 1, 0, 'C');
            if ($item['status'] == 1) {
                $this->Cell(15,10,'Delivered', 1, 0, 'C');
            } else {
                $this->Cell(15,10,'Cancelled', 1, 0, 'C');
            }
            $this->Cell(20,10,$item['order_date'], 1, 0, 'C');
            $this->Ln();
        }
    }
}

// Create a new instance of the SalesReportPDF class
$pdf = new SalesReportPDF();

// Set the document properties
$pdf->SetTitle('Sales Report');
$pdf->SetAuthor('ApoBangpo Merch Ph');

// Add a new page to the PDF
$pdf->AddPage('L','Legal');

// Retrieve the sales report data
$result = getCustomerinfo();

// Generate the sales report in the PDF
$pdf->generateSalesReport($result);

// Set the zoom level to 50%
$pdf->SetDisplayMode('fullpage','continuous','UseNone',50);

// Output the PDF to the browser
$pdf->Output();

?>