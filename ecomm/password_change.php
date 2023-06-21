<?php 
    $titlePages = "Change Password";
    include('includes/header.php'); 
?>
<body>
    <div class="py-1 bg-primary text-center">
        <div class="container text-justify" >
            <nav aria-label="breadcrumb" >
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item" >
                        <a href="index.php" class="text-dark">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="account.php" class="text-dark">My Profile</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="password_change.php" class="text-dark">Reset Password</a>
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
    <div class="body-text ">
    <!-- body content -->
        <div class="container py-3 mr-3 responsive">
            <div class="card col-8">
                <div class="card-body pp1 response-area">
                    <!-- <div class="myProfile"> -->
                        <h3 class="myProfile">Change your password</h3>
                        <hr class="border mb-1">
                        <div class="card-body mt-1 p-1" >
                            <form action="functions/reset-password.php" method="POST">
                                <div class="form-group mb-2 mt-1 input-icons">
                                    <div class="form-field">
                                        <label for="exampleInputPassword1" class="form-label">&nbsp;<Span id="error_password" class="error"></Span></label>
                                        <i class="fa-solid fa-eye icon" id="eye2" aria-hidden="true"></i><input type="password" name="password" class="form-control mb-1" placeholder="Password" id="password" required>
                                    </div>
                                </div>
                                <div class="form-group mb-2 mt-1 input-icons">
                                    <div class="form-field">
                                        <label for="exampleInputPassword1" class="form-label">&nbsp;<Span id="error_newpassword" class="error"></Span></label>
                                        <i class="fa-solid fa-eye icon" id="eye3" aria-hidden="true"></i><input type="password" name="newpassword" class="form-control mb-1" placeholder="New Password" id="newpassword" required>
                                    </div>
                                </div>
                                <div class="form-group mb-2 mt-1 input-icons">
                                    <div class="form-field">
                                        <label for="exampleInputPassword1" class="form-label">&nbsp;<Span id="error_confirm_newpassword" class="error"></Span></label>
                                        <i class="fa-solid fa-eye icon" id="eye4" aria-hidden="true"></i><input type="password" name="confirm_newpassword" class="form-control mb-4" placeholder="Confirm New Password" id="confirm_newpassword" required>
                                    </div>
                                </div>
                                <div class="form-group col-3 mb-4">
                                    <button type="submit" name="action" value="passwordChange" id="updateNewPassword" class="btn  mb-2 form-control">Update</button>
                                </div>
                            </form>
                        </div>
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>
</body>
<?php include('includes/footer.php') ?>