<?php 
// session_start();
include('functions/userfunctions.php');
include('includes/header.php');
include('includes/slider.php');

?>
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Trending Products</h4>
                <div class="underline mb-2"></div>
                <hr>
                <div class="owl-carousel">
                    <?php
                        $trendingProducts = getAllTrending();
                        if(mysqli_num_rows($trendingProducts) > 0) {

                            foreach($trendingProducts as $item) {
                                ?>
                                <div class="mb-2 item">
                                    <a href="product_view.php?product=<?= $item['slug']; ?>">
                                        <div class="card shadow">
                                            <div class="card-body">
                                                <img src="uploads/<?= $item['image']; ?>" alt="Product Image" class="w-100">
                                                <h6 class="text-center"><?= $item['name']; ?></h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>                                              
                            <?php
                            }

                        }
                    ?>
                </div>
             </div>
        </div>
    </div>
</div>

<div class="py-5 bg-f2f2f2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>About Us</h4>
                <div class="underline mb-2"></div>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat, nemo? Beatae repellat similique velit quo reiciendis laudantium! Totam adipisci ratione est obcaecati explicabo similique voluptatum consequuntur enim quae ullam tenetur rem, mollitia qui laudantium optio dolorum dolore consectetur. Ea quis, eveniet quasi quisquam velit ut distinctio! Illo, esse. Praesentium eos dolorem molestiae harum repudiandae quidem perferendis error, aliquam quas quos, commodi in minima nobis fuga doloribus odit inventore dolor? Molestias velit deserunt odit explicabo quasi architecto. Similique modi vel iusto, totam inventore excepturi voluptate tempore nihil ducimus aperiam, architecto aliquam sed natus possimus accusamus obcaecati quisquam vitae et officiis eligendi.
                </p>
                <hr>
             </div>
        </div>
    </div>
</div>
<!-- This is footer area -->
<div class="py-5 bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h4 class="text-white">Ecommerce Project</h4>
                <div class="underline mb-2"></div>
                <a href="index.php" class="text-white"><i class="fa fa-angle-right"></i> HOME</a> <br>
                <a href="#" class="text-white"><i class="fa fa-angle-right"></i> About Us</a><br>
                <a href="cart.php" class="text-white"><i class="fa fa-angle-right"></i> My Cart</a><br>
                <a href="categories.php" class="text-white"><i class="fa fa-angle-right"></i> Our Collections</a>
             </div>
             <div class="col-md-3 text-white">
                <h4>Address</h4>
                <div class="underline mb-2"></div>
                <p>
                    8020 A Mabini St. 
                    Purok 5 San Martin III, 
                    San Jose del Monte, Philippines
                </p>
                <a href="tel: +63 9356542524"><i class="fa fa-phone"></i> 0935-168-2020</a><br>
                <a href="mailto: thedeveloper@gmail.com"><i class="fa fa-envelope"></i> kazeemir04@gmail.com</a>
             </div>
             <div class="col-md-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3856.357710781836!2d121.05305571437196!3d14.86126307462077!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397a95dae958743%3A0xb00b4dde6b58ad0f!2sBarangay%20San%20Martin%20III!5e0!3m2!1sen!2sph!4v1671151616527!5m2!1sen!2sph" class="w-100" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
             </div>
        </div>
    </div>
</div>
<div class="py-2 bg-danger">
    <div class="text-center">
        <p class="mb-0 text-white">All rights reserved. Copyright @ Group4 - <?= date('Y'); ?></p>
    </div>
</div>

<?php include('includes/footer.php') ?>
<script>
    $(document).ready(function() {
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:5
                }
            }
        })
    });
</script>

