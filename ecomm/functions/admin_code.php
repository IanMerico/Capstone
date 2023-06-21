<?php
    // session_start();
    include('admin/config/dbconn.php');
    // include('../config/dbcon.php');
    include('myfunctions.php');

    if(isset($_POST['action']) && $_POST['action'] === 'adminLogin') {

        $usernameAdmin = mysqli_real_escape_string($con, $_POST['username']);
        $passwordAdmin = mysqli_real_escape_string($con, $_POST['password']);

        // $loginQuery = "SELECT * FROM admin WHERE username='$usernameAdmin' AND password='$passwordAdmin' LIMIT 1";
        $loginQuery = "SELECT * FROM admin WHERE username='$usernameAdmin' AND password='$passwordAdmin' LIMIT 1;";

        $loginQuery_run = mysqli_query($con, $loginQuery);

        if(mysqli_num_rows($loginQuery_run) > 0) {

            

            $data = mysqli_fetch_array($loginQuery_run);
            $verifyStats = $data['verifyStats'];

            if($verifyStats == '1' || $verifyStats == '2'){
                
                $_SESSION['auth'] = true; //This is use for authenthication
                $userid = $data['id'];
                $fname = $data['name'];
                $username = $data['username'];
                $role_as = $data['role_as'];

                $_SESSION['auth_user'] = [
                    'id' => $userid,
                    'name' => $fname,
                    'username' => $username
                ];

            
                $_SESSION['role_as'] = $role_as;

            if($role_as == 1) {

                // $_SESSION['message'] = "Welcome to dashboard";
                // header('Location: ../admin/index.php');
                redirect("../admin/index.php", "Welcome to Dashboard");
                // exit(0);

            } elseif ($role_as == 2) {

                // $_SESSION['message'] = "Welcome to dashboard";
                redirect("../staff/index.php", "Welcome to Dashboard");
                // exit(0);
            } else {

                $_SESSION['message'] = "Something went wrong!";
                header('Location: ../admin-login.php');
                exit(0);

            }

        } else {

            $_SESSION['message'] = "Incorrect username and password";
            header('Location: ../admin-login.php');
            exit(0);

        }


        } else {

            $_SESSION['message'] = "Incorrect username and password";
            header('Location: ../admin-login.php');
            exit(0);

        }
        

    } else {
        $_SESSION['message'] = "You are not allowed  to access this file.";
        header('Location: ../admin-login.php');
        exit(0);
    }

    if (isset($_GET['action']) && $_GET['action'] === 'logout') {
        // Destroy the session and unset session variables

        session_destroy();
        unset($_SESSION['auth']);
        unset($_SESSION['auth_user']);
        unset($_SESSION['role_as']);

        // Redirect the user to the login page or any other appropriate page

        header('Location: ../admin-login.php');
        exit(0);
    }

?>
