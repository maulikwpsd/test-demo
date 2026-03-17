<?php
// Override parent theme FAQ block
add_action( 'init', function() {
    // Unregister parent block
    unregister_block_type( 'acf/cs-trust-factors' );
    unregister_block_type( 'acf/cs-callout-banner' );
    unregister_block_type( 'acf/cs-faqs' );
    unregister_block_type( 'acf/cs-two-column' );
   
    // Register child theme override
    register_block_type( HK_TB_DIR . '/blocks/cs-trust-factors' );
    register_block_type( HK_TB_DIR . '/blocks/cs-callout-banner' );
    register_block_type( HK_TB_DIR . '/blocks/cs-faqs' );
    register_block_type( HK_TB_DIR . '/blocks/cs-two-column' );
}, 15 );
 
// Enqueue child theme FAQ styles (frontend + admin)
$enqueue_override_styles = function() {
    wp_dequeue_style( 'acf-cs-faqs' );
    wp_enqueue_style( 'acf-cs-faqs-child', 
        get_stylesheet_directory_uri() . '/blocks/cs-faqs/cs-faqs.css',
        array(), 
        filemtime( get_stylesheet_directory() . '/blocks/cs-faqs/cs-faqs.css' ) 
    );

    wp_dequeue_style( 'cs-callout-banner' );
    wp_enqueue_style( 'cs-callout-banner-child', 
        get_stylesheet_directory_uri() . '/blocks/cs-callout-banner/cs-callout-banner.css',
        array(), 
        filemtime( get_stylesheet_directory() . '/blocks/cs-callout-banner/cs-callout-banner.css' ) 
    );

    wp_dequeue_style( 'cs-trust-factors' );
    wp_enqueue_style( 'cs-trust-factors-child', 
        get_stylesheet_directory_uri() . '/blocks/cs-trust-factors/cs-trust-factors.css',
        array(), 
        filemtime( get_stylesheet_directory() . '/blocks/cs-trust-factors/cs-trust-factors.css' ) 
    );

    wp_dequeue_style( 'cs-two-column' );
    wp_enqueue_style( 'cs-two-column-child', 
        get_stylesheet_directory_uri() . '/blocks/cs-two-column/cs-two-column.css',
        array(), 
        filemtime( get_stylesheet_directory() . '/blocks/cs-two-column/cs-two-column.css' ) 
    );
};
add_action( 'wp_enqueue_scripts', $enqueue_override_styles, 99 );
add_action( 'admin_enqueue_scripts', $enqueue_override_styles, 99 );
/**
 * Register ACF blocks (Child Theme)
 */
function hk_tb_register_acf_blocks() {


    register_block_type( HK_TB_DIR . '/blocks/tb-services-block' );
    register_block_type( HK_TB_DIR . '/blocks/tb-our-process' );
    register_block_type( HK_TB_DIR . '/blocks/tb-form' );
    register_block_type( HK_TB_DIR . '/blocks/tb-featured-projects' );
    register_block_type( HK_TB_DIR . '/blocks/tb-hero-main' );
    register_block_type( HK_TB_DIR . '/blocks/tb-hero-secondary' );
    register_block_type( HK_TB_DIR . '/blocks/tb-hero-landing' );
    register_block_type( HK_TB_DIR . '/blocks/tb-hero-contact' );
    
}
add_action( 'init', 'hk_tb_register_acf_blocks' );
/**
 * Load ACF JSON from Parent → then Child
 */
  add_filter('acf/settings/load_json', function ($paths) {
    // Reset all paths
    $paths = [];
     // Parent JSON (base)
    $paths[] = trailingslashit(get_template_directory()) . 'acf-json';
    // Child JSON (overrides / extensions)
    $paths[] = trailingslashit(get_stylesheet_directory()) . 'acf-json';

     return $paths;
 }, 999);

/**
 * Save ACF JSON ONLY in Child Theme
 */
add_filter('acf/settings/save_json', function () {
    return trailingslashit(get_stylesheet_directory()) . 'acf-json';
});

// Stop jump to multi step form
add_filter( 'gform_confirmation_anchor_4', '__return_false' );


