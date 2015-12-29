<?php
/**
 * Template Name: How It Work
 *
 * This is the template that displays full width page without sidebar
 *
 * @package unite
 */

get_header(); ?>


 
<div id="primary" class="content-area howitworkpage">
<main id="main" class="site-main" role="main">
 
 <?php 
 
$informational_boxes  = get_field('informational_boxes');


if(!empty($informational_boxes)){
	?>
	
	<?php
	foreach($informational_boxes as $k => $informational_box){
		
		if($k%3 == 0){
		
		?>
		
		<div class="select_butntext">
    <div class="wrapper">
<section class="">

            
<div class="container">
<div class="row">
            <div class="col-md-12 col-sm-12">
		<?php
		}
		
		?>
		<div class="col-md-4 col-sm-4">
            <div class="subtitle"><?php echo $informational_box['title'];?></div>
            <div class="text"><?php echo $informational_box['description'];?></div>
        </div>
		<?php
		
		if($k%3 == 2){
		
		?>
	</div>
            </div>
            
            
			</div></section>
		</div>
	</div>
		
		
		<?php
		}
		
	}
	
	
	if($k%3 < 2){
		
		?>
	</div>
            </div>
            
            
			</div></section>
		</div>
	</div>
		
		
		<?php
		}
	
	
}
 ?>
 
	
<div class="getinclude">
  <div class="headingtitle">WHAT YOU GET INCLUDED</div>
  
  
  
<?php 
 
$included_section  = get_field('included_section');


if(!empty($included_section)){
	?>
	
	<?php
	foreach($included_section as $k => $included_sec){
		
		if($k%3 == 0){
		
		?>
		
		<div class="select_butntext">
    <div class="wrapper">
<section class="">
<div class="container">
<div class="row">
            <div class="col-md-12 col-sm-12">
		<?php
		}
		
		?>
		<div class="col-md-4 col-sm-4">
			<div class="subtitle"><?php echo $included_sec['title'];?></div>
			<?php 
			
				if(!empty($included_sec['image']['sizes']['medium_large'])){
					
			?>
			<div class="ramka">
				<?php 
				
				//$image = get_bloginfo('template_directory').'/timthumb.php?src='.$included_sec['image'].'&amp;w=676&amp;h=457&amp;zc=1';
				?>
				<img src="<?php echo $included_sec['image']['sizes']['medium_large']; ?>" class="" alt="Info" />
				
			</div>
			<?php 
			}
			?>
	   </div>
		<?php
		
		if($k%3 == 2){
		
		?>
	</div>
            </div>
			</div></section>
		</div>
	</div>
		
		
		<?php
		}
		
	}
	
	
	if($k%3 < 2){
		
		?>
	</div>
            </div>
			</div></section>
		</div>
	</div>
		
		
		<?php
		}
	
	
}
 ?>
  
  
    
    </div>
    <div class="headingtitle">ACT NOW</div>
   <div class="starttodaybtn"> <a href="<?php echo site_url('/subscribe/');?>" class="button-title">START TODAY</a></div>
    
    <!--
   </div>

		</main>
         #main 
	</div>-->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
