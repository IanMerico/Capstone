<?php 
    $titlePages = "Admin Login";
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- add icon link -->
        <link rel = "icon" href = "assets/images/297979668_103856492433245_4893127009659140128_n-removebg-preview.png" type = "image/x-icon">
        <!-- Bootstrap CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/custom.css" rel="stylesheet">
        <link href="assets/css/validate_style.css" rel="stylesheet">
        <link href="assets/css/owl.theme.default.min.css" rel="stylesheet">
        <link href="assets/css/owl.carousel.min.css" rel="stylesheet">
        <link type="text/css" href="assets/css/jquery.exzoom.css" rel="stylesheet">
        <link type="text/css" href="assets/css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <!-- DataTable CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
        <!-- DataTable CSS -->
        <script defer src="assets/js/activePage.js"></script>
        <title ><?php echo $titlePages; ?></title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cabin&display=swap" rel="stylesheet">
        <!-- Ionicons -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/simpleZoom.js"></script>
        <script defer type="text/javascript" src="assets/js/validation.js"></script>
        <script defer type="text/javascript" src="assets/js/validationLogin.js"></script>
        <script defer type="text/javascript" src="assets/js/validatepassChange.js"></script>
        <!-- Alertfy JS - CSS -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <!-- Bootstrap theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
        <!-- =============== -->
    </head>
<body>
    <div class="container-fluid bg-gradient-primary" style="height: 100vh; border-radius: 10px">
        <div class="container">
        <!-- Outer Row -->
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block" ><img src="admin/img/297742103_103857229099838_5903726466436299823_n.jpg" alt="" style="width:500px ; height:450px; border-top-left-radius: 10px; border-bottom-left-radius: 10px"></div>
                                    <div class="col-lg-6">
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
                                        <div class="p-5">
                                            <div class="text-center">
                                                <h1 class="h4 text-gray-900 mb-4">Welcome Admin!</h1>
                                            </div>
                                            <form action="functions/admin_code.php" method="POST" class="user">
                                                <div class="form-group mb-3">
                                                    <input type="text" name="username" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Username...">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                                </div>
                                                <div class="mb-3"></div>
                                                <button type="submit" name="action" value="adminLogin" id="btnLogin" class="btn btn-primary btn-user btn-block mb-2 form-control">Login</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include('includes/footer.php') ?>
