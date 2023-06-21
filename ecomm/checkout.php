<?php 
    $titlePages = "Checkout";
    include('functions/userfunctions.php');
    include('includes/header.php');
    include('authenticate.php');
?>
<div class="py-1 bg-primary text-center">
    <div class="container text-justify">
        <nav aria-label="breadcrumb" >
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item" >
                    <a href="index.php" class="text-dark">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="checkout.php" class="text-dark">Checkout</a>
                </li>
            </ol>
        </nav>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="card">
            <div class="card-body shadow">
            <div class="card-header bg-primary mb-2">
                <span class="text-dark fs-4">Checkout order</span> 
                <a href="cart.php" class="btn btn-warning float-end"> <i class="fa fa-reply"></i> Back</a>
            </div>
                <form id="checkoutForm" action="functions/placeorder.php" method="POST">               
                    <div class="row textfontsize">                   
                        <div class="col-md-6">
                                <h5 class="text-center">Billing address</h5>
                                <hr>
<?php 
                                $info = getUserinfo();
                                foreach ($info as $infos) {
?>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold" >First name</label>
                                    <input type="text" name="name" id="name" value="<?= $infos['name']; ?>" placeholder="Enter your first name" class="form-control" required>
                                    <small class="text-danger name"></small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold" >Last name</label>
                                    <input type="text" name="lname" id="lname" value="<?= $infos['lname']; ?>" placeholder="Enter your last name" class="form-control" required>
                                    <small class="text-danger lname"></small>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="fw-bold" >E-mail</label>
                                    <input type="email" name="email" id="email" value="<?= $infos['email']; ?>" placeholder="Enter your email" class="form-control" required>
                                    <small class="text-danger email"></small>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="fw-bold" >Phone</label>
                                    <input type="text" name="phone" id="phone" value="<?= $infos['phone']; ?>" placeholder="Enter your phone number]" class="form-control" required>
                                    <small class="text-danger phone"></small>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="fw-bold" >Address</label>
                                    <input type="text" name="street_address" id="street_address" value="<?= $infos['street_address']; ?>" placeholder="Enter your address" class="form-control" required>
                                    <small class="text-danger street_address"></small>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="fw-bold" >Barangay</label>
                                    <input type="text" name="barangay" id="barangay" value="<?= $infos['barangay']; ?>" placeholder="Enter your barangay" class="form-control" required>
                                    <small class="text-danger barangay"></small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold" >Postal code</label>
                                    <input type="text" name="zipcode" id="zipcode" value="<?= $infos['zipcode']; ?>" placeholder="Enter your postal code" class="form-control" required>
                                    <small class="text-danger zipcode"></small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold" >City</label>
                                    <input type="text" name="city" id="city" value="<?= $infos['city']; ?>" placeholder="Enter City" class="form-control" required>
                                    <small class="text-danger city"></small>
                                </div>
                                <div class="form-group col-md-12 mb-2 mt-2 form-field">
                                    <label class="form-label fw-bold">State / Province* &nbsp;<span id="errorProvince" class="error"></span></label>
                                        <select class="form-select" name="province" id="province" required>
                                            <option value="<?= $infos['province']; ?>" selected hidden><?= $infos['province']; ?></option>
<?php                                           
                                                $infos = array('Abra','Agusan del Norte','Aklan','Albay','Antique','Apayao','Aurora','Basilan','Bataan','Batanes','Batangas','Benguet','Biliran','Bohol','Bukidnon','Bulacan','Cagayan','Camarines Norte','Camarines Sur','Camiguin','Capiz','Catanduanes','Cavite','Cebu','Cotabato','Davao Occidental','Davao Oriental','Davao de Oro','Davao del Norte','Davao del Sur','Dinagat Islands','Eastern Samar','Guimaras','Ifugao','Ilocos Norte','Ilocos Sur','Iloilo','Isabela','Kalinga','La Union','Laguna','Lanao del Norte','Lanao del Sur','Leyte','Maguindanao','Marinduque','Masbate','Metro Manila','Misamis Occidental','Misamis Oriental','Mountain Province','Negros Occidental','Negros Oriental','Northern Samar','Nueva Ecija','Nueva Vizcaya','Occidental Mindoro','Oriental Mindoro','Palawan','Pampanga','Pangasinan','Nueva Ecija','Quezon','Quirino','Rizal','Romblon','Samar','Sarangani','Siquijor','Sorsogon','South Cotabato','Southern Leyte','Sultan Kudarat','Sulu','Surigao del Norte','Surigao del Sur','Tarlac','Tawi-Tawi','Zambales','Zamboanga Sibugay');                  
                                                foreach($infos as $provinces) {
?>      
                                            <option value="<?= $provinces; ?>"><?= $provinces; ?></option>                          
<?php                                           
                                                }
?>
                                        </select>
                                    <small class="text-danger province"></small>
                                </div>                
                                </div>
                                    <div class="form-group col-12 mb-2 mt-2 form-field">
                                        <label class="form-label fw-bold">Country/Region&nbsp;<span id="error_gender" class="error"><small></small></span></label>
                                            <select class="form-select" name="country" id="country" required>
                                                <option value="Philippines" selected >Philippines</option>
                                            </select>
                                        <small class="text-danger country"></small>
                                    </div>
<?php  
                                    }
