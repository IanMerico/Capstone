<?php 
$titlePage = "Sales report";
include('../middleware/adminMidleware.php');
include('../middleware/getOrders.php');
include('includes/header.php');
include('includes/navbar.php');

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-1 d-sm-flex align-items-center justify-content-between mb-4">
                    <h4 class="m-0 font-weight-bold text-dark">Sales Report</h4> 
                    <form method="get" action="sales_report.php" class="ml-2">
                        <label for="start_date">Start Date:</label>
                        <input type="date" name="start_date" id="start_date">
                        <label for="end_date">End Date:</label>
                        <input type="date" name="end_date" id="end_date">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-filter"></i> Filter</button>
                    </form>

                </div>
                <?php
                     $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
                     $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;

                ?>
                <form method="GET" action="gen_PDF.php" class="ml-2" target="_blank">
                    <a href="gen_Sales_Report.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-download fa-sm text-white-50"></i> Generate Sales Report
                    </a>
                    <input type="hidden" name="start_date" value="<?= $start_date ?>">
                    <input type="hidden" name="end_date" value="<?= $end_date ?>">
                    <button type="submit" class="btn btn-sm btn-primary d-sm" name="pdf">
                        <i class="fas fa-print fa-sm text-white"></i>
                    </button>
                </form>
                <div class="card-body pt-2" id="">
                    <div class="table-responsive">
                        <table id="example" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Transaction Date</th>
                                    <th>Category</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    // Retrieve the start date and end date from the query parameters
                                    if ($start_date && $end_date) {
                                        // Date filter is specified, fetch data within the date range
                                        $reportSales = getSalesReport($start_date, $end_date);
                                    } else {
                                        // Date filter is not specified, fetch all data
                                        $reportSales = getSalesReport();
                                    }

                                    // Store the filtered data in a session variable
                                    $_SESSION['filteredSalesReport'] = $reportSales;

                                    $total_price = 0;
                                    $total_qty = 0;
                                    $total_amount = 0;

                                    if (mysqli_num_rows($reportSales) > 0) {
                                        foreach ($reportSales as $item) {
                                            $transaction_date = date("l, j F Y, h:i A", strtotime($item["transaction_date"]));
                                            $total_price += $item['total_price'];
                                            $total_qty += $item['qty'];
                                            $total_amount += $item['total_amount'];
                                            ?>
                                            <tr>
                                                <td><?= $transaction_date ?></td>
                                                <td><?= $item['category_name'];?></td>
                                                <td><?= $item['product_name'];?></td>
                                                <td>Php: <?= number_format($item['total_price'], 2); ?></td>
                                                <td><?= $item['qty']; ?></td>
                                                <td><?= $item['total_amount']; ?></td>
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
                            <tfoot>
                                <tr>
                                    <td colspan="3" align="left"><b>Total:</b></td>
                                    <td>Php: <?= number_format($total_price, 2); ?></td>
                                    <td><?= $total_qty; ?></td>
                                    <td>Php: <?= number_format($total_amount, 2); ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>
