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

                        $chk_existing_Cart = "SELECT * FROM carts WHERE product_id='$product_id' AND user_id='$user_id'";
                        $chk_existing_Cart_run = mysqli_query($con, $chk_existing_Cart);

                        if(mysqli_num_rows($chk_existing_Cart_run) > 0) {

                            echo "Existing";
                        }
                        else {     

                            $insert_query = "INSERT INTO carts (user_id, product_id, prod_qty, created_at, updated_at) VALUES ('$user_id', '$product_id', '$prod_qty', NOW(), NOW())";

                            $insert_query_run = mysqli_query($con, $insert_query);

                            if($insert_query_run) {
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

                        $chk_existing_Cart = "SELECT * FROM carts WHERE product_id='$product_id' AND user_id='$user_id'";
                        $chk_existing_Cart_run = mysqli_query($con, $chk_existing_Cart);

                        if(mysqli_num_rows($chk_existing_Cart_run) > 0) {

                            $update_query = "UPDATE carts SET prod_qty='$prod_qty' WHERE product_id='$product_id' AND user_id='$user_id' ";
                            $update_query_run = mysqli_query($con, $update_query);
                            
                            if($update_query_run) {
                                echo 200;
                            } else {
                                echo 500;
                            }
                        }
                        else {     

                            echo "Something went wrong!";
                        }
                    break;

                case "delete":
                        $cart_id = $_POST['cart_id'];
                        $user_id = $_SESSION['auth_user']['user_id'];

                        $chk_existing_Cart = "SELECT * FROM carts WHERE id='$cart_id' AND user_id='$user_id'";
                        $chk_existing_Cart_run = mysqli_query($con, $chk_existing_Cart);

                        if(mysqli_num_rows($chk_existing_Cart_run) > 0) {

                            $delete_query = "DELETE FROM carts WHERE id='$cart_id'";
                            $delete_query_run = mysqli_query($con, $delete_query);
                            
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