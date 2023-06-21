<?php
// session_start();
include('../config/dbcon.php');
include('../functions/myfunctions.php');

if (isset($_POST['search'])) {
    $search = $_POST['search'];

    
    $results = searchCustomersByName("users", $search);

    
    
    // Process the search results and generate the HTML
    if (mysqli_num_rows($results) > 0) {
        $htmlContent = '<table class="table">';
        // $htmlContent .= '<tr><th>User ID</th><th>Full Name</th><th>Email</th><th>Verified Account</th><th>Date Created</th><th>View</th></tr>';
        
        while ($row = mysqli_fetch_assoc($results)) {
            $htmlContent .= '<tr>'; // Add opening <tr> tag
            $htmlContent .= '<td>' . $row['user_id'] . '</td>';
            $htmlContent .= '<td>' . $row['name'] . ' ' . $row['lname'] . '</td>';
            $htmlContent .= '<td>' . $row['email'] . '</td>';
            
            // Get the verification status
            $verificationStatus = $row['verifyStatus'] == '1' ? '<span class="text-success">Verified</span>' : '<span class="text-danger">Not Verified</span>';
            
            $htmlContent .= '<td>' . $verificationStatus . '</td>';
            $htmlContent .= '<td>' . $row['created_at'] . '</td>';
            
            // Add the View button
            $htmlContent .= '<td><button class="btn btn-primary btn-sm view-button" data-userid="' . $row['user_id'] . '">
                    <i class="fas fa-eye"></i>
                </button></td>';
        
            $htmlContent .= '</tr>'; // Add closing </tr> tag
        }
        
        
        $htmlContent .= '</table>';
        echo $htmlContent;
    } else {
        echo "No records found";
    }
} else {
    echo 'No search query provided.';
}
?>


<script>
$(document).ready(function() {
    $('.view-button').click(function() {
        var userId = $(this).data('userid');
        
        // Send an AJAX request to fetch_data.php
        $.ajax({
            url: 'fetch_data.php',
            method: 'POST',
            data: { userId: userId },
            success: function(response) {
                // Update the modal content with the fetched data
                $('#modalContent').html(response);
                $('#exampleModalCustomer').modal('show');
            },
            error: function() {
                alert('Error occurred while fetching data.');
            }
        });
    });
});
</script>
