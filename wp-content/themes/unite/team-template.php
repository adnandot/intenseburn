<?php
/**
 * Template Name: Team
 *
 * This is the template that displays full width page without sidebar
 *
 * @package unite
 */

get_header(); ?>


 
<div id="primary" class="content-area">
<main id="main" class="site-main" role="main">
	<div class="container">    
          <div class="col-md-12 col-sm-12">
          <div class="row theteampage">
            <div class="col-md-6 col-sm-12 border_right">
            <div class="title_nutrition"><img src="<?php bloginfo('template_directory'); ?>/images/diet.png" alt="" />The nutritionists</div>
            
            <ul class="nutritions_team">
			<?php
			$args = array( 'posts_per_page' => -1, 'post_type' => 'team', 'team-cat' => 'Nutritions' );

			$myposts = get_posts( $args );
			foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
				<li>
			 <div class="col-md-6 col-sm-6"><div class="circle_images"><?php the_post_thumbnail('medium')?></div></div>
               <div class="col-md-6 col-sm-6"><?php get_template_part( 'content', 'page' ); ?>	<?php /*?><a href="<?php the_permalink(); ?>" class="button-title">Read More</a><?php */?></div>
               <div class="clear"></div>
				</li>
			<?php endforeach; 
			wp_reset_postdata();?>

			</ul>
			
           </div>

  <div class="col-md-6 col-sm-12 border_right_right">
  <div class="title_fitness"><img src="<?php bloginfo('template_directory'); ?>/images/strongman.png" alt="" />Fitness Team </div>
			<ul class="fitness_team">
			<?php


			$args = array( 'posts_per_page' => -1, 'post_type' => 'team', 'team-cat' => 'Fitness' );

			$myposts = get_posts( $args );
			foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
				<li>
                 <div class="col-md-6 col-sm-6"><div class="circle_images"><?php the_post_thumbnail('medium')?></div></div>
                  <div class="col-md-6 col-sm-6"><?php get_template_part( 'content', 'page' ); ?>
					<?php /*?><a href="<?php the_permalink(); ?>" class="button-title">Read More</a><?php */?></div>
                    <div class="clear"></div>
				</li>
			<?php endforeach; 
			wp_reset_postdata();?>

			</ul>
            

         </div>   </div></div>

		<!-- #main -->
	</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
