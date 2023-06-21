<?php 
    $titlePage = "Order History";
    include('../middleware/adminMidleware.php');
    include('includes/header.php');
    include('includes/navbar.php');
?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header pb-1">
                            <h4 class="m-0 font-weight-bold text-dark">Cancelled Orders
                                <a href="orders.php" class="btn btn-warning float-end">Back</a>
                            </h4> 
                        </div>
                        <div class="card-body pt-2" id="">
                            <div class="table-responsive">
                                <table id="example" class="table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>User</th>
                                            <th>Tracking No.</th>
                                            <th>Price</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>View</th>
                                            <!-- <th>Check details</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
                                    $orders = getCancelledOrders();
                                    
                                    if(mysqli_num_rows($orders) > 0) {

                                        foreach ($orders as $item) {
?>
                                            <tr>
<?php  
                                                    $stats="";
                                                    if( $item['status'] == 0) {
                                                        $stats = "In Process";
                                                    }else if ($item['status'] == 1) {
                                                        $stats = "Delivered";
                                                    }else if($item['status'] == 2) {
                                                        $stats = "Cancelled Order";
                                                    }
?>
                                                <td class="text-center"><?= $item['id']; ?></td>
                                                <td class="text-center"><?= $item['name']; ?>&nbsp;<?= $item['lname']; ?></td>
                                                <td class="text-center"><?= $item['tracking_no'];?></td>
                                                <td class="text-center">Php: <?= number_format($item['total_price'], 2); ?></td>
                                                <td class="text-center"><?= date("F d Y: h:i A",strtotime($item['created_at'])); ?></td>
                                                <td class="text-center">
                                                    <?= $stats; ?>
                                                </td>
                                                <td class="text-center">
                                                    <a href="view_order.php?t=<?= $item['tracking_no']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                                </td>
                                                <td>
                                                    <!-- <a href="update_order.php?id=<?= $item['tracking_no']; ?>" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"> <i class="fas fa-edit"></i></a> -->
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
        </div>
    <?php include('includes/footer.php') ?>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="code.php" method="POST">
                        <input type="hidden" name="tracking_no" value="<?= $item['tracking_no'];?>">
                        <h6>Update Order</h6>
                        <p>Order ID: <?= $item['tracking_no'];?></p>
                        <p>Order ID: <?= $item['id'];?></p>
<?php 
                        if(isset($_GET['id'])) {
                        // $id = $item['order_id'];
                        $ordersRemark = getRemarks();
                        if(mysqli_num_rows($ordersRemark) > 0) {
                            foreach ($ordersRemark as $item) {
?>
<?php 
                            $transaction_date = date("l, j F Y, h:i A", strtotime($item["created_at"])); 
?>
                            <span>Date: <?= $transaction_date;?></span><br>
<?php  
                        $stats="";
                        if( $item['status'] == 0) {
                            $stats = "In Process";
                        }else if ($item['status'] == 1) {
                            $stats = "Delivered";
                        }else if($item['status'] == 2) {
                            $stats = "Declined Order";
                        }
?>
                        <span>Status: <?= $stats;?></span><br>
<?php 
                            if (!empty($item['remark'])) : 
?>
                            <span>Remarks: <?= $item['remark'];?></span><br>
<?php 
                            endif; 
?>
                        <hr style="border-top: 3px solid;">
<?php 
                                    }
                                }
                            } 
?>
                        <span>Product Delevered!</span>
                </div>
                        <div class="modal-footer">
                            <!-- <button type="submit" name="update_Orders_btn" class="btn btn-primary mt-2">Update Order</button> -->
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
