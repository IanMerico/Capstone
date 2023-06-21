<?php
    $host = "localhost:3307";
    $username = "root";
    $password = "";
    $database = "ecommerce_db";

    // Creating database connection 
    $con = mysqli_connect($host, $username, $password, $database);

    // Check database connection
    if(!$con) { 
        die("Connection Failed: ".mysqli_connect_error());
    }

?>