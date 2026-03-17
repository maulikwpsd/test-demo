<?php
/**
 * Block template file: cs-trust-factors.php
 *
 * Cs Trust Factors Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.

$id = 'cs-trust-factors-' . $block['id'];

if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.

$classes = 'block-cs-trust-factors';

if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}

if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

$pt = get_field('section_top_spacing');
$pb = get_field('section_bottom_spacing');
$trust_factors_logos_images = get_field( 'trust_factors_logos', 'option' );
?>
<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?> <?php echo esc_attr($pt);?> <?php echo esc_attr($pb);?>">
    <?php if ( $trust_factors_logos_images ) : ?>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="trust-factor-logo-sliders">
                        <?php foreach ( $trust_factors_logos_images as $trust_factors_logos_image ): ?>
                            <div class="trust-factor-logo-slide">
                                <img width="<?php echo esc_attr( $trust_factors_logos_image['width'] ); ?>" height="<?php echo esc_attr( $trust_factors_logos_image['height'] ); ?>" src="<?php echo esc_url( $trust_factors_logos_image['url'] ); ?>" alt="<?php echo esc_attr( $trust_factors_logos_image['alt'] ); ?>" />
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</section>