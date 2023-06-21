<?php
    // Connect to the database
    // $conn = mysqli_connect("localhost", "username", "password", "database");
    session_start();
    include('config/dbcon.php');

    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
    echo "You need to be logged in to like or dislike a product.";
    exit;
    }

    // Get the user ID and product ID from the request
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['id'];

    // Check if the user has already liked or disliked the product
    $query = "SELECT * FROM product_likes WHERE user_id = $user_id AND product_id = $product_id";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
    // Update the existing record
    $row = mysqli_fetch_assoc($result);
    $liked = $row['liked'];
    $disliked = $row['disliked'];
    if (isset($_POST['like']) && !$liked) {
        $liked = 1;
        $disliked = 0;
    } elseif (isset($_POST['dislike']) && !$disliked) {
        $liked = 0;
        $disliked = 1;
    }
    $query = "UPDATE product_likes SET liked = $liked, disliked = $disliked WHERE user_id = $user_id AND product_id = $product_id";
    mysqli_query($conn, $query);
    } else {
    // Insert a new record
    $liked = 0;
    $disliked = 0;
    if (isset($_POST['like'])) {
        $liked = 1;
    } elseif (isset($_POST['dislike'])) {
        $disliked = 1;
    }
    $query = "INSERT INTO product_likes (user_id, product_id, liked, disliked) VALUES ($user_id, $product_id, $liked, $disliked)";
    mysqli_query($conn, $query);
    }

    // Get the total number of likes and dislikes for the product
    $query = "SELECT SUM(liked) AS likes, SUM(disliked) AS dislikes FROM product_likes WHERE product_id = $product_id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $likes = $row['likes'];
    $dislikes = $row['dislikes'];

    // Return the result as JSON
    echo json_encode(array('likes' => $likes, 'dislikes' => $dislikes));
?>