<?php 
    $titlePages = "accont settings";
    include('functions/userfunctions.php');
    include('includes/header.php');
    include('authenticate.php'); 
?>
<body>
    <div class="py-1 bg-primary text-center">
        <div class="container text-justify">
            <?= $category['name']; ?>
            <nav aria-label="breadcrumb" >
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item" >
                        <a href="index.php" class="text-white">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="account_settings.php" class="text-white">Account Settings</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="sidebar">
        <div>
            <a href="account.php?=profile">My Profile</a> 
        </div>
        <div>
            <a href="#">Change Password</a> 
        </div>
        <div>
            <a href="terms-of-services.php?=termsandconditions">Terms and Conditions</a> 
        </div>
        <div>
            <a href="privacy-protection.php?=privacyandpolicy">privacy_policy</a>
        </div>
    </div>
    <div class="body-text">
    <!-- body content -->
    </div>
</body>
<?php include('includes/footer.php') ?>