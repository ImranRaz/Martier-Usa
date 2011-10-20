<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'martier');

/** MySQL database username */
define('DB_USER', 'junoonis');

/** MySQL database password */
define('DB_PASSWORD', '77151345');

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
define('AUTH_KEY',         ',n51vt+X}DRY;9*C|-6_6Pf!fJzRsnX3N##hJD`~3;|`g{!s0L3).RI,3< q&Wsn');
define('SECURE_AUTH_KEY',  '3cAnX$$grzA+p!Jyd]-8,gGLQD5l+[UeW:V>ml02Ix=,yDol+^noxj$4*kHx{.$<');
define('LOGGED_IN_KEY',    '4M*=|`h 8OgkH,C$ph] sOQ#dk=u0+?e6%(b`]7B8We0,j;Il+4(Q_{;ZfO7=p}J');
define('NONCE_KEY',        'T:)JT@m>l2wHn/AP?-Y)CC0j6_{QwXW7N<x2(e-HfoW,WRSZ.DN6^pMwuD9A*m!7');
define('AUTH_SALT',        '6}lYrD@bw[A2rAe22lTz_?R1T9AXxFAaASeL1}FAYaTz3@?97tnD0$4X@ZB@6dM<');
define('SECURE_AUTH_SALT', 'xTUZKESWoF~bFB$f.>r9|@4&wRl<*+$2{XIM:YD)0PNPIh7+}:_s_r9D|,LGPqcf');
define('LOGGED_IN_SALT',   'j-83?f]lh]cVI77L;Vye!!|c#EKbPQX%`@zoDX_/$ 54?MT?!0*||plSDr%#W_^w');
define('NONCE_SALT',       '<Cbau{J+YW;/AK:?-e}s.<Tc|aT^f`u9WXIgbIM7I*O>(s{JR~H2FFri{#W</1X?');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
