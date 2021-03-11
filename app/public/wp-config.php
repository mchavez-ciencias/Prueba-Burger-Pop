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
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'nKTPXFXa6ifiTpKwP7l0Jy6xrUn92NZkpTJEZwzYFULCz/+czc2g/h9gmFeJ3Xtx8R7LxBqGOtAtEnaC7Sljqw==');
define('SECURE_AUTH_KEY',  'a52bzOxlLjF1IC/M3KhWmU1rRRquDaNbct1Yy4ovuuk+vDRyr9ywucVoqB0rRhrEmI2osE7XNvVbmji1v7oaDw==');
define('LOGGED_IN_KEY',    'nR/V6A8yk2KHgG1hbRn/193EtBo3JxHkwS8cmVDu7i3FEgaP5ERBUBDbyuggB+5miQGXL2u4RPuO499RnMOYUQ==');
define('NONCE_KEY',        'cVMTTaHc3m8uNadpa7gBKy5a7fySH2Manrfyd7PNZU5Y2MSxGN8JtNMsmA/qFsTnPhBAkSoOv57fK5zie+BQHQ==');
define('AUTH_SALT',        'Cpe7LPNcIudHSft6eSDAmKkrPwD+x1eZ2KV/wOu9nw1ve2Ox3AsZiZOFTvJPZ1RK4OrNzJE32Qe2wlsOJpzP4Q==');
define('SECURE_AUTH_SALT', 'ODiAbg+6bH5fDovrQh2dSCApsKw8sxdlegg6oKd6BvjBLFVL3x2jAgfv3frJ4zgVO50Bz5E1XMeHDGE5V8/t+Q==');
define('LOGGED_IN_SALT',   'ZZdEHHlDaxfuwk67Y9KMNatQzCgIP57/w1c9jif/ar7nioiQO5z0KIfgCoZ1wzdVGdtx5HUsKesDQkowXJdmJw==');
define('NONCE_SALT',       'VcfWcdx5WP5gwgBgavbxuQbClVvoFlZNQR7W1Pos1CaAtdtXrMFQMH/v3EVlbXlYlA1mvn4Wblp+s/rhEfYRaQ==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
