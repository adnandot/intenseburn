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

get_header(); ?>

<div class="container">
<div class="col-md-12 col-sm-12">
  <div class="row">
    <div id="primary" class="content-area col-sm-12 col-md-12 <?php echo of_get_option( 'site_layout' ); ?>">
      <div class="row">
        <div class="col-md-12 col-sm-12">
          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="receipy_boxes">
              <header class="entry-header page-header">
                <h1 class="entry-title">Recommended Worokut
                  Fitness 2 </h1>
              </header>
              <!-- .entry-header -->
              
              <div class="col-md-12 col-sm-12">
                <div class="entry-content receipiimage_work">
				<?php $video =  get_field('video');?>
					<video width="100%" height="500" controls autoplay>
						<source src="<?php echo $video['url'];?>" type="<?php echo $video['mime_type'];?>"></source>
					</video>
				</div>
              </div>
              <div class="col-md-4 col-sm-4">
                <div class="change-workout"> <span> Change Workout </span>
                  <select style="width:98%; margin-left:0px;" name="workout" class="select-info-workout">
                    <option value="Power">Power</option>
                    <option value="Strenght">Strenght</option>
                    <option value="Fitness">Fitness</option>
                  </select>
                  <span></span> </div>
                <div class="change-level"> <span>Your Current level  is <b id="user_current_level"><?php echo get_field('current_level', get_user_by( 'id', getLoggedinUserId() ))?></b></span>
                </div>
                <div class="level-change-area">
                  <div class="change" onclick="jQuery('#change-level-form').toggle();"> Change level of workout </div>
                  <form id="change-level-form" class="change-level-form" method="post" action="" style="display: none;">
                    <input type="hidden" name="update_level">
                    <select id="level" name="level" class="select-info-workout-2-1">
                      <option value="1">LEVEL 1</option>
                      <option value="2">LEVEL 2</option>
                      <option value="3">LEVEL 3</option>
                    </select>
                    <div class="submit-area">
                      <input type="button" id="save_level_btn" onclick="changeLevel(jQuery('#level').val(), '<?php echo getLoggedinUserId();?>');" value="SAVE">
                    </div>
                  </form>
                </div>
              </div>
              <div class="clear"></div>
            </div>
          </article>
          <!-- #post-## --> 
        </div>
      </div>
      <!-- #primary --> 
<script type="text/javascript">
var workout_ajax = null;
function changeLevel(new_level, user_id){
	
	if(workout_ajax != null){
		workout_ajax.abort();
	}
	
	jQuery('#save_level_btn').val('Loading...'); 
	
	workout_ajax = jQuery.post('<?php echo admin_url( 'admin-ajax.php' );?>',{'action':'changeLevel', 'new_level':new_level, 'user_id':user_id}, function(data){
                                    
		jQuery("#user_current_level").html(new_level); //append received data into the element

		jQuery('#save_level_btn').val('SAVE'); 
		
		workout_ajax = null;
	
	}).fail(function(xhr, ajaxOptions, thrownError) { //any errors?
		
		alert(thrownError); //alert with HTTP error
		
		
		jQuery('#save_level_btn').val('SAVE'); 
		workout_ajax = null;
	
	});
	
}
</script>
      
    </div>
  </div>
</div>
<?php get_footer(); ?>
