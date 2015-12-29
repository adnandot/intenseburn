<?php


if(isset($_POST["action"]) && $_POST["action"]=='register'){


//if( !email_exists( $_POST['user_email'] ) && !username_exists($_POST['user_login']) ) {
    /* stuff to do when email address exists */
 
	// Create post object
	$my_post = array(

	  'post_title'    => wp_strip_all_tags( $_POST['first_name'] ),
	  'post_content'  => serialize($_POST),
	  'post_status'   => 'publish',
	  'post_author'   => 1,
	  'post_type' 	  => 'register',
	  
	);

	// Insert the post into the database
	$post_id = wp_insert_post( $my_post );

/*

	?>
	<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" id="register_form"  target="_top">
<input type="hidden" name="cmd" value="_xclick-subscriptions">
<input type="hidden" name="business" value="sharma.govind-facilitator@dotsquares.com">
<input type="hidden" name="lc" value="US">
<input type="hidden" name="item_name" value="Sample Subscription Button">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="no_shipping" value="2">
<input type="hidden" name="src" value="1">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="bn" value="PP-SubscriptionsBF:btn_subscribeCC_LG.gif:NonHosted">
<table>
<tr><td><input type="hidden" name="on0" value="Multiple Options">Multiple Options</td>  </tr><tr><td>
<select name="os0">
<option value="Example Monthly" selected="selected">Example Monthly : $20.00 USD - monthly</option>
<option value="Example Daily" >Example Daily : $5.00 USD - daily</option>
<option value="Example Annual" selected="selected">Example Annual : $125.00 USD - yearly</option>
</select> </td></tr>
</table>
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="option_select0" value="Example Monthly">
<input type="hidden" name="option_amount0" value="20.00">
<input type="hidden" name="option_period0" value="M">
<input type="hidden" name="option_frequency0" value="1">
<input type="hidden" name="option_select1" value="Example Daily">
<input type="hidden" name="option_amount1" value="5.00">
<input type="hidden" name="option_period1" value="D">
<input type="hidden" name="option_frequency1" value="1">
<input type="hidden" name="option_select2" value="Example Annual">
<input type="hidden" name="option_amount2" value="125.00">
<input type="hidden" name="option_period2" value="Y">
<input type="hidden" name="option_frequency2" value="1">
<input type="hidden" name="option_index" value="0">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btnbtn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
   </form>
<?php
*/


$planprice = get_post_meta ( $_POST["subscription_plan"], 'price', true );
$plantype = get_post_meta ( $_POST["subscription_plan"], 'type', true );
?>
	<form name="_xclick" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" id="register_form" style="display:none;">
	<input type="hidden" name="cmd" value="_xclick-subscriptions">
	<input type="hidden" name="business" value="sharma.govind-facilitator@dotsquares.com">
	<input type="hidden" name="currency_code" value="USD">

	<!-- Identify the subscription. -->
    <input type="hidden" name="item_name" value="IntensionBurn">
    <input type="hidden" name="item_number" value="<?php echo $post_id;?>">

	<input type="hidden" name="notify_url" value="<?php echo site_url() ?>/wp-register_payment.php" />
    <input type="hidden" name="cancel_return" value="<?php echo site_url() ?>/register/" />
    <input type="hidden" name="return" value="<?php echo site_url() ?>/thanks" />
	<!-- Enable override of buyers's address stored with PayPal . -->
	<input type="hidden" name="a3" value="<?php echo $planprice;?>">
	<input type="hidden" name="p3" value="1">
	<input type="hidden" name="t3" value="<?php echo strtoupper(substr($plantype,0,1));?>">
	<input type="hidden" name="src" value="1">
	
	</form>


	<script src="<?php echo site_url() ?>/wp-includes/js/jquery/jquery.js?ver=1.11.3"></script>

	<script type="text/javascript">
	jQuery(document).ready(function(){

		jQuery("#register_form").submit();

	});
	</script>

	<?php

	die();

	//}

}


