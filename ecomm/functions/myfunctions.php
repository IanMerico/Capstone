<?php
session_start();
include('../config/dbcon.php');

function getAll($table) {

    global $con;
    $query = "SELECT * FROM $table";
    $query_run = mysqli_query($con, $query);
    return($query_run);

    }

function getbyID($table, $id) {

    global $con;
    $query = "SELECT * FROM $table WHERE id='$id' ";
    $query_run = mysqli_query($con, $query);
    return($query_run);

    }

function getAllOrders() {

    global $con;
    $query = "SELECT * FROM orders WHERE status='0'";
    $query_run = mysqli_query($con, $query);
    return($query_run);

    }

function getOrdershistory() {

    global $con;
    $query = "SELECT * FROM orders WHERE status !='0'";
    $query_run = mysqli_query($con, $query);
    return($query_run);

    }

function checkTrackingNoValid($trackingNo) {

    global $con;
    $query = "SELECT * FROM orders WHERE tracking_no='$trackingNo'";
    $query_run = mysqli_query($con, $query);
    return($query_run);

        }

function redirect($url, $message) {

    $_SESSION['message'] = $message;
    header('Location: '.$url);
    exit(0);
}

?>