<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package unite
 */
 global $post;
?>
<!DOCTYPE HTML>

<html <?php language_attributes(); ?>>
<head>
<?php if(!is_page('enable-javascript')) {?>
<noscript>
    <meta http-equiv="refresh" content="0; URL=<?php echo site_url('/enable-javascript')?>">
</noscript>
<?php } if(is_page('enable-javascript')) {?>
<script>
    window.location.href ='<?php echo site_url('/')?>';
</script>
<?php }?>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>

<link rel='stylesheet' id='skt_fitness-nivo-style-css'  href='<?php bloginfo('template_directory'); ?>/css/slider.css' type='text/css' media='all'>
<link rel='stylesheet' id='skt_fitness-nivo-style-css_2'  href='<?php bloginfo('template_directory'); ?>/css/responsive.css' type='text/css' media='all'>
<link rel='stylesheet' id='skt_fitness-custom-style-css'  href='<?php bloginfo('template_directory'); ?>/css/custom.css' type='text/css' media='all'>
<link rel='stylesheet' id='skt_fitness-nivo-style-css_1'  href='<?php bloginfo('template_directory'); ?>/fonts/fonts.css' type='text/css' media='all'>
<?php /*?>
<link rel='stylesheet' id='skt_fitness-nivo-style-css_1'  href='<?php bloginfo('template_directory'); ?>/css/all.css' type='text/css' media='all'><?php */?>

</head>
<body <?php body_class(); ?> text="green">

<div class="clear"></div>
<div id="page" class="hfeed site">
	<div class="container header-area">
		<?php do_action( 'before' ); ?>
		<header id="masthead" class="site-header col-sm-12" role="banner">
<div class="row">
				<div class="site-branding col-md-3 col-sm-6">
					<?php if( get_header_image() != '' ) : ?>

						<div id="logo">
							<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php header_image(); ?>"  height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="<?php bloginfo( 'name' ); ?>"/></a></h1>
							<!--<h4 class="site-description"><?php //bloginfo( 'description' ); ?></h4>-->
						</div><!-- end of #logo -->

					<?php endif; // header image was removed ?>

					<?php if( !get_header_image() ) : ?>

						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<h4 class="site-description"><?php bloginfo( 'description' ); ?></h4>

					<?php endif; // header image was removed (again) ?>
				</div>

			<div class="social-header col-md-9 col-sm-6">
				<?php //unite_social(); // Social icons in header ?>
                
                <div class="social-area col-sm-12">
						<div class="footer-social">
					<a href="#">
							<i class="fa fa-twitter"></i>
						</a>
						<a href="#">
							<i class="fa fa-facebook"></i>
						</a>
						<a href="#">
							<i class="fa fa-youtube-play"></i>
						</a>
						<a href="#">
							<i class="fa fa-google-plus"></i>
						</a>
				</div>
					</div>
                    <div class="login-area col-sm-12">
					
					<?php if(!is_user_logged_in()){?>
					<a href="<?php echo esc_url( home_url( '/register' ) ); ?>">Redeem the code</a> or <a href="<?php echo esc_url( home_url( '/login' ) ); ?>" class="fancybox fancybox.ajax login-link">Login</a> 
					<?php } ?>
					<a href="<?php echo esc_url( home_url( '/member-area' ) ); ?>" class="ma-link">Member Area</a>
					<?php 
					 if(is_user_logged_in()){
						?><br /><span style="font-size:16px; color:#fff;"><a href="<?php echo wp_logout_url(); ?>">Logout</a><br /> <?php //echo getCurrentUserDisplayName();?></span><?php
					}
					
					?>
					</div>
                
                
                               
                <div class="header" style="width:100%;"><div class="header-inner" style="width:100%;"><nav class="navbar navbar-default nav" role="navigation">
			<div class="container" style="width:100%;">
		        <div class="navbar-header" style="width:100%;">
		            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
		                <span class="sr-only">Navigation</span>
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		            </button>

		        </div>
<div class="nav">
				<?php
		            wp_nav_menu( array(
		                'theme_location'    => 'primary',
		                'depth'             => 2,
		                'container'         => 'div',
		                'container_class'   => 'collapse navbar-collapse navbar-ex1-collapse',
		                'menu_class'        => 'nav navbar-nav',
		                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
		                'walker'            => new wp_bootstrap_navwalker())
		            );
		        ?></div>
		    </div>
		</nav><!-- .site-navigation --></div></div>
        
        
			</div>
</div>
		</header><!-- #masthead -->
	</div>
		

	<div id="content" class="site-content container1">
		
		<?php 
		if(!is_home() && !is_front_page() && !is_page('your-profile')){
		if(has_post_thumbnail($post->ID)) {
			
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
			$url = $thumb['0'];
			
			//$url = aq_resize( $url, 1920, 500, false );
			$url = get_bloginfo('template_directory').'/timthumb.php?src='.$url.'&amp;w=1900&amp;h=400&amp;zc=1';

			?>
		<div class="slider-main innerpagetitle">
			<div class="nivoSlider" id="slider">         
			<?php 
			//echo (get_the_title($post->ID));
			?><img src="<?php echo $url;?>" class="nivo-main-image" alt="<?php echo trim( strip_tags( get_the_title($post->ID) ) );?>"/><?php
			
			/*$default_attr = array(
				//'src'   => $url,
				'class' => "nivo-main-image",
				'alt'   => trim( strip_tags( get_the_title($post->ID) ) ),
				'title' => trim( strip_tags( get_the_title($post->ID) ) )
			);
			the_post_thumbnail('full', $default_attr);*/
			?>
			<div class="nivo-caption" style="display: block;">
			<div class="theteamtitle">
			<div class="container"> <div class="col-md-12 col-sm-12"><p id="top_header_title"><?php echo get_the_title($post->ID);?></p></div></div>
			</div>

		</div></div>                                                                            
		</div>
			<?php
		} else {?>
		<div class="container">
			<div class="col-md-12 col-sm-12 class_notitle"><header class="entry-header page-header">
				<h1 id="top_header_title" class="entry-title no-background-image"><?php the_title(); ?></h1>
			</header><!-- .entry-header -->
		</div></div>
		<?php }
		}?>
	