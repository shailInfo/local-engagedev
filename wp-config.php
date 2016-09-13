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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');
define('FS_METHOD', 'direct');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'f7W}e`b6{DfyBDcgNi?DM&9zK(dxJ 8KWwt|@`8^FjCi`Z>b #LFE_)W9:cDm8]2');
define('SECURE_AUTH_KEY',  'NI?`@h!}{u2t<1_YFMHPlY/bd$4C}9Fg:1%RWKv0E0t$}NBctRe5LM-B[ mE#e7G');
define('LOGGED_IN_KEY',    'MrP@+GQ,2Jv?@xT}j)nw5?27{w.e[(K%V?n4:2TmOZDz4W:~=;q*?IJqv9Z|GUL<');
define('NONCE_KEY',        ' N{_mIjZbHDBP>VM>(//^|a>?0{%n}[z}UG6$D4WHR`7x@t!^z-J2hBWSa{P Eud');
define('AUTH_SALT',        'i<m#odv7s0;}|L~DcWAf%rRDCD0XG,ntb?1KRjN83/3dylLg>N72;]Uj%ctu&reK');
define('SECURE_AUTH_SALT', '9<&Iq A+a#N#^sytKzZ #s-ng%cKQv6b%c4qXUn/xKrhWcOp+%1^oRRM O:|1f6s');
define('LOGGED_IN_SALT',   ']^(g4QQyP$ez|tH_`0J)wZ)>VD.K8@[LD TE>1.Gjsm0e~H2Oc1jPXH(f_#;;~Yt');
define('NONCE_SALT',       'W#1oi`>;NW/~b8% w_jMs!wc:Pv,+6]:xCwW.Jm+8n{g6J.*8wq.bv 799-u-rrC');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
