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
define('DB_NAME', 'guitarinstructors_com_blog');

/** MySQL database username */
define('DB_USER', 'gi_blog');

/** MySQL database password */
define('DB_PASSWORD', 'KbPW2YZfc7GwK7Es');

/** MySQL hostname */
define('DB_HOST', '192.168.1.1');

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
define('AUTH_KEY',         ':>l# crtz|5o=y w_PR/HM,mhO5-s []<I+shEC;}q;7kS_LLy;F@UIN# ?mGgFO');
define('SECURE_AUTH_KEY',  '[+M8wZWv0W):oKa0L%4Du:i!i5-E_2Hvi+o6+n@0|$1[hz3i4EAy#FcFA!k{+(]t');
define('LOGGED_IN_KEY',    ' ^ZVMaUuvnuS*w2gUA^i_lV{+!tB[YP&oAMRjTF^Sg}yK-+ v}t7<AA<]1XpAw|5');
define('NONCE_KEY',        '#HZmDQZ{mcoBBb^M:2Qu+k6ZB-EZE/.kiQf>CjG*`AS5j|*AXPR`k,5cD/Q>,#>v');
define('AUTH_SALT',        'smh8+@&8d{-Z+/]V}YN+h8^.LKQB/ypu9oN k>%S8MZ*dT_+5o18{6lu+?hwwsb6');
define('SECURE_AUTH_SALT', 'fPLr^;*:32nj<,J}7iTKx;onRfKPtv,(Xv`=]saI4iBsCV^h6g+Zv5|yFCa5~|/N');
define('LOGGED_IN_SALT',   'zR6@Ux.?&oG?^V;bEC)f#JZv0YJ>(hP&-5XxfCEr#x(I*QiR=[^T63^mNVQtcSu?');
define('NONCE_SALT',       'UN0d9e+ALE2^yAmF7r}Ev[Av@;<HmB:N}^DE,>(k(y*$s-Mk&70T;z8 zb1{`@v`');

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
