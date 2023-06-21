<?php 

    $titlePages = "Register";
    session_start();
    include('includes/header.php');

    if(isset($_SESSION['auth'])) {
        $_SESSION['message'] = "You are already logged In";
        header('Location: index.php');
        exit(0);
    }
    
    
?>
    <div class="py-5 bg-gradient-warning text-dark">
        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-md-9">
<?php
                    if(isset($_SESSION['message'])) {
?>       
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Hey!</strong> <?= $_SESSION['message']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>                    
<?php   
                    unset($_SESSION['message']);
                    }
?>
                    <div class="card shadow-lg p-3 mb-5 bg-body rounded">
                        <div class="card-header bg-lightgrey p-2 text-dark bg-opacity-10">
                            <h4 class="text-center">Register to create an account</h4>
                        </div>
                        <div class="card-body">
                            <form action="functions/authcode.php" method="POST" class="form" id="form" >
                                <div class="row">   
                                    <div class="form-group mb-2 mt-2 form-field">
                                        <div class="form-field">
                                            <label class="form-label">First name*&nbsp;<span id="error_name" class="error"></span></label>
                                            <input type="text" name="name" id="name" class="form-control" autocomplete="off" >
                                        </div>
                                    </div>
                                    <div class="mb-2 mt-2 form-field">
                                        <div class="form-field">
                                            <label class="form-label">Last name*&nbsp;<span id="error_lname" class="error"></span></label>
                                            <input type="text" name="lname" id="lname" class="form-control" autocomplete="off">    
                                        </div>      
                                    </div>
                                    <div class="mb-2 mt-2 form-field input-icons">
                                        <div class="form-field">
                                            <label for="exampleInputEmail1" class="form-label">Email address*&nbsp;<span id="error_email" class="form-text invalid-feedback error"></span></label>
                                            <i class="fa-solid fa-envelope icon"></i><input type="email" name="email" id="email" class="form-control" aria-describedby="emailHelp" autocomplete="off" required > 
                                        </div>
                                    </div>
                                    <div class="mb-2 mt-2 form-field input-icons">
                                        <div class="form-field">
                                            <label for="exampleInputPassword1" class="form-label">Password*&nbsp;<span id="error_password" class="error"></span></label>
                                            <i class="fa-solid fa-eye icon " id="eye" aria-hidden="true"></i><input type="password" name="password" id="password" class="form-control password" autocomplete="off" required  >
                                        </div>
                                    </div>
                                    <div class="mb-2 mt-2 form-field input-icons">
                                        <div class="form-field">
                                            <label class="form-label">Password confirmation*&nbsp;<span id="error_confirm_password" class="error"></span></label>
                                            <i class="fa-solid fa-eye icon1 " id="eye1" aria-hidden="true"></i><input type="password" name="confirm_password" id="confirm_password" class="form-control confirm_password" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="md-form md-outline input-with-post-icon datepicker col-6 mb-2 mt-2 form-group">
                                        <div class="form-field">
                                            <label class="form-label">Birthdate*&nbsp; <span id="error_date" class="error"><small></small></span></label>
                                            <input placeholder="Select date" type="date" name="birthdate" id="example" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group col-6 mb-2 mt-2 form-field">
                                        <label class="form-label">Gender*&nbsp;<span id="error_gender" class="error"><small></small></span></label>
                                            <select class="form-select" name="sex" id="sex" required>
                                                <option value="" selected hidden>-- choose option --</option>
   <?php                                           $gender = array('Male','Female','Others');                  
                                                    foreach($gender as $sex) {
    ?>   
                                                <option value="<?= $sex; ?>"><?= $sex; ?></option>                          
    <?php                                           }
    ?> 
                                            </select>
                                    </div>
                                    <div class="form-group mb-2 mt-2 form-field">
                                        <div class="form-field">
                                            <label class="form-label">Street address*&nbsp;<span id="errorAddress" class="error"></span></label>
                                            <input type="text" name="street_address" id="street_address" class="form-control" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="form-group  mb-2 mt-2 form-field">
                                        <div class="form-field">
                                            <label class="form-label">Barangay*&nbsp; <span id="error_brgy" class="error"></span></label>
                                            <input type="text" name="barangay" id="barangay" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-2 mt-2 form-field">
                                        <label class="form-label">State / Province* &nbsp;<span id="errorProvince" class="error"></span></label>
                                            <select class="form-select" name="province" id="province" required>
                                                <option value="" selected hidden>Choose option</option>
    <?php                                           $province = array('Abra','Agusan del Norte','Aklan','Albay','Antique','Apayao','Aurora','Basilan','Bataan','Batanes','Batangas','Benguet','Biliran','Bohol','Bukidnon','Bulacan','Cagayan','Camarines Norte','Camarines Sur','Camiguin','Capiz','Catanduanes','Cavite','Cebu','Cotabato','Davao Occidental','Davao Oriental','Davao de Oro','Davao del Norte','Davao del Sur','Dinagat Islands','Eastern Samar','Guimaras','Ifugao','Ilocos Norte','Ilocos Sur','Iloilo','Isabela','Kalinga','La Union','Laguna','Lanao del Norte','Lanao del Sur','Leyte','Maguindanao','Marinduque','Masbate','Metro Manila','Misamis Occidental','Misamis Oriental','Mountain Province','Negros Occidental','Negros Oriental','Northern Samar','Nueva Ecija','Nueva Vizcaya','Occidental Mindoro','Oriental Mindoro','Palawan','Pampanga','Pangasinan','Nueva Ecija','Quezon','Quirino','Rizal','Romblon','Samar','Sarangani','Siquijor','Sorsogon','South Cotabato','Southern Leyte','Sultan Kudarat','Sulu','Surigao del Norte','Surigao del Sur','Tarlac','Tawi-Tawi','Zambales','Zamboanga Sibugay');                  
                                                    foreach($province as $provinces) {
    ?>      
                                                <option value="<?= $provinces; ?>"><?= $provinces; ?></option>                          
    <?php                                           }
    ?>
                                            </select>
                                    </div>
                                    <div class="form-group col-md-4 mb-2 mt-2 ">
                                        <div class="form-field">
                                            <label class="form-label">City* &nbsp;<span id="city_Error" class="error"></span></label>
                                            <input type="text" name="city" id="city" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mb-2 mt-2 form-field">
                                        <div  class="form-field">
                                            <label >Zip / Postal code* &nbsp;<span id="zipcodeError" class="error"></label>
                                            <input type="text" name="zipcode" id="zipcode" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 mt-2 form-field">
                                        <div class="form-field">
                                            <label class="form-label">Phone number* &nbsp;<span id="phoneError" class="error"></span></label>
                                            <input type="text" name="phone" id="phone" class="form-control" required>
                                        </div>
                                    </div>  
                                    <div class="form-check mb-3 mt-2">
                                        <input class="form-check-input" type="checkbox" name="agreement" value="AcceptTermsandCondition" id="flexCheckChecked" required>
                                        <label class="form-check-label" for="flexCheckChecked">
                                            I agree to the &nbsp;<a href="terms&conditions.php" target="_blank">terms and conditions.</a>
                                        </label>
                                    </div>
                                    <div>
                                        <a href="register.php" class="btn col-md-3 mb-2 mt-2 me-3">Reset</a>
                                        &nbsp;
                                        <button type="submit" id="submitbtn" name="action" value="register_btn" class="btn form-group col-md-5     mb-2 mt-2">Create account</button>
                                    </div>                       
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include('footer_information.php'); ?>
<?php include('includes/footer.php'); ?>

