<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package unite
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
<script>		
jQuery.noConflict();			
jQuery(window).load(function() {
jQuery('#slider').nivoSlider({
effect:'fade', //sliceDown, sliceDownLeft, sliceUp, sliceUpLeft, sliceUpDown, sliceUpDownLeft, fold, fade, random, slideInRight, slideInLeft, boxRandom, boxRain, boxRainReverse, boxRainGrow, boxRainGrowReverse
animSpeed: 500,
pauseTime: 3000,
directionNav: true,
controlNav: true,
pauseOnHover: false,
});
});
</script>
</script><script type='text/javascript' src='http://sktthemesdemo.net/skt-fitness/wp-content/themes/skt-fitness-pro/js/jquery.nivo.slider.js'></script>
<script type='text/javascript' src='http://sktthemesdemo.net/skt-fitness/wp-content/themes/skt-fitness-pro/js/jquery.prettyPhoto.js'></script>
<script type='text/javascript' src='http://sktthemesdemo.net/skt-fitness/wp-content/themes/skt-fitness-pro/js/filter-gallery.js'></script>
<link rel='stylesheet' id='skt_fitness-basic-style-css'  href='//sktthemesdemo.net/skt-fitness/wp-content/cache/wpfc-minified/c4871ed59563aa67587efb6a85032d7c/1438341151index.css' type='text/css' media='all' />
<link rel='stylesheet' id='skt_fitness-editor-style-css'  href='//sktthemesdemo.net/skt-fitness/wp-content/cache/wpfc-minified/f4ab8aab10575357062e4343182744b9/1438341151index.css' type='text/css' media='all' />
<link rel='stylesheet' id='skt_fitness-base-style-css'  href='//sktthemesdemo.net/skt-fitness/wp-content/cache/wpfc-minified/023cabab983e7a3d2dade6e21b90550b/1438341151index.css' type='text/css' media='all' />
<link rel='stylesheet' id='skt_fitness-responsive-style-css'  href='//sktthemesdemo.net/skt-fitness/wp-content/cache/wpfc-minified/aee341ca37391781886ee6f3be980ebd/1438341151index.css' type='text/css' media='all' />
<link rel='stylesheet' id='skt_fitness-nivo-style-css'  href='//sktthemesdemo.net/skt-fitness/wp-content/cache/wpfc-minified/9406b1d3e6e78436676fca117f08538f/1438341151index.css' type='text/css' media='all' />
<link rel='stylesheet' id='skt_fitness-prettyphoto-style-css'  href='//sktthemesdemo.net/skt-fitness/wp-content/cache/wpfc-minified/63444e88e3a86c6a2abdf0ef3626616e/1438341151index.css' type='text/css' media='all' />
<link rel='stylesheet' id='skt_fitness-fontawesome-style-css'  href='//sktthemesdemo.net/skt-fitness/wp-content/cache/wpfc-minified/8c26fe2fbaecf245baa571cf22aaf37f/1438341151index.css' type='text/css' media='all' />
<link rel='stylesheet' id='skt_fitness-animation-style-css'  href='//sktthemesdemo.net/skt-fitness/wp-content/cache/wpfc-minified/79ef4d8be6a5dab9c62dc5dcb544e570/1438341151index.css' type='text/css' media='all' />
<link rel='stylesheet' id='ns_styles-css'  href='//sktthemesdemo.net/skt-fitness/wp-content/cache/wpfc-minified/4f67a3751e107484d722d467e310a426/1438341151index.css' type='text/css' media='all' />
<style>body, .top-grey-box, p, .testimonial-section, .feature-box p, .address, #footer .footer-inner p, .right-features .feature-cell .feature-desc, .price-table{font-family:'Arimo', sans-serif;}body, .contact-form-section .address, .newsletter, .top-grey-box, .testimonial-section .testimonial-box .testimonial-content .testimonial-mid, .right-features .feature-cell, .accordion-box .acc-content, .work-box .work-info, .feature-box{color:#ffffff;}body{font-size:12px}.header .header-inner .logo h1, .logo a{font-family:Roboto;color:#ffffff;font-size:28px}.header .header-inner .nav ul{font-family:'Roboto', sans-serif;font-size:15px}.header .header-inner .nav ul li a, .header .header-inner .nav ul li ul li a{color:#ffffff;}.header .header-inner .nav ul li a:hover{color:#ffffff;}.header .header-inner .nav ul li.current_page_item a, .header .header-inner .nav ul li:hover a, .header .header-inner .nav ul li:hover > ul{background-color:#ff4e1c}@media screen and (max-width:999px){.nav ul{background-color:#ff4e1c}}#slider .top-bar h2{font-family:Roboto;color:#ffffff}#slider .top-bar h2{font-size:40px}#slider .top-bar p{font-family:Roboto;color:#ffffff}#slider .top-bar p{font-size:16px}h2.section_title{font-size:40px}h1, h2, h3, h4, h5, h6, section h1, #services-box h2, .contact-banner h3, .team-col h3, .newsletter h2{font-family:'Roboto', sans-serif;color:#ffffff}a{color:#ff4e1c;}#slider .top-bar a.read:hover{background-color:#ff4e1c}a:hover, .recent-post li a:hover{color:#ffffff;}.footer .footer-col-1 h2, .footer-col-3 h2{font-family:Roboto}.footer .footer-col-1 h2, .footer-col-3 h2{color:#ffffff}.copyright-txt{font-family:Arimo;color:#ffffff}.design-by{font-family:Arimo;color:#ffffff}#services-box{border:2px solid #ffffff;}#services-box:hover{border:2px solid #ff4e1c;}#slider .top-bar a, .contact-banner a, input.search-submit, .post-password-form input[type=submit]{background-color:#ff4e1c;}#slider .top-bar a:hover, .contact-banner a:hover, input.search-submit:hover, .post-password-form input[type=submit]:hover{background-color:#ef4313;}#slider .top-bar a, .contact-banner a{color:#ffffff;}h3.widget-title{color:#ffffff;}.copyright-wrapper{background-color:#272727;}.nivo-directionNav a{background:url(http://sktthemesdemo.net/skt-fitness/wp-content/themes/skt-fitness-pro/images/slide-nav.png) no-repeat scroll 0 0 #cccccc;}.nivo-controlNav a{background-color:#cccccc}.nivo-controlNav a.active{background-color:#ff4e1c}.phone-no strong{color:#ff4e1c}#slider .top-bar a.read{border:2px solid #ff4e1c}.read-more{border:2px solid #ff4e1c}#services-box:hover .read-more{background-color:#ff4e1c}#slider .top-bar h2 span, #services-box h2 span, h2.section_title span, .footer-col-3 h2 span, .accordion-box h2.active, .latest-news .read-more, .testimonial-box h2, .phone-no strong, .recent-post li span, .office_timing .time_row .day, .time_row .title, .footer-col-2 ul li:hover a, .footer-col-2 ul li.current_page_item a, .news-box:hover .post-date, .copyright-txt span{color:#ff4e1c}.accordion-box h2.active::before, .team-col:hover, .news .newsthumb, .post-date, #commentform input#submit, .wpcf7 form input[type='submit'], .main-form-area input[type='submit']{background-color:#ff4e1c}.news-box .post-date{border-color:#ff4e1c}.news-box, .latest-news .read-more{background-color:#ffffff}.team-col .social-links a{background-color:#ffffff}.testimonial-box{border-color:#565555}.news h2, .wpcf7 form input[type='submit'], .main-form-area input[type='submit']{border-color:#eceaeb}#footer-wrapper{background: url(http://sktthemesdemo.net/skt-fitness/wp-content/themes/skt-fitness-pro/images/footer.jpg)}.recent-post li, .office_timing .time_row, .time_table .time_row{border-color:#3b3b3b}.photobooth .gallery ul li:hover{ background:#ff4e1c; background:url(http://sktthemesdemo.net/skt-fitness/wp-content/themes/skt-fitness-pro/images/camera-icon.png) 50% 50% no-repeat #ff4e1c; }</style>	<style type="text/css">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style>
</head>

