<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'ecommerce' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '8)Fz9Vpj?b`d0Ylx=*DU(2cuPlgl9E&`&8SC]/Y<:#zCaL~_.2a@PAgpeT6k.Dm1' );
define( 'SECURE_AUTH_KEY',  'M$NmZ8`-(DK&c$$uq ObR+iM:x3MvY_(<Hw>g}~f])2lLy/F[YlZ(.Pj_7O7%5-=' );
define( 'LOGGED_IN_KEY',    'hx@3y&_:}H.Nas)CF 4z?:z9B(8b9eCv28Hde?>@?MmF~pOnk*/X9&u%sDs2 W><' );
define( 'NONCE_KEY',        'QrL-}<*affNTa**[oz+SStgdQ!N{#~X:oiKH _u,6Mc%d#m{sL[b564B:sq9NH($' );
define( 'AUTH_SALT',        '0S<DM1x9iD?y`@ye8{dT.2BnYyy!10w?8d!Sl7Nl1]G|JaH${%ZG$)r8iit5Z}.%' );
define( 'SECURE_AUTH_SALT', '[O#KGvlMPk&PlGCw,Q<&0^Ay;lOT~e.ZP<8}XaYf_j[-yju);b4gyY_/_UI{SO# ' );
define( 'LOGGED_IN_SALT',   '-<9PT-1pO{~zLTXrCViV#R5uzr:LU}lH&xEdL/1yD%6+GIIFaFH%nBsABvSTywl|' );
define( 'NONCE_SALT',       '<HToz|f{cs)CQYpuJlXS=QLpuU`:)4OM3ydA)t/VhbjZx6):i6nZ`a0<mb`Uo>Ey' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
