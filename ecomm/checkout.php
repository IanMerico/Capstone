<?php 

include('functions/userfunctions.php');
include('includes/header.php');
include('authenticate.php');

?>
<div class="py-3 bg-primary">
    <div class="container">
        <h6 class="text-white">
            <a href="index.php" class="text-white" >Home</a> 
             / 
            <a href="checkout.php" class="text-white">Checkout</a> 
        </h6>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="card">
            <div class="card-body shadow">
                <form action="functions/placeorder.php" method="POST">
                    <div class="row">
                        <div class="col-md-7">
                            <h5>Basic details</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold" >Name</label>
                                    <input type="text" name="name"  placeholder="Enter your full home name" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold" >E-mail</label>
                                    <input type="email" name="email"  placeholder="Enter your email" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold" >Phone</label>
                                    <input type="text" name="phone" placeholder="Enter your full number" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold" >Zip Code</label>
                                    <input type="text" name="pincode" placeholder="Enter your pin code" class="form-control">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="fw-bold" >Address</label>
                                    <textarea  name="address"  class="form-control" row="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <h5>Order Details</h5>
                            <hr>
                            <?php 
                                $items = getCartItems();
                                $totalPrice = 0;
                                foreach ($items as $CartItem) {
                            ?>
                                <div class="mb-1 border">
                                    <div class="row align-items-center">
                                        <div class="col-md-2">
                                            <img src="uploads/<?= $CartItem['image']; ?>" alt="Image" width="60px">
                                        </div>
                                        <div class="col-md-5">
                                            <label><?= $CartItem['name']; ?></label>
                                        </div>
                                        <div class="col-md-3">
                                            <label><?= $CartItem['selling_price']; ?></label>
                                        </div>
                                        <div class="col-md-2">
                                            <label>x<?= $CartItem['prod_qty']; ?></label>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                $totalPrice += $CartItem['selling_price'] *   $CartItem['prod_qty'];    
                                }
                            ?>
                            <hr>
                            <h5>Total Price: <span class="float-end fw-bold"><?= $totalPrice ?></span></h5>
                            <div class="class">
                                <input type="hidden" name="payment_mode" value="COD">
                                <button type="submit" name="placeOrderBtn" class="btn btn-primary w-100">Confirm and place order | COD</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php') ?>

