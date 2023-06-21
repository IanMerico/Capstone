<?php

   
    // session_start();
    include('../config/dbcon.php');
    include('myfunctions.php');

        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;

      
    
        // //Load Composer's autoloader
        require 'vendor/autoload.php';
    
        function sendemail_verify($name, $email, $token) {
            
            $mail= new PHPMailer(true);
    
            // try {
            
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER; 
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->SMTPAuth = true;
    
            $mail->Host = 'smtp.gmail.com';
            $mail->Username = 'tte29637@gmail.com';
            $mail->Password = 'h q z s e e v r v e g r w a i e';
    
            // $mail->SMTPSecure =PHPMailer::ENCRYPTION_SMTPS;
            //Enable TLS encryption;
            // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->SMTPSecure = "tls";
            $mail->Port = 587;
    
            $mail->setFrom("tte29637@gmail.com", $name);
            $mail->addAddress($email);
    
            $mail->isHTML(true);
            $mail->Subject = "Verify your email to continue login...";
    
            $email_template = "
                <h3>Dear, $name.</h3>
                <p>Please find below a link to the token that you can use to access our services. <br>This token is valid for [duration]. 
                <br>Simply click on the link to access our platform:</p>
                <br/>
                <a href='http://localhost/capstone/ecomm/verify_email.php?token=$token'> Click Me </a>
                <br/>
                <p>Thank you for using our services.</p>
                <p>Best regards</p>
                <p><i><small>Please note that this message is automated and is not monitored. <br>Therefore, if you have any questions or concerns, please do not reply to this message. <br>Instead, please contact our customer support team via Facebook Messenger at https://www.facebook.com/apobangpomerchph and they will be happy to assist you.</small></i></p>
            ";
            $mail->Body = $email_template;
            $mail->send();
            // echo 'Message has been sent';
            // } catch (Exception $e) {
            //     echo 'Message could not be sent.';
            //     echo 'Mailer Error: ' . $mail->ErrorInfo;
            // }
    
        }


    // $name_err ="";
    // $lname_err ="";
    // This is for register button
    if(isset($_POST['action']) && $_POST['action'] === 'register_btn') {
        $name = trim(mysqli_real_escape_string($con, $_POST['name']));
        // $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $lname = trim(mysqli_real_escape_string($con, $_POST['lname']));
        $phone = mysqli_real_escape_string($con, $_POST['phone']);
        $email = trim(mysqli_real_escape_string($con, $_POST['email']), FILTER_VALIDATE_EMAIL);
        $password = trim(mysqli_real_escape_string($con, $_POST['password']));
        $confirm_password = trim(mysqli_real_escape_string($con, $_POST['confirm_password']));
        $birthdate = trim(mysqli_real_escape_string($con, $_POST['birthdate']));
        $sex = trim(mysqli_real_escape_string($con, $_POST['sex']));
        $street_address = trim(mysqli_real_escape_string($con, $_POST['street_address']));
        $barangay = trim(mysqli_real_escape_string($con, $_POST['barangay']));
        $province = trim(mysqli_real_escape_string($con, $_POST['province']));
        $city = trim(mysqli_real_escape_string($con, $_POST['city']));
        $zipcode = trim(mysqli_real_escape_string($con, $_POST['zipcode']));
        $agreement = trim(mysqli_real_escape_string($con, $_POST['agreement']));
        $token = md5((rand()));

                $check_email_query = "SELECT email FROM users WHERE email='$email'";
                $check_email_query_run = mysqli_query($con, $check_email_query);
                
                if(mysqli_num_rows($check_email_query_run) > 0) {

                    $_SESSION['message'] = "Email already exist!";
                    header('Location: ../register.php');
                    exit(0);

                }else {

                    if($password == $confirm_password) {

                        // Insert all the information directly to database
                        $insert_query = "INSERT INTO users (name, lname, email, phone, password, token, birthdate, sex, street_address, barangay, province, city, zipcode, agreement, created_at, updated_at)
                                            VALUES ('$name', '$lname', '$email', '$phone', '$password', '$token', '$birthdate', '$sex', '$street_address', '$barangay', '$province', '$city', '$zipcode', '$agreement', NOW(), NOW())";
                        $insert_query_run = mysqli_query($con, $insert_query);

                            if($insert_query_run) {

                                sendemail_verify("$name", "$email", "$token");
                                $_SESSION['message'] = "Registration successfully, Please verified your email.";
                                header('Location: ../register.php');

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
    // } 
    else if(isset($_POST['action']) && $_POST['action'] === 'login_value') {

        $email = mysqli_real_escape_string($con, $_POST['email']);    
        $password = mysqli_real_escape_string($con, $_POST['password']);

        $login_query = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
        $login_query_run = mysqli_query($con, $login_query);

        if(mysqli_num_rows($login_query_run) > 0) {

            
            $userdata = mysqli_fetch_array($login_query_run);
            $verifyStatus = $userdata['verifyStatus'];
            if($verifyStatus == '1'){
                
                $_SESSION['auth'] = true; //This is use for authenthication
                $userid = $userdata['user_id'];
                $username = $userdata['name'];
                $useremail = $userdata['email'];
                $role_as = $userdata['role_as'];

                $_SESSION['auth_user'] = [
                    'user_id' => $userid,
                    'name' => $username,
                    'email' => $useremail
                ];

                $_SESSION['role_as'] = $role_as;

                if ($role_as == 1) {

                    redirect("../admin/index.php", "Welcome to Dashboard");

                } 
                 else { 

                    redirect("../index.php", "Logged In Successfully");
                }

            } else { 
                 $_SESSION['message'] = "Please, verify your email address";
                header('Location: ../login.php');

            }
           
            

        } else {

            redirect("../login.php", "Invalid Credentials");
        }

    } 
?>