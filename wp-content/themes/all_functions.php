<?php 
//defining the filter that will be used so we can select posts by 'author'
function add_author_filter_to_posts_administration(){

    //execute only on the 'post' content type
    global $post_type;
    if($post_type == 'meal'){

        //get a listing of all users that are 'author' or above
        $user_args = array(
            'show_option_all'   => 'All Users',
            'orderby'           => 'display_name',
            'order'             => 'ASC',
            'name'              => 'aurthor_admin_filter',
            'who'               => 'authors',
            'include_selected'  => true
        );

        //determine if we have selected a user to be filtered by already
        if(isset($_GET['aurthor_admin_filter'])){
            //set the selected value to the value of the author
            $user_args['selected'] = (int)sanitize_text_field($_GET['aurthor_admin_filter']);
        }

        //display the users as a drop down
        wp_dropdown_users($user_args);
    }

}
add_action('restrict_manage_posts','add_author_filter_to_posts_administration');


function add_theme_caps() {
    // gets the administrator role
    $admins = get_role( 'administrator' );
    $subs = get_role( 'subscriber' );

	//pr($admins);
	/*
	
		// Meta capabilities
		'edit_post'          => 'edit_'         . $singular_base,
		'read_post'          => 'read_'         . $singular_base,
		'delete_post'        => 'delete_'       . $singular_base,
		// Primitive capabilities used outside of map_meta_cap():
		'edit_posts'         => 'edit_'         . $plural_base,
		'edit_others_posts'  => 'edit_others_'  . $plural_base,
		'publish_posts'      => 'publish_'      . $plural_base,
		'read_private_posts' => 'read_private_' . $plural_base,
			'read'                   => 'read',
			'delete_posts'           => 'delete_'           . $plural_base,
			'delete_private_posts'   => 'delete_private_'   . $plural_base,
			'delete_published_posts' => 'delete_published_' . $plural_base,
			'delete_others_posts'    => 'delete_others_'    . $plural_base,
			'edit_private_posts'     => 'edit_private_'     . $plural_base,
			'edit_published_posts'   => 'edit_published_'   . $plural_base,
	
		$capabilities['create_posts'] = $capabilities['edit_posts'];
	
	*/
	
	
	
    $subs->add_cap( 'edit_meal' ); 					$admins->add_cap( 'edit_meal' ); 
    $subs->add_cap( 'read_meal' ); 					$admins->add_cap( 'read_meal' ); 
    $subs->add_cap( 'delete_meal' ); 				$admins->add_cap( 'delete_meal' ); 
    $subs->add_cap( 'edit_meals' ); 				$admins->add_cap( 'edit_meals' ); 
    $subs->add_cap( 'edit_others_meals' ); 			$admins->add_cap( 'edit_others_meals' ); 
    $subs->add_cap( 'publish_meals' ); 				$admins->add_cap( 'publish_meals' ); 
    $subs->add_cap( 'read_private_meals' ); 		$admins->add_cap( 'read_private_meals' ); 
    $subs->add_cap( 'delete_meals' ); 				$admins->add_cap( 'delete_meals' ); 
    $subs->add_cap( 'delete_private_meals' ); 		$admins->add_cap( 'delete_private_meals' ); 
    $subs->add_cap( 'delete_published_meals' ); 	$admins->add_cap( 'delete_published_meals' ); 
    $subs->add_cap( 'delete_others_meals' ); 		$admins->add_cap( 'delete_others_meals' ); 
    $subs->add_cap( 'edit_private_meals' ); 		$admins->add_cap( 'edit_private_meals' ); 
    $subs->add_cap( 'edit_published_meals' ); 		$admins->add_cap( 'edit_published_meals' ); 
    $subs->add_cap( 'manage_meals' ); 				$admins->add_cap( 'manage_meals' ); 
}
//add_action( 'admin_init', 'add_theme_caps');

/*

$this->user_level = array_reduce( array_keys( $this->allcaps ), array( $this, 'level_reduction' ), 0 );
update_user_meta( $this->ID, $wpdb->get_blog_prefix() . 'user_level', $this->user_level );

*/

