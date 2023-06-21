<?php 
    $titlePages = "";
    include('functions/userfunctions.php');
    include('authenticate.php');
    if (isset($_SESSION['auth'])) {
        $titlePages .= "Wish List";
    } else {
        $titlePages .= "Wish List";
    }
    include('includes/header.php');
?>
<nav class="py-1 navbar navbar-expand-lg navbar-light bg-primary">
    <div class="container text-justify">
        <nav aria-label="breadcrumb" >
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item" >
                    <a href="index.php" class="text-dark">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#" class="text-dark">My Wishlist</a>
                </li>
            </ol>
        </nav>
    </div>
</nav>
<div class="py-5 mt-4">
    <div class="container w-100">
        <div class="row">
            <div class="table-responsive">
                <div id="mycart">
                    <?php 
                        $wishlist= getwishlistItems();
                        if(mysqli_num_rows($wishlist) > 0) {
                            ?>
                            <table class="table table-hover table-bordered align-middle mb-2 bg-white table-responsive" id="datatableid" width="100%">
                            <!--Table head-->
                                <thead class="bg-light">
                                    <tr class="text-center">
                                        <th class="th-sm">Product Image</th>
                                        <th class="th-sm">Product Name</th>
                                        <th class="th-sm">Price</th>
                                        <th class="th-sm">Available stocks</th>
                                        <th class="th-sm">Remove Wishlist</th>
                                    </tr>
                                </thead>
                            <!--Table head-->
                            <!--Table body-->   
                                <tbody class="text-justify bg-light ">
                                    <?php
                                        foreach ($wishlist as $WishListItem) {
                                            ?>
                                        <tr class="table-light">
                                        
                                            <td scope="row" class="text-center">
                                                <?php 
                                                    $image_array = array($WishListItem['image']);
                                                    $first_image = explode(' ', $image_array[0])[0];
                                                ?>
                                                <img src="uploads/<?= $first_image; ?>" alt="Image" width="50px">
                                            </td>
                                            <td> <a href=""><?= $WishListItem['name']; ?></a> </td>
                                            <td class="text-center">Php: <?= number_format($WishListItem['selling_price'],2); ?></td>
                                            <?php if($WishListItem['qty'] != 0) { ?>
                                            <td class="text-center"><span class="fw-bold"><?= $WishListItem['qty']; ?></span></td>
                                            <?php } else {?>
                                                <td class="text-center"><span class="text-danger fw-normal">Not available*</span></td>
                                            <?php } ?>
                                            <td class="text-center"><button class="btn btn-danger btn-sm deleteItemWishlist" value="<?= $WishListItem['cid']; ?>"><i class="fa fa-trash me-1"></i></button></td>
                                        </tr>
                                        <?php 
                                        }                                  
                                    ?>
                                </tbody>
                                <!--Table body-->
                            </table>
                            <!--Table-->
<?php    
                        } else {
?>
                        <div class="card card-body shadow text-center" style=" height: 15rem;">
                            <h4 class="py-3 fw-bold ">Your wishlist is empty.</h4>
                        </div>
<?php
                        }
?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer_information.php'); ?>

