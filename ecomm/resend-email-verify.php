<?php 
     $titlePages = "Resend email verification";
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
                    <div class="alert alert-Success alert-dismissible fade show" role="alert">
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
                            <!-- <h4 class="text-center">Login to my account</h4> -->
                            <p class="mb-1">Email will resend for verification</p>
                        </div>
                        <div class="card-body mt-2">
                            <form action="functions/verify-resendmail.php" method="POST">
                                <div class="form-group mb-2 mt-2 form-field input-icons">
                                    <div class="form-field">
                                        <label for="exampleInputEmail1" class="form-label mb-2">Resend email verification* &nbsp;<span id="error_email" class="error"></span></label>
                                        <i class="fa-solid fa-envelope icon"></i><input type="email" name="email" class="form-control mb-2" placeholder="E-mail" id="email" aria-describedby="emailHelp">
                                    </div>
                                </div>
                                <div class="form-group col-6 mb-4">
                                    <button type="submit" name="action" value="verifyEmail" id="btnLogin" class="btn  mt-2 form-control">Send </button>                                   
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



