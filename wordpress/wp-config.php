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
define( 'DB_NAME', 'brief7' );

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
define( 'AUTH_KEY',         'E?K.(U%BR ULX3aqNI(~+3r5_5x{i:AoMb)g`!TN[Gu2PrK1MW._F]IN69wl%D+~' );
define( 'SECURE_AUTH_KEY',  'D`LGxxqJe6tMNRxJC>`NG^[A&j6:WZ`5H)i]-Xq|2N4^_]J4+~3rqs;L<5ch&3z(' );
define( 'LOGGED_IN_KEY',    'd~J4e;P}Vnz:H5,$bX7qU<</Fua,Kyb<I&^7giq*Yerx=)01GbF&p6QMWbgZJ|5]' );
define( 'NONCE_KEY',        'jsqK(B_XS5I$)lQpi3s-ijidExX-#Ks1sH}AW)8:FJMcUO?XDWtM_]u]Z,Vv&>bG' );
define( 'AUTH_SALT',        'D_7)B~vvT/_d2$[eOP+q%K-S4pBI{,1P#sW`NH|*^ad:+)QTbAgq}JoxvumW[=Mg' );
define( 'SECURE_AUTH_SALT', '%qGNz2y0h6q-xsM2(YIadpCirk^$GtA]GEzM4_l[`^!P?+&y1m.AxTD=nh_WhO7w' );
define( 'LOGGED_IN_SALT',   '/5?U6(mybd<.)Z],;l4%6Sz&8XC<-6XUT3[m;aVBap3k/cc:Bm.B]0V~,j[hRYYL' );
define( 'NONCE_SALT',       'xUo<>nb}.fH z8xr_1k]~Gx]6E%,rO(.E|3Y<x|6ut`+%`f@L{I/5P[kR9R{vMiF' );

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
