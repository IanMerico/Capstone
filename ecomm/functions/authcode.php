<?php
    session_start();
    include('../config/dbcon.php');
    include('myfunctions.php');

    // This is for register button
    if(isset($_POST['register_btn'])) {
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $phone = mysqli_real_escape_string($con, $_POST['phone']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);

        
            //Check if email is already exist
            $check_email_query = "SELECT email FROM users WHERE email='$email'";
            $check_email_query_run = mysqli_query($con, $check_email_query);
            
            if(mysqli_num_rows($check_email_query_run) > 0) {

                $_SESSION['message'] = "Email already exist!";
                header('Location: ../register.php');

            }else {

        if($password == $confirm_password) {

            // Insert all the information directly to database
            $insert_query = "INSERT INTO users (name, email, phone, password, created_at, updated_at)
                                VALUES ('$name', '$email', '$phone', '$password', NOW(), NOW())";
            $insert_query_run = mysqli_query($con, $insert_query);

                if($insert_query_run) {

                    $_SESSION['message'] = "Registererd Successfully";
                    header('Location: ../login.php');

                } else {

                    $_SESSION['message'] = "Something went wrong!";
                    header('Location: ../register.php');

                }
            

            } else {

                // If password does not match error message will display and return to register.php
                $_SESSION['message'] = "Password do not match!";
                header('Location: ../register.php');
            }

        }
    }
    else if(isset($_POST['login_btn'])) {

        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        $login_query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $login_query_run = mysqli_query($con, $login_query);

        if(mysqli_num_rows($login_query_run) > 0) {

            $_SESSION['auth'] = true; //This is use for authenthication
            $userdata = mysqli_fetch_array($login_query_run);
            $username = $userdata['name'];
            $useremail = $userdata['email'];
            $role_as = $userdata['role_as'];

            $_SESSION['auth_user'] = [
                'name' => $username,
                'email' => $useremail
            ];

            $_SESSION['role_as'] = $role_as;

            if ($role_as == 1) {

                redirect("../admin/index.php", "Welcome to Dashboard");
                // $_SESSION['message'] = "Welcome to Dashboard";
                // header('Location: ../admin/index.php');

            } else { 

                redirect("../index.php", "Logged In Successfully");
                // $_SESSION['message'] = "Logged In Successfully";
                // header('Location: ../index.php');

            }

        } else {

            redirect("../login.php", "Invalid Credentials");
            // $_SESSION['message'] = "Invalid Credentials";
            // header('Location: ../login.php');

        }

    }
?>