<?php
/**
 * Template Name: Shop
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


<div id="primary" class="content-area">
<main id="main" class="site-main" role="main">
	<div class="container">    
          <div class="col-md-12 col-sm-12">
          <div class="row theteampage shop">
            <div class="col-md-12 col-sm-12 1border_right">
            
            
            <div class="nutritions_team"><div class="col-md-12 col-sm-12"><div class="row_no">
             
			<?php
			$args = array( 'posts_per_page' => -1, 'post_type' => 'shop' );

			$myposts = get_posts( $args );
			foreach ( $myposts as $k => $post ) : setup_postdata( $post ); ?>
            
             <?php 
				
				if($k % 2 == 0) {
				
				?><div class="row_margin">
                <div class="row">  <div class="row">
				
				<?php	
					
				}?>
				
                <div class="col-md-6">
			 		<div class="col-md-6 col-sm-6">
                    <?php 
					$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
					$url = $thumb['0'];
					
					//$url = aq_resize( $url, 1920, 500, false );
					$url = get_bloginfo('template_directory').'/timthumb.php?src='.$url.'&amp;w=270&amp;h=260&amp;zc=1';
					
					?>
                    
                    <img src="<?php echo $url; ?>" alt="" /></div>
               <div class="col-md-6 col-sm-6">
			   <div class="title_nutrition"><?php the_title();?></div>
			   <?php 
			   get_template_part( 'content', 'page' ); ?>	
               <div class="shopbtn"><a href="<?php echo get_field('third_party_url')?>" target="_blank" class="create-mealplan">Buy Now</a></div>
               </div>
               
               <div class="clear"></div>
				</div>
                
                <?php 
				
				if($k % 2 == 1) {
				
				?><div class="clear"></div></div></div></div><?php	
					
				}?>
                
                
			<?php endforeach; 
			wp_reset_postdata();?>
			
                
                <?php 
				
				if($k % 2 == 0) {
				
				?></div>
				</div>
				<?php	
					
				}?>
			</div>
			
           </div>

     </div></div>

	<!-- #main -->
	</div>

		<!-- #main -->
</div>	</div><!-- #primary -->
</main></div>
<?php get_footer(); ?>
