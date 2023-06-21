<?php
    session_start();
    include('config/dbcon.php');
    if(isset($_GET['token'])) {
        $token = $_GET['token'];
        $verify_query = "SELECT token, verifyStatus FROM users WHERE token='$token' LIMIT 1";
        $verify_query_run = mysqli_query($con, $verify_query);
        if(mysqli_num_rows($verify_query_run) > 0) {
            $row = mysqli_fetch_array($verify_query_run);
            // echo $row['$token'];
            if($row['verifyStatus'] == "0") {   
                $clicked_token = $row['token'];
                $updateQuery = "UPDATE users SET verifyStatus= '1' WHERE token='$clicked_token' LIMIT 1";
                $updateQuery_run = mysqli_query($con, $updateQuery);

                if($updateQuery_run) {

                    $_SESSION['message'] = "Your account has been verified successfully";
                    header("Location: login.php");
                    exit(0);

                } else {

                    $_SESSION['message'] = "Email verification failed!";
                    header("Location: login.php");
                    exit(0);
                }
            } else { 
                $_SESSION['message'] = "Email verified! Please, Log in.";
                header("Location: login.php");
                exit(0);
            }
        } else { 
            $_SESSION['message'] = "This token does not exsist";
            header("Location: login.php");
            exit(0);
        }
    } else { 
        $_SESSION['message'] = "Not Allowed to this page";
            header("Location: login.php");
            exit(0);
    }
?>