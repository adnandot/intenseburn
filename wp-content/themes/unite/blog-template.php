<?php
/**
 * Template Name: Blog
 *
 * This is the template that displays full width page without sidebar
 *
 * @package unite
 */

get_header(); ?>
 
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

	<div class="container blogpagecontent">    
        <div class="row">
          
            <div class="col-md-12 col-sm-12">
			<?php
			$args = array( 
						'posts_per_page' => get_option('posts_per_page'), 
						'post_type' => 'post',
						'post_status' => 'publish'
					);
			
			
			
			$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
			$args['paged'] = $paged;


			$the_query = new WP_Query( $args );
			
			
			if (  $the_query->have_posts() ) {
            ?><ul class="nutritions_team" id="results"><?php 
				/* ?><div class="paging_wrapper"><?php 
					/* Restore original Post Data * /
					$big = 999999999; // need an unlikely integer
					echo paginate_links( array(
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format' => '?paged=%#%',
						'current' => max( 1, get_query_var('paged') ),
						'total' => $the_query->max_num_pages
					) );
					?></div><?php */
					wp_reset_postdata();
					?></ul>
	
<div class="animation_image" style="display:none">
<img src="<?php bloginfo('template_directory'); ?>/images/loading.gif" alt="" />
</div>
<script type="text/javascript">
jQuery(document).ready(function() {
	
    var track_load = 1; //total loaded record group(s)
    var loading  = true; //to prevents multipal ajax loads
    var total_groups = <?php echo $the_query->max_num_pages; ?>; //total record group(s)
    
    jQuery('#results').load('<?php echo admin_url( 'admin-ajax.php' );?>', { 'action':'load_blog', 'page':track_load}, function() {track_load++;loading = false;}); //load first group
    
    jQuery(window).scroll(function() { //detect page scroll
        
		
		
        if(( jQuery(window).scrollTop() + jQuery(window).height() ) > (jQuery(document).height() - jQuery('footer.footer').height() + 100))  //user scrolled to bottom of the page?
        {
            
            if(track_load <= total_groups && loading==false) //there's more data to load
            {
                loading = true; //prevent further ajax loading
                jQuery('.animation_image').show(); //show loading image
                
                //load data from the server using a HTTP POST request
                jQuery.post('<?php echo admin_url( 'admin-ajax.php' );?>',{'action':'load_blog', 'page':track_load}, function(data){
                                    
                    jQuery("#results").append(data); //append received data into the element

                    //hide loading image
                    jQuery('.animation_image').hide(); //hide loading image once data is received
                    
                    track_load++; //loaded group increment
                    loading = false; 
                
                }).fail(function(xhr, ajaxOptions, thrownError) { //any errors?
                    
                    alert(thrownError); //alert with HTTP error
                    jQuery('.animation_image').hide(); //hide loading image
                    loading = false;
                
                });
                
            }
        }
    });
});

</script>

<?php
			} else {
				?>
				
					<h2>No result found</h2>
				
				<?php
			}
			?>

			

			
           </div>

     </div>

	<!-- #main -->
	</div>

		</main><!-- #main -->
	</div><!-- #primary -->
 
<?php get_footer(); ?>