<?php
include('./functions/userfunctions.php');
include('./includes/header.php');
?>

<!------------- MARQUEE ------------->
<div class="py-3">
    <div class="container">
            <div class="row mt-4">
                <div style="position: absolute; left: 0; font-size: 40px; font-weight:500px; margin-left: 100px; width:25%;">
                    <marquee behavior="scroll" direction="right" scrollamount="10" scrolldelay="100">Month's New Arrival</marquee>
                </div>
                <div style=" margin-top: 70px; padding-left: 15px;justify-content: space-between;letter-spacing: 0.2em; font-size:14px;">
                <p>CHECK OUT THIS MONTH'S NEW ARRIVAL</p>
                </div>
             </div>
    </div>
</div>
  
<!------------------------- PRODUCT SLIDER -------------------->
<div class="slide">
<div class="py-2">
	<div class="container">
		<div class="row">
                <section id="new-arrival-container">
                    <div class="nav-body">
                        <div class="nav-wrapper">
                            <div class="wrapper-holder">
                                <div id="slider-img-1"></div>
                                <div id="slider-img-2"></div>
                                <div id="slider-img-3"></div>
                                <div id="slider-img-4"></div>
                                <div id="slider-img-5"></div>
                            </div>
                        </div>
                        <div class="button-holder">
                            <a href="#slider-img-1" class="button"></a>
                            <a href="#slider-img-2" class="button"></a>
                            <a href="#slider-img-3" class="button"></a>
                            <a href="#slider-img-4" class="button"></a>
                        </div>
                    </div>
                </section>	
		</div>
	</div>
</div>
</div>

<!------------------ COLLECTION DISPLAY ------------------------>

