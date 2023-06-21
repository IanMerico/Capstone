<?php 
    $titlePage = "Tables";
    include('../middleware/adminMidleware.php');
    // include('../middleware/getOrders.php');
    include('includes/header.php');
    include('includes/navbar.php');
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-dark">Table Information</h4>
                </div>
                <form method="post" action="customer_PDF.php" class="ml-2" target="_blank">
                <a href="customer_report.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Customer Information</a>
                    <button type="submit" class="btn btn-sm  btn-primary d-sm" name="pdf">
                        <i class="fas fa-print fa-sm text-white"></i>
                    </button>
                </form>
                <div class="card-body pt-2">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered table-hover align-middle" style="width:100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Tracking No.</th>
                                    <th>Customer Full Name</th>
                                    <th>Age</th>
                                    <th>Complete Address</th>
                                    <th>Email</th>
                                    <th>Mobile#</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
                                    $customerHistory = getCustomerinfo();
                                    if(mysqli_num_rows($customerHistory) > 0) {
                                        foreach ($customerHistory as $item) {
?>
                                            <tr>
                                                <td class="text-center"><?= $item['order_date'];?></td>
                                                <td class="text-center">
                                                    <a href="#" data-toggle="modal" data-target="#trackingModal<?= $item['tracking_no']; ?>">
                                                        <?= $item['tracking_no']; ?>
                                                    </a>
                                                </td>
                                                <td class="text-center"><?= $item['full_name']; ?></td>
                                                <td class="text-center"><?= $item['age'];?></td>
                                                <td class="text-center"><?= $item['complete_address'];?></td>
                                                <td class="text-center"><?= $item['email'];?></td>
                                                <td class="text-center"><?= $item['phone'];?></td>
                                            </tr>
                                            <!-- Modal -->
                                            <div class="modal fade" id="trackingModal<?= $item['tracking_no']; ?>" tabindex="-1" role="dialog" aria-labelledby="trackingModalLabel<?= $item['tracking_no']; ?>" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="trackingModalLabel<?= $item['tracking_no']; ?>">Order details</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Order Number: <?= $item['tracking_no']; ?></p>
                                                            <p>Payment Mode: <?= $item['payment_mode']; ?></p>
                                                            <p>Status: <span style="color:<?= $item['status'] == 0 ? 'orange' : ($item['status'] == 1 ? 'green' : 'red');?>"><?= $item['status'] == 0 ? 'Under Process' : ($item['status'] == 1 ? 'Completed' : 'Cancelled');?></span></p>
                                                            <!-- Add any other tracking information you want to display in the modal body -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
<?php include('includes/footer.php');?>


