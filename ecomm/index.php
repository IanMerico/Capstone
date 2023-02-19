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
<?php include('footer_information.php'); ?>

