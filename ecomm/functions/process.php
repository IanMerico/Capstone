<?php
session_start();
include('../config/dbcon.php');

if (isset($_POST['action']) && $_POST['action'] == 'create_message') {
    getReview($_POST);
} elseif (isset($_POST['action']) && $_POST['action'] == 'create_reply') {
    getReply($_POST);
} else {
    // Redirect back to the previous page
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

function getReview($post)
{
    global $con;
    $userid = $_SESSION['auth_user']['user_id'];
    $product_id = $post['product_id'];
    $message = $post['message'];
    $query = "INSERT INTO reviews (product_id, user_id, review, created_at, updated_at) 
              VALUES ('$product_id', '$userid', '$message', NOW(), NOW())";
    $query_run = mysqli_query($con, $query);
    if ($query_run) {
        $reviewId = mysqli_insert_id($con); // Get the ID of the inserted review
        echo "Review created successfully!";
        // Redirect back to the previous page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        echo "Error creating review: " . mysqli_error($con);
    }
}

function getReply($post)
{
    global $con;
    $userid = $_SESSION['auth_user']['user_id'];
    $product_id = $post['product_id'];
    $review_id = $post['review_id'];
    $reply = $post['reply'];
    $query = "INSERT INTO replies (product_id, user_id, reviews_id, reply, created_at, updated_at) 
              VALUES ('$product_id', '$userid', '$review_id', '$reply', NOW(), NOW())";
    $query_run = mysqli_query($con, $query);
    if ($query_run) {
        echo "Reply created successfully!";
    } else {
        echo "Error creating reply: " . mysqli_error($con);
    }

    // Redirect back to the previous page
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
?>
