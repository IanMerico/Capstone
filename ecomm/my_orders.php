<?php 

include('functions/userfunctions.php');
include('includes/header.php');
include('authenticate.php');

?>
<div class="py-1 bg-primary text-center">
    <div class="container">
        <h6 class="text-white m-1">
            <a href="index.php" class="text-white" >Home</a>
            /
            <a href="my_orders.php" class="text-white">My Orders</a> 
        </h6>
    </div>
</div>
<div class="py-5 mb-5">
    <div class="container">
        <div class="">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tracking No.</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $orders = getOrders();
                                
                                if(mysqli_num_rows($orders) > 0) {

                                    foreach ($orders as $item) {
                                    ?>
                                        <tr>
                                            <td><?= $item['id']; ?></td>
                                            <td><?= $item['tracking_no'];?></td>
                                            <td>Php: <?= number_format($item['total_price'],2); ?></td>
                                            <!-- <td><?= $item['created_at']; ?></td> -->
                                            <td><?php echo date('M j g:i A', strtotime($item["created_at"]));  ?></td>
                                            <td>
                                                <a href="view_order.php?t=<?= $item['tracking_no']; ?>" class="btn btn-primary">View Details</a>
                                            </td>
                                        </tr>
                                    <?php
                                    } 
                                } else {
                                    ?>
                                        <tr>
                                            <td colspan="5">No orders yet</td>
                                        </tr>
                                    <?php
                                }

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer_information.php'); ?>

