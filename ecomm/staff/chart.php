<?php 
    $titlePage = "Charts";
    include('../middleware/adminMidleware.php');
    include('../middleware/getOrders.php');
    include('includes/header.php');
    include('includes/navbar.php');
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-md-12 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-dark">Total Sales</h4>
                </div>
                <div class="card-body">
<?php
                        $total_sales = getTotalSales();
?>
                    <canvas id="sales-chart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-dark">Product Sales</h4>
                </div>
                <div class="card-body">
                <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-dark">Gender Distribution</h4>
                </div>
                <div class="card-body">
                    <canvas id="gender-chart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-dark">Gender Distribution</h4>
                </div>
                <div class="card-body">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php');?>


