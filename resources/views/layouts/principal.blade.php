<!DOCTYPE html>
<html lang="en">
   <!-- Basic -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!-- Mobile Metas -->
   <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <!-- Site Metas -->
   <title>Softfede</title>
   <meta name="keywords" content="">
   <meta name="description" content="">
   <meta name="author" content="">
   <!-- Site Icons -->
   <link rel="shortcut icon" href="" type="image/x-icon" />
   <link rel="apple-touch-icon" href="">
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="sport/css/bootstrap.min.css">
   <!-- Site CSS -->
   <link rel="stylesheet" href="sport/style.css">
   <!-- Colors CSS -->
   
   <!-- ALL VERSION CSS -->	
   <!-- Responsive CSS -->
   <link rel="stylesheet" href="sport/css/responsive.css">
   <!-- Custom CSS -->
   <link rel="stylesheet" href="sport/css/custom.css">
   <!-- font family -->
   <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
   <!-- end font family -->
   <link rel="stylesheet" href="sport/css/3dslider.css" />
   <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
   <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
   <script src="sport/js/3dslider.js"></script>
   </head>
   <body class="game_info" data-spy="scroll" data-target=".header">
	   <div id="app">
      <!-- LOADER -->
      <div id="preloader">
         <img class="preloader" src="sport/images/loading-img.gif" alt="">
	  </div>
	  <section id="top">
		<header>
		   <div class="container">
			  <div class="header-top">
				 <div class="row">
					<div class="col-md-6">
					   <div class="full">
						  <div class="logo">
							 <a href="index.html"><img src="sport/images/logo.png" alt="#" /></a>
						  </div>
					   </div>
					</div>
					<div class="col-md-6">
					   <div class="right_top_section">
						  <!-- social icon -->
						  <ul class="social-icons pull-left">
							 <li><a class="facebook" href="https://www.facebook.com/subfechabal"><i class="fa fa-facebook"></i></a></li>
							 <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
							 <li><a class="youtube" href="https://youtube.com"><i class="fa fa-youtube-play"></i></a></li>
						  </ul>
						  <!-- end social icon -->
						  <!-- button section -->
						  <ul class="login">
							 <li class="login-modal">
								<a href="{{ route('login' )}}" class="login"><i class="fa fa-user"></i>Login
									
								</a>
							 </li>
							 <li>
								<div class="cart-option">
								   <a href="#"><i class="fa fa-shopping-cart"></i>Register
								   </a>
								</div>
							 </li>
						  </ul>
						  <!-- end button section -->
					   </div>
					</div>
				 </div>
			  </div>
			  <div class="header-bottom">
				<div class="row">
				   <div class="col-md-12">
					  <div class="full">
						 <div class="main-menu-section">
							<div class="menu">
								<!--Inicio de navbar -->
									@include('layouts.navbar')
								<!-- Fin de navbar -->	   
							</div>
						 </div>
					  </div>
				   </div>
				</div>
			 </div>
			  
		   </div>
		</header>
		<div class="full-slider">
		   <div id="carousel-example-generic" class="carousel slide">
			  <!-- Indicators -->
			  <ol class="carousel-indicators">
				 <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
				 <li data-target="#carousel-example-generic" data-slide-to="1"></li>
				 <li data-target="#carousel-example-generic" data-slide-to="2"></li>
			  </ol>
			  <!-- Wrapper for slides -->
			  <div class="carousel-inner" role="listbox">
				 <!-- First slide -->
				 <div class="item active deepskyblue" data-ride="carousel" data-interval="5000">
					<div class="carousel-caption">
					   <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12"></div>
					   <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
						  <div class="slider-contant" data-animation="animated fadeInRight">
							 <h3>If you Don’t Practice<br>You <span class="color-yellow">Don’t Derserve</span><br>to win!!!</h3>
							 <p>If you use this site regularly and would like to help keep the site on the Internet,<br>
								please consider donating a small sum to help pay..
							 </p>
							 <button class="btn btn-primary btn-lg">Read More</button>
						  </div>
					   </div>
					</div>
				 </div>
			  </div>
			  <!-- /.carousel-inner -->
			  <!-- Controls -->			  
		   </div>
		   <!-- /.carousel -->            
		</div>
	 </section>
	 <!--Contenido-->
	 	@yield('content')
	 <!-- Fin contenido-->
	 <!-- Footer-->
	 <footer id="footer" class="footer">
		<div class="container">
		   <div class="row">
			  <div class="col-md-4">
				 <div class="full">
					<div class="footer-widget">
					   <div class="footer-logo">
						  <a href="#"><img src="sport/images/footer-logo.png" alt="#" /></a>
					   </div>
					   <p>Most of our events have hard and easy route choices as we are always keen to encourage new riders.</p>
					   <ul class="social-icons style-4 pull-left">
						  <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
						  <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
						  <li><a class="youtube" href="#"><i class="fa fa-youtube-play"></i></a></li>
					   </ul>
					</div>
				 </div>
			  </div>
			  <div class="col-md-4">
				 <div class="full">
					<div class="footer-widget">
					   <h3>Menu</h3>
					   <ul class="footer-menu">
						  <li><a href="about.html">About Us</a></li>
						  <li><a href="news.html">Latest News</a></li>
						  <li><a href="blog.html">Our Blog</a></li>
						  <li><a href="contact.html">Contact Us</a></li>
					   </ul>
					</div>
				 </div>
			  </div>
			  <div class="col-md-4">
				 <div class="full">
					<div class="footer-widget">
					   <h3>Contact us</h3>
					   <ul class="address-list">
						  <li><i class="fa fa-map-marker"></i> Lorem Ipsum is simply dummy text of the printing..</li>
						  <li><i class="fa fa-phone"></i> 123 456 7890</li>
						  <li><i style="font-size:20px;top:5px;" class="fa fa-envelope"></i> demo@gmail.com</li>
					   </ul>
					</div>
				 </div>
			  </div>             
		   </div>
		</div>
		<div class="footer-bottom">
		   <div class="container">
			  <p>Copyright © 2018 Distributed by <a href="https://themewagon.com/" target="_blank">ThemeWagon</a></p>
		   </div>
		</div>
	 </footer>
	 <a href="#home" data-scroll class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>
	 <!-- ALL JS FILES -->
	 <script src="sport/js/all.js"></script>
	 <!-- ALL PLUGINS -->
	 <script src="sport/js/custom.js"></script>
	 <script src="{{ asset('js/app.js') }}"></script>
	</div>
   </body>
</html>	  