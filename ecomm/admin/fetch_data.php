<?php
include('../config/dbcon.php');

if (isset($_POST['userId'])) {
    $userId = $_POST['userId'];

    function getCustomerDetails($userId) {
        global $con;
        $query = "SELECT * FROM users WHERE user_id = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, 'i', $userId);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_get_result($stmt);
    }

    $customer = getCustomerDetails($userId);
    
    if (mysqli_num_rows($customer) > 0) {
        $row = mysqli_fetch_assoc($customer);
    
        $htmlContent = '<div class="modal-content">';
        $htmlContent .= '<table class="table">';
        $htmlContent .= '<tr><th>User ID</th><td>' . $row['user_id'] . '</td></tr>';
        $htmlContent .= '<tr><th>Full Name</th><td>' . $row['name'] . ' ' . $row['lname'] . '</td></tr>';
        $htmlContent .= '<tr><th>Email</th><td>' . $row['email'] . '</td></tr>';
        $htmlContent .= '<tr><th>Phone#</th><td>' . $row['phone'] . '</td></tr>';
    
        // Calculate age based on birthdate
        $birthdate = new DateTime($row['birthdate']);
        $currentDate = new DateTime();
        $age = $currentDate->diff($birthdate)->y;

        $htmlContent .= '<tr><th>Birthdate</th><td>' . $row['birthdate'] . '</td></tr>';
        $htmlContent .= '<tr><th>Age</th><td>' . $age . '</td></tr>';
        $htmlContent .= '<tr><th>Gender</th><td>' . $row['sex'] . '</td></tr>';
        $htmlContent .= '<tr><th>Full Address</th><td>' . $row['street_address'] . '<br> ' . $row['barangay'] .' ' . $row['province'] .'<br>' . $row['city'] .' ' . $row['zipcode'] .'</td></tr>';
        // Add more details as needed

        // Add the verification status
        $htmlContent .= '<tr><th>Verification Status</th><td>';
        if ($row['verifyStatus'] == '1') {
            $htmlContent .= '<span class="text-success">Verified</span>';
        } else {
            $htmlContent .= '<span class="text-danger">Not Verified</span>';
        }
        $htmlContent .= '</td></tr>';
        $htmlContent .= '</table>';
        $htmlContent .= '</div>';
        
        echo $htmlContent;
    } else {
        echo 'No user details found.';
    }
    
} else {
    echo 'No user ID provided.';
}
?>
