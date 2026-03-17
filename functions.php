<?php
/**
 * Toolbox – Child Theme functions and definitions
 *
 * @package contractor_stnd_toolbox
 */

// Theme constants
if ( ! defined( 'TB_CHILD_THEME_SLUG' ) ) {
    define( 'TB_CHILD_THEME_SLUG', 'contractor_stnd_toolbox' );
}

define( 'HK_TB_DIR', get_stylesheet_directory() );
define( 'HK_TB_URI', get_stylesheet_directory_uri() );

if ( ! defined( 'HK_TB_VERSION' ) ) {
	define( 'HK_TB_VERSION', time() );
}


// -----------------------------------------------------------------------------
// Include Files
// -----------------------------------------------------------------------------

$includes = [
	HK_TB_DIR . '/inc/enqueue.php',
	HK_TB_DIR . '/inc/helper.php',
	HK_TB_DIR . '/inc/setup.php',
];

foreach ( $includes as $file ) {
	if ( file_exists( $file ) ) {
		require_once $file;
	}
}
