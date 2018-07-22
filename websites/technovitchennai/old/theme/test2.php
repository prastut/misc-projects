<!-- <?php //require_once("includes/session.php");?>
<?php //require_once("includes/db_connection.php");?>
<?php //require_once("includes/functions.php");?>
<?php //require_once("includes/validation_functions.php"); ?>-->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Tecnhovit 16">
	<meta name="author" content="Prashant Bhardwaj">
	<link rel="shortcut icon" href="assets/ico/favicon.ico">

	<title>Tecnhovit 16</title>

	<!-- Bootstrap core CSS -->
	<link href="assets/css/bootstrap.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="assets/css/style.css" rel="stylesheet">
	<link href="assets/css/font-awesome.min.css" rel="stylesheet">
	<link rel="shortcut icon" href="../favicon.ico">
	<link rel="stylesheet" type="text/css" href="assets/css/normalize.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/demo.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/component.css" />
	<link href='http://fonts.googleapis.com/css?family=Raleway:200,400,800' rel='stylesheet' type='text/css'>



<!--
	Just for debugging purposes. Don't actually copy this line!
	[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif] -->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->

      <script src="assets/js/modernizr.custom.js"></script>
  </head>

  <body>

  	<!-- Fixed navbar -->
  	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
  		<div class="container">
  			<div class="navbar-header">
  				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
  					<span class="sr-only">Toggle navigation</span>
  					<span class="icon-bar"></span>
  					<span class="icon-bar"></span>
  					<span class="icon-bar"></span>
  				</button>
  				<a class="navbar-brand" href="index.html">tecnhoVIT'16.</a>
  			</div>
  			<div class="navbar-collapse collapse navbar-right">
  				<ul class="nav navbar-nav">
  					<li class="active">
<?php
if (isset($_SESSION["username"])) {
	$current_user = $_SESSION["username"];
	$name_query   = "SELECT * FROM users WHERE username = '{$current_user}' LIMIT 1";
	$name_result  = mysqli_query($conn, $name_query);
	confirm_query($name_result);
	$name_title = mysqli_fetch_assoc($name_result);
	$first_name = explode(" ", $name_title['name']);
	$view       = "<a href='logout.php'>Logout, ".$first_name[0]."</a>";
} else {
	$current_user = "";
	$first_name   = "";
	$name_title   = "";
	$view         = "<a href='login.php'>Login/Signup</a>";
}
?>
  						<?php echo "$view";?>
