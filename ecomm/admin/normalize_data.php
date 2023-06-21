<?php 
    $titlePage = "K-Means Clustering";
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
                        Normalized Data
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
                                    <th>is_male</th>
                                    <th>is_female</th>
                                    <th>normalized_age</th>
                                    <th>feedback</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
                                $normalizedFeedbackKmeans = normalizedFeedbackKmeans();

                                if (mysqli_num_rows($normalizedFeedbackKmeans) > 0) {
                                    while ($row = mysqli_fetch_assoc($normalizedFeedbackKmeans)) {
?>
                                        <tr>
                                            <td><?= $row['is_male'] ?></td>
                                            <td><?= $row['is_female'] ?></td>
                                            <td><?= $row['normalized_age'] ?></td>
                                            <td><?= $row['feedback'] ?></td>
                                        </tr>
<?php
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>No records found</td></tr>";
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
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body pt-2" id="category_table">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="text-left">
                                    <th>Gender (M = 1 , F = 1)</th>
                                    <th>Age (min / max)</th>
                                    <th>Feedback result</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
                                $normalizedFeedbackKmeans = normalizedFeedbackKmeans();

                                if (mysqli_num_rows($normalizedFeedbackKmeans) > 0) {
                                    $total_male = 0;
                                    $total_female = 0;
                                    $min_age_male = PHP_INT_MAX;
                                    $max_age_male = PHP_INT_MIN;
                                    $min_age_female = PHP_INT_MAX;
                                    $max_age_female = PHP_INT_MIN;

                                    $excellent_count = 0;
                                    $good_count = 0;
                                    $neutral_count = 0;
                                    $poor_count = 0;
                                    $disagree_count = 0;

                                    while ($row = mysqli_fetch_assoc($normalizedFeedbackKmeans)) {
                                        $is_male = $row['is_male'];
                                        $is_female = $row['is_female'];

                                        $total_male += $is_male;
                                        $total_female += $is_female;

                                        if ($is_male == 1) {
                                            $min_age_male = min($min_age_male, $row['normalized_age']);
                                            $max_age_male = max($max_age_male, $row['normalized_age']);
                                        }

                                        if ($is_female == 1) {
                                            $min_age_female = min($min_age_female, $row['normalized_age']);
                                            $max_age_female = max($max_age_female, $row['normalized_age']);
                                        }

                                        // Increment the count for the corresponding feedback category
                                        $feedback_result = $row['feedback'];
                                        switch ($feedback_result) {
                                            case 1:
                                                $excellent_count++;
                                                break;
                                            case 2:
                                                $good_count++;
                                                break;
                                            case 3:
                                                $neutral_count++;
                                                break;
                                            case 4:
                                                $poor_count++;
                                                break;
                                            case 5:
                                                $disagree_count++;
                                                break;
                                            default:
                                                break;
                                        }
                                    }
?>
                                    <td>
                                        <ul class="gender-list">
                                            <li>Is_male total count = <?= $total_male ?> </li>
                                            <li>Is_female total count = <?= $total_female ?> </li>
                                        </ul>
                                    </td>
                                    <td>
                                        <ul class="gender-list">
                                            <li>Minimum age for males = <?= $min_age_male ?></li>
                                            <li>Maximum age for males = <?= $max_age_male ?></li>
                                            <li>Minimum age for females = <?= $min_age_female ?></li>
                                            <li>Maximum age for females = <?= $max_age_female ?></li>
                                        </ul>
                                    </td>
                                    <td>
                                        <ul class="feedback-list">
                                            <li class="excellent">1 -- Excellent (<?= $excellent_count ?>)</li>
                                            <li class="good">2 -- Good (<?= $good_count ?>)</li>
                                            <li class="neutral">3 -- Neutral (<?= $neutral_count ?>)</li>
                                            <li class="poor">4 -- Poor (<?= $poor_count ?>)</li>
                                            <li class="disagree">5 -- Strongly Disagree (<?= $disagree_count ?>)</li>
                                        </ul>
                                    </td>
<?php
                                } else {
                                    echo "<tr><td colspan='3'>No records found</td></tr>";
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
        <div class="col-lg-12 col-md-12 mb-1">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-dark">K-Means Clustering</h4>
                </div>
                <div class="card-body">
                    <canvas id="clusterChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container overflow-scroll sticky">
    <div class="row">
        <div class="col-lg-12 col-md-12 mb-1">
            <div class="card shadow">
                <div class="card-body">
                    <h5>Cluster Centroids:</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Cluster</th>
                                <th>Centroid Values</th>
                                <th>Explanation</th> <!-- Add a new table header for explanation -->
                            </tr>
                        </thead>
                        <tbody>
<?php
                            foreach ($clusterCentroids as $clusterIndex => $centroid) {
                                $gender = $centroid[0];
                                $age = $centroid[1];
                                $normalizedAge = $centroid[2];
                                $feedback = $centroid[3];
?>
                                <tr>
                                    <td>Cluster <?php echo $clusterIndex; ?></td>
                                    <td><?php echo implode(", ", $centroid); ?></td>
                                    <td>
                                        <ul>
                                            <li>Gender: <?php echo ($gender == 0) ? "Female" : "Male"; ?></li>
                                            <li>Age: <?php echo $age; ?></li>
                                            <li>Normalized Age: <?php echo $normalizedAge; ?></li>
                                            <li>Feedback: <?php echo $feedback; ?></li>
                                        </ul>
                                    </td>
                                </tr>
<?php
                            }
?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 mb-1">
            <div class="card shadow">
                <div class="card-body">
                    <h5>Cluster Sizes:</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Cluster</th>
                                <th>Size</th>
                                <th>Explanation</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
                            foreach ($clusterSizes as $clusterIndex => $size) {
?>
                                <tr>
                                    <td>Cluster <?php echo $clusterIndex; ?></td>
                                    <td><?php echo $size; ?></td>
                                    <td>
<?php
                                        // Provide clear explanations for each cluster size
                                        switch ($clusterIndex) {
                                            case 0:
                                                echo "This cluster contains $size feedback instances.";
                                                echo "  <br> The centroid of this cluster suggests customers who are likely to provide higher feedback ratings compared to other clusters.";
                                                break;
                                            case 1:
                                                echo "This cluster contains $size feedback instances.";
                                                echo "  <br> The centroid of this cluster indicates customers with a relatively younger age and lower feedback ratings.";
                                                break;
                                            case 2:
                                                echo "This cluster contains $size feedback instances.";
                                                echo "  <br> The centroid of this cluster implies customers with a higher normalized age and moderate feedback ratings.";
                                                break;
                                            // Add more cases for additional clusters if needed
                                            default:
                                                echo "No specific explanation available.";
                                                break;
                                        }
?>
                                    </td>
                                </tr>
<?php
                            }
?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Existing code for displaying cluster centroids and cluster sizes -->

        <!-- Add a new section for summarizing the results and providing a comparison -->
        <div class="col-lg-12 col-md-12 mb-1">
            <div class="card shadow">
                <div class="card-body">
                    <h5>Summary and Comparison:</h5>
                    <p>
                        Based on the clustering results, the following insights can be derived:
                    </p>
                    <ul><li>
                         Cluster 0 has a centroid with the following feature values:
                    <ul>
                        <li>Gender: <?php echo ($clusterCentroids[0][0] == 0) ? "Female" : "Male"; ?></li>
                        <li>Age: <?php echo ($clusterCentroids[0][1] == 0) ? "Young" : "Old"; ?></li>
                        <li>Normalized Age: <?php echo ($clusterCentroids[0][2] == 0) ? "Low" : "High"; ?></li>
                        <li>Feedback: <?php echo ($clusterCentroids[0][3] == 0) ? "Low" : "High"; ?></li>
                    </ul>
                    This cluster contains <?php echo $clusterSizes[0]; ?> feedback instances.
    Customers in this cluster are likely to provide <?php echo ($clusterCentroids[0][3] == 0) ? "lower" : "higher"; ?> feedback ratings compared to other clusters.
                </li>
                <li>
                    Cluster 1 has a centroid with the following feature values:
                    <ul>
                        <li>Gender: <?php echo ($clusterCentroids[1][0] == 0) ? "Female" : "Male"; ?></li>
                        <li>Age: <?php echo ($clusterCentroids[1][1] == 0) ? "Young" : "Old"; ?></li>
                        <li>Normalized Age: <?php echo ($clusterCentroids[1][2] == 0) ? "Low" : "High"; ?></li>
                        <li>Feedback: <?php echo ($clusterCentroids[1][3] == 0) ? "Low" : "High"; ?></li>
                    </ul>
                    This cluster contains <?php echo $clusterSizes[1]; ?> feedback instances.
    Customers in this cluster are relatively younger and have <?php echo ($clusterCentroids[1][3] == 0) ? "lower" : "higher"; ?> feedback ratings compared to other clusters.
                </li>
                <li>
                    Cluster 2 has a centroid with the following feature values:
                    <ul>
                        <li>Gender: <?php echo ($clusterCentroids[2][0] == 0) ? "Female" : "Male"; ?></li>
                        <li>Age: <?php echo ($clusterCentroids[2][1] == 0) ? "Young" : "Old"; ?></li>
                        <li>Normalized Age: <?php echo ($clusterCentroids[2][2] == 0) ? "Low" : "High"; ?></li>
                        <li>Feedback: <?php echo ($clusterCentroids[2][3] == 0) ? "Low" : "High"; ?></li>
                    </ul>
                    This cluster contains <?php echo $clusterSizes[2]; ?> feedback instances.
    Customers in this cluster have a higher normalized age and <?php echo ($clusterCentroids[2][3] == 0) ? "moderate" : "higher"; ?> feedback ratings compared to other clusters.
                </li>
                        <!-- Add more bullet points for additional clusters if needed -->
                    </ul>
                    <p>
                        By analyzing the cluster centroids and sizes, the business can gain valuable insights into customer segments.
                        These insights can be used to tailor marketing strategies, product offerings, and customer experiences to better serve the specific needs and preferences of each cluster.
                        For example, by understanding the characteristics and feedback patterns of each cluster, the business can personalize marketing campaigns, optimize pricing strategies, and enhance customer support to drive growth and improve customer satisfaction.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php');?>
