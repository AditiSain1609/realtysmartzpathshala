<?php
session_start();
$userName = isset($_SESSION['user_name']) ? $_SESSION['user_name']
         : (isset($_SESSION['user_email']) ? $_SESSION['user_email'] : null);
?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Realty Smartz Pathshala</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="/assets/img/favicon.png">

    <!-- CSS here -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/css/slicknav.css">
    <link rel="stylesheet" href="/assets/css/flaticon.css">
    <link rel="stylesheet" href="/assets/css/progressbar_barfiller.css">
    <link rel="stylesheet" href="/assets/css/gijgo.css">
    <link rel="stylesheet" href="/assets/css/animate.min.css">
    <link rel="stylesheet" href="/assets/css/animated-headline.css">
    <link rel="stylesheet" href="/assets/css/magnific-popup.css">
    <link rel="stylesheet" href="/assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="/assets/css/themify-icons.css">
    <link rel="stylesheet" href="/assets/css/slick.css">
    <link rel="stylesheet" href="/assets/css/nice-select.css">
    <link rel="stylesheet" href="/assets/css/style.css">

</head>

<body>
 <!-- ? Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="/assets/img/logo/loder.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <header>
        <!-- Header Start -->
        <div class="header-area header-transparent">
            <div class="main-header ">
                <div class="header-bottom  header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!--Logo -->
                            <div class="col-xl-2 col-lg-2">
                                <div class="logo">
                                    <a href="index.html"><img class="logo-pathshala" src="/assets/img/Pathshala.png" alt=""></a>

                                </div>
                            </div>
                <div class="col-xl-10 col-lg-10">
    <div class="menu-wrapper d-flex align-items-center justify-content-end">
        <!-- Main-menu -->
        <div class="main-menu d-none d-lg-block">
            <nav>
                <ul id="navigation">
                    <li class="active"><a href="/main/index.html">Home</a></li>
                    <li><a href="/main/Project.html">Projects</a></li>
                    <li><a href="/main/about.html">About</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="/main/contact.html">Contact</a></li>

                
                      <?php if ($userName): ?>
    <li class="button-header">
        <div class="dropdown" style="position: relative; display: inline-block;">
            <button class="btn btn3 dropdown-toggle" style="cursor:pointer;">
                Your Account
            </button>
            <ul class="dropdown-menu" style="display:none; position:absolute; background:#fff; min-width:180px; box-shadow:0 4px 6px rgba(0,0,0,0.1); border-radius:5px; z-index:1000; padding:10px 0; list-style:none; margin:0;">
                <li><a href="/backend /profile_form.php" style="display:block; padding:8px 15px; color:#333; text-decoration:none;">Create Profile</a></li>
                <li><a href="/backend /take_test.php" style="display:block; padding:8px 15px; color:#333; text-decoration:none;">Aptitude Test</a></li>
                <li><a href="#" style="display:block; padding:8px 15px; color:#333; text-decoration:none;">Chat with Others</a></li>
                <li><a href="/admin/team.php" style="display:block; padding:8px 15px; color:#333; text-decoration:none;">Know About Your Team</a></li>
                <li><a href="/backend /index_logout.php" style="display:block; padding:8px 15px; color:#333; text-decoration:none;">Logout</a></li>
            </ul>
        </div>
    </li>
<?php else: ?>
    <li class="button-header">
        <a href="/main/login.html" class="btn btn3">Log in</a>
    </li>
<?php endif; ?>

<style>
/* Dropdown hover effect */
.dropdown:hover .dropdown-menu {
    display: block !important;
}
.dropdown-menu li a:hover {
    background: #f0f0f0;
}
</style>
  </nav>
        </div>
    </div>
