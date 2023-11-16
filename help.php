<?php
include('functions/userfunctions.php');
include('includes/header.php');
?>

 <!--------------- HELP ------------------------------------------------------->
 <div class="py-5">
    <div class="container">
        <div class="row">
            <section id="help-description">
                <div class="help-desc">
                    <h1> HELP</h1>
                    <h4> How can we help you?</h4>
                </div>
                <div class="descrip-row">
                    <div class="descrip-col">
                <h3> FAQs</h3>
                <p>Our Frequently Asked Question</p>
                    </div>
                    <div class="descrip-col">
                <h3> REPORT A PROBLEM</h3>
                <p>Report Any Issue Encounter</p>
                    </div>
                    <div class="descrip-col">
                <h3> SUPPORT US</h3>
                <p>Rate and React Our Community</p>
                    </div>
                </div>
            </section>
        </div>
    </div>
 </div>
<!------------------------FAQS LINE ---------------------------------->
<div class="py-2">
    <div class="container">
        <div class="row">
            <section id="FAQS">
                <div class="faqs-section">
                        <h1>FREQUENTLY ASKED QUESTIONS</h1>
                        <h4> Useful FAQ's</h4>
                </div>
            </section>  
        </div>
    </div>
</div>
<!------------------------FAQS QUESTION ---------------------------------->
<div class="py-2">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                    <div class="faqs-body">
                        <div class="questions-body">
                            <div class="content-body">
                        <div class="faq-header">
                            <h3> What is All About Basketball?</h3>
                            <span class="open active">˅</span>
                            <span class="close">˄</span>
                            </div>
                            <div class="content ">
                            <p>
                                A paragraph is defined as “a group of sentences or a single sentence that forms a unit
                                A paragraph is defined as “a group of sentences or a single sentence that forms a unit
                            </p>
                            </div>
                        </div>
                        <div class="content-body">
                        <div class="faq-header">
                            <h3> What are the Unique AAB Product? </h3>
                            <span class="open active">˅</span>
                            <span class="close">˄</span>
                            </div>
                            <div class="content">
                            <p>
                            •A paragraph is defined as “a group of sentences or a single sentence that forms a unit
                                A paragraph is defined as “a group of sentences or a single sentence that forms a unit
                                A paragraph is defined as “a group of sentences or a single sentence that forms a unit
                            </p>
                            </div>
                        </div>
                        <div class="content-body">
                        <div class="faq-header">
                            <h3> Physical Location for AAB Clothing Line</h3>
                            <span class="open active">˅</span>
                            <span class="close">˄</span>
                            </div>
                            <div class="content">
                            <p>
                                A paragraph is defined as “a group of sentences or a single sentence that forms a unit
                                A paragraph is defined as “a group of sentences or a single sentence that forms a unit
                                A paragraph is defined as “a group of sentences or a single sentence that forms a unit
                            </p>
                            </div>
                        </div>
                    </div>
                 </div>   
            </div>
        </div>
    </div>
</div>
 <!---------------------------------- REPORT PROBLEM ---------------------------------------->
 <div class="container">
     <div class="card shadow mb-5 mt-3">
        <div class="card-body">
            <div class="py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                                <section id="report-problem">
                                    <div style="margin: 0 30px;">
                                        <div class="report-desc">
                                                <h1> REPORT A PROBLEM</h1>
                                                <h4> Let's Do Some Action To Your Concern </h4>
                                        </div>
                                        <div class="report-subject">
                                            <h2> Don't Hesistate Your <br> Concerns And Inquiries </h2>
                                        </div>
                                    </div>
                                    <div class="body">
                                            <div class="report-header">
                                            <h4> <strong> Danielle Bab T. Ebio </strong></h4>
                                                <div class="content">
                                                <p><i class="fa fa-phone"></i> &nbsp; (+63) 9272853091</p>
                                                <div class="underscore"></div>
                                                <p><i class="fa fa-map-marker"></i> &nbsp; Imus City, Cavite</p>
                                            </div>
                                        </div>
                                        <div class="report-header">
                                            <h4> <strong> Gabriel Jett Hilario </strong></h4>
                                        <div class="content">
                                        <p><i class="fa fa-phone"></i> &nbsp; (+63) 9813795514</p>
                                            <div class="underscore"></div>
                                            <p><i class="fa fa-map-marker"></i> &nbsp; Zapote Kalinisan Bacoor, Cavite</p>
                                            </div>
                                        </div>
                                    </div>
                    <!---------------------------------- CONTACT FORM ---------------------------------------->
                                    <form id="report-form" action="code.php" method="POST">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="res-form">
                                                        <label for="fullname" class="report-label">Fullname</label>
                                                        <input type="text" id="name" class="underscore-input form-control" required autocomplete="off">
                                                    </div>
                                                    <div class="res-form">
                                                        <label for="email" class="report-label">Email</label>
                                                        <input type="text" id="email" class="underscore-input form-control" required autocomplete="off">
                                                    </div>
                                                    <div class="res-form">
                                                        <label for="contact" class="report-label">Contact Number</label>
                                                        <input type="text" id="contact" class="underscore-input form-control" required autocomplete="off">
                                                    </div>
                                                    <div class="res-form">
                                                        <label for="address" class="report-label">Address (Optional) </label>
                                                        <input type="text" id="address" class="underscore-input form-control" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="res-form">
                                                        <label for="inquiries" class="report-label">Title Inquiries</label>
                                                        <select required id="inquiries" required class="form-select mb-2 bg-color-light mt-2">
                                                            <option selected hidden>Select an option</option>
                                                            <!-- Your options here -->
                                                        </select>
                                                    </div>
                                                    <div class="res-form">
                                                        <label for="message" class="report-label">Message</label>
                                                        <input type="text" id="message" class="underscore-input form-control" autocomplete="off" required>
                                                    </div>
                                                    <div class="res-form">
                                                        <button class="report-submit" type="submit" onclick="sendEmail()" name="help_btn">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <h4 class="sent-notification"></h4>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
     </div>
 </div>
