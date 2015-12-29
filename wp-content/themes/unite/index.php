<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package unite
 */

get_header(); ?>
<div class="main-container">
<section class="menu_page" id="services" style="background-color:#272727; ">

<!--Once you join start-->
<div class="container_once">
<div class="container">

<h2 class="section_title">Once you join Intense Burn,<span>ou will have access to:  </span></h2>

<div class="row">
<div class="col-md-12 col-sm-12"><div id="oncejointyou">
<ul class="list-orange">
													<li><span>Online Video-based Fitness programme </span> Personalised to your goals and fitness levels</li>
													<li><span>Tailored meal plans </span> which are also easily customisable</li>
													<li><span>Tasty, healthy and easy </span> to make recipes tailored to your goals</li>
													<li><span>Education and resources </span> on fitness and nutritional topics</li>
													<li><span>New and exciting workouts,</span> recipes and other resources added regularly</li>
											</ul>


</div></div>

</div>

</div><!-- middle-align -->
<div class="clear"></div>
</div>
<!--Once you join END-->

    <!--Workout Start-->
<div class="workoutwraper">
    <div class="wrapper">
<section class="module parallax parallax-2">


  <script src="<?php bloginfo('template_directory'); ?>/js/modernizr.js"></script>


        <div data-image-src="<?php bloginfo('template_directory'); ?>/images/background-second-front.png" data-parallax="scroll" class="sec_front">
            <script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-34160351-1']);
_gaq.push(['_trackPageview']);
(function() {
  var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
  ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script>
<div class="container">
<div class="row">
            <div class="col-md-12 col-sm-12">
            <div class="col-md-7 col-sm-7">
            <div class="title">Work<span>out</span></div>
            <div class="text">The Intense Burn program has been designed to make sure you have the exercises and workouts needed to become fitter, stronger and healthier than ever before. Created by celebrity trainer</div>
            <a href="#"><div class="button-title">Josiah Hunte</div></a>
            </div>
            <div class="col-md-5 col-sm-5">
            <img class="" src="<?php bloginfo('template_directory'); ?>/images/videro.jpg" alt="" />
            </div>
            </div>
            </div></div>
            
            
			</div></section>
		</div>
	</div>
    <!--Workout END-->

    <!--Nutrition Start-->
<div class="white-max">
		<div class="container">
			<div class="col-md-6 col-sm-6">
        	<div class="front-third-left-side front-third-left-side-pad">
			
                <div class="title">Nutrition</div>
				<div class="text">The Intense Burn program has been designed to make sure you have the exercises and workouts needed to become fitter, stronger and healthier than ever before. Created by celebrity trainer				</div>
				<a href="http://wpdevtest.co.uk/fatburning/nutrition/" class="button-title">
					Angela Steel				</a>
                    
			</div>
            </div>
            		<div class="col-md-6 col-sm-6">
            
			<div class="front-third-right-side">
				<img src="<?php bloginfo('template_directory'); ?>/images/angela.png" class="opacitizer" alt="" />
			</div></div>
		</div>
	</div>
    
    <!--Nutrition END-->
<!--INTENSE BURN CHANGING LIVES Start-->

<div class="black-max">
		<div class="container">
        <div class="headingtitle">INTENSE BURN CHANGING LIVES</div>
			<div class="row"><div class="col-md-12 col-sm-12"><div class="row">
            <div class="col-md-6 col-sm-6">
				
                <div class="col-md-6 col-sm-6">
					<div class="ramka"><img class="" src="<?php bloginfo('template_directory'); ?>/images/img1.jpg" alt="" /></div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                    
                    <div class="ramka"><img class="" src="<?php bloginfo('template_directory'); ?>/images/img2.jpg" alt="" /></div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                    <div class="ramka"><img class="" src="<?php bloginfo('template_directory'); ?>/images/img3.jpg" alt="" /></div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                    <div class="ramka"><img class="" src="<?php bloginfo('template_directory'); ?>/images/img4.jpg" alt="" /></div>
                    </div>
                    
                    
                    <div class="text_center"><a href="#" class="button-title">Join Us Now</a></div>
							
							
				</div>
			
		<div class="col-md-6 col-sm-6">
				<div class="top_rightburn">
                <div class="subtitle">Heading Content</div>
				<div class="text">You can use the following notation to format only certain parts of your control’s text.You can use the following notation to format only certain parts of your control’s text.</div>
				<a href="#" class="button-title">Click Here</a>
                </div>
                <div class="top_rightburn">
                <div class="subtitle">Heading Content</div>
				<div class="text">You can use the following notation to format only certain parts of your control’s text.You can use the following notation to format only certain parts of your control’s text.</div>
				<a href="#" class="button-title">Click Here</a>
                </div>
			</div>
		</div></div></div>
</div></div>
<!--INTENSE BURN CHANGING LIVES END-->


<!-- container -->
</section>

</div>
    <!-- #primary -->
<?php //get_sidebar(); ?>
<?php get_footer(); ?>
