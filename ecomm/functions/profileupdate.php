<?php

include('../config/dbcon.php');
include('myfunctions.php');

if(isset($_POST['action']) && $_POST['action'] === 'updateProfile') {

    $user_id = trim(mysqli_real_escape_string($con, $_SESSION['auth_user']['user_id']));
    $name = trim(mysqli_real_escape_string($con, $_POST['name']));
    $lname = trim(mysqli_real_escape_string($con, $_POST['lname']));
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $email = trim(mysqli_real_escape_string($con, $_POST['email']));
    $birthdate = trim(mysqli_real_escape_string($con, $_POST['birthdate']));
    $sex = trim(mysqli_real_escape_string($con, $_POST['sex']));
    $street_address = trim(mysqli_real_escape_string($con, $_POST['street_address']));
    $barangay = trim(mysqli_real_escape_string($con, $_POST['barangay']));
    $province = trim(mysqli_real_escape_string($con, $_POST['province']));
    $city = trim(mysqli_real_escape_string($con, $_POST['city']));
    $zipcode = trim(mysqli_real_escape_string($con, $_POST['zipcode']));

    $updateprofile = "UPDATE users SET name=?, lname=?, phone=?, email=?, birthdate=?, sex=?, street_address=?, barangay=?, province=?, city=?, zipcode=?, created_at=NOW(), updated_at=NOW() WHERE user_id=?";
    $stmt = mysqli_prepare($con, $updateprofile);
    mysqli_stmt_bind_param($stmt, 'sssssssssssi', $name, $lname, $phone, $email, $birthdate, $sex, $street_address, $barangay, $province, $city, $zipcode, $user_id);
    $insert_query_run = mysqli_stmt_execute($stmt);

    

    if($insert_query_run) {
        $_SESSION['message'] = "Profile updated";
        header('Location: ../account.php?=profile');
    } else {
        $_SESSION['message'] = "Something went wrong!";
        header('Location: ../register.php');
    }
}