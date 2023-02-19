<nav class="navbar navbar-expand-lg navbar-dark sticky-top shadow sticky-top">
  <div class="container">
    <a class="navbar-brand" href="index.php">ECOMMERCE PROJECT</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="categories.php">Collections</a>
        </li>
        <li class="nav-item">
          <div id="navcount">
          <?php  
          if(isset($_SESSION['auth'])) {
              $count = getCartCount('carts');
              if(mysqli_num_rows($count) > 0 ) {
              foreach($count as $counts) {
            ?>
            <a class="nav-link cart-sharp" href="cart.php" ><ion-icon name="cart-sharp"></ion-icon>
                <sup><small><span class="badge badge-pill bg-warning text-dark cart_count"><?=  $counts['cart_count']; ?></span></small></sup>
            </a>
          <?php  }}} else {?> 
            <a class="nav-link cart-sharp" href="cart.php"><ion-icon name="cart-sharp"></ion-icon></a>
            <?php }?>
            </div>
          </li>
        <li class="nav-item">
          <div id="navwishlist">
          <?php  
          if(isset($_SESSION['auth'])) {
              $wishcount = getwishlistCount('wishlist');
              if(mysqli_num_rows($wishcount) > 0 ) {
              foreach($wishcount as $wishcounts) {
            ?>
            <a class="nav-link cart-sharp" href="my_wishlist.php"><ion-icon name="heart-sharp"></ion-icon><sup><small><span class="badge badge-pill bg-warning text-dark wishlist_count"><?=  $wishcounts['wishlist_count']; ?></span></small></sup></a>
            <?php  }}} else {?> 
              <a class="nav-link cart-sharp" href="my_wishlist.php"><ion-icon name="heart-sharp"></ion-icon></a>
              <?php }?>
          </div>
        </li>
<?php

        if(isset($_SESSION['auth'])) {
?>
        
        <li class="nav-item dropdown" href="">
          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?=  $_SESSION['auth_user']['name']; ?> 
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="account_settings.php">My profile</a></li>
            <li><a class="dropdown-item" href="my_orders.php">My Orders</a></li>
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
          </ul>
        </li>
<?php
        } else {

?>
        <li class="nav-item">
          <a class="nav-link" href="register.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
<?php
        }
?>
      </ul>
    </div>
  </div>
</nav>