<?php
/**
 * Template Name: Test Page 
 *
 * This is the template that displays full width page without sidebar
 *
 * @package unite
 */
get_header(); ?>

<div class="container">
<div class="col-md-12 col-sm-12">
<div class="row">
<div id="primary" class="content-area col-sm-12 col-md-12">
	
		<?php 
				$args = array(
				'post_type'             => 'video',
				'post_status'           => 'publish',
				'posts_per_page'        => '-1',
				 'tax_query'             => array(
					array(
						'taxonomy'      => 'level',
						'field'         => 'term_id', //This is optional, as it defaults to 'term_id'
						/* 'terms'         => $FirstSectionCategoryId, */
						)
				) 
			);
			$video = new WP_Query($args);
			echo '<pre>';
			print_r($video);
			die;
			?>

	<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
</div><!-- #primary -->
</div></div></div>

<?php get_footer(); ?>