<body <?php body_class(); ?>>

<div class="header">
<div class="header-inner">
<div class="logo">
<a href="http://sktthemesdemo.net/skt-fitness/">
<h1>SKT Fitness</h1>
</a>
<p>Just another WordPress site</p>
</div><!-- logo -->
<div class="toggle">
<a href="#" class="toggleMenu" style="display: none;">Menu</a>
</div><!-- toggle -->
<div class="nav">
<div class="menu-primary-container"><ul class="menu" id="menu-primary"><li class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-44" id="menu-item-44"><a href="http://sktthemesdemo.net/skt-fitness/">Home</a></li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-45" id="menu-item-45"><a href="http://sktthemesdemo.net/skt-fitness/about-us/">About Us</a></li>
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-51" id="menu-item-51"><a href="#" class="parent">Blog</a>
<ul class="sub-menu">
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-46" id="menu-item-46"><a href="http://sktthemesdemo.net/skt-fitness/blog/">Blog Right Sidebar</a></li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-48" id="menu-item-48"><a href="http://sktthemesdemo.net/skt-fitness/blog-left-sidebar/">Blog Left Sidebar</a></li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-47" id="menu-item-47"><a href="http://sktthemesdemo.net/skt-fitness/blog-full-width/">Blog Full Width</a></li>
</ul>
</li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-50" id="menu-item-50"><a href="http://sktthemesdemo.net/skt-fitness/gallery/">Gallery</a></li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-54" id="menu-item-54"><a href="http://sktthemesdemo.net/skt-fitness/shortcodes/">Shortcodes</a></li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-49" id="menu-item-49"><a href="http://sktthemesdemo.net/skt-fitness/contact-us/">Contact Us</a></li>
</ul></div>                            </div><!-- nav --><div class="clear"></div>
</div><!-- header-inner -->
</div>

