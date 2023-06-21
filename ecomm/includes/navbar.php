<nav class="navbar navbar-expand-sm navbar-dark sticky-top shadow sticky-top p-1">
  <div class="container">

         
        <?php
       if(isset($_SESSION['auth'])) {
        $systemlogo = systemlogo();
    
        if(mysqli_num_rows($systemlogo) > 0) {
            $data = mysqli_fetch_array($systemlogo);
            $logo_src = "assets/images/".$data['business_logo'];
        }
        ?>

        <a class="navbar-brand text-dark" href="index.php">
        <img src="<?= $logo_src ?>" width="50px" height="50px">
        ApoBangpo Merch PH
        </a>

        <?php
      
      }
     else {

      $system_info = geticon("system_info");
      if ($system_info && mysqli_num_rows($system_info) > 0) {
          $row = mysqli_fetch_assoc($system_info);
          $business_logo = $row['business_logo'];
          $icon_path = "assets/images/" . $business_logo;
      } else {
          $icon_path = "assets/images/297979668_103856492433245_4893127009659140128_n-removebg-preview.png";
      }
      
      ?>

      


      <a class="navbar-brand text-dark" href="index.php">
      <img src="<?= $icon_path ?>" width="50px" height="50px">
      ApoBangpo Merch PH
      </a>

      <?php
    }

        ?>

        

        
       
    
      
    <!-- <img src="assets/images/297979668_103856492433245_4893127009659140128_n-removebg-preview.png" width="50px" height="50px">  -->
    


    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link home-sharp fw-bold" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-bold" href="categories.php">Collections</a>
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
        
        <li class="nav-item dropdown ms-auto btn-sm p-0" href="">
          <a class="nav-link dropdown-toggle fw-bold" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <span></span><?=  $_SESSION['auth_user']['name']; ?> 
          </a>
          <ul class="dropdown-menu dropdown-menu-info btn-sm p-0" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="nav-link  dropdown-item" href="account.php?=profile">
                <ion-icon name="person-circle-sharp" class="text-right"></ion-icon> 
                <label class="label-icon">My Account</label> 
              </a>
            </li>
            <li><a class="nav-link  dropdown-item" href="my_orders.php">
                    <ion-icon name="list-sharp" class="text-right"></ion-icon>
                    <label class="label-icon"> My Orders</label> 
                </a>
            </li>
            <div class="dropdown-divider"></div>
            <li>
              <a class="nav-link  dropdown-item cart-sharp" href="logout.php">
                <ion-icon name="log-out-sharp"></ion-icon>
                <label class="label-icon">Logout</label> 
              </a>
            </li>
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