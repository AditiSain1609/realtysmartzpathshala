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
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/progressbar_barfiller.css">
    <link rel="stylesheet" href="assets/css/gijgo.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/animated-headline.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
    <!-- ? Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo/loder.png" alt="">
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
                            <!-- Logo -->
                            <div class="col-xl-2 col-lg-2">
                                <div class="logo">
                                    <a href="index.html"><img src="Doc/img/Pathshala.png" alt=""></a>
                                </div>
                            </div>
                            <div class="col-xl-10 col-lg-10">
                                <div class="menu-wrapper d-flex align-items-center justify-content-end">
                                    <!-- Main-menu -->
                                    <div class="main-menu d-none d-lg-block">
                                        <nav>
                                            <ul id="navigation">
                                                <li class="active"><a href="index.html">Home</a></li>
                                                <li><a href="Project.html">Projects</a></li>
                                                <li><a href="about.html">About</a></li>
                                                <li><a href="#">Blog</a>
                                                    <!--<ul class="submenu">
                                                        <li><a href="dlf.html">Blog</a></li>
                                                        <li><a href="blog_details.html">Blog Details</a></li>
                                                        <li><a href="elements.html">Element</a></li>
                                                    </ul> -->
                                                </li>
                                                  <li><a href="contact.html">Contact</a></li>
                                               <?php if ($userName): ?>
    <li class="button-header">
        <div class="dropdown" style="position: relative; display: inline-block;">
            <button class="btn btn3 dropdown-toggle" style="cursor:pointer;">
                Your Account
            </button>
            <ul class="dropdown-menu" style="display:none; position:absolute; background:#fff; min-width:180px; box-shadow:0 4px 6px rgba(0,0,0,0.1); border-radius:5px; z-index:1000; padding:10px 0; list-style:none; margin:0;">
                <li><a href="profile_form.php" style="display:block; padding:8px 15px; color:#333; text-decoration:none;">Create Profile</a></li>
                <li><a href="take_test.php" style="display:block; padding:8px 15px; color:#333; text-decoration:none;">Aptitude Test</a></li>
                <li><a href="#" style="display:block; padding:8px 15px; color:#333; text-decoration:none;">Chat with Others</a></li>
                <li><a href="#" style="display:block; padding:8px 15px; color:#333; text-decoration:none;">Know About Your Team</a></li>
                <li><a href="index_logout.php" style="display:block; padding:8px 15px; color:#333; text-decoration:none;">Logout</a></li>
            </ul>
        </div>
    </li>
<?php else: ?>
    <li class="button-header">
        <a href="login.html" class="btn btn3">Log in</a>
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
        <main>
            <!--? slider Area Start-->
            <section class="slider-area slider-area2">
                <div class="slider-active">
                    <!-- Single Slider -->
                    <div class="single-slider slider-height2">
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-8 col-lg-11 col-md-12">
                                    <div class="hero__caption hero__caption2">
                                        <h1 data-animation="bounceIn" data-delay="0.2s">Contact us</h1>
                                        <!-- breadcrumb Start-->
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                                <li class="breadcrumb-item"><a href="contact.html">Contact</a></li>
                                            </ol>
                                        </nav>
                                        <!-- breadcrumb End -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--?  Contact Area start  -->
            <section class="contact-section">
                <div class="container">
                    <div class="d-none d-sm-block mb-5 pb-4">
                        <div id="map" style="height: 480px; width: 100%; position: relative; overflow: hidden;"><iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1514.9099369185642!2d77.03727222899911!3d28.39946832849089!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d230e36259593%3A0x833ef7f4c569d38!2sREALTY%20SMARTZ%20PVT%20LTD!5e1!3m2!1sen!2sin!4v1753340363743!5m2!1sen!2sin"
                                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin: 50px;">
                    <div class="col-12">
                        <h2 class="contact-title">Get in Touch</h2>
                    </div>
                    <div class="col-12 col-md-6">
                        <form id="contact-form" action="contact_process.php" method="post">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea class="form-control w-100" name="message" id="message" cols="30"
                                            rows="9" onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Enter Message'"
                                            placeholder=" Enter Message"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <input class="form-control valid" name="first_name" id="first_name" type="text"
                                            onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Enter your first name'"
                                            placeholder="First name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control valid" name="last_name" id="last_name" type="text"
                                            onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Enter your last name'" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control" name="email" id="email" type="email"
                                            onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Enter email address'" placeholder="Email">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="button button-contactForm boxed-btn">Send</button>
                            </div>

                        </form>

                    </div>
                    <div class="col-lg-3 offset-lg-1">
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-home"></i></span>
                            <div class="media-body">
                                <h3>Buttonwood, California.</h3>
                                <p>Rosemead, CA 91770</p>
                            </div>
                        </div>
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                            <div class="media-body">
                                <h3>+1 253 565 2365</h3>
                                <p>Mon to Fri 9am to 6pm</p>
                            </div>
                        </div>
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-email"></i></span>
                            <div class="media-body">
                                <h3>support@colorlib.com</h3>
                                <p>Send us your query anytime!</p>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </section>
            <!-- Contact Area End -->
        </main>
        <footer>
            <div class="footer-wrappper footer-bg">
                <!-- Footer Start-->
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
                                                <p>Unlock career growth, continuous learning, and leadership
                                                    opportunities
                                                    in a dynamic real estate environment.</p>
                                            </div>
                                        </div>
                                        <!-- social -->
                                        <div class="footer-social">
                                            <a href="https://www.linkedin.com/company/realtysmartz/posts/?feedView=all"><i
                                                    class="fab fa-linkedin"></i></a>
                                            <a href="https://www.instagram.com/realtysmartz/?hl=en"><i
                                                    class="fab fa-instagram"></i></a>
                                            <a
                                                href="https://www.youtube.com/results?search_query=Realthy+smartz+pvt+ltd"><i
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
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                                <div class="single-footer-caption mb-50">
                                    <div class="footer-tittle">
                                        <h4>Company</h4>
                                        <ul>
                                            <li><a href="#">Design & creatives</a></li>
                                            <li><a href="#">Telecommunication</a></li>
                                            <li><a href="#">Restaurant</a></li>
                                            <li><a href="#">Programing</a></li>
                                            <li><a href="#">Architecture</a></li>
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
        <div id="back-top">
            <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
        </div>
        <!-- JS here -->
        <script>
            $('#contact-form').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'contact_process.php',
                    data: $(this).serialize(),
                    success: function (r) { console.log('OK', r); },
                    error: function (xhr) { console.error('Error', xhr.status); }
                });
            });
        </script>
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