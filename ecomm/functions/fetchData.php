<?php
// Retrieve the search query
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query the database with the search query
$allproducts = searchProducts($search);

// Define a function to search for products in the database
function searchProducts($search) {
    // Set up the database connection
    $conn = mysqli_connect('localhost', 'root', '', 'ecommerce_db');

    // Prepare the statement with placeholders for the search terms
    $stmt = mysqli_prepare($conn, "SELECT * FROM products WHERE name LIKE ? OR description LIKE ? OR small_description LIKE ? OR selling_price LIKE ?");

    // Bind the search terms to the prepared statement
    $searchTerm = "%$search%";
    mysqli_stmt_bind_param($stmt, 'ssss', $searchTerm, $searchTerm, $searchTerm, $searchTerm);

    // Execute the prepared statement
    mysqli_stmt_execute($stmt);

    // Get the result set
    $result = mysqli_stmt_get_result($stmt);

    // Convert the result set to an array of products
    $products = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }

    // Close the database connection and statement
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return $products;
}


// Recommendation Data for female and male

function display_recommendation($user_id) {
    // 1. Connect to the database
    global $con;

    // 2. Get the user's gender from the database
    $sql = "SELECT sex FROM users WHERE user_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if ($row != null && isset($row['sex'])) {
        $gender = $row['sex'];
    } else {
        $gender = null;
    }

    // 3. Return the appropriate recommendation based on the user's gender
    if ($gender == 'Male') {
        return [
            'assets/images/male-1 (1).jpg',
            'assets/images/male-1 (2).jpg',
            'assets/images/male-1 (3).jpg',
            'assets/images/male-1 (4).jpg',
            'assets/images/male-1 (5).jpg'
        ];
    } else if ($gender == 'Female') {
        return [
            'assets/images/female_1 (1).jpg',
            'assets/images/female_1 (2).jpg',
            'assets/images/female_1 (3).jpg',
            'assets/images/female_1 (4).jpg'
        ];
    } else {
         return [
            'assets/images/Others (1).jpg',
            'assets/images/Others (2).jpg',
            'assets/images/Others (3).jpg',
            'assets/images/Others (4).jpg'
        ];
    }
}

?>
