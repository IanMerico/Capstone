<?php
    // connect to the database
    $conn = mysqli_connect('localhost:3307', 'root', '', 'ecommerce_db');

    // retrieve data from the orders table
    $query = "SELECT products.name AS product_name, users.sex, TIMESTAMPDIFF(YEAR, users.birthdate, CURDATE()) AS age FROM products INNER JOIN users ON products.id = users.user_id;";
    $result = mysqli_query($conn, $query);

    // clean and preprocess the data
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        // remove null or invalid values
        if (!empty($row['product_name']) && !empty($row['sex'])) {
            // transform categorical variables into numerical variables
            $gender = ($row['sex'] == 'Male') ? 1 : 0;
            $age = (!empty($row['age'])) ? $row['age'] : 0;
            $data[] = array(
                'product_name' => $row['product_name'],
                'gender' => $gender,
                'age' => $age
            );
        }
    }
    // split the data into training and testing datasets
    $split = 0.7; // 70% training, 30% testing
    $split_index = round(count($data) * $split);
    shuffle($data); // randomize the data
    $train_data = array_slice($data, 0, $split_index);
    $test_data = array_slice($data, $split_index);

    // create a new instance of the classifier
    use Phpml\Classification\LogisticRegression;
    $classifier = new LogisticRegression();
    // train the classifier on your training data
    $X = array();
    $y = array();
    foreach ($train_data as $row) {
        $X[] = array($row['gender'], $row['age']);
        $y[] = $row['product_name'];
    }
    $classifier->train($X, $y);
    // test the performance of the classifier on your testing data
    $correct = 0;
    $total = count($test_data);
    foreach ($test_data as $row) {
        $prediction = $classifier->predict(array($row['gender'], $row['age']));
        if ($prediction === $row['product_name']) {
            $correct++;
        }
    }
    $accuracy = $correct / $total;
    echo "Accuracy: " . $accuracy;
?>