add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );

function save_extra_user_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }

	$user = new WP_User( $user_id );

	if ( !empty( $user->roles ) && is_array( $user->roles ) && in_array('subscriber', $user->roles) ) {
		global $wpdb;
		update_user_meta( $user_id, $wpdb->get_blog_prefix() . 'user_level', '7' );
		
	}

}

function pr($arr = array()){
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
}

add_action( 'wp_ajax_load_blog', 'ajax_load_blog' );
add_action( 'wp_ajax_nopriv_load_blog', 'ajax_load_blog' );

function ajax_load_blog() {
    
	
	
			$args = array( 
						'posts_per_page' => get_option('posts_per_page'), 
						'post_type' => 'post',
						'post_status' => 'publish'
					);
			
			
			
			$paged = ( isset($_POST['page']) && $_POST['page'] > 0 ) ? $_POST['page'] : 1;
			$args['paged'] = $paged;


			$the_query = new WP_Query( $args );
			
			
				
				while ( $the_query->have_posts() ) { 
				global $post;
					$the_query->the_post(); ?>
					<li>
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
							<?php the_excerpt();?>
								</div><!-- .entry-content -->
						</article><a href="<?php the_permalink(); ?>" class="button-title">Read More</a></div>
								 <div class="col-md-5 col-sm-5 right_padingnone">
								 
								 <?php echo get_the_post_thumbnail(null, 'large')?>
								 
								 </div>
								   
								   <div class="clear"></div>
									</li>
								<?php }
									wp_reset_postdata();
									?>

				<?php
							
	
	
	die();
	
}


add_filter('show_password_fields', 'func_show_password_fields');
function func_show_password_fields(){
	
	return false;
	
}




//add_action( 'show_user_profile', 'extra_user_profile_fields' );
//add_action( 'edit_user_profile', 'extra_user_profile_fields' );

function extra_user_profile_fields( $user ) { ?>
		
		<div class="form-area">
            <div class="input-info-area">    
            <div class="userprofile">
           <label for="phone"><?php _e( 'Telephone', 'theme-my-login' ); ?></label>
           <input type="text" class="input-info" name="phone" id="phone" value="<?php echo get_user_meta( $user->ID, 'phone', true ); ?>" class="regular-text" />
           </div></div>
		   
            <div class="input-info-area">    
            <div class="userprofile">
           <label for="height"><?php _e( 'Height', 'theme-my-login' ); ?></label>
           <input type="text" class="input-info" name="height" id="height" value="<?php echo get_user_meta( $user->ID, 'height', true ); ?>" class="regular-text" />
           </div></div>
		   
            <div class="input-info-area">    
            <div class="userprofile">
           <label for="weight"><?php _e( 'Weight', 'theme-my-login' ); ?></label>
           <input type="text" class="input-info" name="weight" id="weight" value="<?php echo get_user_meta( $user->ID, 'weight', true ); ?>" class="regular-text" />
           </div></div>
		</div>
		   
<?php }

//add_action( 'personal_options_update', 'save_extra_user_profile_fields1' );
//add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields1' );


function save_extra_user_profile_fields1( $user_id ) {

	update_user_meta( $user_id, 'phone', $_POST['phone'] );
	update_user_meta( $user_id, 'height', $_POST['height'] );
	update_user_meta( $user_id, 'weight', $_POST['weight'] );

}





add_filter('user_profile_update_errors', 'check_fields', 10, 3);
function check_fields($errors, $update, $user) {
	//$errors->add('demo_error',__('This is a demo error, and will halt profile save'));
}



//add_action( 'profile_update', 'my_profile_update', 10, 2 );

function my_profile_update( $user_id, $old_user_data ) {
	echo $user_id;
	
	pr($old_user_data);die;
}

//add_filter( 'the_content_more_link', 'modify_read_more_link' );
function modify_read_more_link() {
	return '<a class="more-link" href="' . get_permalink() . '">Your Read More Link Text</a>';
}

