<?php 
    $titlePages = "Login";
    session_start();
    include('includes/header.php');

    if(isset($_SESSION['auth'])) {
        $_SESSION['message'] = "You are already logged In";
        header('Location: index.php');
        exit(0);
    }
?>
        <div class="container-fluid py-5">
            <div class="row justify-content-center ">
                <div class="col-md-7 col-lg-6 col-xl-5">
<?php
                    if(isset($_SESSION['message'])) {
?>       
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $_SESSION['message']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>                    
<?php   
                    unset($_SESSION['message']);
                    }
?>
                    <div class="card shadow-lg p-3 mb-5 bg-body rounded">
                        <div class="card-header bg-lightgrey p-2 text-dark bg-opacity-10">
                            <h4 class="text-center">Login to my account</h4>
                            <p class="text-center mb-1"><small>your e-mail and password:</small></p>
                        </div>
                        <div class="card-body mt-2">
                            <form action="functions/authcode.php" method="POST">
                                <div class="form-group mb-2 mt-2 form-field input-icons">
                                    <div class="form-field">
                                        <label for="exampleInputEmail1" class="form-label">&nbsp;<span id="error_email" class="error"></span></label>
                                        <i class="fa-solid fa-envelope icon"></i><input type="email" name="email" class="form-control" placeholder="E-mail" id="email" aria-describedby="emailHelp">
                                        <?php if(isset( $error)) {?>
                                            <span><?php echo $error; ?></span>
                                        <?php }?>
                                    </div>
                                </div>
                                <div class="form-group mb-4 mt-2 input-icons">
                                    <div class="form-field">
                                        <label for="exampleInputPassword1" class="form-label">&nbsp;<Span id="error_password" class="error"></Span></label>
                                        <i class="fa-solid fa-eye icon" id="eye2" aria-hidden="true"></i><input type="password" name="password" class="form-control mb-3" placeholder="Password" id="password">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="form-group col-5 mb-4">
                                        <button type="submit" name="action" value="login_value" id="btnLogin" class="btn mb-2 form-control">Login</button>
                                    </div>
                                    <div>
                                        <a href="password-reset.php" >Forgot your password?</a>
                                    </div>
                                </div>
                                <div class="form-group mb-2">
                                    <label class="text-sm-left"><small>New customer? <a href="register.php">Create your account</a></small> </label>      
                                </div> 
                                <div class="form-group mb-2">
                                    <label class="text-sm-left"><small>Did you not receive the email verification? Click <a href="resend-email-verify.php">Resend</a></small> </label>
                                </div>
                            </form>
                        </div>
                        <div class="card bg-light mb-3" >
                            <div class="card-body">
                                <p class="text-justify"><small>By creating your account or signing in, you agree to our <a href="terms.php" target="_blank">Terms and Conditions</a> & <a href="policy.php" target="_blank">Privacy Policy.</a> </small> </p> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include('footer_information.php'); ?>
<?php include('includes/footer.php') ?>



