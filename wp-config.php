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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'db-phast' );

/** Database username */
define( 'DB_USER', 'phast' );

/** Database password */
define( 'DB_PASSWORD', 'Mdp123456;' );

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
define( 'AUTH_KEY',         'e1`{:%[5PGs},2>Rf&^<:C_7|JCgH+>fpgyggVz7D;)iSDlqmlDZ%6&@>]`;+CWa' );
define( 'SECURE_AUTH_KEY',  '>u4.%hw8MQ# O{@BTQDBsx0<$W-a4.6W>-Y:.l<-*|<#iHsslP&G>i9Y0`P!cds-' );
define( 'LOGGED_IN_KEY',    'MqpbV~~}m8iUS]#<GmO_VT-E/b!x=ThqO` b+u5K2d!37:W~!:r:#ddyt4rZA?Ls' );
define( 'NONCE_KEY',        'pKpx I!NY6>c96Q?A@2?;9XXAd-D>Buo.cM9oMN_@}G-q`,a5#6FIU YWImn${ET' );
define( 'AUTH_SALT',        '3K%e6Tq<n~tkG*L!afkyl]oMa&{a}4,>%?v<:spHiyef<2p4p8nmHgx2Jkyn5Etr' );
define( 'SECURE_AUTH_SALT', 'et. ?m^Jt)e s2.:H&j-_Z2*W_K&Is)Qu2MNpbMnc3ttYUX.o2o<!kR#*z;Q_y|5' );
define( 'LOGGED_IN_SALT',   'TB0e#uB =XM>])(^CTll7@Z8hQ!moL~WEU{C#PX`>cL%hE^ m.!05C?S_eq6 h0f' );
define( 'NONCE_SALT',       'M1ab&cis#uEfLzL)*K8dWZ!Y(Eqi:{D^iI2(?n&8nRI`!#xcfMwki;qt,BB0c3nU' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'phast_';

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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
