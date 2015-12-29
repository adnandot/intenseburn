<?php
/**
 * Template Name: Member Area
 *
 * This is the template that displays full width page without sidebar
 *
 * @package unite
 */

if(!isSubscriber()){
	wp_redirect(site_url('login'));
	exit;
}
get_header(); ?>

<div id="primary" class="content-area membershippage">
  <main id="main" class="site-main" role="main">
  <div class="container">
    <div class="col-md-12 col-sm-12">
      <div class="row theteampage">
        <div class="login_pge">
          <div tabindex="-1" class="fancybox-wrap fancybox-desktop fancybox-type-ajax fancybox-opened">
            <div class="fancybox-skin">
              <div class="fancybox-outer">
                <div class="fancybox-inner">
                  <section style="background:#000; border-bottom:2px solid #f47404;" class="orange top-memberarea recipes-front">
                    <div class="wrapper">
                      <div class="title">First time on page ? <a class="btn btn-large btn-success" href="javascript:void(0);" onclick="javascript:startTour();">Show me how</a></div>
                      <div class="white line"></div>
                    </div>
                  </section>
                  <section class="memberarea">
                    <div class="member-area-all">
                      <div class="row">
                        <div class="col-md-3 col-sm-3">
                          <div class="member-area-single"  data-step="1" data-position="top" data-intro="From here you will find your info. You can change any of the information you have entered as well as changing your goals, which will automatically tailor the site for you."> <a href="<?php echo site_url('/member-area/your-profile')?>"><img src="<?php bloginfo('template_directory'); ?>/images/user-info-m.png" alt="" /></a> </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                          <div class="member-area-single" data-step="2" data-position="top" data-intro="Find new exciting recipes here as well as your favourites. The recipes also have search functions enabling you to search by ingredients as well as meal types! There will be more recipes added on a regular basis."> <a href="<?php echo site_url('/member-area/recipes')?>"><img src="<?php bloginfo('template_directory'); ?>/images/recipes-m.png" alt="" /></a></div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                          <div class="member-area-single" data-step="3" data-position="top" data-intro="You have access to all your meal plans here. We have created sample one’s for you to follow. You can use these, edit them or create brand new meal plans from the recipes you have access to. The meal plans can then be saved and also emailed to yourself."> <a href="<?php echo site_url('/member-area/meal-plan')?>"><img src="<?php bloginfo('template_directory'); ?>/images/mealplan1.png" alt="" /></a></div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                          <div class="member-area-single" data-step="4" data-position="top" data-intro="The fitness test is important to assess your fitness level. The short 5 minute test should be taken on a regular basis (ideally every 2 weeks), to make sure you are working towards your targets and pushing yourself. The results will be stored, plotted on a chart, and used to customise the workouts for you."> <a href="<?php echo site_url('/member-area/my-fitness')?>"><img src="<?php bloginfo('template_directory'); ?>/images/my-fitness.png" alt="" /></a></div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3 col-sm-3">
                          <div class="member-area-single" data-step="5" data-position="top" data-intro=" Here you will find your workouts. These have been customised according to your fitness level. The next workout is recommended to you, so all you have to do is push play and you are ready to go. You can also change which workout you wish to do, as well as the intensity."> <a href="<?php echo site_url('/member-area/my-workout')?>"><img src="<?php bloginfo('template_directory'); ?>/images/workout.png" alt="" /></a></div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                          <div class="member-area-single" data-step="6" data-position="top" data-intro=" Learn more about Fitness and Nutrition with the short videos and resources we have created. New resources will be added regularly to keep your knowledge base fresh."> <a href="<?php echo site_url('/member-area/education')?>"><img src="<?php bloginfo('template_directory'); ?>/images/education1.png" alt="" /></a></div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                          <div class="member-area-single" data-step="7" data-position="top" data-intro="Shop for your favourite brands from stores which we recommend. You will also be able to get a discount as you are an Intense Burn member compared to the RRP on the site usually!"> <a href="<?php echo site_url('/member-area/shop')?>"><img src="<?php bloginfo('template_directory'); ?>/images/shop1.png" alt="" /></a></div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                          <div class="member-area-single" data-step="8" data-position="top" data-intro="The pay site"> <a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/subscription1.png" alt="" /></a></div>
                        </div>
                      </div>
                    </div>
                  </section>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
   
    <!-- #main --> 
  </div>
  </main>
  <!-- #main --> 
</div>
<!-- #primary --> 
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/intro.js"></script>

<link href="<?php bloginfo('template_directory'); ?>/css/introjs.css" rel="stylesheet">
   	<script>
		function startTour() {
			var tour = introJs()
			tour.setOption('tooltipPosition', 'auto');
			tour.setOption('positionPrecedence', ['left', 'right', 'bottom', 'top'])
			tour.start()
		}
	
	</script>
<?php get_footer(); ?>
