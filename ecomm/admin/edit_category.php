<?php 

include('../middleware/adminMidleware.php');
include('includes/header.php');

?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
<?php
                if(isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $category_id = getbyID("categories", $id);

                    if(mysqli_num_rows($category_id) > 0) {    
                        $data = mysqli_fetch_array($category_id);    
?>

                <div class="card">
                    <div class="card-header">
                        <h4>Edit Category
                            <a href="category.php" class="btn btn-sm btn-primary float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" name="category_id" value="<?= $data['id'] ?>">
                                <label for="">Name</label>
                                <input type="text" name="name" value="<?= $data['name'] ?>" placeholder="Enter Category Name" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">Slug</label>
                                <input type="text" name="slug" value="<?= $data['slug'] ?>" placeholder="Enter  Slug" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="">Description</label>
                                <textarea type="text" name="description"  placeholder="Enter Description" class="form-control"><?= $data['description'] ?></textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="">Upload Image</label>
                                <input type="file" name="image" class="form-control" >
                                <label for="">Current Image Uploaded</label>
                                <input type="hidden" name="old_image" value="<?= $data['image'] ?>">
                                <img src="../uploads/<?= $data['image'] ?>" alt="<?= $data['image'] ?>" class="category_image">
                            </div>
                            <div class="col-md-12">
                                <label for="">Meta Title</label>
                                <input type="text" name="meta_title" value="<?= $data['meta_title'] ?>" placeholder="Enter meta title" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="">Meta Description</label>
                                <textarea rows="3" name="meta_description" value="<?= $data['meta_description'] ?>" placeholder="Enter meta description" class="form-control"><?= $data['meta_description'] ?></textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="">Meta Keywords</label>
                                <textarea rows="3" name="meta_keywords" value="<?= $data['meta_keywords'] ?>" placeholder="Enter meta keywords" class="form-control"><?= $data['meta_keywords'] ?></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="">Status</label>
                                <input type="checkbox" name="status"  <?= $data['status'] ? "checked" : ""?>>
                            </div>
                            <div class="col-md-6">
                                <label for="">Popular</label>
                                <input type="checkbox" name="popular" <?= $data['popular'] ? "checked" : ""?> >
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" name="update_category_btn">Update</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>

<?php
                    } else {
                        echo "Category not found";
                    }
                } else { 
                    echo "ID messing from url";
                }
?>
            </div>
        </div>
    </div>

<?php include('includes/footer.php');?>