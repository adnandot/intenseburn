<?php
/**
 * Template Name: Education
 *
 * This is the template that displays full width page without sidebar
 *
 * @package unite
 */
 if(!isSubscriber()){
	wp_redirect(site_url('login'));
	exit;
} 
get_header(); 

?>

<div id="primary" class="content-area" style="min-height: 600px;">
  <main id="main" class="site-main" role="main">
    <div class="container">
      <div class="col-md-12 col-sm-12">
        <div class="row theteampage educationpage">
          <?php
		   
			$educational_video = get_user_meta(getLoggedinUserId(),'educational_video', true);
		
			
			if(!empty($educational_video)){
				$educational_video = @unserialize($educational_video);
				if(!is_array($educational_video)){
					$educational_video = array();
				}
			}
			
			
			
			
			
			$userplan          = get_user_meta(getLoggedinUserId(),'silver_plan', true);
			if(!empty($educational_video)){
			$args = array( 
						'post_type' => 'education',
						'post_status' => 'publish',
						'post_per_page' => -1,
						'post__in' => $educational_video,
						'meta_query' => array(
								'relation' => 'AND', /* <-- here */
									array(
									'key' => 'type',
									'value' => 'video',
									),
						) 
						);
			$the_query = null;	
			$the_query = new WP_Query( $args );
			  /*  $cc = $the_query->get_posts();echo '<pre>';	print_r($cc);die;   */
			if ($the_query->have_posts()) {				
				$education = $the_query->get_posts();
				$first_video_obj = $education[0];
				$first_video =  get_field('video', $first_video_obj->ID);
			?>
          <div class="col-md-8 col-sm-12 border_right">
            <ul class="nutritions_team">
              <li>
                <div class="col-md-12 col-sm-12">
                  <video id="eduVideo" width="100%" controls class="fullscreen-bg__video" poster="">
                    <source type="video/mp4" controls src="<?php echo $first_video['url']?>"></source>
                  </video>
                </div>
                <div class="clear"></div>
              </li>
            </ul>
          </div>
          <div class="col-md-4 col-sm-12" id="right-container" style="height:450px; overflow:hidden;">
            <ul class="fitness_team">
              <?php 

while ($the_query->have_posts()) : $the_query->the_post();
	$video_thumb = get_field('video_thumb');
	$video_thumb_id = get_post_meta($post->ID,'video_thumb', true);
	$video_thumb_alt   = get_post_meta($video_thumb_id, '_wp_attachment_image_alt', true);
	$video = get_field('video');	
?>
              <li>
                <a href="javascript:void(0);" onclick="playVideo(this)" rel='{"video": "<?php echo $video['url']?>"}'>
                <div class="col-md-4 col-sm-4"> <img src="<?php echo $video_thumb?>" width="100%" alt="<?php echo $video_thumb_alt ?>" /> </div>
                <div class="col-md-8 col-sm-8">
                  <h1 class="entry-title">
                    <?php the_title();?>
                  </h1>
                  <div class="entry-content">
                    <p>
                      <?php  $content = get_the_content(); 
echo wp_trim_words($content, $num_words = 20, $more = '… ' ); ?>
                    </p>
                  </div>
                </div>
                </a>
                <div class="clear"></div>
              </li>
              <?php
endwhile; 	 
wp_reset_query(); 
		/* Exclude 3 Video */
			if($userplan == 'true'){
		$exclude_args = array( 
						'post_type' => 'education',
						'post_status' => 'publish',
						'post_per_page' => 3,
						'post__not_in' => $educational_video,
						'meta_query' => array(
								'relation' => 'AND', /* <-- here */
									array(
									'key' => 'type',
									'value' => 'video',
									),
							) 
						);
			$the_query = null;	
			$the_query = new WP_Query( $exclude_args );
			if ($the_query->have_posts()) {
				while ($the_query->have_posts()) : $the_query->the_post(); 
				$exclude_video_thumb = get_field('video_thumb');
				$exclude_video_thumb_id = get_post_meta($post->ID,'video_thumb', true);
				$exclude_video_thumb_alt   = get_post_meta($video_thumb_id, '_wp_attachment_image_alt', true);
				?>
				<li>
               <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal">
                <div class="col-md-4 col-sm-4"> <img src="<?php echo $exclude_video_thumb?>" width="100%" alt="<?php echo $exclude_video_thumb_alt ?>" /> </div>
                <div class="col-md-8 col-sm-8">
                  <h1 class="entry-title">
                    <?php the_title();?>
                  </h1>
                  <div class="entry-content">
                    <p>
                      <?php  $exclude_content = get_the_content(); 
						echo wp_trim_words($exclude_content, $num_words = 20, $more = '… ' ); ?>
                    </p>
                  </div>
                </div>
                </a>
                <div class="clear"></div>
              </li>
				<?php endwhile; 	 
				wp_reset_query();
			} }
			?>
            </ul>
          </div>
			<?php } } else{
				echo "<h2 class='no_found'>No education video found</h2>";				
			} ?>
          <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/jquery.mCustomScrollbar.min.css">
          <!-- custom scrollbar plugin --> 
          <script src="<?php bloginfo('template_directory'); ?>/js/jquery.mCustomScrollbar.js"></script> 
          <script type="text/javascript">