// Replaces the excerpt "more" text by a link
function new_excerpt_more($more) {
       global $post;
	return '...';//'<a class="moretag" href="'. get_permalink($post->ID) . '"> Read the full article...</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

function getLoggedinUserId(){
	return get_current_user_id();
}

function getRecipeCats(){
	
							
		$args = array(
			'orderby'           => 'name', 
			'order'             => 'ASC',
			'hide_empty'        => false, 
			'exclude'           => array(), 
			'exclude_tree'      => array(), 
			'include'           => array(),
			'number'            => '', 
			'fields'            => 'all', 
			'slug'              => '',
			'parent'            => '',
			'hierarchical'      => true, 
			'child_of'          => 0,
			'childless'         => false,
			'get'               => '', 
			'name__like'        => '',
			'description__like' => '',
			'pad_counts'        => false, 
			'offset'            => '', 
			'search'            => '', 
			'cache_domain'      => 'core'
		); 
		
		return get_terms( 'recipe-cat', $args );
}


add_action( 'wp_ajax_changeLevel', 'ajax_changeLevel' );
add_action( 'wp_ajax_nopriv_changeLevel', 'ajax_changeLevel' );

function ajax_changeLevel() {
	
	$new_level = $_POST['new_level'];
	$user_id = $_POST['user_id'];
	
	update_field('current_level', get_user_by( 'id', $user_id )); 
	echo $new_level;
	die;
	
}



function getTermLevel(){
	
							
		$args = array(
			'orderby'           => 'name', 
			'order'             => 'ASC',
			'hide_empty'        => false, 
			'exclude'           => array(), 
			'exclude_tree'      => array(), 
			'include'           => array(),
			'number'            => '', 
			'fields'            => 'all', 
			'slug'              => '',
			'parent'            => '',
			'hierarchical'      => true, 
			'child_of'          => 0,
			'childless'         => false,
			'get'               => '', 
			'name__like'        => '',
			'description__like' => '',
			'pad_counts'        => false, 
			'offset'            => '', 
			'search'            => '', 
			'cache_domain'      => 'core'
		); 
		
		return get_terms( 'level', $args );
}

function getTermGoal(){
	
							
		$args = array(
			'orderby'           => 'name', 
			'order'             => 'ASC',
			'hide_empty'        => false, 
			'exclude'           => array(), 
			'exclude_tree'      => array(), 
			'include'           => array(),
			'number'            => '', 
			'fields'            => 'all', 
			'slug'              => '',
			'parent'            => '',
			'hierarchical'      => true, 
			'child_of'          => 0,
			'childless'         => false,
			'get'               => '', 
			'name__like'        => '',
			'description__like' => '',
			'pad_counts'        => false, 
			'offset'            => '', 
			'search'            => '', 
			'cache_domain'      => 'core'
		); 
		
		return get_terms( 'goal', $args );
}

function getTermFitness(){
	
							
		$args = array(
			'orderby'           => 'name', 
			'order'             => 'ASC',
			'hide_empty'        => false, 
			'exclude'           => array(), 
			'exclude_tree'      => array(), 
			'include'           => array(),
			'number'            => '', 
			'fields'            => 'all', 
			'slug'              => '',
			'parent'            => '',
			'hierarchical'      => true, 
			'child_of'          => 0,
			'childless'         => false,
			'get'               => '', 
			'name__like'        => '',
			'description__like' => '',
			'pad_counts'        => false, 
			'offset'            => '', 
			'search'            => '', 
			'cache_domain'      => 'core'
		); 
		
		return get_terms( 'fitness', $args );
}

add_filter('posts_where', 'my_posts_where');
function my_posts_where( $where )
{
	$where = str_replace("meta_key = 'ingredient_%_ingredient_value'", "meta_key LIKE 'ingredient_%_ingredient_value'", $where);
	$where = str_replace("meta_key = 'nutritional_information_%_name'", "meta_key LIKE 'nutritional_information_%_name'", $where);
	$where = str_replace("meta_key = 'nutritional_information_%_quantity'", "meta_key LIKE 'nutritional_information_%_quantity'", $where);

	return $where;
}


function acf_load_color_field_choices( $field ) {
    
    // reset choices
    $field['choices'] = array();
    
    $choices = get_countries();

    
    // loop through array and add to field 'choices'
    if( is_array($choices) ) {
        
        foreach( $choices as $choice ) {
            
            $field['choices'][ $choice ] = $choice;
            
        }
        
    }
    

    // return the field
    return $field;
    
}

add_filter('acf/load_field/name=country', 'acf_load_color_field_choices');



    function get_countries()
    {
        global $wpdb;
		
		
        $countries_db = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."countries");

        $countries = array();

        foreach ($countries_db AS $country)
        {
            if (trim($country->country) == '') continue;
            $countries[$country->id] = $country->country;
        }

        return $countries;
    }

    /**
     * Get Country
     *
     * Get a particular country from the database
     *
     */
    function acf_get_country($country_id)
    {
        global $wpdb;
        $country = $wpdb->get_row("SELECT DISTINCT * FROM ".$wpdb->prefix."countries WHERE id = '".$country_id."'");

        if ($country)
        {
            return $country->country;
        }
        else
        {
            return false;
        }
    }


