<?php 
    $titlePage = "Products";
    include('../middleware/adminMidleware.php');
    include('includes/header.php');
    include('includes/navbar.php');
?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header pb-1">
                        <h4 class="m-0 font-weight-bold text-dark">
                            Products
                            <a href="add_products.php" class="btn btn-sm btn-primary float-end"><i class="fas fa-fw fa-plus-square"></i> Add Product</a>
                        </h4> 
                    </div>
                    <div class="card-body pt-2" id="products_table">
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle" id="example" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <!-- <th>Delete</th> -->
                                </tr>
                            </thead>
                            <tbody>
<?php
                                $products = getAll("products");

                                if(mysqli_num_rows($products) > 0) {

                                    foreach($products as $item) {
?>
                                <tr>
                                    <td class="text-center"><?= $item['id']?></td>
                                    <td class="text-justify"><?= $item['name']?></td>
                                    <td class="text-center">
<?php 
                                        $image_array = array($item['image']);
                                        $first_image = explode(' ', $image_array[0])[0];
?>
                                        <img src="../uploads/<?= $first_image?>" alt="<?= $first_image?>" class="category_image">
                                    </td>
                                    <td>
<?php 
                                            if ($item['status'] == '0') { 
?>
                                            <span class="active">Active</span>
<?php 
                                            } else { 
?>
                                            <span class="inactive">Inactive</span>
<?php 
                                            } 
?>
                                    </td>
                                    <td class="text-center">
                                        <a href="edit_products.php?id=<?= $item['id']?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
<?php
                                    }
                                } else { 
                                    echo "No records founds";
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