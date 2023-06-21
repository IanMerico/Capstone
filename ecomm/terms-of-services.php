<?php 
    include('functions/userfunctions.php');
    $titlePages = "Terms and Conditions";
    include('includes/header.php'); 
    include('authenticate.php'); 
?>
<body>
    <div class="py-1 bg-primary text-center">
        <div class="container text-justify">
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
                    <li class="breadcrumb-item">
                        <a href="terms-of-services.php" class="text-dark">Terms and Conditions</a>
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
    <div class="body-text">
    <!-- body content -->
    <?php include('terms.php'); ?>
    </div>
</body>
<?php include('includes/footer.php') ?>

