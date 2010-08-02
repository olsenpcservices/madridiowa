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
define('DB_NAME', 'madridiowa');

/** MySQL database username */
define('DB_USER', 'madridiowa');

/** MySQL database password */
define('DB_PASSWORD', 't1g3r5');

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
define('AUTH_KEY',         '1HZwj:y]xqB_Y{OYd^gy 2Ace1:9PV>nO[R}WjNgGaCXcTxJeylslvdQadbfYF6q');
define('SECURE_AUTH_KEY',  'x5sVI2|h<mht.%4|Ps}5o;[O(U=i~/i:jMm@Da,cE_+}z924.1UghE>5l<:C28#Z');
define('LOGGED_IN_KEY',    'e`y}20OL%K)+mdBWeH0ua~~s0l6hym6D~Raotnn/fh3}|25f,]@^:b6Ff4<ndn&;');
define('NONCE_KEY',        '2@eOTS)#fr+nh;~u0M/%y@e@{yZ`gBV.sNI`$/ul( pG]1]SpL3-5y=:~JH_%93#');
define('AUTH_SALT',        'w!>(0Sf xZL7x /yK^H&?=f?ya[}]KVBPOo(I.*8stm<tVhVM<zneYzP9SBMt=:a');
define('SECURE_AUTH_SALT', 'uI?_{cJ^!9/Pf>]b)<5uOOBVM[FAam7WSpzs? v,-U1^[F15dCec:K%p$- +Z<Ym');
define('LOGGED_IN_SALT',   'd+mnxjpv/:|RbrHu%@5@F#bvfwfRZS^)CK`9qNP:sPSe3Nrp>$sok@<j]zp`QJ1!');
define('NONCE_SALT',       '|MlHe20e(>y:#OgnD|,AY)svgFacF[8W*ZW_D@!]@]gIZrL;obgcOS+u5^DP?Udk');

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
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de.mo to wp-content/languages and set WPLANG to 'de' to enable German
 * language support.
 */
define ('WPLANG', '');

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