</div>

  <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>

    <main>
        <!--? slider Area Start-->
        <section class="slider-area ">
            <div class="slider-active">
                <!-- Single Slider -->
                <div class="single-slider slider-height d-flex align-items-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-6 col-lg-7 col-md-12">
                                <div class="hero__caption">
                                    <h1 data-animation="fadeInLeft" data-delay="0.2s">Realty Smartz<br> Pathshala</h1>
                                    <p data-animation="fadeInLeft" data-delay="0.4s">Empowering businesses with skilled
                                        professionals, we build high-performing sales teams that drive smarter
                                        strategies and deliver stronger results.</p>
                                    <a href="#" class="btn hero-btn" data-animation="fadeInLeft"
                                        data-delay="0.7s">Explore Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ? services-area -->
        <div class="services-area">
            <div class="container">
                <div class="row justify-content-sm-center">
                    <div class="col-lg-4 col-md-6 col-sm-8">
                        <div class="single-services mb-30">
                            <div class="features-icon">
                                <img src="/assets/img/icon/icon1.svg" alt="">
                            </div>
                            <div class="features-caption">
                                <h3>Real Estate Expertise</h3>
                                <p>Delivering top-tier property solutions with trusted market insights.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-8">
                        <div class="single-services mb-30">
                            <div class="features-icon">
                                <img src="/assets/img/icon/icon2.svg" alt="">
                            </div>
                            <div class="features-caption">
                                <h3>Employee Achievements</h3>
                                <p>Celebrating our team’s milestones, growth, and outstanding contributions.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-8">
                        <div class="single-services mb-30">
                            <div class="features-icon">
                                <img src="/assets/img/icon/icon3.svg" alt="">
                            </div>
                            <div class="features-caption">
                                <h3>Project Training</h3>
                                <p>Empowering employees through expert-led training on new developments.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Courses area start -->
        <div class="courses-area section-padding40 fix">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        <div class="section-tittle text-center mb-55">
                            <h2>We are Viral on YouTube</h2>
                        </div>
                    </div>
                </div>
                <div class="courses-actives">
                    <!-- Single -->
                    <div class="properties pb-20">
                        <div class="properties__card">

                            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/gj_ZLm_NRAI"
                                title="New Launch  | Signature Global 37 D | Ultra Luxury High Rise Apartments | Call - 8010841841"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

                            <div class="properties__caption">
                                <p>29K Views</p>
                                <h3><a href="#">Signature Global 37 D | Ultra Luxury High Rise Apartments</a></h3>
                                <p>Our luxurious high rise apartments offer stunning city views and all the modern
                                    amenities you could hope for. From Deluxe+ apartments to sky terraces and everything
                                    in between, there's a perfect apartment for you.

                                </p>
                                <div class="properties__footer d-flex justify-content-between align-items-center">
                                    <div class="restaurant-name">
                                        <div class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half"></i>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                    <!-- Single -->
                    <!-- Single -->
                    <div class="properties pb-20">
                        <div class="properties__card">

                            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/Owqh1QvEMMQ"
                                title="Satya Hive | Pre-Leased Investment 75 lacs | TATA Zudio| 8010841841"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

                            <div class="properties__caption">
                                <p>26K Views</p>
                                <h3><a href="#">Satya Hive | Pre-Leased Investment 75 lacs | TATA Zudio|</a></h3>
                                <p> In Gurgaon zudio is a new fashion hub. That's why we bring pre-leased investment of
                                    TATA Zudio today. TATA Zudio investment start from 75 lacs and rent from day1 is
                                    30,000 per month with 18 years of lease.</p>
                                <div class="properties__footer d-flex justify-content-between align-items-center">
                                    <div class="restaurant-name">
                                        <div class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half"></i>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                    <!-- Single -->
                    <div class="properties pb-20">
                        <div class="properties__card">

                            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/10UcIl-OY7I"
                                title="Get Confirmed Allotment for Signature Global 37D | Delux DXP2 | Watch Now! 8010841841"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

                            <div class="properties__caption">
                                <p>9.6K Views</p>
                                <h3><a href="#">Get Confirmed Allotment for Signature Global 37D | Delux DXP2 </a></h3>
                                <p>Signature new launch on Dwarka Expressway at location of 37D means Signature Global
                                    37D dxp2 . Being customer and investor you'll get confirmed allotment.

                                </p>
                                <div class="properties__footer d-flex justify-content-between align-items-center">
                                    <div class="restaurant-name">
                                        <div class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half"></i>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                    <!-- Single -->
                    <div class="properties pb-20">
                        <div class="properties__card">

                            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/vjA2FNa0Md0"
                                title="Don’t Invest in Signature Global Daxin Vistas | South of Gurgaon Sohna |Before watching this video"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

                            <div class="properties__caption">
                                <p>12K Views</p>
                                <h3><a href="#">Signature Global Daxin Vistas | South of Gurgaon Sohna</a></h3>
                                <p>In this detailed video, we take you through an in-depth review of Signature Global
                                    Daxin Vistas, one of the most talked-about residential projects in the
                                    fast-developing South of Gurgaon (Sohna) region.

                                </p>
                                <div class="properties__footer d-flex justify-content-between align-items-center">
                                    <div class="restaurant-name">
                                        <div class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half"></i>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                    <!-- Single -->
                </div>
            </div>
        </div>
        <!-- Courses area End -->
        <!--? About Area-1 Start -->
        <section class="about-area1 fix pt-10">
            <div class="support-wrapper align-items-center">
                <div class="left-content1">
                    <div class="about-icon">
                        <img src="/assets/img/icon/about.svg" alt="">
                    </div>
                    <!-- section tittle -->
                    <div class="section-tittle section-tittle2 mb-55">
                        <div class="front-text">
                            <h2 class="">Learn new skills with top Realtors Of Realty Smartz</h2>
                            <p>Learn new skills, gain real-world insights, and grow your career by working alongside
                                top-performing realtors at Realty Smartz.</p>
                        </div>
                    </div>
                    <div class="single-features">
                        <div class="features-icon">
                            <img src="/assets/img/icon/right-icon.svg" alt="">
                        </div>
                        <div class="features-caption">
                            <p>Learn directly from experts actively closing deals in Gurgaon’s dynamic real estate
                                market.</p>
                        </div>
                    </div>
                    <div class="single-features">
                        <div class="features-icon">
                            <img src="/assets/img/icon/right-icon.svg" alt="">
                        </div>
                        <div class="features-caption">
                            <p>Get one-on-one guidance from seasoned professionals with proven sales strategies and
                                negotiation skills.</p>
                        </div>
                    </div>

                    <div class="single-features">
                        <div class="features-icon">
                            <img src="/assets/img/icon/right-icon.svg" alt="">
                        </div>
                        <div class="features-caption">
                            <p>Work on actual live projects, not just theory—gain practical knowledge that accelerates
                                your growth.</p>
                        </div>
                    </div>
                </div>
                <div class="right-content1">
                    <!-- img -->
                    <div class="right-img">
                        <img src="/assets/img/gallery/about.png" alt="">

                        <div class="video-icon">
                            <a class="popup-video btn-icon" href="/assets/img/gallery/video_V2.mp4"><i
                                    class="fas fa-play"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About Area End -->
        <!--? top subjects Area Start -->
        <div class="topic-area section-padding40">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        <div class="section-tittle text-center mb-55">
                            <h2>Explore top Projects</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single-topic text-center mb-30">
                            <div class="topic-img">
                                <img src="/assets/img/gallery/topic1.png" alt="">
                                <div class="topic-content-box">
                                    <div class="topic-content">
                                        <h3><a href="/main/Project.html">Shapoorji Pallonji</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single-topic text-center mb-30">
                            <div class="topic-img">
                                <img src="/assets/img/gallery/topic2.png" alt="">
                                <div class="topic-content-box">
                                    <div class="topic-content">
                                        <h3><a href="/main/Project.html">DLF Privana</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single-topic text-center mb-30">
                            <div class="topic-img">
                                <img src="/assets/img/gallery/topic3.png" alt="">
                                <div class="topic-content-box">
                                    <div class="topic-content">
                                        <h3><a href="/main/Project.html">Signature Global Daxin</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single-topic text-center mb-30">
                            <div class="topic-img">
                                <img src="/assets/img/gallery/topic4.png" alt="">
                                <div class="topic-content-box">
                                    <div class="topic-content">
                                        <h3><a href="/main/Project.html">Heritage Plots,<br>Pataudi</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single-topic text-center mb-30">
                            <div class="topic-img">
                                <img src="/assets/img/gallery/topic5.png" alt="">
                                <div class="topic-content-box">
                                    <div class="topic-content">
                                        <h3><a href="/main/Project.html">Omaxe The State</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single-topic text-center mb-30">
                            <div class="topic-img">
                                <img src="/assets/img/gallery/topic6.png" alt="">
                                <div class="topic-content-box">
                                    <div class="topic-content">
                                        <h3><a href="/main/Project.html">Ganga Realty</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single-topic text-center mb-30">
                            <div class="topic-img">
                                <img src="/assets/img/gallery/topic7.png" alt="">
                                <div class="topic-content-box">
                                    <div class="topic-content">
                                        <h3><a href="/main/Project.html">Trehan, Sector 35</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single-topic text-center mb-30">
                            <div class="topic-img">
                                <img src="/assets/img/gallery/topic8.png" alt="">
                                <div class="topic-content-box">
                                    <div class="topic-content">
                                        <h3><a href="/main/Project.html">Dubai Projects</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-12">
                        <div class="section-tittle text-center mt-20">
                            <a href="/main/Project.html" class="border-btn">View More Subjects</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- top subjects End -->
        <!--? About Area-3 Start -->
        <section class="about-area3 fix">
            <div class="support-wrapper align-items-center">
                <div class="right-content3">
                    <!-- img -->
                    <div class="right-img">
                        <img src="/assets/img/gallery/about2.png" alt="">
                    </div>
                </div>
                <div class="left-content3">
                    <!-- section tittle -->
                    <div class="section-tittle section-tittle2 mb-20">
                        <div class="front-text">
                            <h2 class="">Celebrating Employee Achievements</h2>
                        </div>
                    </div>
                    <div class="single-features">
                        <div class="features-icon">
                            <img src="/assets/img/icon/right-icon.svg" alt="">
                        </div>
                        <div class="features-caption">
                            <p>Our team consistently surpasses sales targets and delivers exceptional results across
                                projects.</p>
                        </div>
                    </div>
                    <div class="single-features">
                        <div class="features-icon">
                            <img src="/assets/img/icon/right-icon.svg" alt="">
                        </div>
                        <div class="features-caption">
                            <p>Employees are recognized for outstanding service and building long-term client
                                relationships.</p>
                        </div>
                    </div>
                    <div class="single-features">
                        <div class="features-icon">
                            <img src="/assets/img/icon/right-icon.svg" alt="">
                        </div>
                        <div class="features-caption">
                            <p>We celebrate individual milestones, fostering a culture of growth, learning, and
                                appreciation.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About Area End -->
        <!--? Team -->
        <section class="team-area section-padding40 fix">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        <div class="section-tittle text-center mb-55">
                            <h2>Our Top Achivers</h2>
                        </div>
                    </div>
                </div>
                <div class="team-active">
                    <div class="single-cat text-center">
                        <div class="cat-icon">
                            <img src="/assets/img/gallery/team1.png" alt="">
                        </div>
                        <div class="cat-cap">
                            <h5><a href="services.html">Ms. Punita Yadav</a></h5>
                            <p>The automated process all your website tasks.</p>
                        </div>
                    </div>
                    <div class="single-cat text-center">
                        <div class="cat-icon">
                            <img src="/assets/img/gallery/team2.png" alt="">
                        </div>
                        <div class="cat-cap">
                            <h5><a href="services.html">Mrs. Khushbu Yadav</a></h5>
                            <p>The automated process all your website tasks.</p>
                        </div>
                    </div>
                    <div class="single-cat text-center">
                        <div class="cat-icon">
                            <img src="/assets/img/gallery/team3.png" alt="">
                        </div>
                        <div class="cat-cap">
                            <h5><a href="services.html">Mr. Aayush</a></h5>
                            <p>The automated process all your website tasks.</p>
                        </div>
                    </div>
                    <div class="single-cat text-center">
                        <div class="cat-icon">
                            <img src="/assets/img/gallery/team4.png" alt="">
                        </div>
                        <div class="cat-cap">
                            <h5><a href="services.html">Ms. Mansi Aggrawal</a></h5>
                            <p>The automated process all your website tasks.</p>
                        </div>
                    </div>
                    <div class="single-cat text-center">
                        <div class="cat-icon">
                            <img src="/assets/img/gallery/team3.png" alt="">
                        </div>
                        <div class="cat-cap">
                            <h5><a href="services.html">Ms. Manisha</a></h5>
                            <p>The automated process all your website tasks.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Services End -->
        <!--? About Area-2 Start -->
        <section class="about-area2 fix pb-padding">
            <div class="support-wrapper align-items-center">
                <div class="right-content2">
                    <!-- img -->
                    <div class="right-img">
                        <img src="assets/img/gallery/about2.png" alt="">
                    </div>
                </div>
                <div class="left-content2">
                    <!-- section tittle -->
                    <div class="section-tittle section-tittle2 mb-20">
                        <div class="front-text">
                            <h2 class="">Empowering Through Training</h2>
                            <p>Our dedicated training programs equip team members with in-depth real estate knowledge,
                                sales skills, and project insights ensuring every professional at Realty Smartz grows
                                with confidence and expertise.</p>
                            <a href="#" class="btn">Explore More...</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About Area End -->
    </main>
    <footer>
        <div class="footer-wrappper footer-bg">
            <!-- Footer Start-->
            <div class="footer-area footer-padding">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-xl-4 col-lg-5 col-md-4 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="single-footer-caption mb-30">
                                    <!-- logo -->
                                    <div class="footer-logo mb-25">
                                        <a href="index.html"><img src="Pathshala.png" alt=""></a>
                                    </div>
                                    <div class="footer-tittle">
                                        <div class="footer-pera">
                                            <p>Unlock career growth, continuous learning, and leadership opportunities
                                                in a dynamic real estate environment.</p>
                                        </div>
                                    </div>
                                    <!-- social -->
                                    <div class="footer-social">
                                        <a href="https://www.linkedin.com/company/realtysmartz/posts/?feedView=all"><i
                                                class="fab fa-linkedin"></i></a>
                                        <a href="https://www.instagram.com/realtysmartz/?hl=en"><i
                                                class="fab fa-instagram"></i></a>
                                        <a href="https://www.youtube.com/results?search_query=Realthy+smartz+pvt+ltd"><i
                                                class="fab fa-youtube"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-5">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>Our solutions</h4>
                                    <ul>
                                        <li><a href="Project.html">DLF</a></li>
                                        <li><a href="Project.html">Shapoorji Pallonji</a></li>
                                        <li><a href="Project.html">Ganga Realty</a></li>
                                        <li><a href="Project.html">Signature Global</a></li>
                                        <li><a href="Project.html">M3M</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>Support</h4>
                                    <ul>
                                        <li><a href="Project.html">Heritage Homes Plots</a></li>
                                        <li><a href="Project.html">Omaxe The State</a></li>
                                        <li><a href="Project.html">Trehan</a></li>
                                        <li><a href="Project.html">Danube Properties</a></li>
                                        <li><a href="Project.html">Dubai Real Estate</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer-bottom area -->
            <div class="footer-bottom-area">
                <div class="container">
                    <div class="footer-border">
                        <div class="row d-flex align-items-center">
                            <div class="col-xl-12 ">
                                <div class="footer-copy-right text-center">
                                    <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                    © 2025 Realty Smartz Pathshala.  All rights reserved |
                                     Made with <i class="fa fa-heart" aria-hidden="true"></i> by <a
                                            href="https://engagexpert.in/" target="_blank">EngageXpert</a>
                                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End-->
        </div>
    </footer>
    <!-- Scroll Up -->
    <div id="back-top">
        <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
    </div>

    <!-- JS here -->
    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="./assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/slick.min.js"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/animated.headline.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>

    <!-- Date Picker -->
    <script src="./assets/js/gijgo.min.js"></script>
    <!-- Nice-select, sticky -->
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>
    <!-- Progress -->
    <script src="./assets/js/jquery.barfiller.js"></script>

    <!-- counter , waypoint,Hover Direction -->
    <script src="./assets/js/jquery.counterup.min.js"></script>
    <script src="./assets/js/waypoints.min.js"></script>
    <script src="./assets/js/jquery.countdown.min.js"></script>
    <script src="./assets/js/hover-direction-snake.min.js"></script>

    <!-- contact js -->
    <script src="./assets/js/contact.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/mail-script.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/main.js"></script>

</body>
</html>