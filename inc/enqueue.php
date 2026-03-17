<?php

/**
 * Enqueue parent & child theme styles
 */
function hk_tb_enqueue_child_styles() {

    // Parent theme stylesheet
    wp_enqueue_style(
        'hook-toolbox-parent-style',
        get_template_directory_uri() . '/style.css',
        [],
        HK_TB_VERSION
    );
    // Child theme stylesheet
    wp_enqueue_style(
        'hook-toolbox-child-style',
        HK_TB_URI . '/style.css',
        [ 'hook-toolbox-parent-style' ],
        HK_TB_VERSION
    );

    wp_enqueue_style(
        'hook-toolbox-child-main-css',
        HK_TB_URI . '/sass/main.min.css',
        [ 'hook-toolbox-child-style' ],
        HK_TB_VERSION
    );

    // -------------------------------------------------------------------------
	// Child Theme Scripts
	// -------------------------------------------------------------------------
	wp_enqueue_script(
		'hook-toolbox-child-init',
		get_stylesheet_directory_uri() . '/assets/js/init.js',
		[ 'jquery' ],
		HK_TB_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'hk_tb_enqueue_child_styles', 100 );


?>
