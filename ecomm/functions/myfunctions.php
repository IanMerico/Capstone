<?php
session_start();
include('../config/dbcon.php');
require_once 'vendor/autoload.php';
require_once 'vendor1/autoload.php';
use Phpml\Clustering\KMeans;

function getAll($table) {

    global $con;
    $query = "SELECT * FROM $table";
    $query_run = mysqli_prepare($con, $query);
    mysqli_stmt_execute($query_run);
    return mysqli_stmt_get_result($query_run);

}
function getAllCustomers($table) {
    global $con;
    $query = "SELECT * FROM $table ORDER BY created_at DESC";
    $result = mysqli_query($con, $query);
    return $result;
}

function getCustomersWithLimit($table, $startIndex, $resultsPerPage) {
    global $con;
    $query = "SELECT * FROM $table ORDER BY created_at DESC LIMIT ?, ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'ii', $startIndex, $resultsPerPage);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return $result;
}
function searchCustomersByName($table, $search) {
    global $con;
    $query = "SELECT * FROM $table WHERE name LIKE ? OR email LIKE ? OR lname LIKE ? ORDER BY created_at DESC";
    $stmt = mysqli_prepare($con, $query);
    $searchTerm = '%' . $search . '%';
    mysqli_stmt_bind_param($stmt, 'sss', $searchTerm, $searchTerm, $searchTerm);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return $result;
}




// this function is to get all the list from admin table users
function getAllusers($table) {

    global $con;
    $query = "SELECT * FROM $table";
    $query_run = mysqli_prepare($con, $query);
    mysqli_stmt_execute($query_run);
    return mysqli_stmt_get_result($query_run);

}



// This function is to fetch all the data from the table
// feedback that is use for k-means datamining

function getFeedback() {
    global $con;
    $query = "SELECT name, gender, age, suggestions, feedback FROM feedback";
    $query_run = mysqli_prepare($con, $query);
    mysqli_stmt_execute($query_run);
    return mysqli_stmt_get_result($query_run);
}
// This function is to normalize the dataset
// feedback that is use for k-means datamining


function normalizeFeedback() {
    global $con;
    $query = "SELECT
    id,
    name,
    CASE WHEN gender = 'Male' THEN 1 ELSE 0 END AS is_male,
    CASE WHEN gender = 'Female' THEN 1 ELSE 0 END AS is_female,
    (age - (SELECT MIN(age) FROM feedback)) / (SELECT MAX(age) - MIN(age) FROM feedback) AS normalized_age,
    suggestions,
    feedback
FROM
    feedback;
";
    
    $result = mysqli_query($con, $query);
    return $result;
}

function normalizedFeedbackKmeans() {
    global $con;
    $query = "SELECT
        CASE WHEN gender = 'Male' THEN 1 ELSE 0 END AS is_male,
        CASE WHEN gender = 'Female' THEN 1 ELSE 0 END AS is_female,
        (age - (SELECT MIN(age) FROM feedback)) / (SELECT MAX(age) - MIN(age) FROM feedback) AS normalized_age,
        feedback
    FROM
        feedback;
    ";

    $result = mysqli_query($con, $query);
    return $result;
}

$data = normalizedFeedbackKmeans();
$resultArray = [];
while ($row = mysqli_fetch_assoc($data)) {
    $resultArray[] = $row;
}

$input = [];
foreach ($resultArray as $row) {
    $input[] = [
        $row['is_male'],
        $row['is_female'],
        $row['normalized_age'],
        $row['feedback']
    ];
}

$numberOfClusters = 3;
$kmeans = new KMeans($numberOfClusters);
$clusters = $kmeans->cluster($input);

// Store cluster characteristics
$clusterSizes = [];
$clusterCentroids = [];

// Calculate cluster sizes
foreach ($clusters as $clusterIndex => $cluster) {
    $clusterSizes[$clusterIndex] = count($cluster);
}

