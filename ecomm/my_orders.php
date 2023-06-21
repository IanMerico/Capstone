<?php 
$titlePages = "My Orders";
include('functions/userfunctions.php');
include('includes/header.php');
include('authenticate.php');
?>
<div class="py-1 bg-primary text-center">
    <div class="container text-justify">
        <nav aria-label="breadcrumb" class="breadcrumbs">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item" >
                    <a href="index.php" class="text-dark">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="my_orders.php" class="text-dark">My Orders</a>
                </li>
            </ol>
        </nav>
    </div>
</div>
<div class="py-5 mb-5">
    <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-responsive" id="datatableid" width="100%">
                        <thead>
                            <tr>
                                <th class="th-sm">Order ID.</th>
                                <th class="th-sm">Price</th>
                                <th class="th-sm">Date</th>
                                <th class="th-sm">Status</th>
                                <th class="th-sm">View</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
                            $orders = getOrders();                             
                            if(mysqli_num_rows($orders) > 0) {
                                foreach ($orders as $item) {
?>
                                    <tr>
                                        <td><?= $item['tracking_no'];?></td>
                                        <td>Php: <?= number_format($item['total_price'],2); ?></td>
                                        <td><?php echo date('M j g:i A', strtotime($item["created_at"]));  ?></td>
                                        <td>
<?php 
                                            $item["status"];  
                                            if($item['status'] == 0) {

                                                echo "<div class='p-0 bg-warning text-dark text-center'>Under Process</div>";

                                            } else if($item['status'] == 1) {

                                                echo "<div class='p-0 bg-success text-white text-center'>Completed</div>";
                                                
                                            } else if($item['status'] == 2) {

                                                echo "<div class='p-0 bg-danger text-white text-center'>Cancelled</div>";   
                                            }
?>
                                        </td>
                                        <td class="d-flex justify-content-center align-content-center ">
                                            <a href="view_order.php?t=<?= $item['tracking_no']; ?>" class="btn btn-primary p-0 ">View details</a>
                                        </td>
                                    </tr>
<?php
                                } 
                            } else {
?>
                                    <div class="mb-3">
                                        No orders yet
                                    </div>
<?php
                            }
?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Order ID.</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>View</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php 
include('footer_information.php'); 
?>


