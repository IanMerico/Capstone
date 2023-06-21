<?php 
     $titlePages = "Reset your password";
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
                        <!-- <strong>Hey!</strong>  -->
                        <?= $_SESSION['message']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>                    
<?php   
                    unset($_SESSION['message']);
                    }
?>
                    <div class="card shadow-lg p-3 mb-5 bg-body rounded">

                    <div class="card-header bg-lightgrey p-2 text-dark bg-opacity-10">
                            <h4 class="text-left">Reset password</h4>
                            <!-- <p class="text-center mb-1"><small>your e-mail and password:</small></p> -->
                        </div>
                        <div class="card-body mt-2">
                            <form action="functions/password-reset-email.php" method="POST">
                                <div class="form-group mb-2 mt-2 form-field input-icons">
                                    <div class="form-field">
                                        <label for="exampleInputEmail1" class="form-label mb-2">Reset password &nbsp;<span id="error_email" class="error"></span></label>
                                        <i class="fa-solid fa-envelope icon"></i><input type="email" name="email" class="form-control mb-2" placeholder="E-mail" id="email" aria-describedby="emailHelp">
                                    </div>
                                </div>
                                <div class="form-group col-6 mb-4">
                                    <button type="submit" name="action" value="resetPassword" id="btnLogin" class="btn  mt-2 form-control">Reset password send link</button>
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