// Compute cluster centroids
foreach ($clusters as $clusterIndex => $cluster) {
    $centroid = array_reduce($cluster, function ($carry, $dataPoint) {
        $carry[0] += $dataPoint[0]; // is_male
        $carry[1] += $dataPoint[1]; // is_female
        $carry[2] += $dataPoint[2]; // normalized_age
        $carry[3] += $dataPoint[3]; // feedback
        return $carry;
    }, [0, 0, 0, 0]);

    $centroidCount = count($cluster);
    
    // Handle division by zero
    if ($centroidCount !== 0) {
        $centroid = array_map(function ($sum) use ($centroidCount) {
            return $sum / $centroidCount;
        }, $centroid);
    }

    $clusterCentroids[$clusterIndex] = $centroid;
}

// ==================================



// Perform clustering
// $numberOfClusters = 2;
// $kmeans = new Phpml\Clustering\KMeans($numberOfClusters);
// $clusters = $kmeans->cluster($input);

// // Calculate WCSS
// $wcss = calculateWCSS($clusters, $input);

// // Function to calculate WCSS
// function calculateWCSS($clusters, $data)
// {
//     $wcss = 0;
//     foreach ($clusters as $clusterData) {
//         if (isset($clusterData['centroid'])) {
//             $centroid = $clusterData['centroid'];
//             if (isset($clusterData['points'])) {
//                 foreach ($clusterData['points'] as $dataIndex) {
//                     $dataPoint = $data[$dataIndex];
//                     $distance = calculateDistance($dataPoint, $centroid);
//                     $wcss += $distance ** 2;
//                 }
//             }
//         }
//     }
//     return $wcss;
// }
// // Function to calculate the distance between two data points
// function calculateDistance($dataPoint, $centroid)
// {
//     $sum = 0;
//     foreach ($dataPoint as $i => $value) {
//         $sum += ($value - $centroid[$i]) ** 2;
//     }
//     return sqrt($sum);
// }

// // Calculate WCSS for different numbers of clusters
// $wcssValues = [];
// $minNumberOfClusters = 2;
// $maxNumberOfClusters = 10;

// for ($k = $minNumberOfClusters; $k <= $maxNumberOfClusters; $k++) {
//     $kmeans = new Phpml\Clustering\KMeans($k);
//     $clusters = $kmeans->cluster($input);
//     $wcss = calculateWCSS($clusters, $input);
//     $wcssValues[$k] = $wcss;
// }

// Print WCSS values
// foreach ($wcssValues as $clusters => $wcss) {
//     echo "WCSS for $clusters clusters: $wcss" . PHP_EOL;
// }



// Rest of the code remains the same

// This function is for corelation analysis
// feedback that is use for k-means datamining

// This function performs correlation analysis on the normalized feedback data
// This function performs correlation analysis on the normalized feedback data
// function correlationAnalysis() {
//     global $con;
//     $query = "SELECT
//         (SUM(normalized_age * feedback) - COUNT(*) * AVG(normalized_age) * AVG(feedback)) /
//         (SQRT((SUM(POW(normalized_age, 2)) - COUNT(*) * POW(AVG(normalized_age), 2)) *
//         (SUM(POW(feedback, 2)) - COUNT(*) * POW(AVG(feedback), 2)))) AS Normalized_age,
//         (SUM(is_male * feedback) - COUNT(*) * AVG(is_male) * AVG(feedback)) /
//         (SQRT((SUM(POW(is_male, 2)) - COUNT(*) * POW(AVG(is_male), 2)) *
//         (SUM(POW(feedback, 2)) - COUNT(*) * POW(AVG(feedback), 2)))) AS Is_male,
//         (SUM(is_female * feedback) - COUNT(*) * AVG(is_female) * AVG(feedback)) /
//         (SQRT((SUM(POW(is_female, 2)) - COUNT(*) * POW(AVG(is_female), 2)) *
//         (SUM(POW(feedback, 2)) - COUNT(*) * POW(AVG(feedback), 2)))) AS Is_female
//     FROM
//         (SELECT
//             CASE WHEN gender = 'Male' THEN 1 ELSE 0 END AS is_male,
//             CASE WHEN gender = 'Female' THEN 1 ELSE 0 END AS is_female,
//             (age - (SELECT MIN(age) FROM feedback)) / (SELECT MAX(age) - MIN(age) FROM feedback) AS normalized_age,
//             feedback
//         FROM
//             feedback) AS normalized_feedback";

//     $result = mysqli_query($con, $query);

//     // Check if the query execution was successful
//     if (!$result) {
//         echo "Error in query execution: " . mysqli_error($con);
//         exit();
//     }

