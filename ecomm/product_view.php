<?php 
$titlePages = "Available Item";
    include('functions/userfunctions.php');
    include('includes/header.php');

    if(isset($_GET['product'])) {

        $product_slug = $_GET['product'];
        $product_data = getSlugactive("products", $product_slug);
        $product = mysqli_fetch_array($product_data);
        

        if($product) {
?>
<style>
        /* This style is for the wall demo success.php */
    * {
        margin: 0px;
        padding: 0px;
        /* outline: 1px dotted green; */
        font-family: sans-serif;
        
    }
    .container1 {
        padding: 0px 10px 10px 10px;
        width: auto;
        height:auto;
        border: 1px solid black;
        background-color: #6E85B7;
    }
    header ul {
        background-color: #bdccec;
        margin: 5px;
    }
    header ul li{
        display: inline-block;
        font-size: 20px;
        padding: 10px 20px 10px 20px;
        font-weight: bold;
        
    }
    input {
        font-size: 18px;
        padding-left: 5px;
        box-shadow: 2px 5px #C4D7E0;
    }
    .left_side {
        position: relative;
        left: 850px;
    }
    main {
        margin: 5px;
        /* background-color: #B2C8DF; */
    }
    h1,h2 {
        /* color: #1C3879; */
        padding: 10px;
    }
    .content {
        text-align: justify;
        margin: 5px 10px 5px 10px;
    }
    p {
        padding: 5px;
        margin: 5px;
        font-size: 16px;
    }
    textarea {
        width: 600px;
        height: 80px;
        padding: 5px;
    }
    form input[type='submit'] {
        margin-top: 5px;
        display: block;
        background-color: #6E85B7;
        border-radius: 5px;
        color: white;
        padding: 5px;
    }
    form input[type='submit']:hover {
        background-color: #C4D7E0;
        color: blue;
    }
    h3, p{
        margin-left: 25px;
        /* font-size: 16px; */
    }
    h3, h2, h6{
        font-size: 18px;
        margin-top: 25px;
    }
    form.reply_form {
        margin-left: 30px;
    }
    section {
        border: 1px solid black;
        padding: 15px;
        margin-top: 10px;
    }
    .error {
        font-size: 11px;
        text-align: center;
        color: red;
        height: 10px;
        margin: 1px 20px;
        background-color: #C4D7E0;
    }
    .success {
        font-size: 11px;
        text-align: center;
        color: green;
        height: 10px;

        background-color: #C4D7E0;
    }
</style>
        <div class="py-1 bg-primary text-center">
            <div class="container text-justify">
                    <?= $product['name']; ?>
                <nav aria-label="breadcrumb" >
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item" >
                            <a href="index.php" class="text-dark">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="categories.php" class="text-dark">Collections</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" class="text-dark"><?= $product['name']; ?></a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>  
        <div class="bg-light py-5">
            <div class="container product_data margin-4">
                <div class="row">
                    <div class="col-md-6 col-lg-4">
                        <div class="shadow">

                        <div class="exzoom" id="exzoom">
                            <!-- Images -->
                            <div class="exzoom_img_box">
                                <ul class='exzoom_img_ul'>
                                    <?php
                                    // $i="";
                                    $res=$product['image'];
                                    $res=explode(" ",$res);
                                    $count=count($res) + 1;
                                    for($i=0;$i<$count;++$i)
                                    {
                                    ?>
                                <li><img src="uploads/<?=$res[$i];?>" class="exzoom-gallery"></li>
                                <?php }?>
                                </ul>
                            </div>
                            <div class="exzoom_nav"></div>
                            <!-- Nav Buttons -->
                            <p class="exzoom_btn">
                                <a href="javascript:void(0);" class="exzoom_prev_btn"> < </a>
                                <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                            </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-8 shadow">
                        <h4 class="fw-bold pt-2"><?= $product['name']; ?>
                            <span class="float-end text-danger"><?php if($product['trending']) {echo "Trending"; } ?></span>
                        </h4>       
                        <hr>
                        <p><?= $product['small_description']; ?></p>
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
                        <div class="row mt-3 mb-2">
                            <div class="col-md-6">
                                <Span class="fst-italic mb-1 text-danger">Product not available*</Span>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                                <button class="btn btn-secondary addToCartbtn px-4" disabled><i class="fa fa-shopping-cart me-2"></i>SOLD OUT</button>
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
        } else{
            
?>
            <div class="bg-light py-4 mb-12  mt-3">
                <div class="container">
                        <div class="row w-100 p-3">
                            <div class="container product_data mt-3 text-center">
                            <p class="mb-5 font-weight-light">Product is not available right now.</p>
                            <a href="index.php" class="btn btn-warning"> <i class="fa fa-reply"></i> Back</a>
                        </div>
                    </div>
                </div>
            </div>
<?php
        }
    } else {
        echo "Something went wrong";
    }
