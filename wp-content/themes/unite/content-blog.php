<?php
/**
 * @package unite
 */
?>

<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                
					<div class="col-md-2 col-sm-2 padingrightnone"><header class="blogdate"><h1 class="page-title"><span class="month"><?php echo get_the_date('F'); ?></span><span class="date"><?php echo get_the_date('d, Y'); ?></span></h1></header></div>
					<div class="col-md-5 col-sm-5 padingrightnond">           <article class="post-241 team type-team status-publish has-post-thumbnail hentry team-cat-nutritions" id="post-241">
						<header class="entry-header page-header">
							<h1 class="entry-title"><?php the_title();?></h1>
							<div class="categoriestype"><?php 
							$cats = get_the_category(get_the_ID());
							
							$temp = array();
							foreach($cats as $cat){
								$temp[] = $cat->name;
							}
							
							if(!empty($temp)){
								echo implode(', ', $temp);
							}
							
							?> </div>
						</header><!-- .entry-header -->

						<div class="entry-content">
							<?php the_content();?>
								</div><!-- .entry-content -->
						</article></div>
								 <div class="col-md-5 col-sm-5 right_padingnone">
								 
								 <?php echo get_the_post_thumbnail(null, 'large')?>
								 
								 </div>
								   
								   <div class="clear"></div>
									</li>