</li>
  					<li><a href="#start">START</a></li>
  					<li><a href="#patrons">PATRONS</a></li>
  					<li><a href="#archives">ARCHIVES</a></li>
  					<li><a href="#clients">CLIENTS</a></li>
  					<li class="active"><a href="index.html">HOME</a></li>
  					<li><a href="reg/index.html">REGISTRATIONS</a></li>
  					<li><a href="contact.html">CONTACT</a></li>
  					<li class="dropdown">
  						<a href="#" class="dropdown-toggle" data-toggle="dropdown">PAGES <b class="caret"></b></a>
  						<ul class="dropdown-menu">
  							<li><a href="blog.html">BLOG</a></li>
  							<li><a href="single-post.html">SINGLE POST</a></li>
  							<li><a href="aboutus.html">ABOUT US</a></li>
  							<li><a href="single-project.html">SINGLE PROJECT</a></li>
  						</ul>
  					</li>
  				</ul>
  			</div><!--/.nav-collapse -->
  		</div>
  	</div>

	<!-- *****************************************************************************************************************
	 HEADERWRAP
	 ***************************************************************************************************************** -->
	 <style type="text/css">
	 	.img-logo{
	 		max-width: 100%;
	 		height: auto;
	 	}
	 	.img-small{
	 		max-width: 28%;
	 		height: auto;
	 	}
	 	#year{
	 		padding-top: 0;
	 		margin-top: 0;
	 	}
	 </style>
	 <div style="width: 100%;" class="demo-1" name="start">
	 	<div class="content">
	 		<div id="large-header" class="large-header" style="margin-top:5vw;">
	 			<div id="inner_box">
					<img src="assets/img/9.jpg" alt="">
					<img src="assets/img/2.jpg" alt="">
					<img src="assets/img/3.jpg" alt="">
					<img src="assets/img/4.jpg" alt="">
				</div>
	 			<canvas id="demo-canvas" ></canvas>
	 			<h1 class="main-title" style="padding-bottom:24vw;">
	 				<img src="assets/img/vitcc.png" class="img-small"/>
	 				<img src="design/technovit copy.png" class="img-logo" align="center" />
	 				<span class="thin" style="text-align:center;">2016</span>
	 			</h1>
	 			<div id="clockdiv">
					<div><span class="days"></span><div class="smalltext">Days</div></div>
					<div><span class="hours"></span><div class="smalltext">Hours</div></div>
					<div><span class="minutes"></span><div class="smalltext">Minutes</div></div>
					<div><span class="seconds"></span><div class="smalltext">Seconds</div></div>
				</div>
				<script src="assets/js/clock.js"></script>
	 			<small class="main-title" style="font-size:2em;padding-top:15vw;text-transform:capitalize;">15<sup>th</sup> to 17<sup>th</sup>September
	 			</small>
	 		</div>


	 	</div>
	 	<!-- Related demos -->


	 <div name="patrons"></div>
	 </div> <!-- /container -->


	<!-- *****************************************************************************************************************
	 SERVICE LOGOS
	 ***************************************************************************************************************** -->
	 <div id="service" >
	 	<div class="container">
	 		<p><center><h2><br>Our Patrons</h2></center></p>
	 		<div class="row centered">
	 			<br><br><br>
	 			<div class="col-md-4">
	 				<img src="assets/img/gv.jpg" class="img-circle"  style="box-shadow: 5px 5px 15px #888888"></img>
	 				<h4>Dr. G. Viswanathan</h4>
	 				<h6>Founder & Chancellor</h6>
	 				<p>The founder-chancellor of VIT University was born on December 8, 1938 in a remote village near Vellore in Tamil Nadu. His life is a source of inspiration to the modern- day youth. He is a man of profound knowledge whose aim has been to get his students to the peak of their capabilities. Every student at VIT University is given ample opportunities to prove his academic and cultural excellence. This is well encouraged and supported in all means by our chancellor.</p>
	 			</div>
	 			<div class="col-md-4" >
	 				<img src="assets/img/vp.jpg" class="img-circle"  style="box-shadow: 5px 5px 15px #888888"></img>
	 				<h4>Mr. Sankar Viswanathan</h4>
	 				<h6>Vice President</h6>
	 				<p>After his Advanced Diploma in Engineering Technology, at Chisholm Institute, Melbourne, Australia - he has held the honoured position as Chairman of Vellore Engineering College, before taking over as Pro-Chancellor (Academic VIT). He has travelled a lot and done the knowledge transfer, to the VIT. Though he is a man with a lot of responsibilities, it is one of his biggest priorities to be present whenever there is an event at our campus to shower us with all his support.</p>
	 			</div>
	 			<div class="col-md-4">
	 				<img src="assets/img/avp.jpg" class="img-circle"  style="box-shadow: 5px 5px 15px #888888"></img>
	 				<h4>Ms. Kadhambari S. Viswanathan</h4>
	 				<h6>Assistant Vice President</h6>
	 				<p>On completion of her Masters degree in Health Science, from the prestigious Bloomberg School of Public Health at Johns Hopkins University, Baltimore, USA. She has been honoured by the 'Limca Book of Records' as the youngest biographer. She is fully committed to the enrichment of the university and is completely involved with all activities in college. She encourages participation in intercollegiate events by fuelling us with constant support and is always available to the members of the University.</p>
	 			</div>
	 		</div>
	 	</div><! --/container -->
	 </div><! --/service -->

	<!-- *****************************************************************************************************************
	 PORTFOLIO SECTION
	 ***************************************************************************************************************** -->
	 <div id="portfoliowrap" name="archives">
	 	<h3>ARCHIVES<br><br><br></h3>

	 	<div class="portfolio-centered">
	 		<div class="recentitems portfolio">
	 			<div class="portfolio-item graphic-design">
	 				<div class="he-wrap tpl6">
	 					<img src="assets/img/2.jpg" alt="">
	 					<div class="he-view">
	 						<div class="bg a0" data-animate="fadeIn">
	 							<a data-rel="prettyPhoto" href="assets/img/2.jpg" class="dmbutton a2" data-animate="fadeInUp"><i class="fa fa-search"></i></a>
	 						</div><!-- he bg -->
	 					</div><!-- he view -->
	 				</div><!-- he wrap -->
	 			</div><!-- end col-12 -->

	 			<div class="portfolio-item web-design">
	 				<div class="he-wrap tpl6">
	 					<img src="assets/img/1.jpg" alt="">
	 					<div class="he-view">
	 						<div class="bg a0" data-animate="fadeIn">
	 							<a data-rel="prettyPhoto" href="assets/img/1.jpg" class="dmbutton a2" data-animate="fadeInUp"><i class="fa fa-search"></i></a>
	 						</div><!-- he bg -->
	 					</div><!-- he view -->
	 				</div><!-- he wrap -->
	 			</div><!-- end col-12 -->

	 			<div class="portfolio-item graphic-design">
	 				<div class="he-wrap tpl6">
	 					<img src="assets/img/3.jpg" alt="">
	 					<div class="he-view">
	 						<div class="bg a0" data-animate="fadeIn">
	 							<a data-rel="prettyPhoto" href="assets/img/3.jpg" class="dmbutton a2" data-animate="fadeInUp"><i class="fa fa-search"></i></a>
	 						</div><!-- he bg -->
	 					</div><!-- he view -->
	 				</div><!-- he wrap -->
	 			</div><!-- end col-12 -->

	 			<div class="portfolio-item graphic-design">
	 				<div class="he-wrap tpl6">
	 					<img src="assets/img/4.jpg" alt="">
	 					<div class="he-view">
	 						<div class="bg a0" data-animate="fadeIn">
	 							<a data-rel="prettyPhoto" href="assets/img/4.jpg" class="dmbutton a2" data-animate="fadeInUp"><i class="fa fa-search"></i></a>
	 						</div><!-- he bg -->
	 					</div><!-- he view -->
	 				</div><!-- he wrap -->
	 			</div><!-- end col-12 -->

	 			<div class="portfolio-item books">
	 				<div class="he-wrap tpl6">
	 					<img src="assets/img/5.jpg" alt="">
	 					<div class="he-view">
	 						<div class="bg a0" data-animate="fadeIn">
	 							<a data-rel="prettyPhoto" href="assets/img/5.jpg" class="dmbutton a2" data-animate="fadeInUp"><i class="fa fa-search"></i></a>
	 						</div><!-- he bg -->
	 					</div><!-- he view -->
	 				</div><!-- he wrap -->
	 			</div><!-- end col-12 -->

	 			<div class="portfolio-item graphic-design">
	 				<div class="he-wrap tpl6">
	 					<img src="assets/img/7.jpg" alt="">
	 					<div class="he-view">
	 						<div class="bg a0" data-animate="fadeIn">
	 							<a data-rel="prettyPhoto" href="assets/img/7.jpg" class="dmbutton a2" data-animate="fadeInUp"><i class="fa fa-search"></i></a>
	 						</div><!-- he bg -->
	 					</div><!-- he view -->
	 				</div><!-- he wrap -->
	 			</div><!-- end col-12 -->

	 			<div class="portfolio-item books">
	 				<div class="he-wrap tpl6">
	 					<img src="assets/img/6.jpg" alt="">
	 					<div class="he-view">
	 						<div class="bg a0" data-animate="fadeIn">
	 							<a data-rel="prettyPhoto" href="assets/img/6.jpg" class="dmbutton a2" data-animate="fadeInUp"><i class="fa fa-search"></i></a>
	 						</div><!-- he bg -->
	 					</div><!-- he view -->
	 				</div><!-- he wrap -->
	 			</div><!-- end col-12 -->

	 			<div class="portfolio-item graphic-design">
	 				<div class="he-wrap tpl6">
	 					<img src="assets/img/8.jpg" alt="">
	 					<div class="he-view">
	 						<div class="bg a0" data-animate="fadeIn">
	 							<a data-rel="prettyPhoto" href="assets/img/8.jpg" class="dmbutton a2" data-animate="fadeInUp"><i class="fa fa-search"></i></a>
	 						</div><!-- he bg -->
	 					</div><!-- he view -->
	 				</div><!-- he wrap -->
	 			</div><!-- end col-12 -->

	 			<div class="portfolio-item web-design">
	 				<div class="he-wrap tpl6">
	 					<img src="assets/img/9.jpg" alt="">
	 					<div class="he-view">
	 						<div class="bg a0" data-animate="fadeIn">
	 							<a data-rel="prettyPhoto" href="assets/img/9.jpg" class="dmbutton a2" data-animate="fadeInUp"><i class="fa fa-search"></i></a>
	 						</div><!-- he bg -->
	 					</div><!-- he view -->
	 				</div><!-- he wrap -->
	 			</div><!-- end col-12 -->

	 			<div class="portfolio-item books">
	 				<div class="he-wrap tpl6">
	 					<img src="assets/img/10.jpg" alt="">
	 					<div class="he-view">
	 						<div class="bg a0" data-animate="fadeIn">
	 							<a data-rel="prettyPhoto" href="assets/img/10.jpg" class="dmbutton a2" data-animate="fadeInUp"><i class="fa fa-search"></i></a>
	 						</div><!-- he bg -->
	 					</div><!-- he view -->
	 				</div><!-- he wrap -->
	 			</div><!-- end col-12 -->

	 		</div><!-- portfolio -->
	 	</div><!-- portfolio container -->
	 </div><!--/Portfoliowrap -->


	<!-- *****************************************************************************************************************
	 MIDDLE CONTENT
	 ***************************************************************************************************************** -->



	<!-- *****************************************************************************************************************
	 TESTIMONIALS
	 ***************************************************************************************************************** -->


	<!-- *****************************************************************************************************************
	 OUR CLIENTS
	 ***************************************************************************************************************** -->
	 <div id="cwrap" name="clients">
	 	<div class="container">
	 		<div class="row centered">
	 			<h3>OUR SPONSORS</h3>
	 			<div class="col-lg-3 col-md-3 col-sm-3">
	 				<img src="assets/img/clients/client01.png" class="img-responsive">
	 			</div>
	 			<div class="col-lg-3 col-md-3 col-sm-3">
	 				<img src="assets/img/clients/client02.png" class="img-responsive">
	 			</div>
	 			<div class="col-lg-3 col-md-3 col-sm-3">
	 				<img src="assets/img/clients/client03.png" class="img-responsive">
	 			</div>
	 			<div class="col-lg-3 col-md-3 col-sm-3">
	 				<img src="assets/img/clients/client04.png" class="img-responsive">
	 			</div>
	 		</div><! --/row -->
	 	</div><! --/container -->
	 </div><! --/cwrap -->

	<!-- *****************************************************************************************************************
	 FOOTER
	 ***************************************************************************************************************** -->
	 <div id="footerwrap">
	 	<div class="container">
	 		<div class="row">
	 			<div class="col-lg-4">
	 				<h4>About</h4>
	 				<div class="hline-w"></div>
	 				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
	 			</div>
	 			<div class="col-lg-4">
	 				<h4>Social Links</h4>
	 				<div class="hline-w"></div>
	 				<p>
	 					<a href="#"><i class="fa fa-dribbble"></i></a>
	 					<a href="#"><i class="fa fa-facebook"></i></a>
	 					<a href="#"><i class="fa fa-twitter"></i></a>
	 					<a href="#"><i class="fa fa-instagram"></i></a>
	 					<a href="#"><i class="fa fa-tumblr"></i></a>
	 				</p>
	 			</div>
	 			<div class="col-lg-4">
	 				<h4>Contact Us</h4>
	 				<div class="hline-w"></div>
	 				<p>
	 					VIT University Chennai Campus<br/>
	 					Vandalur - Kelambakkam Road<br/>
	 					Chennai - 600 127<br/>
	 					Phone : +91 44 3993 1555<br/>
	 					Fax : +91 44 3993 2555<br/>
	 					Email : admin.chennai@vit.ac.in
	 				</p>
	 			</div>

	 		</div><! --/row -->
	 	</div><! --/container -->
	 </div><! --/footerwrap -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/retina-1.1.0.js"></script>
    <script src="assets/js/jquery.hoverdir.js"></script>
    <script src="assets/js/jquery.hoverex.min.js"></script>
    <script src="assets/js/jquery.prettyPhoto.js"></script>
    <script src="assets/js/jquery.isotope.min.js"></script>
    <script src="assets/js/custom.js"></script>


    <script>
