 <div  class="row theteampage " id="theme-my-login<?php $template->the_instance(); ?>">
            <div class="login_pge"><div tabindex="-1" class="fancybox-wrap fancybox-desktop fancybox-type-ajax fancybox-opened"><div class="fancybox-skin"><div class="fancybox-outer"><div class="fancybox-inner">

<section class="memberarea"><div class="wrapper">		
		<div class="subpage-text-area"><div class="subpage-text-area-inside"></div>		</div>
		<div style="margin-bottom:10px;" class="memberarea-pole">
		
			<div class="pleaselogincont">
			<?php $template->the_action_template_message( 'login' ); ?>
            
			<?php $template->the_errors(); ?>
		</div>
			<form name="loginform" id="loginform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'login' ); ?>" method="post">
				<p class="login-username">
					<label for="user_login<?php $template->the_instance(); ?>"><?php
					if ( 'email' == $theme_my_login->get_option( 'login_type' ) )
						_e( 'E-mail', 'theme-my-login' );
					elseif ( 'both' == $theme_my_login->get_option( 'login_type' ) )
						_e( 'Username or E-mail', 'theme-my-login' );
					else
						_e( 'Username', 'theme-my-login' );
				?></label>
				<input type="text" name="log" id="user_login<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'log' ); ?>" size="20" />
				</p>
				<p class="login-password">
					<label for="user_pass<?php $template->the_instance(); ?>"><?php _e( 'Password', 'theme-my-login' ); ?></label>
					<input type="password" name="pwd" id="user_pass<?php $template->the_instance(); ?>" class="input" value="" size="20" autocomplete="off" />
				</p>
				
				<?php do_action( 'login_form' ); ?>
		
				<p class="login-remember"><label><input name="rememberme" type="checkbox" id="rememberme<?php $template->the_instance(); ?>" value="forever" /> Remember Me</label></p>
				<p class="login-submit">
					<input type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e( 'Log In', 'theme-my-login' ); ?>" />
					<input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'login' ); ?>" />
					<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
					<input type="hidden" name="action" value="login" />
				</p>
			</form>
			<div class="loginlostpass"><?php $template->the_action_links( array( 'login' => false ) ); ?></div>
		</div>
	</div>
</section>
</div></div><a href="javascript:;" class="fancybox-item fancybox-close" title="Close"></a></div></div></div>
			

     </div>
<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
* /
?>
<div class="tml tml-login" id="theme-my-login<?php $template->the_instance(); ?>">
	<?php $template->the_action_template_message( 'login' ); ?>
	<?php $template->the_errors(); ?>
	<form name="loginform" id="loginform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'login' ); ?>" method="post">
		<p class="tml-user-login-wrap">
			<label for="user_login<?php $template->the_instance(); ?>"><?php
				if ( 'email' == $theme_my_login->get_option( 'login_type' ) )
					_e( 'E-mail', 'theme-my-login' );
				elseif ( 'both' == $theme_my_login->get_option( 'login_type' ) )
					_e( 'Username or E-mail', 'theme-my-login' );
				else
					_e( 'Username', 'theme-my-login' );
			?></label>
			<input type="text" name="log" id="user_login<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'log' ); ?>" size="20" />
		</p>

		<p class="tml-user-pass-wrap">
			<label for="user_pass<?php $template->the_instance(); ?>"><?php _e( 'Password', 'theme-my-login' ); ?></label>
			<input type="password" name="pwd" id="user_pass<?php $template->the_instance(); ?>" class="input" value="" size="20" autocomplete="off" />
		</p>

		<?php do_action( 'login_form' ); ?>

		<div class="tml-rememberme-submit-wrap">
			<p class="tml-rememberme-wrap">
				<input name="rememberme" type="checkbox" id="rememberme<?php $template->the_instance(); ?>" value="forever" />
				<label for="rememberme<?php $template->the_instance(); ?>"><?php esc_attr_e( 'Remember Me', 'theme-my-login' ); ?></label>
			</p>

			<p class="tml-submit-wrap">
				<input type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e( 'Log In', 'theme-my-login' ); ?>" />
				<input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'login' ); ?>" />
				<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
				<input type="hidden" name="action" value="login" />
			</p>
		</div>
	</form>
	<?php $template->the_action_links( array( 'login' => false ) ); ?>
</div>

<?php */############################################################################################# ?>