<div class="clear"></div>
<div class="slider-main">
<div class="nivoSlider" id="slider">
<img title="#slidecaption1" alt="Welcome to Fitness &lt;span&gt;Center&lt;/span&gt;" src="http://sktthemesdemo.net/skt-fitness/wp-content/themes/skt-fitness-pro/images/slides/slider1.jpg" style="width: 1903px; visibility: hidden;"><img title="#slidecaption2" alt="Support &lt;span&gt;24x7&lt;/span&gt;" src="http://sktthemesdemo.net/skt-fitness/wp-content/themes/skt-fitness-pro/images/slides/slider2.jpg" style="width: 1903px; visibility: hidden;"><img title="#slidecaption3" alt="Welcome to &lt;span&gt;Fitness&lt;/span&gt;" src="http://sktthemesdemo.net/skt-fitness/wp-content/themes/skt-fitness-pro/images/slides/slider3.jpg" style="width: 1903px; visibility: hidden;">                
<img class="nivo-main-image" src="http://sktthemesdemo.net/skt-fitness/wp-content/themes/skt-fitness-pro/images/slides/slider1.jpg" style="display: inline; height: 927px; width: 1903px;"><div class="nivo-caption" style="display: block;">
<div class="top-bar">
<h2>Support <span>24x7</span></h2>
<p>Sed rhoncus euismod risus tristique imperdiet Morbi fringilla.</p>
<a href="#" class="read">Read More »</a>
</div>
</div><div class="nivo-directionNav"><a class="nivo-prevNav">Prev</a><a class="nivo-nextNav">Next</a></div><div name="0" class="nivo-slice" style="left: 0px; width: 1903px; height: 927px; opacity: 0.839977; overflow: hidden;"><img style="position:absolute; width:1903px; height:auto; display:block !important; top:0; left:-0px;" src="http://sktthemesdemo.net/skt-fitness/wp-content/themes/skt-fitness-pro/images/slides/slider2.jpg"></div><div name="1" class="nivo-slice" style="left: 127px; width: 127px; height: 927px; opacity: 0; overflow: hidden;"><img style="position:absolute; width:1903px; height:auto; display:block !important; top:0; left:-127px;" src="http://sktthemesdemo.net/skt-fitness/wp-content/themes/skt-fitness-pro/images/slides/slider2.jpg"></div><div name="2" class="nivo-slice" style="left: 254px; width: 127px; height: 927px; opacity: 0; overflow: hidden;"><img style="position:absolute; width:1903px; height:auto; display:block !important; top:0; left:-254px;" src="http://sktthemesdemo.net/skt-fitness/wp-content/themes/skt-fitness-pro/images/slides/slider2.jpg"></div><div name="3" class="nivo-slice" style="left: 381px; width: 127px; height: 927px; opacity: 0; overflow: hidden;"><img style="position:absolute; width:1903px; height:auto; display:block !important; top:0; left:-381px;" src="http://sktthemesdemo.net/skt-fitness/wp-content/themes/skt-fitness-pro/images/slides/slider2.jpg"></div><div name="4" class="nivo-slice" style="left: 508px; width: 127px; height: 927px; opacity: 0; overflow: hidden;"><img style="position:absolute; width:1903px; height:auto; display:block !important; top:0; left:-508px;" src="http://sktthemesdemo.net/skt-fitness/wp-content/themes/skt-fitness-pro/images/slides/slider2.jpg"></div><div name="5" class="nivo-slice" style="left: 635px; width: 127px; height: 927px; opacity: 0; overflow: hidden;"><img style="position:absolute; width:1903px; height:auto; display:block !important; top:0; left:-635px;" src="http://sktthemesdemo.net/skt-fitness/wp-content/themes/skt-fitness-pro/images/slides/slider2.jpg"></div><div name="6" class="nivo-slice" style="left: 762px; width: 127px; height: 927px; opacity: 0; overflow: hidden;"><img style="position:absolute; width:1903px; height:auto; display:block !important; top:0; left:-762px;" src="http://sktthemesdemo.net/skt-fitness/wp-content/themes/skt-fitness-pro/images/slides/slider2.jpg"></div><div name="7" class="nivo-slice" style="left: 889px; width: 127px; height: 927px; opacity: 0; overflow: hidden;"><img style="position:absolute; width:1903px; height:auto; display:block !important; top:0; left:-889px;" src="http://sktthemesdemo.net/skt-fitness/wp-content/themes/skt-fitness-pro/images/slides/slider2.jpg"></div><div name="8" class="nivo-slice" style="left: 1016px; width: 127px; height: 927px; opacity: 0; overflow: hidden;"><img style="position:absolute; width:1903px; height:auto; display:block !important; top:0; left:-1016px;" src="http://sktthemesdemo.net/skt-fitness/wp-content/themes/skt-fitness-pro/images/slides/slider2.jpg"></div><div name="9" class="nivo-slice" style="left: 1143px; width: 127px; height: 927px; opacity: 0; overflow: hidden;"><img style="position:absolute; width:1903px; height:auto; display:block !important; top:0; left:-1143px;" src="http://sktthemesdemo.net/skt-fitness/wp-content/themes/skt-fitness-pro/images/slides/slider2.jpg"></div><div name="10" class="nivo-slice" style="left: 1270px; width: 127px; height: 927px; opacity: 0; overflow: hidden;"><img style="position:absolute; width:1903px; height:auto; display:block !important; top:0; left:-1270px;" src="http://sktthemesdemo.net/skt-fitness/wp-content/themes/skt-fitness-pro/images/slides/slider2.jpg"></div><div name="11" class="nivo-slice" style="left: 1397px; width: 127px; height: 927px; opacity: 0; overflow: hidden;"><img style="position:absolute; width:1903px; height:auto; display:block !important; top:0; left:-1397px;" src="http://sktthemesdemo.net/skt-fitness/wp-content/themes/skt-fitness-pro/images/slides/slider2.jpg"></div><div name="12" class="nivo-slice" style="left: 1524px; width: 127px; height: 927px; opacity: 0; overflow: hidden;"><img style="position:absolute; width:1903px; height:auto; display:block !important; top:0; left:-1524px;" src="http://sktthemesdemo.net/skt-fitness/wp-content/themes/skt-fitness-pro/images/slides/slider2.jpg"></div><div name="13" class="nivo-slice" style="left: 1651px; width: 127px; height: 927px; opacity: 0; overflow: hidden;"><img style="position:absolute; width:1903px; height:auto; display:block !important; top:0; left:-1651px;" src="http://sktthemesdemo.net/skt-fitness/wp-content/themes/skt-fitness-pro/images/slides/slider2.jpg"></div><div name="14" class="nivo-slice" style="left: 1778px; width: 125px; height: 927px; opacity: 0; overflow: hidden;"><img style="position:absolute; width:1903px; height:auto; display:block !important; top:0; left:-1778px;" src="http://sktthemesdemo.net/skt-fitness/wp-content/themes/skt-fitness-pro/images/slides/slider2.jpg"></div></div><div class="nivo-controlNav"><a rel="0" class="nivo-control">1</a><a rel="1" class="nivo-control active">2</a><a rel="2" class="nivo-control">3</a></div>                    <div class="nivo-html-caption" id="slidecaption1">
<div class="top-bar">
<h2>Welcome to Fitness <span>Center</span></h2>
<p>We are passionate about clients results.</p>
<a href="#" class="read">Read More »</a>
</div>
</div>                    <div class="nivo-html-caption" id="slidecaption2">
<div class="top-bar">
<h2>Support <span>24x7</span></h2>
<p>Sed rhoncus euismod risus tristique imperdiet Morbi fringilla.</p>
<a href="#" class="read">Read More »</a>
</div>
</div>                    <div class="nivo-html-caption" id="slidecaption3">
<div class="top-bar">
<h2>Welcome to <span>Fitness</span></h2>
<p>Proin id sem et diam imperdiet interdum. Pellentesque sollicitudin, quam ac scelerisque dictum, urna quam posuere erat.</p>
<a href="#" class="read">Read More »</a>
</div>
</div>                
</div>



