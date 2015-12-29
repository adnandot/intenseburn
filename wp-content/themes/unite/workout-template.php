<?php
/**
	* Template Name: Workout Template
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

<div class="container">
<div class="col-md-12 col-sm-12">
  <div class="row_temp">
    <div id="primary" class="content-area <?php echo of_get_option( 'site_layout' ); ?>">
      <div class="row">
        <div class="col-md-12 col-sm-12">
          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="receipy_boxes">
              <header class="entry-header page-header">
                <h1 class="entry-title">My Workout Fitness <?php echo get_field('current_level', get_user_by( 'id', getLoggedinUserId() ))?> </h1>
              </header>
              <!-- .entry-header -->
              
              <div class="col-md-12 col-sm-12">
			  <div class="workout_categorie">
              <form method="get" action="<?php echo site_url('/member-area/my-workout');?>">
				<?php 
				
					$terms = getTermLevel();
					
					$selectedLevel = isset($_GET['level']) && $_GET['level'] != '' ? $_GET['level'] : '';
					
					if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
						echo '<select name="level" id="level" class="eat">';
						foreach ( $terms as $k => $term ) {
							if(trim($selectedLevel) == '' && $k == 0){
								$selectedLevel = $term->term_id; 
							}
							?><option value="<?php echo $term->term_id;?>" <?php if($term->term_id == $selectedLevel){ echo 'selected="selected"';}?>><?php echo $term->name;?></option><?php
						}
						echo '</select>';
					}
					
				
					?>
					
					
					
			  
				<?php 
					$terms = getTermGoal();
					
					$selectedGoal = isset($_GET['goal']) && $_GET['goal'] != '' ? $_GET['goal'] : '';
					
					if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
						echo '<select name="goal" id="goal" class="eat">';
						foreach ( $terms as $k => $term ) {
							if(trim($selectedGoal) == '' && $k == 0){
								$selectedGoal = $term->term_id; 
							}
							?><option value="<?php echo $term->term_id;?>" <?php if($term->term_id == $selectedGoal){ echo 'selected="selected"';}?>><?php echo $term->name;?></option><?php
						}
						echo '</select>';
					}
				
					?>
					
					
			  
				<?php 
					$terms = getTermFitness();
					
					$selectedFitness = isset($_GET['fitness']) && $_GET['fitness'] != '' ? $_GET['fitness'] : '';
					
					if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
						echo '<select name="fitness" id="fitness" class="eat last">';
						foreach ( $terms as $k => $term ) {
							if(trim($selectedFitness) == '' && $k == 0){
								$selectedFitness = $term->term_id; 
							}
							?><option value="<?php echo $term->term_id;?>" <?php if($term->term_id == $selectedFitness){ echo 'selected="selected"';}?>><?php echo $term->name;?></option><?php
						}
						echo '</select>';
					}
				
					?>   
                    <div class="search_abutton"><input class="search-button" type="submit" value="Submit" /></div>
                    </form>
                    
                    
              <div class="clear"></div></div></div>
              
			  <?php 
			  
			  $args = array('post_type' => 'video',
				'posts_per_page' => get_option('posts_per_page'), 
				'tax_query' => array(   //(array) - use taxonomy parameters (available with Version 3.1).
				'relation' => 'AND',  //(string) - Possible values are 'AND' or 'OR' and is the equivalent of ruuning a JOIN for each taxonomy
				  array(
					'taxonomy' => 'level',                //(string) - Taxonomy.
					'field' => 'id',                    //(string) - Select taxonomy term by ('id' or 'slug')
					'terms' => $selectedLevel,    //(int/string/array) - Taxonomy term(s).
					//'include_children' => true,           //(bool) - Whether or not to include children for hierarchical taxonomies. Defaults to true.
					//'operator' => 'IN'                    //(string) - Operator to test. Possible values are 'IN', 'NOT IN', 'AND'.
				  ),
				  array(
					'taxonomy' => 'goal',
					'field' => 'id',
					'terms' => $selectedGoal,
					//'include_children' => false,
					//'operator' => 'NOT IN'
				  ),
				  array(
					'taxonomy' => 'fitness',
					'field' => 'id',
					'terms' => $selectedFitness,
					//'include_children' => false,
					//'operator' => 'NOT IN'
				  )
				),

			 );
			 
			$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
			$args['paged'] = $paged;

			 $loop = new WP_Query($args);
			 if($loop->have_posts()) {
				 ?>
				 
			  
              <div class="workout_videolist"> 
                 <div class="col-md-12 col-sm-12">
              <div class="row">
				 <?php
				while($loop->have_posts()) : $loop->the_post();
					
					?>
					<div class="col-md-3 col-sm-6">
						<div class="title">
							<a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a>
						</div>
						<div class="entry-content receipiimage">
							<a href="<?php echo get_permalink();?>">
								<?php 
								$url = get_field('video_thumb');
								
								if($url != '') {
								//$url = aq_resize( $url, 1920, 500, false );
								$url = get_bloginfo('template_directory').'/timthumb.php?src='.$url.'&amp;w=270&amp;h=190&amp;zc=1';
								?>
								<img alt="<?php echo get_the_title();?>" class="nivo-main-image" src="<?php echo $url; ?>">
								<?php } else {
									?>
								<img alt="<?php echo get_the_title();?>" class="nivo-main-image" src="<?php bloginfo('template_directory'); ?>/images/no_images.jpg"><?php
								}?>
							</a>
						</div>
					</div>
					<?php
					
					
				endwhile;
				?>
                <div class="clear"></div>
                 <div class="paging_wrapper"><?php 
					/* Restore original Post Data */
					$big = 999999999; // need an unlikely integer
					echo paginate_links( array(
						'base' => strtok(str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),'?'),
						'format' => '?paged=%',
						'current' => max( 1, get_query_var('paged') ),
						'total' => $loop->max_num_pages
					) );
					?></div><?php 
				
				?>
				
              </div>
              </div>   <div class="clear"></div>
              </div> 
			  <div class="clear"></div>
				<?php
					wp_reset_postdata();
			 } else {
				 ?>
			  <div class="clear"></div>
			  <h2 style="    text-align: center;    margin-top: 50px;">No workout available.</h2><?php
			 }
			  
			  ?>
			  
              </div>
			  <div class="clear"></div>
            </div>
          </article>
          <!-- #post-## --> 
        </div>
      </div>
      <!-- #primary --> 
<script type="text/javascript"></script>
      
    </div>
  </div>
</div>
<?php get_footer(); ?>
