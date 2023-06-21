<?php
    $titlePage = "Generate Report";
    include('../config/dbcon.php');
    date_default_timezone_set('Asia/Manila');

    // Set the company name and address
$company_name = "Business name: ApoBangpo Merch Ph";
$company_address = "Address: 8020 A Mabini St. Purok 5 San Martin III,San Jose del Monte, Philippines";

// Get the current date
$current_date = date('F j, Y');

   // SQL query to fetch data from the table
$sql = "SELECT oi.created_at AS transaction_date, c.name AS category_name, p.name AS product_name, oi.price, oi.qty, oi.price * oi.qty AS total_amount FROM order_items oi JOIN products p ON oi.prod_id = p.id JOIN categories c ON p.category_id = c.id ORDER BY oi.created_at DESC";

// Execute the query
$result = $con->query($sql);

// Create CSV file
$csv_file = fopen('sales_report.csv', 'w');


// Write company name and address to CSV file
fputcsv($csv_file, array($company_name));
fputcsv($csv_file, array($company_address));
fputcsv($csv_file, array(''));

// Write current date to CSV file
fputcsv($csv_file, array('Date: ' . $current_date));
fputcsv($csv_file, array(''));

// Write headers to CSV file
fputcsv($csv_file, array('Transaction Date', 'Category', 'Product', 'Price', 'Quantity', 'Total Amount'));

// Initialize totals
$total_price = 0;
$total_qty = 0;
$total_amount = 0;

// Loop through the data and write to CSV file
while ($row = $result->fetch_assoc()) {
    // Format transaction date
    $transaction_date = date("l, j F Y, h:i A", strtotime($row['transaction_date']));

    // Format price and total amount
    $price = "Php " . number_format($row['price'], 2);
    $total_amount_row = $row['price'] * $row['qty'];
    $total_amount += $total_amount_row;
    $total_price += $row['price'];
    $total_qty += $row['qty'];
    $total_amount_formatted = "Php " . number_format($total_amount, 2);

    // Write row to CSV file
    fputcsv($csv_file, array($transaction_date, $row['category_name'], $row['product_name'], $price, $row['qty'], "Php " . number_format($total_amount_row, 2)));
}

// Write footer to CSV file
fputcsv($csv_file, array('Total:', '', '', 'Php ' . number_format($total_price, 2), $total_qty, $total_amount_formatted));

// Close the CSV file
fclose($csv_file);

// Set headers to download the CSV file
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="sales_report.csv"');

// Output the CSV file to the browser
readfile('sales_report.csv');

// Delete the CSV file
unlink('sales_report.csv');

// Close the database connection
// $conn->close();

// Redirect back to index page
// header("Location: index.php");
// exit();



?>