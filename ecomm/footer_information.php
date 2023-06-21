<footer class="py-3 bg-dark mt-2">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-12">
                <h4 class="text-dark">ApoBangpo Merch PH</h4>
                <div class="underline mb-2"></div>
                <ul class="list-unstyled">
                    <li><a href="index.php" class="text-dark"><i class="fa fa-angle-right"></i> HOME</a></li>
                    <li><a href="#" class="text-dark"><i class="fa fa-angle-right"></i> About Us</a></li>
                    <li><a href="cart.php" class="text-dark"><i class="fa fa-angle-right"></i> My Cart</a></li>
                    <li><a href="categories.php" class="text-dark"><i class="fa fa-angle-right"></i> Our Collections</a></li>
                </ul>
            </div>
            <div class="col-md-3 col-12 text-dark">
                <h4>Address</h4>
                <div class="underline mb-2"></div>
                <p>
                    8020 A Mabini St. <br>
                    Purok 5 San Martin III, <br>
                    San Jose del Monte, Philippines
                </p>
                <p><a href="tel:+639356542524"><i class="fa fa-phone"></i> 0935-168-2020</a></p>
                <p><a href="mailto:thedeveloper@gmail.com"><i class="fa fa-envelope"></i> kazeemir04@gmail.com</a></p>
            </div>
            <div class="col-md-6 col-12">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3856.357710781836!2d121.05305571437196!3d14.86126307462077!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397a95dae958743%3A0xb00b4dde6b58ad0f!2sBarangay%20San%20Martin%20III!5e0!3m2!1sen!2sph!4v1671151616527!5m2!1sen!2sph" class="embed-responsive-item" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</footer>
<footer class="py-2 navbar">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <p class="mb-0 text-dark">All rights reserved. Copyright &#0169; Group4 -
                    <?= date('Y'); ?>
                </p>
            </div>
        </div>
    </div>
</footer>
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




