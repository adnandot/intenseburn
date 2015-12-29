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


/*print_r($_POST);
$data = ob_get_contents();
mail('testdeveloper30@gmail.com', 'intenseburn', $data );*/


if($_POST["business"]=='sharma.govind-facilitator@dotsquares.com'?$_POST["payment_status"]=='Pending':$_POST["payment_status"]=='Completed'){
$postid = $_POST["item_number"];

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


$addMoreRecipe = get_feild('add_recipe_count', $getsubs->ID) ? get_feild('add_recipe_count', $getsubs->ID) : 10;
$addMoreVideos = get_feild('add_educational_video_count', $getsubs->ID);
$addMorePDFs = get_feild('add_educational_pdf_count', $getsubs->ID);



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

$user_id = wp_insert_user( $userdata ) ;

$user_recipe = serialize(get_user_recipe($user_id, $userinfo["acf"]["field_567794581852d"], $userinfo["acf"]["field_56779d416d97d"] ));

$user_educational_video = serialize(get_user_educational($user_id, $userinfo["acf"]["field_567794581852d"], $userinfo["acf"]["field_56779d416d97d"] , 'video'));

$user_educational_pdf = serialize(get_user_educational($user_id, $userinfo["acf"]["field_567794581852d"], $userinfo["acf"]["field_56779d416d97d"], 'pdf' ));



update_user_meta($user_id, 'user_recipe', $user_recipe);
update_user_meta($user_id, 'educational_video', $user_educational_video);
update_user_meta($user_id, 'silver_plan', $silverplan);
update_user_meta($user_id, 'educational_pdf', $user_educational_pdf);