?>
                                </div>
                        <div class="col-md-6">
                            <h5 class="text-center">Order Details</h5>
                            <hr>
<?php 
                                $items = getCartItems();
                                $totalPrice = 0;
                                foreach ($items as $CartItem) {
?>
                                <div class="mb-1 border">
                                    <div class="row align-items-center">
                                        <div class="col-md-2">
<?php 
                                            $image_array = array($CartItem['image']);
                                            $first_image = explode(' ', $image_array[0])[0];
?>
                                            <img src="uploads/<?= $first_image; ?>" alt="Image" width="60px">
                                        </div>
                                        <div class="col-md-5">
                                            <label><?= $CartItem['name']; ?></label>
                                        </div>
                                        <div class="col-md-3">
                                            <label><?= number_format($CartItem['selling_price'],2); ?></label>
                                        </div>
                                        <div class="col-md-2">
                                            <label>x<?= $CartItem['prod_qty']; ?></label>
                                        </div>
                                    </div>
                                </div>
<?php
                                $totalPrice += $CartItem['selling_price'] *   $CartItem['prod_qty'] + $CartItem['fee'];    
                                }
?>
                            <hr>
                            <h6>Shipping Fee  : <span class="float-end fw-normal mb-2" >&#8369; <?= number_format($CartItem['fee'],2); ?></span></h6>
                            <h5>Total Price: <span class="float-end fw-bold mb-2">&#8369; <?= number_format($totalPrice,2) ?></span></h5>
                                <div class="col-md-12 mb-3">
                                    <label class="fw-lighter" >Add notes*(Optional only)</label>
                                    <textarea  name="comments"  class="form-control" row="5"></textarea>
                                </div>
                                <div class="class">
                                    <input type="hidden" name="payment_mode" value="COD">
                                    <button type="submit" name="placeOrderBtn" class="btn btn-primary w-100 mb-1">Confirm and place order | COD</button>
                                    <div id="paypal-button-container"></div>
                                </div> 
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include('includes/footer.php') ?>
    <script>
        paypal.Buttons({
            onclick(){
                var name = $('#name').val();
                var lname = $('#lname').val();
                var email = $('#email').val();
                var phone = $('#phone').val();
                var street_address = $('#street_address').val();
                var barangay = $('#barangay').val();
                var zipcode = $('#zipcode').val();
                var city = $('#city').val();
                var province = $('#province').val();
                var country = $('#country').val();
                var country = $('#comments').val();
                
                if(name.length == 0) {
                    $('.name').text("*This field cannot be empty!");
                    return false;
                } else {
                    $('.name').text("");
                }
                if(lname.length == 0) {
                    $('.lname').text("*This field cannot be empty!");
                    return false;
                }
                else {
                    $('.lname').text("");
                }
                if(email.length == 0) {
                    $('.email').text("*This field cannot be empty!");
                    return false;
                }
                else {
                    $('.email').text("");
                }
                if(phone.length == 0) {
                    $('.phone').text("*This field cannot be empty!");
                    return false;
                }
                else {
                    $('.phone').text("");
                }
                if(street_address.length == 0) {
                    $('.street_address').text("*This field cannot be empty!");
                    return false;
                }
                else {
                    $('.street_address').text("");
                }
                if(barangay.length == 0) {
                    $('.barangay').text("*This field cannot be empty!");
                    return false;
                }
                else {
                    $('.barangay').text("");
                }
                if(zipcode.length == 0) {
                    $('.zipcode').text("*This field cannot be empty!");
                    return false;
                }
                else {
                    $('.zipcode').text("");
                }
                if(city.length == 0) {
                    $('.city').text("*This field cannot be empty!");
                    return false;
                }
                else {
                    $('.city').text("");
                }
                if(province.length == 0) {
                    $('.province').text("*This field cannot be empty!");
                    return false;
                }
                else {
                    $('.province').text("");
                }
                if(country.length == 0) {
                    $('.country').text("*This field cannot be empty!");
                    return false;
                }
                else {
                    $('.country').text("");
                }
                if(name.length == 0 || lname.length == 0 || email.length == 0 || phone.length == 0 || street_address.length == 0 || barangay.length == 0 || zipcode.length == 0 || city.length == 0 || country.length == 0) {
                    return false;
                }
            },
            //Sets up the transaction when a payment button is clicked
            createOrder: (data, actions) => {
            //    console.log("create order");
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            // value: '<?= number_format($totalPrice,2) ?>'//Can also reference a variable or function
                            value: `1`
                        }
                    }]
                });
            },
            // Funalize the transaction after payer approval
            onApprove: (data, actions) => {
                return actions.order.capture().then(function(orderData) {
                    //successful capture! for dev/demo purposes:
                        // console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    //    console.log(orderData);
                    const transaction = orderData.purchase_units[0].payments.captures[0];
                    // alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available data`);
                    var id = $('#id').val();
                    var name = $('#name').val();
                    var lname = $('#lname').val();
                    var email = $('#email').val();
                    var phone = $('#phone').val();
                    var street_address = $('#street_address').val();
                    var barangay = $('#barangay').val();
                    var zipcode = $('#zipcode').val();
                    var city = $('#city').val();
                    var province = $('#province').val();
                    var country = $('#country').val();
                    // var country = $('#comments').val();
                    var data = {
                        'id' :id ,
                        'name' :name ,
                        'lname' :lname ,
                        'email' :email ,
                        'phone' :phone ,
                        'street_address' :street_address ,
                        'barangay' :barangay ,
                        'zipcode' :zipcode ,
                        'city' :city ,
                        'province' :province ,
                        'country' :country ,
                        // 'comments' :comments ,
                        'payment_mode' :"Paid by paypal" ,
                        'payment_id' :transaction.id, 
                        'placeOrderBtn': true
                    };
                    $.ajax({
                        method: "POST",
                        url: "functions/placeorder.php",
                        data: data,
                        success: function (response) {
                            if(response == 201) {
                            //    alert("success");
                                alertify.success("Order placed successfully!");
                                // actions.redirect('../my_orders.php');
                                window.location.href ='../my_orders.php';
                            //    window.location.replace('../my_orders.php');
                            }else {
                            alertify.success("Order placed successfully!");
                                // actions.redirect('../my_orders.php');
                                window.location.href ='my_orders.php';
                            }
                        }
                    });
                });
            }
        }).render('#paypal-button-container');
    </script>
        


