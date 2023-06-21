<?php
session_start();
include('config/dbcon.php');

// function getUserinfo() {

//     global $con;
//     $userid = $_SESSION['auth_user']['user_id'];
//     $query = "SELECT * FROM users WHERE user_id ='$userid' LIMIT 1";
//     $query_run = mysqli_query($con, $query);
//     return($query_run);

//     }

function getUserinfo() {

    global $con;
    $userid = $_SESSION['auth_user']['user_id'];
    $query = "SELECT * FROM users WHERE user_id = ? LIMIT 1";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $userid);
    mysqli_stmt_execute($stmt);
    $query_run = mysqli_stmt_get_result($stmt);
    return($query_run);

}

// for logo
function systemlogo() {

    global $con;
    $query = "SELECT business_logo FROM system_info WHERE id = 1";
    $query_run = mysqli_prepare($con, $query);
    mysqli_stmt_execute($query_run);
    return mysqli_stmt_get_result($query_run);

}

// =================================

// function getAllactive($table) {

//     global $con;
//     $query = "SELECT * FROM $table WHERE status='0'";
//     $query_run = mysqli_query($con, $query);
//     return($query_run);

//     }

function getAllactive($table) {

    global $con;
    $query = "SELECT * FROM $table WHERE status='0'";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_execute($stmt);
    $query_run = mysqli_stmt_get_result($stmt);
    return($query_run);

}

// Data for cover slider in system_info
function getcoverpage($system_info) {

    global $con;
    $query = "SELECT cover FROM $system_info";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_execute($stmt);
    $query_run = mysqli_stmt_get_result($stmt);
    return($query_run);

}


// =================================
// function getAllTrending() {

//     global $con;
//     $query = "SELECT * FROM products WHERE trending='1'";
//     $query_run = mysqli_query($con, $query);
//     return($query_run);

//     }

function getAllTrending() {

    global $con;
    $query = "SELECT * FROM products WHERE trending='1'";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_execute($stmt);
    $query_run = mysqli_stmt_get_result($stmt);
    return($query_run);

}

// =================================
// function getSlugactive($table, $slug) {

//     global $con;
//     $query = "SELECT * FROM $table WHERE slug='$slug' AND status='0' LIMIT 1";
//     $query_run = mysqli_query($con, $query);
//     return($query_run);

//     }

function getSlugactive($table, $slug) {

    global $con;
    $query = "SELECT * FROM $table WHERE slug=? AND status='0' LIMIT 1";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "s", $slug);
    mysqli_stmt_execute($stmt);
    $query_run = mysqli_stmt_get_result($stmt);
    return($query_run);

}

// =================================
// function getProdbyCategory($category_id){
//     global $con;
//     $query = "SELECT * FROM products WHERE category_id='$category_id' AND status='0'";
//     $query_run = mysqli_query($con, $query);
//     return($query_run);
// }

function getProdbyCategory($category_id){
    global $con;
    $query = "SELECT * FROM products WHERE category_id=? AND status='0'";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $category_id);
    mysqli_stmt_execute($stmt);
    $query_run = mysqli_stmt_get_result($stmt);
    return($query_run);
}


// =================================

// function getIDactive($table, $id) {

//     global $con;
//     $query = "SELECT * FROM $table WHERE id='$id' AND status='0' ";
//     $query_run = mysqli_query($con, $query);
//     return($query_run);

//     }

function getIDactive($table, $id) {

    global $con;
    $query = "SELECT * FROM $table WHERE id=? AND status='0' ";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $query_run = mysqli_stmt_get_result($stmt);
    return($query_run);

}

// =================================

// function getCartItems() {

//     global $con;
//     $userid = $_SESSION['auth_user']['user_id'];
//     $query = "SELECT c.id as cid, c.product_id, c.prod_qty, p.id as pid, p.name, p.image, p.selling_price FROM carts c, products p WHERE c.product_id=p.id AND c.user_id='$userid' ORDER BY c.id DESC";
//     $query_run = mysqli_query($con, $query);
//     return($query_run);

//     }

function getCartItems() {

    global $con;
    $userid = $_SESSION['auth_user']['user_id'];
    // $query = "SELECT c.id as cid, c.product_id, c.prod_qty, p.id as pid, p.name, p.image, p.selling_price FROM carts c, products p WHERE c.product_id=p.id AND c.user_id=? ORDER BY c.id DESC";
    $query = "SELECT c.id as cid, c.product_id, c.prod_qty, p.id as pid, p.name, p.image, p.selling_price, p.qty, p.fee FROM carts c, products p WHERE c.product_id=p.id AND c.user_id=? ORDER BY c.id DESC";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $userid);
    mysqli_stmt_execute($stmt);
    $query_run = mysqli_stmt_get_result($stmt);
    return($query_run);

}

// =================================

// function getCartCount($id) {

//     global $con; 
//     $userid = $_SESSION['auth_user']['user_id'];
//     $cartcount = "SELECT count(id) AS cart_count FROM carts WHERE user_id='$userid'";
//     $queryCount = mysqli_query($con, $cartcount);
//     // $resultcount = mysqli_fetch_assoc($queryCount);
//     return($queryCount);
// }

function getCartCount($id) {

    global $con; 
    $userid = $_SESSION['auth_user']['user_id'];
    $cartcount = "SELECT count(id) AS cart_count FROM carts WHERE user_id=?";
    $stmt = mysqli_prepare($con, $cartcount);
    mysqli_stmt_bind_param($stmt, "i", $userid);
    mysqli_stmt_execute($stmt);
    $queryCount = mysqli_stmt_get_result($stmt);
    return($queryCount);
}

// =================================
// function getwishlistCount($id) {

