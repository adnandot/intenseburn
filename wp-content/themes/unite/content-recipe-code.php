<?php
/**
 * @package unite
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header page-header">

		<?php the_post_thumbnail( 'unite-featured', array( 'class' => 'thumbnail' )); ?>

		<h1 class="entry-title "><?php the_title(); ?></h1>

		<div class="entry-meta">
			<?php unite_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		
		
	<div>
		<h2>Ingredient</h2>
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
		
	<div>
		<h2>Nutritional Information</h2>
		<?php $nutritional_information = get_field('nutritional_information');
		if(!empty($nutritional_information)){
			?><ul><?php
			foreach($nutritional_information as $nutritional){
				?><li><span><?php echo $nutritional['name']?></span>&nbsp;&nbsp;:&nbsp;&nbsp;<span><?php echo $nutritional['quantity']?></span></li><?php
			}
			?></ul><?php
		}
		?>
	</div>
	<div>
		<h2>Method</h2>
		<?php echo $method = get_field('method');?>
	</div>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'unite' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'unite' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', 'unite' ) );

			if ( ! unite_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = '<i class="fa fa-folder-open-o"></i> %2$s. <i class="fa fa-link"></i> <a href="%3$s" rel="bookmark">permalink</a>.';
				} else {
					$meta_text = '<i class="fa fa-link"></i> <a href="%3$s" rel="bookmark">permalink</a>.';
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = '<i class="fa fa-folder-open-o"></i> %1$s <i class="fa fa-tags"></i> %2$s. <i class="fa fa-link"></i> <a href="%3$s" rel="bookmark">permalink</a>.';
				} else {
					$meta_text = '<i class="fa fa-folder-open-o"></i> %1$s. <i class="fa fa-link"></i> <a href="%3$s" rel="bookmark">permalink</a>.';
				}

			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink()
			);
		?>

		<?php edit_post_link( __( 'Edit', 'unite' ), '<i class="fa fa-pencil-square-o"></i><span class="edit-link">', '</span>' ); ?>
		<?php unite_setPostViews(get_the_ID()); ?>
		<hr class="section-divider">
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
