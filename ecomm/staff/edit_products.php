<?php 
$titlePage = "Edit Products";
include('../middleware/adminMidleware.php');
include('includes/header.php');
include('includes/navbar.php');

?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
<?php
                if(isset($_GET['id'])) {

                
                $id = $_GET['id'];
                $products = getbyID("products", $id);

                if(mysqli_num_rows($products) > 0) {

                    $data = mysqli_fetch_array($products);
?>
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Product
                            <a href="products.php" class="btn btn-sm btn-primary float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="    ">
                                    <label class="mb-0" >Select Category</label>
                                    <select name="category_id" class="form-select mb-2" aria-label="Default select example">
                                    <option selected>Select Category List</option>
<?php
                                        $categories = getAll("categories");

                                        if(mysqli_num_rows($categories) > 0) {
                                            foreach($categories as $item){
?>
                                                <option value="<?= $item['id']; ?>"<?= $data['category_id'] == $item['id']?'selected':'' ?>><?= $item['name']; ?></option>
<?php
                                            }     
                                        } else {
                                                echo "No category Available";
                                        }
?>                                     
                                    </select>
                                </div>
                                <input type="hidden" name="product_id" value="<?= $data['id'];?>">
                                <div class="col-md-6 mb-2">
                                    <label class="mb-0">Name <small><i>(name of the products)</i></small></label>
                                    <input type="text" value="<?= $data['name'];?>" name="name"placeholder="Enter Category Name" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="mb-0">Slug <small><i>(text string that is used to create a URL for a web page or post.)</i></small> </label>
                                    <input type="text" value="<?= $data['slug'];?>" name="slug" placeholder="Enter  Slug" class="form-control" required>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="mb-0">Small Description <small><i>(short description of the product content)</i></small></label>
                                    <textarea rows="3" id="small_description" name="small_description" placeholder="Enter Small Description" class="form-control" required> <?= $data['small_description']?></textarea>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="mb-0">Description</label></label>
                                    <textarea rows="3" id="productsdescription" name="description" placeholder="Enter Description" class="form-control"><?= $data['description']?></textarea>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="mb-0">Original Price</label>
                                    <input type="text" value="<?= $data['original_price'];?>" name="original_price" placeholder="Enter Price" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="mb-0">Selling Price</label>
                                    <input type="text" value="<?= $data['selling_price'];?>" name="selling_price" placeholder="Enter  Selling Price" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="mb-0">Shipping fee</label>
                                    <input type="text" value="<?= $data['fee'];?>" name="fee" placeholder="Enter  shipping fee" class="form-control" required>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="mb-0">Upload Image</label>
                                    <input type="hidden" name="old_image" value="<?= $data['image'];?>">
                                    <input type="file" name="image[]" multiple class="form-control mb-2">
                                    <label class="mb-0">Current Image</label>
<?php
                                    $i="";
                                    $res=$data['image'];
                                    $res=explode(" ",$res);
                                    $count=count($res);
                                    for($i=0;$i<$count;++$i)
                                    {
?>
                                    <img src="../uploads/<?= $res[$i];?>" alt="Product Image" class="product_image" required>
<?php 
                                    }
?>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label class="mb-0">Quantity</label>
                                        <input type="number" value="<?= $data['qty'];?>" name="qty" placeholder="Enter  Quantity" class="form-control" min="0" required>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="mb-0">Status to hide the item</label><br>
                                        <input type="checkbox"  name="status" <?= $data['status'] == 0?'':'checked'?>>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="mb-0">Trending to post</label><br>
                                        <input type="checkbox"  name="trending" <?= $data['trending'] == 0?'':'checked'?>>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <button type="submit" class="btn btn-primary" name="update_product_btn">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
<?php 
                    } else {
                        echo "Product not found";
                    }

                 } else {
                    echo "ID is messing from url!";
                }
?>
            </div>
        </div>
    </div>
<?php include('includes/footer.php');?>