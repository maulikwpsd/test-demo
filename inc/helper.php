<?php

/* ---------------------------------------------------- 
Estimated reading time
---------------------------------------------------- */

add_action('template_redirect', function() {
    ob_start(function($buffer) {
        // 2. This finds "[Number] Min Read" and replaces it with "[Number] Minute Read"
        // It handles both "1 Min Read" and "5 Min Read"
        $search = '/(\d+)\s?Min Read/';
        $replace = '$1 Minute';
        
        return preg_replace($search, $replace, $buffer);
    });
});

// 3. Clean up the buffer when the page is finished
add_action('shutdown', function() {
    if (ob_get_length() > 0) {
        ob_end_flush();
    }
}, 0);


add_filter( 'wp_nav_menu_objects', 'add_acf_icon_to_menu_items', 10, 2 );
function add_acf_icon_to_menu_items( $items, $args ) {

    // Only apply to menu-2
    if ( $args->theme_location !== 'menu-2' ) {
        return $items;
    }

    foreach ( $items as &$item ) {

        // ACF field attached to menu item
        $menu_icon = get_field( 'menu_font_icon', $item->ID );

        if ( $menu_icon ) {
            $item->title = '<i class="' . esc_attr( $menu_icon ) . ' tbnav-icon"></i> ' . $item->title;
        }
    }

    return $items;
}

?>