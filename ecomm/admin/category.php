<?php 
    $titlePage = "Category";
    include('../middleware/adminMidleware.php');
    include('includes/header.php');
    include('includes/navbar.php');
?>
    <div class="container overflow-scroll sticky">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                <div class="card-header  pb-1 py-3">
                            <h4 class="m-0 font-weight-bold text-dark">
                                Categories
                                <a href="add_category.php" class="btn btn-sm btn-primary float-end"><i class="fas fa-fw fa-plus"></i> Add Categories</a>
                            </h4>
                        </div>
                    <div class="card-body pt-2" id="category_table">
                        <div class="table-responsive">
                            <!-- <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0"> -->
                            <table id="example" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr class="text-center">
                                        <!-- <th>ID</th> -->
                                        <th>Category name</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
                                    $category = getAll("categories");

                                    if(mysqli_num_rows($category) > 0) {

                                        foreach($category as $item) {
?>
                                    <!-- HTML code with the active and inactive text -->
                                    <tr class="#">
                                        <!-- <td><?= $item['id']?></td> -->
                                        <td><?= $item['name']?></td>
                                        <td>
                                            <img src="../uploads/<?= $item['image']?>" alt="<?= $item['image']?>" class="category_image">
                                        </td>
                                        <td>
                                            <?php if ($item['status'] == '0') { ?>
                                                <span class="active">Active</span>
                                            <?php } else { ?>
                                                <span class="inactive">Inactive</span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a href="edit_category.php?id=<?= $item['id']?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-danger delete_category_btn" value="<?= $item['id']?>"><i class="fas fa-trash-alt"></i></button>
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