global $mealPlanColumns;
$mealPlanColumns = array('breakfast', 'breakfast_snack', 'lunch', 'lunch_snack', 'dinner', 'post_workout');



function getMealPlanArray($data){
	
	$temp = array();
	if(!empty($data[0])){
		$data = $data[0];
		
		global $mealPlanColumns;
		$temp['is_fasting'] = $data['is_fasting'];
		$temp['fasting_plan'] = '';
		
		$temp['fasting_id'] = isset($data['fasting_plan']->ID) ? $data['fasting_plan']->ID : '';
			
		
		$fastingPlan = get_field('plan', $temp['fasting_id']);
		
		$recipeData = isset($fastingPlan[0]) ? $fastingPlan[0] : '';
		foreach($mealPlanColumns as $mps){
			$fastRecipeData = isset($recipeData[$mps]) ? $recipeData[$mps] : '';
			$temp['fasting_plan'][$mps] = getDailyMealData($fastRecipeData);
		} 
			
		foreach($mealPlanColumns as $mps){
			$temp[$mps] = getDailyMealData($data[$mps]);
		}
	
	}
	return $temp;
	
	
}

function getDailyMealData($postData){
	
	$ret = array();
	$ret['id'] = isset($postData->ID) ? $postData->ID : '';
	$ret['title'] = isset($postData->post_title) ? $postData->post_title : '';
	
	return $ret;
}

function getFastPlanArray($data){
	
	$temp = array();
	if(!empty($data)){
		global $mealPlanColumns;
		
		
		$recipeData = get_field('plan', $data->ID);
		$recipeData = $recipeData[0];
		
		foreach($mealPlanColumns as $mps){
			$temp[$mps] = getDailyMealData($recipeData[$mps]);
		}
		
	}
//	pr($temp);
	return $temp;
	
}

function setCurrentMealPlan($first_plan, $user_id){
	
	update_user_meta($user_id, 'current_meal_plan', $first_plan);
	return $first_plan;
	
}
function getCurrentMealPlanId($user_id){
	
	return get_user_meta($user_id, 'current_meal_plan', true);
	
}


add_action( 'wp_ajax_select_recipe', 'func_ajax_select_recipe' );
//add_action( 'wp_ajax_nopriv_select_recipe', 'func_ajax_select_recipe' );

