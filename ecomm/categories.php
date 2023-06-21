<?php 
$titlePages = "Collection List";
include('functions/userfunctions.php');
include('includes/header.php');
?>
<div class="py-1 bg-primary text-center">
    <div class="container text-justify">
        <nav aria-label="breadcrumb" >
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item" >
                    <a href="index.php" class="text-dark">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#" class="text-dark">All Collections</a>
                </li>
            </ol>
        </nav>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Collections list</h1>
                <hr>
                <div class="row">
<?php
                $categories = getAllactive("categories");
                if(mysqli_num_rows($categories) > 0) {

                    foreach($categories as $item) {
?>
                    <div class="col-md-2 mb-2">
                        <a href="products.php?category=<?= $item['slug']; ?>">
                            <div class="card shadow">
                                <div class="card-body" >
                                    <img src="uploads/<?= $item['image']; ?>" alt="Category Image"  style="width: 100px; height: 100px;" class="img-thumbnail rounded mx-auto d-block">
                                    <h6 class="text-center"><?= $item['name']; ?></h6>
                                </div>
                            </div>
                        </a>
                    </div>                          
<?php
                    }
                } else { 
                    echo "No data available";
                }
?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php') ?>