// Portfolio
(function($) {
	"use strict";
	var $container = $('.portfolio'),
	$items = $container.find('.portfolio-item'),
	portfolioLayout = 'fitRows';

	if( $container.hasClass('portfolio-centered') ) {
		portfolioLayout = 'masonry';
	}

	$container.isotope({
		filter: '*',
		animationEngine: 'best-available',
		layoutMode: portfolioLayout,
		animationOptions: {
			duration: 750,
			easing: 'linear',
			queue: false
		},
		masonry: {
		}
	}, refreshWaypoints());

	function refreshWaypoints() {
		setTimeout(function() {
		}, 1000);
	}

	$('nav.portfolio-filter ul a').on('click', function() {
		var selector = $(this).attr('data-filter');
		$container.isotope({ filter: selector }, refreshWaypoints());
		$('nav.portfolio-filter ul a').removeClass('active');
		$(this).addClass('active');
		return false;
	});

	function getColumnNumber() {
		var winWidth = $(window).width(),
		columnNumber = 1;

		if (winWidth > 1200) {
			columnNumber = 5;
		} else if (winWidth > 950) {
			columnNumber = 4;
		} else if (winWidth > 600) {
			columnNumber = 3;
		} else if (winWidth > 400) {
			columnNumber = 2;
		} else if (winWidth > 250) {
			columnNumber = 1;
		}
		return columnNumber;
	}

	function setColumns() {
		var winWidth = $(window).width(),
		columnNumber = getColumnNumber(),
		itemWidth = Math.floor(winWidth / columnNumber);

		$container.find('.portfolio-item').each(function() {
			$(this).css( {
				width : itemWidth + 'px'
			});
		});
	}

	function setPortfolio() {
		setColumns();
		$container.isotope('reLayout');
	}

	$container.imagesLoaded(function () {
		setPortfolio();
	});

	$(window).on('resize', function () {
		setPortfolio();
	});
})(jQuery);
</script>
<script>
        $(function() {
            $('a[href*=#]:not([href=#])').click(function() {
                if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    if (target.length) {
                        $('html,body').animate({
                            scrollTop: target.offset().top
                        }, 1000);
                        return false;
                    }
                }
            });
        });
</script>
<script type="text/javascript">
	/*function logoSlide(){
		$('.main-title').slideDown(3000);
	}
	setTimeout(logoSlide,800)*/
</script>
<script src="assets/js/TweenLite.min.js"></script>
<script src="assets/js/EasePack.min.js"></script>
<script src="assets/js/rAF.js"></script>
<script src="assets/js/demo-1.js"></script>
</body>
</html>