//     return $result;
// }


// Interpret the Correlation Results
// function interpretCorrelationResults($correlationValue) {
//     // Interpret the correlation value and return the interpretation
//     // You can add your logic here based on the magnitude and direction of the correlation
//     // For example:
//     if ($correlationValue > 0.5) {
//         return "Strong positive correlation";
//     } elseif ($correlationValue < -0.5) {
//         return "Strong negative correlation";
//     } else {
//         return "Weak or no correlation";
//     }
// }


 


function getbyID($table, $id) {

    global $con;
    $query = "SELECT * FROM $table WHERE id=?";
    $query_run = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($query_run, "i", $id);
    mysqli_stmt_execute($query_run);
    return mysqli_stmt_get_result($query_run);

}
// This function is to get the admin user by ID
function getAdminbyID($table, $id) {
    global $con;
    $query = "SELECT * FROM $table WHERE id=?";
    $query_run = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($query_run, "i", $id);
    mysqli_stmt_execute($query_run);
    return mysqli_stmt_get_result($query_run);
}

// This is to load all the data from the admins side
function getAllAdmin() {

    global $con;
    $userid = $_SESSION['auth_user']['id'];
    $query = "SELECT * FROM admin WHERE id='$userid'";
    $query_run = mysqli_prepare($con, $query);
    mysqli_stmt_execute($query_run);
    return mysqli_stmt_get_result($query_run);

}
function getAllOrders() {

    global $con;
    $query = "SELECT * FROM orders WHERE status='0' ORDER BY created_at DESC";
    $query_run = mysqli_prepare($con, $query);
    mysqli_stmt_execute($query_run);
    return mysqli_stmt_get_result($query_run);

}

function getAllordersbyID ($id) {

    global $con;
    $query = "SELECT * FROM orders WHERE status='0' AND id=?";
    $query_run = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($query_run, "i", $id);
    mysqli_stmt_execute($query_run);
    return mysqli_stmt_get_result($query_run);
}

function getOrderDetailsById($order_id) {
    global $con;
    $query = "SELECT * FROM orders WHERE id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'i', $order_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
}
function counttotalNewOrder() {

    global $con;
    $query = "SELECT COUNT(*) as num_new_orders FROM orders WHERE created_at > DATE_SUB(NOW(), INTERVAL 1 DAY) AND status = 0";
    $query_run = mysqli_query($con, $query);
    $result = mysqli_fetch_assoc($query_run);
    $total_count = $result['num_new_orders'];
    return $total_count;
}

// This function is for the system information

function systeminfo() {

    global $con;
    $query = "SELECT * FROM system_info";
    $query_run = mysqli_prepare($con, $query);
    mysqli_stmt_execute($query_run);
    return mysqli_stmt_get_result($query_run);

}

// for logo
function systemlogo() {

    global $con;
    $query = "SELECT business_logo FROM system_info WHERE id = 1";
    $query_run = mysqli_prepare($con, $query);
    mysqli_stmt_execute($query_run);
    return mysqli_stmt_get_result($query_run);

}

function countOrders() {
    // Add global $con variable
    global $con;
    $sql = "SELECT COUNT(*) as num_new_orders FROM orders WHERE created_at > DATE_SUB(NOW(), INTERVAL 1 DAY) AND status = 0";
    $result = mysqli_query($con, $sql);

    // Get the number of new orders from the query result
    $num_new_orders = 0;
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $num_new_orders = $row['num_new_orders'];
    }

    // Display badge count
    if ($num_new_orders > 0) {
        echo '<small><span class="badge badge-warning">' . $num_new_orders . '</span></small>';
    }
}
function countDeliveredOrders() {
    // Add global $con variable
    global $con;

    $sql = "SELECT COUNT(*) as num_delivered_orders FROM orders WHERE created_at > DATE_SUB(NOW(), INTERVAL 1 DAY) AND status = 1";
    $result = mysqli_query($con, $sql);

    // Get the number of delivered orders from the query result
    $num_delivered_orders = 0;
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $num_delivered_orders = $row['num_delivered_orders'];
    }

    // Display badge count
    if ($num_delivered_orders > 0) {
        echo '<small><span class="badge badge-success"><i class="fas fa-fw fa-check-circle"></i> ' . $num_delivered_orders . '</span></small>';
    }
}
function countCancelledOrders() {
    // Add global $con variable
    global $con;

    $sql = "SELECT COUNT(*) as num_cancelled_orders FROM orders WHERE created_at > DATE_SUB(NOW(), INTERVAL 1 DAY) AND status = 2";
    $result = mysqli_query($con, $sql);

    // Get the number of delivered orders from the query result
    $num_cancelled_orders = 0;
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $num_cancelled_orders = $row['num_cancelled_orders'];
    }

    // Display badge count
    if ($num_cancelled_orders > 0) {
        echo '<small><span class="badge badge-danger"><i class="fas fa-fw fa-check-circle"></i> ' . $num_cancelled_orders . '</span></small>';
    }
}



