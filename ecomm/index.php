<?php 
    $titlePages = "ApoBangpo Merch PH";
    include('functions/userfunctions.php');
    include('functions/fetchData.php');
    include('includes/header.php');
    include('includes/slider.php');
?>
<div class="py-3">
    <div class="container">
        <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4 col-xl-4">
            <form method="GET" class="search-form">
                <div class="input-group">
                    <input type="search" class="form-control search-input" id="searchInput" name="search" placeholder="Search..." onkeyup="fetchData()" />
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary search-btn"><i class="fa fa-search"></i></button>
                        <a href="index.php" class="btn btn-primary search-btn all-btn">ALL</a>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<div class="py-2">
    <div class="container">
        <div class="row justify-content-center">
<?php 
            if (count($allproducts) > 0) {
                foreach ($allproducts as $allitem) {
?>
                    <div class="col-md-4 col-lg-4 col-4 d-grid align-items-stretch mb-3">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="form-group mb-2">
                                    <label for="p_available" class="card-text">
                                    <?php if($allitem['qty'] != 0) {?>
                                            Available: <?= $allitem['qty']?>
                                            <span class="text-success">Available</span> 
                                        <?php } else { ?>
                                            Out of stock: <?= $allitem['qty']?>
                                            <span class="text-danger">Out of stock</span> 
                                            <?php } ?>
                                    </label>
                                </div>
                                <div class="form-group mb-2">
                                    <p class="card-title h-50 w-auto"><strong><small><?= $allitem['name']; ?></small></strong> </p>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="border-image rounded mx-auto d-block">
                                        <?php 
                                            $image_array = array($allitem['image']);
                                            $first_image = explode(' ', $image_array[0])[0];
                                        ?>
                                        <img src="uploads/<?= $first_image; ?>" class="h-100 w-100 itemhere img-thumbnail rounded mx-auto d-block">
                                        
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label name="price">&#8369 <?php echo number_format($allitem['selling_price'], 2); ?></label>
                                </div>
                                <div class="form-group mb-2">
                                    <small><p class="card-text"><?= $allitem['small_description']; ?></p></small>
                                </div>
                                <div class="form-group mb-2">
                                    <a href="product_view.php?product=<?= $allitem['slug']; ?>"  class="btn btn-primary">Continue...</a>
                                </div>
                            </div>
                        </div>
                    </div>
<?php                
                }
            } else {
                echo 'No products found.';
            }
?>
        </div>
    </div>
</div>
<?php include('footer_information.php'); ?>