<div class="py-3">
    <div class="container">
        <div class="row">
            <div class="col">
            <h4 class="text-dark"> <strong> AAB Collection </strong> </h4>
                <div class="underlines mb-2"></div>
                <div class="row">
                    <?php 
                        $categories = getAllActive("categories");

                        if(mysqli_num_rows($categories) > 0)
                        {
                            foreach($categories as $item)
                            {
                                ?>
                                    <div class="col-md-3 mb-2">
                                        <a href="products.php?category=<?= $item['slug']; ?>">
                                            <div class="card shadow">
                                                <div class="card-body">
                                                    <img src="./uploads/<?= $item['image']; ?>"  width="250px" height="250px" alt="Category Image" class = "w-100">
                                                    <h4 class = "text-center text-danger"> <strong> <?= $item['slug']; ?> </strong></h4>
                                                </div>
                                            </div>
                                        </a>
                                    </div>    
                                <?php
                            }
                        }
                        else
                        {
                            echo "Sorry No Available!";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!------------------ PRODUCTS DISPLAY ------------------------>
<div class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-dark"> <strong> AAB Products </strong> </h4>
                <div class="underlines mb-2"></div>
                <div class="owl-carousel">
                    <?php
                        $trendingProducts = getAllTrending();
                        if(mysqli_num_rows($trendingProducts) > 0)
                        {
                            foreach ($trendingProducts as $item) {
                                ?>
                                    <div class="item">
                                        <a href="product-view.php?product=<?= $item['slug']; ?>">
                                            <div class="card shadow">
                                                <div class="card-body">
                                                    <!-- Image File Not Working -->
                                                    <h5><?=  $item['image']; ?></h5>
                                                    <img src="./uploads/<?= $item['image']; ?>"  width="350px" height="300px" alt="Product Image" class = "w-100">
                                                    <h6 class = "text-center text-dark"> <strong> <?= $item['name']; ?> </strong></h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>    
                            <?php
                            }
                        }
                        else
                        {
                            echo "Sorry No Available!";
                        }
                    ?>
                </div>             
            </div>
        </div>
    </div>
</div>



<!--------------------------------------------- PRODUCT SALES  ---------------------->

<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div class="lagayan">
                <div class="prodl">
                    <div class="card-imahe car-1"></div>
                    <h2>Hot Offers</h2>
                    <p>Check Out Our New Hot Offers</p>
                        <a href="">Shop Now</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="lagayan">
                <div class="prodl">
                    <div class="card-imahe car-2"></div>
                    <h2>Check Out Now</h2>
                    <p>Check Out Your Favorite Items</p>
                    <a href="">Shop Now</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="lagayan">
                <div class="prodl">
                    <div class="card-imahe car-3"></div>
                    <h2>Discover Our Collection</h2>
                    <p>Be the first to avail or new collections</p>
                    <a href="">Shop Now</a>
                </div>
            </div>
        </div>
    </div>
</div>



<!------------------ Featured  ----------------->

<!-- <div class="py-2">
    <div class="container">
        <div class="row">
            <section id="feature" class="section-p1">
                <div class="fe-box">
                    <img src="feature/checked.png" alt="">
                    <h6> Safe Transaction </h6>
                </div>
                <div class="fe-box">
                    <img src="feature/trust.png" alt="">
                    <h6> Trustworthy </h6>
                </div>
                <div class="fe-box">
                    <img src="feature/customer-loyalty.png" alt="">
                    <h6> Top Notch Service </h6>
                </div>
                <div class="fe-box">
                    <img src="feature/customer-service.png" alt="">
                    <h6> Good Quality </h6>
                </div>
                <div class="fe-box">
                    <img src="feature/express-delivery.png" alt="">
                    <h6> Accurate Delivery </h6>
                </div>
            </section>
                    </div>
        </div>
    </div>
</div> -->

<!--------------------- Featured MODEL --------------------------------------->
<div class="py-5 mt-3">
    <div class="container">
        <div class="row">

            <div class="title" style = "text-align:center; margin: 40px 0px 40px 0px">
                    <h2>ALL STAR COLLECTION </h2>
                    <p> ALL ABOUT BASKETBALL CLOTHING LINE</p>
                </div>
                 
            

            <section id="product1">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6  mb-4">
                            <div class="card">
                                <img src="aab_images/model2.jpg" class="card-img-top" alt="Model 2">
                                <div class="card-body">
                                    <h5 class="card-title">Collection 2</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6  mb-4">
                            <div class="card">
                                <img src="aab_images/model3.jpg" class="card-img-top" alt="Model 3">
                                <div class="card-body">
                                    <h5 class="card-title">Collection 3</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6  mb-4">
                            <div class="card">
                                <img src="aab_images/model4.jpg" class="card-img-top" alt="Model 4">
                                <div class="card-body">
                                    <h5 class="card-title">Collection 4</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6  mb-4">
                            <div class="card">
                                <img src="aab_images/model5.jpg" class="card-img-top" alt="Model 5">
                                <div class="card-body">
                                    <h5 class="card-title">Collection 5</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6  mb-4">
                            <div class="card">
                                <img src="aab_images/model6.jpg" class="card-img-top" alt="Model 6">
                                <div class="card-body">
                                    <h5 class="card-title">Collection 6</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6  mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title ">Be a Model</h5>
                                    <p class="card-text">WE HOPE THAT YOU WILL BE PART OF OUR MODEL</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>


<!------------------------------------------------------------------------ -->
<!-- <div class="py-5 bg-f2f2f2 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-dark"> <strong> About Us </strong></h4>
                <div class="underline mb-2 text-info"></div>
                <p>
                    AAB
                </p>
                <p>
                    AAB
                    </p>
                    <p>
                    AAB
                    </p>
                
                
                
                          
            </div>
        </div>
    </div> -->



<!-------------- FOOTER LAYER ------------------->

<!-- Proper Footer Design -->
<!-- <a href="" class="text-info"><i class="fa fa-angle-right"></i> Collection</a><br> -->
<footer>
    <div class="bg-dark py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h4 class="text-white"><strong>All About Basketball</strong></h4>
                    <div class="underline mb-3"></div>
                    <ul class="list-unstyled">
                        <li><a href="index.php" class="text-info">Home</a></li>
                        <li><a href="categories.php" class="text-info">AAB Collections</a></li>
                        <li><a href="help.php" class="text-info">Help</a></li>
                        <li><a href="cart.php" class="text-info">Cart</a></li>
                        <li><a href="my-orders.php" class="text-info">Track Order</a></li>
                        <li><a href="terms.php" class="text-info">Terms and Services</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h4 class="text-white"><strong>Address</strong></h4>
                    <ul class="list-unstyled">
                        <li><a href="tel:+639451278635" class="text-white"><i class="fa fa-phone"></i> (+63) 9813795513</a></li>
                        <li><a href="mailto:allaboutbasketball4102@gmail.com" class="text-white"><i class="fa fa-envelope"></i> allaboutbasketball4102@gmail.com</a></li>
                        <li><a href="https://www.google.com/maps?q=Maliksi+3+Bacoor,+Cavite" target="_blank" class="text-white"><i class="fa fa-map-marker"></i> Maliksi 3 Bacoor, Cavite</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mt-2">
                    <ul class="list-unstyled">
                        <li><a href="https://www.facebook.com/Allaboutbasketballclothing?mibextid=LQQJ4d" class="text-white"><i class="fa fa-facebook"></i> Facebook</a></li>
                        <li><a href="https://www.instagram.com/all_about_basketballclo/?igshid=MzRlODBiNWFlZA%3D%3D&fbclid=IwAR2602htvIx4OrtBU9y7eS_qncnBAAv65NIdriK2SFL7acTCi1oEiv1kt9c" class="text-white"><i class="fa fa-instagram"></i> Instagram</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <div class="map-con">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3864.687474098946!2d120.9523358!3d14.45997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397cd8d14cb0d5f%3A0x5cecad8590a32f1e!2sFX52%2BXWP%2C%20Maliksi%20Elementary%20School%2C%20Maliksi%2C%20Bacoor%2C%20Cavite%2C%20Gen.%20Evangelista%20Street%2C%20Bacoor%2C%20Cavite!5e0!3m2!1sen!2sph!4v1625191187386!5m2!1sen!2sph" width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-warning py-2">
        <div class="container">
            <div class="text-center">
                <p class="mb-0">All Rights Reserved Copyright @ National College of Science & Technology <?= date('Y')?></p>
            </div>
        </div>
    </div>
</footer>


<?php include('includes/footer.php'); ?>
<script>

$(document).ready(function () {
    $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:3
        }
    }
})
});
</script>