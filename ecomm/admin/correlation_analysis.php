<?php 
$titlePage = "Correlation Analysis table";
include('../middleware/adminMidleware.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<?php
$correlationAnalysisFeedback = correlationAnalysis();

if (mysqli_num_rows($correlationAnalysisFeedback) > 0) {
    echo '<div class="container overflow-scroll sticky">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow mb-4">
                        <div class="card-header pb-1 py-3">
                            <h4 class="m-0 font-weight-bold text-dark">
                                Correlation Analysis
                            </h4>
                        </div>
                        <div class="card-body pt-2" id="category_table">
                            <div class="table-responsive">
                                <table class="table table-hover" id="dataTable">
                                    <thead>
                                        <tr class="text-left">
                                            <th>Features</th>
                                            <th>Correlation with Feedback</th>
                                            <th>Interpretation</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

    while ($cof = mysqli_fetch_assoc($correlationAnalysisFeedback)) {
        foreach ($cof as $feature => $correlationValue) {
            // Interpret the correlation value
            $interpretation = interpretCorrelationResults($correlationValue);

            // Display the feature, correlation value, and its interpretation
            echo "<tr>";
            echo "<td>$feature</td>";
            echo "<td>$correlationValue</td>";
            echo "<td>$interpretation</td>";
            echo "</tr>";
        }
    }

    echo '</tbody>
        </table>
    </div>
    </div>
    </div>
    </div>
    </div>';

    // Visualize the correlations
    visualizeCorrelations($correlationAnalysisFeedback);
} else {
    echo "No records found";
}

// Visualize the Correlations
function visualizeCorrelations($correlationData) {
    // Create an array to store the feature names and correlation values
    $features = [];
    $correlationValues = [];

    // Iterate over the correlation data and populate the arrays
    while ($cof = mysqli_fetch_assoc($correlationData)) {
        foreach ($cof as $feature => $correlationValue) {
            $features[] = $feature;
            $correlationValues[] = $correlationValue;
        }
    }

    // Generate the scatter plot using Chart.js
    echo '<canvas id="correlationChart"></canvas>';
    echo '';
}
?>

<?php include('includes/footer.php');?>
