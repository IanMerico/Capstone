<?php
    include('../functions/myfunctions.php');

    if(isset($_SESSION['auth'])) {

        if($_SESSION['role_as'] != 1 ) {

            redirect("../index.php", "You are not authorized to access this page");
            // $_SESSION['message'] = "You are not authorized to access this page";
            // header('Location: ../index.php');

        } 

    } else {

        redirect("../login.php", "Login to continue");
        // $_SESSION['message'] = "Login to continue";
        // header('Location: ../login.php');
    }
    

?>