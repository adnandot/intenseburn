<?php
/**
 * The Template for displaying all single posts.
 *
 * @package unite
 */
get_header(); ?>

	<div class="container" id="print_able">
<div class="col-md-12 col-sm-12">
<div class="row"><div id="primary" class="content-area col-sm-12 col-md-8 <?php echo of_get_option( 'site_layout' ); ?>">
		<main id="main" class="site-main" role="main">
<div class="receipy_boxes">
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'recipe' ); ?>


			<?php
				// If comments are open or we have at least one comment, load up the comment template
				/*if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;*/
			?>

		<?php endwhile; // end of the loop. ?>
        <div class="clear"></div>
</div>
<script> function printContent(el){ var restorepage = document.body.innerHTML; var printcontent = document.getElementById(el).innerHTML; document.body.innerHTML = printcontent; 
jQuery('#print-recipe-div').hide();
window.print(); document.body.innerHTML = restorepage;jQuery('#print-recipe-div').show(); } </script>
						
		</main><!-- #main -->
	</div><!-- #primary -->

</div></div></div>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>