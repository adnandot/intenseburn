<?php 
/**
 * Template Name: Start Today
 *
 * This is the template that displays full width page without sidebar
 *
 * @package unite
 */

    if ( get_option( 'show_on_front' ) == 'posts' ) {
        get_template_part( 'index' );
    } elseif ( 'page' == get_option( 'show_on_front' ) ) {

 get_header(); ?>

 
<?php 
$small_banner_area = get_field('small_banner_area');



if(!empty($small_banner_area[0]['title']) || !empty($small_banner_area[0]['items'])){

?>
 
 
<div class="starttodaypage">
 
<div class="slider-main">
<div class="nivoSlider" id="slider_inner">         
<div class="container">
<?php if(!empty($small_banner_area[0]['title'])){?>
<h2 class="section_title"><?php echo $small_banner_area[0]['title'];?></h2>
<?php }?>

<?php if(!empty($small_banner_area[0]['items'])){?>
<div class="row">
<div class="col-md-12 col-sm-12"><div id="oncejointyou">
<ul class="list-orange">
		<?php foreach($small_banner_area[0]['items'] as $item){?>
        <li><?php echo $item['data']?></li>
		<?php }?>
</ul>
</div></div>
</div>
<?php }?>

</div>
</div></div>                                                                            
</div>
<?php }?>
	<div class="main-container">
<section class="menu_page" id="services" style="background-color:#272727; ">

<?php 
$informational_boxes = get_field('informational_boxes');

if(!empty($informational_boxes)){
?>
    <!--Nutrition Start-->
<div class="white-max">
		<div class="container">
			<?php foreach($informational_boxes as $informational_box){?>
			<div class="col-md-3 col-sm-3">
        	<div class="getstarted">
			
                <div class="title"><?php echo $informational_box['title']?></div>
				<div class="text"><?php echo $informational_box['description']?></div>
				
                    
			</div>
            </div>
			<?php }?>
		</div>
	</div>
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
				
				<div class="title">get started </div>
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

<!-- container -->
</section>

</div><!-- #primary -->


<?php get_footer(); } ?> 