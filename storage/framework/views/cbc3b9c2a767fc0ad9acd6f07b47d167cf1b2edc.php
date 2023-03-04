<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SEND</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/new_file/img/sendred.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" data-tag="font" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" data-tag="font" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" data-tag="font" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" data-tag="font" />

  <!-- Vendor CSS Files -->
  <link href="<?php echo e(url('assets/new_file/vendor/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(url('assets/new_file/vendor/bootstrap-icons/bootstrap-icons.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(url('assets/new_file/vendor/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(url('assets/new_file/vendor/aos/aos.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(url('assets/new_file/vendor/glightbox/css/glightbox.min.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(url('assets/new_file/vendor/swiper/swiper-bundle.min.css')); ?>" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo e(url('assets/new_file/css/main.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(url('assets/new_file/css/style.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(url('assets/new_file/css/responsive.css')); ?>" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css">

<style>
  button.slick-prev.slick-arrow{
    display: none !important;
  }
  button.slick-next.slick-arrow{
    display: none !important;
  }
  .hero .info h2 span {
    color: #B03138;
    margin-top: 10px;
}
.slide1{
 color: green !important;
margin-top:0px !important;
}
.slick-slider {
    margin-bottom: 0px !important;
}
.slide2{
  color: red!important;
  margin-top:0px !important;
}
span.slider.slick-initialized.slick-slider.slick-vertical {
    width: 42% !important;
}
.viagift{
  position: relative;
    bottom: 17px;
}
.col-lg-6.text-left {
    position: relative;
    right: 60px;
    bottom: 40px;
}
@media (max-width: 912px) {
    .col-lg-6.text-left {
      right: 0px;
    
  }
  span.slider.slick-initialized.slick-slider.slick-vertical {
      width: 15% !important;
  }
  .hero .info h2 {
      font-size: 20px;
      max-width: 100%;
  }
}


</style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center">
    <div class="container-fluid d-flex align-items-center justify-content-between">

      <a href="#" class="logo d-flex align-items-center">
        <img src="<?php echo e(asset('backend/img/send-logo-removebg-preview 1.png')); ?>">
      </a>

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
      <nav id="navbar" class="navbar">
        <ul>
          <!-- <li><a href="#aboutus" class="active">About Us</a></li> -->
          <li><a href="#constructions"> Features</a></li>
          <li><a href="#contact-us">Contact Us</a></li>
          <li><a href="blog" target="_blank">Blogs</a></li>
          <li class="login"><a href="<?php echo e(url('login')); ?>">Login</a></li>
          <!-- <li class="login"><a href="javascript:void(0)" onclick="showMaintance()">Login</a></li> -->
        </ul>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero">

    <div class="info d-flex align-items-center">
      <div class="container">
        <div class="row justify-content-flex-start">
          <div class="col-lg-6 text-left">
            <h2 class="d-flex align-items-center" data-aos="fade-down">Drive   <span class="slider">
    <h2 class="slide1">Customer</h2>
    <h2 class="slide2">Employee</h2>
  </span> Loyalty </h2><h2 class="viagift">via Gift Marketing
            <span>  Automation</span></h2>
            <!-- <p data-aos="fade-up" style="font-weight: 700; font:Public Sans">Use Data Driven Gifting to increase loyal customer base, increase prospect and generate better brand recall</p> -->
            <a data-aos="fade-up" data-aos-delay="200" href="https://calendly.com/sendsoftware/30min" class="btn-get-started">Book A Demo</a>
          </div>
        </div>
      </div>
    </div>

    <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">

      <div class="carousel-item active" style="background-image:url(<?php echo e(url('landing/images/banner02.png)')); ?>"></div>
    </div>

  </section>
  <!-- End Hero Section -->

  <main id="main">

    <!-- ======= rating Section ======= -->
    <section id="get-started" class="get-started section-bg">

      <div class="container">
        <div class="row justify-content-between gy-4">
          <div class="col-lg-12 col-md-12 rating" data-aos="fade">
            <h1 class="text-center" style="font-size: 3.5em;">Trusted by brands around the world</h1>
            <!-- <p>Trusted by brands around the world</p> -->
            <div class="d-flex align-items-center justify-content-between rating-side">
              <span> <img src="<?php echo e(url('landing/images/mcaffein.webp')); ?>"> </span>
              <span><img src="<?php echo e(url('landing/images/konica.webp')); ?>"> </span>
              <span> <img src="<?php echo e(url('landing/images/conductix.webp')); ?>"></span>
              <span> <img src="<?php echo e(url('landing/images/metro.webp')); ?>"></span>

            </div>
          </div>
        </div>
      </div>

    </section>
    <!-- End rating Section -->

    <!-- ======= services Section ======= -->
    <section id="constructions" class="constructions">
      <div class="container-fuild">
        <div class="section-header">
          <h2>Convert Gifting Into a Powerful Marketing Channel</h2>
          <p>Digital Marketing is old school. Adopt Gift Marketing and Boost your customer interactions by 4x.</p>
        </div>

        <div class="row">
          <div class="slides-service swiper">
            <div class="swiper-wrapper">



              <div class="swiper-slide">
                <div class="testimonial-wrap d-flex">
                  <div class="service-img-box">
                    <img src="<?php echo e(url('assets/new_file/img/msg.png')); ?>" class="service-img" alt="">
                  </div>
                  <div class="testimonial-item">
                    <h3>Send Physical Gift as Per Occasion</h3>
                    <p>Send gift kits curated by a team of gift experts suited for every occasion to create impact</p>
                  </div>
                </div>
              </div>
              <!-- End service item -->
              <div class="swiper-slide">
                <div class="testimonial-wrap d-flex">
                  <div class="service-img-box">
                    <img src="<?php echo e(url('assets/new_file/img/gift.png')); ?>" class="service-img" alt="">
                  </div>
                  <div class="testimonial-item">
                    <h3>Never Miss Any Occasion</h3>
                    <p> Automate sending gifts on birthdays, work anniversaries, festivals in One Click</p>
                  </div>
                </div>
              </div>
              <!-- End service item -->

              <div class="swiper-slide">
                <div class="testimonial-wrap d-flex">
                  <div class="service-img-box">
                    <img src="<?php echo e(url('assets/new_file/img/node.png')); ?>" class="service-img" alt="">
                  </div>
                  <div class="testimonial-item">
                    <h3>Boost Demand, Boost Revenue</h3>
                    <p> Increase leads for your business by attracting customers. Win over competition</p>
                  </div>
                </div>
              </div>
              <!-- End service item -->

              <div class="swiper-slide">
                <div class="testimonial-wrap d-flex">
                  <div class="service-img-box">
                    <img src="<?php echo e(url('assets/new_file/img/Icon.png')); ?>" class="service-img" alt="">
                  </div>
                  <div class="testimonial-item">
                    <h3>Send Gifts Globally Without Hassle</h3>
                    <p>Software has in built shipping option for domestic and international locations</p>
                  </div>
                </div>
              </div>


            </div>


            <div class="swiper-pagination"></div>
          </div>
          <div class="text-center">

            <button class="btn-get"><a href="#contact-us" style="color:white;" class="btn-get">get started </a><img src="<?php echo e(url('assets/new_file/img/ic_play_circle_outline_48px.png')); ?>"> </button>
          </div>
        </div>

      </div>
    </section>
    <!-- End Constructions Section -->
    <section id="feedback" class="feedback section-bg">

      <div class="container">
        <div class="col-lg-12 col-md-12 rating" data-aos="fade">
          <!-- <h1 class="text-center" style="font-size: 4.0em;">Trusted by brands around the world</h1> -->
          <div class="d-flex align-items-center justify-content-between rating-side">
            <span> <img src="<?php echo e(url('landing/images/feedback1.webp')); ?>"> </span>
            <span><img src="<?php echo e(url('landing/images/feedback2.webp')); ?>"> </span>
            <span> <img src="<?php echo e(url('landing/images/feedback3.webp')); ?>"></span>
            <span> <img src="<?php echo e(url('landing/images/feedback4.webp')); ?>"></span>
            <span> <img src="<?php echo e(url('landing/images/feedback5.webp')); ?>"></span>
          </div>
        </div>

    </section>
    <!-- ======= Alt Services Section ======= -->
    <section id="alt-services" class="alt-services">
      <div class="container-fuild" data-aos="fade-up">

        <div class="row justify-content-around gy-4">
          <div class="col-lg-5 d-flex flex-column justify-content-center">
            <h3>Reduce Cost of New Customer Acquisition</h3>
            <!-- <p>These companies release their own versions of the operating systems with minor changes, and yet always with the same bottom line. </p> -->

            <div class="icon-box d-flex position-relative align-items-center" data-aos="fade-up" data-aos-delay="100">
              <img src="<?php echo e(url('assets/new_file/img/Icon1.png')); ?>">
              <div>
                <h4><a class="stretched-link"> Send gifts to potential prospects</a></h4>
              </div>
            </div>
            <!-- End Icon Box -->

            <div class="icon-box d-flex position-relative align-items-center" data-aos="fade-up" data-aos-delay="200">
              <img src="<?php echo e(url('assets/new_file/img/Icon2.png')); ?>">
              <div>
                <h4><a class="stretched-link">Increase chance of engaging</a></h4>
              </div>
            </div><!-- End Icon Box -->

            <div class="icon-box d-flex position-relative align-items-center" data-aos="fade-up" data-aos-delay="300">
              <img src="<?php echo e(url('assets/new_file/img/Icon3.png')); ?>">
              <div>
                <h4><a class="stretched-link">Increase your brand recall</a></h4>
              </div>
            </div><!-- End Icon Box -->



          </div>

          <div class="col-lg-6 img-bg" style="background-image: url(<?php echo e(url('assets/new_file/img/temp.svg)')); ?>;" data-aos="zoom-in" data-aos-delay="100"></div>


        </div>

      </div>
    </section><!-- End Alt Services Section -->


    <!-- ======= Our Projects Section ======= -->
    <section id="projects" class="projects">
      <div class="container-fuild" data-aos="fade-up">

        <div class="section-header pb-md-0 mb-md-4 pb-1 ">
          <h2>Pre loaded Gift Options For Hassle Free Gifting</h2>
          <p class="mt-0 mt-md-4">Gifts for Every Occasion and Every category. Joining Kit, Fathers Day Kit, Mothers Day kit, Birthday Hampers, Diwali Hampers, Anniversary hampers etc</p>
        </div>
        <!-- <div class="text-center mb-4 mb-md-5">
        <button class="btn-get-see">See our gifts</button>
        </div>  -->
        <div class="slides-gifting swiper">
          <div class="swiper-wrapper">

            <div class="swiper-slide even">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <img src="<?php echo e(url('assets/new_file/img/giftpack-1.webp')); ?>" class="gift-img" alt="">
                </div>
              </div>
            </div>
            <!-- End testimonial item -->

            <div class="swiper-slide odd">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <img src="<?php echo e(url('assets/new_file/img/giftpack-2.webp')); ?>" class="gift-img" alt="">
                </div>
              </div>
            </div>
            <!-- End testimonial item -->

            <div class="swiper-slide even">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <img src="<?php echo e(url('assets/new_file/img/giftpack-3.webp')); ?>" class="gift-img" alt="">
                </div>
              </div>
            </div>
            <!-- End testimonial item -->

            <div class="swiper-slide odd">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <img src="<?php echo e(url('assets/new_file/img/giftpack-4.webp')); ?>" class="gift-img" alt="">
                </div>
              </div>
            </div>
            <!-- End testimonial item -->

            <div class="swiper-slide even">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <img src="<?php echo e(url('assets/new_file/img/giftpack-5.webp')); ?>" class="gift-img" alt="">

                </div>
              </div>
            </div>


            <!-- End testimonial item -->

          </div>
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
          <div class="swiper-pagination"></div>
        </div>


      </div>
    </section>
    <!-- End Our Projects Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials section-bg">
      <div class="container-fuild" data-aos="fade-up">

        <div class="section-header">
          <h2>One Software. Different Teams. Different Purpose</h2>
          <!-- <p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint.m velit mollit.</p> -->
        </div>

        <div class="slides-testimonial swiper">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="card">
                <img src="<?php echo e(url('landing/images/Marketing_Team.webp')); ?>" class="card-img-top" alt="...">
                <div class="card-body">
                  <div class="img-div d-flex">
                    <img src="<?php echo e(url('assets/new_file/img/human.png')); ?>" class="">
                    <span class="hr-team">
                      <h6>Marketing Team</h6>
                    </span>
                  </div>
                  <p class="card-text">Break the traditional marketing methods and generate game changing brand awareness with gifts and rewards.</p>
                </div>
              </div>
            </div>
            <!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="card">
                <img src="<?php echo e(url('landing/images/Sales_Team.webp')); ?>" class="card-img-top" alt="...">
                <div class="card-body">
                  <div class="img-div d-flex">
                    <img src="<?php echo e(url('assets/new_file/img/human.png')); ?>" class="">
                    <span class="hr-team">
                      <h6>Sales Team</h6>
                    </span>
                  </div>
                  <p class="card-text">Boost up your sales funnel with delighted prospects and loyal customers. Motivate them to do more business with you.</p>
                </div>
              </div>
            </div>
            <!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="card">
                <img src="<?php echo e(url('landing/images/HR_Team.webp')); ?>" class="card-img-top" alt="...">
                <div class="card-body">
                  <div class="img-div d-flex">
                    <img src="<?php echo e(url('assets/new_file/img/human.png')); ?>" class="">
                    <span class="hr-team">
                      <h6>HR Team</h6>
                    </span>
                  </div>
                  <p class="card-text">Employees are your biggest strenght. Show them that you care and they will win the world for you.</p>
                </div>
              </div>
            </div>
            <!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="card">
                <img src="<?php echo e(url('landing/images/CXO.webp')); ?>" class="card-img-top" alt="...">
                <div class="card-body">
                  <div class="img-div d-flex">
                    <img src="<?php echo e(url('assets/new_file/img/human.png')); ?>" class="">
                    <span class="hr-team">
                      <h6>CXO</h6>
                    </span>
                  </div>
                  <p class="card-text">Influence the Decision maker not only for more business but for better feedback and more referrals.</p>
                </div>
              </div>
            </div>
            <!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Testimonials Section -->


    <!--    <section id="real-story" class="real-story">
      <div class="container" data-aos="fade-up">
        <div class="real-head">
          <h3 class="real-heading">Real Stories from Real Customers</h3>
            <p class="real-para">Get inspired by these stories.</p>
        </div>

        <div class="row justify-content-center gy-4">
          <div class="col-lg-5 d-flex  justify-content-flex-end">
            <div class="saprate">
              <img src="<?php echo e(url('landing/images/metro.jpg')); ?>" class="quate-logo">
            <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="100">
              <img src="<?php echo e(url('assets/new_file/img/Quote-small.png')); ?>" class="quate-smal">
              <div class="Quote-para">
                <p>We absolutely love the experience of using this website! We've been using it for a while to send gifts to my clients and employees and I've never had a problem. The selection is great. The whole process of sending a gift with or without customization is smooth and hassle-free. I highly recommend this site to anyone looking for a great gift-giving experience.</p>
              </div>
             </div>
             <div class="real-details">
             <h5>Floyd Miles</h5>
                    <h6>Vice President, GoPro</h6>
              </div>
              </div>
           </div>
         <div class="col-lg-5 d-flex flex-column justify-content-center position-relative rightside">
          <div class="row d-flex flex-column justify-content-center">
            <div class="col-md-12">
              <div class="saprate one">
              <img src="<?php echo e(url('landing/images/mcaffein.png')); ?>" class="quate-logo">
            <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="100">
              <img src="<?php echo e(url('assets/new_file/img/Quote-small.png')); ?>" class="quate-smal">
              <div class="Quote-para">
                <p>Our company has been using Send1.in for our corporate gifting needs with your automated gifting service and we have been very happy with it. The website is easy to use. The customer service is also excellent and they have always been able to help us with any questions we have had.</p>
              </div>
             </div>
             <div class="real-details">
                 <h5>Jane Cooper</h5>
                    <h6>CEO, Airbnb</h6>
              </div>
              </div>
            </div>
            <div class="col-md-12 mt-md-4 mt-1 BookMyShow">
              <div class="saprate two">
              <img src="<?php echo e(url('landing/images/konica.png')); ?>" class="quate-logo">
            <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="100">
              <img src="<?php echo e(url('assets/new_file/img/Quote-small.png')); ?>" class="quate-smal">
              <div class="Quote-para">
                <p>I have found this website to be an invaluable resource for finding and sending gifts for clients and prospects. This website is very easy to use and the selection of gifts is excellent. I found the customer service very helpful and polite. I would highly recommend this website to anyone looking for a great way to find gifts for loved ones.</p>
              </div>
             </div>
             <div class="real-details">
             <h5>Kristin Watson</h5>
                    <h6>Co-Founder, BookMyShow</h6>
              </div>
              </div>
            </div>
          </div>



          </div>

        </div>

      </div>
    </section> -->

    <!-- <section class="section-bg-2" id="contact">
   <div class="section-bg-overlay"></div> -->
    <!--begin container-->
    <!-- <div class="container"> -->
    <!--begin row -->
    <!-- <div class="row"> -->
    <!--begin col-md-12-->
    <!-- <div class="col-md-12 text-center padding-bottom-10">
            <h2 class="section-title white-text">We will be delighted to get in touch with you</h2>
            <p class="section-subtitle white">Fill the form and get to know more details about how we are revolutionising the corporate gifting industry via powerful software to make gift campaigns, organise customers and employees, fine tune budget and plan the entire gifting calendar</p>
         </div> -->
    <!--end col-md-12 -->
    <!-- </div> -->
    <!--end row -->
    <!--begin row-->
    <!-- <div class="row justify-content-md-center"> -->
    <!--begin col-md-8-->
    <!-- <div class="col-md-8 text-center margin-top-10"> -->
    <!--begin contact-form-wrapper-->
    <!-- <div class="contact-form-wrapper wow bounceIn" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: bounceIn;"> -->
    <!--begin form-->
    <!-- <div> -->
    <!--begin success message -->
    <!-- <p class="contact_success_box" style="display:none;">We received your message and you will hear from us soon. Thank You!</p> -->
    <!--end success message -->
    <!--begin contact form -->
    <!-- <form id="contact-form" class="row contact-form contact form-group" action="javascript:void(0)" method="post"> -->
    <!-- <?php echo csrf_field(); ?> -->
    <!--begin col-md-6-->
    <!-- <div class="col-md-6">
                        <input class="contact-input form-control mb-3" required="" name="name" id="name" placeholder="Your Name*" type="text">
                        <input class="contact-input form-control mb-3" required="" name="mob" id="mob" placeholder="Phone Number*" type="text">
                     </div> -->
    <!--end col-md-6-->
    <!--begin col-md-6-->
    <!-- <div class="col-md-6">
                        <input class="contact-input form-control mb-3" required="" name="cname"  id="cname" placeholder="Company  Name*" type="text">
                        <input class="contact-input form-control mb-3" required="" name="contact_email" id="contact_email" placeholder="Email Address*" type="email">
                     </div> -->
    <!--end col-md-6-->
    <!--begin col-md-12-->
    <!-- <div class="col-md-12">
                        <button class="btn btn-primary" style="background-color: #B03138; border-color: #B03138;" id="btnSubmit" type="button">Submit</button>
                     </div> -->
    <!--end col-md-12-->
    <!-- </form> -->
    <!--end contact form -->
    <!-- <div class="col-md-12">
                     <span id="successmsg"></span>
                  </div>
               </div> -->
    <!--end form-->
    <!-- </div> -->
    <!--end contact-form-wrapper-->
    <!-- </div> -->
    <!--end col-md-8-->
    <!-- </div> -->
    <!--end row-->
    <!-- </div> -->
    <!--end container-->
    <!-- </section> -->


    <section class="banner" id="contact-us">
      <div class="info d-flex align-items-center">
        <div class="container-fuild d-flex justify-content-center banner-img" style="background-image:url(<?php echo e(url('assets/new_file/img/CTA.png)')); ?>">
          <div class="row justify-content-center align-items-center">
            <div class="col-lg-12 text-center align-items-center justify-content-center banner-text">
              <h2 class="text-center" data-aos="fade-down">Recharge your Business today with data driven gift marketing</h2>
              <p data-aos="fade-up">Kindly fill in the form below and our Expert will be in touch with you to grow your business.</p>
              <!-- <a data-aos="fade-up" data-aos-delay="200" href="#get-started" class="btn-get-started">Get Started</a> -->
              <form id="contact-form" class="row contact-form contact form-group" action="javascript:void(0)" method="post">
                <?php echo csrf_field(); ?>
                <!--begin col-md-6-->
                <div class="col-md-6">
                  <input class="contact-input form-control mb-3" required="" name="name" id="name" placeholder="Your Name*" type="text" tabindex="1">
                  <input class="contact-input form-control mb-3" required="" name="mobile" id="mobile" placeholder="Phone Number*" type="text" tabindex="3">
                </div>
                <!--end col-md-6-->
                <!--begin col-md-6-->
                <div class="col-md-6">
                  <input class="contact-input form-control mb-3" required="" name="company_name" id="company_name" placeholder="Company  Name*" type="text" tabindex="2">
                  <input class="contact-input form-control mb-3" required="" name="contact_email" id="contact_email" placeholder="Email Address*" type="email" tabindex="4">
                </div>
                <!--end col-md-6-->
                <!--begin col-md-12-->
                <div class="col-md-12">
                  <button class="btn btn-primary" style="background-color: #B03138; border-color: #B03138;" id="btnSubmit" type="button" tabindex="5">Submit</button>
                </div>
                <!--end col-md-12-->
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="footer-content position-relative">
      <div class="container">
        <div class="row">



          <div class="col-lg-6 col-md-6 footer-links">
            <h4>ABOUT THE SEND1.IN </h4>
            <ul>
              <li>Send1.in is a unique platform for Automated Gifting. We at Send1 are committed to understanding your needs to help you in increasing leads for your business by attracting customers and Winning over the competition with our hassle-free process. Send gift kits curated by a team of gift experts suited for every occasion that too in one click</li>

            </ul>
          </div>
          <!-- End footer links column-->

          <div class="col-lg-3 col-md-3 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><a href="#constructions">About Us</a></li>
              <li><a href="#contact-us">Contact Us</a></li>
              <li><a href="https://betasend1.wordpress.com" target="_blank">Blogs</a></li>
              <li><a href="https://calendly.com/sendsoftware/30min" target="_blank">Schedule Demo</a></li>
              <li><a href="#contact-us">We are Hiring</a></li>
            </ul>
          </div>
          <!-- End footer links column-->

          <div class="col-lg-3 col-md-3 footer-links">
            <h4>Social Media</h4>
            <ul>
              <li><a href="https://instagram.com/send1.in" target="_blank"><img src="<?php echo e(url('assets/new_file/img/instagram-symbol.png')); ?>" style="width:25px;"></a>&nbsp;&nbsp;
                <a href="https://www.facebook.com/send1.in" target="_blank"><img src="<?php echo e(url('assets/new_file/img/facebook-symbol.png')); ?>" style="width:25px;"></a></li>
            </ul>
          </div>
          <!-- End footer links column-->



          <!-- End footer info column-->


          <b>© <script>
              document.write(new Date().getFullYear())
            </script> Send1.in</b>
        </div>
      </div>
    </div>
  </footer>
  <!-- End Footer -->
 

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="<?php echo e(url('assets/new_file/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
  <script src="<?php echo e(url('assets/new_file/vendor/aos/aos.js')); ?>"></script>
  <script src="<?php echo e(url('assets/new_file/vendor/glightbox/js/glightbox.min.js')); ?>"></script>
  <script src="<?php echo e(url('assets/new_file/vendor/isotope-layout/isotope.pkgd.min.js')); ?>"></script>
  <script src="<?php echo e(url('assets/new_file/vendor/swiper/swiper-bundle.min.js')); ?>"></script>
  <script src="<?php echo e(url('assets/new_file/vendor/purecounter/purecounter_vanilla.js')); ?>"></script>
  <!--  Main JS File -->
  <script src="<?php echo e(url('assets/new_file/js/main.js')); ?>"></script>

  <script src="<?php echo e(url('assets/js/plugins/jquery-3.3.1.min.js')); ?>"></script>
  <script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.js "></script>
<script>
  $('.slider').slick({
  vertical: true,
  autoplay: true,
  autoplaySpeed: 3000,
  speed: 300
});
</script>

  <script type="text/javascript">
    document.getElementById("myButton").onclick = function() {
      location.href = "https://ekmatra.in";
    };
  </script>

  <script>
    $('#btnSubmit').on('click', function(e) {
      e.preventDefault()
      let formValue = $('#contact-form').serialize(); //  new FormData(this);
      $('.contact-submit').prop('disabled', true);
      $('.contact-submit').val('Please wait...');
      $.ajax({
        type: "post",
        url: '<?php echo e(url("save-contact")); ?>',
        data: formValue,
        // cache: false,
        // contentType: false,
        // processData: false,
        success: function(response) {
          if (response.success) {
            message('success', response.message);
            $('#successmsg').html('').html(response.message);
            setTimeout(function() {
              $('#successmsg').html('');
            }, 5000);
            $('#name').val('');
            $('#contact_email').val('');
            $('#mobile').val('');
            $('#company_name').val('');
          } else {
            $('#successmsg').html('').html(response.message);
            // message('error', response.message);
            printErrorMsg(response.errors);
          }
          $('.contact-submit').prop('disabled', false);
          $('.contact-submit').val('submit');
        },
        error: function(response) { 
          // console.log('eeror fun')
          // printErrorMsg(response.errors);
          $('.contact-submit').prop('disabled', false);
          $('.contact-submit').val('submit');
        },
      });

      function printErrorMsg (msg) {
            $.each( msg, function( key, value ) {
              toastr.error(value, {
          timeOut: 1500
        });
              // message('error', value);
            });
        }

    });


    function showMaintance(){
       message('info', 'The website is under maintenance. We are going live with host of new features at 3:00 PM, 20 Jan, 2023.');
    }

    // toaster common function
    function message(action, message) {
      if (action == 'success') {
        toastr.remove();
        toastr.options.closeButton = true;
        toastr.warning(message, {
          timeOut: 1500
        });
      }else if (action == 'info') {
        toastr.remove();
        toastr.options.closeButton = true;
        toastr.info(message, {
          timeOut: 5000
        });
      }  else {
        toastr.remove();
        toastr.options.closeButton = true;
        toastr.error(message, {
          timeOut: 1500
        });
      }
    }
  </script>
  <script>
    $(document).ready(function() {
      var itemsMainDiv = ('.MultiCarousel');
      var itemsDiv = ('.MultiCarousel-inner');
      var itemWidth = "";

      $('.leftLst, .rightLst').click(function() {
        var condition = $(this).hasClass("leftLst");
        if (condition)
          click(0, this);
        else
          click(1, this)
      });

      ResCarouselSize();




      $(window).resize(function() {
        ResCarouselSize();
      });

      //this function define the size of the items
      function ResCarouselSize() {
        var incno = 0;
        var dataItems = ("data-items");
        var itemClass = ('.item');
        var id = 0;
        var btnParentSb = '';
        var itemsSplit = '';
        var sampwidth = $(itemsMainDiv).width();
        var bodyWidth = $('body').width();
        $(itemsDiv).each(function() {
          id = id + 1;
          var itemNumbers = $(this).find(itemClass).length;
          btnParentSb = $(this).parent().attr(dataItems);
          itemsSplit = btnParentSb.split(',');
          $(this).parent().attr("id", "MultiCarousel" + id);


          if (bodyWidth >= 1200) {
            incno = itemsSplit[3];
            itemWidth = sampwidth / incno;
          } else if (bodyWidth >= 992) {
            incno = itemsSplit[2];
            itemWidth = sampwidth / incno;
          } else if (bodyWidth >= 768) {
            incno = itemsSplit[1];
            itemWidth = sampwidth / incno;
          } else {
            incno = itemsSplit[0];
            itemWidth = sampwidth / incno;
          }
          $(this).css({
            'transform': 'translateX(0px)',
            'width': itemWidth * itemNumbers
          });
          $(this).find(itemClass).each(function() {
            $(this).outerWidth(itemWidth);
          });

          $(".leftLst").addClass("over");
          $(".rightLst").removeClass("over");

        });
      }


      //this function used to move the items
      function ResCarousel(e, el, s) {
        var leftBtn = ('.leftLst');
        var rightBtn = ('.rightLst');
        var translateXval = '';
        var divStyle = $(el + ' ' + itemsDiv).css('transform');
        var values = divStyle.match(/-?[\d\.]+/g);
        var xds = Math.abs(values[4]);
        if (e == 0) {
          translateXval = parseInt(xds) - parseInt(itemWidth * s);
          $(el + ' ' + rightBtn).removeClass("over");

          if (translateXval <= itemWidth / 2) {
            translateXval = 0;
            $(el + ' ' + leftBtn).addClass("over");
          }
        } else if (e == 1) {
          var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
          translateXval = parseInt(xds) + parseInt(itemWidth * s);
          $(el + ' ' + leftBtn).removeClass("over");

          if (translateXval >= itemsCondition - itemWidth / 2) {
            translateXval = itemsCondition;
            $(el + ' ' + rightBtn).addClass("over");
          }
        }
        $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
      }

      //It is used to get some elements from btn
      function click(ell, ee) {
        var Parent = "#" + $(ee).parent().attr("id");
        var slide = $(Parent).attr("data-slide");
        ResCarousel(ell, Parent, slide);
      }

    });
  </script>

</body>

</html><?php /**PATH C:\xamp\htdocs\ek-send\resources\views/home.blade.php ENDPATH**/ ?>