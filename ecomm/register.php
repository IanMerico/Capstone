<?php 
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
                <div class="col-md-8">
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
                        <div class="card-header bg-info p-2 text-dark bg-opacity-10">
                            <h4 class="text-center">Create An Account</h4>
                        </div>
                        <div class="card-body">
                            <form action="functions/authcode.php" method="POST">
                                <div class="row">
                                    <div class="form-group col-md-6 mb-2 mt-2">
                                        <label class="form-label">First name*</label>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6 mb-2 mt-2">
                                        <label class="form-label">Last name*</label>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                    <div class="mb-2 mt-2">
                                        <label for="exampleInputEmail1" class="form-label">Email address*</label>
                                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    </div>
                                    <div class="mb-2 mt-2">
                                        <label for="exampleInputPassword1" class="form-label">Password*</label>
                                        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                                    </div>
                                    <div class="mb-2 mt-2">
                                        <label class="form-label">Password confirmation*</label>
                                        <input type="password" name="confirm_password" class="form-control">
                                    </div>
                                    <div class="md-form md-outline input-with-post-icon datepicker col-6 mb-2 mt-2">
                                        <label class="form-label">Birthdate</label>
                                        <input placeholder="Select date" type="date" name="birthdate" id="example" class="form-control">
                                    </div>
                                    <div class="form-group col-6 mb-2 mt-2">
                                        <label class="form-label">Gender</label>
                                            <select class="form-select" name="gender">
                                                <option selected="selected">Choose option</option>
    <?php                                           $gender = array('Male','Female','Others');                  
                                                    foreach($gender as $sex) {
    ?>      
                                                <option value="<?= $sex; ?>"><?= $sex; ?></option>                          
    <?php                                           }
    ?>
                                            </select>
                                    </div>
                                    <div class="mb-2 mt-2">
                                        <label class="form-label">Street Address</label>
                                        <input type="text" name="street_address" class="form-control">
                                    </div>
                                    <div class="mb-2 mt-2">
                                        <label class="form-label">Barangay</label>
                                        <input type="text" name="barangay" class="form-control">
                                    </div>
                                    <div class="form-group col-4 mb-2 mt-2">
                                        <label class="form-label">State / Province</label>
                                            <select class="form-select" name="province">
                                                <option selected="selected">Choose option</option>
    <?php                                           $province = array('Abra','Agusan del Norte','Aklan','Albay','Antique','Apayao','Aurora','Basilan','Bataan','Batanes','Batangas','Benguet','Biliran','Bohol','Bukidnon','Bulacan','Cagayan','Camarines Norte','Camarines Sur','Camiguin','Capiz','Catanduanes','Cavite','Cebu','Cotabato','Davao Occidental','Davao Oriental','Davao de Oro','Davao del Norte','Davao del Sur','Dinagat Islands','Eastern Samar','Guimaras','Ifugao','Ilocos Norte','Ilocos Sur','Iloilo','Isabela','Kalinga','La Union','Laguna','Lanao del Norte','Lanao del Sur','Leyte','Maguindanao','Marinduque','Masbate','Metro Manila','Misamis Occidental','Misamis Oriental','Mountain Province','Negros Occidental','Negros Oriental','Northern Samar','Nueva Ecija','Nueva Vizcaya','Occidental Mindoro','Oriental Mindoro','Palawan','Pampanga','Pangasinan','Nueva Ecija','Quezon','Quirino','Rizal','Romblon','Samar','Sarangani','Siquijor','Sorsogon','South Cotabato','Southern Leyte','Sultan Kudarat','Sulu','Surigao del Norte','Surigao del Sur','Tarlac','Tawi-Tawi','Zambales','Zamboanga Sibugay');                  
                                                    foreach($province as $provinces) {
    ?>      
                                                <option value="<?= $provinces; ?>"><?= $provinces; ?></option>                          
    <?php                                           }
    ?>
                                            </select>
                                    </div>
                                    <div class="form-group col-md-4 mb-2 mt-2">
                                        <label class="form-label">City</label>
                                        <input type="text" name="city" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4 mb-2 mt-2">
                                        <label class="form-label">Zip / Postal code</label>
                                        <input type="text" name="zipcode" class="form-control">
                                    </div>
                                    <div class="mb-3 mt-2">
                                        <label class="form-label">Phone number</label>
                                        <input type="number" name="phone" class="form-control">
                                    </div>  
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" required>
                                        <label class="form-check-label" for="flexCheckChecked">
                                            I agree to the &nbsp;<a href="terms&conditions.php" target="_blank">terms and conditions.</a>
                                        </label>
                                    </div>
                                    <div>
                                        <a href="login.php" class="btn col-md-3 mb-2 mt-2 me-3">Cancel</a>
                                        &nbsp;
                                        <button type="submit" name="register_btn" class="btn form-group col-md-5     mb-2 mt-2">Create account</button>
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

