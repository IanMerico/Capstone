<?php 
    $titlePages = "Available Products";    
    include('functions/userfunctions.php');
    include('includes/header.php');

    if(isset($_GET['category'])) {
    $category_slug = $_GET['category'];
    $category_data = getSlugactive("categories", $category_slug);
    $category = mysqli_fetch_array($category_data);
    if($category) {
    $cid = $category['id'];
    ?>
    <div class="py-1 bg-primary text-center">
        <div class="container text-justify">
                <?= $category['name']; ?>
            <nav aria-label="breadcrumb" >
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item" >
                        <a href="index.php" class="text-dark">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="categories.php" class="text-dark">Collections</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#" class="text-dark"><?= $category['name']; ?></a>
                    </li>
                </ol>
            </nav>
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
                        $product = getProdbyCategory($cid);
                        
                        if(mysqli_num_rows($product) > 0) {

                            foreach($product as $item) {
                        ?>
                                <div class="col-md-3 mb-2">
                                    <a href="product_view.php?product=<?= $item['slug']; ?>">
                                        <div class="card shadow">
                                            <div class="card-body">
                                            <?php 
                                            $image_array = array($item['image']);
                                            $first_image = explode(' ', $image_array[0])[0];
                                        ?>
                                                <img src="uploads/<?=  $first_image; ?>" alt="Product Image" class="w-100">
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
<?php  
            } 
            else {
                echo "Something went wrong";
            }   
        } else {
            echo "Something went wrong";
        }

    include('includes/footer.php'); 
?>