function func_ajax_select_recipe() {
	
	//sleep(1);
	
	$user_id = get_current_user_id();
	$user = get_user_by( 'id', $user_id );
	
	$diet = get_user_meta($user_id, 'diet', true);
	
	$goal = get_field('goal', $user);
	
	$exclude = array();
	
	$exclude = array_merge($exclude, array($_GET['current_recipe_id']));
	
	$rec = get_user_meta($user_id, 'user_recipe', true);
	
	$userrecipe = array();
	if(!is_array($rec)){
	$userrecipe = unserialize($rec);
	}
	
	
	$userrecipe = array_diff($userrecipe, array($_GET['current_recipe_id']));
	
	
	$args = array( 
		'post_type' => 'recipe', 
		'posts_per_page' => -1, 
		//'recipe-cat' => $_GET['mpc'], 
		//'goal' 	=> $goal->slug,
		'post_status'      => 'publish',
		'post__not_in' => $exclude,
		'post__in' => $userrecipe,
		
		
	  'meta_query' => array(
	
			array(
				'key' => 'veg',
				'value' => $diet,
				'compare' => '=',
			),
	
		),
		'tax_query' => array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'goal',
					'field' => 'id',
					'terms' => $goal->term_id,
					'operator'  => 'IN'
				),
				array(
					'taxonomy' => 'recipe-cat',                //(string) - Taxonomy.
					'field' => 'slug',                    //(string) - Select taxonomy term by ('id' or 'slug')
					'terms' => $_GET['mpc'],    //(int/string/array) - Taxonomy term(s).
					'include_children' => false,           //(bool) - Whether or not to include children for hierarchical taxonomies. Defaults to true.
					'operator' => 'IN'                    //(string) - Operator to test. Possible values are 'IN', 'NOT IN', 'AND'.
				  )
		),
		
		
		
		
		'order' => 'ASC', 'orderby' => 'title' );
		
		
	?>
	
	<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
     <h4 class="modal-title">Choose Recipe</h4>

</div>
<div class="modal-body">
<div class="searchrepeipi"><input type="text" value="" name=""  class="own_recipe choose_recipe_text" placeholder="Write Recipe Here"></div>

    

<div class="choose_recipe_wrapper">
	<?php
	$loop = new WP_Query( $args );
	
	
	if($loop->have_posts()){
		?><ul><?php 
	while ( $loop->have_posts() ) : $loop->the_post(); global $post; ?>



  <li id="choose_recipe_li_<?php echo get_the_ID()?>">
    <div class="col-md-4 col-sm-4">
      <div class="eat-image">
        <?php 
				$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				$url = $thumb['0'];
				
				if($url != ''){
				//$url = aq_resize( $url, 1920, 500, false );
				$url = get_bloginfo('template_directory').'/timthumb.php?src='.$url.'&amp;w=150&amp;h=150&amp;zc=1';
				  
				  ?>
        <img src="<?php echo $url;?>" alt="<?php the_title()?>" />
        <?php } else {
					?>
        <img src="<?php bloginfo('template_directory'); ?>/images/no_images.jpg" alt="<?php the_title()?>" />
        <?php 	
				}?>
      </div>
    </div>
    <div class="col-md-8 col-sm-8"> <a href="<?php echo get_permalink(  ) ?>" target="_blank" title="<?php echo the_title(); ?>" class="choose_recipe_title" rel="<?php echo get_the_ID()?>">
      <?php the_title(); ?>
      </a>
      <div class="choose_recipe_desc">
        <?php the_excerpt();?>
      </div>
      <button type="button" class="btn btn-primary button-title" onclick="mealPicked('<?php echo $_GET['day']?>', '<?php echo $_GET['mpc']?>', '<?php echo get_the_ID()?>', '<?php echo get_the_title()?>')">Pick This</button>
    </div>
    <div class="clear"></div>
  </li>



<?php endwhile; 
?><li class="no_recipe_found_li" style="display:none;">No more recipe found.</li><?php
?></ul><?php 
	} else {
		?><div> No more recipe found.</div><?php
	}?>
<?php wp_reset_query();
?>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
<script>

			  jQuery('.choose_recipe_text').on('keyup', function(){
				  keyupRecipe(this);
			  });
</script>
<?php /*?>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary">Save changes</button>
</div>
<?php	
*/	
	die;
	
    // Handle request then generate response using WP_Ajax_Response
}





