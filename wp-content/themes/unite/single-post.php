<?php
/**
 *
 * @package unite
 */

get_header(); ?>
<div class="container">
<div class="col-md-12 col-sm-12">
<div class="row">
	<div id="primary" class="content-area col-sm-12 col-md-8 <?php echo of_get_option( 'site_layout' ); ?>">
		<main id="main" class="site-main" role="main">
<div class="container blogpagecontent">    
        <div class="row">
          
            <div class="col-md-12 col-sm-12">
		
		<ul class="nutritions_team results">
       
		<?php while ( have_posts() ) : the_post(); ?>
	
			
			<?php get_template_part( 'content', 'blog' ); ?>

			<?php unite_post_nav(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>
        </ul>
        
        
        </div></div></div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php //get_sidebar(); ?></div></div></div>
<?php get_footer(); ?>