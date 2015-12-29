<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package unite
 */
?>
	</div><!-- #content -->

<!-- #New footer -->

<footer role="contentinfo" class="footer">
			<div class="container">
				<div class="footer-logo">
					<a href="#">
                    <img class="" src="<?php bloginfo('template_directory'); ?>/images/logo.png" alt="" />
				
					</a>
				</div>
				
				<div class="footer-social">
					<a href="#">
							<i class="fa fa-twitter"></i>
						</a>
						<a href="#">
							<i class="fa fa-facebook"></i>
						</a>
						<a href="#">
							<i class="fa fa-youtube-play"></i>
						</a>
						<a href="#">
							<i class="fa fa-google-plus"></i>
						</a>
				</div>
				<div class="credits-footer">
					Copyright &copy; 2015 <span>IntenseBurn.</span> All rights reserved.
				</div>
			</div>
		</footer>
     <!-- #New footer -->

<!-- #Old footer -->
<?php /*?>	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info container">
			<div class="row">
				<nav role="navigation" class="col-md-6">
					<?php unite_footer_links(); ?>
				</nav>

				<div class="copyright col-md-6">
					<?php do_action( 'unite_credits' ); ?>
					<?php echo of_get_option( 'custom_footer_text', 'unite' ); ?>
				
				</div>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon --><?php */?>
    <!-- #Old footer -->
    
</div><!-- #page -->
<?php wp_footer(); ?>
<script type="text/javascript">

var temp_text = jQuery('<div><span>This</span>span</div>');


jQuery(document).ready(function(){
	
	jQuery('#menu-main-menu li a').each(function(){
		
		var tt = jQuery(this).attr('title');
		
		jQuery(this).attr('title', jQuery("<div/>").html(tt).text());
		
		
	});
	
});

</script>
</body>
</html>