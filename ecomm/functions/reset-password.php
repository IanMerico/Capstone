<?php
    session_start();
    include('../config/dbcon.php');
    // include('myfunctions.php');

    if (isset($_POST['action']) && $_POST['action'] === 'passwordChange') {

        $user_id = trim(mysqli_real_escape_string($con, $_SESSION['auth_user']['user_id']));
    
        $oldpassword = mysqli_real_escape_string($con, $_POST['password']);
        $newpassword = mysqli_real_escape_string($con, $_POST['newpassword']);
        $confirm_newpassword = mysqli_real_escape_string($con, $_POST['confirm_newpassword']);
        // $new_password_hash = password_hash($newpassword, PASSWORD_DEFAULT);
    
        if ($newpassword === $confirm_newpassword) {
    
            $check_password = "SELECT * FROM users WHERE password = ? AND user_id = ?";
            $stmt = mysqli_prepare($con, $check_password);
            mysqli_stmt_bind_param($stmt, "si", $oldpassword, $user_id);
            mysqli_stmt_execute($stmt);
            $check_password_query_run = mysqli_stmt_get_result($stmt);
            $count = mysqli_num_rows($check_password_query_run);
    
            if ($count > 0) {
    
                $sql = "UPDATE users SET password = ? WHERE user_id = ?";
                $stmt = mysqli_prepare($con, $sql);
                mysqli_stmt_bind_param($stmt, "si", $newpassword, $user_id);
                mysqli_stmt_execute($stmt);
                $_SESSION['message'] = "Password changed successfully";
                header('Location: ../password_change.php');
            } else {
                $_SESSION['message'] = "Old Password does not match!";
                header('Location: ../password_change.php');
            }
        } else {
            $_SESSION['message'] = "Password does not match!";
            header('Location: ../password_change.php');
        }
    } else {
        $_SESSION['message'] = "Error changing password";
        header('Location: ../password_change.php');
    }
?>