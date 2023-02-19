<?php

    session_start();
    // require('userfunctions.php');
    include('../config/dbcon.php');
    
    if(isset($_SESSION['auth'])) {

        if(isset($_POST['placeOrderBtn'])) {

            $name = mysqli_real_escape_string($con, $_POST['name']);
            $email = mysqli_real_escape_string($con, $_POST['email']);
            $phone = mysqli_real_escape_string($con, $_POST['phone']);
            $pincode = mysqli_real_escape_string($con, $_POST['pincode']);
            $address = mysqli_real_escape_string($con, $_POST['address']);
            $payment_mode = mysqli_real_escape_string($con, $_POST['payment_mode']);
            $payment_id = mysqli_real_escape_string($con, $_POST['payment_id']);

            if($name=="" || $email=="" || $phone=="" || $pincode=="" || $address=="") {

                $_SESSION['message'] = "Some field  are empty";
                header('Location: ../checkout.php');
                exit(0);
            }

            $userid = $_SESSION['auth_user']['user_id'];
            $query = "SELECT c.id as cid, c.product_id, c.prod_qty, p.id as pid, p.name, p.image, p.selling_price FROM carts c, products p WHERE c.product_id=p.id AND c.user_id='$userid' ORDER BY c.id DESC";

            $query_run = mysqli_query($con, $query);

            $totalPrice = 0;
            foreach ($query_run as $CartItem) {
     
            $totalPrice += $CartItem['selling_price'] *   $CartItem['prod_qty'];  

            }
            // echo $totalPrice;

            $tracking_no = "RDW".rand(1111,9999).substr($phone,2);
            // $user_id = $_SESSION['auth_user']['user_id'];
            $insert_query = "INSERT INTO orders (tracking_no, user_id, name, email, phone, address, pincode, total_price, payment_mode, payment_id, created_at) VALUES ('$tracking_no', '$userid', '$name', '$email', '$phone', '$address', '$pincode', '$totalPrice', '$payment_mode', '$payment_id', NOW() )";


            $insert_query_run = mysqli_query($con, $insert_query);

            if($insert_query_run) {

                $order_id = mysqli_insert_id($con);
                foreach ($query_run as $CartItem) {

                    $prod_id = $CartItem['product_id'];
                    $prod_qty = $CartItem['prod_qty'];
                    $price = $CartItem['selling_price'];

                    $insert_items_query = "INSERT INTO order_items (order_id, prod_id, qty, price, created_at) VALUES ('$order_id', '$prod_id', '$prod_qty', '$price', NOW())";
                    $insert_items_query_run = mysqli_query($con, $insert_items_query);


                    $product_query = "SELECT * FROM products WHERE id='$prod_id' LIMIT 1";
                    $product_query_run = mysqli_query($con, $product_query);

                    $productData = mysqli_fetch_array($product_query_run);
                    $current_qty = $productData['qty'];

                    $new_qty = $current_qty - $prod_qty;

                    $updateQty_query = "UPDATE products SET qty='$new_qty' WHERE id='$prod_id' ";
                    $updateQty_query_run = mysqli_query($con, $updateQty_query);
                }

                $deleteCartQuery = "DELETE FROM carts WHERE user_id='$userid'";
                $deleteCartQuery_run = mysqli_query($con, $deleteCartQuery);


                $_SESSION['message'] = "Order placed successfully";
                header('Location: ../my_orders.php');
                die();

            }

        }
    }
    else {
        header('Location: ../index.php');
    }

?>