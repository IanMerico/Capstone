<?php 
    include('functions/userfunctions.php');
    include('includes/header.php');

    if(isset($_GET['product'])) {

        $product_slug = $_GET['product'];
        $product_data = getSlugactive("products", $product_slug);
        $product = mysqli_fetch_array($product_data);

        if($product) {
?>
        <div class="py-1 bg-primary text-center">
            <div class="container">
                <h6 class="text-white m-1">
                    <a href="categories.php" class="text-white">
                    Home / 
                    </a>
                    <a href="categories.php" class="text-white">
                    Collections / 
                    </a>
                    <?= $product['name']; ?>
                </h6>
            </div>
        </div>
        <div class="bg-light py-4">
            <div class="container product_data mt-3">
                <div class="row">
                    <div class="col-md-4">
                        <div class="shadow">
                            <img src="uploads/<?= $product['image']; ?>" alt="Product Image" class="w-100">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h4 class="fw-bold"><?= $product['name']; ?>
                            <span class="float-end text-danger"><?php if($product['trending']) {echo "Trending"; } ?></span>
                        </h4>       
                        <hr>
                        <p><?= $product['small_description']; ?></p>
                        <div class="row">
                            <Span class="fw-normal mb-1">In stocks : <?= $product['qty']; ?></Span>
                        </div>
<?php 
                        if($product['qty'] != 0) 
{?>
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Php: <span class="text-success fw-bold"><?= number_format($product['selling_price'],2); ?></span></h4>
                            </div>
                            <div class="col-md-6">
                                <h5>Php: <s class="text-danger"><?= number_format($product['original_price'],2); ?></s></h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group mb-3" style="width:130px">
                                    <button class="input-group-text decrement-btn" >-</button>
                                        <input type="text" class="form-control text-center bg-white input_qty" value="1" disabled >
                                    <button class="input-group-text increment-btn">+</button>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <button class="btn btn-primary addToCartbtn px-4"value="<?= $product['id']; ?>"><i class="fa fa-shopping-cart me-2"></i>ADD TO CART</button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-primary addToWishlistbtn px-4"value="<?= $product['id']; ?>"><i class="fa fa-heart me-2"></i><span>ADD TO WISHLIST</span> </button>
                            </div>
                        </div>
<?php                       
                        } else {
?>
                        <div class="row">
                            <div class="col-md-6">
                                <Span class="fst-italic mb-1 text-danger">Product not available*</Span>
                            </div>
                        </div>
<?php 
                        } 
?>
                        <hr>
                        <h6>Product Description</h6>
                        <p><?= $product['description']; ?></p>
                    </div>
                </div>
            </div>
        </div>
            
<?php
        } else {
            echo "Product not found in this sections";
        }
    } else {
        echo "Something went wrong";
    }
    include('footer_information.php');
    // include('includes/footer.php'); 
?>