<!-------------- FOOTER LAYER ------------------->
<div class="py-5 bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h4 class="text-white"> <strong> All About Basketball </strong></h4>
                <div class="underlines mb-2"></div>
                <a href="index.php" class="text-info"><i class="fa fa-angle-right"></i> Home</a>
                <br>
                <!-- <a href="" class="text-info"><i class="fa fa-angle-right"></i> Collection</a><br> -->
                <a href="categories.php" class="text-info"><i class="fa fa-angle-right"></i> AAB Collections</a>
                <br>
                <a href="help.php" class="text-info"><i class="fa fa-angle-right"></i> Help</a>
                <br>
                <a href="cart.php" class="text-info"><i class="fa fa-angle-right"></i> Cart</a>
                <br>
                <a href="my-orders.php" class="text-info"><i class="fa fa-angle-right"></i> Track Order</a> 
                <br>
                <a href="terms.php" class="text-info"><i class="fa fa-angle-right"></i> Terms and Services</a>          
            </div>
            <div class="col-md-3">
                <h4 class="text-white"> <strong> Address </strong> </h4>
                <a href="tel:+639451278635" class="text-white"  style="display: block; margin-bottom: 10px;"><i class="fa fa-phone">&nbsp; (+63) 9813795513</i></a>
                <a href="mailto:" class="text-white"><i class="fa fa-envelope"> &nbsp;allaboutbasketball4102@gmail.com</i></a>
                <a href="https://www.google.com/maps?q=Maliksi+3+Bacoor,+Cavite" target="_blank" class="text-white" style="display: block; margin-top: 10px;"><i class="fa fa-map-marker"></i> &nbsp; Maliksi 3 Bacoor, Cavite</a>

            </div>
            <div class="col-md-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3864.687474098946!2d120.9523358!3d14.45997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397cd8d14cb0d5f%3A0x5cecad8590a32f1e!2sFX52%2BXWP%2C%20Maliksi%20Elementary%20School%2C%20Maliksi%2C%20Bacoor%2C%20Cavite%2C%20Gen.%20Evangelista%20Street%2C%20Bacoor%2C%20Cavite!5e0!3m2!1sen!2sph!4v1625191187386!5m2!1sen!2sph" width="600" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

            <div class="col-md-3 mt-2">
                <a href="https://www.facebook.com/Allaboutbasketballclothing?mibextid=LQQJ4d" class="text-white mr-3"><i class="fa fa-facebook"></i> Facebook</a>
                <a href="https://www.instagram.com/all_about_basketballclo/?igshid=MzRlODBiNWFlZA%3D%3D&fbclid=IwAR2602htvIx4OrtBU9y7eS_qncnBAAv65NIdriK2SFL7acTCi1oEiv1kt9c" class="text-white" style="margin-left: 15px;"><i class="fa fa-instagram"></i> Instagram</a>
            </div>
        </div>
    </div>
</div>
<div class="py-2 bg-warning">
    <div class="text-center">
        <p class="mb-0">All Rights Reserved Copyright @ National College of Science & Technology <?= date('Y')?></p>
    </div>
</div>
<?php include('includes/footer.php'); ?>
<script>
  const faqHeaders = document.querySelectorAll(".faq-header");

  faqHeaders.forEach((header) => {
    header.addEventListener("click", () => {
      const faqBody = header.nextElementSibling;
      const openIcon = header.querySelector(".open");
      const closeIcon = header.querySelector(".close");

      faqBody.classList.toggle("active");
      openIcon.classList.toggle("active");
      closeIcon.classList.toggle("active");
    });
  });
</script>

