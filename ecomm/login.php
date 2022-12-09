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
                        <div class="card-header">
                            <h4 class="text-center">Login Form</h4>
                        </div>
                        <div class="card-body">
                            <form action="functions/authcode.php" method="POST">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter your email" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Enter password" id="exampleInputPassword1">
                                </div>
                                <button type="submit" name="login_btn" class="btn btn-primary">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include('includes/footer.php') ?>

