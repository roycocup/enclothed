[10/03/2014 15:37:00] Rodrigo Dias: Please add me as a contact. Rodrigo Dias
[10/03/2014 15:37:24] Alex Lopez: Alex Lopez has shared contact details with Rodrigo Dias.
[13/03/2014 12:34:18] Alex Lopez: http://open.spotify.com/user/accao/playlist/0Ext7IsNweO7kgPruiBBiJ
[18/03/2014 10:06:29] Rodrigo Dias: <?php
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
define('WP_HOME','http://enclothed.dev');
define( 'FS_METHOD', 'direct' );

$local = false; 

if ($local){
	define('DB_NAME', 'enclothed');
	define('DB_USER', 'root');
	define('DB_PASSWORD', '');
	define('DB_HOST', 'localhost');
} else{
	define('DB_NAME', 'encprod1_enclothed');
	define('DB_USER', 'encprod1_enc');
	define('DB_PASSWORD', 'Pandabear01');
	define('DB_HOST', 'enclothedstaging.likedigitalmedia.com');	
}

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
define('AUTH_KEY',         '[&f$oz8~:WitqK~l?m|[~F.dD]GIZ)1BfSl#zOTO!4W@M=R*b`OCsESjLmSa6J.6');
define('SECURE_AUTH_KEY',  'V,AKy%}mhI!+HlMPHh#{K?cI_)i+7y;*Nb!wS=50,.s[ A0k>+kd5O-YIrdDeG,`');
define('LOGGED_IN_KEY',    '91b7,<~v%NFtwEN$L+[P~61~uX}tI7XbKf}R^JnBKntzI}z :F|%*QFnw3X,>Edm');
define('NONCE_KEY',        'ddR6LigmuK.aK?Y|R?4H9{Py:Gt>i3TL|3ptmd.*kFlF|g6%vOtX*e6NfUZi^0u~');
define('AUTH_SALT',        '[z6DUJEWj>j+3|CaPuFgcrckPx7?7n&g*^P/|(OchO@m]fkD_WY0.}hzG%Qj|+4b');
define('SECURE_AUTH_SALT', ';H-^r4S3|7![l~R2Y lG6e:=:vc5W]}BvIL;M-R!.H3>G#g6&Q,OsDdC-MYDerfs');
define('LOGGED_IN_SALT',   '*Zip|k:3$qhzl&V@bH0}ZKDf`$hmwJZkS/]X>,- g0//1OJm{G~Z?)q%}LG`jMGX');
define('NONCE_SALT',       'YD3X*k$+V~FS$%1i@QfnH8^p#(v =,QX}1)/xIf1N/NAqQ@&i F-D:v2KFIFt&}+');

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

/*Making sure we have a open session*/
if (!session_id()) session_start();

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
