<?php
session_start();
include('config/dbcon.php');

function getAllactive($table) {

    global $con;
    $query = "SELECT * FROM $table WHERE status='0'";
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

function redirect($url, $message) {

    $_SESSION['message'] = $message;
    header('Location: '.$url);
    exit(0);
}
?>