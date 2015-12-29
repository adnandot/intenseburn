<?php
/**
 *
 * This is the template that displays full width page without sidebar
 *
 * @package unite
 */

get_header(); ?>
<div class="slider-main innerpagetitle">
<div class="nivoSlider" id="slider">         
<img class="nivo-main-image" src="<?php bloginfo('template_directory'); ?>/images/blog.jpg" alt="" /><div class="nivo-caption" style="display: block;">
<div class="theteamtitle">
<div class="container"><p><span class="orange-text"></span>Blog</p></div>
</div>

</div></div>                                                                            
</div>
 
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

	<div class="container blogpagecontent">    
        <div class="row">
          
            <div class="col-md-12 col-sm-12">
            <ul class="nutritions_team">
			<?php
			$args = array( 'posts_per_page' => -1, 'post_type' => 'team', 'team-cat' => 'Nutritions' );
			$myposts = get_posts( $args );
			foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
				<li>
                <div class="col-md-2 col-sm-2 padingrightnone"><header class="blogdate"><h1 class="page-title"><span class="month">December</span><span class="date">21</span></h1></header></div>
                <div class="col-md-5 col-sm-5 padingrightnond">           <article class="post-241 team type-team status-publish has-post-thumbnail hentry team-cat-nutritions" id="post-241">
	<header class="entry-header page-header">
		<h1 class="entry-title">we denounce with righteous indignation and dislike men</h1>
        <div class="categoriestype">BURN MORE WITH CIRCUITS </div>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas maximus tellus sit amet enim elementum blandit. Aenean tellus leo, maximus quis rhoncus id, finibus sit amet mi. Nam a felis sit amet orci euismod commodo. Vestibulum commodo nunc diam,  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas maximus tellus sit amet enim elementum blandit. Aenean tellus leo, maximus quis rhoncus id, finibus sit amet mi. Nam a felis sit amet orci euismod commodo. Vestibulum commodo nunc diam, </p>
			</div><!-- .entry-content -->
	</article><a href="<?php the_permalink(); ?>" class="button-title">Read More</a></div>
			 <div class="col-md-5 col-sm-5 right_padingnone"><img class="" src="<?php bloginfo('template_directory'); ?>/images/blog1.jpg" alt="" /></div>
               
               <div class="clear"></div>
				</li>
			<?php endforeach; 
			wp_reset_postdata();?>

			</ul>
			
           </div>

     </div>

	<!-- #main -->
	</div>

		</main><!-- #main -->
	</div><!-- #primary -->
 
<?php get_footer(); ?>