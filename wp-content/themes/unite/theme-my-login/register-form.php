<div class="row theteampage">
            <div class="register_pge"><div tabindex="-1" class="fancybox-wrap fancybox-desktop fancybox-type-ajax fancybox-opened"><div class="fancybox-skin"><div class="fancybox-outer"><div class="fancybox-inner">

<section class="memberarea">	<div class="wrapper">		
		<div class="subpage-text-area">			<div class="subpage-text-area-inside">							</div>		</div>
		<div style="margin-bottom:10px;" class="memberarea-pole"  id="theme-my-login<?php $template->the_instance(); ?>">
        
       <div class="pleaselogincont">Nulla sed dignissim orci. Nullam lacus magna, ultrices commodo dignissim in, facilisis pharetra libero. Fusce luctus mollis iaculis
		
		<?php $template->the_action_template_message( 'register', $before_message = '<p class="message" style="display:none;">' ); ?>
		<?php $template->the_errors(); ?>
		</div>
		<form name="registerform" id="loginform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'register' ); ?>" method="post" class="loginform">
		
		

			<p class="tml-user-plan-wrap login-username">
				<label for="user_plan<?php $template->the_instance(); ?>"><?php _e( 'Subscription Plan', 'theme-my-login' ); ?></label>
				<select name="subscription_plan" class="input">
					<option>Silver&nbsp;&nbsp;&pound9 / month</option>
					<option>Silver&nbsp;&nbsp;&pound108 / year</option>
					<option>Gold&nbsp;&nbsp;&nbsp;&nbsp;&pound15 / month</option>
					<option>Gold&nbsp;&nbsp;&nbsp;&nbsp;&pound180 / year</option>
				</select>
			</p>
			
			
			<p class="tml-user-login-wrap login-username">
				<label for="first_name<?php $template->the_instance(); ?>"><?php _e( 'First Name', 'theme-my-login' ); ?></label>
				<input type="text" name="first_name" id="first_name<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'first_name' ); ?>" size="20" />
			</p>
			
			<p class="tml-user-login-wrap login-username">
				<label for="last_name<?php $template->the_instance(); ?>"><?php _e( 'First Name', 'theme-my-login' ); ?></label>
				<input type="text" name="last_name" id="last_name<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'last_name' ); ?>" size="20" />
			</p>
		
			<?php if ( 'email' != $theme_my_login->get_option( 'login_type' ) ) : ?>
			<p class="tml-user-login-wrap login-username">
				<label for="user_login<?php $template->the_instance(); ?>"><?php _e( 'Username', 'theme-my-login' ); ?></label>
				<input type="text" name="user_login" id="user_login<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'user_login' ); ?>" size="20" />
			</p>
			<?php endif; ?>

			<p class="tml-user-email-wrap login-username">
				<label for="user_email<?php $template->the_instance(); ?>"><?php _e( 'E-mail', 'theme-my-login' ); ?></label>
				<input type="text" name="user_email" id="user_email<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'user_email' ); ?>" size="20" />
			</p>

			<p class="tml-user-email-wrap login-username">
				<label for="user_con_email<?php $template->the_instance(); ?>"><?php _e( 'Confirm E-mail', 'theme-my-login' ); ?></label>
				<input type="text" name="user_con_email" id="user_con_email<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'user_con_email' ); ?>" size="20" />
			</p>


			<p class="tml-user-email-wrap login-username" style="display:none;">
				<label for="user_code<?php $template->the_instance(); ?>"><?php _e( 'Invitation Code', 'theme-my-login' ); ?></label>
				<input type="text" name="inv_code" id="inv_code<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'inv_code' ); ?>" size="20" />
			</p>
			
			<?php do_action( 'register_form' ); ?>
			
			<p class="tml-registration-confirmation login-username" id="reg_passmail<?php $template->the_instance(); ?>"><?php echo apply_filters( 'tml_register_passmail_template_message', __( 'Registration confirmation will be e-mailed to you.', 'theme-my-login' ) ); ?></p>
			
			<p class="login-submit">
				<input type="submit" name="wp-submit" class="button-primary" id="wp-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e( 'Register', 'theme-my-login' ); ?>" />
				<input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'register' ); ?>" />
				<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
				<input type="hidden" name="action" value="register" />
			</p>
            <div class="loginlostpass">
			<?php $template->the_action_links( array( 'register' => false ) ); ?>
            </div>
		</form>		</div>
	</div>
</section>
</div></div><a href="javascript:;" class="fancybox-item fancybox-close" title="Close"></a></div></div></div>
			<script type="text/javascript">
			jQuery('input[type="text"], select').addClass('input');
			</script>

     </div>
	 
	 
	 
	 
<?php ################################################################
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
* /
?>
	<div class="tml tml-register" id="theme-my-login<?php $template->the_instance(); ?>">
		<?php $template->the_action_template_message( 'register' ); ?>
		<?php $template->the_errors(); ?>
		<form name="registerform" id="registerform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'register' ); ?>" method="post">
			<?php if ( 'email' != $theme_my_login->get_option( 'login_type' ) ) : ?>
			<p class="tml-user-login-wrap">
				<label for="user_login<?php $template->the_instance(); ?>"><?php _e( 'Username', 'theme-my-login' ); ?></label>
				<input type="text" name="user_login" id="user_login<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'user_login' ); ?>" size="20" />
			</p>
			<?php endif; ?>

			<p class="tml-user-email-wrap">
				<label for="user_email<?php $template->the_instance(); ?>"><?php _e( 'E-mail', 'theme-my-login' ); ?></label>
				<input type="text" name="user_email" id="user_email<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'user_email' ); ?>" size="20" />
			</p>

			<?php do_action( 'register_form' ); ?>

			<p class="tml-registration-confirmation" id="reg_passmail<?php $template->the_instance(); ?>"><?php echo apply_filters( 'tml_register_passmail_template_message', __( 'Registration confirmation will be e-mailed to you.', 'theme-my-login' ) ); ?></p>

			<p class="tml-submit-wrap">
				<input type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e( 'Register', 'theme-my-login' ); ?>" />
				<input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'register' ); ?>" />
				<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
				<input type="hidden" name="action" value="register" />
			</p>
		</form>
		<?php $template->the_action_links( array( 'register' => false ) ); ?>
	</div>
<?php */?>