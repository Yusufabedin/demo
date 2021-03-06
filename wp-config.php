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
define( 'DB_NAME', 'Demo' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define( 'WP_MEMORY_LIMIT', '256M' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '!#wIzdnr&$kUtbUt4#zl |O<0mAgL8j<JbcA=avYWm)u6aQBCx=SL8.(v}![8M_b' );
define( 'SECURE_AUTH_KEY',  '<Ee#)PzRlIYG=?,zvztbR*,9M9dMxIp0`t9Vv0.ba*ML?Km1b-q,qQa^{R}6qY}9' );
define( 'LOGGED_IN_KEY',    'n#p`>!&5Z56yhQm+@>byaU024 K/rl0ob)WFpx@[s^d`35]W5<B7TRJY~ce4Z4gR' );
define( 'NONCE_KEY',        '(3y?19P|yBDCKWfjA4x+,_-Q88)A 0!?bOhHGy~vQlIn!iZI7[s3Nq_UsD/BTWf~' );
define( 'AUTH_SALT',        '~(<tT+tvU;>pNv94=0&8[8onS9zyGLEP78;|c`Xo%SN]1kIo0i-{3oV$W0&[YN,C' );
define( 'SECURE_AUTH_SALT', '!S>Uhy`MZR;-^U~F_B&CK[Wd&mZSslVS,^AYQNph*O/Ou.9YY:yGOCfyv0]~cg.Z' );
define( 'LOGGED_IN_SALT',   '*K6te&H|eR|v :L)wvf|?zd]GlDHrdEM$8Bc4#;rCeLMa|!33p7Y*J<UU<XH&__I' );
define( 'NONCE_SALT',       'aE^tq ?k*Z Vj&ixtRDfwD*NGz(1#j<]V5d-{PXqaGX(9XVU~CUx#)~sRl-RlT?a' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_demo_';

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
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
