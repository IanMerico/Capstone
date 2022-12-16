<?php
session_start();
include('config/dbcon.php');

function getAllactive($table) {

    global $con;
    $query = "SELECT * FROM $table WHERE status='0'";
    $query_run = mysqli_query($con, $query);
    return($query_run);

    }
function getAllTrending() {

    global $con;
    $query = "SELECT * FROM products WHERE trending='1'";
    $query_run = mysqli_query($con, $query);
    return($query_run);

    }
function getSlugactive($table, $slug) {

    global $con;
    $query = "SELECT * FROM $table WHERE slug='$slug' AND status='0' LIMIT 1";
    $query_run = mysqli_query($con, $query);
    return($query_run);

    }
function getProdbyCategory($category_id){
    global $con;
    $query = "SELECT * FROM products WHERE category_id='$category_id' AND status='0'";
    $query_run = mysqli_query($con, $query);
    return($query_run);
}

function getIDactive($table, $id) {

    global $con;
    $query = "SELECT * FROM $table WHERE id='$id' AND status='0' ";
    $query_run = mysqli_query($con, $query);
    return($query_run);

    }

function getCartItems() {

    global $con;
    $userid = $_SESSION['auth_user']['user_id'];
    $query = "SELECT c.id as cid, c.product_id, c.prod_qty, p.id as pid, p.name, p.image, p.selling_price FROM carts c, products p WHERE c.product_id=p.id AND c.user_id='$userid' ORDER BY c.id DESC";
    $query_run = mysqli_query($con, $query);
    return($query_run);

    }

function getOrders() {

    global $con;
    $userid = $_SESSION['auth_user']['user_id'];
    $query = "SELECT * FROM orders WHERE user_id='$userid' ORDER BY id DESC";
    $query_run = mysqli_query($con, $query);
    return($query_run);

    }

function checkTrackingNoValid($trackingNo) {

    global $con;
    $userid = $_SESSION['auth_user']['user_id'];
    $query = "SELECT * FROM orders WHERE tracking_no='$trackingNo' AND user_id='$userid'";
    $query_run = mysqli_query($con, $query);
    return($query_run);

        }

function redirect($url, $message) {

    $_SESSION['message'] = $message;
    header('Location: '.$url);
    exit(0);
}
?>