function getRemarks() {

    global $con;
    $query = "SELECT *
    FROM orders
    INNER JOIN order_remarks ON orders.id = order_remarks.order_id WHERE orders.id = orders.order_id";
    $query_run = mysqli_prepare($con, $query);
    mysqli_stmt_execute($query_run);
    return mysqli_stmt_get_result($query_run);

}

// This is for the remarks

function getRemarksByOrderId($order_id) {
    global $con;
    $query = "SELECT * FROM order_remarks WHERE order_id = ?";
    $query_run = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($query_run, 'i', $order_id);
    mysqli_stmt_execute($query_run);
    return mysqli_stmt_get_result($query_run);
}

function getRemarksbyID($id) {
    global $con;
    $query = "SELECT *
              FROM order_remarks
              WHERE order_id = ?";
    $query_run = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($query_run, "i", $id);
    mysqli_stmt_execute($query_run);
    $result = mysqli_stmt_get_result($query_run);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $rows;
}

// To get all the information from the table
function getCustomerinfo() {

    global $con;
    $query = "SELECT o.tracking_no, CONCAT(u.name, ' ', u.lname) AS full_name, TIMESTAMPDIFF(YEAR, u.birthdate, CURDATE()) AS age, CONCAT( u.street_address, ', ', u.barangay, ', ', u.city, ', ', u.province, ' ', u.zipcode, ' ', o.country ) AS complete_address, u.phone, u.email, o.payment_mode, o.status,
    DATE(o.created_at) AS order_date  FROM orders o JOIN users u ON o.user_id = u.user_id GROUP BY o.tracking_no ORDER BY o.status = 1 DESC;";
    $query_run = mysqli_prepare($con, $query);
    mysqli_stmt_execute($query_run);
    return mysqli_stmt_get_result($query_run);

}

function getOrderID($id) {

    global $con;
    $query = "SELECT orders.id, orders.tracking_no, orders.user_id, orders.name, orders.lname, orders.total_price, orders.payment_mode, order_items.prod_id, order_items.qty, order_items.price FROM orders JOIN order_items ON orders.id = order_items.order_id WHERE orders.id = ?";
    $query_run = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($query_run, "i", $id);
    mysqli_stmt_execute($query_run);
    return mysqli_stmt_get_result($query_run);
    
}
//This is the function to get all data that completed
function getOrdershistory() {

    global $con;
    $query = "SELECT * FROM orders WHERE status ='1' ORDER BY id DESC";
    $query_run = mysqli_prepare($con, $query);
    mysqli_stmt_execute($query_run);
    return mysqli_stmt_get_result($query_run);

}
//list of Cancelled Orders
function getCancelledOrders() {

    global $con;
    $query = "SELECT * FROM orders WHERE status ='2' ORDER BY id DESC";
    $query_run = mysqli_prepare($con, $query);
    mysqli_stmt_execute($query_run);
    return mysqli_stmt_get_result($query_run);

}