add_filter('gform_next_button', 'custom_gform_next_button', 10, 3);
function custom_gform_next_button($button, $form, $field) {
    preg_match('/id=[\'"]([^\'"]+)[\'"]/', $button, $id_match);
    $id = isset($id_match[1]) ? $id_match[1] : '';
    preg_match('/onclick=[\'"]([^\'"]+)[\'"]/', $button, $onclick_match);
    $onclick = isset($onclick_match[1]) ? $onclick_match[1] : '';
    preg_match('/tabindex=[\'"]([^\'"]+)[\'"]/', $button, $tabindex_match);
    $tabindex = isset($tabindex_match[1]) ? $tabindex_match[1] : '';
    preg_match('/value=[\'"]([^\'"]+)[\'"]/', $button, $value_match);
    $text = isset($value_match[1]) ? esc_html($value_match[1]) : 'Next';
    return sprintf(
        '<button id="%s" onclick="%s" tabindex="%s" class="btn btn--primary gform_next_button"><span>%s</span></button>',
        esc_attr($id),
        esc_attr($onclick),
        esc_attr($tabindex),
        esc_html($text)
    );
}

add_filter('gform_previous_button', 'custom_gform_previous_button', 10, 3);
function custom_gform_previous_button($button, $form, $field) {
    preg_match('/id=[\'"]([^\'"]+)[\'"]/', $button, $id_match);
    $id = isset($id_match[1]) ? $id_match[1] : '';

    preg_match('/onclick=[\'"]([^\'"]+)[\'"]/', $button, $onclick_match);
    $onclick = isset($onclick_match[1]) ? $onclick_match[1] : '';

    preg_match('/tabindex=[\'"]([^\'"]+)[\'"]/', $button, $tabindex_match);
    $tabindex = isset($tabindex_match[1]) ? $tabindex_match[1] : '';

    preg_match('/value=[\'"]([^\'"]+)[\'"]/', $button, $value_match);
    $text = isset($value_match[1]) ? esc_html($value_match[1]) : 'Previous';

    return sprintf(
        '<button id="%s" onclick="%s" tabindex="%s" class="btn gform_previous_button"><span>%s</span></button>',
        esc_attr($id),
        esc_attr($onclick),
        esc_attr($tabindex),
        esc_html($text)
    );
}


add_action('wp_head', 'apply_texture_acf', 100);

function apply_texture_acf() {
    $main_hero_texture_dark = get_field('main_hero_texture_dark', 'option');
    $main_hero_texture_light = get_field('main_hero_texture_light', 'option');
    $landing_hero_texture_dark = get_field('landing_hero_texture_dark', 'option');
    $landing_hero_texture_light = get_field('landing_hero_texture_light', 'option');
    $secondary_hero_texture_dark = get_field('secondary_hero_texture_dark', 'option');
    $secondary_hero_texture_light = get_field('secondary_hero_texture_light', 'option');    
    $faqs_block_texture_dark = get_field('faqs_block_texture_dark', 'option');
    $faqs_block_texture_light = get_field('faqs_block_texture_light', 'option');
    $final_cta_texture_dark = get_field('final_cta_texture_dark', 'option');
    $final_cta_texture_light = get_field('final_cta_texture_light', 'option');


?>

    <style id='theme-utility-texture'>
    :root {
        --main-hero-texture-dark: url('<?php echo $main_hero_texture_dark; ?>');
        --main-hero-texture-light: url('<?php echo $main_hero_texture_light; ?>');
        --landing-hero-texture-dark: url('<?php echo $landing_hero_texture_dark; ?>');
        --landing-hero-texture-light: url('<?php echo $landing_hero_texture_light; ?>');
        --secondary-hero-texture-dark: url('<?php echo $secondary_hero_texture_dark; ?>');
        --secondary-hero-texture-light: url('<?php echo $secondary_hero_texture_light; ?>');
        --faqs-block-texture-dark: url('<?php echo $faqs_block_texture_dark; ?>');
        --faqs-block-texture-light: url('<?php echo $faqs_block_texture_light; ?>');
        --final-cta-texture-dark: url('<?php echo $final_cta_texture_dark; ?>');
        --final-cta-texture-light: url('<?php echo $final_cta_texture_light; ?>');
    }
    </style>
    <?php
}
?>