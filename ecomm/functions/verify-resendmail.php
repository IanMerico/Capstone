<?php
    session_start();
    include('../config/dbcon.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

  

    // //Load Composer's autoloader
    require 'vendor/autoload.php';

    function resend_email_verify($name, $email, $token) {

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
            $mail->Subject = "Resend - Verify your email to continue login...";
    
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


    if(isset($_POST['action']) && $_POST['action'] === 'verifyEmail') {

        if(!empty(trim($_POST['email']))) { 

            $email = mysqli_real_escape_string($con, $_POST['email']);

            $checkmail_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
            $checkmail_query_run = mysqli_query($con, $checkmail_query);

            if(mysqli_num_rows($checkmail_query_run) > 0) {

                $row = mysqli_fetch_array($checkmail_query_run);

                if($row['verifyStatus'] == "0") {


                    $name = $row['name'];
                    $email = $row['email'];
                    $token = $row['token'];
                    resend_email_verify($name, $email, $token);
                    $_SESSION['message'] = "A verification link has been sent to your email address.";
                    header("Location: ../login.php");
                    exit(0);

                } else { 

                    $_SESSION['message'] = "Your email has already been verified. Please login to continue.";
                    header("Location: ../login.php");
                    exit(0);

                }

            } else { 

                $_SESSION['message'] = "Sorry, this email is not registered!";
                header("Location: ../resend-email-verify.php");
                exit(0);

            }
            

        }
        else {

            $_SESSION['message'] = "Please enter your email in the field provided.";
            header("Location: resend-email-verify.php");
            exit(0);

        }

    }

?>