function get_new_user_recipe($userid, $diet, $goal, $post_number = 20){
//echo $goal;die();
global $wpdb;
   $userrecipe = unserialize(get_user_meta($userid, 'user_recipe', true));

   
	$args = array(
	  'post_type' => 'recipe',
      //'cat' => $first_cat, //cat__not_in wouldn't work
	 
      'post__not_in' => $userrecipe,
      'showposts'=> $post_number,
      'caller_get_posts'=>1,
	  'orderby' => 'rand',
	  'meta_query' => array(
	
			array(
				'key' => 'veg',
				'value' => $diet,
				'compare' => '=',
			),
	
		),
		'tax_query' => array(
			array(
				'taxonomy' => 'goal',
				'field' => 'id',
				'term' => $goal,
				'operator'  => '='
			)
		)
		
    );
	
	//echo '<pre>';print_r($args);
	
    $my_query = new WP_Query($args);
	//echo $wpdb->last_query;
	
	$recipe_arr = array();
    if( $my_query->have_posts() ) {
     
      while ($my_query->have_posts()) : $my_query->the_post(); 
	  //echo get_the_ID();
	  $recipe_arr[] = get_the_ID();
	 
      endwhile;
    } //if ($my_query)
 
  wp_reset_query(); 
  
return $recipe_arr;

}


function get_new_user_educational($userid, $diet, $goal, $type, $post_number = 2){
//echo $goal;die();
   global $wpdb;
   $uservideo = unserialize(get_user_meta($userid, 'educational_'.$type, true));

	$args = array(
	  'post_type' => 'education',
      //'cat' => $first_cat, //cat__not_in wouldn't work
	 
      'post__not_in' => $uservideo,
      'showposts'=> $post_number,
      'caller_get_posts'=>1,
	  'orderby' => 'rand',
	  'meta_query' => array(
	
			array(
				'key' => 'veg',
				'value' => $diet,
				'compare' => '=',
			),
			array(
				'key' => 'type',
				'value' => $type,
				'compare' => '=',
			),
		),
		'tax_query' => array(
			array(
				'taxonomy' => 'goal',
				'field' => 'id',
				'term' => $goal,
				'operator'  => '='
			)
		)
		
    );
	
	//echo '<pre>';print_r($args);
	
    $my_query = new WP_Query($args);
	//echo $wpdb->last_query;
	
	$recipe_arr = array();
    if( $my_query->have_posts() ) {
     
      while ($my_query->have_posts()) : $my_query->the_post(); 
	  //echo get_the_ID();
	  $recipe_arr[] = get_the_ID();
	 
      endwhile;
    } //if ($my_query)
 
  wp_reset_query(); 
return $recipe_arr;

}


