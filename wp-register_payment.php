<?php
/**
 * WordPress Cron Implementation for hosts, which do not offer CRON or for which
 * the user has not set up a CRON job pointing to this file.
 *
 * The HTTP request to this file will not slow down the visitor who happens to
 * visit when the cron job is needed to run.
 *
 * @package WordPress
 */

ignore_user_abort(true);




if ( !defined('ABSPATH') ) {
	/** Set up WordPress environment */
	require_once( dirname( __FILE__ ) . '/wp-load.php' );
}


//$data = ob_get_contents();
//mail('testdeveloper30@gmail.com', 'intenseburn', $data );

if($_REQUEST["business"]=='sharma.govind-facilitator@dotsquares.com'?$_REQUEST["payment_status"]=='Pending':$_REQUEST["payment_status"]=='Completed'){
$postid = $_REQUEST["item_number"];
//627;//
$post_detail = get_post( $postid ); 
//print_r($_POST);


$userinfo = unserialize($post_detail->post_content);
//echo '<pre>'; print_r($userinfo); 

$getplan = get_post($userinfo["subscription_plan"]);

$getuserplan = get_post_meta ( $userinfo["subscription_plan"], 'subscription', true );

$getsubs = get_post($getuserplan);

$silverplan = 0;
if($getsubs->post_title == 'Silver'){
	
	$silverplan = 1;

}


$addMoreRecipe = get_field('add_recipe_count', $getsubs->ID) ? get_field('add_recipe_count', $getsubs->ID) : 20;
$addMoreVideos = get_field('add_educational_video_count', $getsubs->ID) ? get_field('add_educational_video_count', $getsubs->ID) : 2;
$addMorePDFs = get_field('add_educational_pdf_count', $getsubs->ID) ? get_field('add_educational_pdf_count', $getsubs->ID) : 2;





//echo '<pre>'; print_r($getsubs); die();

$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, strlen($alphabet)-1);
        $pass[$i] = $alphabet[$n];
    }

$userpass = implode($pass);

$userdata = array(

    'user_login'  =>  $userinfo["user_login"],
	'user_pass'  =>  $userpass,
	'user_nicename'  =>  $userinfo["first_name"],
	'user_email'  =>  $userinfo["user_email"],
	'user_registered'  =>  date('Y-m-d H:i:s'),
	'user_status'  =>  '0',
	'display_name'  =>  $userinfo["first_name"],
	//'user_url'    =>  $website,

);

echo $user_id = wp_insert_user( $userdata, true ) ;

$data = ob_get_contents();
mail('testdeveloper30@gmail.com', 'intenseburn', $data );

//$user_id = 12;

echo "\$user_id = $user_id <br />";

/*
$new_user_recipe = get_new_user_recipe($user_id, $userinfo["acf"]["field_567794581852d"], $userinfo["acf"]["field_56779d416d97d"] );
$user_recipe = serialize($new_user_recipe);


$new_user_educational_vidoes = get_new_user_educational($user_id, $userinfo["acf"]["field_567794581852d"], $userinfo["acf"]["field_56779d416d97d"] , 'video');
$user_educational_video = serialize($new_user_educational_vidoes);



$new_user_educational_pdfs = get_new_user_educational($user_id, $userinfo["acf"]["field_567794581852d"], $userinfo["acf"]["field_56779d416d97d"], 'pdf' );
$user_educational_pdf = serialize($new_user_educational_pdfs);


//update_user_meta($user_id, 'user_recipe', $user_recipe);
//update_user_meta($user_id, 'educational_video', $user_educational_video);
//update_user_meta($user_id, 'silver_plan', $silverplan);
//update_user_meta($user_id, 'educational_pdf', $user_educational_pdf);


createNewMealPlan($user_id, $newMealName);*/

$new_user_recipe = get_new_user_recipe($user_id, $userinfo["acf"]["field_567794581852d"], $userinfo["acf"]["field_56779d416d97d"] );
$user_recipe = serialize($new_user_recipe);


$new_user_educational_vidoes = get_new_user_educational($user_id, $userinfo["acf"]["field_567794581852d"], $userinfo["acf"]["field_56779d416d97d"] , 'video');
$user_educational_video = serialize($new_user_educational_vidoes);



$new_user_educational_pdfs = get_new_user_educational($user_id, $userinfo["acf"]["field_567794581852d"], $userinfo["acf"]["field_56779d416d97d"], 'pdf' );
$user_educational_pdf = serialize($new_user_educational_pdfs);

update_user_meta($user_id, 'current_level', 1);
update_user_meta($user_id, 'phone', $userinfo["acf"]["field_566aa675a37c4"]);
update_user_meta($user_id, 'height', $userinfo["acf"]["field_566aaa4136807"]);
update_user_meta($user_id, 'weight', $userinfo["acf"]["field_566aaa4b36808"]);
update_user_meta($user_id, 'diet', $userinfo["acf"]["field_567794581852d"]);
update_user_meta($user_id, 'goal', $userinfo["acf"]["field_56779d416d97d"]);
update_user_meta($user_id, 'sex', $userinfo["acf"]["field_567153c7355b6"]);
update_user_meta($user_id, 'dob', $userinfo["acf"]["field_567153f5355b7"]);
update_user_meta($user_id, 'street_1', $userinfo["acf"]["field_56715426355b8"]);
update_user_meta($user_id, 'street_2', $userinfo["acf"]["field_5671544b355b9"]);
update_user_meta($user_id, 'city', $userinfo["acf"]["field_5671546b355ba"]);
update_user_meta($user_id, 'state', $userinfo["acf"]["field_56715474355bb"]);
update_user_meta($user_id, 'country', $userinfo["acf"]["field_5671547f355bc"]);
update_user_meta($user_id, 'postcode', $userinfo["acf"]["field_567154a1355bd"]);

update_user_meta($user_id, 'user_recipe', $user_recipe);
update_user_meta($user_id, 'educational_video', $user_educational_video);
update_user_meta($user_id, 'silver_plan', $silverplan);
update_user_meta($user_id, 'educational_pdf', $user_educational_pdf);


$meal_plan_id = createNewMealPlan($user_id, $userinfo["acf"]["field_567794581852d"], $userinfo["acf"]["field_56779d416d97d"], $newMealName);
setCurrentMealPlan($meal_plan_id, $user_id);


$my_post = array(

	  'post_title'    => wp_strip_all_tags( $_POST['address_name'] ),
	  'post_content'  => serialize($_POST),
	  'post_status'   => 'publish',
	  'post_author'   => 1,
	  'post_type' 	  => 'paypal_data',
	  
	);

	// Insert the post into the database
	$post_id = wp_insert_post( $my_post );
	
	

}



