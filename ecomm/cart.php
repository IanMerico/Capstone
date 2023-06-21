<?php 
    $titlePages = "";
    include('functions/userfunctions.php');
    include('authenticate.php');
        if (isset($_SESSION['auth'])) {
            $titlePages .= "Add Cart";
        } else {
            $titlePages .= "Add Cart";
        }
    include('includes/header.php');
?>
<div class="py-1 bg-primary text-center">
    <div class="container text-justify">
        <nav aria-label="breadcrumb" >
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item" >
                    <a href="index.php" class="text-dark">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="categories.php" class="text-dark">All Collections</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="cart.php" class="text-dark">Cart</a>
                </li>
            </ol>
        </nav>
    </div>
</div>
<div class="py-5">
    <div class="container "style=" height: 20rem;">
        <div class="box overflow-auto" >
            <div class="row justify-content-center textfontsize">
                <div class="col-md-12" >
                    <div id="mycart">
<?php 
                        $items = getCartItems();
                        if(mysqli_num_rows($items) > 0) {
?>
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <h6>Product</h6>
                            </div>
                            <div class="col-md-3">
                                <h6>Price</h6>
                            </div>
                            <div class="col-md-2">
                                <h6>Quantity</h6>
                            </div>
                            <div class="col-md-2">
                                <h6>Remove Item</h6>
                            </div>
                        </div>
                        <div id="">
<?php
                            foreach ($items as $CartItem) {
?>
                            <div class="card product_data shadow-sm mb-3">
                                <input type="hidden" name="qty" value="<?= $CartItem['qty']; ?>">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
<?php 
                                        $image_array = array($CartItem['image']);
                                        $first_image = explode(' ', $image_array[0])[0];
?>
                                        <img src="uploads/<?= $first_image; ?>" alt="Image" width="80px">
                                    </div>
                                    <div class="col-md-3 ">
                                        <h6><?= $CartItem['name']; ?></h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6>Php: <?= number_format($CartItem['selling_price'],2); ?></h6>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="hidden" class="prodId" value="<?= $CartItem['product_id']; ?>">
                                        <div class="input-group mb-1" style="width:110px">
                                            <button class="input-group-text decrement-btn updateQty" >-</button>
                                                <input type="text" class="form-control text-center bg-white input_qty " value="<?= $CartItem['prod_qty']; ?>" disabled >
                                            <button class="input-group-text increment-btn updateQty">+</button>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-danger btn-sm deleteItem" value="<?= $CartItem['cid']; ?>"><i class="fa fa-trash me-2"></i>Remove Item</button>
                                    </div>
                                </div>
                            </div>
<?php    
                                }   
                            
?>
                        </div>
                        <div class="float-end">
                            <a href="checkout.php" class="btn btn-outline-primary"> Proceed to Checkout</a>
                        </div>
<?php    
                        } else {
?>
                            <div class="card card-body shadow text-center" style=" height: 15rem;">
                                <h4 class="py-3 fw-bold ">Your cart is empty.</h4>
                            </div>
<?php
                        }
?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer_information.php'); ?>


