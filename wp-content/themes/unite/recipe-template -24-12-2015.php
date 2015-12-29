<?php
/**
	* Template Name: Recipe Template
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package unite
 */

if(!isSubscriber()){
	wp_redirect(site_url('login'));
	exit;
}



get_header(); ?>
<div class="container recepitop">
<div class="col-md-12 col-sm-12">
<div class="row">
	<div id="primary" class="content-area col-sm-12 col-md-12 <?php echo of_get_option( 'site_layout' ); ?>">
    
	<?php if(isset($_GET['added'])){
		?><div class="success">Recipe added successfuly.</div><?php
	}?>
	
    <div class="receipysearch">
		<form action="<?php echo site_url('/member-area/recipes/');?>" method="get">
    	<span class="text-search">Ingredient</span>
		<?php 
		$ingredient = isset($_GET['ingredient']) ? trim($_GET['ingredient']) : '';
		?>
        <input name="ingredient" value="<?php echo $ingredient?>" class="search">
        <span class="text-search">What to eat</span>
        
		<?php 
					$recipeCat = isset($_GET['recipe-cat']) ? trim($_GET['recipe-cat']) : '';
					$terms = getRecipeCats();
					if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
						echo '<select class="eat" name="recipe-cat">
						<option value="">Default</option>
						';
						
						foreach ( $terms as $term ) {
							?><option value="<?php echo $term->term_id;?>" <?php echo $recipeCat == $term->term_id ? 'selected="selected"' : '';?>><?php echo $term->name;?></option><?php
						}
						echo '</select>';
					}


					?> 
       <div class="search-abutton"><input class="search-button" type="submit" value="Search" /></div>
       <div class="search-button"><a href="<?php echo site_url('/member-area/add-recipe/');?>">Add Recipe</a></div>
       
       <div style="float:left; width:100%; margin:20px 0px;" class="orange line"></div>     
	   </form>
    </div>
		 

		<?php 
		//echo do_shortcode('[acf_form group_id="97"]');
				$args = array(
				'post_type'             => 'recipe',
				'post_status'           => 'publish',
				'posts_per_page'        => get_option('posts_per_page'),
				'author__in'        	=> array(getLoggedinUserId(), '1'),
				
			);
			
			
			
			if($ingredient) {
				$args['meta_query'] = array(  
										   array(
											 'key' => 'ingredient_%_ingredient_value',                  //(string) - Custom field key.
											 'value' => $ingredient,                 //(string/array) - Custom field value (Note: Array support is limited to a compare value of 'IN', 'NOT IN', 'BETWEEN', or 'NOT BETWEEN')
											 'type' => 'CHAR',                  //(string) - Custom field type. Possible values are 'NUMERIC', 'BINARY', 'CHAR', 'DATE', 'DATETIME', 'DECIMAL', 'SIGNED', 'TIME', 'UNSIGNED'. Default value is 'CHAR'.
											 'compare' => 'LIKE',                  //(string) - Operator to test. Possible values are '=', '!=', '>', '>=', '<', '<=', 'LIKE', 'NOT LIKE', 'IN', 'NOT IN', 'BETWEEN', 'NOT BETWEEN'. Default value is '='.
										   )
										   /*,
										   array(
											 'key' => 'price',
											 'value' => array( 1,200 ),
											 'compare' => 'NOT LIKE'
										   )*/
								   );
			}
			
			
			
			if($recipeCat) {
				$args['tax_query'] = array(
										'relation' => 'AND',                      //(string) - Possible values are 'AND' or 'OR' and is the equivalent of ruuning a JOIN for each taxonomy
										  array(
											'taxonomy' => 'recipe-cat',                //(string) - Taxonomy.
											'field' => 'id',                    //(string) - Select taxonomy term by ('id' or 'slug')
											'terms' => $recipeCat,    //(int/string/array) - Taxonomy term(s).
											'include_children' => true,           //(bool) - Whether or not to include children for hierarchical taxonomies. Defaults to true.
											'operator' => 'IN'                    //(string) - Operator to test. Possible values are 'IN', 'NOT IN', 'AND'.
										  )
										  /*,
										  array(
											'taxonomy' => 'actor',
											'field' => 'id',
											'terms' => array( 103, 115, 206 ),
											'include_children' => false,
											'operator' => 'NOT IN'
										  )*/
										);
			}
			
			
			$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
			$args['paged'] = $paged;
			
			$recipe = new WP_Query($args);
			//pr($recipe);
			if (  $recipe->have_posts() ) {
				$rr=0;
				?><div class="row"><?php 
			/* Start the Loop */ 
			while ( $recipe->have_posts() ) : $recipe->the_post(); global $recipe; $rr++;
				
				/*$thumbnail_id = get_post_meta($post->ID, '_thumbnail_id', true);
				$default_attr = array(
					'class' => "",
					'alt'   => get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true),
				);
				the_post_thumbnail('full', $default_attr );*/
				
			?>
            
  <div class="col-md-6 col-sm-6">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="receipy_boxes">
            	<header class="entry-header page-header">
					<h1 class="entry-title"><a href="<?php echo get_permalink()?>"><?php echo get_the_title(); ?></a></h1>
				</header><!-- .entry-header -->
			
				
                <div class="col-md-6 col-sm-12 full_width">
                <div class="entry-content receipiimage">
				
				
				<a title="<?php echo get_the_title(); ?>" href="<?php echo get_permalink()?>">	
				<?php if(has_post_thumbnail()){?>
				<?php 
				
					/**/
					$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
					$url = $thumb['0'];
					$url = get_bloginfo('template_directory').'/timthumb.php?src='.$url.'&amp;w=400&amp;h=300&amp;zc=1';
				?><img src="<?php echo $url;?>" class="nivo-main-image" alt="<?php echo trim( strip_tags( get_the_title() ) );?>"/>
				<?php } else {
					?><img src="<?php bloginfo('template_directory'); ?>/images/no_images.jpg" class="nivo-main-image" alt="<?php echo trim( strip_tags( get_the_title() ) );?>"/>
				<?php
				}?>
				</a>
				
				
				</div>
				</div>
                
                <div class="col-md-6 col-sm-12 full_width">
				<?php the_excerpt(); ?>
				<a class="button-title" href="<?php echo get_permalink()?>">Read More</a>
                </div>
                <div class="clear"></div>
                </div>
			</article><!-- #post-## -->
           </div>
			<?php if($rr > 0 && $rr%2 == 0){
				?></div><div class="row"><?php
			}?>
			
		<?php endwhile; 
				 ?>
                 </div>
                
                 <div class="paging_wrapper"><?php 
					/* Restore original Post Data */
					$big = 999999999; // need an unlikely integer
					echo paginate_links( array(
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format' => '?paged=%#%',
						'current' => max( 1, get_query_var('paged') ),
						'total' => $recipe->max_num_pages
					) );
					?></div><?php 
					wp_reset_postdata();		
			} else {
				?>
				
					<h2>No result found</h2>
				
				<?php
			}?>  
	</div><!-- #primary -->

</div></div></div>
<?php get_footer(); ?>