//     global $con; 
//     $userid = $_SESSION['auth_user']['user_id'];
//     $cartcount = "SELECT count(id) AS wishlist_count FROM wishlist WHERE user_id='$userid'";
//     $queryCount = mysqli_query($con, $cartcount);
//     // $resultcount = mysqli_fetch_assoc($queryCount);
//     return($queryCount);
// }

function getwishlistCount($id) {
    global $con; 
    $userid = $_SESSION['auth_user']['user_id'];
    $cartcount = "SELECT count(id) AS wishlist_count FROM wishlist WHERE user_id=?";
    $stmt = mysqli_prepare($con, $cartcount);
    mysqli_stmt_bind_param($stmt, "s", $userid);
    mysqli_stmt_execute($stmt);
    $queryCount = mysqli_stmt_get_result($stmt);
    return($queryCount);
}

// =================================

// function getwishlistItems() {

//         global $con;
//         $userid = $_SESSION['auth_user']['user_id'];
//         $query = "SELECT c.id as cid, c.product_id, c.prod_qty, p.id as pid, p.name, p.image, p.selling_price ,p.qty FROM wishlist c, products p WHERE c.product_id=p.id AND c.user_id='$userid' ORDER BY c.id DESC";
//         $query_run = mysqli_query($con, $query);
//         return($query_run);
    
//     }

function getwishlistItems() {
    global $con;
    $userid = $_SESSION['auth_user']['user_id'];
    $query = "SELECT c.id as cid, c.product_id, c.prod_qty, p.id as pid, p.name, p.image, p.selling_price ,p.qty FROM wishlist c, products p WHERE c.product_id=p.id AND c.user_id=? ORDER BY c.id DESC";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "s", $userid);
    mysqli_stmt_execute($stmt);
    $query_run = mysqli_stmt_get_result($stmt);
    return($query_run);
}
 // =================================

 function getTotalSales() {
    global $con;
    $userid = $_SESSION['auth_user']['user_id'];
    $query = "SELECT SUM(total_amount) as total_price FROM orders WHERE user_id=? ORDER BY id DESC";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "s", $userid);
    mysqli_stmt_execute($stmt);
    $query_run = mysqli_stmt_get_result($stmt);
    $result = mysqli_fetch_assoc($query_run);
    return $result['total_price'];
}


 // =================================

// function getOrders() {

//     global $con;
//     $userid = $_SESSION['auth_user']['user_id'];
//     $query = "SELECT * FROM orders WHERE user_id='$userid' ORDER BY id DESC ";
//     $query_run = mysqli_query($con, $query);
//     return($query_run);

//     }

// This is the part where the user can fetch all the data from reviews

function fetchReview($productId) {
    global $con;
    $userid = $_SESSION['auth_user']['user_id'];
    $query = "SELECT users.user_id AS user_id, users.name AS name, reviews.id AS review_id, reviews.review, reviews.created_at, reviews.updated_at FROM users JOIN reviews ON users.user_id = reviews.user_id WHERE reviews.product_id = $productId;";
    
    $result = mysqli_query($con, $query);
    return $result;
}
function fetchReplies($reviewId) {
    global $con;
    $userid = $_SESSION['auth_user']['user_id'];
    $query = "SELECT replies.product_id, replies.user_id, users.name, replies.reviews_id, replies.reply, replies.created_at 
              FROM replies
              JOIN reviews ON replies.reviews_id = reviews.id
              JOIN users ON replies.user_id = users.user_id
              WHERE replies.reviews_id = $reviewId";
    
    $result = mysqli_query($con, $query);
    return $result;
}

function fetchAllReviews($productId) {
    global $con;
    $query = "SELECT users.user_id AS user_id, users.name AS name, reviews.id AS review_id, reviews.review, reviews.created_at, reviews.updated_at FROM users JOIN reviews ON users.user_id = reviews.user_id WHERE reviews.product_id = $productId;";
    $result = mysqli_query($con, $query);
    return $result;
}
function fetchAllReplies($reviewId) {
    global $con;
    $query = "SELECT replies.product_id, replies.user_id, users.name, replies.reviews_id, replies.reply, replies.created_at 
    FROM replies
    JOIN reviews ON replies.reviews_id = reviews.id
    JOIN users ON replies.user_id = users.user_id
    WHERE replies.reviews_id = $reviewId";
    $result = mysqli_query($con, $query);
    return $result;
}




// ===============================================================



function getOrders() {
    global $con;
    $userid = $_SESSION['auth_user']['user_id'];
    $query = "SELECT * FROM orders WHERE user_id=? ORDER BY id DESC ";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "s", $userid);
    mysqli_stmt_execute($stmt);
    $query_run = mysqli_stmt_get_result($stmt);
    return($query_run);
}

    // =================================

// function checkTrackingNoValid($trackingNo) {

//     global $con;
//     $userid = $_SESSION['auth_user']['user_id'];
//     $query = "SELECT * FROM orders WHERE tracking_no='$trackingNo' AND user_id='$userid'";
//     $query_run = mysqli_query($con, $query);
//     return($query_run);

//         }

function checkTrackingNoValid($trackingNo) {
    global $con;
    $userid = $_SESSION['auth_user']['user_id'];
    $query = "SELECT * FROM orders WHERE tracking_no=? AND user_id=?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "ss", $trackingNo, $userid);
    mysqli_stmt_execute($stmt);
    $query_run = mysqli_stmt_get_result($stmt);
    return($query_run);
}

// =================================

// function redirect($url, $message) {

//     $_SESSION['message'] = $message;
//     header('Location: '.$url);
//     exit(0);
// }

function redirect($url, $message) {
    $_SESSION['message'] = $message;
    header('Location: '.$url);
    exit(0);
}
?>



