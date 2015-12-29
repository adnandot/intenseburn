<?php
/**
	* Template Name: My Fitness Template
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


if(!isSubscriber()){
	wp_redirect(site_url('login'));
	exit;
}

get_header(); ?>
<div class="container my_fitness">
<div class="col-md-12 col-sm-12">
<div class="row">
	<div id="primary" class="content-area col-sm-12 col-md-12 <?php echo of_get_option( 'site_layout' ); ?>">
		
		       <div class="row">   

		
            
  <div class="col-md-12 col-sm-12">
			
            <div class="subpage-text-area-inside">
            
            <a href="<?php echo site_url('/member-area');?>" class="back-member">Back to Member Area </a>
            
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec gravida arcu a pulvinar cursus. Sed sit amet nunc turpis. Nam mollis, risus eget maximus ullamcorper, erat mi tincidunt metus, sed rhoncus mi lorem a metus. Praesent ut bibendum arcu, vel efficitur nisl. Ut vulputate iaculis nunc ut porttitor. Ut aliquam faucibus tellus quis malesuada. Fusce pharetra tristique justo, suscipit egestas erat porttitor a. Donec aliquam sem non ex cursus, in ullamcorper leo feugiat. Pellentesque mauris mi, consectetur ut vulputate eget, tincidunt id ipsum. Aenean id condimentum augue, a aliquam dolor. Phasellus dignissim cursus massa at blandit.</p>
							</div>
                            
            
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="receipy_boxes">
            
            
            	<header class="entry-header page-header">
					<h1 class="entry-title">Take fitness test  </h1>
				</header><!-- .entry-header -->
			
				
                <div class="col-md-8 col-sm-8">
                <div class="entry-content receipiimage">
			<iframe src="https://www.youtube.com/embed/mUfp4J07HR8" class="iframmyfitnes" allowfullscreen></iframe>
				
				</div>
				</div>
                
                <div class="col-md-4 col-sm-4">
				<div class="change-workout exercise-side">
		<span>Test Your Body! </span>
		<input type="text" required="" name="number1" placeholder="EXERCISE 1" class="input-100">
        <input type="text" required="" name="number1" placeholder="EXERCISE 1" class="input-100">
        <input type="text" required="" name="number1" placeholder="EXERCISE 1" class="input-100">
        <input type="text" required="" name="number1" placeholder="EXERCISE 1" class="input-100">
		<span></span>
		</div>
        <div class="change-level">
        <!--readonly=""-->
		<input type="hidden" value="1" class="select-info-workout-2 myfitneswork">
		</div>
        <div class="level-change-area">
				<div class="submit-area">
				<input type="submit" value="SUBMIT">
		</div>
		
		</div>
                </div>
                <div class="clear"></div>
                </div>
			</article><!-- #post-## -->
            
            <div class="title-fitness">Your Performance </div>
            
              <div class="col-md-6 col-sm-6">
            
            <div class="current-level">
					<span> Current Level </span>
					<input readonly="" value="<?php echo get_field('current_level', get_user_by( 'id', getLoggedinUserId() ))?>">
				</div>
                </div>
                  <div class="col-md-6 col-sm-6">
                <div class="legend-diag">
					<span class="legend-title">LEGEND</span>
					<div class="first-ex">First EXERCISE</div>
					<div class="second-ex">Second EXERCISE</div>
					<div class="third-ex">Third EXERCISE</div>
					<div class="fourth-ex">Fourth EXERCISE</div>
				</div>
                </div>
                
				<script language="javascript" type="text/javascript" src="http://wpdevtest.co.uk/fatburning/wp-content/themes/fatburning/js/jquery.jqplot.min.js"></script>
				<script class="include" language="javascript" type="text/javascript" src="http://wpdevtest.co.uk/fatburning/wp-content/themes/fatburning/js/jqplot.highlighter.min.js"></script>
				<script class="include" language="javascript" type="text/javascript" src="http://wpdevtest.co.uk/fatburning/wp-content/themes/fatburning/js/jqplot.dateAxisRenderer.min.js"></script>
				<script class="code" type="text/javascript">
				(function($) {
				$(document).ready(function(){
  							var line1=[
															 10,				
															 5,				
															 5,				
															 10,				
															 15,				
															 10,				
															 56,				
															 13,				
															 0,				
															 0,				
														];
													var line2=[
															 10,				
															 10,				
															 10,				
															 10,				
															 20,				
															 10,				
															 56,				
															 12,				
															 0,				
															 0,				
														];
													var line3=[
															 10,				
															 12,				
															 12,				
															 545,				
															 45,				
															 10,				
															 56,				
															 12,				
															 0,				
															 0,				
														];
													var line4=[
															 20,				
															 15,				
															 15,				
															 10,				
															 3,				
															 10,				
															 56,				
															 12,				
															 0,				
															 44,				
														];
												var plot4 = $.jqplot('chart4', [line1, line2, line3, line4], {
    
     
      axes: {
          xaxis:{renderer:$.jqplot.CategoryAxisRenderer}
      },
      seriesDefaults: { 
        showMarker:true,
        pointLabels: { show:true } 
      },
	  highlighter: {
			tooltipAxes: 'y',
			 show: true,
			sizeAdjust: 10,
			show: true,
			
	  },

  });
  
});
})(jQuery);
</script>
				<div id="chart4" style="height:300px; width:100%; float:left;"></div>  
                <!-- <img src="<?php bloginfo('template_directory'); ?>/images/chart.jpg">-->
                
            
            
           </div>
			
		
	</div><!-- #primary -->

</div></div></div></div>	
<?php get_footer(); ?>
