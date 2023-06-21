<?php
    session_start();
    include('../config/dbcon.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

  

    // //Load Composer's autoloader
    require 'vendor/autoload.php';

    function send_password_reset($get_name, $get_email, $token) {

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
    
            $mail->setFrom("tte29637@gmail.com", $get_name);
            $mail->addAddress($get_email);
    
            $mail->isHTML(true);
            $mail->Subject = "Reset password notification";
    
            $email_template = "
                <h3>Hi</h3>
                <p>We are sending you this email because we have received a password reset request for your account.</p>
                <br/>
                <a href='http://localhost/capstone/ecomm/password-update.php?token=$token&email=$get_email'> Click Me </a>
            ";
            $mail->Body = $email_template;
            $mail->send();
            // echo 'Message has been sent';
            // } catch (Exception $e) {
            //     echo 'Message could not be sent.';
            //     echo 'Mailer Error: ' . $mail->ErrorInfo;
            // }
    

    }

    if(isset($_POST['action']) && $_POST['action'] === 'resetPassword') {



        $email = mysqli_real_escape_string($con, $_POST['email']);
        $token = md5(rand());

        $check_email = "SELECT email FROM users WHERE email='$email' LIMIT 1";
        $check_email_run = mysqli_query($con, $check_email);

        if(mysqli_num_rows($check_email_run) > 0) {

            $row = mysqli_fetch_array($check_email_run);
            $get_name = $row['name'];
            $get_email = $row['email'];

            $update_token = "UPDATE users SET token='$token' WHERE email='$get_email' LIMIT 1";
            $update_token_run = mysqli_query($con, $update_token);

            if($update_token_run) {

                send_password_reset($get_name, $get_email, $token);
                $_SESSION['message'] = "Check your email to reset your password";
                header("Location: ../password-reset.php");
                exit(0);

            } else {

                $_SESSION['message'] = "Something, went wrong";
                header("Location: ../password-reset.php");
                exit(0);

            }

        } else {

            
            $_SESSION['message'] = "No, Email found";
            header("Location: ../password-reset.php");
            exit(0);

        }



    }


    if(isset($_POST['action']) && $_POST['action'] === 'passwordUpdate') {

        $email = mysqli_real_escape_string($con, $_POST['email']);
        $new_password = mysqli_real_escape_string($con, $_POST['newpassword']);
        $confirm_newpassword = mysqli_real_escape_string($con, $_POST['confirm_newpassword']);
        $token = mysqli_real_escape_string($con, $_POST['password_token']);

        if(!empty($token)) {

            if(!empty($email) && !empty($new_password) && !empty($confirm_newpassword) ) {

                //Checking token is valid or not
                $check_token = "SELECT token FROM users WHERE token = '$token' LIMIT 1";
                $check_token_run = mysqli_query($con, $check_token);

                if(mysqli_num_rows($check_token_run) > 0) {

                    if($new_password == $confirm_newpassword) {

                        $updatePass = "UPDATE users SET password ='$new_password' WHERE token = '$token' LIMIT 1";
                        $updatePass_run = mysqli_query($con, $updatePass);

                        if($updatePass_run) {

                            $new_token = md5(rand());
                            $update_new_token = "UPDATE users SET token ='$new_token' WHERE token = '$token' LIMIT 1";
                            $update_new_token_run = mysqli_query($con, $update_new_token);

                            $_SESSION['message'] = "The new password has been updated successfully.";
                            header("Location: ../login.php");
                            exit(0);

                        } else {

                            $_SESSION['message'] = "The password was not updated due to an error.";
                            header("Location: ../password-update.php?token=$token&email=$email");
                            exit(0);
    
                        }

                    } else {

                        $_SESSION['message'] = "The password and its confirmation do not match.";
                    header("Location: ../password-update.php?token=$token&email=$email");
                    exit(0);

                    }



                } else { 

                    $_SESSION['message'] = "The token provided is not valid.";
                    header("Location: ../password-update.php?token=$token&email=$email");
                    exit(0);

                }

            } else {

                $_SESSION['message'] = "Every field must contain information and cannot be left blank.";
                header("Location: password-update.php?token=$token&email=$email");
                exit(0);

            }



        } else {

            $_SESSION['message'] = "No, token available";
            header("Location: ../password-reset.php");
            exit(0);

        }

    }
?>