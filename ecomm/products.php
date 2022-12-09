<?php 
include('functions/userfunctions.php');
include('includes/header.php');

if(isset($_GET['category'])) {

$category_slug = $_GET['category'];
$category_data = getSlugactive("categories", $category_slug);
$category = mysqli_fetch_array($category_data);
if($category) {
$cid = $category['id'];

?>
<div class="py-3 bg-primary">
    <div class="container">
        <h6 class="text-white">
            <a href="categories.php" class="text-white">
            Home / 
            </a>
            <a href="categories.php" class="text-white">
            Collections / 
            </a>
            <?= $category['name']; ?>
        </h6>
    </div>
</div>
<div class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2><?= $category['name']; ?></h2>
                <hr>
                <div class="row">
<?php
                    $products = getProdbyCategory($cid);
                    if(mysqli_num_rows($products) > 0) {

                        foreach($products as $item) {
?>
                            <div class="col-md-3 mb-2">
                                <a href="#">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <img src="uploads/<?= $item['image']; ?>" alt="Product Image" class="w-100">
                                        <h4 class="text-center"><?= $item['name']; ?></h4>
                                    </div>
                                </div>
                                </a>
                            </div>                          
<?php
    
                    
?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
            }
        }
            }else { 
                echo "No data available";
            }
    } else {
        echo "Something went wrong";
    }

include('includes/footer.php'); ?>
