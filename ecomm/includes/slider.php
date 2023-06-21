

    <?php
// include 'functions/fetchData.php';

// if (!isset($_SESSION['auth_user'])) {
//     $user_id = $_SESSION['auth_user']['user_id'];
// $user_id = $_SESSION['auth_user']['user_id'];
// $recommendations = display_recommendation($user_id);
?>

<!-- <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
    <div class="carousel-indicators">
        <?php
        foreach ($recommendations as $key => $value) {
            echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="' . $key . '"';
            if ($key === 0) {
                echo ' class="active" aria-current="true"';
            }
            echo ' aria-label="Slide ' . ($key + 1) . '"></button>';
        }
        ?>
    </div>
    <div class="carousel-inner">
        <?php
        foreach ($recommendations as $key => $value) {
            echo '<div class="carousel-item';
            if ($key === 0) {
                echo ' active';
            }
            echo '"><img src="' . $value . '" style="height: 500px; width: 600px;" class="d-block mx-auto"></div>';
        }
        ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div> -->
<?php 
// } else { 
    ?>

    <!-- <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="assets/images/Others (1).jpg" style="height: 500px; width: 600px;" class="d-block mx-auto" alt="Others (1).jpg">
            </div>
            <div class="carousel-item">
            <img src="assets/images/Others (2).jpg" style="height: 500px; width: 600px;" class="d-block mx-auto"     alt="Others (2).jpg">
            </div>
            <div class="carousel-item">
            <img src="assets/images/Others (3).jpg" style="height: 500px; width: 600px;" class="d-block mx-auto"     alt="Others (3).jpg">
            </div>
            <div class="carousel-item">
            <img src="assets/images/Others (4).jpg" style="height: 500px; width: 600px;" class="d-block mx-auto"     alt="Others (4).jpg">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div> -->

<?php 
// } 
?>

<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
    <div class="carousel-indicators">
        <?php
        $system_info = getcoverpage("system_info");
        if ($system_info && mysqli_num_rows($system_info) > 0) {
            $total_images = 0;
            while ($row = mysqli_fetch_assoc($system_info)) {
                $cover_paths = explode(',', $row['cover']);
                $total_images += count($cover_paths);
            }

            for ($i = 0; $i < $total_images; $i++) {
                $active_class = ($i === 0) ? 'active' : '';
                echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="' . $i . '" class="' . $active_class . '" aria-label="Slide ' . ($i + 1) . '"></button>';
            }
        }
        ?>
    </div>
    <div class="carousel-inner">
        <?php
        if ($system_info && mysqli_num_rows($system_info) > 0) {
            mysqli_data_seek($system_info, 0); // Reset the result set pointer
            while ($row = mysqli_fetch_assoc($system_info)) {
                $cover_paths = explode(',', $row['cover']);

                foreach ($cover_paths as $index => $path) {
                    $carousel_class = ($index === 0) ? 'carousel-item active' : 'carousel-item';
                    echo '<div class="' . $carousel_class . '">';
                    echo '<img src="assets/images/' . trim($path) . '" alt="Category Image" class="img-thumbnail rounded mx-auto d-block">';
                    echo '</div>';
                }
            }
        }
        ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

