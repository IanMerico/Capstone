<?php
     include('../config/dbcon.php');
     include('../functions/myfunctions.php');

     if(isset($_POST['name'])) {

        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $email = $_POST['email'];
        $suggestions = $_POST['suggestions'];
        $feedback = $_POST['feedback'];

        $feedback_query = "INSERT INTO feedback (name, gender, age, email, suggestions, feedback, created_at) VALUES ('$name', '$gender', '$age', '$email', '$suggestions', '$feedback',  NOW())";

        
        $feedback_query_run = mysqli_query($con,  $feedback_query);

        if($feedback_query_run) {
           
            // Redirect to the same page after processing the form
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit;

        } else {

            echo "Something went wrong";

        }

     }

?>