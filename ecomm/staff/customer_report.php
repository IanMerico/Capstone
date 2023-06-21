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
$sql = "SELECT o.tracking_no, CONCAT(u.name, ' ', u.lname) AS full_name, TIMESTAMPDIFF(YEAR, u.birthdate, CURDATE()) AS age, CONCAT( u.street_address, ', ', u.barangay, ', ', u.city, ', ', u.province, ' ', u.zipcode, ' ', o.country ) AS complete_address, u.phone, u.email, o.payment_mode, o.status, DATE(o.created_at) AS order_date 
FROM orders o 
JOIN users u ON o.user_id = u.user_id 
GROUP BY o.tracking_no 
ORDER BY o.status DESC, o.created_at DESC";

// Execute the query
$result = $con->query($sql);

// Create CSV file
$csv_file = fopen('Customer_Details.csv', 'w');


// Write company name and address to CSV file
fputcsv($csv_file, array($company_name));
fputcsv($csv_file, array($company_address));
fputcsv($csv_file, array(''));

// Write current date to CSV file
fputcsv($csv_file, array('Date: ' . $current_date));
fputcsv($csv_file, array(''));

// Write headers to CSV file
fputcsv($csv_file, array('Order Number', 'Full Name', 'Age', 'Complete Address', 'Phone', 'Email', 'Payment Mode', 'Status', 'Date Order'));


// Loop through the data and write to CSV file
while ($row = $result->fetch_assoc()) {

    $tracking_no = $row['tracking_no'];
    $full_name = $row['full_name'];
    $age = $row['age'];
    $complete_address = $row['complete_address'];
    $phone = $row['phone'];
    $email = $row['email'];
    $payment_mode = $row['payment_mode'];
    $status = $row['status'];
    $order_date = $row['order_date'];

    $stats="";
        if( $status == 0) {
            $stats = "In Process";
        }else if ($status == 1) {
            $stats = "Delivered";
        }else if($status == 2) {
            $stats = "Declined Order";
        }else if($status == 3) {
            $stats = "Cancelled";
        }
    

    fputcsv($csv_file, array($tracking_no, $full_name, $age, $complete_address, $phone, $email, $payment_mode, $stats, date('m/d/Y', strtotime($order_date))));
}

// Write footer to CSV file
// fputcsv($csv_file, array('Total:', '', '', 'Php ' . number_format($total_price, 2), $total_qty, $total_amount_formatted));

// Close the CSV file
fclose($csv_file);

// Set headers to download the CSV file
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="Customer_Details.csv"');


// Output the CSV file to the browser
readfile('Customer_Details.csv');

// Delete the CSV file
unlink('Customer_Details.csv');

// Close the database connection
// $conn->close();

// Redirect back to index page
// header("Location: index.php");
// exit();



?>