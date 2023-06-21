<?php 

    $titlePage = "Add Products";
    include('../middleware/adminMidleware.php');
    include('includes/header.php');
    include('includes/navbar.php');

?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Product
                            <a href="products.php" class="btn btn-sm btn-primary float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="mb-0" >Select Category</label>
                                    <select name="category_id" class="form-select mb-2">
                                    <option selected>Select Category List</option>
<?php
                                        $categories = getAll("categories");

                                        if(mysqli_num_rows($categories) > 0) {
                                            foreach($categories as $item){
?>
                                                <option value="<?= $item['id']; ?>"><?= $item['name']; ?></option>
<?php
                                            }     
                                        } else {
                                                echo "No category Available";
                                        }
?>                                     
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="mb-0">Name</label>
                                    <input type="text" name="name" placeholder="Enter Product Name" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="mb-0">Slug <small>(url name)</small></label>
                                    <input type="text" name="slug" placeholder="Enter  Slug" class="form-control" required>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="mb-0">Small Description <small><i>(text string that is used to create a URL for a web page or post.)</i></small></label>
                                    <textarea rows="3" name="small_description" placeholder="Enter Small Description" class="form-control" required></textarea>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="mb-0">Description <small><i>(short description of the product content)</i></small></label>
                                    <textarea rows="3" id="productsdescription" name="description" placeholder="Enter Description" class="form-control"></textarea>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="mb-0">Original Price</label>
                                    <input type="text" name="original_price" placeholder="Enter Price" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="mb-0">Selling Price</label>
                                    <input type="text" name="selling_price" placeholder="Enter  Selling Price" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="mb-0">Shipping fee</label>
                                    <input type="text" name="fee" placeholder="Enter  shipping fee" class="form-control" required>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="mb-0">Upload Image</label>
                                    <input type="file" name="image[]" multiple class="form-control mb-1" required >
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label class="mb-0">Quantity</label>
                                        <input type="number" name="qty" placeholder="Enter  Quantity" class="form-control" required>
                                    </div>
                                    <div class="col-md-3 ">
                                        <label class="mb-0">Status</label><br>
                                        <input type="checkbox" name="status">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="mb-0">Trending</label><br>
                                        <input type="checkbox" name="trending">
                                    </div>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <button type="submit" class="btn btn-primary" name="add_product_btn">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include('includes/footer.php');?>