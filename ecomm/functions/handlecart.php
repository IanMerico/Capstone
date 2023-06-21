<?php
session_start();
include('../config/dbcon.php');

    if(isset($_SESSION['auth'])) {

        if(isset($_POST['scope'])) {

            $scope = $_POST['scope'];
            switch($scope) {

                case "add":

                    $product_id = $_POST['product_id'];
                    $prod_qty = $_POST['prod_qty'];
                    $user_id = $_SESSION['auth_user']['user_id'];
    
                    $chk_existing_Cart = "SELECT * FROM carts WHERE product_id=? AND user_id=?";
                    $stmt = mysqli_prepare($con, $chk_existing_Cart);
                    mysqli_stmt_bind_param($stmt, "ii", $product_id, $user_id);
                    mysqli_stmt_execute($stmt);
                    $chk_existing_Cart_run = mysqli_stmt_get_result($stmt);
    
                    if (mysqli_num_rows($chk_existing_Cart_run) > 0) {
                        echo "Existing";
                    } else {
                        $insert_query = "INSERT INTO carts (user_id, product_id, prod_qty, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())";
                        $stmt = mysqli_prepare($con, $insert_query);
                        mysqli_stmt_bind_param($stmt, "iii", $user_id, $product_id, $prod_qty);
                        $insert_query_run = mysqli_stmt_execute($stmt);
    
                        if ($insert_query_run) {
                            echo 201;
                        } else {
                            echo 500;
                        }
                    }
                    break;

                    case "addwishlist":

                        $product_id = $_POST['product_id'];
                        $prod_qty = $_POST['prod_qty'];
                        $user_id = $_SESSION['auth_user']['user_id'];

                        $chk_existing_Cart = "SELECT * FROM wishlist WHERE product_id=? AND user_id=?";
                        $stmt = mysqli_prepare($con, $chk_existing_Cart);
                        mysqli_stmt_bind_param($stmt, "ii", $product_id, $user_id);
                        mysqli_stmt_execute($stmt);
                        $chk_existing_Cart_run = mysqli_stmt_get_result($stmt);

                        if (mysqli_num_rows($chk_existing_Cart_run) > 0) {
                            echo "Existing";
                        } else {
                            $insert_query = "INSERT INTO wishlist (user_id, product_id, prod_qty, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())";
                            $stmt = mysqli_prepare($con, $insert_query);
                            mysqli_stmt_bind_param($stmt, "iii", $user_id, $product_id, $prod_qty);
                            $insert_query_run = mysqli_stmt_execute($stmt);

                            if ($insert_query_run) {
                                echo 201;
                            } else {
                                echo 500;
                            }
                        }
                    break;

                case "update":
                        $product_id = $_POST['product_id'];
                        $prod_qty = $_POST['prod_qty'];
                        $user_id = $_SESSION['auth_user']['user_id'];

                        $chk_existing_Cart = "SELECT * FROM carts WHERE product_id=? AND user_id=?";
                        $stmt = mysqli_prepare($con, $chk_existing_Cart);
                        mysqli_stmt_bind_param($stmt, "ii", $product_id, $user_id);
                        mysqli_stmt_execute($stmt);
                        $chk_existing_Cart_run = mysqli_stmt_get_result($stmt);

                        if (mysqli_num_rows($chk_existing_Cart_run) > 0) {
                            $update_query = "UPDATE carts SET prod_qty=? WHERE product_id=? AND user_id=?";
                            $stmt = mysqli_prepare($con, $update_query);
                            mysqli_stmt_bind_param($stmt, "iii", $prod_qty, $product_id, $user_id);
                            $update_query_run = mysqli_stmt_execute($stmt);

                            if ($update_query_run) {
                                echo 200;
                            } else {
                                echo 500;
                            }
                        } else {
                            echo "Something went wrong!";
                        }
                    break;

                case "delete":
                        $cart_id = $_POST['cart_id'];
                        $user_id = $_SESSION['auth_user']['user_id'];

                        $chk_existing_Cart = "SELECT * FROM carts WHERE id=? AND user_id=?";
                        $stmt = mysqli_prepare($con, $chk_existing_Cart);
                        mysqli_stmt_bind_param($stmt, "ii", $cart_id, $user_id);
                        mysqli_stmt_execute($stmt);
                        $chk_existing_Cart_run = mysqli_stmt_get_result($stmt);

                        if(mysqli_num_rows($chk_existing_Cart_run) > 0) {
                            $delete_query = "DELETE FROM carts WHERE id=?";
                            $stmt = mysqli_prepare($con, $delete_query);
                            mysqli_stmt_bind_param($stmt, "i", $cart_id);
                            $delete_query_run = mysqli_stmt_execute($stmt);

                            if($delete_query_run) {
                                echo 200;
                            } else {
                                echo "Something went wrong!";
                            }
                        } else {     
                            echo "Something went wrong!";
                        }
                    break;
                    // Delete Item from Wishlist
                    case "deleteWishlist":
                            $cart_id = $_POST['cart_id'];
                            $user_id = $_SESSION['auth_user']['user_id'];

                            $chk_existing_Cart = "SELECT * FROM wishlist WHERE id=? AND user_id=?";
                            $chk_existing_Cart_stmt = mysqli_prepare($con, $chk_existing_Cart);
                            mysqli_stmt_bind_param($chk_existing_Cart_stmt, "ii", $cart_id, $user_id);
                            mysqli_stmt_execute($chk_existing_Cart_stmt);
                            $chk_existing_Cart_run = mysqli_stmt_get_result($chk_existing_Cart_stmt);

                            if(mysqli_num_rows($chk_existing_Cart_run) > 0) {

                                $delete_query = "DELETE FROM wishlist WHERE id=?";
                                $delete_query_stmt = mysqli_prepare($con, $delete_query);
                                mysqli_stmt_bind_param($delete_query_stmt, "i", $cart_id);
                                $delete_query_run = mysqli_stmt_execute($delete_query_stmt);

                                if($delete_query_run) {
                                    echo 200;
                                } else {
                                    echo "Something went wrong!";
                                }
                            }
                            else {     
                                echo "Something went wrong!";
                            }
                            break;
                            default:
                                echo 500;
                            }
                            }
                            } else {
                                echo 401;
                            }
?>