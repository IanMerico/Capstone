<?php

// Data for cover slider in system_info
include('config/dbcon.php');
function geticon($system_info) {

  global $con;
  $query = "SELECT business_logo FROM $system_info";
  $stmt = mysqli_prepare($con, $query);
  mysqli_stmt_execute($stmt);
  $query_run = mysqli_stmt_get_result($stmt);
  return($query_run);

}
function getMeta($meta) {

  global $con;
  $query = "SELECT meta_title, meta_keywords, meta_description FROM $meta";
  $stmt = mysqli_prepare($con, $query);
  mysqli_stmt_execute($stmt);
  $query_run = mysqli_stmt_get_result($stmt);
  return($query_run);

}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- add icon link -->

    <?php
      $system_info = geticon("system_info");
      if ($system_info && mysqli_num_rows($system_info) > 0) {
          $row = mysqli_fetch_assoc($system_info);
          $business_logo = $row['business_logo'];
          $icon_path = "assets/images/" . $business_logo;
      } else {
          $icon_path = "assets/images/297979668_103856492433245_4893127009659140128_n-removebg-preview.png";
      }

      $meta_new = getMeta("system_info");
      if($meta_new && mysqli_num_rows($meta_new) > 0) {
        $raw = mysqli_fetch_assoc($meta_new);

      }
  ?>

   <!-- Set meta tags -->
   <meta name="title" content="<?= $raw['meta_title']?>">
    <meta name="description" content="<?= $raw['meta_description']?>">
    <meta name="description" content="<?= $raw['meta_keywords']?>">


  <!-- add icon link -->
  <link rel="icon" href="<?php echo $icon_path; ?>" type="image/x-icon">


    <!-- <link rel = "icon" href = "assets/images/297979668_103856492433245_4893127009659140128_n-removebg-preview.png" 
        type = "image/x-icon"> -->

    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
    <link href="assets/css/validate_style.css" rel="stylesheet">
    <link href="assets/css/owl.theme.default.min.css" rel="stylesheet">
    <link href="assets/css/owl.carousel.min.css" rel="stylesheet">
    <link type="text/css" href="assets/css/jquery.exzoom.css" rel="stylesheet">
    <link type="text/css" href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- DataTable CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
    
    <!-- DataTable CSS -->
    <script defer src="assets/js/activePage.js"></script>
    
    <title ><?php echo $titlePages; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cabin&display=swap" rel="stylesheet">
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/simpleZoom.js"></script>
    <script defer type="text/javascript" src="assets/js/validation.js"></script>
    <script defer type="text/javascript" src="assets/js/validationLogin.js"></script>
    <script defer type="text/javascript" src="assets/js/validatepassChange.js"></script>

 

    
    <!-- <script src="assets/js/custom.js"></script> -->
    
      <!-- Alertfy JS - CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
    <!-- =============== -->

    

    

  </head>
  <body>
    <?php include('includes/navbar.php') ?>