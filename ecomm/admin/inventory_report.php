<?php 
    $titlePage = "Inventory report";
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
                <h4 class="m-0 font-weight-bold text-dark">Inventory Report</h4>              
            </div>      
            <form method="post" action="inventory_PDF.php" class="ml-2" target="_blank">
                <a href="gen_inventory_Report.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>
                    Generate Inventory Report</a>
                    <button type="submit" class="btn btn-sm  btn-primary d-sm" name="pdf">
                        <i class="fas fa-print fa-sm text-white"></i>
                    </button>
                </form>
                <div class="card-body pt-2" id="">
                    <div class="table-responsive">
                        <table id="#" class="table table-hover" style="width:100%; text-align:justify">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Sold</th>
                                    <th>Remaining Stock</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
                                    $inventoryReports= getInventoryReport();
                                    
                                    if(mysqli_num_rows($inventoryReports) > 0) {

                                        foreach ($inventoryReports as $item) {
?>
                                            <tr>
                                                <td><?= $item['id'] ?></td>
                                                <td><?= $item['category'] ?></td>
                                                <td><?= $item['name'];?></td>
                                                <td>Php: <?= number_format($item['price'], 2); ?></td>
                                                <td><?= $item['stock'];?></td>
                                                <td><?= $item['sold']; ?></td>
                                                <td><?= $item['remaining_stock']; ?></td>
                                            </tr>
<?php
                                        } 
                                    } else {
?>
                                            <tr>
                                                <td colspan="5">No stocks available</td>
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
