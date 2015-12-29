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



$postid = 620;//$_POST["item_number"];

$post_detail = get_post( $postid ); 

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

//$user_id = wp_insert_user( $userdata ) ;

$user_id = 2;

echo "\$user_id = $user_id <br />";


$new_user_recipe = get_new_user_recipe($user_id, $userinfo["acf"]["field_567794581852d"], $userinfo["acf"]["field_56779d416d97d"] );
$user_recipe = serialize($new_user_recipe);


$new_user_educational_vidoes = get_new_user_educational($user_id, $userinfo["acf"]["field_567794581852d"], $userinfo["acf"]["field_56779d416d97d"] , 'video');
$user_educational_video = serialize($new_user_educational_vidoes);



$new_user_educational_pdfs = get_new_user_educational($user_id, $userinfo["acf"]["field_567794581852d"], $userinfo["acf"]["field_56779d416d97d"], 'pdf' );
$user_educational_pdf = serialize($new_user_educational_pdfs);


update_user_meta($user_id, 'user_recipe', $user_recipe);
update_user_meta($user_id, 'educational_video', $user_educational_video);
update_user_meta($user_id, 'silver_plan', $silverplan);
update_user_meta($user_id, 'educational_pdf', $user_educational_pdf);


$meal_plan_id = createNewMealPlan($user_id, $userinfo["acf"]["field_567794581852d"], $userinfo["acf"]["field_56779d416d97d"], $newMealName);
setCurrentMealPlan($meal_plan_id, $user_id);





