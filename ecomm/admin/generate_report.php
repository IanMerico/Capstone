<?php
    $titlePage = "Generate Report";
    include('../config/dbcon.php');

    // SQL query to fetch data from the table
$sql = "SELECT * FROM users";

// Execute the query
$result = $con->query($sql);

// Create CSV file
$csv_file = fopen('report.csv', 'w');

// Write headers to CSV file
fputcsv($csv_file, array('ID', 'Name', 'description'));

// Loop through the data and write to CSV file
while ($row = $result->fetch_assoc()) {
    fputcsv($csv_file, $row);
}

// Close the CSV file
fclose($csv_file);

// Set headers to download the CSV file
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="report.csv"');

// Output the CSV file to the browser
readfile('report.csv');

 // Delete the CSV file
 unlink('report.csv');

// Close the database connection
// $conn->close();

 // Redirect back to index page
//  header("Location: index.php");
//  exit();



?>