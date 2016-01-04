<?php
/**
 * Template Name: Registration
 *
 * This is the template that displays full width page without sidebar
 *
 * @package unite
 */

get_header(); ?>
 <link rel='stylesheet' id='skt_fitness-nivo-style-css_1'  href='<?php bloginfo('template_directory'); ?>/fonts/fonts.css' type='text/css' media='all'>
 
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<div class="container">    
          <div class="col-md-12 col-sm-12">
          <div class="row theteampage">
            <div class="register_pge"><div tabindex="-1" class="fancybox-wrap fancybox-desktop fancybox-type-ajax fancybox-opened"><div class="fancybox-skin"><div class="fancybox-outer"><div class="fancybox-inner">
			<section class="memberarea">	<div class="wrapper">		
		<div class="subpage-text-area">			<div class="subpage-text-area-inside">							</div>		</div>
		<div id="theme-my-login" class="memberarea-pole" style="margin-bottom:10px;">
        
       <div class="pleaselogincont">Nulla sed dignissim orci. Nullam lacus magna, ultrices commodo dignissim in, facilisis pharetra libero. Fusce luctus mollis iaculis
		</div>
		<form class="loginform" method="post" action="<?php echo site_url();?>/register/" id="loginform" name="registerform">
			
<p class="tml-user-plan-wrap login-username">
<label for="user_plan">Subscription Plan</label>
<select class="input" name="subscription_plan">
<?php
$args = array(
	  'post_type' => 'package',
      //'cat' => $first_cat, //cat__not_in wouldn't work
      'showposts'=>-1,
		
    );
	
	if(isset($_GET['subs'])) {
				$args['meta_query'] = array(  
						   array(
							 'key' => 'subscription',                  //(string) - Custom field key.
							 'value' => $_GET['subs'],                 //(string/array) - Custom field value (Note: Array support is limited to a compare value of 'IN', 'NOT IN', 'BETWEEN', or 'NOT BETWEEN')
							 'type' => 'CHAR',                  //(string) - Custom field type. Possible values are 'NUMERIC', 'BINARY', 'CHAR', 'DATE', 'DATETIME', 'DECIMAL', 'SIGNED', 'TIME', 'UNSIGNED'. Default value is 'CHAR'.
							 'compare' => '=',                  //(string) - Operator to test. Possible values are '=', '!=', '>', '>=', '<', '<=', 'LIKE', 'NOT LIKE', 'IN', 'NOT IN', 'BETWEEN', 'NOT BETWEEN'. Default value is '='.
						   )
				   );
			}
	
	//echo '<pre>';print_r($args);
	
    $my_query = new WP_Query($args);
	//echo $wpdb->last_query;
	
	$recipe_arr = array();
    if( $my_query->have_posts() ) {
     
      while ($my_query->have_posts()) : $my_query->the_post(); 
?>
<option value="<?php echo get_the_ID();?>" ><?php echo get_the_title();?></option>
<?php 
 endwhile;
 } ?>

</select>
</p>
<p class="tml-user-login-wrap login-username">
<label for="first_name">First Name</label>
<input type="text" size="20" value="" class="input" id="first_name" name="first_name">
</p>
	
<p class="tml-user-login-wrap login-username">
<label for="user_login">Username</label>
<input type="text" size="20" value="" class="input" id="user_login" name="user_login">
</p>
<p class="tml-user-email-wrap login-username">
<label for="user_email">E-mail</label>
<input type="text" size="20" value="" class="input" id="user_email" name="user_email">
</p>
<!-- <p>My custom field: <?php //create_options('diet'); ?></p> -->
	<?php do_action( 'register_form' ); ?>
	<p class="login-submit">
		<input type="submit" value="Register" id="wp-submit" class="button-primary" name="wp-submit">
		<!--<input type="hidden" value="http://192.168.0.34/intenseburn/login/?checkemail=registered" name="redirect_to">-->
		<input type="hidden" value="" name="instance">
		<input type="hidden" value="register" name="action">
	</p>
	
    <div class="loginlostpass">
	<ul class="tml-action-links">
<li><a rel="nofollow" href="<?php echo site_url('/login');?>">LOGIN</a></li>
<li><a rel="nofollow" href="<?php echo site_url('/lostpassword');?>">Lost Password</a></li>
</ul>
            </div>
			
		</form>		</div>
	</div> </section>
