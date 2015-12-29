<?php
/**
 * Template Name: Login
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
		  
		  
		  
			<?php while ( have_posts() ) : the_post(); ?>

				<?php the_content(); ?>
				

			<?php endwhile; // end of the loop. ?>
		  
          </div>
	</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
