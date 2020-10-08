<!doctype html>
<html class="no-js" lang="<?php echo e(app()->getLocale()); ?>">
	
<!-- Mirrored from rockstheme.com/rocks/WalletMenNow-live/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 30 Jul 2020 11:28:30 GMT -->
<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title><?php echo e(setting('site.site_name')); ?></title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- favicon -->		
		<link rel="shortcut icon" type="image/x-icon" href="img/logo/favicon.ico">

		<!-- all css here -->

		<!-- bootstrap v3.3.6 css -->
		<link rel="stylesheet" type="text/css" href="<?php echo e(asset('landing/welcome/css/bootstrap.min.css')); ?>">
		<!-- owl.carousel css -->
		<link rel="stylesheet" type="text/css" href="<?php echo e(asset('landing/welcome/css/owl.carousel.css')); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo e(asset('landing/welcome/css/owl.transitions.css')); ?>">
       <!-- Animate css -->
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('landing/welcome/css/animate.css')); ?>">
        <!-- meanmenu css -->
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('landing/welcome/css/meanmenu.min.css')); ?>">
        <!-- Nice-select css -->
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('landing/welcome/css/nice-select.css')); ?>">
		<!-- font-awesome css -->
		<link rel="stylesheet" type="text/css" href="<?php echo e(asset('landing/welcome/css/font-awesome.min.css')); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo e(asset('landing/welcome/css/themify-icons.css')); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo e(asset('landing/welcome/css/flaticon.css')); ?>">
		<!-- magnific css -->
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('landing/welcome/css/magnific.min.css')); ?>">
		<!-- style css -->
		<link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('landing/welcome/style.css')); ?>">
		<!-- responsive css -->
		<link rel="stylesheet" type="text/css" href="<?php echo e(asset('landing/welcome/css/responsive.css')); ?>">

		<!-- modernizr css -->
		<script src="<?php echo e(asset('landing/welcome/js/vendor/modernizr-2.8.3.min.js')); ?>"></script>
	</head>
		<body>

		<!--[if lt IE 8]>
			<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->

        <div id="preloader"></div>
        <header class="header-one">
            <!-- header-area start -->
            <div id="sticker" class="header-area hidden-xs">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="row">
                                <!-- logo start -->
                                <div class="col-md-3 col-sm-3">
                                    <div class="logo">
                                        <!-- Brand -->
                                        <a href="<?php echo e(url('/')); ?>"> <img src="<?php echo e(setting('site.welcome_page_logo_url')); ?>" class="navbar-brand page-scroll white-logo" alt="WMN">
										
                                        </a>
                                      
                                    </div>
                                    <!-- logo end -->
                                </div>
                                <div class="col-md-9 col-sm-9">
                                    <div class="header-right-link">
                                        <!-- search option end -->
										
										   <?php if(Route::has('login')): ?>
                            <ul class="member-actions">
                                    <?php if(Auth::check()): ?>
                                        <a href="<?php echo e(route('logout')); ?>" class="s-menu" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><?php echo e(__('Logout')); ?> <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                        <?php echo csrf_field(); ?>
                                    </form></a>
                                        <a href="<?php echo e(url('/home')); ?> " class="r-menu"><?php echo e(('My')); ?> <?php echo e(setting('site.site_name')); ?></a>
                                    <?php else: ?>
                                        <a href="<?php echo e(url('/register')); ?>" class="r-menu">Create Account</a>
                                      <a href="<?php echo e(url('/login')); ?>" class="s-menu"><?php echo e(__('Log in')); ?></a>
                                    <?php endif; ?>
                            </ul>
                            <?php endif; ?>
									
                                    </div>
                                    <!-- mainmenu start -->
                                    <!-- mainmenu end -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- header-area end -->
            <!-- mobile-menu-area start -->
            <div class="mobile-menu-area hidden-lg hidden-md hidden-sm">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mobile-menu">
                                <div class="logo">
                                    <a href="index-2.html"><img src="img/logo/logo.png" alt="" /></a>
                                </div>
                                <nav id="dropdown">
                                    <ul>
                                    
										 <li><a href="feature.html">Login</a></li>
                                        <li><a href="feature.html">Register</a></li>
                                       
                                    </ul>
                                </nav>
                            </div>					
                        </div>
                    </div>
                </div>
            </div>
            <!-- mobile-menu-area end -->		
        </header>
        <!-- header end -->
        <!-- Start Slider Area -->
		<div class="slide-area fix" data-stellar-background-ratio="0.6">
            <div class="display-table">
                <div class="display-table-cell">
					<div class="container">
						<div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <!-- Start Slider content -->
                                <div class="slide-content">
                                    <h2 class="title2">Move money in easy secure steps</h2>
                                    <p>Fast and easy you want to be more secure send and recives money sort time</p>
                                    <div class="layer-1-3">
									<?php if(Auth::check()): ?>
                                <a href="<?php echo e(url('/')); ?>/home" class="ready-btn left-btn">dashboard</a>
                            <?php else: ?>
                               <a href="<?php echo e(url('/')); ?>/login" class="ready-btn left-btn">Get Started</a>
                            <?php endif; ?>
									 </div>
                                </div>
                                <!-- End Slider content -->
						    </div>
						</div>
					</div>
				</div>
            </div>
		</div>
		<!-- End Slider Area -->
        <!-- Start How to area -->
        <div class="how-to-area area-padding">
            <div class="container">
                <div class="row">
                    <div class="all-services">
                        <!-- single-well end-->
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="well-services first-item">
                                <div class="well-img">
                                    <a class="big-icon" href="#"><i class="flaticon-user-12"></i></a>
                                </div>
                                <div class="main-wel">
                                    <div class="wel-content">
                                        <h4><span>01.</span>Creat an account</h4>
                                        <p>Aspernatur sit adipisci quaerat unde at neque Redug Lagre dolor sit amet consectetu. Agencies to define their new business objectives and then create</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single-well end-->
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="well-services ">
                                <div class="well-img">
                                    <a class="big-icon" href="#"><i class="flaticon-building"></i></a>
                                </div>
                                <div class="main-wel">
                                    <div class="wel-content">
                                        <h4><span>02.</span>Attach bank accounts</h4>
                                        <p>Aspernatur sit adipisci quaerat unde at neque Redug Lagre dolor sit amet consectetu. Agencies to define their new business objectives and then create</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single-well end-->
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="well-services thired-item">
                                <div class="well-img">
                                    <a class="big-icon" href="#"><i class="flaticon-worldwide"></i></a>
                                </div>
                                <div class="main-wel">
                                    <div class="wel-content">
                                        <h4><span>03.</span>Send money</h4>
                                        <p>Aspernatur sit adipisci quaerat unde at neque Redug Lagre dolor sit amet consectetu. Agencies to define their new business objectives and then create</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single-well end-->
                    </div>
                </div>
            </div>
        </div>
        <!-- End How to area -->
        <!-- Start About Area -->
        <div class="about-area bg-color fix area-padding">
            <div class="container">
               <div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="section-headline text-center">
                            <h3>Why choose WalletMenNow online plateform</h3>
                            <p>Help agencies to define their new business objectives and then create professional software.</p>
						</div>
					</div>
				</div>
                <div class="row">
                    <div class="support-all">
                        <!-- Start services -->
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="support-services wow ">
                                <a class="support-images" href="#"><i class="flaticon-like-2"></i></a>
                                <div class="support-content">
                                    <h4>Professional Services</h4>
                                    <p>Replacing a  maintains the amount of lines. When replacing a selection. help agencies to define their new business objectives and then create</p>
                                </div>
                            </div>
                        </div>
                        <!-- Start services -->
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="support-services ">
                                <a class="support-images" href="#"><i class="flaticon-transfer-3"></i></a>
                                <div class="support-content">
                                    <h4>Low costing</h4>
                                    <p>Replacing a  maintains the amount of lines. When replacing a selection. help agencies to define their new business objectives and then create</p>
                                </div>
                            </div>
                        </div>
                        <!-- Start services -->
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="support-services ">
                                <a class="support-images" href="#"><i class="flaticon-user-4"></i></a>
                                <div class="support-content">
                                    <h4>Live Support</h4>
                                    <p>Replacing a  maintains the amount of lines. When replacing a selection. help agencies to define their new business objectives and then create</p>
                                </div>
                            </div>
                        </div>
                        <!-- Start services -->
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="support-services">
                                <a class="support-images" href="#"><i class="flaticon-padlock"></i></a>
                                <div class="support-content">
                                    <h4>Safe & Security</h4>
                                    <p>Replacing a  maintains the amount of lines. When replacing a selection. help agencies to define their new business objectives and then create</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="about-contact text-center">
                                <div class="about-btn">
								<?php if(Auth::check()): ?>
                                <a href="<?php echo e(url('/')); ?>/home" class="ab-btn right-ab-btn">dashboard</a>
                            <?php else: ?>
                               <a href="<?php echo e(url('/')); ?>/login" class="ab-btn right-ab-btn">Create an Account</a>
                            <?php endif; ?>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End About Area -->
        <!-- service area start -->
        <div class="services-area area-padding-2">
            <div class="container">
               <div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="section-headline text-center">
                            <h3>WalletMenNow services worldwide</h3>
                            <p>Help agencies to define their new business objectives and then create professional software.</p>
						</div>
					</div>
				</div>
                <div class="row">
                    <div class="all-services">
                        <!-- single-well end-->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="single-service ">
                                <div class="service-img">
                                    <a class="service-icon" href="#"><i class="flaticon-transfer-1"></i></a>
                                </div>
                                <div class="main-service">
                                    <div class="service-content">
                                        <h4>Money Transfer</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single-well end-->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="single-service ">
                                <div class="service-img">
                                    <a class="service-icon" href="#"><i class="flaticon-piggy-bank"></i></a>
                                </div>
                                <div class="main-service">
                                    <div class="service-content">
                                        <h4>Bank deposit</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single-well end-->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="single-service ">
                                <div class="service-img">
                                    <a class="service-icon" href="#"><i class="flaticon-shopping-bag-1"></i></a>
                                </div>
                                <div class="main-service">
                                    <div class="service-content">
                                        <h4>Online Shopping</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single-well end-->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="single-service ">
                                <div class="service-img">
                                    <a class="service-icon" href="#"><i class="flaticon-smartphone"></i></a>
                                </div>
                                <div class="main-service">
                                    <div class="service-content">
                                        <h4>Online payment</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single-well end-->
                    </div>
                </div>
            </div>
        </div>
        <!-- End service area End -->
        <!-- Start Feature Area -->
        <div class="feature-area bg-color fix area-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="feature-content">
                            <div class="feature-images">
                                <img src="<?php echo e(asset('landing/welcome/img/feature/f1.png')); ?>" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="feature-text">
                            <h3>Move money for worldwide your startup business</h3>
						    <p>Replacing a  maintains the amount of lines. When replacing a selection. help agencies to define their new business objectives and then create. Replacing a  maintains the amount of lines. When replacing a selection. help agencies to define their new business objectives and then create. Replacing a  maintains the amount of lines. When replacing a selection. help agencies to define their new business objectives and then create. </p>
                            
							<?php if(Auth::check()): ?>
                                <a href="<?php echo e(url('/')); ?>/home" class="feature-btn">dashboard</a>
                            <?php else: ?>
                               <a href="<?php echo e(url('/')); ?>/login" class="feature-btn">Get Started</a>
                            <?php endif; ?>
							   </div>
                    </div>
                </div>
                <div class="row margin-row">
                    <div class="col-md-6 col-sm-6 hidden-xs">
                        <div class="feature-text">
                            <h3>Easily grow your business save more money</h3>
						    <p>Replacing a  maintains the amount of lines. When replacing a selection. help agencies to define their new business objectives and then create</p>
                            <ul>
                               <li><a href="#">Innovation idea latest business tecnology</a></li>
                                <li><a href="#">Digital content marketing online clients plateform</a></li>
                                <li><a href="#">Safe secure services for you online email account</a></li>
                            </ul>
							<?php if(Auth::check()): ?>
                                <a href="<?php echo e(url('/')); ?>/home" class="feature-btn">dashboard</a>
                            <?php else: ?>
                               <a href="<?php echo e(url('/')); ?>/login" class="feature-btn">Get Started</a>
                            <?php endif; ?>
							 </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="feature-content">
                            <div class="feature-images">
                                <img src="<?php echo e(asset('landing/welcome/img/feature/f2.png')); ?>" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="hidden-md hidden-lg hidden-sm col-xs-12">
                        <div class="feature-text">
                            <h3>Easily grow your business earn more money</h3>
						    <p>Replacing a  maintains the amount of lines. When replacing a selection. help agencies to define their new business objectives and then create</p>
                            <ul>
                               <li><a href="#">Innovation idea latest business tecnology</a></li>
                                <li><a href="#">Digital content marketing online clients plateform</a></li>
                                <li><a href="#">Safe secure services for you online email account</a></li>
                            </ul>
                            <?php if(Auth::check()): ?>
                                <a href="<?php echo e(url('/')); ?>/home" class="feature-btn">dashboard</a>
                            <?php else: ?>
                               <a href="<?php echo e(url('/')); ?>/login" class="feature-btn">Get Started</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Feature Area -->
        <!-- Start brand Banner area -->
        <div class="brand-area area-padding fix" data-stellar-background-ratio="0.6">
            <div class="container">
               <div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						 <div class="brand-text text-center">
                            <h3> We are happy our business partner relationship buildup</h3>
						</div>
					</div>
				</div>
            </div>
        </div>
        <div class="brand-area-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="brand-content">
						<?php if(Auth::check()): ?>
                                <a href="<?php echo e(url('/')); ?>/home" class="hire-btn">dashboard</a>
                            <?php else: ?>
                               <a href="<?php echo e(url('/')); ?>/login" class="hire-btn">Get Started</a>
                            <?php endif; ?>
                         </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End brand Banner area -->
        <!-- Core feature start -->
        <div class="core-feature-area bg-color area-padding-2">
            <div class="container">
               <div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="section-headline text-center">
                            <h3>WalletMenNow core feature</h3>
                            <p>Help agencies to define their new business objectives and then create professional software.</p>
						</div>
					</div>
				</div>
                <div class="row">
                    <div class="all-core-feature">
                        <!-- single-well end-->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="core-feature ">
                                <div class="core-img">
                                    <a class="core-icon" href="#"><i class="flaticon-target"></i></a>
                                </div>
                                <div class="main-core">
                                    <div class="core-content">
                                        <h4>Fraud detection</h4>
                                        <p>Aspernatur sit adipisci quaerat unde at neque Redug Lagre dolor sit amet consectetu.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single-well end-->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="core-feature ">
                                <div class="core-img">
                                    <a class="core-icon" href="#"><i class="flaticon-user-8"></i></a>
                                </div>
                                <div class="main-core">
                                    <div class="core-content">
                                        <h4>Support manager</h4>
                                        <p>Aspernatur sit adipisci quaerat unde at neque Redug Lagre dolor sit amet consectetu.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single-well end-->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="core-feature ">
                                <div class="core-img">
                                    <a class="core-icon" href="#"><i class="flaticon-settings-2"></i></a>
                                </div>
                                <div class="main-core">
                                    <div class="core-content">
                                        <h4>Account updater</h4>
                                        <p>Aspernatur sit adipisci quaerat unde at neque Redug Lagre dolor sit amet consectetu.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single-well end-->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="core-feature ">
                                <div class="core-img">
                                    <a class="core-icon" href="#"><i class="flaticon-smartphone"></i></a>
                                </div>
                                <div class="main-core">
                                    <div class="core-content">
                                        <h4>Payment invoice</h4>
                                        <p>Aspernatur sit adipisci quaerat unde at neque Redug Lagre dolor sit amet consectetu.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single-well end-->
                        <div class="col-md-offset-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="core-feature ">
                                <div class="core-img">
                                    <a class="core-icon" href="#"><i class="flaticon-transfer"></i></a>
                                </div>
                                <div class="main-core">
                                    <div class="core-content">
                                        <h4>Payments types</h4>
                                        <p>Aspernatur sit adipisci quaerat unde at neque Redug Lagre dolor sit amet consectetu.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single-well end-->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="core-feature ">
                                <div class="core-img">
                                    <a class="core-icon" href="#"><i class="flaticon-speech-bubble"></i></a>
                                </div>
                                <div class="main-core">
                                    <div class="core-content">
                                        <h4>Simple checkout</h4>
                                        <p>Aspernatur sit adipisci quaerat unde at neque Redug Lagre dolor sit amet consectetu.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single-well end-->
                    </div>
                </div>
            </div>
        </div>
        <!-- Core feature End -->
        <!-- Start Download area -->
		<!-- End Download area -->
        <!-- Start Banner Area -->
        <div class="banner-area area-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="banner-all area-80 text-center">
                            <div class="banner-content">
                                <h3>Our worldwide integration partner work with long time relationship </h3>
	<?php if(Auth::check()): ?>
                                <a href="<?php echo e(url('/')); ?>/home" class="banner-btn">dashboard</a>
                            <?php else: ?>
                               <a href="<?php echo e(url('/')); ?>/login" class="banner-btn">Open new account</a>
                            <?php endif; ?>                               
							  </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Banner Area -->
        <!-- Start Footer Area -->
        <footer class="footer-1">
          
            <div class="footer-area-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="copyright">
                                <p>
                                    Copyright © 2020
                                    <a href="#">WalletMenNow</a> All Rights Reserved
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer Area -->
		
		<!-- all js here -->

		<!-- jquery latest version -->
		<script src="<?php echo e(asset('landing/welcome/js/vendor/jquery-1.12.4.min.js')); ?>"></script>
		<!-- bootstrap js -->
		<script src="<?php echo e(asset('landing/welcome/js/bootstrap.min.js')); ?>"></script>
		<!-- owl.carousel js -->
		<script src="<?php echo e(asset('landing/welcome/js/owl.carousel.min.js')); ?>"></script>
		  <!-- stellar js -->
        <script src="<?php echo e(asset('landing/welcome/js/jquery.stellar.min.js')); ?>"></script>
		<!-- Counter js -->
		<script src="<?php echo e(asset('landing/welcome/js/jquery.counterup.min.js')); ?>"></script>
		<!-- waypoint js -->
		<script src="<?php echo e(asset('landing/welcome/js/waypoints.js')); ?>"></script>
        <!-- Nice-select js -->
        <script src="<?php echo e(asset('landing/welcome/js/jquery.nice-select.min.js')); ?>"></script>
		<!-- magnific js -->
        <script src="<?php echo e(asset('landing/welcome/js/magnific.min.js')); ?>"></script>
        <!-- wow js -->
        <script src="<?php echo e(asset('landing/welcome/js/wow.min.js')); ?>"></script>
        <!-- meanmenu js -->
        <script src="<?php echo e(asset('landing/welcome/js/jquery.meanmenu.js')); ?>"></script>
		<!-- Form validator js -->
		<script src="<?php echo e(asset('landing/welcome/js/form-validator.min.js')); ?>"></script>
		<!-- plugins js -->
		<script src="<?php echo e(asset('landing/welcome/js/plugins.js')); ?>"></script>
		<!-- main js -->
		<script src="<?php echo e(asset('landing/welcome/js/main.js')); ?>"></script>
	</body>

<!-- Mirrored from rockstheme.com/rocks/WalletMenNow-live/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 30 Jul 2020 11:29:38 GMT -->
</html>