<?php 

include('functions/userfunctions.php');
include('includes/header.php');
include('authenticate.php');

?>
<!-- <div class="py-1 bg-primary text-center">
    <div class="container">
        <h6 class="text-white m-1">
            <a href="index.php" class="text-white" >Home</a> 
             / 
            <a href="#" class="text-white">My Wishlist</a> 
        </h6>
    </div>
</div> -->
<nav class="py-1 navbar navbar-expand-lg navbar-light bg-primary">
  <div class="container text-justify">
    <nav aria-label="breadcrumb" >
      <ol class="breadcrumb ">
        <li class="breadcrumb-item" >
          <a href="index.php" class="text-white">Home</a>
        </li>
        <li class="breadcrumb-item">
          <a href="#" class="text-white">My Wishlist</a>
        </li>
      </ol>
    </nav>
  </div>
</nav>
<div class="py-5 mt-4">
    <div class="container">
        <div class="table-responsive">
            <div id="mycart">
                <?php 
                    $wishlist= getwishlistItems();

                    if(mysqli_num_rows($wishlist) > 0) {
                        ?>
                        <table class="table table-hover table-bordered align-middle mb-2 bg-white">
                        <!--Table head-->
                            <thead class="bg-light">
                                <tr class="text-center">
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Available stocks</th>
                                    <th>View</th>
                                    <th>Remove Wishlist</th>
                                </tr>
                            </thead>
                        <!--Table head-->
                        <!--Table body-->   
                            <tbody class="text-justify bg-light ">
                                <?php
                                    foreach ($wishlist as $WishListItem) {
                                        ?>
                                    <tr class="table-light">
                                    
                                        <td scope="row" class="text-center"><img src="uploads/<?= $WishListItem['image']; ?>" alt="Image" width="50px"></td>
                                        <td> <a href=""><?= $WishListItem['name']; ?></a> </td>
                                        <td class="text-center">Php: <?= number_format($WishListItem['selling_price'],2); ?></td>
                                        <?php if($WishListItem['qty'] != 0) { ?>
                                        <td class="text-center"><span class="fw-bold"><?= $WishListItem['qty']; ?></span></td>
                                        <?php } else {?>
                                            <td class="text-center"><span class="text-danger fw-normal">Not available*</span></td>
                                        <?php } ?>
                                        <td class="text-center"><a href="categories.php" class="btn btn-danger btn-sm" ><i class="fa fa-eye me-1"></i></a></td>
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
                            <div class="card card-body shadow text-center">
                                <h4 class="py-3 fw-bold ">Your wishlist is empty.</h4>
                            </div>
                    <?php
                    }
                    ?>
            </div>
        </div>
    </div>
</div>
<?php include('footer_information.php'); ?>

