<?php 
// session_start();
include('../config/dbcon.php');

     // =================================
     
//This is the result of getting the total sales
     function getTotalSales() {
        global $con;
        $query = "SELECT SUM(total_price) as total_sales FROM orders WHERE status = 1 OR status = 2";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_execute($stmt);
        $query_run = mysqli_stmt_get_result($stmt);
        $result = mysqli_fetch_assoc($query_run);
        $total_sales = $result['total_sales'];
        $cancelled_sales = getCancelledSales();
        $total_sales -= $cancelled_sales;
        return $total_sales;
    }
//This is the query for list of cancelled order
    function getCancelledSales() {
        global $con;
        $query = "SELECT SUM(total_price) as cancelled_sales FROM orders WHERE status = 2";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_execute($stmt);
        $query_run = mysqli_stmt_get_result($stmt);
        $result = mysqli_fetch_assoc($query_run);
        $cancelled_sales = $result['cancelled_sales'];
        return $cancelled_sales;
    }

    function getTotalUsers() {
        global $con;
        $query = "SELECT COUNT(*) as total_users FROM users WHERE `role_as` = 0";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
        return $row['total_users'];
    }

    function getTotalcart() {
        global $con;
        $query = "SELECT COUNT(id) as prod_qtys FROM carts";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_execute($stmt);
        $query_run = mysqli_stmt_get_result($stmt);
        $result = mysqli_fetch_assoc($query_run);
        $total_sales = $result['prod_qtys'];
        $cancelled_sales = getCancelledSales();
        $total_sales = max(0, $total_sales - $cancelled_sales); // Ensure the result is not negative
        return $total_sales;
    }

    function getTotalwishlist() {
        global $con;
        $query = "SELECT COUNT(prod_qty) as prod_qtys FROM wishlist";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_execute($stmt);
        $query_run = mysqli_stmt_get_result($stmt);
        $result = mysqli_fetch_assoc($query_run);
        $total_sales = $result['prod_qtys'];
        $cancelled_sales = getCancelledSales();
        $total_sales = max(0, $total_sales - $cancelled_sales); // Ensure the result is not negative
        return $total_sales;
    }


    

 // =================================

 // Query to retrieve age and gender data
$sql = "SELECT TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) AS age, sex FROM users WHERE  user_id ";
$result = $con->query($sql);

// Create associative array of age and gender data
$data = array();
while ($row = $result->fetch_assoc()) {
    $age = $row['age'];
    $gender = $row['sex'];
    if (isset($data[$gender])) {
        $data[$gender]['count']++;
        $data[$gender]['ages'][] = $age;
    } else {
        $data[$gender]['count'] = 1;
        $data[$gender]['ages'] = array($age);
    }
}

// Encode data into JSON format
$json_data = json_encode($data);


// =======================================================

// Prepare the SQL statement
$query = "SELECT sex, COUNT(*) AS count FROM users GROUP BY sex";
$stmt = mysqli_prepare($con, $query);

// Execute the prepared statement
mysqli_stmt_execute($stmt);

// Bind the result variables
mysqli_stmt_bind_result($stmt, $sex, $count);

// Fetch the data from the statement
$gender_data = array();
while (mysqli_stmt_fetch($stmt)) {
    $gender_data[$sex] = $count;
}

// Close the prepared statement
mysqli_stmt_close($stmt);


// ========================================

// $sql = "SELECT products.name, SUM(orders.total_price) AS total_sales
// FROM orders
// JOIN products ON orders.id = products.category_id
// GROUP BY products.name";
// $result = mysqli_query($con, $sql);

// $product = [];
// $sales = [];

// while ($row = mysqli_fetch_array($result)) {
//     $product[] = $row['product_name'];
//     $sales[] = $row['sales'];
// }

// =======================================


// Connect to the database and execute the query
// $db = mysqli_connect('localhost', 'username', 'password', 'database');
// $query = "SELECT p.name as product_name, o.total_price as price FROM products p JOIN orders o";
// $query = "SELECT p.name as product_name, SUM(o.total_price) as total_price FROM products p JOIN orders o GROUP BY p.name;";
$query = "SELECT p.name AS product_name, SUM(oi.price) AS total_price FROM products p JOIN order_items oi ON p.id = oi.prod_id GROUP BY p.id;";
$result = mysqli_query($con, $query);

// Fetch the data and convert it to JSON format
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = array('product_name' => $row['product_name'], 'total_price' => $row['total_price']);
}
// Calculate the total sum of prices
$total_sum = 0;
foreach ($data as $row) {
    $total_sum += $row['total_price'];
}

// Add percentage value for each product
foreach ($data as &$row) {
    $percentage = round(($row['total_price'] / $total_sum) * 100, 2);
    $row['percentage'] = $percentage . '%';
}

// Convert the updated data to JSON format
$json_data = json_encode($data);

// Close the database connection

// =======================================


// example SQL query to get sales data for each day
// $sql = "SELECT DATE(sale_date) AS day, SUM(total_sales) AS sales FROM sales GROUP BY DATE(sale_date)";
$sql = "SELECT DATE(created_at) AS sales_day, SUM(total_price) AS total_sales
FROM orders
WHERE status = 1
GROUP BY sales_day
ORDER BY sales_day ASC;";
$result = mysqli_query($con, $sql);

// create an empty array to store the sales data
$salesData = array();

// loop through the query results and store the sales data in the array
while ($row = mysqli_fetch_assoc($result)) {
    $salesData[$row['sales_day']] = $row['total_sales'];
}

// convert the sales data array to a JavaScript object
$salesDataJson = json_encode($salesData);


?>

