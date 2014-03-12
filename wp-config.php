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

define('WP_HOME','http://enclothed.dev');
define( 'FS_METHOD', 'direct' );
//define( 'FS_CHMOD_DIR', 0777 );
//define( 'FS_CHMOD_FILE', 0777 );

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'enclothed');

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
define('AUTH_KEY',         'fH?7p[.8KQ&7rylO[`a,8*8j;Yk+<WF*5_y=^|-Mrc77J1M|lL#!aJN+7 mKDhR_');
define('SECURE_AUTH_KEY',  'QIx)A8c+x9B|cL 3Un+G]r3z;w|y,`Kgp~luarha-Z;8t-PR(bH]uz&%iy|gRCD:');
define('LOGGED_IN_KEY',    '>McT%p5M232hO}mp,)S(xX:_9Z30P8J^D(hj+`KP{6;x#IFg/wB-t-K6NkBP]%k2');
define('NONCE_KEY',        'lvJWO&K&?RK/d^ *^WIts}yWCI`UL|-v1B-RitNLG= ]@IZF7h^7ms+*s~(OocTQ');
define('AUTH_SALT',        'BJ+N[q-+|6MH`mO_Lx@O NUs2prwI^(3*V<,Ua<QV!HJ1}g:E+|]nJZF<gk8N]#1');
define('SECURE_AUTH_SALT', 'Oq.?<i!CMPkDjV>$ZqcLO& T-IngrK!-Bylt%94MP|ss_@zGNw30Frv{{;l#@l[Q');
define('LOGGED_IN_SALT',   'Xv}`mC-[x Mrr#Tlu!9sOFnQ+~g9QT5s<??<0-=V:nzMAK>px;-+z-.oj71F9`Xk');
define('NONCE_SALT',       'gTFn1_pP0nZ!mHNp)<>a6HIUPrJSo72g=6=$Td}P-d1 8%KCa-~jpq?659u0p^m8');

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
