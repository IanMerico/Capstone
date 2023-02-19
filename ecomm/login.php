<?php 
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
                <div class="col-md-5">
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
                            <h4 class="text-center">Login to my account</h4>
                            <p class="text-center"><small>your e-mail and password:</small></p>
                        </div>
                        <div class="card-body mt-3">
                            <form action="functions/authcode.php" method="POST">
                                <div class="mb-4">
                                    <!-- <label for="exampleInputEmail1" class="form-label">Email address</label> -->
                                    <input type="email" name="email" class="form-control" placeholder="E-mail" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-4">
                                    <!-- <label for="exampleInputPassword1" class="form-label">Password</label> -->
                                    <input type="password" name="password" class="form-control mb-3" placeholder="Password" id="exampleInputPassword1">
                                    <!-- An element to toggle between password visibility -->
                                    <input type="checkbox" class="mx-1 form-check-input" onclick="myFunction()">Show Password
                                </div>
                                <button type="submit" name="login_btn" class="btn  mb-2 form-control">Login</button>
                                <div >
                                    <p class="text-sm-left">New customer? <a href="register.php">Create your account</a></p>
                                </div> 
                            </form>
                        </div>
                        <div class="card bg-light mb-3" >
                            <div class="card-body">
                                <p class="text-justify"><small>By creating your account or signing in, you agree to our <a href="">Terms and Conditions</a> & <a href="privacy_policy.php" target="_blank">Privacy Policy.</a> </small> </p> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include('footer_information.php'); ?>
<?php include('includes/footer.php') ?>



