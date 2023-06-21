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
    $sql = "SELECT products.id, products.name, categories.name as category, products.qty as stock, products.selling_price as price, COALESCE(SUM(order_items.qty), 0) as sold, products.qty - COALESCE(SUM(order_items.qty), 0) as remaining_stock FROM products LEFT JOIN categories ON products.category_id = categories.id LEFT JOIN order_items ON products.id = order_items.prod_id GROUP BY products.id";

    // Execute the query
    $result = $con->query($sql);

    // Create CSV file
    $csv_file = fopen('inventory_report.csv', 'w');

    // Write company name and address to CSV file
    fputcsv($csv_file, array($company_name));
    fputcsv($csv_file, array($company_address));
    fputcsv($csv_file, array(''));

    // Write current date to CSV file
    fputcsv($csv_file, array('Date: ' . $current_date));
    fputcsv($csv_file, array(''));

    // Write headers to CSV file
    fputcsv($csv_file, array('Product ID', 'Product Name', 'Category', 'Stock', 'Price', 'Sold', 'Remaining Stock'));

    // Loop through the data and write to CSV file
    while ($row = $result->fetch_assoc()) {
        // Write row to CSV file
        fputcsv($csv_file, array($row['id'], $row['name'], $row['category'], $row['stock'], $row['price'], $row['sold'], $row['remaining_stock']));
    }

    // Close the CSV file
    fclose($csv_file);

    // Set headers to download the CSV file
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="inventory_report.csv"');

    // Output the CSV file to the browser
    readfile('inventory_report.csv');

    // Delete the CSV file
    unlink('inventory_report.csv');
?>