?>
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Leave a Review</h2>
                <?php if (isset($_SESSION['auth_user'])) { // Check if user is logged in ?>
                    <form action="functions/process.php" method="POST">
                        <input type="hidden" name="action" value="create_message" />
                        <textarea name="message" placeholder="Post a Review"></textarea>
                        <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                        <input type="submit" value="Create a review" />
                    </form>
                <?php } else { ?>
                    <p>You need to <a href="login.php">login</a> to leave a review.</p>
                    <?php
                        $reviews = fetchAllReviews($product['id']);
                        if (mysqli_num_rows($reviews) > 0) {
                            while ($data = mysqli_fetch_assoc($reviews)) {
                                ?>
                                <h6><?= $data['name']; ?> (<?= date("l, j F Y, h:i A", strtotime($data["created_at"])) ?>)</h6>
                                <p><?= $data['review']; ?></p>
                <?php
                                $replies = fetchAllReplies($product['id']);
                                if (mysqli_num_rows($replies) > 0) {
                                    while ($reps = mysqli_fetch_assoc($replies)) {
                ?>
                                        <h6><?= $reps['name']; ?> (<?= date("l, j F Y, h:i A", strtotime($reps["created_at"])) ?>)</h6>
                                        <p><?= $reps['reply']; ?></p>
                <?php
                                    }
                                }
                            }
                        }
                    ?>
                <?php } ?>
                <div>
                    <?php
                    if (isset($_SESSION['auth_user'])) {
                        $reviews = fetchReview($product['id']);
                        if (mysqli_num_rows($reviews) > 0) {
                            while ($data = mysqli_fetch_assoc($reviews)) {
                                ?>
                                <h6><?= $data['name']; ?> (<?= date("l, j F Y, h:i A", strtotime($data["created_at"])) ?>)</h6>
                                <p><?= $data['review']; ?></p>
                                <?php
                                $replies = fetchReplies($product['id']);
                                if (mysqli_num_rows($replies) > 0) {
                                    while ($reps = mysqli_fetch_assoc($replies)) {
                                        ?>
                                        <h6><?= $reps['name']; ?> (<?= date("l, j F Y, h:i A", strtotime($reps["created_at"])) ?>)</h6>
                                        <p><?= $reps['reply']; ?></p>
                                        <?php
                                    }
                                }
                                ?>
                                <form class="reply_form" action="functions/process.php" method="POST">
                                    <input type="hidden" name="action" value="create_reply" />
                                    <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                                    <input type="hidden" name="review_id" value="<?= $data['review_id']; ?>" />
                                    <textarea name="reply" placeholder="Post a reply"></textarea>
                                    <input type="submit" value="Reply" />
                                </form>
                                <?php
                            }
                        } else {
                            echo "No reviews found.";
                        }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Leave you feedback</h4>
                <div>
                    <p><i>Please help us to serve you better by taking a couple of minutes.</i> </p>
                </div>
                <div class="col-md-6">                
                    <button type="button" class="btn btn-warning px-5 " data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="FORM">FEEDBACK FORM</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Product you may like</h4>
                <div class="underline mb-2  d-grid align-items-stretch"></div>
                <hr>
                <div class="owl-carousel">
                    <?php
                        $trendingProducts = getAllTrending();
                        if(mysqli_num_rows($trendingProducts) >  0) {
                            foreach($trendingProducts as $item) {
                                ?>
                                <div class="mb-2 item">
                                    <a href="product_view.php?product=<?= $item['slug']; ?>">
                                        <div class="card shadow">
                                            <div class="card-body">
                                        <?php 
                                            $image_array = array($item['image']);
                                            $first_image = explode(' ', $image_array[0])[0];
                                        ?>
                                                <img src="./uploads/<?= $first_image; ?>" alt="Product Image"  style="width: 100px; height: 100px;" class="img-thumbnail rounded mx-auto d-block">
                                                <label class="text-center" style="font-size: 13px;"><small></small><?= $item['name']; ?></label>
                                            </div>
                                        </div>
                                    </a>
                                </div>                                              
                            <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">FEEDBACK FORM</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <h6>How satisfied were you with our product?</h6>
            <form action="process_feedback.php" method="POST">
                <div >
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" style="background-color: green;">Excellent</th>
                            <th scope="col" style="background-color: lightgreen;">Good</th>
                            <th scope="col" style="background-color: yellow;">Neutral</th>
                            <th scope="col" style="background-color: orange;">Poor</th>
                            <th scope="col" style="background-color: red;">Strongly Disagree</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="radio" name="feedback" value="1"  required style="width: 15px;"></td>
                            <td><input type="radio" name="feedback" value="2" style="width: 15px;"></td>
                            <td><input type="radio" name="feedback" value="3" style="width: 15px;"></td>
                            <td><input type="radio" name="feedback" value="4" style="width: 15px;"></td>
                            <td><input type="radio" name="feedback" value="5" style="width: 15px;"></td>
                        </tr>
                    </tbody>
                </table>
                </div>
                <div class="dropdown-divider"></div>
                    <div class="row">
                        <div class="col-md-5">
                            <label class="mb-0">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="gender">Gender</label>
                            <select class="form-select" id="gender" name="gender" required>
                                <option >---</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="mb-0">Age</label>
                            <input type="text" name="age" class="form-control" required>
                        </div>
                    </div>
                <div class="mb-3">
                    <label for="email" class="col-form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="suggestions" class="col-form-label">Any Suggestions?</label>
                    <textarea class="form-control" id="suggestions" name="suggestions"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="submitFormBtn" name="submitFormBtn">Click Submit</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<script>
  // Submit form using AJAX
$(document).ready(function() {
    $('#submitFormBtn').click(function(e) {
      e.preventDefault(); // Prevent default form submission behavior
      // Serialize form data
        var formData = $('form').serialize();

      // Send AJAX request
        $.ajax({
            type: 'POST',
            url: 'functions/process_feedback.php',
            data: formData,
            success: function(response) {
            // Handle the response from process_feedback.php if needed

            // Close the modal
            $('#exampleModal').modal('hide');

            // Optionally, you can show a success message or perform other actions
            //   alert('Feedback submitted successfully!');

            // Reload the page to refresh the content
            location.reload();
            },
            error: function(xhr, status, error) {
            // Handle AJAX errors if needed
            console.error(xhr.responseText);
            }
        });
        });
});
</script>
<script >
    //This is to limit the add button of increment at dicrement that equal to quantity
$(document).ready(function() {
    // Get the available quantity
    var availableQty = $product['qty'];
    
    // Get the quantity input element
    var qtyInput = $(".input_qty");
    
    // Get the increment and decrement buttons
    var incrementBtn = $(".increment-btn");
    var decrementBtn = $(".decrement-btn");
    
    // Set the initial value of the quantity input
    qtyInput.val("1");
    
    // Disable the decrement button if the initial quantity is 1
    if (qtyInput.val() == "1") {
        decrementBtn.prop("disabled", true);
    }
    
    // Increment button click event
    incrementBtn.on("click", function() {
        // Get the current quantity value
        var qty = parseInt(qtyInput.val());
        
        // Check if the available quantity has been reached
        if (qty < availableQty) {
            // Increment the quantity value
            qty++;
            
            // Set the new quantity value
            qtyInput.val(qty);
            
            // Enable the decrement button
            decrementBtn.prop("disabled", false);
            
            // Disable the increment button if the available quantity has been reached
            if (qty == availableQty) {
                incrementBtn.prop("disabled", true);
            }
        }
    });
    
    // Decrement button click event
    decrementBtn.on("click", function() {
        // Get the current quantity value
        var qty = parseInt(qtyInput.val());
        
        // Check if the quantity is greater than 1
        if (qty > 1) {
            // Decrement the quantity value
            qty--;
            
            // Set the new quantity value
            qtyInput.val(qty);
            
            // Enable the increment button
            incrementBtn.prop("disabled", false);
            
            // Disable the decrement button if the quantity is 1
            if (qty == 1) {
                decrementBtn.prop("disabled", true);
            }
        }
    });
});
</script>    
<?php  
    include('footer_information.php');
?>


