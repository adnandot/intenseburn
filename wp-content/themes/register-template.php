<?php
/**
 * Template Name: Registration
 *
 * This is the template that displays full width page without sidebar
 *
 * @package unite
 */

get_header(); ?>
<div class="slider-main innerpagetitle">
<div class="nivoSlider" id="slider">         
<img class="nivo-main-image" src="<?php bloginfo('template_directory'); ?>/images/banner1.jpg" alt="" /><div class="nivo-caption" style="display: block;">
<div class="theteamtitle">
<div class="container"><p><span class="orange-text"></span> Registration</p></div>
</div>

</div></div>                                                                            
</div>
 
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			

			<div class="container">    
          <div class="col-md-12 col-sm-12">
          <div class="row theteampage">
            <div class="register_pge"><div tabindex="-1" class="fancybox-wrap fancybox-desktop fancybox-type-ajax fancybox-opened"><div class="fancybox-skin"><div class="fancybox-outer"><div class="fancybox-inner">
<section style="background:#000; border-bottom:2px solid #f47404;" class="orange top-memberarea recipes-front">
	<div class="wrapper">		<div class="title">			Registration		</div>		<div class="white line"></div>	</div>
</section>
<section class="memberarea">	<div class="wrapper">		<div class="subpage-icon">			<img src="<?php bloginfo('template_directory'); ?>/images/member-icon.png" alt="" />
		</div>
		<div class="subpage-text-area">			<div class="subpage-text-area-inside">							</div>		</div>
		<div style="margin-bottom:10px;" class="memberarea-pole">
        
        <p>Nulla sed dignissim orci. Nullam lacus magna, ultrices commodo dignissim in, facilisis pharetra libero. Fusce luctus mollis iaculis</p>
		<form method="post" action="#" id="loginform" name="loginform">
			<p class="login-username">
				<label for="user_login">First Name</label>
				<input type="text" size="20" value="" class="input" id="user_login" name="log">
			</p>
            <p class="login-username">
				<label for="user_login">Last Name</label>
				<input type="text" size="20" value="" class="input" id="user_login" name="log">
			</p>
            <p class="login-username">
				<label for="user_login">Email</label>
				<input type="text" size="20" value="" class="input" id="user_login" name="log">
			</p>
            <p class="login-username">
				<label for="user_login">Registration Code</label>
				<input type="text" size="20" value="" class="input" id="user_login" name="log">
			</p>
			
			<p class="login-password">
				<label for="user_pass">Password</label>
				<input type="password" size="20" value="" class="input" id="user_pass" name="pwd">
			</p>
			<p class="login-submit">
				<input type="submit" value="Register" class="button-primary" id="wp-submit" name="wp-submit">
				<input type="hidden" value="" name="redirect_to">
			</p>
		</form>		</div>
	</div>
</section>
</div></div><a href="javascript:;" class="fancybox-item fancybox-close" title="Close"></a></div></div></div>
			

     </div></div>

		</main><!-- #main -->
	</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
