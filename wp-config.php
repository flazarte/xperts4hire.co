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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'gxpsvdmt_wp43' );

/** MySQL database username */
define( 'DB_USER', 'gxpsvdmt_wp43' );

/** MySQL database password */
define( 'DB_PASSWORD', '3373-(7Sup' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'zkwd4a7nxug1trg5sxaob1ckiiqhg1aqgtmzh7bfgx3auhgnhii0g6ebae25rt7p' );
define( 'SECURE_AUTH_KEY',  '8msdvxts1hg5ny1flv1p7eegccte86ov4sae0eyolde11pb9cdxaq0qr3jaurnrp' );
define( 'LOGGED_IN_KEY',    '2uouu9rsm3da7bl48urukeuao2a3kxq3t8fcqhfq8ridoci08h7gz51firtgcwkj' );
define( 'NONCE_KEY',        'xfwv4ttk1e3yezfqosgwihr2hihkontsaqfufrnl59wmtorgrn4bvndtm895bvph' );
define( 'AUTH_SALT',        'znodxkbbjyhk7hrg7ea7bjgzzr6bvmzb4yf2jc1eza4cq11yblz4synpukr8e9ft' );
define( 'SECURE_AUTH_SALT', '1tpjajfz0anlanxkqok3zxtpeivo3xal8m6ypaqsa7z0teeq65kvj6enhkvnwop4' );
define( 'LOGGED_IN_SALT',   '96cummfypuvq0ee2zbpjziyt2cxn3a8gjy6dg80lsj2wna2s4upffm3scxjjzcam' );
define( 'NONCE_SALT',       '9zmjbw6coql1n3zzwn988e7iqd64ouik8zekdwim3jf1s0xzs2jbaijimynny1y3' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wprr_';

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