function checkTrackingNoValid($trackingNo) {

    global $con;
    $query = "SELECT * FROM orders WHERE tracking_no=?";
    $query_run = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($query_run, "s", $trackingNo);
    mysqli_stmt_execute($query_run);
    return mysqli_stmt_get_result($query_run);

}

    // This is for total_sales

    function getSalesReport($start_date = null, $end_date = null) {
        global $con;
    
        // Modify the SQL query to include the date range filter if provided
        $query = "SELECT oi.created_at AS transaction_date, c.name AS category_name, p.name AS product_name, oi.price + p.fee AS total_price, oi.qty, (oi.price + p.fee) * oi.qty AS total_amount, orr.status AS completed 
        FROM order_items oi 
        JOIN products p ON oi.prod_id = p.id 
        JOIN categories c ON p.category_id = c.id 
        JOIN orders orr ON oi.id = orr.id ";
    
        if ($start_date && $end_date) {
            // Date filter is specified, add it to the query
            $query .= "WHERE (orr.status = 1 OR orr.status IS NULL) 
                        AND oi.created_at BETWEEN '$start_date' AND '$end_date' ";
        } else {
            // Date filter is not specified, fetch all data
            $query .= "WHERE orr.status = 1 OR orr.status IS NULL ";
        }
    
        $query .= "ORDER BY oi.created_at DESC";
    
        $result = mysqli_query($con, $query);
        return $result;
    }
    

     // This is for total_sales

     function getInventoryReport() {
        global $con;
        $query = "SELECT products.id, products.name, categories.name as category, 
        products.qty as stock, products.selling_price as price, 
        COALESCE(SUM(order_items.qty), 0) as sold, 
        CASE 
          WHEN COALESCE(SUM(order_items.qty), 0) = products.qty THEN 0 
          ELSE products.qty - COALESCE(SUM(order_items.qty), 0) 
        END AS remaining_stock 
      FROM products 
      LEFT JOIN categories ON products.category_id = categories.id 
      LEFT JOIN order_items ON products.id = order_items.prod_id 
      GROUP BY products.id
      ";
        $result = mysqli_query($con, $query);
        return $result;
    }


// // Recommendation Data for female and male

// function display_recommendation($user_id) {
//     // 1. Connect to the database
//     global $con;

//     // 2. Get the user's gender from the database
//     $sql = "SELECT sex FROM users WHERE user_id = ?";
//     $stmt = mysqli_prepare($con, $sql);
//     mysqli_stmt_bind_param($stmt, "i", $user_id);
//     mysqli_stmt_execute($stmt);
//     $result = mysqli_stmt_get_result($stmt);
//     $row = mysqli_fetch_assoc($result);
//     $gender = $row['sex'];

//     // 3. Return the appropriate recommendation based on the user's gender
//     if ($gender == 'male') {
//         return [
//             'assets/images/female_1 (1).jpg',
//             'assets/images/female_1 (2).jpg',
//             'assets/images/female_1 (3).jpg',
//             'assets/images/female_1 (4).jpg'
//         ];
//     } else if ($gender == 'female') {
//         return [
//             'assets/images/male-1 (1).jpg',
//             'assets/images/male-1 (2).jpg',
//             'assets/images/male-1 (3).jpg',
//             'assets/images/male-1 (4).jpg',
//             'assets/images/male-1 (5).jpg',
//         ];
//     } else {
//          return [
//             'assets/images/Others (1).jpg',
//             'assets/images/Others (2).jpg',
//             'assets/images/Others (3).jpg',
//             'assets/images/Others (4).jpg'
//         ];
//     }
// }


// =======================

function redirect($url, $message) {

    $_SESSION['message'] = $message;
    header('Location: '.$url);
    exit(0);

}


// function getAll($table) {

//     global $con;
//     $query = "SELECT * FROM $table";
//     $query_run = mysqli_query($con, $query);
//     return($query_run);

//     }

// function getbyID($table, $id) {

//     global $con;
//     $query = "SELECT * FROM $table WHERE id='$id' ";
//     $query_run = mysqli_query($con, $query);
//     return($query_run);

//     }

// function getAllOrders() {

//     global $con;
//     $query = "SELECT * FROM orders WHERE status='0'";
//     $query_run = mysqli_query($con, $query);
//     return($query_run);

//     }

// function getOrdershistory() {

//     global $con;
//     $query = "SELECT * FROM orders WHERE status !='0'";
//     $query_run = mysqli_query($con, $query);
//     return($query_run);

//     }

// function checkTrackingNoValid($trackingNo) {

//     global $con;
//     $query = "SELECT * FROM orders WHERE tracking_no='$trackingNo'";
//     $query_run = mysqli_query($con, $query);
//     return($query_run);

//         }


// function redirect($url, $message) {

//     $_SESSION['message'] = $message;
//     header('Location: '.$url);
//     exit(0);
// }

?>