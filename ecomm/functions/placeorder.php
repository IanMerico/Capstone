<?php
session_start();
// require('userfunctions.php');

include('../config/dbcon.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';

function emailreceived($name, $email, $phone, $payment_mode, $tracking_no, $street_address, $barangay, $zipcode, $country, $city, $province, $totalPrice) {

    // Configure PHPMailer
    $mail = new PHPMailer(true);
    // try {
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'tte29637@gmail.com';
    $mail->Password = 'h q z s e e v r v e g r w a i e';
    $mail->SMTPSecure = "tls";
    $mail->Port = 587;

  // Set email content
$mail->setFrom('tte29637@gmail.com', 'Apobangpo Merch');
$mail->addAddress($email);
// Content
$mail->isHTML(true);   // Set email format to HTML
$mail->Subject = 'Your Order from Apobangpo Merch is Confirmed';
$mail->Body    = '
    <h1>Dear '.$name.'</h1>
    <p>Thank you for placing an order with Apobangpo Merch. Your order has been confirmed and is being processed. Your order number is '.$tracking_no.'. We will keep you updated with the progress of your order.</p>
    <h4>Order Details</h4>
    <p><strong>Customer name:</strong> '.$name.'</p>
    <p><strong>Email:</strong> '.$email.'</p>
    <p><strong>Phone:</strong> '.$phone.'</p>
    <p><strong>Payment Method:</strong> '.$payment_mode.'</p>
    <h4>Delivery Address</h4>
    <p><strong>Street Address:</strong> '.$street_address.'</p>
    <p><strong>Barangay:</strong> '.$barangay.'</p>
    <p><strong>Zipcode:</strong> '.$zipcode.'</p>
    <p><strong>City:</strong> '.$city.'</p>
    <p><strong>Province:</strong> '.$province.'</p>
    <p><strong>Country:</strong> '.$country.'</p>
    <h4>Order Items</h4>
    <table>
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Selling Price</th>
        </tr>';

include('../config/dbcon.php');
$userid = $_SESSION['auth_user']['user_id'];
$query = "SELECT c.id as cid, c.product_id, c.prod_qty, p.id as pid, p.name, p.image, p.selling_price, p.fee FROM carts c, products p WHERE c.product_id=p.id AND c.user_id=? ORDER BY c.id DESC";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "i", $userid);
mysqli_stmt_execute($stmt);
$query_run = mysqli_stmt_get_result($stmt);

$totalPrice = 0;
foreach ($query_run as $CartItem) {
    $product_name = $CartItem['name'];
    $product_qty = $CartItem['prod_qty'];
    $selling_price = $CartItem['selling_price'];
    $fee = $CartItem['fee'];
    $totalPrice += $CartItem['selling_price'] * $CartItem['prod_qty'] + $CartItem['fee'];

    $mail->Body .= '
        <tr>
            <td>'.$product_name.'</td>
            <td>'.$product_qty.'</td>
            <td>'.$selling_price.'</td>
        </tr>';
}

$mail->Body .= '
    </table>
    <h4>Additional Shipping fee: '.$fee.'</h4>
    <h4>Total Price: '.$totalPrice.'</h4>
    <p>We appreciate your business and look forward to serving you again soon.</p>
    <br><br>Best Regards,<br>Apobangpo Merch';

       // Send email
if ($mail->send()) {
    // Email sent successfully
    return true;
} else {
    // Error in sending email
    return false;
}

    }

    function adminreceived($id, $name, $email, $phone, $payment_mode, $tracking_no) {
    // Get the current date and time
    $date_time = date('Y-m-d H:i:s');

        
    // Configure PHPMailer
    $mail = new PHPMailer(true);

        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'tte29637@gmail.com';
        $mail->Password = 'h q z s e e v r v e g r w a i e';
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;

        // Set email content
        $mail->setFrom('tte29637@gmail.com', 'Apobangpo Merch');
        $mail->addAddress('tte29637@gmail.com');
        // Content
        $mail->isHTML(true);   // Set email format to HTML
        $mail->Subject = 'New Order has been placed';
        $mail->Body    = '
        
        <h1>Dear Admin</h1>

        <p>A new order has been placed on '.$date_time.' Please find the details of the order below:</p>

        <h4>Order Details</h4>
        
        

        Order ID: '.$id.'
        Customer Name: '.$name.'<br>
        Customer Email: '.$email.'<br>
        Customer Phone: '.$phone.'<br>
        Payment Mode: '.$payment_mode.'<br>
        Order Status: '.$tracking_no.'<br>

        <p>Please take the necessary action and keep the customer informed about the status of their order.</p>

        <p>Thank you.</p>

        <br><br>Best regards,
        <br>Apobangpo Merch
        ';
        $mail->send();

    }

    if(isset($_SESSION['auth'])) {

        if(isset($_POST['placeOrderBtn'])) {



            $id = mysqli_real_escape_string($con, $_POST['id']);
            $name = mysqli_real_escape_string($con, $_POST['name']);
            $lname = mysqli_real_escape_string($con, $_POST['lname']);
            $email = mysqli_real_escape_string($con, $_POST['email']);
            $phone = mysqli_real_escape_string($con, $_POST['phone']);
            $street_address = mysqli_real_escape_string($con, $_POST['street_address']);
            $barangay = mysqli_real_escape_string($con, $_POST['barangay']);
            $zipcode = mysqli_real_escape_string($con, $_POST['zipcode']);
            $city = mysqli_real_escape_string($con, $_POST['city']);
            $province = mysqli_real_escape_string($con, $_POST['province']);
            $country = mysqli_real_escape_string($con, $_POST['country']);
            $comments = mysqli_real_escape_string($con, $_POST['comments']);
            $payment_mode = mysqli_real_escape_string($con, $_POST['payment_mode']);
            $payment_id = mysqli_real_escape_string($con, $_POST['payment_id']);
            // $fee = mysqli_real_escape_string($con, $_POST['fee']);

            // if($name=="" || $email=="" || $phone=="" || $pincode=="" || $address=="") {

            //     $_SESSION['message'] = "Some field  are empty";
            //     header('Location: ../checkout.php');
            //     exit(0);
            // }

            // $userid = $_SESSION['auth_user']['user_id'];
            // $query = "SELECT c.id as cid, c.product_id, c.prod_qty, p.id as pid, p.name, p.image, p.selling_price FROM carts c, products p WHERE c.product_id=p.id AND c.user_id='$userid' ORDER BY c.id DESC";

            // $query_run = mysqli_query($con, $query);



            $userid = $_SESSION['auth_user']['user_id'];
            $query = "SELECT c.id as cid, c.product_id, c.prod_qty, p.id as pid, p.name, p.image, p.selling_price, p.fee FROM carts c, products p WHERE c.product_id=p.id AND c.user_id=? ORDER BY c.id DESC";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "i", $userid);
            mysqli_stmt_execute($stmt);
            $query_run = mysqli_stmt_get_result($stmt);

            $totalPrice = 0;
            foreach ($query_run as $CartItem) {
     
            $totalPrice += $CartItem['selling_price'] *   $CartItem['prod_qty'] + $CartItem['fee'];  

            }
            // echo $totalPrice;

            $tracking_no = "RDW".rand(1111,9999).substr($phone,2);
            $user_id = $_SESSION['auth_user']['user_id'];
            // $insert_query = "INSERT INTO orders (tracking_no, user_id, name, email, phone, address, zipcode, total_price, payment_mode, payment_id, created_at) VALUES ('$tracking_no', '$userid', '$name', '$email', '$phone', '$address', '$zipcode', '$totalPrice', '$payment_mode', '$payment_id', NOW() )";

            $insert_query = "INSERT INTO orders (tracking_no, user_id, name, lname, email, phone, street_address, barangay, zipcode, city, province, country, comments, total_price, payment_mode, payment_id, created_at) VALUES ('$tracking_no', '$userid', '$name', '$lname', '$email', '$phone', '$street_address', '$barangay', '$zipcode', '$city', '$province', '$country', '$comments','$totalPrice', '$payment_mode', '$payment_id', NOW() )";
            //  $insert_query = $con->prepare("INSERT INTO orders (tracking_no, user_id, name, lname, email, phone, street_address, barangay, zipcode, city, province, country, comments, total_price, payment_mode, payment_id, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");

            // $insert_query->bind_param('siisssssssssdss', $tracking_no, $userid, $name, $lname, $email, $phone, $street_address, $barangay, $zipcode, $city, $province, $country, $comments, $totalPrice, $payment_mode, $payment_id);

            // $insert_query->execute();


            $insert_query_run = mysqli_query($con, $insert_query);

            if ($insert_query_run) {

 
                emailreceived($name, $email, $phone, $payment_mode, $tracking_no, $street_address, $barangay, $zipcode, $country, $city, $province, $totalPrice);
                adminreceived($id, $name, $email, $phone, $payment_mode, $tracking_no);
                $order_id = mysqli_insert_id($con);
                $insert_items_query = $con->prepare("INSERT INTO order_items (order_id, prod_id, qty, price, created_at) VALUES (?, ?, ?, ?, NOW())");
            
                $product_query = $con->prepare("SELECT * FROM products WHERE id=? LIMIT 1");
                $updateQty_query = $con->prepare("UPDATE products SET qty=? WHERE id=?");
            
                $deleteCartQuery = $con->prepare("DELETE FROM carts WHERE user_id=?");
            
                foreach ($query_run as $CartItem) {
                    $prod_id = $CartItem['product_id'];
                    $prod_qty = $CartItem['prod_qty'];
                    $price = $CartItem['selling_price'];
            
                    $insert_items_query->bind_param('iiid', $order_id, $prod_id, $prod_qty, $price);
                    $insert_items_query->execute();
            
                    $product_query->bind_param('i', $prod_id);
                    $product_query->execute();
                    $product_query_result = $product_query->get_result();
                    $productData = mysqli_fetch_array($product_query_result);
                    $current_qty = $productData['qty'];
            
                    $new_qty = $current_qty - $prod_qty;
            
                    $updateQty_query->bind_param('ii', $new_qty, $prod_id);
                    $updateQty_query->execute();
                }
            
                $deleteCartQuery->bind_param('i', $userid);
                $deleteCartQuery->execute();

                if($payment_mode == "COD") {
                    $_SESSION['message'] = "Order placed successfully";
                header('Location: ../my_orders.php');
                die();
                } else {
                    echo 201;
                    $_SESSION['message'] = "Order placed successfully";
                header('Location: ../my_orders.php');
                die();
                }
            
                
            }

            // if($insert_query_run) {

            //     $order_id = mysqli_insert_id($con);
            //     foreach ($query_run as $CartItem) {

            //         $prod_id = $CartItem['product_id'];
            //         $prod_qty = $CartItem['prod_qty'];
            //         $price = $CartItem['selling_price'];

            //         $insert_items_query = "INSERT INTO order_items (order_id, prod_id, qty, price, created_at) VALUES ('$order_id', '$prod_id', '$prod_qty', '$price', NOW())";
            //         $insert_items_query_run = mysqli_query($con, $insert_items_query);


            //         $product_query = "SELECT * FROM products WHERE id='$prod_id' LIMIT 1";
            //         $product_query_run = mysqli_query($con, $product_query);

            //         $productData = mysqli_fetch_array($product_query_run);
            //         $current_qty = $productData['qty'];

            //         $new_qty = $current_qty - $prod_qty;

            //         $updateQty_query = "UPDATE products SET qty='$new_qty' WHERE id='$prod_id' ";
            //         $updateQty_query_run = mysqli_query($con, $updateQty_query);
            //     }

            //     $deleteCartQuery = "DELETE FROM carts WHERE user_id='$userid'";
            //     $deleteCartQuery_run = mysqli_query($con, $deleteCartQuery);


            //     $_SESSION['message'] = "Order placed successfully";
            //     header('Location: ../my_orders.php');
            //     die();

            // }

        }
    }
    else {
        header('Location: ../index.php');
    }

?>