<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'intenseburn');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '5R92}nV-L_TJ.neS#)4=;V+@w54^rkH{2liDu784e=hKO|-X-.gbY`l7m|+T.}7q');
define('SECURE_AUTH_KEY',  '!!DE[CMe+tla]_C|6->;ei(t|+j&L+I;_3=]]Y3-,x6:x<wKnTy[X/_k;wF;_>FQ');
define('LOGGED_IN_KEY',    '#?WSNqy8Tq2:60Y%c)f0)r6!zB1mox(NWL1eff@$eR]N*?Ds6-x5YxV7l9>tP7gx');
define('NONCE_KEY',        'L.,k7x :QG2k.p!Ryb^VoB<Cv^!b+UHUd;dUl~4D+|#]TE]|{*@HlV>mf(URRUvj');
define('AUTH_SALT',        'UM3GzNDP[:myILk!~!}-CQfe?| |D9KR;s%wYna>NPB[v-,}#jsbf:vnPQ&e+M$u');
define('SECURE_AUTH_SALT', ',3&?^+1%6{t](>e]K^@.YJsA~9AHlL!OinrpV:iyywq{)-zOi2I])N|gC@@]8qt1');
define('LOGGED_IN_SALT',   'bfyHy7dQ_sM}fJx--@8%hp7+AR6GO.<Sij!4A<w]~zZ*6S&+%}Kk-v5R|F};^^*y');
define('NONCE_SALT',       '~m:<K-4 MX9~V!AF||&UWg|md|$%:*,&$%yn-Z!w$_oRnwi6lOc!g6BKNHaT<j1G');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'int_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
