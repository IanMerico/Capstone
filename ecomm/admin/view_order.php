<?php
    $titlePage = "View Orders";
    include('../middleware/adminMidleware.php');
    include('includes/header.php');
    include('includes/navbar.php');
    if (isset($_GET['t'])) {
        $tracking_no = $_GET['t'];
        $Order_data = checkTrackingNoValid($tracking_no);

        if (mysqli_num_rows($Order_data) < 0) {
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
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="m-0 font-weight-bold text-dark">View Purchase Order</span>
                    <a href="order_history.php" class="btn btn-warning float-end"> <i class="fa fa-reply"></i> Back</a>
                    <form method="post" action="update_order.php" class="ml-2" target="_blank">
                <button class="btn btn-sm btn-flat btn-success" id="print" type="button"><i class="fa fa-print"></i> Print</button>
                </form>
                </div>
                <div class="card-body" id="out_print">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <div>
<?php
                                $systemInfo = systeminfo();

                                if (mysqli_num_rows($systemInfo) > 0) {
                                    $data_systemInfo = mysqli_fetch_array($systemInfo);
                                    ?>
                                    <p class="m-0"><?= $data_systemInfo['business_name']; ?></p>
                                    <p class="m-0"><?= $data_systemInfo['seller_email']; ?></p>
                                    <p class="m-0"><?= $data_systemInfo['business_address']; ?></p>
<?php
                                }
?>
                            </div>
                        </div>
                        <div class="col-6">
                            <center><img src="../assets/images/<?= $data_systemInfo['business_logo'] ?>" alt="" height="200px"></center>
                            <h2 class="text-center"><b>PURCHASE ORDER</b></h2>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <p class="m-0"><b>Customer</b></p>
                            <div>
                                <p class="m-0"><?= $data['name']; ?>&nbsp;<?= $data['lname']; ?></p>
                                <p class="m-0">
                                    <?= $data['street_address']; ?>
                                    <?= $data['barangay']; ?>
                                    <?= $data['city']; ?>
                                    <?= $data['province']; ?>
                                    <?= $data['zipcode']; ?>
                                </p>
                                <p class="m-0"><?= $data['phone']; ?></p>
                                <p class="m-0"><?php $data['email'] ?></p>
                            </div>
                        </div>
                        <div class="col-6 row">
                            <div class="col-6">
                                <p class="m-0"><b>P.O. #:</b></p>
                                <p><b><?= $data['tracking_no']; ?></b></p>
                            </div>
                            <div class="col-6">
                                <p class="m-0"><b>Date Created</b></p>
                                <p><b><?php echo date("Y-m-d", strtotime($data['created_at'])); ?></b></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped table-bordered" id="item-list">
                                <colgroup>
                                    <col style="width: 5%;">
                                    <col style="width: 40%;">
                                    <col style="width: 25%;">
                                    <col style="width: 25%;">
                                </colgroup>
                                <thead>
                                    <tr class="bg-navy disabled">
                                        <th class="bg-light disabled text-dark px-1 py-1 text-center">SR #No</th>
                                        <th class="bg-light disabled text-dark px-1 py-1 text-center">Product Description</th>
                                        <th class="bg-light disabled text-dark px-1 py-1 text-center">Quantity</th>
                                        <th class="bg-light disabled text-dark px-1 py-1 text-center">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
                                    $order_query = "SELECT o.id as oid, o.tracking_no, o.user_id, oi.*, oi.qty as orderQty, p.* FROM orders o, order_items oi, products p WHERE oi.order_id=o.id AND p.id=oi.prod_id AND o.tracking_no='$tracking_no'";
                                    $order_query_run = mysqli_query($con, $order_query);

                                    if (mysqli_num_rows($order_query_run) > 0) {
                                        foreach ($order_query_run as $item) {
?>
<?php
                                                $serialNumber = 1; // Initialize the serial number variable

                                                if (mysqli_num_rows($order_query_run) > 0) {
                                                    foreach ($order_query_run as $item) {
?>
                                                        <tr>
                                                            <td class="align-middle p-2"><?= $serialNumber; ?></td> <!-- Display the serial number -->
                                                            <td class="align-middle p-2"><?= $item['name']; ?></td>
                                                            <td class="align-middle p-2 text-center">x<?= $item['orderQty']; ?></td>
                                                            <td class="align-middle p-2 text-right">&#8369; <?= number_format($item['price'], 2); ?></td>
                                                        </tr>
                                                        <tr class="bg-lightblue">
                                                            <th class="p-2 text-right" colspan="3">Plus Shipping fee</th>
                                                            <th class="p-2 text-right" id="sub_total">&#8369; <?= number_format($item['fee'], 2); ?></th>
                                                        </tr>
<?php
                                                        $serialNumber++; // Increment the serial number
                                                    }
                                                } else {
?>
                                                    <tr>
                                                        <td colspan="3" class="text-center">No items found.</td>
                                                    </tr>
<?php
                                                }
?>

<?php
                                        }
                                    } else {
?>
                                        <tr>
                                            <td colspan="3" class="text-center">No items found.</td>
                                        </tr>
<?php
                                    }
?>
                                </tbody>
                                <tfoot>
                                   
                                    <tr class="bg-lightblue">
                                        <th class="p-2 text-right" colspan="3">Sub Total</th>
                                        <th class="p-2 text-right" id="sub_total">&#8369; <?= number_format($data['total_price'], 2); ?></th>
                                    </tr>
                                </tfoot>
                            </table>

                            <div class="row">
                                <div class="col-6">
                                    <label for="notes" class="control-label">Notes</label>
                                    <p><?= $data['comments']; ?></p>
                                </div>
                                <div class="col-6">
                                    <label for="status" class="control-label">Status</label>
                                    <br>
<?php
                                    switch ($data['status']) {
                                        case 0:
                                            echo "<span class='py-2 px-4 btn-flat btn-warning'>In Process</span>";
                                            break;
                                        case 1:
                                            echo "<span class='py-2 px-4 btn-flat btn-success'>Delivered</span>";
                                            break;
                                        case 2:
                                            echo "<span class='py-2 px-4 btn-flat btn-danger'>Declined Order</span>";
                                            break;
                                        default:
                                            break;
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

<?php include('includes/footer.php') ?>



