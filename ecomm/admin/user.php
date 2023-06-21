<?php 
$titlePage = "User";
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
                                List of System Users
                                <a href="add_user.php" class="btn btn-sm btn-primary float-end"><i class="fas fa-fw fa-plus"></i> Create New</a>
                            </h4>
                        </div>
                    <div class="card-body pt-2" id="category_table">
                    <div class="table-responsive">
                        <!-- <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0"> -->
                        <table id="example" class="table table-hover" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th>ID</th>
                                    <th>Avatar</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Type</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
                                $admin = getAllusers("admin");

                                if(mysqli_num_rows($admin) > 0) {

                                    foreach($admin as $item) {
?>
                                <!-- HTML code with the active and inactive text -->
                                <tr class="#">
                                    <td><?= $item['id']?></td>
                                    <td>
                                        <img src="img/<?= $item['avatar']?>" alt="<?= $item['avatar']?>" class="category_image img-avatar img-thumbnail p-0 border-2 rounded-circle">
                                    </td>
                                    <td><?= $item['name']?>&nbsp;<?= $item['lname']?></td>
                                    <td><?= $item['username']?></td>
                                   
                                    <td>
                                        <?php if ($item['role_as'] == '1') { ?>
                                            <span class="active">Administrator</span>
                                        <?php } else { ?>
                                            <span class="inactive">Staff</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="edit_user.php?id=<?= $item['id']?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-danger delete_user_btn" value="<?= $item['id']?>"><i class="fas fa-trash-alt"></i></button>
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