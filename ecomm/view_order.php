<?php 
$titlePages = "Order View";
include('functions/userfunctions.php');
include('includes/header.php');
include('authenticate.php');

if(isset($_GET['t'])) {

    $tracking_no = $_GET['t'];

    $Order_data = checkTrackingNoValid($tracking_no);

        if(mysqli_num_rows($Order_data) < 0) {
        ?>
            <h4>No Tracking number available</h4>
        <?php
        die();
        }

} else { 
    ?>
        <h4>No Tracking number available</h4>
    <?php
    die();
}
$data = mysqli_fetch_array($Order_data);
?>
<div class="py-1 bg-primary text-center">
    <div class="container text-justify">
        <nav aria-label="breadcrumb" >
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item" >
                    <a href="index.php" class="text-dark">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="my_orders.php" class="text-dark">My Orders</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#" class="text-dark">View Order</a>
                </li>
            </ol>
        </nav>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="">
            <div class="row textfontsize">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <span class="text-dark fs-4">View Order</span> 
                            <a href="my_orders.php" class="btn btn-warning float-end"> <i class="fa fa-reply"></i> Back</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Shipping address</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                                <div class="border p-1">
                                                    <label class="fw-bolder">Date:&nbsp;</label><?= date('F j Y h:i:s A', strtotime($data['created_at']));?>              
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-2">
                                                <div class="border p-1">
                                                    <label class="fw-bolder">Order ID:&nbsp;</label><?= $data['tracking_no'];?>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-2">
                                                <div class="border p-1">
                                                        <label class="fw-bolder">Full name:&nbsp;</label>
                                                        <?= $data['name'];?>&nbsp;<?= $data['lname'];?>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-2">      
                                                <div class="border p-1">
                                                    <label class="fw-bolder">Address:&nbsp;</label>
                                                    <?= $data['street_address'];?>
                                                    <?= $data['barangay'];?>
                                                    <?= $data['city'];?>
                                                    <?= $data['province'];?>
                                                    <?= $data['zipcode'];?>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-2">                                 
                                                <div class="border p-1">
                                                    <label class="fw-bolder">Contact #:&nbsp;</label>
                                                        <?= $data['phone'];?>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-2">                                 
                                                <div class="border p-1">
                                                    <label class="fw-lighter">Buyer remarks*:&nbsp;</label>
                                                        <textarea name="foo" id="foo" class="form-control bg-white fw-lighter" row="5" disabled><?= $data['comments'];?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="col-md-6">
                                    <h4>Order Details</h4>
                                    <hr>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="fw-bolder">Product</th>
                                                <th class="fw-bolder">Price</th>
                                                <th class="fw-bolder">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $userid = $_SESSION['auth_user']['user_id'];

                                                $order_query = "SELECT o.id as oid, o.tracking_no, o.user_id, oi.*,oi.qty as orderQty, p.* FROM orders o, order_items oi, products p WHERE o.user_id='$userid' AND oi.order_id=o.id AND p.id=oi.prod_id AND o.tracking_no='$tracking_no'";

                                                $order_query_run = mysqli_query($con, $order_query);

                                                if(mysqli_num_rows($order_query_run) > 0) {

                                                    foreach($order_query_run as $item) {
                                                        ?>
                                                        <tr>
                                                            <td class="align-middle">
                                                            <?php 
                                                                $image_array = array($item['image']);
                                                                $first_image = explode(' ', $image_array[0])[0];
                                                            ?>
                                                                <img src="uploads/<?= $first_image;?>" width="50px" height="50px" alt="<?= $item['name'];?>">
                                                                <?= $item['name'];?>
                                                            </td>
                                                            <td class="align-middle fw-bolder">
                                                            &#8369; <?= number_format($item['price'],2);?>
                                                            </td>
                                                            <td class="align-middle">
                                                                x<?= $item['orderQty'];?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }

                                                }

                                            ?>
                                        </tbody>
                                    </table>                                    
                                    <h6>Shipping Fee  : <span class="float-end fw-normal mb-2">&#8369; <?= number_format($item['fee'],2); ?></span></h6>
                                    <h5 class="fw-bolder mt-3">Total Price: <span class="float-end">&#8369; <?= number_format($data['total_price'],2);?></span></h5>
                                    <hr>
                                    <label class="fw-bold">Payment Method</label>
                                    <div class="border p-1 mb-2">
                                        <?= $data['payment_mode'];?>
                                    </div>                             
                                    <label class="fw-bolder">Status</label>
                                    <div class="border p-0 mb-2 text-center">                                    
                                        <?php
                                            if($data['status'] == 0) {

                                                echo "<div class='p-0 bg-warning text-dark'>Under Process</div>";

                                            } else if($data['status'] == 1) {

                                                echo "<div class='p-0 bg-success text-white'>Completed</div>";
                                                
                                            } else if($data['status'] == 2) {

                                                echo "<div class='p-0 bg-danger text-white'>Cancelled</div>";;
                                                
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer_information.php'); ?>