<div id="page" class="hfeed site">
	<div class="container header-area">
		<?php do_action( 'before' ); ?>
		<header id="masthead" class="site-header col-sm-12" role="banner">

				<div class="site-branding col-md-6">
					<?php if( get_header_image() != '' ) : ?>

						<div id="logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php header_image(); ?>"  height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="<?php bloginfo( 'name' ); ?>"/></a>
							<h4 class="site-description"><?php bloginfo( 'description' ); ?></h4>
						</div><!-- end of #logo -->

					<?php endif; // header image was removed ?>

					<?php if( !get_header_image() ) : ?>

						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<h4 class="site-description"><?php bloginfo( 'description' ); ?></h4>

					<?php endif; // header image was removed (again) ?>
				</div>

			<div class="social-header col-md-6">
				<?php unite_social(); // Social icons in header ?>
			</div>

		</header><!-- #masthead -->
	</div>
		<nav class="navbar navbar-default" role="navigation">
			<div class="container">
		        <div class="navbar-header">
		            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
		                <span class="sr-only">Toggle navigation</span>
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		            </button>

		        </div>

				<?php
		            wp_nav_menu( array(
		                'theme_location'    => 'primary',
		                'depth'             => 2,
		                'container'         => 'div',
		                'container_class'   => 'collapse navbar-collapse navbar-ex1-collapse',
		                'menu_class'        => 'nav navbar-nav',
		                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
		                'walker'            => new wp_bootstrap_navwalker())
		            );
		        ?>
		    </div>
		</nav><!-- .site-navigation -->

	<div id="content" class="site-content container">