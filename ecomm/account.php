<?php 
    include('functions/userfunctions.php');
    $titlePages = "Account";
    include('includes/header.php'); 
    include('authenticate.php'); 
?>
    <div class="py-1 bg-primary text-center sticky-wrapper">
        <div class="container text-justify" >
            <nav aria-label="breadcrumb" >
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item" >
                        <a href="index.php" class="text-dark">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="account.php" class="text-dark">My Profile</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container py-1 sidebarx ml-3 responsive">
        <div class="card p-2 shadow-card">
            <div class="sidebar">
            <div>
                <a href="account.php?=profile" class="hover-underline-animation">My Profile</a> 
            </div>
            <div>
                <a href="password_change.php" class="hover-underline-animation">Change Password</a> 
            </div>
            <div>
                <a href="terms-of-services.php?=termsandconditions" class="hover-underline-animation">Terms and Conditions</a> 
            </div>
            <div>
                <a href="privacy-protection.php?=privacyandpolicy" class="hover-underline-animation">Privacy Policy</a>
            </div>
            </div>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="updateProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit profile information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                <form action="functions/profileUpdate.php" method="POST" class="form" id="form" >
                    <div class="row">   
<?php
                    $myProfile = getUserinfo();
                    foreach ($myProfile as $editprofile) {
?>
                        <div class="form-group mb-2 mt-2 form-field">
                            <div class="form-field">
                                <label class="form-label">First name&nbsp;<span id="error_name" class="error"></span></label>
                                <input type="text" name="name" id="name" value="<?= $editprofile['name'];?>" class="form-control" autocomplete="off" >
                            </div>
                        </div>
                        <div class="mb-2 mt-2 form-field">
                            <div class="form-field">
                                <label class="form-label">Last name&nbsp;<span id="error_lname" class="error"></span></label>
                                <input type="text" name="lname" id="lname" value="<?= $editprofile['lname'];?>"  class="form-control" autocomplete="off">    
                            </div>      
                        </div>
                        <div class="mb-2 mt-2 form-field input-icons">
                            <div class="form-field">
                                <label for="exampleInputEmail1" class="form-label">Email address&nbsp;<span id="error_email" class="form-text invalid-feedback error"></span></label>
                                <i class="fa-solid fa-envelope icon"></i><input type="email" name="email" id="email" value="<?= $editprofile['email'];?>" class="form-control" aria-describedby="emailHelp" autocomplete="off" required > 
                            </div>
                        </div>
                        <div class="md-form md-outline input-with-post-icon datepicker col-6 mb-2 mt-2 form-group">
                            <div class="form-field">
                                <label class="form-label">Birthdate&nbsp; <span id="error_date" class="error"><small></small></span></label>
                                <input placeholder="Select date" type="date" name="birthdate" id="example" value="<?= $editprofile['birthdate'];?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group col-6 mb-2 mt-2 form-field">
                            <label class="form-label">Gender&nbsp;<span id="error_gender" class="error"><small></small></span></label>
                            <select class="form-select" name="sex" id="sex" required>
                                <option value="<?= $editprofile['sex'];?>" selected hidden><?= $editprofile['sex'];?></option>
<?php                                    
                                    $gender = array('Male','Female','Others');                  
                                    foreach($gender as $sex) {
?>   
                                    <option value="<?= $sex; ?>"><?= $sex; ?></option>                          
<?php                                           
                                    }
?> 
                            </select>
                        </div>
                        <div class="form-group mb-2 mt-2 form-field">
                            <div class="form-field">
                                <label class="form-label">Street address&nbsp;<span id="errorAddress" class="error"></span></label>
                                <input type="text" name="street_address" value="<?= $editprofile['street_address'];?>" id="street_address" class="form-control" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="form-group  mb-2 mt-2 form-field">
                            <div class="form-field">
                                <label class="form-label">Barangay&nbsp; <span id="error_brgy" class="error"></span></label>
                                <input type="text" name="barangay" id="barangay" value="<?= $editprofile['barangay'];?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group  mb-2 mt-2 form-field">
                            <label class="form-label">State / Province &nbsp;<span id="errorProvince" class="error"></span></label>
                            <select class="form-select" name="province" id="province" required>
                                <option value="<?= $editprofile['province'];?>" selected hidden><?= $editprofile['province'];?></option>
<?php                                           
                                    $province = array('Abra','Agusan del Norte','Aklan','Albay','Antique','Apayao','Aurora','Basilan','Bataan','Batanes','Batangas','Benguet','Biliran','Bohol','Bukidnon','Bulacan','Cagayan','Camarines Norte','Camarines Sur','Camiguin','Capiz','Catanduanes','Cavite','Cebu','Cotabato','Davao Occidental','Davao Oriental','Davao de Oro','Davao del Norte','Davao del Sur','Dinagat Islands','Eastern Samar','Guimaras','Ifugao','Ilocos Norte','Ilocos Sur','Iloilo','Isabela','Kalinga','La Union','Laguna','Lanao del Norte','Lanao del Sur','Leyte','Maguindanao','Marinduque','Masbate','Metro Manila','Misamis Occidental','Misamis Oriental','Mountain Province','Negros Occidental','Negros Oriental','Northern Samar','Nueva Ecija','Nueva Vizcaya','Occidental Mindoro','Oriental Mindoro','Palawan','Pampanga','Pangasinan','Nueva Ecija','Quezon','Quirino','Rizal','Romblon','Samar','Sarangani','Siquijor','Sorsogon','South Cotabato','Southern Leyte','Sultan Kudarat','Sulu','Surigao del Norte','Surigao del Sur','Tarlac','Tawi-Tawi','Zambales','Zamboanga Sibugay');                  
                                    foreach($province as $provinces) {
?>      
                                    <option value="<?= $provinces; ?>"><?= $provinces; ?></option>                          
<?php                                           
                                    }
?>
                            </select>
                        </div>
                        <div class="form-group col-md-6 mb-2 mt-2 ">
                            <div class="form-field">
                                <label class="form-label">City &nbsp;<span id="city_Error" class="error"></span></label>
                                <input type="text" name="city" id="city" value="<?= $editprofile['city'];?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6 mb-2 mt-2 form-field">
                            <div  class="form-field">
                                <label >Zip / Postal code &nbsp;<span id="zipcodeError" class="error"></label>
                                <input type="text" name="zipcode" id="zipcode" value="<?= $editprofile['zipcode'];?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group mb-3 mt-2 form-field">
                            <div class="form-field">
                                <label class="form-label">Phone number &nbsp;<span id="phoneError" class="error"></span></label>
                                <input type="text" name="phone" id="phone" value="<?= $editprofile['phone'];?>" class="form-control" required>
                            </div>
                        </div>     
<?php 
                    } 
