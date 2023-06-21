<?php
    require_once('fpdf185/fpdf.php');
    require_once('../functions/myfunctions.php');
    date_default_timezone_set('Asia/Manila');
   
// Define a new class extending FPDF
class SalesReportPDF extends FPDF {
    // Define the header of the PDF
    function Header() {

         // Retrieve the system information
         $system_info = systeminfo();
         if ($row = mysqli_fetch_assoc($system_info)) {
        // Add the logo
        $this->Image('../assets/images/'. $row['business_logo'], 15, 10, 22, 22);

        // Add the subtitle
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 15, $row['system_name'], 0, 1, 'C');

        // Add the title
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 10, 'Sales Report', 0, 1, 'C');
    
        // Add business name and address
        $this->SetFont('Arial', '', 9);
        $this->Cell(0, 5, 'Business name: ' . $row['business_name'], 0, 1, 'L');
        $this->MultiCell(0, 5, 'Address: ' . $row['business_address'], 0,'L');
        $this->Cell(0, 5, 'Contact Email: ' . $row['seller_email'], 0, 1, 'L');
         //  $this->Cell(0, 5, 'San Jose del Monte, Philippines', 0, 1, 'L');       
         }
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
    function generateSalesReport($start_date, $end_date) {
        // Add the prepared date and From-To Date information
        $admin_info = getAllAdmin();
        if ($admin = mysqli_fetch_assoc($admin_info)) {
            // Display the admin's name and position
            $this->SetFont('Arial', '', 9);
            if($admin['role_as'] == 1) {
                $admin_role = 'Admin';
            } else {
                $admin_role = 'Staff';
            }
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(0, 5, 'Prepared by: '. $admin['name'] . ' (' . $admin_role . ') - ' . date('F j, Y'), 0, 1, 'R');
        }

        $this->Cell(0, 5, 'From Date: ' . $start_date . '   To Date: ' . $end_date, 0, 1, 'R');
        // Set font and table headers
        $this->SetFont('Arial','B',9);
        $this->Cell(55,10,'Transaction Date', 1, 0, 'C');
        $this->Cell(20,10,'Category', 1, 0, 'C');
        $this->Cell(60,10,'Product Name', 1, 0, 'C');
        $this->Cell(20,10,'Price', 1, 0, 'C');
        $this->Cell(10,10,'QTY', 1, 0, 'C');
        $this->Cell(30,10,'Total Amount', 1, 0, 'C');
        $this->Ln();
        
        // Get the sales report data
        $reportSales= getSalesReport($start_date, $end_date);
        $total_price = 0;
        $total_qty = 0;
        $total_amount = 0;
        
        // Add data rows
        $this->SetFont('Arial','',8);
        foreach ($reportSales as $item) {
            $transaction_date = date("l, j F Y, h:i A", strtotime($item["transaction_date"]));
            $this->Cell(55,10,$transaction_date, 1, 0, 'L');
            $this->Cell(20,10,$item['category_name'], 1, 0, 'C');
            $this->Cell(60,10,$item['product_name'], 1, 0, 'L');
            $this->Cell(20,10,number_format($item['total_price'], 2), 1, 0, 'C');
            $this->Cell(10,10,$item['qty'], 1, 0, 'C');
            $this->Cell(30,10,number_format($item['total_amount'], 2), 1, 0, 'C');
            $this->Ln();
            $total_price += $item['total_price'];
            $total_qty += $item['qty'];
            $total_amount += $item['total_amount'];
        }
        
        // Add table footer
        $this->SetFont('Arial','B',9);
        $this->Cell(10,10,'Total:',0,0,'R');
        $this->Cell(125,10,'',0,0,'R');
        $this->Cell(20,10,number_format($total_price, 2), 1, 0, 'C');
        $this->Cell(10,10,$total_qty, 1, 0, 'C');
        $this->Cell(30,10,number_format($total_amount, 2), 1, 0, 'C');

        
    }
}

// Create a new instance of the SalesReportPDF class
$pdf = new SalesReportPDF();

// Set the document properties
$pdf->SetTitle('Sales Report');
$pdf->SetAuthor('ApoBangpo Merch Ph');

// Add a new page to the PDF
$pdf->AddPage();

// Retrieve the sales report data
// $result = getSalesReport();

// Retrieve the start date and end date from the query parameters
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;

// Generate the sales report in the PDF
$pdf->generateSalesReport($start_date, $end_date);



// Output the PDF to the browser
$pdf->Output();

?>