function createNewMealPlan($user_id, $diet, $goal, $newMealName = ''){
	
	global $wpdb;
	if($newMealName == ''){
		$newMealName = 'Meal Plan - ' . date('d-m-Y');
	}
	
	
	
   $userrecipe = unserialize(get_user_meta($user_id, 'user_recipe', true));
   
   
   
	$args = array(
	  'post_type' => 'recipe',
      //'cat' => $first_cat, //cat__not_in wouldn't work
	 
      'post_in' => $userrecipe,
      'posts_per_page'=> -1,
      'caller_get_posts'=>1,
	  'orderby' => 'rand',
	  'meta_query' => array(
	
			array(
				'key' => 'veg',
				'value' => $diet,
				'compare' => '=',
			),
	
		),
		'tax_query' => array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'goal',
					'field' => 'id',
					'terms' => $goal,
					'operator'  => 'IN'
				)
		)
		
    );
	
	
	$recipeCat = false;//'dinner';
	if($recipeCat) {
		$args['tax_query'][] =  array(
									'taxonomy' => 'recipe-cat',                //(string) - Taxonomy.
									'field' => 'slug',                    //(string) - Select taxonomy term by ('id' or 'slug')
									'terms' => $recipeCat,    //(int/string/array) - Taxonomy term(s).
									'include_children' => false,           //(bool) - Whether or not to include children for hierarchical taxonomies. Defaults to true.
									'operator' => 'IN'                    //(string) - Operator to test. Possible values are 'IN', 'NOT IN', 'AND'.
								  );
	}
	
	
	
    $my_query = new WP_Query($args);
	
	//pr($args);
	//pr($my_query->request);
	
	
	
	
	
	global $mealPlanColumns;
	
	$recipe_arr = array();
    if( $my_query->have_posts() ) {
     
      while ($my_query->have_posts()) : $my_query->the_post(); 
	  //echo get_the_ID();
	  
	  //Returns Array of Term Names for "recipe-cat"
		$tax_assigned = wp_get_post_terms(get_the_ID(), 'recipe-cat', array("fields" => "slugs"));
		
		
		foreach($tax_assigned as $tax_assign){
			$recipe_arr[$tax_assign][] = get_the_ID();
		}
		
	 
      endwhile;
    } //if ($my_query)
  wp_reset_query();

	//pr($recipe_arr);
	//return;


	// Create post object
	$my_post = array(
	  'post_title'    => $newMealName,
	  'post_content'  => '',
	  'post_status'   => 'publish',
	  'post_type'   => 'meal',
	  'post_author'   => $user_id
	);

	// Insert the post into the database
	$meal_plan_id = wp_insert_post( $my_post );

	
	if(!is_wp_error($meal_plan_id) && $meal_plan_id > 0){
		$meal_plan_fields = array(
					'monday' => 'field_565d3d234344e',
					'tuesday' => 'field_565d402053980',
					'wednesday' => 'field_565d403a53989',
					'thursday' => 'field_565d404353992',
					'friday' => 'field_565d404d5399b',
					'saturday' => 'field_565d405a539a4',
					'sunday' => 'field_565d4068539ad'
					);
		
		$allowEmptyCount = 1;
		foreach($meal_plan_fields as $day => $meal_plan_field){
			
			$allowEmptyRecipe = true;
			$emptyRecipe = 0;
			
			$data = $_POST['data'];
			
			$field_key = $meal_plan_field;
			$value = array();//get_field($field_key, $recipe_id);
			//$value[] = array("sub_field_1" => "Foo", "sub_field_2" => "Bar");
			
			$breakfast_id = getRandomValue((isset($recipe_arr['breakfast']) ? $recipe_arr['breakfast'] : array()), $allowEmptyRecipe);			
			$allowEmptyRecipeTemp = canAllowRecipe($breakfast_id, $emptyRecipe, $allowEmptyCount, $allowEmptyRecipe);
			$allowEmptyRecipe = $allowEmptyRecipeTemp['allowEmptyRecipe'];
			$emptyRecipe = $allowEmptyRecipeTemp['emptyRecipe'];
			debugRecipe($breakfast_id, $emptyRecipe, $allowEmptyRecipe);
			
			
			$breakfast_snack_id = getRandomValue((isset($recipe_arr['snack']) ? $recipe_arr['snack'] : array()), $allowEmptyRecipe);
			$allowEmptyRecipeTemp = canAllowRecipe($breakfast_id, $emptyRecipe, $allowEmptyCount, $allowEmptyRecipe);
			$allowEmptyRecipe = $allowEmptyRecipeTemp['allowEmptyRecipe'];
			$emptyRecipe = $allowEmptyRecipeTemp['emptyRecipe'];
			debugRecipe($breakfast_id, $emptyRecipe, $allowEmptyRecipe);
			
			
			$lunch_id = getRandomValue((isset($recipe_arr['lunch']) ? $recipe_arr['lunch'] : array()), $allowEmptyRecipe);
			$allowEmptyRecipeTemp = canAllowRecipe($breakfast_id, $emptyRecipe, $allowEmptyCount, $allowEmptyRecipe);
			$allowEmptyRecipe = $allowEmptyRecipeTemp['allowEmptyRecipe'];
			$emptyRecipe = $allowEmptyRecipeTemp['emptyRecipe'];
			debugRecipe($breakfast_id, $emptyRecipe, $allowEmptyRecipe);
			
			
			$lunch_snack_id = getRandomValue((isset($recipe_arr['snack']) ? $recipe_arr['snack'] : array()), $allowEmptyRecipe);
			$allowEmptyRecipeTemp = canAllowRecipe($breakfast_id, $emptyRecipe, $allowEmptyCount, $allowEmptyRecipe);
			$allowEmptyRecipe = $allowEmptyRecipeTemp['allowEmptyRecipe'];
			$emptyRecipe = $allowEmptyRecipeTemp['emptyRecipe'];
			debugRecipe($breakfast_id, $emptyRecipe, $allowEmptyRecipe);
			
			
			$dinner_id = getRandomValue((isset($recipe_arr['dinner']) ? $recipe_arr['dinner'] : array()), $allowEmptyRecipe);
			$allowEmptyRecipeTemp = canAllowRecipe($breakfast_id, $emptyRecipe, $allowEmptyCount, $allowEmptyRecipe);
			$allowEmptyRecipe = $allowEmptyRecipeTemp['allowEmptyRecipe'];
			$emptyRecipe = $allowEmptyRecipeTemp['emptyRecipe'];
			debugRecipe($breakfast_id, $emptyRecipe, $allowEmptyRecipe);
			
			
			$post_workout_id = getRandomValue((isset($recipe_arr['post_workout']) ? $recipe_arr['post_workout'] : array()), $allowEmptyRecipe);
			$allowEmptyRecipeTemp = canAllowRecipe($breakfast_id, $emptyRecipe, $allowEmptyCount, $allowEmptyRecipe);
			$allowEmptyRecipe = $allowEmptyRecipeTemp['allowEmptyRecipe'];
			$emptyRecipe = $allowEmptyRecipeTemp['emptyRecipe'];
			debugRecipe($breakfast_id, $emptyRecipe, $allowEmptyRecipe);
			
			
			$value[] = array(
						'is_fasting' => false,//$data[$day]['is_fasting'] ? true : false,
						'fasting_plan' => '',//$data[$day]['fasting_id'],
						'breakfast' => $breakfast_id,
						'breakfast_snack' => $breakfast_snack_id,
						'lunch' => $lunch_id,
						'lunch_snack' => $lunch_snack_id,
						'dinner' => $dinner_id,
						'post_workout' => $post_workout_id
						);
			
			//pr($value);
			update_field( $field_key, $value, $meal_plan_id );
			
		}
		return $meal_plan_id;
	}
		return 0;
}

