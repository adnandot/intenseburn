<?php

    if ( get_option( 'show_on_front' ) == 'posts' ) {
        get_template_part( 'index' );
    } elseif ( 'page' == get_option( 'show_on_front' ) ) {

 get_header();
while(have_posts()){ the_post();
the_content();
 ?>

<?php 
$banner = get_field('banner');

if(!empty($banner[0])) {
	
$banner_image = $banner[0]['banner_image'];
$banner_title = $banner[0]['title'];
$banner_short_description = $banner[0]['short_description'];

?>

<div class="slider-main">
<div class="nivoSlider" id="slider">    
<?php if(!empty($banner_image)) {
//$banner_image = get_bloginfo ('template_directory'). '/timthumb.php?src='.$banner_image.'&amp;w=1903&amp;h=502&amp;zc=1'; ?>     
<img class="nivo-main-image" src="<?php echo $banner_image;?>" alt="home_Banner"/>
<?php } ?>
<div class="nivo-caption" style="display: block;">
<div class="container">
<div class="da-slide da-slide-current">
									<h2><?php echo $banner_title;?></h2>
									<p><?php echo $banner_short_description;?></p>
									<a class="da-link" href="<?php echo site_url('/register');?>">Join Us now</a>
								</div>
</div>

</div></div>                                                                            
</div>
<?php }?>
	<div class="main-container">
<section class="menu_page" id="services" style="background-color:#272727;">


<?php 

$benefit_area = get_field('benefit_area');


if(!empty($benefit_area[0])){
	
	$bf_title = $benefit_area[0]['title'];
	$bf_benefits = $benefit_area[0]['benefits'];
?>
<!--Once you join start-->
<div class="container_once">
<div class="container">

<h2 class="section_title"><?php echo $bf_title;?></h2>

<div class="row">
<div class="col-md-12 col-sm-12"><div id="oncejointyou">
<?php if(!empty($bf_benefits)){?>
<ul class="list-orange">
	<?php foreach($bf_benefits as $bf_benefit){
		if(!empty($bf_benefit['benefit_points']))
		?>
	<li><?php echo $bf_benefit['benefit_points'];?></li>
	<?php }?>
</ul>
<?php }?>

</div></div>

</div>

</div><!-- middle-align -->
<div class="clear"></div>
</div>
<!--Once you join END-->
</section></div>
<?php }?>

<?php 

$args = array(
		'post_type' => 'plan',
		'post_status' => 'publish',
		);
		
$plans = get_posts($args);

if(!empty($plans)){
?>
<!-- Plans Start -->
<div class="select_butntext">
    <div class="wrapper">
<section class="">

            
<div class="container">
<div class="row">
            <div class="col-md-12 col-sm-12">
			<?php foreach($plans as $post){ setup_postdata($post);?>
            <div class="col-md-6 col-sm-6">
            <div class="subtitle"><?php the_title();?></div>
            <div class="text"><?php echo nl2br(get_the_content())?></div>
            <a href="<?php echo site_url('/register?subs='.get_the_ID())?>"><div class="button-title">Register Now</div></a>
            </div>
			<?php }
			wp_reset_postdata();
			?>
            </div>
            </div>
            
            
			</div></section>
		</div>
	</div>
<!-- Plans End -->
<?php }?>

<?php 

$workout_area = get_field('workout_area');


if(!empty($workout_area[0])){

$wo_title = $workout_area[0]['title'];
$wo_description = $workout_area[0]['description'];
$wo_background_image = $workout_area[0]['background_image'];
$wo_video_url = $workout_area[0]['video_url'];
$wo_workout_button = $workout_area[0]['workout_button'];
	
	?>
    <!--Workout Start-->
<div class="workoutwraper">

<section class="module parallax parallax-2">
    <div class="wrapper">

  <script src="<?php bloginfo('template_directory'); ?>/js/modernizr.js"></script>

		<?php 
		if(!empty($wo_background_image)){
		?>
        <div data-image-src="<?php echo $wo_background_image; ?>" data-parallax="scroll" class="sec_front">
		<?php }?>
            
<div class="container">
<div class="row">
            <div class="col-md-12 col-sm-12">
            <div class="col-md-7 col-sm-7">
            <div class="title"><?php echo $wo_title;?></div>
            <div class="text"><?php echo $wo_description;?></div>
			<?php if(!empty($wo_workout_button)){?>
            <a href="<?php echo $wo_workout_button[0]['link']?>"><div class="button-title"><?php echo $wo_workout_button[0]['title']?></div></a>
			<?php }?>
            </div>
            <div class="col-md-5 col-sm-5">
			<?php if(!empty($wo_video_url)) {?>
			<iframe class="homevideoiframe" src="<?php echo $wo_video_url;?>" allowfullscreen></iframe>
			<?php }?>
            </div>
            </div>
            </div></div>
            
            
			</div></div></section>
		
	</div>
    <!--Workout END-->
<?php }?>
<?php 
$below_workout_area = get_field('below_workout_area');


if(!empty($below_workout_area)) {
	
	
$wod_title = $below_workout_area[0]['title'];
$wod_description = $below_workout_area[0]['description'];
$wod_right_image = $below_workout_area[0]['right_image'];
$wod_button_1 = $below_workout_area[0]['button_1'];

?>
    <!--Nutrition Start-->
<div class="white-max">
		<div class="container">
			<div class="col-md-6 col-sm-6">
        	<div class="front-third-left-side front-third-left-side-pad">
			
                <div class="title"><?php echo $wod_title;?></div>
				<div class="text"><?php echo $wod_description;?></div>
			<?php if(!empty($wod_button_1)){?>
				<a href="<?php echo $wod_button_1[0]['link']?>"><div class="button-title"><?php echo $wod_button_1[0]['title']?></div></a>
			<?php }?>
                    
			</div>
            </div>
            		<div class="col-md-6 col-sm-6">
            
			<div class="front-third-right-side">
			<?php 
		if(!empty($wod_right_image)){
			//$wod_right_image = get_bloginfo('template_directory').'/timthumb.php?src='.$wod_right_image.'&amp;w=339&amp;h=339&amp;zc=1';
		?>
				<img src="<?php echo $wod_right_image; ?>" class="opacitizer" alt="Image1" />
		<?php }?>
			</div></div>
		</div>
	</div>
    
    <!--Nutrition END-->
<?php } ?>
	
	
<?php 

$changing_lives = get_field('changing_lives');



if(!empty($changing_lives[0]['changes'])){
	
$lives_title = $changing_lives[0]['title'];
$lives_changes = $changing_lives[0]['changes'];
?>
	
<!--INTENSE BURN CHANGING LIVES Start-->

<div class="black-max">
		<div class="container">
        <div class="headingtitle">INTENSE BURN CHANGING LIVES</div>
			<div class="row"><div class="col-md-12 col-sm-12"><div class="row">
            <div class="col-md-6 col-sm-6">
				
				<?php foreach($lives_changes as $lives_change) {?>
					
					<?php if(!empty($lives_change['before_image'])){ 
					//$before_image = get_bloginfo('template_directory').'/timthumb.php?src='.$lives_change['before_image'].'&amp;w=221&amp;h=179&amp;zc=1';
					$before_image = $lives_change['before_image'];

					?>
				<div class="col-md-6 col-sm-6">
					<div class="ramka">
						<img  alt="Before" src="<?php echo $before_image; ?>" />
						<div class="boxintenseburn"><?php echo $lives_change['before_image_title']; ?></div>
					</div>
				</div>
					<?php }?>
					<?php if(!empty($lives_change['after_image'])){
						//$after_image = get_bloginfo('template_directory').'/timthumb.php?src='.$lives_change['after_image'].'&amp;w=221&amp;h=179&amp;zc=1';
						$after_image = $lives_change['after_image']; ?>
                    <div class="col-md-6 col-sm-6">
                    
                    <div class="ramka">
                    <img alt="After" src="<?php echo $after_image; ?>" />
                    	<div class="boxintenseburn"><?php echo $lives_change['after_image_title']; ?></div></div>
                </div>
					<?php } ?>
				<?php } ?>
                    
                    <div class="text_center"><a href="<?php echo site_url('/register/');?>" class="button-title">Join Us Now</a></div>
							
							
				</div>
			
		<div class="col-md-6 col-sm-6">
		
		
				<?php foreach($lives_changes as $lives_change) {?>
					<?php if(!empty($lives_change['title'])){
					?>
					<div class="top_rightburn">
						<div class="subtitle"><?php echo $lives_change['title'];?></div>
						<div class="text"><?php echo $lives_change['short_description'];?></div>
						<?php /*?><a href="#" class="button-title">Click Here</a><?php */?>
					</div>
					<?php }?>
					
				<?php }?>
		
		
		
		
				
			</div>
		</div></div></div>
</div></div>
<!--INTENSE BURN CHANGING LIVES END-->
<?php }?>

<!-- container -->


<!-- #primary -->

<?php
	}
	get_footer();
}
?>