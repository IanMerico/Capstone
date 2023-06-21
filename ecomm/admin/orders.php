<?php 
    $titlePage = "Order list";
    include('../middleware/adminMidleware.php');
    include('includes/header.php');
    include('includes/navbar.php');
?>

    <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow mb-4">
                        <div class="card-header pb-1">
                            <h4 class="m-0 font-weight-bold text-dark">Orders
                                <!-- <a href="order_history.php" class="btn btn-warning float-end">Order History</a> -->
                            </h4> 
                        </div>
                        <div class="card-body pt-2" id="">
                        <!-- <table class="table table-bordered table-hover align-middle" id="dataTable" width="100%" cellspacing="0"> -->
                        <table id="example" class="table table-bordered table-hover align-middle" style="width:100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Customer Name</th>
                                    <th>Tracking No.</th>
                                    <th>Price</th>
                                    <th>Date</th>
                                    <th>View</th>
                                    <th>Update</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $orders = getAllOrders();
                                    
                                    if(mysqli_num_rows($orders) > 0) {

                                        foreach ($orders as $item) {
                                        ?>
                                            <tr>
                                                <td class="text-center"><?= $item['id']; ?></td>
                                                <td class="text-center"><?= $item['name']; ?>&nbsp;<?= $item['lname']; ?></td>
                                                <td class="text-center"><?= $item['tracking_no'];?></td>
                                                <td>Php: <?= number_format($item['total_price'], 2); ?></td>
                                                <td><?= date("F d Y: h:i A",strtotime($item['created_at'])); ?></td>
                                                <td>
                                                    <a href="view_order.php?t=<?= $item['tracking_no']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                                </td>
                                                <td>
                                                    <!-- <a href="update_order.php?id=<?= $item['tracking_no']; ?>" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"> <i class="fas fa-edit"></i></a> -->

                                                    <!-- <a href="update_order.php?id=<?= $item['id']; ?>" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-edit"></i></a> -->
                                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" onclick="updateModalValues('<?= $item['tracking_no'];?>', '<?= $item['id'];?>')">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
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

<script>
    function updateModalValues(trackingNo, id) {
        
        document.getElementById("modal-tracking-no").innerHTML = trackingNo;
        document.getElementById("modal-id").innerHTML = id;
        // var orderId = document.getElementById("modal-id").innerHTML = id;
        document.getElementById("tracking-no-input").value = trackingNo;
    }
</script>

<?php include('includes/footer.php')

// 
?>

<php


?>

<!-- Modal -->
<!-- 
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
                // $order_id = $item['id'];// get the specific order ID from the user

                $order_id = $item['id'];
                $ordersRemark = getRemarksByOrderId($order_id);
                $last_update_timestamp = $item['updated_at'];
                                
                if(mysqli_num_rows($ordersRemark) > 0) {

                    foreach ($ordersRemark as $item) {
                
                ?>
                <?php $transaction_date = date("l, j F Y, h:i A", strtotime($item["created_at"])); ?>
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
                <span>ID: <?= $item['order_id'];?></span><br>
                <span>Status: <?= $stats;?></span><br>

                <?php if (!empty($item['remark'])) : ?>
                    <span>Remarks: <?= $item['remark'];?></span><br>
                <?php endif; ?>
                <hr style="border-top: 3px solid;">
                <?php }}?>
                
                <select name="order_status" id="" class="form-select mb-2">
                    <option value="0" <?= $item['status'] == 0? "selected":""?>>In Process</option>
                    <option value="1" <?= $item['status'] == 1? "selected":""?>>Delivered</option>
                    <option value="2" <?= $item['status'] == 2? "selected":""?>>Declined Order</option>
                </select>
                <div class="form-group">
                    <label for="remark">Remark:</label>
                    <textarea class="form-control" id="remark" name="remark" rows="3"></textarea>
                </div>
      </div>
                <div class="modal-footer">
                    <button type="submit" name="update_Orders_btn" class="btn btn-primary mt-2">Update Order</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
    </div>
  </div>
</div> -->

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
    <input type="hidden" name="tracking_no" id="tracking-no-input">
    <!-- <input type="hidden" id="order-id" value="<?php echo $id; ?>"> -->

    <h6>Update Order</h6>
    <p>Order ID: <span id="modal-tracking-no"></span></p>
    <p>Order ID: <span id="modal-id"><?= $order_id ?></span></p>

    <?php
    //   $id = $_POST['id'];
    // $orders = getAllordersbyID($order_id);
    // if (mysqli_num_rows($orders) > 0) {
    //     foreach ($orders as $item) {
    //         $order_id = $item['id'];
            $ordersRemark = getRemarksByOrderId($order_id);
            $last_update_timestamp = $item['updated_at'];
            if (mysqli_num_rows($ordersRemark) > 0) {
                while ($remark_item = mysqli_fetch_assoc($ordersRemark)) {
                    $transaction_date = date("l, j F Y, h:i A", strtotime($remark_item["created_at"]));
                    $stats="";
                    if ($remark_item['status'] == 0) {
                        $stats = "In Process";
                    } else if ($remark_item['status'] == 1) {
                        $stats = "Delivered";
                    } else if ($remark_item['status'] == 2) {
                        $stats = "Declined Order";
                    }
?>
                    <span>Date: <?= $transaction_date;?></span><br>
                    <span >ID: <?= $remark_item['order_id'];?></span><br>
                    <span>Status: <?= $stats;?></span><br>

                    <?php if (!empty($remark_item['remark'])) : ?>
                        <span>Remarks: <?= $remark_item['remark'];?></span><br>
                    <?php endif; ?>
                    <hr style="border-top: 3px solid;">
<?php
                }
            }
    //     }
    // }
?>
    
    <select name="order_status" id="" class="form-select mb-2">
        <option value="0" <?= $item['status'] == 0? "selected":""?>>In Process</option>
        <option value="1" <?= $item['status'] == 1? "selected":""?>>Delivered</option>
        <option value="2" <?= $item['status'] == 2? "selected":""?>>Declined Order</option>
    </select>
    <div class="form-group">
        <label for="remark">Remark:</label>
        <textarea class="form-control" id="remark" name="remark" rows="3"></textarea>
    </div>
    <div class="modal-footer">
        <button type="submit" name="update_Orders_btn" class="btn btn-primary mt-2">Update Order</button>
    </div>
</form>
    </div>
  </div>
</div>