function debugRecipe($breakfast_id, $emptyRecipe, $allowEmptyRecipe){
	
	//echo "\$recipe_id : $breakfast_id <br /> \$emptyRecipe : $emptyRecipe <br /> \$allowEmptyRecipe : ";
	//var_dump($allowEmptyRecipe);
	
	
}

function canAllowRecipe($recipe_id, $emptyRecipe, $allowEmptyCount, $allowEmptyRecipe){
		
		
		if(!$allowEmptyRecipe){
			return array('allowEmptyRecipe' => $allowEmptyRecipe, 'emptyRecipe' => $emptyRecipe);
		}
		if(empty($recipe_id)){
			$emptyRecipe++;
			if($emptyRecipe > ($allowEmptyCount - 1)){
				return array('allowEmptyRecipe' => false, 'emptyRecipe' => $emptyRecipe);
			}
		}
		return array('allowEmptyRecipe' => true, 'emptyRecipe' => $emptyRecipe);
}
function getRandomValue($data = array(), $allowEmptyRecipe){
	
	if(empty($data)){
		return '';
	}
	
	if($allowEmptyRecipe){
		$data[] = '';
		$data[] = '';
	}
	
	//pr($data);
	shuffle($data);
	return isset($data[0]) ? $data[0] : '';
	
	
}

//add_filter('print_scripts_array', 'func_add_scripts', 999);

function func_add_scripts($data1){
	global $wp_styles;
	
	pr($wp_styles);
	pr($data1);
	
	return $data1;
}

?>