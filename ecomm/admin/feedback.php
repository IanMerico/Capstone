<?php 
    $titlePage = "Feedback";
    include('../middleware/adminMidleware.php');
    include('includes/header.php');
    include('includes/navbar.php');
?>
<div class="container overflow-scroll sticky">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header pb-1 py-3">
                    <h4 class="m-0 font-weight-bold text-dark">
                        Data of Feedback
                        <!-- <a href="add_user.php" class="btn btn-sm btn-primary float-end"><i class="fas fa-fw fa-plus"></i> Create New</a> -->
                    </h4>
                </div>
                <div class="card-body pt-2" id="category_table">
                    <div class="table-responsive">
                        <style>
                            .table {
                                font-size: 14px; /* Adjust the font size as needed */
                            }

                            .table thead th {
                                background-color: #f8f9fc; /* Set the background color for the table header */
                            }

                            .table-responsive {
                                max-height: 400px; /* Set the maximum height for the table container */
                            }

                            .card {
                                border-radius: 10px; /* Add some border radius to the card */
                            }
                            
                            ul.feedback-list li {
                                position: relative;
                                padding-left: 20px;
                                margin-bottom: 10px;
                                list-style: none;
                                line-height: 1.5;
                            }

                            ul.feedback-list li::before {
                                content: '';
                                position: absolute;
                                left: 0;
                                top: 5px;
                                height: 8px;
                                width: 10px;
                                background-color: #000;
                            }
                            
                            ul.feedback-list li.excellent::before {
                                background-color: green;
                            }
                            
                            ul.feedback-list li.good::before {
                                background-color: lightgreen;
                            }
                            
                            ul.feedback-list li.neutral::before {
                                background-color: yellow;
                            }
                            
                            ul.feedback-list li.poor::before {
                                background-color: orange;
                            }
                            
                            ul.feedback-list li.disagree::before {
                                background-color: red;
                            }
                            .gender-list {
                                list-style: none;
                            }
                        </style>
                        <table class="table table-bordered table-hover" id="dataTable">
                            <thead>
                                <tr class="text-left">
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Age</th>
                                    <th>Feedback</th>
                                    <th>Suggestions</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
                                $allFeedback = getFeedback();

                                if(mysqli_num_rows($allFeedback) > 0) {
                                    foreach($allFeedback as $Feedback_data) {
?>
                                <tr>
                                    <td><?= $Feedback_data['name']?></td>
                                    <td><?= $Feedback_data['gender']?></td>
                                    <td><?= $Feedback_data['age']?></td>
                                    <td><?= $Feedback_data['feedback']?></td>
                                    <td><?= $Feedback_data['suggestions']?></td>
                                </tr>
<?php
                                    }
                                } else { 
                                    echo "No records found";
                                }
?>                                     
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container overflow-scroll sticky">
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-body pt-2" id="category_table">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" >
                            <thead>
                                <tr class="text-left">
                                    <th>Feedback</th>
                                    <th>Gender</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <ul class="feedback-list">
                                            <li class="excellent">1 -- Excellent</li>
                                            <li class="good">2 --  Good</li>
                                            <li class="neutral">3 --  Neutral</li>
                                            <li class="poor">4 --  Poor</li>
                                            <li class="disagree">5 --  Strongly Disagree</li>
                                        </ul>
                                    </td>
                                    <td>
                                        <ul class="gender-list">
                                            <li>Male</li>
                                            <li>Female</li>
                                        </ul>  
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container overflow-scroll sticky">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header pb-1 py-3">
                    <h4 class="m-0 font-weight-bold text-dark">Normalize Numeric Variables</h4>
                </div>
                <div class="card-body pt-2" id="category_table">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable">
                            <thead>
                                <tr class="text-left">
                                    <th>id</th>
                                    <th>name</th>
                                    <th>is_male</th>
                                    <th>is_female</th>
                                    <th>normalized_age</th>
                                    <th>suggestions</th>
                                    <th>feedback</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
                                $NormalizeNumericFeedback = normalizeFeedback();

                                if(mysqli_num_rows($NormalizeNumericFeedback) > 0) {
                                    foreach($NormalizeNumericFeedback as $Normalize) {
?>
                                <tr>
                                    <td><?= $Normalize['id']?></td>
                                    <td><?= $Normalize['name']?></td>
                                    <td><?= $Normalize['is_male']?></td>
                                    <td><?= $Normalize['is_female']?></td>
                                    <td><?= $Normalize['normalized_age']?></td>
                                    <td><?= $Normalize['suggestions']?></td>
                                    <td><?= $Normalize['feedback']?></td>
                                </tr>
<?php
                                    }
                                } else { 
                                    echo "No records found";
                                }
?>                                     
            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php');?>
