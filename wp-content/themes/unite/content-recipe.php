<?php
/**
 * @package unite
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="col-sm-12 col-md-12 toptxt">
    <h1 class="education-title"><?php the_title(); ?></h1>
<?php the_content(); ?></div>

	<div class="col-sm-6 col-md-6">
     <div class="right-sidesingle">
				<div class="eat-image"><?php the_post_thumbnail( 'unite-featured', array( 'class' => 'thumbnail' )); ?></div>
				<div class="nutritional-information">
					<div class="nutritional-title">Nutritional information (per serving)</div>
					
						<?php $nutritional_information = get_field('nutritional_information');
		if(!empty($nutritional_information)){
			?><div class="nutritional-list"><?php
			foreach($nutritional_information as $nutritional){
				?><div class="single-nutritional"><?php echo $nutritional['name']?><span><?php echo $nutritional['quantity']?></span></div><?php
			}
			?></ul><?php
		}
		?>
                    
                    
				</div>
				<div class="allergens">
					<div class="nutritional-title">
						Allergens
					</div>
					<div class="allergens-text">
						<?php echo get_field('allergens')?>				</div>
				</div>
			</div>
    
    
    
    </div>
	</div>
	<div class="col-sm-6 col-md-6">
    <div class="what-time-eat">
					<?php 
					$post_terms = wp_get_post_terms( get_the_ID(), 'recipe-cat', array("fields" => "ids") );
					
					
					$terms = getRecipeCats();
					if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
						foreach ( $terms as $term ) {
							?><div class="single-what-time-eat">
						<span><?php echo $term->name;?></span>
						<div class="what-time-eat-circle-<?php echo in_array($term->term_id, $post_terms) ? 'yes' : '';?>">
						<?php if(in_array($term->term_id, $post_terms)){
						/*?><img class="print_show" alt="yes" src="<?php bloginfo('template_directory'); ?>/images/recipe-cat-yes.png"/><?php	*/
						}?>
						</div>
					</div><?php
						}
					}
					
					?>
				</div>
                <div class="suitable-desc">
					<div class="suitable-for">
						Suitable for: <span><?php echo get_field('suitable_for')?>	</span>
					</div>
					<div class="suitable-prep-time">
						Prep time (excluding cook time):
						<span><?php echo get_field('prep_time')?></span>
					</div>
					<div class="suitable-serving">
												Servings: 
												<?php 
												$servings = get_field('servings');
												$serving_str = '<img src="'. get_bloginfo('template_directory').'/images/serving.png" alt="serving">';
												echo str_repeat($serving_str, $servings);
												?>
											</div>
				</div>
    
    <div class="entry-content">
		
		
		
	<div class="ingridients-ticks">
		<h2 class="ingridients-title">Ingredient</h2>
		<?php $ingredients = get_field('ingredients');
		if(!empty($ingredients)){
			?><ul><?php
			foreach($ingredients as $ingredient){
				?><li><?php echo $ingredient['ingredient_value']?></li><?php
			}
			?></ul><?php
		}
		?>
	</div>
		
	
	<div class="ingridients-ticks">
		<h2 class="ingridients-title">Method</h2>
		<?php echo $method = get_field('method');?>
	</div>
	</div><!-- .entry-content -->
	<div class="bottom-icons-single">
  <div class="print-recipe" id="print-recipe-div"> 
    <button onClick="printContent('print_able')"><img src="<?php bloginfo('template_directory'); ?>/images/print_page.png" alt="" /></button>
  </div>
  </div>
	<div class="clear"></div>
    </div>
</article><!-- #post-## -->
