<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *


if(!isSubscriber()){
	wp_redirect(site_url('login'));
	exit;
}

 * @package unite
 */

get_header(); 

$videosJson = array();

function getVideoAllCategoryList($post_id){
	

	$termArr = array();
	//Returns Array of Term Names for "level"
	$term_list = wp_get_post_terms($post_id, 'level', array("fields" => "names"));
	$termArr = array_merge($termArr, $term_list);
	
	//Returns Array of Term Names for "goal"
	$term_list = wp_get_post_terms($post_id, 'goal', array("fields" => "names"));
	$termArr = array_merge($termArr, $term_list);
	
	//Returns Array of Term Names for "fitness"
	$term_list = wp_get_post_terms($post_id, 'fitness', array("fields" => "names"));
	$termArr = array_merge($termArr, $term_list);
	
	return $termArr;

}
?>

<div class="container">
<div class="col-md-12 col-sm-12">
  <div class="row">
    <div id="primary" class="content-area col-sm-12 col-md-12 <?php echo of_get_option( 'site_layout' ); ?>">
      <div class="row">
        <div class="col-md-12 col-sm-12">
          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="receipy_boxes">
              <header class="entry-header page-header">
                <h1 class="entry-title "><?php 
				
				?>Recommended Worokut: <span id="categories_span"><?php echo implode(', ', getVideoAllCategoryList($post->ID));?></span>
				</h1>
              </header>
              <!-- .entry-header -->
              
              <div class="col-md-12 col-sm-12">
                <div class="entry-content receipiimage_work">
				<?php 
				$video =  get_field('video');
				$video_thumb =  get_field('video_thumb');
				?>
					<video id="workoutVideo" width="100%" height="100%" controls  poster="<?php //echo $video_thumb;?>">
						<source src="<?php echo $video['url'];?>" type="<?php echo $video['mime_type'];?>"></source>
					</video>
				</div>
				
                <div class="videoDescription">
                <div class="row">
                <div class="col-md-6 col-sm-6">
				<div class="change-level"> <span>Your Current level  is <b id="user_current_level">1<?php //echo get_field('current_level', get_user_by( 'id', getLoggedinUserId() ))?></b></span>
                </div></div>
                <div class="col-md-6 col-sm-6">
				
				<?php 
				
					$ddataa = array(
							'id' => get_the_ID(),
							'title' => get_the_title(),
							'poster' => $video_thumb,
							'url' => $video['url'],
							'mime_type' => $video['mime_type'],
							'categories' => implode(', ', getVideoAllCategoryList($post->ID)),
							);
					$videosJson[] = $ddataa;
				
				
				//Returns Array of Term Names for "level"
				$levelId = wp_get_post_terms($post->ID, 'level', array("fields" => "ids"));
				
				//Returns Array of Term Names for "goal"
				$goalId = wp_get_post_terms($post->ID, 'goal', array("fields" => "ids"));
				
				//Returns Array of Term Names for "fitness"
				$fitnessId = wp_get_post_terms($post->ID, 'fitness', array("fields" => "ids"));
				
				
				
			  $args = array('post_type' => 'video',
				'posts_per_page' => -1,
				'post__not_in' => array(get_the_ID()),
				'tax_query' => array(   //(array) - use taxonomy parameters (available with Version 3.1).
				'relation' => 'AND',  //(string) - Possible values are 'AND' or 'OR' and is the equivalent of ruuning a JOIN for each taxonomy
				  array(
					'taxonomy' => 'level',                //(string) - Taxonomy.
					'field' => 'id',                    //(string) - Select taxonomy term by ('id' or 'slug')
					'terms' => $levelId,    			//(int/string/array) - Taxonomy term(s).
					//'include_children' => true,           //(bool) - Whether or not to include children for hierarchical taxonomies. Defaults to true.
					'operator' => 'IN'                    //(string) - Operator to test. Possible values are 'IN', 'NOT IN', 'AND'.
				  ),
				  array(
					'taxonomy' => 'goal',
					'field' => 'id',
					'terms' => $goalId,
					//'include_children' => false,
					'operator' => 'IN'
				  ),
				  array(
					'taxonomy' => 'fitness',
					'field' => 'id',
					'terms' => $fitnessId,
					//'include_children' => false,
					'operator' => 'IN'
				  )
				),

			 );
			 
			

			 $loop = new WP_Query($args);
			 
			 
			 
			 if($loop->have_posts()) {
				while($loop->have_posts()) : $loop->the_post();
				
					$videoData =  get_field('video');
					$video_thumbData =  get_field('video_thumb');
					$ddataa = array(
							'id' => get_the_ID(),
							'title' => get_the_title(),
							'poster' => $video_thumbData,
							'url' => $videoData['url'],
							'mime_type' => $videoData['mime_type'],
							'categories' => implode(', ', getVideoAllCategoryList(get_the_ID())),
							);
					$videosJson[] = $ddataa;
				
				endwhile;
				wp_reset_postdata();
			 }
			 	?>
			<script type="text/javascript">
			var videosJson = <?php echo json_encode($videosJson);?>;
			var totalVideo = <?php echo count($videosJson);?>;
			
			workoutVideo = document.getElementById('workoutVideo');
			var videoPos = 0;
			
			var id = '';
			var title = '';
			var poster = '';
			var url = '';
			var mime_type = '';
			var categories = '';
			
			function prevVideo(){
				
				
				videoPos--;
				
				if(videoPos < 0){
					videoPos = totalVideo-1;
				}
				
				if(typeof videosJson[videoPos] == 'undefined'){
					videoPos = 0;
				}
				
				playVideo(videoPos);
				
			}
			
			
			
			function nextVideo(){
				
				videoPos++;
				
				if(videoPos == totalVideo){
					videoPos = 0;
				}
				
				if(typeof videosJson[videoPos] == 'undefined'){
					videoPos = 0;
				}
				
				playVideo(videoPos);
					
				
				
				
				
			}
			
			
			
			
			function playVideo(pos){
				
				
					
				id = videosJson[pos].id;
				title = videosJson[pos].title;
				poster = videosJson[pos].poster;
				url = videosJson[pos].url;
				mime_type = videosJson[pos].mime_type;
				categories = videosJson[pos].categories;
				
				
				//jQuery(workoutVideo).attr('poster', poster);
				jQuery(workoutVideo).find('source').attr('src', url);
				jQuery(workoutVideo).find('source').attr('type', mime_type);
				
				jQuery("#categories_span").html(categories);
				jQuery("#top_header_title").html(title);
				
				
		
				workoutVideo.load();
				//workoutVideo.play();
				
			}
			
			
			</script>
				
				
				
				
                <div class="change-level"> <span class="prev-span" onclick="prevVideo();"><</span> <span>change workout</span><span class="next-span" onclick="nextVideo();">></span>
                </div>
                </div></div>
				 <div class="clear"></div>
                </div>
              </div>
              <div class="clear"></div>
            </div>
          </article>
          <!-- #post-## --> 
        </div>
      </div>
      <!-- #primary --> 
    </div>
  </div>
</div>
<?php get_footer(); ?>
