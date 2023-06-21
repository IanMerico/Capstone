<?php 
    $titlePage = "Add Category";
    include('../middleware/adminMidleware.php');
    include('includes/header.php');
    include('includes/navbar.php');

?>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header pb-1">
                                            <h4>Add Category
                                                <a href="category.php" class="btn btn-sm btn-primary float-end">Back</a>
                                            </h4>
                                        </div>
                                        <div class="card-body pt-2">
                                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-6 mb-2">
                                                    <label for="">Name</label>
                                                    <input type="text" name="name" placeholder="Enter Category Name" class="form-control">
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="">Slug <small>(url name)</small></label>
                                                    <input type="text" name="slug" placeholder="Enter  Slug" class="form-control">
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <label for="">Description</label>
                                                    <textarea type="text" name="description" placeholder="Enter Description" class="form-control"></textarea>
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <label for="">Upload Image</label>
                                                    <input type="file" name="image" class="form-control " >
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="">Status</label>
                                                    <input type="checkbox" name="status" value="status" onclick="toggleCheckboxes(this)">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="">Popular</label>
                                                    <input type="checkbox" name="popular" value="popular" onclick="toggleCheckboxes(this)">
                                                </div>
                                                <div class="col-md-12 ">
                                                    <button type="submit" class="btn btn-primary" name="add_category_btn">Save</button>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

<?php include('includes/footer.php');?>