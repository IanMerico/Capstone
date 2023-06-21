<?php 
     $titlePages = "Reset Password";
    session_start();
    include('includes/header.php');
    if(isset($_SESSION['auth'])) {
        $_SESSION['message'] = "You are already logged In";
        header('Location: index.php');
        exit(0);
    }
?>
    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-md-7">
<?php
                    if(isset($_SESSION['message'])) {
?>       
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Hey!</strong> <?= $_SESSION['message']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>                    
<?php   
                    unset($_SESSION['message']);
                    }
?>
                    <div class="card shadow-lg p-3 mb-5 bg-body rounded">

                    <div class="card-header bg-lightgrey p-2 text-dark bg-opacity-10">
                            <h4 class="text-center">Reset password</h4>
                        </div>
                        <div class="card-body mt-2">
                        <form action="functions/password-reset-email.php" method="POST">
                                <div class="form-group mb-2 mt-2 form-field input-icons">
                                    <input type="hidden" name="password_token" value="<?php if(isset($_GET['token'])){echo $_GET['token'];} ?>">
                                    <div class="form-field">
                                        <label for="exampleInputEmail1" class="form-label mb-2">Update your new password* &nbsp;<span id="error_email" class="error"></span></label>
                                        <i class="fa-solid fa-envelope icon"></i><input type="email" name="email" value="<?php if(isset($_GET['email'])){echo $_GET['email'];} ?>" class="form-control mb-2" placeholder="E-mail" id="email" aria-describedby="emailHelp">
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
                                    <button type="submit" name="action" value="passwordUpdate" id="updateNewPassword" class="btn  mb-2 form-control">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include('footer_information.php'); ?>
<?php include('includes/footer.php') ?>



