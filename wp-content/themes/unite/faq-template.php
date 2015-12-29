<?php
/**
 * Template Name: Faq
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
          <div class="row faqpage">
            

  <div class="faq-area">
  
				<?php 
				
				$args = array(
					'post_type'             => 'faq',
					'post_status'           => 'publish',
					'posts_per_page'        => '-1',
				);
				
				
				$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
				$args['paged'] = $paged;
				
				$recipe = new WP_Query($args);
				$i =0;
				?>
					<div class="faq_content"><?php
				while ( $recipe->have_posts() ) { $recipe->the_post();$i++;
				
				?>
  
  
  
						<div class="col-md-6 col-sm-6">
						<div class="faq-single">
				<div class="title-faq-single">
				<?php echo $i;?>. <?php the_title()?>				</div>
				<div class="text-faq-single">
				<?php the_content()?>
				
				</div>
			</div>
			</div>
					<?php if($i%2 == 0){
						?></div><div class="faq_content"><?php
					}?>
				
				
				<?php }?>
				</div>
					
			
		</div>   </div></div>

		<!-- #main -->
	</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