</div></div><a href="javascript:;" class="fancybox-item fancybox-close" title="Close"></a></div></div></div>
			

     </div></div>

		
	</div>

		</main><!-- #main -->
	</div><!-- #primary -->
	
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.validate.js" type="text/javascript"></script>
<script>
 
	jQuery().ready(function() {
		// validate signup form on keyup and submit
		jQuery("#loginform").validate({
			rules: {
				first_name: "required",
				user_login: "required",
				subscription_plan: "required",
				user_email: {
					required: true,
					email: true
				},
				'acf[field_567153f5355b7]' : "required",
				'acf[field_56779d416d97d]' : "required",
				'acf[field_56715426355b8]' : "required",
				'acf[field_5671544b355b9]' : "required",
				'acf[field_5671546b355ba]' : "required",
				'acf[field_56715474355bb]' : "required",
				'acf[field_5671547f355bc]' : "required",
				'acf[field_567154a1355bd]' : "required"
			},
			messages: {
				first_name: "Please enter your first name",
				user_login: "Please enter your user login",
				subscription_plan: "Please select your plan.",
				user_email: "Please enter a valid email address",
				'acf[field_567153f5355b7]' : "Please enter valid date",
				'acf[field_56779d416d97d]' : "Please select goal",
				'acf[field_56715426355b8]' : "Please enter street.",
				'acf[field_5671544b355b9]' : "Please enter street.",
				'acf[field_5671546b355ba]' : "Please enter city.",
				'acf[field_56715474355bb]' : "Please enter state.",
				'acf[field_5671547f355bc]' : "Please select country.",
				'acf[field_567154a1355bd]' : "Please enter pincode."
				
			}
		});

		setTimeout(function(){ jQuery("input#acf-field_567153f5355b7").next('input').attr('name','acf[field_567153f5355b7]'); }, 2000);
		jQuery("input#acf-field_567153f5355b7").next('input').attr('name','acf[field_567153f5355b7]');
		
		posts = <?php echo json_encode($_POST); ?>;
		if(posts.length != 0){
			subscription_plan = (typeof posts['subscription_plan'] == 'undefined'?'United Kingdom':posts['subscription_plan']);
			jQuery("select[name=subscription_plan]").val(subscription_plan);	//subscription_plan
			jQuery("input[name=first_name]").val( (typeof posts['first_name'] == 'undefined'?'':posts['first_name']));
			jQuery("input[name=user_login]").val( (typeof posts['user_login'] == 'undefined'?'':posts['user_login']));
			jQuery("input[name=user_email]").val( (typeof posts['user_email'] == 'undefined'?'':posts['user_email']));
			
			diet = (typeof posts['acf']['field_567794581852d'] == 'undefined'?'Veg':posts['acf']['field_567794581852d']);
			jQuery("input[name='acf[field_567794581852d]'][value="+diet+"]").attr('checked', 'checked');	//diet acf[field_567794581852d]
			jQuery("input[name='acf[field_567794581852d]']").val( (typeof posts['acf']['field_567794581852d'] == 'undefined'?'':posts['acf']['field_567794581852d']));
			
			sex = (typeof posts['acf']['field_567153c7355b6'] == 'undefined'?'Male':posts['acf']['field_567153c7355b6']);
			jQuery("input[name='acf[field_567153c7355b6]'][value="+sex+"]").attr('checked', 'checked');	//sex acf[field_567153c7355b6]
			jQuery("input[name='acf[field_567153f5355b7]']").val( (typeof posts['acf']['field_567153f5355b7'] == 'undefined'?'':posts['acf']['field_567153f5355b7'])); 	//dob
			jQuery("input[name='acf[field_56715426355b8]']").val( (typeof posts['acf']['field_56715426355b8'] == 'undefined'?'':posts['acf']['field_56715426355b8']));	//street 1
			jQuery("input[name='acf[field_5671544b355b9]']").val( (typeof posts['acf']['field_5671544b355b9'] == 'undefined'?'':posts['acf']['field_5671544b355b9']));	//street 2
			jQuery("input[name='acf[field_5671546b355ba]']").val( (typeof posts['acf']['field_5671546b355ba'] == 'undefined'?'':posts['acf']['field_5671546b355ba']));	//city
			jQuery("input[name='acf[field_56715474355bb]']").val( (typeof posts['acf']['field_56715474355bb'] == 'undefined'?'':posts['acf']['field_56715474355bb']));	//state
			country = (typeof posts['acf']['field_5671547f355bc'] == 'undefined'?'United Kingdom':posts['acf']['field_5671547f355bc']);
			jQuery("select[name='acf[field_5671547f355bc]']").val(country);	//country acf[field_5671547f355bc]
			jQuery("input[name='acf[field_567154a1355bd]']").val( (typeof posts['acf']['field_567154a1355bd'] == 'undefined'?'':posts['acf']['field_567154a1355bd']));	//pincode
			
			jQuery("input[name=redirect_to]").val( (typeof posts['redirect_to'] == 'undefined'?'':posts['redirect_to']));
			jQuery("input[name=instance]").val( (typeof posts['instance'] == 'undefined'?'':posts['instance']));
		}
		
	});
 </script>
<?php get_footer(); ?>
