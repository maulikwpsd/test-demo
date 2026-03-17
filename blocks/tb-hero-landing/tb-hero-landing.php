<?php
/**
 * Block template file: tb-hero-landing.php
 *
 * Tb Hero Landing Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'tb-hero-landing-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-tb-hero-landing';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

$hero_microTitle = get_field('micro_title');
$hero_mainTitle  = get_field('main_title');
$hero_content = get_field('hero_content');
$hero_cta_link    = get_field( 'hero_cta_button' );

$form_title = get_field( 'form_title' );
$form_id = get_field( 'form_id' );
$enable_text = get_field( 'enable_shortcode' );
$shortcode = get_field( 'shortcode' );

$background_style = get_field( 'background_style' );
$solid_color = get_field( 'solid_color' );
$gradient_type = get_field( 'gradient_type' );
$imagecorner = get_field( 'select_image_corner', 'option' ); 
$cornerclass = ($imagecorner == 1) ? 'landing-tb-square' : 'landing-tb-circle';
?>
<section id="<?php echo esc_attr( $id ); ?>" class="hero hero--landing <?php echo esc_attr( $classes ); ?> <?php echo $background_style === 'solid-color' ? $solid_color : $gradient_type; ?> <?php echo esc_attr( $cornerclass ); ?>" aria-label="page introduction">      
    <div class="hero-landing_innner">
        <?php if (has_post_thumbnail()) { ?>
            <picture class="hero-img d-none d-lg-block">
                <?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?>
            </picture>
        <?php }?>    
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content d-flex flex-column row-gap-24">
                        <?php get_template_part( 'template-parts/components/hero', 'headings' ); 
                        if ( ! empty( $hero_content ) ) : ?>
                            <div class="editor-content">
                                <?php echo wp_kses_post( $hero_content ); ?>
                            </div>
                        <?php endif; 
                        get_template_part( 'template-parts/components/highlight', 'list' ); 
                        if ( ! empty( $hero_cta_link ) ) : ?>
                            <div class="btn-wrap">
                                <a
                                    class="btn btn--primary-light"
                                    href="<?php echo esc_url( $hero_cta_link['url'] ); ?>"
                                    <?php if ( ! empty( $hero_cta_link['target'] ) ) : ?>
                                        target="<?php echo esc_attr( $hero_cta_link['target'] ); ?>"
                                        rel="noopener noreferrer"
                                    <?php endif; ?>>
                                    <?php echo esc_html( $hero_cta_link['title'] ); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>                
                <?php if ( $shortcode || $form_id) : ?>
                    <div class="col-lg-6 col-xl-4">   
                        <?php if (has_post_thumbnail()) { ?>
                            <picture class="hero-img d-lg-none">
                                <?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?>
                            </picture>
                        <?php }?>  
                        <?php if ( $shortcode || $form_id) : ?>             
                            <div id="lead-form" class="form-wrapper bg-bas-lig">
                                <?php if ( $form_title ) : ?>
                                    <h3><?php echo esc_html( $form_title ); ?></h3>
                                <?php endif; 
                                if ( $enable_text == 1 ) {
                                    echo do_shortcode( $shortcode );
                                } elseif ( $form_id ) {
                                    echo do_shortcode(
                                        '[gravityform id="' . esc_attr( $form_id ) . '" title="false" description="false" ajax="false"]'
                                    );
                                } ?>
                                <?php get_template_part( 'template-parts/components/social', 'ratings' ); ?>
                            </div>     
                        <?php endif; ?>                
                    </div>                
                <?php endif; ?>                    
            </div>
        </div>
    </div>
</section> 