?>
                    </div>
                </div>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="submitbtn" id name="action" value="updateProfile" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="body-text ">
<!-- body content -->
    <div class="container py-3 mr-3 responsive">
        <div class="card">
            <div class="card-body pp1 response-area">
                
                <h1 class="myProfile">My Profile</h1>
                <p>Manage your account</p>
                <hr class="border mb-3">
                <form action="">
<?php
                    $myAccount = getUserinfo();
                    foreach ($myAccount as $profileInfo) {

?>
                    <div class="profile">
                        <span for="" class="labelName" style="padding: 0px 6px 0px 0px;">First name:</span> 
                            <input type="text" name="name" value="<?= $profileInfo['name'];?> " disabled>
                        <span for="" class="labelName" style="padding: 0px 6px 0px 0px;">Last name:</span> 
                            <input type="text" name="lname" value="<?= $profileInfo['lname'];?>" disabled>  
                        <p></p>
                    </div>
                    <div class="profile">
                        <span for="" class="labelName" style="padding: 0px 17px 0px 0px;">Birthdate:</span>
                            <input  type="text" name="birthdate" value="<?= $profileInfo['birthdate'];?>" disabled>
                        <span for="" class="labelName" style="padding: 0px 28px 0px 0px;">Gender:</span> 
                            <input type="text" name="sex" value="<?= $profileInfo['sex'];?>" disabled>
                        <p></p>
                    </div>
                    <div class="profile">
                        <span for="" class="labelName" style="padding: 0px 48px 0px 0px;">Email:</span> 
                            <input type="text" name="email" value="<?= $profileInfo['email'];?> " disabled>
                        <span for="" class="labelName" style="padding: 0px 28px 0px 0px;">Phone#</span> 
                            <input type="text" name="phone" value="<?= $profileInfo['phone'];?> " disabled>
                        <p></p>
                    </div>
                    <div class="profile" >
                        <span for="" class="labelName" style="padding: 0px 17px 0px 0px;">Address:#</span> 
                            <input type="text" name="street_address" value="<?= $profileInfo['street_address'];?> " style="width: 600px" disabled>
                        <p></p>
                    </div>
                    <div class="profile" >
                        <span for="" class="labelName" style="padding: 0px 17px 0px 0px;">Barangay:</span> 
                                <input type="text" name="barangay" value="<?= $profileInfo['barangay'];?>"  style="width: 600px" disabled>
                        <p></p>
                    </div>
                    <div class="profile" >
                        <span for="" class="labelName" style="padding: 0px 24px 0px 0px;">Province:</span> 
                            <input type="text" name="province" value="<?= $profileInfo['province'];?>"  style="width: 600px" disabled>
                        <p></p>
                    </div>
                    <div class="profile" >
                        <span for="" class="labelName" style="padding: 0px 61px 0px 0px;">City:</span> 
                            <input type="text" name="city" value="<?= $profileInfo['city'];?>"  style="width: 600px" disabled>
                        <p></p>
                    </div>
                    <div class="profile mb-3" >
                        <span for="" class="labelName" style="padding: 0px 25px 0px 0px;">Zip code:</span> 
                            <input type="text" name="zipcode" value="<?= $profileInfo['zipcode'];?>"  style="width: 600px" disabled>
<?php 
                        } 
?>
                    </div>
                </form>       
                <hr class="border mb-3">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#updateProfile">
                    Edit profile
                </button>
            </div>
        </div>
    </div>
<?php include('includes/footer.php') ?>