var workoutVideo = document.getElementById('eduVideo');
function playVideo(obj){
	
	var data = jQuery.parseJSON(jQuery(obj).attr('rel'));
	console.log(data.video);
	
	
	jQuery(workoutVideo).find('source').attr('src', data.video);
	
	workoutVideo.load();
	//workoutVideo.play();
	
	
}
		(function($){
			$(window).load(function(){
				
				$("#right-container").mCustomScrollbar({
					scrollButtons:{enable:true},
					theme:"light-thick",
					scrollbarPosition:"outside"
				});
				
				/*
				$("#content-4").mCustomScrollbar({
					theme:"rounded-dots",
					scrollInertia:400
				});
				
				$("#content-5").mCustomScrollbar({
					axis:"x",
					theme:"dark-thin",
					autoExpandScrollbar:true,
					advanced:{autoExpandHorizontalScroll:true}
				});
				
				$("#content-6").mCustomScrollbar({
					axis:"x",
					theme:"light-3",
					advanced:{autoExpandHorizontalScroll:true}
				});
				
				$("#content-7").mCustomScrollbar({
					scrollButtons:{enable:true},
					theme:"3d-thick"
				});
				
				$("#content-8").mCustomScrollbar({
					axis:"yx",
					scrollButtons:{enable:true},
					theme:"3d",
					scrollbarPosition:"outside"
				});
				
				$("#content-9").mCustomScrollbar({
					scrollButtons:{enable:true,scrollType:"stepped"},
					keyboard:{scrollType:"stepped"},
					mouseWheel:{scrollAmount:188},
					theme:"rounded-dark",
					autoExpandScrollbar:true,
					snapAmount:188,
					snapOffset:65
				});*/
				
			});
		})(jQuery);
	</script> 
        </div>
<div class="clear"></div>
        <?php
			$educational_pdf = get_user_meta(getLoggedinUserId(),'educational_pdf', true);
			
			
			
			if(!empty($educational_pdf)){
				$educational_pdf = @unserialize($educational_pdf);
				if(!is_array($educational_pdf)){
					$educational_pdf = array();
				}
			}
			
			
			if(!empty($educational_pdf)){
			$pdf_args = array( 
						'post_type' => 'education',
						'post_status' => 'publish',
						'post_per_page' => -1,
						'post__in' => $educational_pdf,
						'meta_query' => array(
								'relation' => 'AND', /* <-- here */
									array(
									'key' => 'type',
									'value' => 'pdf',
									),
						) );
			$the_query = null;	
			$the_query = new WP_Query( $pdf_args );
			if ($the_query->have_posts()) {		
			?>
		<div class="pdf-area">
			 <?php 
			   /* $cc = $the_query->get_posts();echo '<pre>';	print_r($cc);die;  */ 
		while ($the_query->have_posts()) : $the_query->the_post();
		$pdffile = get_field('pdf_file');
		?>
          <div class="single-pdf">
             <a href="<?php echo $pdffile['url']?>" target='blank'>
             <div class="image-pdf"><img src="<?php bloginfo('template_directory'); ?>/images/pdf-icon.png" alt=""></div>
           <span class="title"><?php the_title();?></span>
		   </a>
		  </div>
			
          <?php 
			
			endwhile; 	 
			wp_reset_query(); 
			
			/* Exclude 3 PDF */
			if($userplan == 'true'){
			$exclude_pdf_args = array( 
						'post_type' => 'education',
						'post_status' => 'publish',
						'post_per_page' => 3,
						'post__not_in' => $educational_pdf,
						'meta_query' => array(
								'relation' => 'AND', /* <-- here */
									array(
									'key' => 'type',
									'value' => 'pdf',
									),
						) );
				
						
			$the_query = null;	
			$the_query = new WP_Query( $exclude_pdf_args);
			if ($the_query->have_posts()) {
				while ($the_query->have_posts()) : $the_query->the_post(); 
			?>
			  <div class="single-pdf">
				   <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal">
					<div class="image-pdf"><img src="<?php bloginfo('template_directory'); ?>/images/pdf-icon.png" alt=""></div>
					<span class="title"><?php the_title();?></span>
					</a>
			  </div>
				<?php endwhile; 	 
				wp_reset_query();
			} }
			?>
			
			
        </div>
			<?php } } else{
				
				echo "<h2 class='no_found'>No education pdf found</h2>";
				
			} ?>
      </div>
      <div class="clear"></div>
      <!-- #main -->
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </main>
  <!-- #main -->
  <div class="clear"></div>
</div>
<!-- #primary --> 

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> Alert</h4>
      </div>
      <div class="modal-body">
        <p>Please upgrade your subscription package.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>
