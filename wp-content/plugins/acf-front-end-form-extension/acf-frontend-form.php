<?php
/**
 * Plugin Name: Front End Form Extension for ACF (Free)
 * Description: Display an ACF Form with the custom fields you created on the front end. You can use the short code <code>[acf_form group_id="x"]</code>, where x are field group ids separated by a comma. e.g. <code>[acf_form group_id="1,6,10"]</code>, You can also set whether to create a new entry by using <code>[acf_form group_id="x" create_new_post="true" post_type="post-type"]</code> the type is an argument that sets the type of post. Type is set to 'post' by default.
 * Author: The Portland Company
 * Author URI: https://profiles.wordpress.org/d363f86b/
 * Plugin URI: http://www.theportlandcompany.com
 * Version: 1.0.9
 */
define( 'ACFFEF_FREE_VERSION', '1.0.9');

require_once( dirname( __FILE__ ). '/classes/ACFFrontendFormAdminRawScripts.php' );
require_once( dirname( __FILE__ ). '/classes/ACFFrontendFormAdminNotices.php' );
require_once( dirname( __FILE__ ). '/classes/ACFFrontendFormActivation.php' );
require_once( dirname( __FILE__ ). '/classes/ACFFrontendFormPointers.php' );
require_once( dirname( __FILE__ ). '/classes/ACFFrontendForm.php' );
ACFFrontendForm::instance( );
ACFFrontendFormPointers::instance( );
ACFFrontendFormAdminRawScripts::instance();
ACFFrontendFormAdminNotices::instance();
ACFFrontendFormActivation::instance();

register_activation_hook( __FILE__,  'acffef_free_activation_hook');

function acffef_free_activation_hook() {
	ACFFrontendFormActivation::intro_notice();
}

$current_version = get_option( 'acffef_free_version' );
if (!is_string($current_version) || $current_version != ACFFEF_FREE_VERSION) {
	update_option('acffef_free_version', ACFFEF_FREE_VERSION);
}

?>
